<?php
session_start();// Starting Session

include_once('db_connect.php');
global $connection;

// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$query = "SELECT username from `users` WHERE username = '$user_check'";
$user_info = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($user_info);
$login_session = $row['username'];

if(!isset($login_session)){
	mysql_close($connection); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}

?>