<?php

class User_DAO {
	private $db;
	private $users_table;
	private $groups_table;

	public function __construct() {
		$this->db = new db();
		$this->users_table = "`Users`";
		$this->groups_table = "`Groups`";
	}

	public function list_users() {
		$query = "SELECT * FROM $this->users_table";

		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result;
		}
	}

	public function get_user_by_id($id) {
		$query = "SELECT * FROM $this->users_table WHERE `id` = $id";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0];
		}
	}

	public function get_user_by_name($username) {
		$query = "SELECT * FROM $this->users_table WHERE `username` = '$username'";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result[0];
		}
	}

	public function add_user($User) {
		if (!empty($this->get_user_by_name($User->username))) {
			die("User already exists");
		}
		$query = "INSERT INTO $this->users_table (
			`username`, `password`, `email`, `full_name`, `group_id`, `sex`, `notes`)
			VALUES (?, ?, ?, ?, ?, ?, ?)";
		$values = [$User->username, password_hash($User->password, PASSWORD_DEFAULT), $User->email, 
			$User->full_name, $User->group_id, $User->sex, $User->notes];
		echo "Hours";
		$this->db->execute_advanced($query, $values);
	}

	public function delete_user($User) {
		$id = $this->get_user_by_name($User->username)['id'];
		$query = "DELETE FROM $this->users_table WHERE `id` = ".$id;
		$this->db->execute_query($query);
	}

	public function update_user($User) {
		$id = $this->get_user_by_name($User->username)['id'];
		$query = "UPDATE $this->users_table SET
			 `username` = ?,
			 `email` = ?,
			 `full_name` = ?,
			 `group_id` = ?, 
			 `sex` = ?,
			 `notes` = ?";
		$values = [$User->username, $User->email, $User->full_name, 
			$User->group_id, $User->sex, $User->notes];
		if ($User->password != "") {
			$query .= ", `password` = ?";
			array_push($values, password_hash($User->password, PASSWORD_DEFAULT));
		}
		$query .= " WHERE `id` = ?";
		array_push($values, $id);
		$this->db->execute_advanced($query, $values);
	}

	public function login($User) {
		$all_users = $this->list_users();
		$counter = 0;
		foreach ($all_users as $user) {
			if ($User->username == $user['username'] && password_verify($User->password, $user['password'])) {
				if ($user['group_id'] == 1) {
					setcookie('username', 'admin', time() + (86400 * 30), "/");
				} else {
					setcookie('username', 'user', time() + (86400 * 30), "/");
				}
				return TRUE;
			}
		}
		return FALSE;	
	}

	public static function check_if_admin() {
		if (isset($_COOKIE['username']) && $_COOKIE['username'] == "admin") {
			return true;
		} else {
			return false;
		}
	}

	public static function check_if_logged() {
		if (isset($_COOKIE['username'])) {
			return true;
		} else {
			return false;
		}
	}

	public function list_groups() {
		$query = "SELECT * FROM $this->groups_table";
		$result = $this->db->get_data($query);
		if (isset($result[0])) {
			return $result;
		}
	}
}