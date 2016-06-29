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
   $formular = $_POST['form_name'];
   $edit_area = $_POST['edit_area'];
   $to_edit =  $_POST['to_edit'];

   $sql = "DELETE FROM `$formular` WHERE id='$to_edit'";
   $sql = "UPDATE `$formular` SET text='$edit_area' WHERE id='$to_edit'";
   $result = mysql_query($sql,$link);
   if ($result === TRUE) {     echo "Record deleted successfully"; } else {     echo "Error deleting record:" . $link->error; }     header("Location: form.php");
  }
 }
?>
