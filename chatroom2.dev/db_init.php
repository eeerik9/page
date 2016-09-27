<?php
 $dbhost="localhost";
 $dbuser="recon_qss";
 $dbname="database1";
 $dbpass="recon_qss"; 
 echo "Connect:</br>"; 

 // Connect to mysql
 $link = mysql_connect($dbhost, $dbuser, $dbpass);
 if(! $link )
 {
  echo 'Error connecting to db';       
  die('Could not connect: ' . mysql_error());
 }
 echo 'Connected successfully to mysql</br>';

 // Connect to db
 $db_selected = mysql_select_db($dbname, $link);
 if (!$db_selected){
  die ('Could not select db: '. mysql_error());
 } 
 echo 'Db selected successfully</br>';

 // table login
 $sql = "DROP TABLE chat_login";
 if (!mysql_query($sql, $link)) {
  echo 'The table does not exist</br>';
 } else {
  echo 'Table login dropped</br>';
 }
 $sql ="CREATE TABLE chat_login ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username  VARCHAR(10) NOT NULL,password  VARCHAR(10) NOT NULL)";
 
 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table login created successfully</br>';
 
 $sql = "INSERT INTO chat_login (username, password) VALUES ('erik', 'erik1')";
 
 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'User inserted sucessfully</br>';

 // table login_sessions
 $sql = "DROP TABLE chat_login_sessions";
 if (!mysql_query($sql, $link)) {
  echo 'The table login_sessions does not exist</br>';
 } else {
  echo 'Table login_sessions dropped</br>';
 }
 $sql ="CREATE TABLE chat_login_sessions ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username  VARCHAR(10) NOT NULL)";
 
 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table login_sessions created successfully</br>';

 // table profile
 $sql = "DROP TABLE chat_profile";
 if (!mysql_query($sql, $link)) {
  echo 'The table profile does not exist</br>';
 } else {
  echo 'Table profile dropped</br>';
 }
 $sql ="CREATE TABLE chat_profile ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username  VARCHAR(10) NOT NULL, whoami VARCHAR(1024), resources VARCHAR(512), give VARCHAR(256), receive VARCHAR(256), photo VARCHAR(32), contact VARCHAR(256) )";
 
 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table profile created successfully</br>';
 
 // table msgs
 $sql = "DROP TABLE chat_msgs";
 if (!mysql_query($sql, $link)) {
  echo 'The table msgs does not exist</br>';
 } else {
  echo 'Table msgs dropped</br>';
 }
 $sql ="CREATE TABLE chat_msgs ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username  VARCHAR(10) NOT NULL, msg VARCHAR(256) NOT NULL, modtime TIMESTAMP)";
 
 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table msgs created successfully</br>';
 
// table msgs
 $sql = "DROP TABLE chat_chatrooms";
 if (!mysql_query($sql, $link)) {
  echo 'The table chatrooms does not exist</br>';
 } else {
  echo 'Table chatrooms dropped</br>';
 }
 $sql ="CREATE TABLE chat_chatrooms ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username  VARCHAR(10) NOT NULL, users VARCHAR(256) NOT NULL, creator VARCHAR(20) NOT NULL)";
 
 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table chatrooms created successfully</br>';

  mysql_close($link);
?>
