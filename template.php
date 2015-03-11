<?php
include_once('inc/functions.php');
include_once('inc/session.php');

$title = ' Page - DSSD Student Portal';
$bday = date_create($data['birth_date']);
$start = date_create($data['start_date']);
?>

<?php include_once('inc/head.html'); ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="content">
<div class="container">

	<div class="row row-margin">

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