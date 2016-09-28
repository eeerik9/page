<?php
include("session.php");
session_start();
$link = get_link();
$sql="SELECT * FROM chat_profile";
$ret=mysql_query($sql, $link);
echo '<a href="home.php">Home</a>; <a href="logout.php">Logout</a></br>';
echo "User Names:</br>";
while($row = mysql_fetch_assoc($ret)){
 echo '<a href="profileuserdisplay.php?user='.$row['username'].'"target="_top">'.$row['username'].'</a>;';
}
mysql_close($link);
?>
