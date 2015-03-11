<?php
include_once('db_connection.php');
include_once('functions.php');
global $connection;

$rank_id = $_POST['query'];
$type_id = $_POST['query2'];

if($type_id == 'techniques') {
	$query = 'SELECT * FROM `techniques` ';
	$query .= 'INNER JOIN `ranks_has_techniques` ON techniques_id = techniques.id ';
	$query .= 'INNER JOIN `ranks` ON ranks.id = ranks_has_techniques.ranks_id ';
	$query .= 'WHERE ranks.id = ' . $rank_id;
}
if($type_id == 'forms') {
	$query = 'SELECT * FROM `forms` ';
	$query .= 'INNER JOIN `ranks_has_forms` ON forms_id = forms.id ';
	$query .= 'INNER JOIN `ranks` ON ranks.id = ranks_has_forms.ranks_id ';
	$query .= 'WHERE ranks.id = ' . $rank_id;
}
if($type_id == 'sets') {
	$query = 'SELECT * FROM `sets` ';
	$query .= 'INNER JOIN `ranks_has_sets` ON sets_id = sets.id ';
	$query .= 'INNER JOIN `ranks` ON ranks.id = ranks_has_sets.ranks_id ';
	$query .= 'WHERE ranks.id = ' . $rank_id;
}

$result_set = mysqli_query($connection, $query);

$output = '<ol>';
while ($row = mysqli_fetch_array($result_set)) {
	$output .= '<li id="' . $row['name'] . '" class="lists-item">' . $row['name'] . ' <span class="glyphicon glyphicon-menu-right"></span></li>';
}
$output .= '</ol>';

echo $output;

?>