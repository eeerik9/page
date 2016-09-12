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
   exit;
  } else {
   echo 'Topic inserted successfully</br>';
   header('Location: index.php');
  }
   
 }
?>
