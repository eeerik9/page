<?php
	require_once('../db/connectdb.php');
	session_start();
	$error = '';
	echo "1";
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
			echo "2";
		} else {
		 	echo "3";
			$conn = connect_db();
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$username = escape_fields($username);
			$password = escape_fields($password);
			// var_dump($username, __LINE__);
			// var_dump($password, __LINE__);
		        echo "4";	
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
