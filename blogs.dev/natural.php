<html>
<head>
<link rel="stylesheet" type="text/css" href="natural.css">
</head>
<body>
	<nav>
	  <ul>
                <li>
		  <a href="natural.php?page=math.php">Advanced Math</a>
		</li>
                <li>
		  <a href="natural.php?page=law.php">Law</a>
		</li>
		<li>
		  <a href="natural.php?page=harmony.php">Living in Harmony</a>
		</li>
                <li>
		  <a href="natural.php?page=phi.php">Golden Ratio</a>
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
			include('law.php');
		} 	/* otherwise, include the default page */
	?>

</div>

</body>
</html>