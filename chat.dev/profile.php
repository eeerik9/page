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
   src="http://code.jquery.com/jquery-latest.js">
  </script>
  <script>
   $(document).ready(function(){
    setInterval(function() {
     $("#text1").load("chattext.php");
     $("#chat").animate({ scrollTop: $(document).height() }, "fast");
    }, 10);
   });

  </script>
  <script>
   $(document).ready(function(){
    setInterval(function() {
     $("#refresh").load("logged.php");
    }, 100);
    });
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
  <div id="text1">
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
 <div id="text2">
  <div id="refresh">
  </div>
<!-- setInterval(
    $("#refresh").load("logged.php"), 3000); -->


 </div>
</div>

</div>

</body>
</html>	
