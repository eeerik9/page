<?php
 // Mysql DB init
 $dbhost="localhost";
 $dbuser="recon_qss";
 $dbpass="recon_qss";
 $dbname="database1";

 // Connect to mysql
 $link = mysql_connect($dbhost, $dbuser, $dbpass);
 if(! $link )
 {
     die('Could not connect: ' . mysql_error());
 }
 echo 'Connected successfully to mysql</br>';
 
// Connect to db
 $db_selected = mysql_select_db($dbname, $link);
 if (!$db_selected){
  die ('Could not select db: '. mysql_error());
 } 
 echo 'Db selected successfully</br>';

// Sql query
 echo 'Array: Users in the db are: </br>';
 $sql = "SELECT * FROM login";
 $ret = mysql_query($sql, $link);
 while ($row = mysql_fetch_array($ret)){
   echo "User: ".$row[0]. " ". $row[1]. "</br>";
 }
 echo "</br>";

 $sql = "SELECT * FROM login";
 $ret = mysql_query($sql, $link); 
 echo 'Assoc: Users in the db are: </br>';
 while ($row = mysql_fetch_assoc($ret)){
  echo "User: " .  $row['username'] . "</br>"; 
 }

// Initialize tables
 echo 'Initializing tables</br>';

// table login
 $sql = "DROP TABLE forum_login";
 if (!mysql_query($sql, $link)) {
  die ("Error: " . mysql_error());
 }
 echo 'Table login dropped</br>';
 $sql ="CREATE TABLE forum_login ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,author  VARCHAR(10) NOT NULL,number  VARCHAR(10) NOT NULL)";

 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table login created successfully</br>';

 $sql = "INSERT INTO forum_login (author, number) VALUES ('erik', 'erik1')";

  if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'User inserted sucessfully</br>';

// table form
 $sql = "DROP TABLE forum_topics";
 if (!mysql_query($sql, $link)) {
  die ("Error: " . mysql_error());
 }
 echo 'Table topics dropped</br>';
 $sql ="CREATE TABLE forum_topics ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(20) NOT NULL, topic VARCHAR(500) NOT NULL, author  VARCHAR(10) NOT NULL,views INT(6) NOT NULL, posted TIMESTAMP)";

 if (!mysql_query($sql, $link)) {
  die ("Error: " .  mysql_error());
 }
 echo 'Table forum created successfully</br>';
 
 mysql_close($link);
?>
