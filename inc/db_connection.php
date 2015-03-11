<?php  
  $dbhost = "localhost";
  $dbuser = "jlyman_owner";
  $dbpass = "Wh33l0fTim3";
  $dbname = "jlyman_dssd_admin";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>