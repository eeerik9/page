<?php
function get_link() {
 $host ="host=127.0.0.1";
 $port="port=5432";
 $dbname="dbname=policka";
 $cred="user=eeerik9 password=135Ad"; //pgsql pgsql
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
