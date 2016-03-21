<html>

 <head>
<title>XXXXX</title>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="shortcut icon" href="images/fish.ico" />
</head>
<body>
	<?php include("index_navigation.php"); ?>
        
        <div id="mycontent">

	<?php
		$page = $_GET['page'];	/* gets the variable $page */
		if (!empty($page)) {
			include($page);
		} 	/* if $page has a value, include it */
		else {
			include('home.php');
		} 	/* otherwise, include the default page */
	?>
        
        </div>
        
<h1 id="author">Hosted by: <a target="_blank" href=" http://www.000webhost.com/"> http://www.000webhost.com/</a></h1>

</body>
</html>
