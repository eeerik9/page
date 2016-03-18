<html>
<head>
<link rel="stylesheet" type="text/css" href="web.css">
</head>
<body>
	<nav>
	  <ul>
                <li>
		  <a href="menu_test.php">Menu Styles</a>
		</li> 
                <li>
		  <a href="web.php?page=php_exec.php">Execute Linux command</a>
		</li>  
                <li>
		  <a href="web.php?page=ssh_connect.php">OpenSSH</a>
		</li>
                 <li>
		  <a href="web.php?page=test.php">Test Jquery JavaScript</a>
		</li>
                <li>
		  <a href="blogs.php">Back</a>
		</li>
		
	  </ul>
	</nav>

 
	<div id="mycontent">

	<?php
		$page = $_GET['page'];	/* gets the variable $page */
		if (!empty($page)) {
			include($page);
		} 	/* if $page has a value, include it */
		else {
			include('php_exec.php');
		} 	/* otherwise, include the default page */
	?>

</div>

</body>
</html>