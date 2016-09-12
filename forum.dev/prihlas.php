<?php
 include('prihlasit.php');
?>
<html>
 <body>
  <center>
   |<a href="index.php">Spat na Forum</a>|
  </center>
  <h2>Prihlas sa na Forum</h2>
  <form action="" method="post"> 
   Pouzivatel:</br>
   <input name="meno" placeholder="meno" type="text"></br>
   Heslo:</br>
   <input name="heslo" placeholder="****************" type="password"></br></br>
   <input name="stlacil" type="submit" value="Prihlasit sa">
   <span><?php echo $error; ?></span>
  </form>
 </body>
</html>
