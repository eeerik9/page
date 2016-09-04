<?php
include("session.php");
session_start();
$link = get_link();
$ret = pg_query(
 $link,
 "SELECT * FROM profile"
);
echo '<a href="home.php">Home</a>; <a href="logout.php">Logout</a></br>';
echo "User Names:</br>";
while($row = pg_fetch_assoc($ret)){
 echo '<a href="profileuserdisplay.php?user='.$row['username'].'"target="_top">'.$row['username'].'</a>;';
}
?>
