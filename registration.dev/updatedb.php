<?php
	require_once('connectdb.php');
	$conn = connect_db();
	// var_dump($_POST);
	
	$first = $_POST['firstname']; $first = escape_fields($first);
	$last = $_POST['lastname']; $last = escape_fields($last);
	$user = $_POST['username']; $user = escape_fields($user);
	$pass = $_POST['password']; $pass = escape_fields($pass);
	$pass1 = $_POST['password1']; $pass1 = escape_fields($pass1);
	$email =$_POST['email']; $email = escape_fields($email);
	
	$hash = md5( rand(0,1000) );
	
	if (strcmp($pass, $pass1) !== 0){
		echo "The passwords do not match";
		header("Location: register.php"); // redirect back to your contact form
		exit;
	}
	
	$sql = "INSERT INTO users (firstname, lastname, username, password, email)
	VALUES ('$first', '$last', '$user', '$pass', '$email')";


	
	if (mysql_query($sql,$conn) === TRUE) {
    	echo "New record created successfully";
    } else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
    	
	}

	$conn->close();
	
	$to      = $email; // Send email to our user
	$subject = 'Signup | Verification'; // Give the email a subject 
	$message = '
 
	Thanks for signing up!
	Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
	------------------------
	Username: '.$user.'
	Password: '.$pass.'
	------------------------
 
	Please click this link to activate your account:
	http://eeerik93.dev/verify.php?email='.$email.'&hash='.$hash.'
 
	'; // Our message above including the link
                     
	$headers = 'From:noreply@eeerik93.dev' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
?>