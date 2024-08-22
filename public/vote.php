<?php

require_once '../core.php';
require_once '../database.php';

$output = [];
try {
	$db = new DatabaseConnection($config['database']);
	
	if (empty($_POST) ||
		empty($_POST['id']) ||
		!isset($_POST['vote'])) {
		throw new Exception('Missing data.');
	}
	
	$ip_address = get_client_ip();
	
	// Insert the vote.
	$db->insert('votes', [
		'movie_id' => $_POST['id'],
		'vote' => $_POST['vote'],
		'ip_address' => $ip_address
	]);
	
	// Denormalize the movie row vote values.
	$db->query('UPDATE movies SET
		upvotes = (SELECT COUNT(*) FROM votes WHERE movie_id=? AND vote = 1),
		downvotes = (SELECT COUNT(*) FROM votes WHERE movie_id=? AND vote = 0)
		WHERE id=?',
	array_fill(0,3,$_POST['id']));
	
	// Return the updated movie info.
	$output['data'] = $db->select('movies', '*', 'id=?', [$_POST['id']]);
}
catch (Exception $e) {
	$output['error'] = $e->getMessage();
}
echo json_encode($output,true);
