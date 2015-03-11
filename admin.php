<?php
include_once('inc/functions.php');
include_once('inc/session.php');
require_once('inc/Paginator.class.php');
global $connection;

$title = 'My Administration Page - DSSD Student Portal';

$bday = date_create($user_data['birth_date']);
$start = date_create($user_data['start_date']);

$ranks_id = $user_data['ranks_id'];
$programs_id = $user_data['programs_id'];
//var_dump($_SESSION);
?>

<?php include_once('inc/head.html'); ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="content">
<div class="container">

	<div class="row row-margin">
		<div class="col-md-4 clearfix user-info">
			<h2>Administrator Info</h2>
			<div class="well well-small">
				<?php
					get_single_user($ranks_id, $programs_id, $user_id);
				?>
			</div>
			<h2>Announcements</h2>
			<?php echo get_announcements(); ?>
			<h2>Calendar</h2>
			<div class="calendar"></div>
		</div>
		<div class="col-md-8">
			<h2>
				Student List
				<form name="search" id="search" class= 
				"navbar-form navbar-right" action="">
					<div class="form-group">
						<input type="text" id="student-search" class="form-control" placeholder="Search Students">
						<!--button type="submit" id="student-search" class="btn btn-default">Submit</button-->
					</div>
				</form>
			</h2>
			<div id="student-list">Search to display students.</div>
			<?php
				//echo get_all_users();
			?>
		</div>
	</div>

</div>
</div>

<?php include_once('inc/footer.php'); ?>

</body>
</html>