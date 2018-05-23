<?php
require_once("functions.php");
/* constructor:
public function __construct(title, path, cid, ispost=false, date=date("Y-m-d"), url=NULL, tag_id=NULL)
*/
class Caricature_DAO {
	private $category_table;
	private $caricature_table;
	private $timeline_id;

	private $timeline_dao;
	private $db;

	public function __construct() {
		$this->db = new db();
		$this->timeline_dao = new Timeline_DAO();
		$this->category_table = "`Categories`";
		$this->caricature_table = "`Caricatures`";
		$this->timeline_id = 1;
	}

	public function list_all_caricatures() {
		return $this->db->get_data("SELECT * FROM $this->caricature_table"); 
	}

	public function category_by_id($id) {
		return $this->db->get_data("SELECT name FROM $this->category_table WHERE id=".$id)[0]['name'];
	}

	public function category_by_name($name) {
		return $this->db->get_data("SELECT id FROM $this->category_table WHERE name = '".$name."'")[0]['id'];
	}

	public function caricature_by_id($id) {
		return $this->db->get_data("SELECT * FROM `Caricatures` WHERE id=".$id)[0];
	}

	public function next_caricature($id, $gid=NULL) {
		//select id from Caricatures where id = (select min(id) from Caricatures where id > 0 and cid = 1);
		$query = "SELECT `id` FROM `Caricatures` WHERE `id` = 
				(SELECT MIN(`id`) FROM `Caricatures` WHERE `id` > ".$id;
		if ($gid != NULL) {
			$query .= " AND `cid` = ".$gid;
		}
		$query .= " )";
		$result = $this->db->get_data($query);
		if (!isset($result[0])) {
			return $this->first_caricature($gid);
		} else {
			return $result[0]['id'];
		}
	}

	public function previous_caricature($id, $gid=NULL) {
		$query = "SELECT `id` FROM `Caricatures` WHERE `id` = 
				(SELECT MAX(`id`) FROM `Caricatures` WHERE `id` < ".$id;
		if ($gid != NULL) {
			$query .= " AND `cid` = ".$gid;
		}
		$query .= " )";
		$result = $this->db->get_data($query);
		if (!isset($result[0])) {
			return $this->last_caricature($gid);
		} else {
			return $result[0]['id'];						
		}
	}

	public function first_caricature($cid = NULL) {
		$query = "SELECT MIN(id) as min FROM Caricatures";		
		if ($cid != NULL) {
			$query .= " WHERE `cid` = ".$cid;
		}
		return $this->db->get_data($query)[0]['min'];
	}

	public function last_caricature($cid = NULL) {
		$query = "SELECT MAX(id) as max FROM Caricatures";
		if ($cid != NULL) {
			$query .= " WHERE `cid` = ".$cid;
		}
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['max'];
		}
	}

	public function random_caricature() {
		$query = "SELECT `id` FROM Caricatures ORDER BY RAND() LIMIT 1";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['id'];
		}
	}

	public function category_path($search, $is_id=TRUE) {
		if ($is_id) {
			return $this->db->get_data("SELECT path FROM $this->category_table WHERE id=".$search)[0]['path'];
		} else {
			return $this->db->get_data("SELECT path FROM $this->category_table WHERE name like '%".$search."%'")[0]['path'];
		}
	}

	function list_categories() {		
		$query = "SELECT id, name, path FROM Categories";
		return $this->db->get_data($query);
	}

	public function count_caricatures($cid=NULL, $is_post=NULL) {
		$query = "SELECT count(*) FROM `Caricatures`";
		if ($cid != NULL) {
			$query .= " WHERE `cid` = ".$cid;
		}
		if ($cid != NULL && $is_post != NULL) {
			$query .= " AND `is_post` = ".$is_post;
		} else if ($cid == NULL && $is_post != NULL) {
			$query .= "WHERE `is_post` = ".$is_post;
		}
		return $this->db->get_data($query)[0]['count(*)'];
	}

	public function get_category($cid) {
		$query = "SELECT `cid` FROM `Caricatures` WHERE `id` = ".$cid;
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['cid'];
		}
	}

	public function auto_thumb($cid) {
		$count = $this->count_caricatures($cid);
		if ($count > 0) {
			$first_id = $this->db->get_data("SELECT id FROM `Caricatures` WHERE `cid` =".$cid." LIMIT 1")[0]['id'];
			$this->db->execute_query("UPDATE `Categories` SET `thumb_id` =".$first_id." WHERE `id` = ".$cid);
		}
	}

	public function file_upload($file_upload, $path, $upload_name_field = 'file-upload') {
		$file_name = clean_string(cyr_lat($file_upload[$upload_name_field]['name']));
		$temp_name = $file_upload[$upload_name_field]['tmp_name'];
		$file_type = $file_upload[$upload_name_field]['type'];
		$description = $_POST['description'];
		$file_name = clean_string(cyr_lat($file_name));
		if (!$file_upload[$upload_name_field]['tmp_name']) {
			return false;
		} else {
			if (move_uploaded_file($temp_name, $path)) {
				return true;
			}
		}
	}

	public function new_category($category_name) {
		$path = "./content/".clean_string(cyr_lat($category_name))."/";
		$query = "INSERT INTO $this->category_table (`name`, `path`) VALUES ('".$category_name."', '".$path."')";
		$id = $this->db->execute_query($query);
		mkdir($path);
		return $id;
	}

	public function new_caricature($caricature) {
		$insert = "INSERT INTO $this->caricature_table (`title`, `description`, `path`, `cid`, `is_post`, `date`";
		$values = "VALUES ('".$caricature->title."', '".$caricature->description."', '".$caricature->path."', 
					".$caricature->category_id.", ".$caricature->is_post.", '".$caricature->date."'";
		if ($caricature->url != "" && $caricature->url != NULL) {
			$insert .= ", `url`";
			$values .= ", '".$caricature->url."'";
		}
		if ($caricature->tag_id != "" && $caricature->tag_id != NULL) {
			$insert .= ", `tid`";
			$values .= ", '".$caricature->tag_id."'";
		}
		$insert .= " ) ";
		$values .= " )";
		$query = $insert.$values;
		$cid = $this->db->execute_query($query);
		if ($caricature->is_post == 1) {
			//__construct($type, $iid, $is_pinned=NULL, $date=NULL)		
			$timeline_item = new Timeline($this->timeline_id, $cid, $caricature->is_pinned, $caricature->date);
			$this->timeline_dao->add_new_item($timeline_item);
		}
	}

	public function add_new_caricature($post, $files) {
		if ($post['category'] == 'new') {
			$category = $caricature->category = $this->new_category($post['category']);
		} else {
			$category = $post['category'];
		}
		$upload_path = $this->category_path($category);
		$upload_path .= clean_string(cyr_lat($files['file-upload']['name']));
		$title = $post['title'];
		$description = $post['description'];
		$is_pinned = $post['is-pinned'];
		$is_post = $post['is-post'];
		if ($this->file_upload($files, $upload_path)) {
			//__construct($title, $description, $path, $cid, $ispost=false, $ispinned = NULL, $date=NULL, $url=NULL, $tag_id=NULL)
			$caricature = new Caricature($title, $description, $upload_path, $category, $is_post, $is_pinned);
			$this->new_caricature($caricature);
		}
	}


}

?>