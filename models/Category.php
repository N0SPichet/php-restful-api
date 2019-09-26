<?php

/**
 * 
 */
class Category
{
	// DB Params
	private $conn;
	private $table = 'categories';

	// Category Params
	public $id;
	public $name;
	public $created_at;
	

	// Construct with DB
	function __construct($db)
	{
		$this->conn = $db;
	}

	// Get Categories
	public function read() {
		// Query
		$query = 'SELECT * FROM '.$this->table.' ORDER BY created_at DESC';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execute query
		$stmt->execute();

		return $stmt;

	}

	// Get Single Category
	public function read_single() {
		// Query
		$query = 'SELECT * FROM	'.$this->table.' WHERE id = ? LIMIT 0, 1';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Bind ID Param
		$stmt->bindParam(1, $this->id);

		// Execute query
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Set Properties
		$this->name = $row['name'];

		return $stmt;
	}

	// Create Category
	public function create() {
		// Query
		$query = 'INSERT INTO '.$this->table.' SET name = :name';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// CLean Data
		$this->name = htmlspecialchars(strip_tags($this->name));

		// Bind Data
		$stmt->bindParam(':name', $this->name);

		if ($stmt->execute()) {
			return true;
		}

		printf('Error: %s.\n', $stmt->error);
		return false;
	}

	// Update Category
	public function update() {
		// Query
		$query = 'UPDATE '.$this->table.'
		SET
			name = :name
		WHERE
			id = :id';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// CLean Data
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind Data
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}
		
		printf('Error: %s.\n', $stmt->error);
		return false;
	}

	// Delete Category
	public function delete() {
		// Query
		$query = 'DELETE FROM '.$this->table.' WHERE id = :id';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// CLean Data
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind Data
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		printf('Error: %s.\n', $stmt->error);
		return false;
	}
}