<?php
include("session.php");
session_start;
$link = get_link();

$ret = pg_query(
 $link,
 "SELECT * FROM profile WHERE username='{$login_session}'"
);
$rows = pg_fetch_assoc($ret);

echo '

<html>
<body>
<form action="uploadfoto.php" method="post" enctype="multipart/form-data"> Nahraj fotografiu:</br>
 <input type="file" name="fileToUpload" id="fileToUpload"></br>
 <input type="submit" value="Vloz" name="submit"></br>
</form>
<form action="profileusersave.php" method="post" id="profilechange">
 Foto:</br>
 <img src="'.$rows['photo'].'"></br>
 Meno:</br>
 <input style="width:100%;" type="text" name="username" required="re quired" value="'.trim($rows['username']).'"></br>
 Kto som:<br>                 
 <textarea rows="8" style="width:100%;" name="whoami">'.trim($rows['whoami']).'</textarea></br>
 Zdroje:<br>
 <input style="width:100%;" type="text" name="resources" value="'.trim($rows['resources']).'"></br>
 Darujem:<br>
 <input style="width:100%;" type="text" name="give" value="'.trim($rows['give']).'"></br>
 Prijmem:<br>
 <input style="width:100%;" type="text" name="receive" value="'.trim($rows['receive']).'"></br>              
 Kontakt:<br>
 <input style="width:100%;" type="text" name="contact" value="'.trim($rows['contact']).'"></br>
 <input style="width:100%;" type="submit" value="Ulozit">
</form>
</body>
</html>
' 
?>
