<?php

class db {
	private $connection;
	private $host = "localhost";
	private $db = "pestart_caricatures";
	private $usr = "pestart_caricatures";
	private $pwd = "c4ricatur3s";
	private $opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	public function __construct() {
		try {
			$this->connection = new PDO("mysql:host=$this->host;
					dbname=$this->db",$this->usr,$this->pwd, $this->opt);
		}
		catch (PDOException $e){
			die("Could not connect: $e->getMessage()");
		}
	}

	public function get_data($sql) {
		$data = array();
		$result = $this->connection->prepare($sql);
		$result->execute();
		$data = $result->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function execute_query($sql) {
		$this->connection->exec($sql);
		// if ($this->connection->error) {
		// 	die("Error in execution: ".$this->connection->error);
		// }
		return $this->connection->lastInsertId();
	}

	public function execute_test($query) {
		$this->connection->prepare($query);
		$this->connection->exec($query);
	}
}