<?php 
 include ("files/form_name.php");
  $target_dir = "uploads/"; 
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); 
 $uploadOk = 1; 
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); 
 // Check if image file is a actual image or fake image 
 if(isset($_POST["submit"])) {    
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);     
  if($check !== false) {         
   echo "File is an image - " . $check["mime"] . ".";         
   $uploadOk = 1;     
  } else {         
   echo "File is not an image.";         
   $uploadOk = 0;     }
 } 
 // Check if file already exists 
 if (file_exists($target_file)) {     
  echo "Sorry, file already exists.";     
  $uploadOk = 0; 
 } 
 // Check file size 
 if ($_FILES["fileToUpload"]["size"] > 200000) {     
  echo "Sorry, your file is too large.";     
  $uploadOk = 0; 
 } 
 // Allow certain file formats 
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {     
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";     
  $uploadOk = 0; 
 } 
 // Check if $uploadOk is set to 0 by an error 
 if ($uploadOk == 0) {     
  echo "Sorry, your file was not uploaded."; 
  // if everything is ok, try to upload file 
 } else {    
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {         
   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";     
 
  $servername = "localhost";                                                                                                         
 $username = "recon_qss";                                                                                                              
 $password = "recon_qss";                                                                                                              
 $database = "database1";                                                                                                              
 // Create connection                                                                                                                  
 $link = mysql_connect("$hostname", "$username", "$password");                                                                         
        if (!$link) {                                                                                                                  
            echo "<p>Could not connect to the server '" . $hostname . "'</p>\n";                                                       
            echo mysql_error();                                                                                                        
        }else{                                                                                                                         
            echo "<p>Successfully connected to the server '" . $hostname . "'</p>\n";                                                  
          printf("MySQL client info: %s\n", mysql_get_client_info());                                                                  
          printf("MySQL host info: %s\n", mysql_get_host_info());                                                                      
          printf("MySQL server version: %s\n", mysql_get_server_info());                                                               
          printf("MySQL protocol version: %s\n", mysql_get_proto_info());                                                              
        }  
   if ($database) {
    $dbcheck = mysql_select_db("$database");
        if (!$dbcheck) {
            echo mysql_error();                                                                                                        
        }else{                                                                                                                         
            echo "<p>Successfully connected to the database '" . $database . "'</p>\n";  
           $formular = $form_name;                                                                                                    
            $text = $target_file;                                                                                                    
            $sql = "INSERT INTO $formular (text, timestamp, ispic)                                                                     
                   VALUES ('$text', now(), 1)";                                                                                        
            if (!mysql_query($sql, $link)) {                                                                                           
             die("Error: " . $sql . "</br>" . $link->error);                                                                           
                                                                                                                                     
        }                                                                                                                              
                echo "New record created successfully";                                                                                
mysql_close($link);                                          
header( 'Location: form.php' ) ; 
 } 
}

  } else {         
   echo "Sorry, there was an error uploading your file.";     
  } 
}
?> 
