<?php

// -------- FORM VALIDATIOMS --------- //
$errors = [];
function validate_presence_on($required_fields) {
	global $errors;
	foreach($required_fields as $field) {
		if(!has_presence($_POST[$field])) {
			$errors[$field] = "'" . "' can't be blank";
		}
	}
}

function has_presence($value) {
	$trimmed_value = trim($value);
	return isset($trimmed_value) && $trimmed_value !== "";
}

//has_length($first_name, ['min' => 5, 'max' => 100])
function has_length($value, $options=[]) {
	if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && (strlen($value) > (int)$options['min'])) {
		return false;
	}
	if(isset($options['exact']) && (strlen($value) > (int)$options['exact'])) {
		return false;
	}
	return true;
}

//Format check for say an email address
function has_format_matching($value, $regex="//") {
	return preg_match($regex, $value);
}

//has_number($items_to_order, ['min' => 1, 'max' => 5])
function has_number($value, $options=[]) {
	if(!is_numeric($value)) {
		return false;
	}
	if(isset($options['max']) && ($value > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && ($value < (int)$options['min'])) {
		return false;
	}
	return true;
}

function has_inclusion_in($value, $set = []) {
	return in_array($value, $set);
}

function has_exclusion_from($value, $set = []) {
	return !in_array($value, $set);
}

// * validate uniqueness
//A common validation, but not an easy one to write generically.
//Requires going to the database to check if value is already present.
//Implementation depends on your database setup.
//Instead, here is a mock-up of the concept.
//Be sure to escape the user-provided vaue before sending it to the database.
//Table and column will be provided by us and escaping them is optional.
//Also consider whether you want to trim whitespace, or make the query case-sensitive or not.

/*function has_uniqueness($value, $table, $column) {
	$escaped_value = mysqli_escape($value);
	$query = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = '{$escaped_value}';"
	if count > 0 then value is already present and not unique. return false
}*/

?>