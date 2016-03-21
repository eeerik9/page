<html>
<head>
	<title>MySite</title>
	
<script type="text/javascript"
    src="http://code.jquery.com/jquery-1.10.2.min.js">
  
</script>
	
</head>
<body>
	<form action="welcome.php" method="post" id="form1">
  		Username:<br>
  		<input type="text" name="username"><br>
  		Password:<br>
  		<input name="password" placeholder="**********" type="password"><br>
  		Email:<br>
  		<input type="text" name="email">
	</form>
	<button type="submit" form="form1" value="Submit">Submit</button>
	<br>
	<br>
   <?php echo "************************************************<br>" ?>
   
<div id="refresh">
</div>

<script>
	function loadlink(){
    $('#refresh').load('loaddata.php');
	}  
loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 3 seconds
}, 3000);

</script>


<!-- setInterval(
    $("#refresh").load("logged.php"), 3000); -->


</div>
</body>
</html>
