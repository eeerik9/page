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
  $username = pg_escape_string($username);
  $password = pg_escape_string($password);
  // Get db connection
  $link = get_link();
  //if($link) {echo "OK</br>";} else {echo "KO</br>";}
  // Check if user exists
  $ret = pg_query(
   $link,
   "SELECT * FROM login WHERE password = '{$password}' AND username = '{$username}'"
  );
  //if ($ret) {echo "OK</br>";} else {echo "KO</br>";} 
  // Check number of selected rows 
  $num_rows = pg_num_rows($ret); 
  if ($num_rows == 1) {
   $_SESSION['login_user']=$username; // Initializing Session
   
   // Update who is signed
   $ret = pg_query(
    $link,
    "INSERT INTO login_sessions (username)
    VALUES ( '{$username}' )"
   );
   header("Location: profile.php"); // Redirecting To Other Page
  } else {
   $error = "Username or Password is invalid";
  }
  pg_close($link);
 }
}
?>
