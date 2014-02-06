<?php

require_once('db_obj.php');

$adminpw = "hunter2";

function handle_index() {
	echo file_get_contents('dashboard.html');
}

function handle_admin() {
	echo file_get_contents('admin.html');
}

//stolen from stackoverflow http://stackoverflow.com/questions/4356289/php-random-string-generator

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function handle_api() {
	$csrfcookie = $_COOKIE["csrftoken"];
	
	$data = false;
	$error = null;


	# dispatch here

	$data = 'hi';

	header ("Content-Type", "application/json");


	$csrftoken = $_COOKIE['csrftoken'];
	if (!$csrftoken) {
		$csrftoken = generateRandomString();
	}

	switch ($_SERVER['REQUEST_URI']) {

		case '/' :
			header ("Content-Type", "text/html");
			setcookie ("csrftoken", $csrftoken);
			return handle_index();
			break;
		case '/admin' :
			header ("Content-Type", "text/html");
			setcookie ("csrftoken", $csrftoken);
			return handle_admin();
			break;
		case '/api/login' :
			$data = $_POST['password'] == $adminpw;
			if (!$data) {
				$error="Wrong password.";
			} else {
				setcookie ("password", $_POST["password"]);
			}
			break;
		case '/api/booking/list' :
			$data = array(array("hello" => "world"));
			break;
		default:
			echo "Unknown URI";
	}

	$response = array(
		"data" => $data
	);

	if ($error) {
		$response["error"] = $error;
	}

	setcookie ("csrftoken", $csrftoken);

	echo json_encode($response);
}

handle_api();

$db = new Mysqlidb('localhost', 'booking', 'booking', 'booking');

//insert

/*$insertData = array(
	'start' => time(),
	'end' => time(),
	'name' => "John Doe"
);

if($db->insert('booking', $insertData)) echo 'success!';*/

//select

/*$results = $db->get('booking', 100);
print_r($results);*/

//select from time range

/*
$db->where('start', time());
$db->where('end', time());
$results = $db->get('booking');
print_r($results);*/

//update
/*$updateData = array(
	'start' => time(),
	'end' => time(),
	'name' => "John Doe"
);
$db->where('id', 1);
$results = $db->update('booking', $updateData);*/

//delete
/*$db->where('id', 1);
if($db->delete('booking')) echo 'successfully deleted'; */

