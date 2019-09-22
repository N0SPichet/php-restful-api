<?php

/**
 * 
 */
class Post
{
	// DB params
	private $conn;
	private $table = 'posts';

	// Post params
	public $id;
	public $category_id;
	public $category_name;
	public $title;
	public $body;
	public $author;
	public $created_at;
	

	// Construct with DB
	function __construct($db)
	{
		$this->conn = $db;
	}

	// Get Posts
	public function read() {
		// Query
		$query = 'SELECT
			category.name as category_name,
			post.id,
			post.category_id,
			post.title,
			post.body,
			post.author,
			post.created_at
			FROM
			'.$this->table.' post
			LEFT JOIN
				categories category ON post.category_id = category.id
			ORDER BY
				post.created_at DESC';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execute query
		$stmt->execute();

		return $stmt;

	}

	// Get Single Post
	public function read_single() {
		// Query
		$query = 'SELECT
			category.name as category_name,
			post.id,
			post.category_id,
			post.title,
			post.body,
			post.author,
			post.created_at
			FROM
			'.$this->table.' post
			LEFT JOIN
				categories category ON post.category_id = category.id
			WHERE
				post.id = ?
			LIMIT 0, 1';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Bind ID Param
		$stmt->bindParam(1, $this->id);

		// Execute query
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Set Properties
		$this->title = $row['title'];
		$this->body = $row['body'];
		$this->author = $row['author'];
		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];

		return $stmt;
	}

	// Create Post
	public function create() {
		// Query
		$query = 'INSERT INTO '.$this->table.' SET title = :title, body = :body, author = :author, category_id = :category_id';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// CLean Data
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));

		// Bind Data
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':body', $this->body);
		$stmt->bindParam(':author', $this->author);
		$stmt->bindParam(':category_id', $this->category_id);

		if ($stmt->execute()) {
			return true;
		}

		printf('Error: %s.\n', $stmt->error);
		return false;
	}

	// Update Post
	public function update() {
		// Query
		$query = 'UPDATE '.$this->table.'
		SET
			title = :title, body = :body, author = :author, category_id = :category_id
		WHERE
			id = :id';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// CLean Data
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind Data
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':body', $this->body);
		$stmt->bindParam(':author', $this->author);
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}
		
		printf('Error: %s.\n', $stmt->error);
		return false;
	}

	// Delete Post
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