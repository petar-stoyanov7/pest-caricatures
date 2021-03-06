<?php
require_once("functions.php");
/* constructor:
public function __construct($title, $text, $ispost=true, $date=NULL)
*/
class Post_DAO {
	private $post_table;
	private $timeline_id;

	private $db;
	private $Timeline_DAO;

	public function __construct() {
		$this->db = new db();
		$this->Timeline_DAO = new Timeline_DAO();

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
		$values = "VALUES (?, ?, ?, ?)";
		$values_array = [$post->title, $post->text, $post->is_post, $post->date];
		$query = $insert.$values;
		$post_id = $this->db->execute_advanced($query, $values_array);
		if ($post->is_post == 1) {
			$timeline_item = new Timeline($this->timeline_id, $post_id, $post->is_pinned, $post->date);
			$this->Timeline_DAO->add_new_item($timeline_item);
		}
	}

	public function add_new_post($http_post) {
		$title = $http_post['title'];
		$content = $http_post['content'];
		$is_post = $http_post['is-post2'];
		$is_pinned = $http_post['is-pinned'];
		$Post = new Post($title, $content, $is_post, $is_pinned);
		$this->new_post($Post);
	}

	public function update_post($http_post, $id) {
		$is_pinned = $this->Timeline_DAO->is_pinned($id, 2);
		$post = $this->post_by_id($id);
		$timeline_item = new Timeline($this->timeline_id, $id, $http_post['is-pinned2'], $post['date']);
		if ($post['is_post'] == 0 && $http_post['is-post2'] == 1) {
			$item = $this->Timeline_DAO->item_by_iid($post['id'], 2);
			if (empty($item)) {
				$this->Timeline_DAO->add_new_item($timeline_item);
			}
		} else if (($post['is_post'] == 1) && ($http_post['is-post2'] == 0)) {
			$this->Timeline_DAO->delete_entry($id, 2);
		} if ($http_post['is-pinned2'] != $is_pinned) {
			$this->Timeline_DAO->update_item($timeline_item);
		}
		$query = "UPDATE $this->posts_table SET
					`title` = ?,
					`text` = ?,
					`is_post` = ?
					WHERE `id` = ?";
		$values_array = [$http_post['title'], $http_post['content'], $http_post['is-post2'], $id];
		$this->db->execute_advanced($query, $values_array);
	}

	public function delete_post($id) {
		$query = "DELETE FROM $this->posts_table WHERE `id` = ?";
		$values_array = [$id];
		$this->Timeline_DAO->delete_entry($id, 2);
		$this->db->execute_advanced($query, $values_array);
	}
}

?>