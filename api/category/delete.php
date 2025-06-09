<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Set ID to Delete
$post->id = $data->id;

// Delete Category
if (!is_null($data)) {
	if ($post->delete()) {
		echo json_encode([
			'message' => 'Category Deleted'
		]);
	}
} else {
	echo json_encode([
		'message' => 'Category Not Deleted'
	]);
}
