<?php
include('session.php');
session_start();
$_SESSION['page1opens']++;
?>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script>
function myFunction(val) {
   localStorage.setItem("sel", val);
}

function loadVar() {
     document.getElementsByName("_writeto")[0].value=localStorage.getItem("sel");
     document.getElementsByName("msg_area")[0].value=localStorage.getItem("text");
}
window.onload = loadVar;
</script>
<script type="text/javascript"
    src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

</head>
<body>
<div id="all">

<div id="left">

<div id="me">
 <div id="text">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>
</div>

<div id="chat" scrolled="true">
<div id="text">
Chatting:<br />
<?php
session_start();
$time = time ();

$result = mysql_query("SELECT * FROM msgs ORDER BY timestamp DESC");
 while ($row = mysql_fetch_assoc($result)) {

        $timestamp = $row['timestamp'];
        $username = $row['username'];
        $msg = $row['msg'];
        echo $timestamp." ".$username."<br/>";
        echo $msg."<br/>";
}

?>
</div>
</div>

<div id="write">
<div  style="width:100%">

<form action="send.php" method="post">
<textarea rows="2" placeholder="text to write" name="msg_area"   style="width:100%; background-color:transparent;"></textarea><br>

<input name="submit" type="submit" value="Send" style=" display: block; width: 100%;" >

<select name="_writeto"  onchange="myFunction(this.value)" style=" display: block; width: 100%;">
<option value="None" <?php if (strcmp($_SESSION['writeto'], 'None') == 0) {echo "selected='selected'";} ?> >None</option>
<option value="All"  <?php if (strcmp($_SESSION['writeto'], 'All') == 0)  {echo "selected='selected'";}  ?> >All</option>
<?php
 session_start();
 $result = mysql_query("SELECT * FROM login_sessions");
 while ($row = mysql_fetch_assoc($result)) {
  echo "<option value=\"";
  echo $row['username']."\" ";
  if (strcmp($_SESSION['writeto'], $row['username']) == 0)  {echo "selected='selected'";}
  echo ">";
  echo $row['username'];
  echo "</option>";
 }
?>
</select>

</div>
</div>

</div>

<div id="logged">
<div id="text">
<div id="refresh">

</div>

<script>
function loadlink(){
    $('#refresh').load('logged.php');
}
loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 3 seconds
}, 3000);

</script>


<!-- setInterval(
    $("#refresh").load("logged.php"), 3000); -->


</div>
</div>

</div>

</body>
</html>	