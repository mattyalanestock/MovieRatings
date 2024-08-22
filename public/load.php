<?php

require_once '../core.php';
require_once '../database.php';

$output = [];
try {
	$db = new DatabaseConnection($config['database']);
	$output['data'] = $db->select('movies');
}
catch (Exception $e) {
	$output['error'] = $e->getMessage();
}
echo json_encode($output,true);
