<?php
require_once("functions.php");
/* constructor:
public function __construct(title, path, cid, ispost=false, date=date("Y-m-d"), url=NULL, tag_id=NULL)
*/
class Caricature_DAO {
	private $category_table;
	private $caricature_table;
	private $timeline_id;

	private $Timeline_DAO;
	private $db;

	public function __construct() {
		$this->db = new db();
		$this->Timeline_DAO = new Timeline_DAO();
		$this->category_table = "`Categories`";
		$this->caricature_table = "`Caricatures`";
		$this->timeline_id = 1;
	}

	public function list_all_caricatures() {
		return $this->db->get_data("SELECT * FROM $this->caricature_table"); 
	}

	function list_categories() {		
		$query = "SELECT * FROM Categories";
		return $this->db->get_data($query);
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

	public function caricatures_by_category($cid) {
		$query = "SELECT * FROM `Caricatures` WHERE `cid`=".$cid." ORDER BY `id` DESC";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result;
		}
	}

	public function next_caricature($id, $gid=NULL) {
		$query = "SELECT `id` FROM `Caricatures` WHERE `id` = 
				(SELECT MIN(`id`) FROM `Caricatures` WHERE `id` > ".$id;
		if (!is_null($gid)) {
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
		if (!is_null($gid)) {
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
		if (!is_null($cid)) {
			$query .= " WHERE `cid` = ".$cid;
		}
		return $this->db->get_data($query)[0]['min'];
	}

	public function last_caricature($cid = NULL) {
		$query = "SELECT MAX(id) as max FROM Caricatures";
		if (!is_null($cid)) {
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

	public function count_caricatures($cid=NULL, $is_post=NULL) {
		$query = "SELECT count(*) FROM `Caricatures`";
		if (!is_null($cid)) {
			$query .= " WHERE `cid` = ".$cid;
		}
		if (!is_null($cid) && !is_null($is_post)) {
			$query .= " AND `is_post` = ".$is_post;
		} else if (is_null($cid) && !is_null($is_post)) {
			$query .= "WHERE `is_post` = ".$is_post;
		}
		return $this->db->get_data($query)[0]['count(*)'];
	}

	public function get_category_by_id($cid) {
		$query = "SELECT `cid` FROM `Caricatures` WHERE `id` = ".$cid;
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['cid'];
		}
	}

	public function get_category($id) {
		$query = "SELECT * FROM `Categories` WHERE `id` = ".$id;
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0];
		}
	}

	public function auto_thumb($cid) {
		$count = $this->count_caricatures($cid);
		if ($count > 0) {
			$first_id = $this->db->get_data("SELECT id FROM `Caricatures` WHERE `cid` =".$cid." LIMIT 1")[0]['id'];
			$data_array = [$first_id, $cid];
			$this->db->execute_advanced("UPDATE `Categories` SET `thumb_id` = ? WHERE `id` = ?", $data_array);
		}
	}

	public function make_cover($cid) {
		$category_id = $this->get_category_by_id($cid);
		$query = "UPDATE $this->category_table SET `thumb_id`= ? WHERE `id`= ?";
		$data_array = [$cid, $category_id];
		$this->db->execute_advanced($query, $data_array);
	}

	public function get_thumb($cid) {
		$query = "SELECT path FROM `Caricatures` WHERE id=".$cid;
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['path'];
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

	public function delete_directory($path) {
		if (!is_dir($path)) {
			throw new InvalidArgumentException("$path must be directory");
		}
		if (substr($path, strlen($path) - 1, 1) != '/') {
	        $path .= '/';
	    }
	    $files = glob($path.'*', GLOB_MARK);
	    foreach ($files as $file) {
	    	if (is_dir($file)) {
	    		self::delete_directory($file);
	    	} else {
	    		unlink($file);
	    	}
	    }
	    rmdir($path);
	}

	public function new_category($category_name, $category_description="") {
		$path = "./content/".clean_string(cyr_lat($category_name))."/";
		// $query = "INSERT INTO $this->category_table (`name`, `path`) VALUES ('".$category_name."', '".$path."')";
		$query = "INSERT INTO $this->category_table (`name`, `path`, `description`) VALUES (?, ?, ?)";
		$data_array = array($category_name, $path, $category_description);
		$id = $this->db->execute_advanced($query, $data_array);
		mkdir($path);
		return $id;
	}

	public function update_category($id, $name, $description) {
		$query = "UPDATE $this->category_table SET 
			`name` = ?, 
			`description` = ?
			WHERE `id` = ?";
		$values = [$name, $description, $id];
		$this->db->execute_advanced($query, $values);
	}

	public function delete_category($id) {
		$path = $this->category_path($id);
		$this->delete_directory($path);
		$query = "DELETE FROM $this->caricature_table WHERE `cid` = ".$id;
		$this->db->execute_query($query);
		$query = "DELETE FROM $this->category_table WHERE `id` = ".$id;
		$this->db->execute_query($query);
	}

	public function new_caricature($caricature) {
		$insert = "INSERT INTO $this->caricature_table (`title`, `description`, `path`, `cid`, `is_post`, `date`";
		$values_array = [$caricature->title, $caricature->description, $caricature->path, $caricature->category_id,
						$caricature->is_post, $caricature->date];
		$values = "VALUES (?, ?, ?, ?, ?, ? ";		
		if ($caricature->url != "" && !is_null($caricature->url)) {
			$insert .= ", `url`";
			array_push($values_array, $caricature->url);
			$values .= ", ?";
		}
		if ($caricature->tag_id != "" && !is_null($caricature->tag_id)) {
			$insert .= ", `tid`";
			array_push($values_array, $caricature->tag_id);
			$values .= ", ?";
		}
		$insert .= " ) ";
		$values .= " )";
		$query = $insert.$values;
		$cid = $this->db->execute_advanced($query, $values_array);
		if ($caricature->is_post == 1) {
			$timeline_item = new Timeline($this->timeline_id, $cid, $caricature->is_pinned, $caricature->date);
			$this->Timeline_DAO->add_new_item($timeline_item);
		}
	}

	public function add_new_caricature($post, $files) {
		if ($post['category'] == 'new') {
			$category = $this->new_category($post['new-category'], $post['category-description']);
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
			$Caricature = new Caricature($title, $description, $upload_path, $category, $is_post, $is_pinned);
			$this->new_caricature($Caricature);
		}
	}

	public function update_caricature($http_post, $id, $files=NULL) {
		$caricature = $this->caricature_by_id($id);
		$is_pinned = $this->Timeline_DAO->is_pinned($id, 1);
		$timeline_item = new Timeline($this->timeline_id, $id, $http_post['is-pinned'], $caricature['date']);
		if (($caricature['is_post'] == 0) && ($http_post['is-post'] == 1)) {
			$this->Timeline_DAO->add_new_item($timeline_item);
		} else if (($caricature['is_post'] == 1) && ($http_post['is-post'] == 0)) {
			$this->Timeline_DAO->delete_entry($id, 1);
		} else if ($http_post['is-pinned'] != $is_pinned) {
			$this->Timeline_DAO->update_item($timeline_item);
		}

		if ($http_post['category'] == 'new') {
			$category = $this->new_category($http_post['new-category']);
		} else {
			$category = $http_post['category'];
		}
		if ($files !== NULL) {
			$upload_path = $this->category_path($category);
			$upload_path .= clean_string(cyr_lat($files['file-upload']['name']));
			if ($this->file_upload($files, $upload_path)) {
				$this->delete_file($caricature['path']);
				$query = "UPDATE $this->caricature_table SET
						`title` = ?, 
						`description` = ?, 
						`path` = ?, 
						`cid` = ?, 
						`is_post` = ? 
						WHERE `id` = ?";
				$values_array = [$http_post['title'], $http_post['description'], $upload_path, 
						$category, $http_post['is-post'], $id];
				$this->db->execute_advanced($query, $values_array);
			}
		} else {
			if ($http_post['category'] != $caricature['category']) {
				$old_path = $caricature['path'];
				$path = $this->get_category($http_post['category'])['path'];
				$path .= basename($old_path);
				rename($old_path, $path);
			} else {
				$path = $caricature['path'];
			}
			$query = "UPDATE $this->caricature_table SET
						`title` = ?, 
						`description` = ?, 
						`path` = ?, 
						`cid` = ?, 
						`is_post` = ?
						WHERE `id` = ?";
			$values_array = [$http_post['title'], $http_post['description'], $path, 
							$category, $http_post['is-post'], $id];
			$this->db->execute_advanced($query, $values_array);
		}
	}

	public function delete_file($path) {
		if (file_exists($path)) {
			unlink($path);
		}
	}

	public function delete_caricature($id) {
		$caricature = $this->caricature_by_id($id);
		$query = "DELETE FROM $this->caricature_table WHERE `id` = ?";
		$values_array = [$id];
		$this->Timeline_DAO->delete_entry($id, 1);
		$this->db->execute_advanced($query, $values_array);
		$this->delete_file($caricature['path']);
	}


}

?>