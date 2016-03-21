<?php
	$servername = "localhost";
	$username = "erik";
	$password = "nikanika";
	$dbname = "database1";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	// var_dump($_POST);
	$first = $_POST['firstname'];
	$last = $_POST['lastname'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$email =$_POST['email'];
	$sql = "INSERT INTO users (firstname, lastname, username, password, email)
	VALUES ('$firstname', '$lastname', '$user', '$pass', '$email')";

	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	header("Location: index.php"); // redirect back to your contact form
	exit;

?>