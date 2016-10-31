<?php
function get_link() {
 include("credentials.php");	
 // Database connection 
 $link = null;
 //echo "Connect\n";
 $link = pg_connect ("$host $port $dbname $cred" );
 //echo "Connected call </br>";
 if (!$link) {
  //echo "Error: Unable to open database </br>";
  var_dump (__LINE__, __FUNCTION__);
  exit;
 } else {
  //echo "Opened database successfully </br>";
  return $link;
 }
}
?>
