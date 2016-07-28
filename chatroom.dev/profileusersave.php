<?php
include("session.php");
session_start();

$username = pg_escape_string($_POST["username"]);
$whoami =  pg_escape_string($_POST["whoami"]);
$resources = pg_escape_string($_POST["resources"]);
$give = pg_escape_string($_POST["give"]);
$receive = pg_escape_string($_POST["receive"]);
$contact =  pg_escape_string($_POST["contact"]);
$link = get_link();
$ret = pg_query(
 $link,
 "SELECT * from profile WHERE username ='{$username}'"
);
if ($ret){ echo "OK</br>";} else {echo "KO</br>";}

$num_rows = pg_num_rows($ret);
if($num_rows == 0) {
 $ret = pg_query(
  $link,
  "INSERT INTO profile (username, whoami, resources, give, receive, contact)
  VALUES ('{$login_session}', '{$whoami}', '{$resources}','{$give}', '{$receive}', '{$contact}')"
 );
  echo "INSERT: ";if ($ret) {echo "OK</br>";} else {echo "KO</br>";}
} else {
  $ret = pg_query(
  $link,
  "UPDATE profile SET whoami='{$whoami}',resources='{$resources}' ,give='{$give}',receive='{$receive}',contact='{$contact}' WHERE username='{$username}'"
 );
 echo "UPDATE: ";if ($ret) {echo "OK</br>";} else {echo "KO</br>";} 
} 
pg_close($link);
header('Location: profileuserdisplay.php');
?>
