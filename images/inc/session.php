<?php
session_start();// Starting Session

include_once('inc/db_connection.php');
global $connection;

// Storing Session
$user_check = $_SESSION['user_query']; //$_SESSION['user_query'] from login.php
//var_dump($user_check);

$user_id = $user_check['id'];
$user_rank = $user_check['ranks_id'];
$user_prog = $user_check['programs_id'];

$query2 = "SELECT * FROM `users` ";
$query2 .= "INNER JOIN `ranks` ";
$query2 .= "ON $user_rank = ranks.id ";
$query2 .= "INNER JOIN `programs` ";
$query2 .= "ON $user_prog = programs.id ";
$query2 .= "WHERE users.id = $user_id";

$user_info = mysqli_query($connection, $query2);
$user_data = mysqli_fetch_assoc($user_info);

$username = $user_data['username'];

if(!isset($username)){
	mysql_close($connection); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}

?>