<?php
include_once('db_connection.php');
include_once('functions.php');
global $connection;

$str = $_POST['query'];
$str = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$str = mysqli_real_escape_string($connection, $str);

$query = 'SELECT * FROM `users` ';
$query .= "INNER JOIN `ranks` ";
$query .= "ON users.ranks_id = ranks.id ";
$query .= "INNER JOIN `programs` ";
$query .= "ON users.programs_id = programs.id ";
$query .= 'WHERE first_name LIKE ';
$query .= '"%'. $str . '%"';
$query .= ' OR last_name LIKE ';
$query .= '"%'. $str . '%"';
$query .= "ORDER BY users.id ";

$result_set = mysqli_query($connection, $query);
//$result = mysqli_fetch_assoc($result_set);
if (mysqli_num_rows($result_set) != 0) {
	// displaying records.
	echo output_users($result_set);
} else {
	echo "No records are found.";
}
?>