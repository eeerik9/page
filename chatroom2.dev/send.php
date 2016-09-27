<?php
 include("db_connect.php");
 session_start();
 if (isset($_SESSION['chatroom'])){
  $msgs = $_SESSION['chatroom'];
 } else {
  $msgs = "chat_msgs";
 }
 //send a message
 //username in form $from->$to
 $from = $_SESSION['login_user'];
 $to = 'all';
 if (strcmp($to, '') !== 0) {
  $msg = $_POST['msg_area'];
  $msg = mysql_escape_string($msg);

  //Get link to db
  $link = get_link();
  if (strcmp($msg, '') !== 0) {
   $username = $from."->".$to;
   $sql="INSERT INTO $msgs (username, msg) VALUES ('{$username}', '{$msg}')";
   mysql_query($sql, $link);
  }
  mysql_close($link); 
 }
 header('Location: chat.php');
?>
