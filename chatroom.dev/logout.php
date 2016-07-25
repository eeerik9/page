<?php
include("db_connect.php");
session_start();
$link = get_link();
$username = $_SESSION['login_user'];

pg_query(
 $link,
 "DELETE FROM login_sessions WHERE username='{$username}'"
);

if(session_destroy()) {
  header("Location: chatlogin.php"); // Redirecting To Home Page
}
?>
