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
			<?php
			$limit = 5;
			$entry = get_announcements($limit);
            //$entry = mysqli_fetch_assoc($entry);
            //var_dump($entry);
			//$date = date_create($entry['publish_date']);
			//$date = $date->format('M d, Y');
			?>
			<?php
               $output = "<ul id=\"announcements\" class=\"list-unstyled\">";
                while($message = mysqli_fetch_assoc($entry)) {
                    $date = date_create($message['publish_date']);
                    $output .= "<li>";
                    $output .= "<h2>" . $message['title'] . "</h2>";
                    $output .= "<p>" . date_format($date, 'm/d/y') . "</p>";
                    $output .= "<p class=\"message\">" . substr($message['body'], 0, 150) . "...</p>";
                    $output .= "</li>";
                }
                $output .= "</ul>";
                echo $output;
            ?>
			<!--<ul id="announcements" class="list-unstyled">


				<?php
				$i = 0;
				while($i < $limit) { ?>
				<li>
					<h2><?php echo $entry['title'] ?></h2>
					<p><?php echo $date; ?></p>
					<p class="message"><?php echo substr($entry['body'], 0, 150) ?></p>
				</li>
				<?php $i++; } ?>

			</ul>-->
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