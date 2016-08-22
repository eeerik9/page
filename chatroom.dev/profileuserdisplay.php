<?php
include("session.php");
session_start();
$link = get_link();
if(!isset($_GET['user'])) {
$user = $login_session;
} else {
$user = $_GET['user'];
}

$ret = pg_query(
$link,
"SELECT * FROM profile WHERE username='{$user}'"
);
$rows = pg_fetch_assoc($ret);
echo '
<html>
<body>
<b><h1>'.$user.'</h1></b>
<a href="chat.php">Chat</a>; <a href="allprofiles.php">AllProfiles</a>; <a href="logout.php">Logout</a></br>

<form action="profileuserchange.php" method="post" id="profiledisplay">
Foto:</br>
<img src="'.$rows["photo"].'"></br>
<label>'.$rows["photo"].'</label></br>
Meno:</br>
<label style="display:block; width:100%; border-style: solid; border-width: 1px; border-color:#A8A8A8;border-radius: 2px;">'.$user.'</label>

Kto som:</br>                 
<label style="display:block; width:100%; border-style: solid; border-width: 1px; border-color:#A8A8A8;border-radius: 2px;"><pre>'.$rows["whoami"].'</pre></label>

Zdroje:<br>
<label style="display:block; width:100%; border-style: solid; border-width: 1px; border-color:#A8A8A8;border-radius: 2px;">'.$rows["resources"].'</label>
Darujem:<br>
<label style="display:block; width:100%; border-style: solid; border-width: 1px; border-color:#A8A8A8;border-radius: 2px;">'.$rows["give"].'</label>
Prijmem:<br>
<label style="display:block; width:100%; border-style: solid; border-width: 1px; border-color:#A8A8A8;border-radius: 2px;">'.$rows["receive"].'</label>

Kontakt:<br>
<label style="display:block; width:100%; border-style: solid; border-width: 1px; border-color:#A8A8A8;border-radius: 2px;">'.$rows["contact"].'</label>';

if (strcmp(trim($user), trim($login_session)) == 0){ echo '
<input style="width:100%;" type="submit" value="Zmenit">
';
}
echo '
</body>
</html> ';
pg_close($link);
?>

