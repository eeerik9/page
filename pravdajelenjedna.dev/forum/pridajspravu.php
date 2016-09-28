<?php
 include ("db_connect.php");
 $target_dir = "subory/";
 $target_file = $target_dir . basename($_FILES["obrazok"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 // Check if image file is a actual image or fake image 
 if(isset($_POST["stlacil"])) {
  $check = getimagesize($_FILES["obrazok"]["tmp_name"]);
  if($check !== false) {
   echo "File is an image - " . $check["mime"] . ".</br>";
   $uploadOk = 1;
  } else {
   echo "File is not an image.</br>";
   $uploadOk = 0;     }
 }
 
 // Check if file already exists 
 if (file_exists($target_file)) {
  echo "Sorry, file already exists.</br>";
  $uploadOk = 0;
 }
 
 // Check file size 
 if ($_FILES["obrazok"]["size"] > 200000) {
  echo "Sorry, your file is too large.</br>";
  $uploadOk = 0;
 }
 
 // Allow certain file formats 
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.</br>";
  $uploadOk = 0;
 }

 // Check if $uploadOk is set to 0 by an error 
 if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.</br>";
  
  // if everything is ok, try to upload file 
 } else {
  if (move_uploaded_file($_FILES["obrazok"]["tmp_name"], $target_file)) {
   echo "The file ". basename( $_FILES["obrazok"]["name"]). " has been uploaded.</br>";
  
   // Update message
   if (isset($_POST['stlacil'])){
    $sprava = mysql_escape_string(trim($_POST['sprava']));
    
    session_start();
    if (isset($_SESSION['prihlaseny'])){
     $link = get_link();
     $name = mysql_escape_string(trim($_POST['tema']));
     $author = trim($_SESSION['prihlaseny']);
     $sql = "INSERT INTO $name (msg, pict, author) VALUES ('{$sprava}', '{$target_file}','{$author}')";
     $ret = mysql_query($sql, $link);
     if (!$ret){
      echo "Error: " . mysql_error();
      mysql_close($link);
      exit;
     } else {
      echo "Message successfully inserted.</br>";
      mysql_close($link);
      header("Location: tema.php?n=".$name);
     }
    }
   }
  } 
 }
?>
