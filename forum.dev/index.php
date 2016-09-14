<html>
 <head>
  <title>Forum
  </title>
 </head>
 <body>
  <center>
|<a href="http://pravdajelenjedna.info">Pravdajelenjedna</a>

<?php
 session_start();
 if (isset($_SESSION['prihlaseny'])){
  echo '|<a href="odhlasit.php">Odhlas</a>|';
 } else {
  echo '|<a href="prihlas.php">Prihlas</a>|';
 }
?>
 
</br></br>
  </center>
  <?php
   include("forum.php");
  ?>
 </body>
</html>
