<?php
 include("db_connect.php");
 session_start();
 if (isset($_SESSION['chatroom'])){
  $msgs = $_SESSION['chatroom'];
 } else {
  $msgs = "msgs";
 }
 //send a message
 //username in form $from->$to
 $from = $_SESSION['login_user'];
 $to = 'all';
 if (strcmp($to, '') !== 0) {
  $msg = $_POST['msg_area'];
  $msg = pg_escape_string($msg);

  //Get link to db
  $link = get_link();
  if (strcmp($msg, '') !== 0) {
   $username = $from."->".$to;
   $ret = pg_query(
    $link,
    "INSERT INTO $msgs (username, msg) 
    VALUES ('{$username}', '{$msg}')"
   );
  }
  pg_close($link); 
 }
 header('Location: chat.php');
?>
