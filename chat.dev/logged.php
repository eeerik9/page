<?php
require_once("../db/connectdb.php");
echo "loaded...<br />";
$mydb = new db();
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "eeerik9", "nikanika");
$mydb->db_set("localhost", "recon_qss", "recon_qss");
$connection = $mydb->db_connect();
// Selecting Database
$mydb->db_change("database1");

// SQL query to fetch information of registerd users and finds user match.

$result = mysql_query("SELECT * FROM login_sessions", $connection);

echo "<br />";
while ($row = mysql_fetch_assoc($result)) {

    echo $row['username'] . "<br />";
}

?>


