<?php 
include("show_forms.php");
echo '
 <html>
  <head>
   <style>    textarea {width:100%;height:50px;border:1px solid black;padding:2px 4px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}   </style>
  </head>
  <body>

   <form action="insert_form.php" method="post"></br>    <textarea name="form_area">Insert new form, name: </textarea>    <input type="submit" value="Insert form">   </form>
  </body>
 </html>
';
?>
