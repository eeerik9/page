<?php
 include("db_connect.php");

 session_start();
 
 if (isset($_POST['stlacil'])) {
  if (empty($_POST['meno']) || empty($_POST['heslo'])) {
   $error ="Username or Password is invalid";
  } else {
  
   $meno = mysql_escape_string($_POST['meno']);
   $heslo = mysql_escape_string($_POST['heslo']);

   $link = get_link();
  
   $sql = "SELECT * FROM forum_login WHERE author='{$meno}' AND number='{$heslo}'";
  
   $ret = mysql_query($sql, $link);
  
   $num_rows = mysql_num_rows($ret);
   
   if($num_rows == 1) {
    $_SESSION['prihlaseny']=$meno;
    header("Location: index.php");
   } else {
    $error="Nespravne Meno alebo Heslo";
   }
  
   
   mysql_close($link);
  }
 }


?>
