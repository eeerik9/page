<?php
 require_once("../db/connectdb.php");
 session_start();
 //send a message
 //username in form $from->$to
 $from = $_SESSION['login_user'];
 $to = 'all';
 
 if (strcmp($to, '') !== 0) {
  $msg = $_POST['msg_area'];
  $msg = stripslashes($msg);

  // Establishing Connection with Server by passing server_name, user_id and password as a parameter
  $mydb = new db();
  $mydb->db_set("localhost", "recon_qss", "recon_qss");
  $connection = $mydb->db_connect();
  // $connection = mysql_connect("localhost", "eeerik9", "nikanika");
  // Selecting Database
  $mydb->db_change("database1");
  $msg = mysql_real_escape_string($msg);

  if (strcmp($msg, '') !== 0) {
   $username = $from."->".$to;
   mysql_query("INSERT INTO msgs (username, msg) VALUES ('$username', '$msg')");
  }
 }
 header('Location: profile.php');
?>
