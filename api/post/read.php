<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Includes
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// DB Connect
$database = new Database();
$db = $database->connect();

// Post Object
$post = new Post($db);

// Post Query
$result = $post->read();

// Get Row Count
$num = $result->rowCount();
if ($num > 0) {
	$posts = array();
	$posts['data'] = array();

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$post = array(
			'id' => $id,
			'title' => $title,
			'body' => html_entity_decode($body),
			'author' => $author,
			'category_id' => $category_id,
			'category_name' => $category_name
		);

		array_push($posts['data'], $post);
	}
	// Turn to JSON
	echo json_encode($posts);
} else {
	// No Posts
	echo json_encode([
		'message' => 'No Posts Found'
	]);
}
