<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['loggeduser'])){
header("location: profile.php");
}
?>
<html>
<head>
	<title>MySite</title>
	
<script type="text/javascript"
    src="http://code.jquery.com/jquery-1.10.2.min.js">
  
</script>
	
</head>
<body>
	<form action="" method="post" id="form1">
  		Meno:<br>
  		<input type="text" name="username"><br>
  		Heslo:<br>
  		<input name="password" placeholder="**********" type="password"><br>
 	<br>

	<input type="submit" name="submit"  value="Prihlasit">
	</form>
	<form action="forgotpass.php" ><input type="submit" value="Nove heslo"></form>
	<form action="register.php" ><input type="submit" value="Registrovat"></form>

   


<!-- setInterval(
    $("#refresh").load("logged.php"), 3000); -->


</div>
</body>
</html>
