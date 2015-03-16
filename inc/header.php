<header>
	<div class="container">
		<div class="row">
			<h1 class="col-sm-6">DSSD Portal</h1>
			<nav class="col-sm-6 text-right">
				<ul class="list-unstyled">
					<?php
						if($_SESSION) {
					?>
						<li class="greeting">Hello, <?php echo $user_check['first_name'] ?></li>
					<?php if($user_check['role'] == 'admin' || $user_check['role'] == 'superadmin') {
					?>
							<li class="dropdown">
								<button class="btn btn-link dropdown-toggle" id="profileMenu" data-toggle="dropdown">My Menu <span class="caret"></span></button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="profileMenu">
									<li><a href="profile.php">My Profile</a></li>
									<li><a href="admin.php">Admin Page</a></li>
								</ul>
							</li>
					<?php
						} else {
					?>
						<li><a class="btn btn-link" href="profile.php">My Profile</a></li>
					<?php } ?>
						<li><a class="btn btn-link" href="inc/logout.php">Logout</a></li>
					<?php } ?>
				</ul>
			</nav>
		</div>
	</div>
</header>