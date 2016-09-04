<?php
 include('db_connect.php');
 session_start();
 $link = get_link();
 $sql = "SELECT * FROM chatrooms";
 $ret = pg_query($link, $sql);
 if (!$ret) {
  echo pg_last_error($link);
 } else {
  while ($row = pg_fetch_row($ret)) {
   echo '<a href="chat.php?na='.$row[1].'">'.$row[1].'</a>, ';
  } 
 }
 pg_close($link);
?>
