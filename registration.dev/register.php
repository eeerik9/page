<html>
<head>
		
<script type="text/javascript"
    src="http://code.jquery.com/jquery-1.10.2.min.js">
    </script>
</head>
<body>
<form action="updatedb.php" method="post" id="form2">
  		Meno:<br>
  		<input type="text" name="firstname" required="required" pattern="[A-Z]{1}[a-z]{1,29}"><br>
  		Priezvisko:<br>
  		<input type="text" name="lastname" required="required" pattern="[A-Z]{1}[a-z]{1,29}"><br>
  		Prihlasovacie meno:<br>
  		<input type="text" name="username" required="required" pattern="[a-zA-Z_]{3,}[0-25]*"><br>
  		Email:<br>
  		<input type="text" name="email" required="required" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"><br>
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