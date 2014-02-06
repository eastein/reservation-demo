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
	global $adminpw;
	$csrfcookie = null;
	if (isset($_COOKIE["csrftoken"]))
		$csrfcookie = $_COOKIE["csrftoken"];
	
	$data = false;
	$error = null;


	# dispatch here

	$data = 'hi';


	$csrftoken = $_COOKIE['csrftoken'];
	if (!$csrftoken) {
		$csrftoken = generateRandomString();
	}

	if (isset($_POST['password'])) {
		$loggedin = $_POST['password'] == $adminpw;
	} elseif (isset($_COOKIE['password']) && $_COOKIE['password'] == $adminpw) {
		$loggedin = true;
	} else {
		$loggedin = false;
	}


	$summary = false;
	switch ($_SERVER['REQUEST_URI']) {

		case '/' :
			header ("Content-Type: text/html");
			setcookie ("csrftoken", $csrftoken);
			return handle_index();
			break;
		case '/admin' :
			header ("Content-Type: text/html");
			setcookie ("csrftoken", $csrftoken);
			return handle_admin();
			break;
		case '/api/login' :
			$data = $loggedin;
			if (!$data) {
				$error="Wrong password.";
			} else {
				setcookie ("password", $_POST["password"]);
			}
			break;
		case '/api/booking/list/summary' :
			$summary = true;
			$data = 'what';
		case '/api/booking/list' :

			if (!$summary && !$loggedin) {
				$error = "You must be logged in to do that.";
				break;
			}
			$data = select(intval($_POST['start_ts']), intval($_POST['end_ts']));
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

	header ("Content-Type: application/json");

	setcookie ("csrftoken", $csrftoken);

	echo json_encode($response);
}

handle_api();
