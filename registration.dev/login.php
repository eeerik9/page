<?php
	session_start();
	$error = '';
	echo "1";
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
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
			$password = $_POST['password'];
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysql_real_escape_string($username);
			$password = mysql_real_escape_string($password);
			var_dump($username);
			var_dump($password);
			
			$query = mysql_query("SELECT * FROM users WHERE username='$username' and password='$password'",$conn);
			var_dump($query);			
			$rows = mysql_num_rows($query);
			echo $rows;
			echo "6";
			if ($rows == 1){
				$_SESSION['loggeduser']=$username;
				echo "7";
				header("location: profile.php");
				
			} else {
				echo "8";
				//var_dump($username);		
				//var_dump($password);		
				$error = "Username or Password is invalid";	
			}
			mysql_close($conn); // Closing Connection
		
}
	
} else {
	echo "4";
}
?>