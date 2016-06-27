<?php
include("show_forum.php");
echo '
<html>
 <head>
  <style>
   textarea {width:100%;height:50px;border:1px solid black;padding:2px 4px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
  </style>
 </head>
 <body>
  <form action="insert_form.php" method="post">
   <textarea name="area">Area</textarea>
   <input type="submit"> 
  </form>
 </body>
</html>'
?>
