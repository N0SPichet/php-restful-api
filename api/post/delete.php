<?php

	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

	// Includes
	include_once '../../config/Database.php';
	include_once '../../models/Post.php';

	// DB Connect
	$database = new Database();
	$db = $database->connect();

	// Post Object
	$post = new Post($db);

	// Get Raw Posted Data
	$data = json_decode(file_get_contents('php://input'));

	// Set ID to Delete
	$post->id = $data->id;

	// Delete Post
	if (!is_null($data)) {
		if ($post->delete()) {
			echo json_encode([
				'message' => 'Post Deleted'
			]);
		}
	}
	else {
		echo json_encode([
			'message' => 'Post Not Deleted'
		]);
	}