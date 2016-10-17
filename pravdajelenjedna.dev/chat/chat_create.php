<?php
 // login to db
 include("db_connect.php");
 // check if user is logged in
 session_start();
 // get connection to db
 $link = get_link();

 $name = $_POST['chatname'];
 $users = $_POST['chatusers'];
 $name = mysql_escape_string($name);
 $users = mysql_escape_string($users);

 $sql ="CREATE TABLE $name (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username  VARCHAR(10) NOT NULL, msg VARCHAR(256) NOT NULL, modtime TIMESTAMP)";
 
 $ret = mysql_query($sql,$link);
 if (!$ret) {
  echo "Error: ". mysql_errno($link);
 } else {
  echo "Table created successfully </br>";
 }

 $sql = "INSERT INTO chat_chatrooms (chatname, users, creator) VALUES ( '{$name}', '{$users}', '{$_SESSION['login_user']}')";
 $ret = mysql_query($sql, $link);
 if (!$ret) {
  echo "Error: " . mysql_error($link);
 } else {
  echo "Chatroom inserted successfully";
 }

 echo "Name: " . $name. "</br>";
 echo "Users: " . $users;

 // close connection to db 
 mysql_close($link);

 header('Location: home.php');
?>
