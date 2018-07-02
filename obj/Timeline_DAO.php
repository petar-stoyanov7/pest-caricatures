<?php
class Timeline_DAO {
	private $db;
	private $timeline_table;

	/// function __construct($type, $iid, $date=NULL)
	public function __construct() {
		$this->db = new db();
		$this->timeline_table = "`Timeline`";
	}

	public function item_by_iid($iid, $type) {
		$query = "SELECT * FROM $this->timeline_table WHERE `item_id` = ".$iid." AND `content_type` = ".$type;
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0];
		}
	}

	public function add_new_item($timeline) {
		$insert = "INSERT INTO $this->timeline_table (`content_type`, `item_id`, `is_pinned`, `date`) ";
		$values = "VALUES (?, ?, ?, ?)";
		$values_array = [$timeline->content_type, $timeline->item_id, $timeline->is_pinned, $timeline->date];
		$query = $insert.$values;
		return $this->db->execute_advanced($query, $values_array);
	}

	public function count_elements($type=NULL) {
		$query = "SELECT COUNT(*) AS count FROM $this->timeline_table";
		if (!is_null($type)) {
			$query .= " WHERE `content_type` = ".$type;
		}
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['count'];
		}
	}


	public function is_pinned($id, $type) {
		$query = "SELECT `is_pinned` from $this->timeline_table 
			WHERE `item_id` = $id AND `content_type` = $type";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['is_pinned'];
		} else {
			return 0;
		}
	}

	public function count_pinned() {
		$query = "SELECT COUNT(*) AS count FROM $this->timeline_table WHERE is_pinned = 1";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['count'];
		}
	}

	public function list_timeline($start=NULL, $number=NULL) {
		$query = "SELECT Timeline.id, Timeline.content_type as type, Timeline.item_id as iid, Timeline.date, Timeline.is_pinned,
			Posts.title as post_title, Posts.text as post_text,
			Caricatures.title as car_title, Caricatures.description as car_desc, Caricatures.path as path
			FROM Timeline 
			LEFT JOIN Posts ON Timeline.item_id = Posts.id AND Timeline.content_type = 2
			LEFT JOIN Caricatures ON Timeline.item_id = Caricatures.id AND Timeline.content_type = 1			
			WHERE Timeline.is_pinned = 0
			ORDER BY `id` DESC";	
		if (!is_null($start) && !is_null($number)) {
			$query .= " LIMIT ".$start.",".$number;
		}
		$data = $this->db->get_data($query);
		if (isset($data[0])) {
			return $data;
		}
	}

	public function list_only_posts($start=NULL, $number=NULL) {
		$query = "SELECT Posts.id as post_id, Posts.title as post_title, Posts.text as post_text, Posts.date
			FROM Posts			
			ORDER BY date DESC";
		if (!is_null($start) && !is_null($number)) {
			$query .= " LIMIT ".$start.",".$number;
		}
		$data = $this->db->get_data($query);
		if (isset($data[0])) {
			for ($i = 0; $i < count($data); $i++) {
				$data[$i]['iid'] = $data[$i]['post_id'];
				$data[$i]['type'] = 2;
			}
			return $data;
		}
	}	

	public function list_pinned() {
		$query = "SELECT Timeline.id, Timeline.content_type as type, Timeline.item_id as iid, Timeline.date, Timeline.is_pinned,
			Posts.title as post_title, Posts.text as post_text,
			Caricatures.title as car_title, Caricatures.description as car_desc, Caricatures.path as path
			FROM Timeline 
			LEFT JOIN Posts ON Timeline.item_id = Posts.id AND Timeline.content_type = 2
			LEFT JOIN Caricatures ON Timeline.item_id = Caricatures.id AND Timeline.content_type = 1
			WHERE Timeline.is_pinned = 1
			ORDER BY date DESC";
		$data = $this->db->get_data($query);
		return $data;
	}

	public function update_item($timeline) {
		$query = "UPDATE $this->timeline_table SET
			`is_pinned` = ".$timeline->is_pinned." 
			WHERE `item_id` = ".$timeline->item_id." 
			AND `content_type` = ".$timeline->content_type;
		$this->db->execute_query($query);
	}

	public function delete_entry($iid, $type) {
		$query = "DELETE FROM $this->timeline_table WHERE `item_id` = $iid AND `content_type` = $type";
		$this->db->execute_query($query);
	}
}
?>