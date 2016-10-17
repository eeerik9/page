<?php
 include ("db_connect.php");
 
  session_start();
  if (!isset($_SESSION['prihlaseny'])){
   echo "Neprihlaseny";
   exit;
  }

  if (isset($_POST['stlacil'])){
   $id = mysql_escape_string( $_POST['tema']);
   $name = mysql_escape_string( $_POST['meno']); 
   $link = get_link();
   
   //remove images
   $sql = "SELECT pict FROM $name";
   $ret = mysql_query($sql, $link);
   if (!$ret) {
    echo "Error: ". mysql_error();
    mysql_close();
    exit;
   } else {
    while ($row = mysql_fetch_row($ret)){
     if (strcmp($row[0], "") !=="") {
      unlink($row[0]);
     }
    }
   }
    
   $sql = "DROP TABLE $name";
   
   $ret = mysql_query($sql, $link);
   
   if (!$ret) {
    echo "Error: ". mysql_error();
    mysql_close($link);
    exit;
   } else {
    echo "Topic table deleted successfully. </br>";

    $sql = "DELETE FROM forum_topics WHERE id=$id";
  
    $ret = mysql_query($sql, $link);
   
    if (!$ret) {
     echo "Error: ". mysql_error();
     mysql_close($link);
     exit;
    } else {
     echo "Topic deleted successfully";
     mysql_close($link);
     header("Location: index.php");
    }
   }
   
  }
?>
