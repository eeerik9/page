<?php
 session_start(); 
 $error=''; 
 if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password'])) {
   $error = "Username or Password is invalid";
  } else {
   $username=$_POST['username'];
   $password=$_POST['password'];
   // Establishing Connection with Server by passing server_name, user_id and password as a parameter
   $link = mysql_connect("localhost", "recon_qss", "recon_qss");
   // To protect MySQL injection for Security purpose
   $username = mysql_real_escape_string(stripslashes($username));
   $password = mysql_real_escape_string(stripslashes($password));
   // Selecting Database
   $db = mysql_select_db("database1", $link);
   // SQL query to fetch information of registerd users and finds user match.
   $query = mysql_query("select * from login where password='$password' AND username='$username'", $link);
   $rows = mysql_num_rows($query);
   if ($rows == 1 ) {
    $nick = $username;
    $_SESSION['login_user']=$username; // Initializing Session
    $_SESSION['nick_user']=$nick;
    header("location: profile.php"); // Redirecting To Other Page
   } else { 
    $error =  "Username or Password is invalid";
  }
 }
 mysql_close($link); // Closing Connection
}
?>
