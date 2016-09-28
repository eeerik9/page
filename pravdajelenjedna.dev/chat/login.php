<?php
 include("db_connect.php");
 // Starting session
 session_start(); 
 // Check if submit form is full
 if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password'])) {
  $error = "Username or Password is invalid";
 } else {
  // Extract login from post form
  $username=$_POST['username'];
  $password=$_POST['password'];
  // Escape string if injection
  $username = mysql_escape_string($username);
  $password = mysql_escape_string($password);
  // Get db connection
  $link = get_link();
  //if($link) {echo "OK</br>";} else {echo "KO</br>";}
  // Check if user exists
  $sql= "SELECT * FROM chat_login WHERE password = '{$password}' AND username = '{$username}'";
  $ret = mysql_query($sql, $link);
  //if ($ret) {echo "OK</br>";} else {echo "KO</br>";} 
  // Check number of selected rows 
  $num_rows = mysql_num_rows($ret); 
  if ($num_rows == 1) {
   $_SESSION['login_user']=$username; // Initializing Session
   
   // Update who is signed
   $sql= "INSERT INTO chat_login_sessions (username) VALUES ( '{$username}' )";
   mysql_query($sql, $link);
   header("Location: chat.php"); // Redirecting To Other Page
  } else {
   $error = "Username or Password is invalid";
  }
  mysql_close($link);
 }
}
?>
