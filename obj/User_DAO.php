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

	public function add_user($User) {
		$query = "INSERT INTO $this->users_table (
			`username`, `password`, `email`, `full_name`, `group_id`, `sex`, `notes`)
			VALUES ( 
			'".$User->username."', 
			'".password_hash($User->password, PASSWORD_DEFAULT)."', 
			'".$User->email."', 
			'".$User->full_name."', 
			".$User->group_id.", 
			'".$User->sex."', 
			'".$User->notes."' )";
			$this->db->execute_query($query);
		}

	public function login($User) {
		$all_users = $this->list_users();
		foreach ($all_users as $user) {
			if ($User->username == $user['username'] && password_verify($User->password, $user['password'])) {
				if ($user['group_id'] == 1) {
					setcookie('username', 'admin', time() + (86400 * 30), "/");
				} else {
					setcookie('username', 'user', time() + (86400 * 30), "/");
				}
				header("Location: index.php");
			}
		}		
	}

	public function check_if_admin() {
		if (isset($_COOKIE['username']) && $_COOKIE['username'] == "admin") {
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