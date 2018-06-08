<?php
class User {
	private $username;
	private $password;
	private $email;
	private $full_name;
	private $group_id;
	private $sex;
	private $notes;

	public function __construct($usr, $pwd, $email="",  $fullname="", $grp="", $sex="", $notes="") {
		$this->username = $usr;
		$this->password = $pwd;
		$this->email = $email;
		$this->full_name = $fullname;
		$this->group_id = $grp;
		$this->sex = $sex;
		$this->notes = $notes;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

}

?>