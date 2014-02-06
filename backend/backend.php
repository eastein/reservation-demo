<?php

require_once('db_obj.php');

$adminpw = "hunter2";

echo "hello world";


function handle_api() {
	$csrfcookie = $_COOKIE["csrftoken"];
	
	$data = false;
	$error = null;


	# dispatch here

	$data = 'hi';


	$response = array(
		"data" => $data
	);

	if ($error) {
		$response["error"] = $error;
	}

	return json_encode($response);
}