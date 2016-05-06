<?php
require_once("../db/connectdb.php");
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "recon_qss", "recon_qss");
$mydb = new db();
$mydb->db_set("localhost","recon_qss", "recon_qss");
$connection = $mydb->db_connect();
// To protect MySQL injection for Security purpose
$username = escape_fields($username);
$password = escape_fields($password);
//$username = mysql_real_escape_string($username);
//$password = mysql_real_escape_string($password);
//hash the password
//$password = hash('sha256', $password);
// Selecting Database
$mydb->db_change("database1");
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
mysql_query("INSERT INTO login_sessions (username) VALUES ('$username')");
header("Location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>
