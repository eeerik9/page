<?php
include('login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>

<html>
<head>
<title>XXXX Library</title>
<link href="../index.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/fish.ico" />
</head>
<body>

<?php include("library_navigation.php"); ?>


<div id="mycontent">
<h1>XXXX Library login</h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<label>Conditions : </label>
<input type="checkbox" name="accept" value="value1">
I acknowledge that I comprehend and behave according to Natural Law and its principles<br>
<br>
<label>Guests : </label>
If you wish to enter as a guest, just fill your Username and 0000 as your password<br>

<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>

<h1 id="author">Hosted by: <a target="_blank" href=" http://www.000webhost.com/"> http://www.000webhost.com/</a></h1>
</body>
</html>