<?php
require_once("../db/connectdb.php");
session_start();
$mydb = new db();
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "eeerik9", "nikanika");
$mydb->db_set("localhost","recon_qss", "recon_qss");
$connection = $mydb->db_connect();
// Selecting Database
$mydb->db_change("database1");

$username = $_SESSION['login_user'];
mysql_query("DELETE FROM login_sessions WHERE username='$username'");

if(session_destroy()) // Destroying All Sessions
{
header("Location: index.php"); // Redirecting To Home Page
}
?>
