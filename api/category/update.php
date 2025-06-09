<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// DB Connect
$database = new Database();
$db = $database->connect();

// Category Object
$post = new Category($db);

// Get Raw Categoryed Data
$data = json_decode(file_get_contents('php://input'));

// Set ID to Update
$post->id = $data->id;

$post->name = $data->name;

// Update Category
if (is_null($data)) {
	if ($post->update()) {
		echo json_encode([
			'message' => 'Category Updated'
		]);
	}
} else {
	echo json_encode([
		'message' => 'Category Not Updated'
	]);
}
