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

	// Get ID
	$post->id = isset($_GET['id']) ? $_GET['id']:die();

	// Get Post
	$post->read_single();

	// Create Array
	$post = array(
		'id' => $post->id,
		'title' => $post->title,
		'body' => $post->body,
		'author' => $post->author,
		'category_id' => $post->category_id,
		'category_name' => $post->category_name
	);

	// Turn to JSON
	echo json_encode($post);