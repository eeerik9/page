<?php
 echo '
  <html>
   <head>
   <title>Pravdajelenjedna</title>
   <link rel="shortcut icon" href="images/favicon-16x16.png" />
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
     "vitaj" => "vitaj.php",
     "ktosom" => "ktosom.php",
     "veda" => "veda.php",
     "zdroje" => "zdroje.php",
     "informacie" => "informacie.php",
     "preco" => "preco.php",
     "slovnik" => "slovnik.php",
     "prispej" => "prispej.php",
     "dakujem" => "dakujem.php",
     "vedeckaspolocnost" =>"vedeckaspolocnost.php",
    );
    echo '</div>';
    echo '<div id="content">';
    if (isset($_GET["str"])) {
     include($navi_array[$_GET["str"]]);
    } else {
     include("vitaj.php");
    }
    echo '</div>';
 echo '
   </body>
  </html>
 ';
?>			