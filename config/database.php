<?php

// This file contains database connection class


class DBStorage {
	private $host = 'localhost';
	private $db_name = "task_manager_db";
	private $username = "task_manager";
	private $password = "Drew2325$$";
	private $conn;

	// connector method that connects the database
	// with the dpo object

	public function __construct()
	{
		// Create the connection as soon as the obj is created
		self::create();
	}
	
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

	public function post($name, $completed=false ) {

		// check if the params are provided
		if (!$name ) {
			throw new InvalidArgumentException("Name parameter is required");
		}

		$stmt = $this->conn->prepare("INSERT INTO tasks ( name, completed ) 
				VALUES ( :name, :completed ) ");
		
		try {
			$stmt->execute(
				[
					":name" => $name,
					"completed" => $completed
				]
			);
		} catch (PDOException $e) {
			throw new Exception(" Database write failed: " . $e->getMessage());
		};
	}

	public function getTaskWithId($id) {

		$stmt = $this->conn->prepare("SELECT * FROM tasks WHERE id = (:id)");
		
		try {

			$stmt->execute(
				[
					":id" => $id
				]
				);
		} catch (PDOException $e) {
			throw new Exception(
				"failed to get data from the database" . $e->getMessage());
		}
	}

	
}
