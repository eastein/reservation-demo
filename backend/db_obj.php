<?php
require_once('mysqlidb.php');

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