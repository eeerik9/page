<html>
<head>
		
<script type="text/javascript"
    src="http://code.jquery.com/jquery-1.10.2.min.js">
    </script>
</head>
<body>
<form action="updatedb.php" method="post" id="form2">
  		Meno:<br>
  		<input type="text" name="firstname"><br>
  		Priezvisko:<br>
  		<input type="text" name="lastname"><br>
  		Prihlasovacie meno:<br>
  		<input type="text" name="username"><br>
  		Email:<br>
  		<input type="text" name="email"><br>
  		Heslo:<br>
  		<input name="password" placeholder="**********" type="password"><br>
  		Heslo:<br>
  		<input name="password1" placeholder="**********" type="password"><br>
  		
  		<input type="submit"  value="Registrovat">
</form>
<br><br>
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

</body>

</html>