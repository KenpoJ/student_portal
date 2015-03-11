<header>
	<div class="container">
		<div class="row">
			<h1 class="col-sm-6">DSSD Portal</h1>
			<nav class="col-sm-6 text-right">
				<ul class="list-unstyled">
					<?php
						if($_SESSION) {
							echo '<li><a class="greeting btn btn-link disabled">Hello, ' . $user_check['first_name'] . '</a></li>';
							echo '<li><a class="btn btn-link" href="profile.php">My Profile</a></li>';
						
							echo '<li><a class="btn btn-link" href="inc/logout.php">Logout</a></li>';
						}
					?>
				</ul>
			</nav>
		</div>
	</div>
</header>