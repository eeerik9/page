<?php
 include ("db_connect.php");
 
  session_start();
  if (!isset($_SESSION['prihlaseny'])){
   echo "Neprihlaseny";
   exit;
  }

  if (isset($_POST['stlacil'])){
   $id = mysql_escape_string( $_POST['tema']);
   
   $link = get_link();
   
   $sql = "DELETE FROM forum_topics WHERE id=$id";
  
   $ret = mysql_query($sql, $link);
   
   if (!$ret) {
    echo "Error: ". mysql_error();
    exit;
   } else {
    echo "Topic deleted successfully";
    header("Location: index.php");
   }
   
  }
?>
