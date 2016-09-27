<?php
 include("db_connect.php");
 // Establishing Connection with Server by passing server_name, user_id and password as a parameter
 $link = get_link();
 session_start();// Starting Session
 // Storing Session
 $user_check=$_SESSION['login_user'];
 // SQL Query To Fetch Complete Information Of User
 $sql= "SELECT * FROM chat_login_sessions WHERE username = '{$user_check}'";
 $ret=mysql_query($sql,$link);
 $row = mysql_fetch_assoc($ret);
 $login_session =$row['username'];
 mysql_close($link);
 if(!isset($login_session)){
  header('Location: chatlogin.php'); // Redirecting To Home Page
 }
?>
