<?php
require_once('mysqlidb.php');

$db = new Mysqlidb('localhost', 'booking', 'booking', 'booking');

function write($start, $end, $name, $id=null) {
	$data = array(
		'start' => $start,
		'end' => $end,
		'name' => $name
	);

	if($id) {
		$this->db->where('id', $id);
		$this->db->update('bookings', $data);
	} elseif($this->db->insert('bookings', $data)) return true;

	return false;
}

function select($start=null, $end=null) {
	global $db;
	if($start && $end) {
		$db->where('start', $start);
		$db->where('end', $end);
	}
	$results = $db->get('bookings');
	return $results;
}

function delete($id) {
	$this->db->where('id', 1);
	if($this->db->delete('bookings')) return true;
	return false;
}
