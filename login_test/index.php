<?php
	include_once('../inc/db_connection.php');
	include_once('functions.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Portal - Diamond School of Self Defense</title>

<link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/reset.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css" />

</head>

<body>

<div class="container">

	<div class="row">
		<h2>Login</h2>
		<div id="login-form" class="col-md-4 well">
			<form name="login" method="post" action="dashboard.php">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" placeholder="Enter username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" placeholder="Enter password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Login">
					<input type="hidden" name="login" value="true">
				</div>
				<div class="error"><?php //echo $error; ?></div>
			</form>
		</div>
		<h2>Register</h2>
		<div id="register-form" class="col-md-4 well">
			<form name="register" method="post" action="register.php">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="r-username" placeholder="Select a username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="r-password" placeholder="Enter a password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Register">
					<input type="hidden" name="register" value="true">
				</div>
				<div class="error"><?php //echo $error; ?></div>
			</form>
		</div>
	</div>

</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</body>
</html>