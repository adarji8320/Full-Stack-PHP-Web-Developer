<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/album.php';
include_once '../objects/user.php';
 
// instantiate database and album object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$album = new Album($db);
$user = new User($db);

// set USER ID
$user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

// query user
$user_stmt = $user->read($user->user_id);
$num = $user_stmt->rowCount();

// check if more than 0 record found
if( $num > 0 ) {

	// query albums
	$album_stmt = $album->read($user->user_id);
	$num = $album_stmt->rowCount();
	 
	// check if more than 0 record found
	if( $num > 0 ) {
	 
		// user array
		$user_data = array();

		// album array
		$album_arr = array();
		$album_arr["album"] = array();
	 
		// retrieve table contents
		while ( $row = $album_stmt->fetch(PDO::FETCH_ASSOC) ) {
			// extract row
			extract($row);
	 
			$featured = false;
			
			if( $album_featured == 1 ) $featured = true;
			
	 
			$album_item = array (
				"id" => $album_id,
				"title" => $album_title,
				"description" => html_entity_decode($album_description),
				"img" => $album_img,
				"date" => date("Y-m-d", strtotime($album_date) ),
				"featured" => $featured
			);
	 
			array_push( $album_arr["album"], $album_item );
		}
		
		// retrieve table contents
		while ($row = $user_stmt->fetch(PDO::FETCH_ASSOC)){
			
			// extract row
			extract($row);
	 
			$user_data = array(
				//"id" => $user_id,
				"name" => $user_name,
				"phone" => $user_phone,
				"email" => $user_email,
				"bio" => html_entity_decode($user_bio),
				"profile_picture" => $user_profile_picture,
				"album" => $album_arr["album"]
			);

		}
	 
		// set response code - 200 OK
		http_response_code(200);
	 
		// show album data in json format
		echo json_encode($user_data);
		
	}else{
	 
		// set response code - 404 Not found
		//http_response_code(404);
	 
		// tell the user no albums found
		echo json_encode(
			array(
				"error_name" => "album",
				"message" => "No album found.",
			)
		);
	}

}else{
	 
	// set response code - 404 Not found
	//http_response_code(404);
 
	// tell the user no user found
	echo json_encode(
		array(
			"error_name" => "user",
			"message" => "No user found.",
		)
	);
}

?>
