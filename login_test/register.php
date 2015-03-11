<?php
	include_once('../inc/db_connection.php');
	include_once('functions.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Portal - Register</title>

<link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/reset.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css" />

</head>

<body>

<div class="container">

	<div class="row">
		<?php
			registerUser($_POST['r-username'], $_POST['r-password']);
		?>
	</div>

</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</body>
</html>