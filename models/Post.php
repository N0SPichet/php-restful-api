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
}