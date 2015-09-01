<?php
include_once('db_connection.php');
include_once('functions.php');
global $connection;

//Search by Name
$str = $_POST['query'];
$str = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$str = mysqli_real_escape_string($connection, $str);

if($str == 'adult' || $str == 'youth' || $str == 'junior') {
    switch($str) {
        case 'junior':
            $str = 3;
            break;
        case 'youth':
            $str = 2;
            break;
        case 'adult':
            $str = 1;
            break;
    }
    $query = 'SELECT * FROM `users` ';
    $query .= "INNER JOIN `ranks` ";
    $query .= "ON users.ranks_id = ranks.id ";
    $query .= "INNER JOIN `programs` ";
    $query .= "WHERE users.programs_id = " . $str . " ";
    $query .= "AND programs.id = users.programs_id ";
    $query .= "GROUP BY users.id ";
    //$query .= "ORDER BY users.id ";

} else if ($str == 'all') {
    $query = "SELECT * FROM `users` ";
	$query .= "INNER JOIN `ranks` ";
	$query .= "ON users.ranks_id = ranks.id ";
	$query .= "INNER JOIN `programs` ";
	$query .= "ON users.programs_id = programs.id ";
	$query .= "ORDER BY users.last_name ";

} else {
    $query = 'SELECT * FROM `users` ';
    $query .= "INNER JOIN `ranks` ";
    $query .= "ON users.ranks_id = ranks.id ";
    $query .= "INNER JOIN `programs` ";
    $query .= "ON users.programs_id = programs.id ";
    $query .= 'WHERE first_name LIKE ';
    $query .= '"%'. $str . '%"';
    $query .= ' OR last_name LIKE ';
    $query .= '"%'. $str . '%"';
    $query .= "ORDER BY users.id ";
}

get_all_users($query);

/*$result_set = mysqli_query($connection, $query);
//$result = mysqli_fetch_assoc($result_set);

if (mysqli_num_rows($result_set) != 0) {
	// displaying records.
	echo output_users($result_set);
} else {
	echo "No records found.";
    //get_all_users();
}*/
?>