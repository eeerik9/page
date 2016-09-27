<?php
 // login to db
 include("db_connect.php");
 // check if user is logged in
 session_start();
 // get connection to db
 $link = get_link();

 $name = $_POST['chatname'];
 $name = mysql_escape_string($name);

 // Only creator can delete chatroom 
 $sql = "SELECT * FROM chat_chatrooms WHERE chatname='{$name}'";
 
 $ret = mysql_query($sql,$link);

 if (!$ret){
  echo mysql_errno($link);
 } else {
  $row = mysql_fetch_assoc($ret);
  $logged = trim($_SESSION['login_user']);
  $creator = trim($row['creator']);
  if (strcmp($creator, $logged) == 0){   

   $sql = "DELETE FROM chat_chatrooms WHERE chatname='{$name}'";
 
   $ret = mysql_query($sql,$link);

   if (!$ret) {
    echo mysql_errno($link);
   } else {
    echo "Chatroom removed from chatrooms </br>";
   }

   $sql = "DROP TABLE IF EXISTS $name";
 
   $ret = mysql_query($sql, $link);
   if (!$ret) {
    echo "Error: ". mysql_errno($link);
   } else {
    echo "Table deleted successfully </br>";
   }
  }
 }
 
 // close connection to db 
 mysql_close($link);

 header('Location: home.php');
?>
