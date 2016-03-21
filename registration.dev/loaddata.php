<?php

$host = 'localhost';
$user = 'erik';
$pass = 'nikanika';

mysql_connect($host, $user, $pass);

mysql_select_db('database1');

$selectdata = "SELECT firstname, lastname, username,email FROM users ORDER BY id DESC";

$query = mysql_query($selectdata);

while($row = mysql_fetch_array($query))
{

	echo "<p>".$row['firstname']." ".$row['lastname']." ".$row['username']." ".$row['email']."</p>";

}


?>