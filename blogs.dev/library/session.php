<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$link = mysql_connect("localhost", "recon_qss", "recon_qss");
// Selecting Database
$db = mysql_select_db("database1", $link);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from login where username='$user_check'", $link);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];
$nick_session = $_SESSION['nick_user'];
if(!isset($login_session)){
mysql_close($link); // Closing Connection
header('Location: library.php'); // Redirecting To Home Page
}
?>
