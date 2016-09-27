<?php
echo '
<html>
<body>';
echo "*****Server Info*****</br>";
echo "http_host "; var_dump($_SERVER["HTTP_HOST"]);echo "</br>http_user_agent ";var_dump($_SERVER["HTTP_USER_AGENT"]);echo "</br>server_addr ";var_dump($_SERVER["SERVER_ADDR"]); echo "</br>server_port "; var_dump($_SERVER["SERVER_PORT"]); echo "</br>request_uri ";var_dump($_SERVER["REQUEST_URI"]);echo "</br></br>"; 

echo "*****Chat Room*****</br>";
echo '
<a href="chatlogin.php">Chat</a>
</body>
</html>';
?>

