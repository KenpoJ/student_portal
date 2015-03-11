<?php
	//include_once('inc/configuration.php');
	require_once('db_connect.php');
	include_once('../inc/session.php');
	include_once('functions.php');
	if(isset($_POST['login'])) {
		authenticateUser($_POST['username'], $_POST['password']);
	}	
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

<?php include_once('../inc/header.php'); ?>

<div class="container">

	<div class="row row-margin">
		<div class="col-md-4 clearfix user-info">
			<h2>Student Info</h2>
			<div class="well well-small">
				<?php
					$id = $_GET['user'];
					get_single_user($id);
				?>
			</div>
		</div>
		<div class="col-md-4">
			<h2>Announcements</h2>
			<?php echo get_announcements(); ?>
		</div>
		<div class="col-md-4">
			<h2>Calendar</h2>
			<div class="calendar"></div>
		</div>
	</div>

</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.supercal.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.calendar').supercal({
		transition: 'carousel-vertical'
	});
});
</script>

</body>
</html>