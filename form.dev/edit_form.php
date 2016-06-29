<?php  
 $servername = "localhost";
 $username = "recon_qss";  
 $password = "recon_qss";  
 $database = "database1";  
 // Create connection     
 $link = mysql_connect("$hostname", "$username", "$password");  
 if ($database) {   
  $dbcheck = mysql_select_db("$database");   
  if (!$dbcheck) {    
   echo mysql_error();   
  } else{     
   echo "<p>Successfully connected to the database '" . $database . "'</p>\n";    
   // Check table formular    
   $formular = "forms_names";
   $edit_area = $_POST['edit_area'];
   $to_edit =  $_POST['to_edit'];
   
   // select table name     
   $sql = "SELECT * FROM `$formular` WHERE id='$to_edit'";     
   $result = mysql_query($sql,$link);     
   if ($result) {     echo "Record selected successfully"; } else {     echo "Error selecting record:" . $link->error; }     
   $row = mysql_fetch_array($result);
   $table_name = $row['name'];

   $sql = "UPDATE `$formular` SET name='$edit_area' WHERE id='$to_edit'";
   $result = mysql_query($sql,$link);
   if ($result === TRUE) {     echo "Record updated successfully"; } else {     echo "Error updating record:" . $link->error; } header("Location: index.php");
  
   $sql = "RENAME TABLE $table_name TO $edit_area";
   $result = mysql_query($sql,$link);
   if ($result === TRUE) {     echo "Record updated successfully"; } else {     echo "Error updating record:" . $link->error; } header("Location: index.php");

  }
 }
?>
