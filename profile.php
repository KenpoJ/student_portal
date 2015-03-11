<?php
include_once('inc/functions.php');
include_once('inc/session.php');

$title = 'My Profile - DSSD Student Portal';

$bday = date_create($user_check['birth_date']); //$user_check from session.php
$start = date_create($user_check['start_date']);
$ranks_id = $user_check['ranks_id'];
$programs_id = $user_check['programs_id'];
$user_id = $user_check['id'];
//var_dump($user_check);

$rank_name = get_rank($ranks_id);
$next_rank_name = get_next_rank($ranks_id);
$program_name = get_program($programs_id);

$technique_list = get_techniques($ranks_id);
$working_technique_list = get_techniques($ranks_id + 1);

$class = get_class_times($ranks_id);
$start_time = new DateTime($class['start_time']);
$end_time = new DateTime($class['end_time']);
$start = $start_time->format('g:ia');
$end = $end_time->format('g:ia');
?>

<?php include_once('inc/head.html'); ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="content">
<div class="container">

	<div class="row row-margin">
		<div class="col-md-4 clearfix user-info">
			<h2>My Info</h2>
			<div class="well well-small">
				<?php
					get_single_user($ranks_id, $programs_id, $user_id);
				?>
			</div>
		</div>
		<div class="col-md-8">
			<h2>My Rank Info</h2>
			<div class="well well-small user-info">
				<div class="row">
					<div class="col-md-4">
						<h3><?php echo $rank_name; ?> Belt</h3>
						<h4><?php echo $program_name; ?> Program</h4>
						<!--a href="rank_advancement.php" class="btn btn-sm btn-danger"><strong>All <?php echo $next_rank_name; ?> Belt</strong> Requirements</a-->
						<a href="rank_advancement.php" class="btn btn-sm btn-danger"><strong>See Belt Requirements</strong></a>
						<!--h3><?php echo $next_rank_name; ?> Belt Sets</h3-->
						<?php //echo get_sets($ranks_id); ?>
					</div>
					<div class="col-md-8">
						<h3><?php echo $next_rank_name; ?>  Belt Technique List</h3>
						<div class="row">
							<div class="col-md-6">
								<ol class="tech-list">
								<?php
									$split_list = array();
									while($row = mysqli_fetch_array($working_technique_list)) {
										$split_list[] = $row;
									}
									$chunked_array = array_chunk($split_list, 2);
									$first_half_length = count($split_list) / 2;
									foreach($chunked_array as $value) {
										echo '<li>' . $value[0][1] . '</li>';
									}
								?>
								</ol>
							</div>
							<div class="col-md-6">
								<ol class="tech-list" start="<?php echo $first_half_length + 1; ?>">
									<?php
										foreach($chunked_array as $value) {
											echo '<li>' . $value[1][1] . '</li>';
										}
									?>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-margin">
		<div class="col-md-4 clearfix user-info">
			<a type="button" class="close" href="announcements.php"><span class="glyphicon glyphicon-eye-open"></span> View All</a>
			<h2>Announcements</h2>
			<?php echo get_announcements(); ?>
		</div>
		<div class="col-md-4">
			<h2>My Class Times</h2>
			<h3><?php echo $class['name']; ?></h3>
			<ul class="list-unstyled">
				<li>
					<strong><?php echo substr($class['day1'], 0, 3); ?>:</strong> <?php echo $start . ' - ' . $end ?>
				</li>
				<li>
					<strong><?php echo substr($class['day2'], 0, 3) ?>:</strong> <?php echo $start . ' - ' . $end ?>
				</li>
			</ul>
		</div>
		<div class="col-md-4">
			<h2>Calendar</h2>
			<div class="calendar"></div>
		</div>
	</div>

</div>
</div>

<?php include_once('inc/footer.php'); ?>

</body>
</html>