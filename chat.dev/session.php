<?php
 include("db_connect.php");
 // Establishing Connection with Server by passing server_name, user_id and password as a parameter
 $link = get_link();
 if ($link) {echo "OK</br>";} else {echo "KO</br>";}
 session_start();// Starting Session
 // Storing Session
 $user_check=$_SESSION['login_user'];
 // SQL Query To Fetch Complete Information Of User
 $ret = pg_query(
  $link,
  "SELECT * FROM login WHERE username = '{$user_check}'"
 );
 $row = pg_fetch_assoc($ret);
 $login_session =$row['username'];
 pg_close($link);
 if(!isset($login_session)){
  header('Location: index.php'); // Redirecting To Home Page
 }
?>
