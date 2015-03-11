<?php
include('inc/login.php'); // Includes Login Script

$title = 'Login - Diamond School of Self Defense - Student Portal';

if(isset($_SESSION['login_user'])){
	header("location: profile.php");
}
?>

<?php include_once('inc/head.html') ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="content">
<div class="container">
	<div class="row">
		<div id="general-form" class="col-md-4 col-md-offset-4 well well-small">
			<h2>Login</h2>
			<form action="" method="post">
				<div class="form-group">
					<label>Username:</label>
					<input id="name" class="form-control" name="username" placeholder="Enter username" type="text">
				</div>
				<div class="form-group">
					<label>Password:</label>
					<input id="password" class="form-control" type="password" name="password" placeholder="Enter password">
				</div>
				<div class="form-group">
					<input name="submit" type="submit" value="Login">
					<span class="text-danger"><?php echo $error; ?></span>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<?php include_once('inc/footer.php'); ?>
</body>
</html>