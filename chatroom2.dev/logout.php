<?php
include("db_connect.php");
session_start();
$link = get_link();
$username = $_SESSION['login_user'];

$sql = "DELETE FROM chat_login_sessions WHERE username='{$username}'";

mysql_query($sql, $link);

if(session_destroy()) {
  header("Location: chatlogin.php"); // Redirecting To Home Page
}
?>
