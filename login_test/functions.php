<?php

function confirm_query($result_set) {
	if (!$result_set) {
		die("Database connection failed: " . 
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")"
		);
	}
}

function reprintRegForm($un, $msg) {
	$output = '<h2>Register</h2>';
	$output .= '<div id="register-form" class="col-md-4 well">';
	$output .= '<form name="register" method="post" action="register.php">';
	$output .= '<div class="form-group has-error">';
	$output .= '<label for="username">Username</label>';
	$output .= '<input type="text" class="form-control" name="r-username" placeholder="' . $un . '">';
	$output .= '<span class="help-block">' . $msg . '</span>';
	$output .= '</div>';
	$output .= '<div class="form-group">';
	$output .= '<label for="password">Password</label>';
	$output .= '<input type="password" class="form-control" name="r-password" placeholder="Enter a password">';
	$output .= '</div>';
	$output .= '<div class="form-group">';
	$output .= '<input type="submit" class="btn btn-default" value="Register">';
	$output .= '<input type="hidden" name="register" value="true">';
	$output .= '</div>';
	$output .= '<div class="error"><?php //echo $error; ?></div>';
	$output .= '</form>';
	$output .= '</div>';

	echo $output;
}

 
function generateHashWithSalt($password) {
	define("MAX_LENGTH", 6);
	$intermediateSalt = md5(uniqid(rand(), true));
	$salt = substr($intermediateSalt, 0, MAX_LENGTH);
	return hash("sha256", $password . $salt);
}

function registerUser($un, $pw) {
	global $output;
	$error = 'none';
	if(isset($_POST['register'])) {
		$un = stripslashes($un);
		$pw = stripslashes($pw);
		$regex = "/^[A-Za-z0-9_~\-\.!@#\$%\^&\*\(\)]+$/";

		if(preg_match($regex, $un)) { // username is valid
			//check to see if username is unique
			global $connection;

			$query = "SELECT * FROM `users` WHERE username = '$un'";
			$user_info = mysqli_query($connection, $query);
			confirm_query($user_info);
			$data = mysqli_fetch_assoc($user_info);

			if($data['username'] == $un) { //username is NOT unique
				$msg = 'That username is already in use. Choose another.';
				reprintRegForm($un, $msg);
			} else { //username IS unique
				$pw = hash("sha256", $pw);
				//$pw = generateHashWithSalt($pw);
				$query = "INSERT INTO `users` (username, password) VALUES ('$un', '$pw')";
				echo 'Success!';
				$user_info = mysqli_query($connection, $query);
				confirm_query($user_info);

				//check to see if insertion was successful

			}
			//take password and hash it for storage

		} else { //when username is not in valid format
			$error = 'error';
			$msg = 'Username is in an invalid format.';
			//reprint form
			reprintRegForm($un, $msg);
		}
	} else {
		echo 'no register submission';
	}
}

function authenticateUser($un, $pw) {
	global $connection;
	$un = stripslashes($un);
	$pw = hash("sha256", stripslashes($pw));

	$query = "SELECT * FROM `users` WHERE username = '$un' AND password = '$pw'";
	$login_info = mysqli_query($connection, $query);
	confirm_query($login_info);
	$data = mysqli_fetch_assoc($login_info);
	//var_dump($login_info);
}

function get_single_user($id) {
	global $connection;
	$query = "SELECT * FROM `users` ";
	$query .= "INNER JOIN `ranks` ";
	$query .= "ON users.ranks_id = ranks.id ";
	$query .= "INNER JOIN `programs` ";
	$query .= "ON users.programs_id = programs.id  WHERE users.id = $id";

	$user_info = mysqli_query($connection, $query);
	confirm_query($user_info);
	$data = mysqli_fetch_assoc($user_info);

	$bday = date_create($data['birth_date']);
	$start = date_create($data['start_date']);

	$output = '<!--img src="images/students/image_name.jpg" alt="Jenny Phillips"-->
			<img class="pull-left" src="http://placehold.it/60x60" alt="Jenny Phillips">';
	$output .= '<h3>' . $data['first_name'] . ' ' . $data['last_name'] . '</h3>';
	$output .= '<p class="rank">' . $data['rank'] . ' Belt</p>';
	$output .= '<p class="program">' . $data['program'] . '</p>';
	$output .= '<div class="clearfix"></div>';
	$output .= '<p class="email"><a href="mailto:' . $data['email'] . '">' . $data['email'] . '</a></p>';
	$output .= '<address>';
	$output .= $data['street_address'] . '<br>';
	$output .= $data['city'] . ', ' . $data['state'] . ' ' . $data['zip'] . '<br>';
	$output .= '<span class="phone">' . $data['phone'] . '</span>';
	$output .= '</address>';
	$output .= '<p class="bday">Birthday: ' . date_format($bday, 'm/d/Y') . '</p>';
	$output .= '<p class="start">Start Date: ' . date_format($start, 'm/d/Y') . '</p>';
	$output .= '<div class="clearfix"></div>';
	$output .= '<div class="emergency-contact">';
	$output .= '<h4>Emergency Contact</h4>';
	$output .= '<p>' . $data['emergency_contact'] . '<br>';
	$output .= $data['emergency_phone'] . '</p>';
	$output .= '</div>';

	echo $output;
}

function get_announcements() {
	global $connection;

	$query = "SELECT * ";
	$query .= "FROM `announcements` ";
	$query .= "ORDER BY publish_date";
	//echo $query;
	$message_set = mysqli_query($connection, $query);
	confirm_query($message_set);
	
	$output = "<ul class=\"list-unstyled\">";
	while($message = mysqli_fetch_assoc($message_set)) {
		$date = date_create($message['publish_date']);
		$output .= "<li>";
		$output .= "<h4>" . $message['title'] . "</h4>";
		$output .= "<p>" . date_format($date, 'm/d/y') . "</p>";
		$output .= "<p class=\"message\">" . substr($message['body'], 0, 150) . "...</p>";
		$output .= "</li>";
	}
	$output .= "</ul>";
	echo $output;
}

?>