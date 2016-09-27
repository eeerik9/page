<?php
 include("db_connect.php");
 session_start();
 if (isset($_SESSION['chatroom'])) {
  $msgs = $_SESSION['chatroom'];
 } else {
  $msgs = "msgs";
 }
 $link = get_link();
 $time = time ();
 $ret = pg_query(
  $link,
  "SELECT * FROM $msgs ORDER BY modtime DESC"
 );
 while ($row = pg_fetch_array($ret)) {    
  $username = $row['username'];
  $from_to = explode("->", $username);
  $timestamp = $row['modtime']; // 2016-04-09 09:56:24
  $date_time = explode(" ", $timestamp); // creates array
  $timestamp = $date_time[1];
                                                                               
  $msg = $row['msg'];
                                                           
  echo " <B>".$from_to[0].'</B> <small>'.$timestamp."</small><br/>";
  echo $msg."<br/><br/>";
 }
 pg_close($link);
?>
