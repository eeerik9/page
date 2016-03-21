<?php
function connect
$dbservername = "localhost";
$dbusername = "erik";
$dbpassword = "nikanika";
$dbname = "database1";
echo "3";
// Create connection
$conn = mysql_connect($dbservername, $dbusername, $dbpassword);
// Check connection
if ($conn->connect_error) {
	echo "5";
	die("Connection failed: " . $conn->connect_error);
}	
?> 