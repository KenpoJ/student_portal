<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
	header("location: profile.php");
}
?>
<!doctype html>
<html>
<head>
	<title>Login Form in PHP with Session</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>


<body>
<div id="main">
	<h1>PHP Login Session Example</h1>
	<div id="login">
		<h2>Login Form</h2>
		<form action="" method="post">
			<label>Username:</label>
			<input id="name" name="username" placeholder="Enter username" type="text">
			<label>Password:</label>
			<input id="password" type="password" name="password" placeholder="Enter password">
			<input name="submit" type="submit" value="Login">
			<span><?php echo $error; ?></span>
		</form>
	</div>
</div>
</body>
</html>