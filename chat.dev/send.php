<?php
 session_start();
 //send a message
 //username in form $from->$to
 $from = $_SESSION['login_user'];
 $to = $_POST['_writeto'];
 
 if (strcmp($to, '') !== 0) {
  $msg = $_POST['msg_area'];
  $msg = stripslashes($msg);

  // Establishing Connection with Server by passing server_name, user_id and password as a parameter
  $connection = mysql_connect("localhost", "eeerik9", "nikanika");
  // Selecting Database
  $db = mysql_select_db("eeerik9", $connection);
  $msg = mysql_real_escape_string($msg);
  
  if (strcmp($msg, '') !== 0) {
   $username = $from."->".$to;
   mysql_query("INSERT INTO msgs (username, msg) VALUES ('$username', '$msg')");
  }
 }
 header('Location: profile.php');
?>