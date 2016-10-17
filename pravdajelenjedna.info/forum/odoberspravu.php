<?php
 include ("db_connect.php");
 
 if (isset($_POST['stlacil'])){
  $name = mysql_escape_string($_POST['tema']);
  $id = mysql_escape_string($_POST['id']);
  
  $link = get_link();
  $sql = "SELECT * FROM $name WHERE id = {$id}";
  
  $ret = mysql_query($sql, $link);
  if (!$ret) {
   echo "Error: " . mysql_error();
   mysql_close($link);
   exit;
  } else {
   $row = mysql_fetch_assoc($ret);
   // delete picture
   if (strcmp($row['pict'], "")!==0){
    unlink($row['pict']);
   }
   $sql = "DELETE FROM $name WHERE id = {$id}";
   
   $ret = mysql_query($sql, $link);
   if (!$ret) {
    echo "Error: ". mysql_error();
    mysql_close($link);
    exit;
   } else {
    echo "The message was successfully deleted</br>";
    mysql_close();
    header("Location: tema.php?n=".$name);
   }
  }
 } 
 
?>
