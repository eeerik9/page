<?php
require_once("../db/connectdb.php");
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
var_dump(__LINE__);
$mydb = new db();
$mydb->db_set("localhost", "recon_qss", "recon_qss");
$connection = $mydb->db_connect();
// Selecting Database
$mydb->db_change("database1");
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>
