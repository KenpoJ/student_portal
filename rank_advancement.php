<?php
include_once('inc/functions.php');
include_once('inc/session.php');
$session = $_SESSION['user_query'];

$title = 'Requirements for My Next Rank Advancement - DSSD Student Portal';

$ranks = get_advancements_ranks($session['ranks_id'], $session['programs_id']);
?>

<?php include_once('inc/head.html'); ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="content">
<div class="container">

	<div class="row row-margin">
		<h2 class="col-md-12">Rank Requirements</h2>
	</div>

	<div class="row row-margin requirements">
		<div class="col-md-1 ranks">
			<ul class="list-unstyled">
				<?php
				while($row = mysqli_fetch_array($ranks)) {
					echo '<li id="' . $row['id'] . '">' . $row['rank'] . ' <span class="glyphicon glyphicon-menu-right"></span></li>';
				}
				?>
			</ul>
		</div>
		<div class="col-md-1 types">
			<ul class="list-unstyled">
				<li id="techniques">Techniques <span class="glyphicon glyphicon-menu-right"></span></li>
				<li id="forms">Forms <span class="glyphicon glyphicon-menu-right"></span></li>
				<li id="sets">Sets <span class="glyphicon glyphicon-menu-right"></span></li>
			</ul>
		</div>
		<div class="col-md-2 lists">
			<ol>
				<?php
				/*$tech_list = get_techniques($session['ranks_id']);
				while($row = mysqli_fetch_array($tech_list)) {
					echo '<li id="' . $row['name'] . '" class="lists-item">' . $row['name'] . ' <span class="glyphicon glyphicon-menu-right"></span></li>';
				}*/
				?>
			</ol>
		</div>
		<div class="col-md-8 display"></div>
	</div>

</div>
</div>

<?php include_once('inc/footer.php'); ?>

</body>
</html>