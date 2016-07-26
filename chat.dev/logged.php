<?php
include("db_connect.php");
echo "loaded...<br />";
$link = get_link();
// SQL query to fetch information of registerd users and finds user match.
$ret = pg_query(
        $link,
        "SELECT * FROM login_sessions"
       );

echo "<br/>";
while ($row =pg_fetch_assoc($ret)) {
    echo $row['username'] . "<br/>";
}
pg_close($link);
?>


