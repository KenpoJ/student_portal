<?php

function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}

function get_program($programs_id) {
	global $connection;
	$query = 'SELECT program FROM `programs` ';
	$query .= 'WHERE programs.id = ' . $programs_id;
	$program_info = mysqli_query($connection, $query);
	confirm_query($program_info);
	$program = mysqli_fetch_assoc($program_info);
	$program_name = $program['program'];
	return $program_name;
}

function get_rank($ranks_id) {
	global $connection;
	$query = 'SELECT rank FROM `ranks` ';
	$query .= 'WHERE ranks.id = ' . $ranks_id;
	$rank_info = mysqli_query($connection, $query);
	confirm_query($rank_info);
	$rank = mysqli_fetch_assoc($rank_info);
	$rank_name = $rank['rank'];
	return $rank_name;
}

function get_advancements_ranks($ranks_id, $programs_id) {
	global $connection;
	$query = 'SELECT * FROM `ranks` ';
	$query .= 'WHERE id <= ';
	$query .= $ranks_id + 1;
	$query .= ' AND id > 1 ';
	$query .= 'AND programs_id = ' . $programs_id;
	$rank_info = mysqli_query($connection, $query);
	confirm_query($rank_info);
	//$ranks = mysqli_fetch_assoc($rank_info);
	//var_dump($ranks);
	return $rank_info;
}

function get_next_rank($ranks_id) {
	global $connection;
	$query = 'SELECT rank FROM `ranks` ';
	$query .= 'WHERE ranks.id = ' . $ranks_id . ' + 1';
	$rank_info = mysqli_query($connection, $query);
	confirm_query($rank_info);
	$next_rank = mysqli_fetch_assoc($rank_info);
	$next_rank_name = $next_rank['rank'];
	return $next_rank_name;
}

function get_techniques($ranks_id) {
	global $connection;
	$query = 'SELECT * FROM `techniques` ';
	$query .= 'INNER JOIN `ranks_has_techniques` ON techniques_id = techniques.id ';
	$query .= 'INNER JOIN `ranks` ON ranks.id = ranks_has_techniques.ranks_id ';
	$query .= 'WHERE ranks.id = ' . $ranks_id;
	$technique_list = mysqli_query($connection, $query);
	//$list = mysqli_fetch_assoc($technique_list);
	return $technique_list;
	//var_dump($list);
}

function get_sets($ranks_id) {
	global $connection;
	$query = 'SELECT * FROM `sets` ';
	$query .= 'INNER JOIN `ranks_has_sets` ON sets_id = sets.id ';
	$query .= 'INNER JOIN `ranks` ON ranks.id = ranks_has_sets.ranks_id ';
	$query .= 'WHERE ranks.id = ' . $ranks_id;
	$set_list = mysqli_query($connection, $query);
	$list = mysqli_fetch_assoc($set_list);
	echo $list['name'];
	//return $list;
	//var_dump($list);
}

function get_class_times($ranks_id) {
	global $connection;
	$query = 'SELECT name, start_time, end_time, day1, day2 FROM `classes` ';
	$query .= 'INNER JOIN `ranks` ON classes_id = classes.id ';
	$query .= 'WHERE ranks.id = ' . $ranks_id;
	$user_class = mysqli_query($connection, $query);
	$class = mysqli_fetch_assoc($user_class);
	$fields = mysqli_fetch_fields($user_class);
	return $class;
}

function get_all_users() {
	global $connection;

	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if($page <= 0) {
		$page = 1;
	}

	// Set how many records do you want to display per page.
	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$statement = "`users` ORDER BY `id` ASC"; // Change `records` according to your table name.

	$query = "SELECT * FROM `users` ";
	$query .= "INNER JOIN `ranks` ";
	$query .= "ON users.ranks_id = ranks.id ";
	$query .= "INNER JOIN `programs` ";
	$query .= "ON users.programs_id = programs.id ";
	$query .= "ORDER BY users.id ";
	$query .= "LIMIT {$startpoint} , {$per_page}";
	
	//$results = mysqli_query($connection,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
	$results = mysqli_query($connection, $query);
	if (mysqli_num_rows($results) != 0) {
		// displaying records.
		echo output_users($results);
	} else if(mysqli_num_rows($results) == 0) {
		echo 'Search to display students.';
	} else {
		echo "No records are found.";
	}
	// displaying paginaition.
	echo $output;
	echo pagination($statement, $per_page, $page, $url='?');
}

function output_users($results) {
	$output = '<ul id="student-list" class="list-unstyled">';
	while ($row = mysqli_fetch_array($results)) {
		$output .= '<li>';
		$output .= '<div class="row">';
		$output .= '<div class="col-md-4">';
		$output .= '<img class="pull-left" src="http://placehold.it/80x80" alt="' . $row['first_name'] . ' ' . $row['last_name'] . '">';
		$output .= '<h3>' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>';
		$output .= '<p>' . $row['rank'] . ' Belt<br>' . $row['program'] . ' Program<br></p>';
		$output .= '</div>';
		$output .= '<div class="col-md-4"';
		$output .= '<p>' . $row['notes'] . '</p>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</li>';
	}
	$output .= '</ul>';
	return $output;
}

function get_single_user($ranks_id, $programs_id, $id) {
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

	$output = '<a type="button" class="close" href="manage_profile.php"><span class="glyphicon glyphicon-pencil"></span>Edit</a>';
	$output .= '<!--img src="images/students/image_name.jpg" alt="Jenny Phillips"-->
			<img class="pull-left" src="http://placehold.it/60x60" alt="' . $data['first_name'] . ' ' . $data['last_name'] . '">';
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

function get_announcements($limit) {
	global $connection;

	$query = "SELECT * ";
	$query .= "FROM `announcements` ";
	$query .= "ORDER BY publish_date ";
	$query .= "LIMIT " . $limit;
	echo $query;
	$message_set = mysqli_query($connection, $query);
	confirm_query($message_set);
	$entry = mysqli_fetch_assoc($message_set);
	return $entry;

	/*$output = "<ul id=\"announcements\" class=\"list-unstyled\">";
	while($message = mysqli_fetch_assoc($message_set)) {
		$date = date_create($message['publish_date']);
		$output .= "<li>";
		$output .= "<h4>" . $message['title'] . "</h4>";
		$output .= "<p>" . date_format($date, 'm/d/y') . "</p>";
		$output .= "<p class=\"message\">" . substr($message['body'], 0, 150) . "...</p>";
		$output .= "</li>";
	}
	$output .= "</ul>";
	echo $output;*/
}

function get_rank_info($ranks_id, $programs_id, $id) {
	global $rank;
	get_rank($ranks_id);
	echo $rank;
}

function changeUserInfo() {
	if(isset($_POST['submitted'])) {
		
	} else {
		echo 'not submitted';
	}
}

function pagination($query, $per_page = 10, $page = 1, $url = '?') {   
	global $connection;

	$query = "SELECT COUNT(*) as `num` FROM {$query}";
	$row = mysqli_fetch_array(mysqli_query($connection, $query));
	$total = $row['num'];
	$adjacents = "2"; 

	$prevlabel = "&lsaquo; Prev";
	$nextlabel = "Next &rsaquo;";
	$lastlabel = "Last &rsaquo;&rsaquo;";

	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $per_page;                               

	$prev = $page - 1;                          
	$next = $page + 1;

	$lastpage = ceil($total / $per_page);

	$lpm1 = $lastpage - 1; // //last page minus 1

	$pagination = "";
	if($lastpage > 1) {   
		$pagination .= "<ul class='pagination'>";
		//$pagination .= "<li class='page_info pull-right'>Page {$page} of {$lastpage}</li>";

		if($page > 1) { 
			$pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
		}

		if($lastpage < 7 + ($adjacents * 2)) {
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $page) {
					$pagination.= "<li><a class='active'>{$counter}</a></li>";
				} else {
					$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
				}                  
			}
		} elseif($lastpage > 5 + ($adjacents * 2)) {
			if($page < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $page) {
						$pagination.= "<li><a class='active'>{$counter}</a></li>";
					} else {
						$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
					}
				}
				$pagination.= "<li class='dot'>...</li>";
				$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
				$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
			} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
				$pagination.= "<li class='dot'>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page) {
					$pagination.= "<li><a class='active'>{$counter}</a></li>";
					} else {
					$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
					}                  
				}
				$pagination.= "<li class='dot'>..</li>";
				$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
				$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";
			} else {
				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
				$pagination.= "<li class='dot'>..</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $page) {
					$pagination.= "<li><a class='active'>{$counter}</a></li>";
					} else {
						$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
					}
				}
			}
		}
		if ($page < $counter - 1) {
			$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
			$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
		}
		$pagination.= "</ul>";     
	}
	return $pagination;
}

?>