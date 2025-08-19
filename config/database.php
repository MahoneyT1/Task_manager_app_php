<?php

// This file contains database connection class


class Database {
	private $host = 'localhost';
	private $db_name = "mydatabase";
	private $username = "root";
	private $password = "";
	private $conn;

	// connector method that connects the database
	// with the dpo object
	public function create() {
		$this->conn = null;

		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

		try {

			// try to create the connection object with Pdo
			// if error respond with dpo connector error handler

			$this->conn = new PDO(
				$dsn,
				$this->username,
				$this->password
			);

			$this->conn->setAttribute(
				PDO::ATTR_ERRMODE, 
				PDO::ERRMODE_EXCEPTION
			);
		} catch (PDOException $e) {
			echo "Connection Error". $e->getMessage();
		};

		return $this->conn;
	}
}
