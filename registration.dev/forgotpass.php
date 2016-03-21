<?php
	$error = '';
	echo "1";
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['email'])) {
			$error = "Username or Email is invalid";
			echo "2";
	} else {
		$dbservername = "localhost";
		$dbusername = "erik";
		$dbpassword = "nikanika";
		$dbname = "database1";
		echo "3";
		// Create connection
		$conn = mysql_connect($dbservername, $dbusername, $dbpassword);
		// Check connection
		if ($conn->connect_error) {
			echo "5";
	    	die("Connection failed: " . $conn->connect_error);
		}	 
		mysql_select_db($dbname, $conn);
		
		$username = $_POST['username'];
		$email = $_POST['email'];
		$username = stripslashes($username);
		$email = stripslashes($email);
		$username = mysql_real_escape_string($username);
		$email = mysql_real_escape_string($email;
		
		$query = mysql_query("SELECT * FROM users WHERE username='$username' and email='$email'",$conn);
		var_dump($query);			
		$rows = mysql_num_rows($query);
		echo $rows;
		echo "6";
		if ($rows == 1){
			$to      = $email; // Send email to our user
			$subject = 'Signup | Verification'; // Give the email a subject 
			$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$name.'
Password: '.$password.'
------------------------
 
Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
				
		} else {
			echo "8";
			//var_dump($username);		
			//var_dump($password);		
			$error = "Username or Password is invalid";	
		}
		mysql_close($conn); // Closing Connection
	}
?>	
	<form action="" method="post" id="form1">
		Meno:<br>
  		<input type="text" name="username"><br>
  		Email:<br>
  		<input type="text" name="email"><br>
 	<br>

	<input type="submit" name="submit"  value="Nove heslo">
	</form>
