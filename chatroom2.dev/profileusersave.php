<?php
include("session.php");
session_start();

$username = mysql_escape_string($_POST["username"]);
$whoami =  mysql_escape_string($_POST["whoami"]);
$resources = mysql_escape_string($_POST["resources"]);
$give = mysql_escape_string($_POST["give"]);
$receive = mysql_escape_string($_POST["receive"]);
$contact =  mysql_escape_string($_POST["contact"]);
$link = get_link();
$sql= "SELECT * from chat_profile WHERE username ='{$username}'";
$ret= mysql_query($sql, $link);

if ($ret){ echo "OK</br>";} else {echo "KO</br>";}
$num_rows = mysql_num_rows($ret);
if($num_rows == 0) {
 $sql="INSERT INTO chat_profile (username, whoami, resources, give, receive, contact)
         VALUES ('{$login_session}', '{$whoami}', '{$resources}','{$give}', '{$receive}', '{$contact}')";
 $ret = mysql_query($sql, $link);
 
  echo "INSERT: ";if ($ret) {echo "OK</br>";} else {echo "KO</br>";}
} else {
  $sql ="UPDATE chat_profile SET whoami='{$whoami}',resources='{$resources}' ,give='{$give}',receive='{$receive}',contact='{$contact}' WHERE username='{$username}'";
  $ret = mysql_query($sql, $link);
 echo "UPDATE: ";if ($ret) {echo "OK</br>";} else {echo "KO</br>";} 
} 
mysql_close($link);
header('Location: profileuserdisplay.php');
?>
