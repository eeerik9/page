<html>
<head>
<title>TEST</title>
<link rel="stylesheet" type="text/css" href="mystyle_new.css">

</head>

<body>
<?php include("navigation.php"); ?>

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




</body>
</html>