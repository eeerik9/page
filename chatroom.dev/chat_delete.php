<?php
 // login to db
 include("db_connect.php");
 // check if user is logged in
 session_start();
 // get connection to db
 $link = get_link();

 $name = $_POST['chatname'];
 $name = pg_escape_string($name);
 
 $sql = "DELETE FROM chatrooms WHERE chatname='{$name}'";
 
 $ret = pg_query($link, $sql);

 if (!$ret) {
  echo pg_last_error($link);
 } else {
  echo "Chatroom removed from chatrooms </br>";
 }

 $sql = "DROP TABLE IF EXISTS $name";
 
 $ret = pg_query($link, $sql);
 if (!$ret) {
  echo pg_last_error($link);
 } else {
  echo "Table deleted successfully </br>";
 }
 echo "Name: " . $name;

 // close connection to db 
 pg_close($link);

 header('Location: home.php');
?>
