<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

// Create Post
if (isset($data->title) && isset($data->body) && isset($data->author) && isset($data->category_id)) {
	$post->title = $data->title;
	$post->body = $data->body;
	$post->author = $data->author;
	$post->category_id = $data->category_id;

	if ($post->create()) {
		echo json_encode([
			'message' => 'Post Created'
		]);
	}
} else {
	echo json_encode([
		'message' => 'Post Not Created'
	]);
}
