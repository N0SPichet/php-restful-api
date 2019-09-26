<?php

	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	// Includes
	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	// DB Connect
	$database = new Database();
	$db = $database->connect();

	// Category Object
	$post = new Category($db);

	// Get ID
	$post->id = isset($_GET['id']) ? $_GET['id']:die();

	// Get Category
	$post->read_single();

	// Create Array
	$post = array(
		'id' => $post->id,
		'name' => $post->name
	);

	// Turn to JSON
	echo json_encode($post);