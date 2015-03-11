<?php
include_once('inc/db_connection.php');
include_once('inc/functions.php');
include_once('inc/session.php');
//$bday = date_create($data['birth_date']);
//$start = date_create($data['start_date']);

$title = 'Manage My Profile - DSSD Student Portal';
?>

<?php include_once('inc/head.html'); ?>

<body>

<?php include_once('inc/header.php'); ?>

<div class="container">

	<div class="row row-margin">
		<form class="general-form col-md-8 col-md-offset-2 well well-small" action="" method="post">

			<fieldset>
				<legend>Personal Information</legend>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">First Name</label>
							<input type="text" class="form-control" name="first_name" placeholder="<?php echo $user_check['first_name']; ?>">
						</div>
						<div class="form-group">
							<label for="">Email Address</label>
							<input type="text" class="form-control" name="email" placeholder="<?php echo $user_check['email']; ?>">
						</div>
						<div class="form-group">
							<label for="">Emergency Contact</label>
							<input type="text" class="form-control" name="em_contact" placeholder="<?php echo $user_check['emergency_contact']; ?>">
						</div>
						<div class="form-group">
							<label for="">Emergency Phone</label>
							<input type="text" class="form-control" name="em_phone" placeholder="<?php echo $user_check['emergency_phone']; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Last Name</label>
							<input type="text" class="form-control" name="last_name" placeholder="<?php echo $user_check['last_name']; ?>">
						</div><div class="form-group">
							<label for="">Street Address</label>
							<input type="text" class="form-control" name="street_add" placeholder="<?php echo $user_check['street_address']; ?>">
						</div>
						<div class="form-group">
							<label for="">City</label>
							<input type="text" class="form-control" name="city" placeholder="<?php echo $user_check['city']; ?>">
						</div>
						<div class="form-group">
							<label for="">State</label>
							<input type="text" class="form-control" name="state" placeholder="<?php echo $user_check['state']; ?>">
						</div>
						<div class="form-group">
							<label for="">Zip Code</label>
							<input type="text" class="form-control" name="zip" placeholder="<?php echo $user_check['zip']; ?>">
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Login Information</legend>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" class="form-control" name="username" placeholder="<?php echo $user_check['username']; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Change Your Password</label>
							<input type="text" class="form-control" name="password" placeholder="Enter password">
						</div>
						<div class="form-group">
							<label for="">Re-enter Your Password</label>
							<input type="text" class="form-control" name="password2" placeholder="Re-enter password">
						</div>
					</div>
				</div>
			</fieldset>
			<button type="submit" class="col-md-3 col-md-offset-4 btn btn-default">Make Changes</button>
			<input type="hidden" name="submitted">
		</form>
		<?php changeUserInfo(); ?>
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