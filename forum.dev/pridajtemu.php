<?php
 include("db_connect.php");
 session_start();
 if (!isset($_SESSION['prihlaseny'])) { 
  echo "neprihlaseny</br>";
  exit;
 }
 if (isset($_POST['stlacil'])){
  $nazov = mysql_escape_string($_POST['nazov']);
  $tema = mysql_escape_string($_POST['tema']);
  
 $link = get_link();

 $sql ="INSERT INTO forum_topics (name,topic,author,views) VAlUES ('{$nazov}', '{$tema}', '{$_SESSION["prihlaseny"]}', 0)";
  
  $ret = mysql_query($sql, $link);
  if (!$ret){
   echo "Error: ". mysql_error();
   mysql_close($link);
   exit;
  } else {
   echo 'Topic inserted successfully</br>';
   
   // Add topic
   $sql ="CREATE TABLE $nazov (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, msg VARCHAR(500) NOT NULL, pict VARCHAR(50) NOT NULL, author VARCHAR(10) NOT NULL, posted TIMESTAMP)";

   $ret = mysql_query($sql, $link);
   if (!$ret){
    echo "Error: " . mysql_error();
    mysql_close($link);
    exit;
   } else {
    echo 'Topic table created successfully';
   }
   mysql_close($link);
   header('Location: index.php');
  }
   
 }
?>
