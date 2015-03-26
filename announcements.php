<?php
include_once('inc/functions.php');
include_once('inc/session.php');
require_once('inc/Paginator.class.php');
global $entry;

$title = 'Announcements - DSSD Student Portal';
?>

<?php include_once('inc/head.html'); ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="content">
<div class="container">

	<div class="row row-margin">
		<div class="col-md-8">
			<?php
			$entry = get_announcements(100000);
			$date = date_create($entry['publish_date']);
			$date = $date->format('M d, Y');
			var_dump($entry);
			?>
			<ul id="announcements" class="list-unstyled">
				<?php while($entry) { ?>
				<li>
					<h2><?php echo $entry['title'] ?></h2>
					<p><?php echo $date; ?></p>
					<p class="message"><?php echo substr($entry['body'], 0, 150) ?></p>
				</li>
				<?php } ?>
			</ul>
		</div>
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