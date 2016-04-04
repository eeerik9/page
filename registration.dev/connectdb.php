<?php
function connect_db () {
	
	$dbservername = "localhost";
	$dbusername = "erik";
	$dbpassword = "nikanika";
	$dbname = "database1";
	
	// Create connection
	$conn = mysql_connect($dbservername, $dbusername, $dbpassword);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	

	// Create connection
	$conn = mysql_connect($dbservername, $dbusername, $dbpassword);
	// Check connection
	if ($conn->connect_error) {
		echo "5";
		die("Connection failed: " . $conn->connect_error);
	}	 
	mysql_select_db($dbname, $conn);
	return $conn;
}

function escape_fields($field)
{
	return mysql_real_escape_string(stripslashes($field));
}
?> 