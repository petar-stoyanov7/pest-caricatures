<?php
class Timeline_DAO {
	private $db;
	private $timeline_table;

	/// function __construct($type, $iid, $date=NULL)
	public function __construct() {
		$this->db = new db();
		$this->timeline_table = "`Timeline`";
	}

	public function add_new_item($timeline) {
		$insert = "INSERT INTO $this->timeline_table (`content_type`, `item_id`, `is_pinned`, `date`) ";
		$values = "VALUES ($timeline->content_type, $timeline->item_id, $timeline->is_pinned, '".$timeline->date."')";
		$query = $insert.$values;
		return $this->db->execute_query($query);
	}

	public function count_elements() {
		$query = "SELECT COUNT(*) AS count FROM $this->timeline_table";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0]['count'];
		}
	}

	public function list_timeline($start=NULL, $end=NULL) {
		$query = "SELECT Timeline.id, Timeline.content_type as type, Timeline.item_id as iid, Timeline.date, Timeline.is_pinned,
			Posts.title as post_title, Posts.text as post_text,
			Caricatures.title as car_title, Caricatures.description as car_desc, Caricatures.path as path
			FROM Timeline 
			LEFT JOIN Posts ON Timeline.item_id = Posts.id AND Timeline.content_type = 2
			LEFT JOIN Caricatures ON Timeline.item_id = Caricatures.id AND Timeline.content_type = 1			
			WHERE Timeline.is_pinned = 0
			ORDER BY date DESC";
		$data = $this->db->get_data($query);
		if (isset($data[0])) {
			return $data;
		}
	}

	//TODO:
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
}
?>