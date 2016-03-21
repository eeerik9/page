<?php
include('session.php');
?>

<html>
<head>
<title>XXXX Library</title>
<link href="../index.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../images/fish.ico" />
</head>
<body>

<?php include("profile_navigation.php"); ?>

<div id="mycontent">

<?php
		$page = $_GET['page'];	/* gets the variable $page */
		if (!empty($page)) {
			include($page);
		} 	/* if $page has a value, include it */
		else {
			include('books.php');
		} 	/* otherwise, include the default page */
	?>
        
</div>

</body>
</html>