<?php
function get_link() {
 $dbhost="localhost";
 $dbuser="recon_qss";
 $dbpass="recon_qss";
 $dbname="database1";
 // Database connection 
 $link = null;
 
 // Connect to mysql
 $link = mysql_connect($dbhost, $dbuser, $dbpass);
 if(! $link )
 {
  die('Could not connect: ' . mysql_error());
 }
 // echo 'Connected successfully to mysql</br>';
 
 // Connect to db
 $db_selected = mysql_select_db($dbname, $link);
 if (!$db_selected){
  die ('Could not select db: '. mysql_error());
 }
 // echo 'Db selected successfully</br>';
 
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
