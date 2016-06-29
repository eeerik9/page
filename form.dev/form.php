<?php
include("show_item.php");
echo '
<html>
 <head>
  <style>
   textarea {width:100%;height:50px;border:1px solid black;padding:2px 4px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
  </style>
 </head>
 <body>
  <form action="upload.php" method="post" enctype="multipart/form-data"> Image to upload:</br>     
   <input type="file" name="fileToUpload" id="fileToUpload"></br>  
   <input type="submit" value="Upload Image" name="submit"> </form>
  <form action="insert_item.php" method="post"> Text to upload:</br>
   <textarea name="area">Text to upload: </textarea>
   <label>Label: '.$_POST['form_name'].'</label>
   <input type="hidden" name="form_name" value="'.$_POST['form_name'].'">
   <input type="submit" value="Upload Text"> 
  </form>
 </body>
</html>'
?>
