<?php
 include('db_connect.php');
 session_start();
 $link = get_link();
 $sql = "SELECT * FROM chat_chatrooms";
 $ret = mysql_query($sql, $link);
 if (!$ret) {
  echo "Error: ". mysql_errno($link);
 } else {
  while ($row = mysql_fetch_row($ret)) {
   // Show only chatroom for particular user
   if (strpos($row[2],$_SESSION['login_user'])!== false) {   
    echo '<a href="chat.php?na='.$row[1].'">'.$row[1].'</a>('.$row[3].'->'.$row[2].'), ';
   } 
  }
 }
 mysql_close($link);
?>
