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
    echo '<a href="profileuserdisplay.php?user='.trim($row['username']).'" target="_top">'.trim($row['username']).'</a><br/>';
}
pg_close($link);
?>


