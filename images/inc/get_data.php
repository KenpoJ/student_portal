<?php
include_once('db_connection.php');

global $connection;

$query = "SELECT users.*, NULL AS password, ranks.rank, programs.program FROM `users` ";
$query .= "LEFT JOIN `ranks` ";
$query .= "ON users.ranks_id = ranks.id ";
$query .= "LEFT JOIN `programs` ";
$query .= "ON users.programs_id = programs.id ";
$query .= "ORDER BY users.last_name";
//echo $query;

$results = mysqli_query($connection, $query);

$results_array = array();

while($obj = mysqli_fetch_assoc($results)) {
	array_push($results_array, $obj);
}

header('Content-Type: application/json');
echo json_encode($results_array);
//$json = json_encode($results_array);

//return $json;
//var_dump($json);
//echo $json;
?>