<?php
session_start(); //Ganz wichtig
 
if(!isset($_SESSION['loggeduser'])) {
   die("Prosim najprv sa prihlas"); //Mit die beenden wir den weiteren Scriptablauf   
}
 
//In $name den Wert der Session speichern
$name = $_SESSION['loggeduser'];
 
//Text ausgeben
echo "Stale sa volas: $name
<a href=\"logout.php\">Logout</a>";
?>