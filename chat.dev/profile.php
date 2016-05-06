<?php
 include('session.php');
 session_start();
 $_SESSION['page1opens']++;
?>
<html>
 <head>
  <title>Your Home Page</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  </script>
  <script type="text/javascript"
   src="http://code.jquery.com/jquery-1.10.2.min.js">
  </script>

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

   $result = mysql_query("SELECT * FROM msgs ORDER BY timestamp ASC");
   while ($row = mysql_fetch_assoc($result)) {    
    $username = $row['username'];
    $from_to = explode("->", $username);

    $timestamp = $row['timestamp']; // 2016-04-09 09:56:24
    $date_time = explode(" ", $timestamp); // creates array
    $timestamp = $date_time[1];
                                                     
    $msg = $row['msg'];
                                                    
    echo " <B>".$from_to[0].'</B> <small>'.$timestamp."</small><br/>";
    echo $msg."<br/><br/>";
   }

   ?>
  </div>
 </div>

 <div id="write">
  <div  style="width:100%">

   <form action="send.php" method="post" id ="target" >
    <textarea rows="6" placeholder="text to write" name="msg_area" onkeypress="sendMsg(event)"  style="width:100%; background-color:transparent;"></textarea><br>

    <input id ="submit_but" name="submit" type="submit" value="Send" style=" display: block; width: 100%;" >
   
   <script src="/resources/events.js"></script>
   <script>
   function sendMsg(e){
     // alert("Key hit!");
        if(e.keyCode =='13' || e.which == '13')  // the enter key code
        {
         //alert("Enter hit!");
         $('#submit_but').trigger('click');
        }
   } 
   </script>
   </form>
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
