<?php
 echo '
  <html>
   <head>
    <style>
     body {
      line-height: 2.0;
     }
    </style>
   </head>
   <body>';
    echo '<div id="menu">';
    include("menu.php");
    $navi_array = array(
     "veda" => "veda.php",
     "zdroje" => "zdroje.php",
     "informacie" => "informacie.php",
     "preco" => "preco.php",
     "slovnik" => "slovnik.php",
     "prispej" => "prispej.php",
     "vedeckaspolocnost" =>"vedeckaspolocnost.php",
    );
    echo '</div>';
    echo '<div id="content">';
    if (isset($_GET["str"])) {
     include($navi_array[$_GET["str"]]);
    } else {
     include("veda.php");
    }
    echo '</div>';
 echo '
   </body>
  </html>
 ';
?>		