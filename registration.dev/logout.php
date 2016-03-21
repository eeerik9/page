<?php
session_start();
session_destroy();
echo "Uspesne odhlasenie";
echo "<a href=\"index.php\">Formular</a>";
?>