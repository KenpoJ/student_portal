<?php
session_start(); // Starting Session
include_once('/inc/db_connection.php');

$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		global $connection;
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$username = stripslashes($username);
		$password = hash("sha256", stripslashes($password));
		//$username = mysqli_real_escape_string($username);
		//$password = mysqli_real_escape_string($password);
		
		$query = "SELECT * from `users` where password = '$password' AND username = '$username'";
		$user_info = mysqli_query($connection, $query);

		$data = mysqli_fetch_assoc($user_info);
		//var_dump($data);

		$rows = mysqli_num_rows($user_info);
		if ($rows == 1) {
			//$_SESSION['login_user'] = $username; // Initializing Session
			$_SESSION['user_query'] = $data; // Initializing Session

			if($data['role'] == 'admin' || $data['role'] == 'superadmin') {
				header('location: profile.php');
				$admin = true;
			} else {
				header("location: profile.php"); // Redirecting To Other Page
				$admin = false;
			}
		} else {
			$error = "Username or Password is invalid";
		}
		mysqli_close($connection); // Closing Connection
	}
}

?>