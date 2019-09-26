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

	// Category Query
	$result = $post->read();

	// Get Row Count
	$num = $result->rowCount();
	if ($num > 0) {
		$posts = array();
		$posts['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$post = array(
				'id' => $id,
				'name' => $name
			);

			array_push($posts['data'], $post);
		}
		// Turn to JSON
		echo json_encode($posts);
	}
	else {
		// No Categorys
		echo json_encode([
			'message' => 'No Categorys Found'
		]);
	}