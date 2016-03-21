<html>
<head>
<link rel="stylesheet" type="text/css" href="computers.css">
</head>
<body>
	<nav>
	  <ul>
                <li>
		  <a href="computers.php?page=linux.php">Linux</a>
		</li>
                 <li>
		  <a href="computers.php?page=kernel.php">Linux Kernel</a>
		</li>
                 <li>
		  <a href="computers.php?page=embeded.php">Linux Embeded</a>
		</li>
                 <li>
		  <a href="computers.php?page=sockets.php">Linux Sockets</a>
		</li>
                <li>
		  <a href="computers.php?page=debian.php">Debian</a>
		</li>
                <li>
		  <a href="computers.php?page=freebsd.php">FreeBSD</a>
		</li>
                <li>
		  <a href="computers.php?page=windows.php">Windows</a>
		</li>
		<li>
		  <a href="computers.php?page=oracle.php">Oracle</a>
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
			include('linux.php');
		} 	/* otherwise, include the default page */
	?>

</div>

</body>
</html>