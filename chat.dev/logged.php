<?php
echo "loaded...<br />";

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "eeerik9", "nikanika");

// Selecting Database
$db = mysql_select_db("eeerik9", $connection);

// SQL query to fetch information of registerd users and finds user match.

$result = mysql_query("SELECT * FROM login_sessions", $connection);

echo "<br />";
while ($row = mysql_fetch_assoc($result)) {

    echo $row['username'] . "<br />";
}

?>


