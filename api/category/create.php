<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$post->name = $data->name;

// Create Category
if (isset($data)) {
	if ($post->create()) {
		echo json_encode([
			'message' => 'Category Created'
		]);
	}
} else {
	echo json_encode([
		'message' => 'Category Not Created'
	]);
}
