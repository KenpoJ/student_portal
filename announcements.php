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
		    <h1>Announcements</h1>
			<?php get_announcements(5); ?>
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