<?php
 // login to db
 include("db_connect.php");
 // check if user is logged in
 session_start();
 // get connection to db
 $link = get_link();

 $name = $_POST['chatname'];
 $users = $_POST['chatusers'];
 $name = pg_escape_string($name);
 $users = pg_escape_string($users);

 $sql ="CREATE TABLE $name (id SERIAL,username CHAR(30) NOT NULL,msg CHAR(256) NOT NULL,modtime timestamp DEFAULT current_timestamp)";
 
 $ret = pg_query($link, $sql);
 if (!$ret) {
  echo pg_last_error($link);
 } else {
  echo "Table created successfully </br>";
 }

 $sql = "INSERT INTO chatrooms (chatname, users) VALUES ( '{$name}', '{$users}')";
 $ret = pg_query($link, $sql);
 if (!$ret) {
  echo pg_last_error($link);
 } else {
  echo "Chatroom inserted successfully";
 }

 echo "Name: " . $name. "</br>";
 echo "Users: " . $users;

 // close connection to db 
 pg_close($link);

 header('Location: home.php');
?>
