<html>
 <head>
  <style>    textarea {width:100%;height:50px;border:1px solid black;padding:2px 4px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}   </style>
 </head>
 <body>
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
  }else{  

   echo "<p>Successfully connected to the database '" . $database . "'</p>\n"; 
   // Check table formular
   $formular = "forms_names";
   $to_edit = $_POST['to_edit'];
   if (isset($_POST['remove'])){
    // select table name
    $sql = "SELECT * FROM `$formular` WHERE id='$to_edit'";     
    $result = mysql_query($sql,$link);     
    if ($result) {     echo "Record selected successfully"; } else {     echo "Error selecting record:" . $link->error; }
    $row = mysql_fetch_array($result);
    $table_name = $row['name'];
    // delete table name from forms_names
    $sql = "DELETE FROM `$formular` WHERE id='$to_edit'";
    $result = mysql_query($sql,$link);
    if ($result === TRUE) {     echo "Record deleted successfully"; } else {     echo "Error deleting record:" . $link->error; }
    
    $sql = "DROP TABLE $table_name";
    $result = mysql_query($sql,$link);
    if ($result === TRUE) {     echo "Table dropped"; } else {     echo "Error dropping table:" . $link->error; }

    header("Location: index.php");
   }
   if (isset($_POST['edit'] )){
    $sql = "SELECT * FROM `$formular` WHERE id='$to_edit'";     
    $result = mysql_query($sql,$link);     
    if ($result) {     echo "Record selected successfully"; } else {     echo "Error selecting record:" . $link->error; }
    
    $row = mysql_fetch_array($result);
    echo '
    <form action="edit_form.php" method="post">    <textarea name="edit_area">'. $row["name"].'</textarea> <input type="hidden" name="to_edit" value="'.$_POST['to_edit'].'"><input type="submit">    </form> ';
   }
  }
 }
?>
 </body>
</html>
