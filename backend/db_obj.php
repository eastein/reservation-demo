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
		$this->db->update('booking', $data);
	} elseif($this->db->insert('booking', $data)) return true;

	return false;
}

function select($limit=0, $start=null, $end=null) {
	if($start && $end) {
		$this->db->where('start', $start);
		$this->db->where('end', $end);
	}
	$results = $this->db->get('booking', $limit);
	return $results;
}

function delete($id) {
	$this->db->where('id', 1);
	if($this->db->delete('booking')) return true;
	return false;
}