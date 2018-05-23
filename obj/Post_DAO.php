<?php
require_once("functions.php");
/* constructor:
public function __construct($title, $text, $ispost=true, $date=NULL)
*/
class Post_DAO {
	private $post_table;
	private $timeline_id;

	private $db;
	private $timeline_dao;

	public function __construct() {
		$this->db = new db();
		$this->timeline_dao = new Timeline_DAO();

		$this->posts_table = "`Posts`";
		$this->timeline_id = 2;
	}

	public function list_all_posts() {
		return $this->db->get_data("SELECT * FROM $this->posts_table"); 
	}

	public function post_by_id($id) {
		$query = "SELECT * FROM $this->posts_table WHERE `id` = ".$id;
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0];
		}
	}

	public function post_by_title($title) {
		$query = "SELECT * FROM $this->posts_table WHERE `title` = '".$title."'";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0];
		}
	}

	public function new_post($post) {
		$insert = "INSERT INTO $this->posts_table (`title`, `text`, `is_post`, `date`) ";
		$values = "VALUES ('$post->title', '$post->text', $post->is_post, '$post->date')";
		$post_id = $this->db->execute_query($insert.$values);
		if ($post->is_post == 1) {
			//__construct($type, $iid, $is_pinned=0, $date=NULL)
			$timeline_item = new Timeline($this->timeline_id, $post_id, $post->is_pinned, $post->date);
			$this->timeline_dao->add_new_item($timeline_item);
		}
	}

	public function add_new_post($post_data) {
		//__construct($title, $text, $ispost=true, $ispinned = false, $date=NULL)
		$title = $post_data['title'];
		$content = $post_data['content'];
		$is_post = $post_data['is-post'];
		$is_pinned = $post_data['is-pinned'];
		$Post = new Post($title, $content, $is_post, $is_pinned);
		$this->new_post($Post);
	}
}

?>