<?php
include_once('inc/functions.php');
include_once('inc/session.php');
require_once('inc/Paginator.class.php');
global $connection;

if($user_check['role'] == 'admin' || $user_check['role'] == 'superadmin') {
	// do nothing
} else {
	global $msg;
	$msg = 'You do not have permission to view that page.';
	header('location: profile.php');
}

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
            <a type="button" class="close" href="announcements.php"><span class="glyphicon glyphicon-eye-open"></span> View All</a>

			<h2>Announcements</h2>
			<?php get_announcements(2); ?>

			<h2>Calendar</h2>
			<div class="calendar"></div>
		</div>
		<div class="col-md-8">
			<h2>Student List</h2>
				<form name="search" id="search" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="student-search" class="form-control" placeholder="Search by Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Filter by Program</h3>
                            <div class="form-group radio">
                                <label class="radio-inline">
                                    <input type="radio" name="program" id="adult" value="adult"> Adult
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="program" id="youth" value="youth"> Youth
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="program" id="junior" value="junior"> Junior
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="program" id="all" value="all" checked> All
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Filter by Rank</h3>
                            <div class="form-group checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="white"> White
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="yellow"> Yellow
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="orange"> Orange
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="purple"> Purple
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="blue"> Blue
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="green"> Green
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="1stbrown"> 1st Brown
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="2ndbrown"> 2nd Brown
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="black"> Black
                                </label>
                            </div>
                        </div>
                    </div>
				</form>

			<!--div id="student-list">Search to display students.</div-->
			<?php
				echo get_all_users();
			?>
		</div>
	</div>

</div>
</div>

<?php include_once('inc/footer.php'); ?>

</body>
</html>