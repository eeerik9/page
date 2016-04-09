<?php
session_start();

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "eeerik9", "nikanika");

// Selecting Database
$db = mysql_select_db("eeerik9", $connection);

$username = $_SESSION['login_user'];
mysql_query("DELETE FROM login_sessions WHERE username='$username'");

if(session_destroy()) // Destroying All Sessions
{
header("Location: index.php"); // Redirecting To Home Page
}
?>