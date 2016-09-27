<?php
include("db_connect.php");
echo "loaded...<br />";
$link = get_link();
// SQL query to fetch information of registerd users and finds user match.
$sql="SELECT * FROM chat_login_sessions";
$ret=mysql_query($sql, $link);
echo "<br/>";
while ($row =mysql_fetch_assoc($ret)) {
    echo '<a href="profileuserdisplay.php?user='.trim($row['username']).'" target="_top">'.trim($row['username']).'</a><br/>';
}
mysql_close($link);
?>


