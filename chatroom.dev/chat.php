<?php
 include('session.php');
 session_start();
 $_SESSION['page1opens']++;
 if (isset($_GET['na'])){
  $_SESSION['chatroom'] = $_GET['na'];
 }
?>
<html>
 <head>
  <title>Your Home Page</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js">
  </script>
  <script>
   $(document).ready(function(){
    $("#text1").load("chattext.php");
   });
   $(document).ready(function(){
    $("#refresh").load("logged.php");
   });
  </script> 
 </head>
 <body>
  <div id="all">

   <div id="left">

    <div id="me">
     <div id="text">
      <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>;
     <b><a href="home.php"> Home</a>
     <a href="profileuserdisplay.php"> MyProfile</a>
     <a href="allprofiles.php"> AllProfiles</a></b>
     <b id="logout"><a href="logout.php">Logout</a></b>;
     <b><a href="deleteprofile.php">DeleteAll</a></b>;</br>
     <b> <?php echo "Chatroom: ". $_SESSION['chatroom']; ?> </b></br>
     </div>
    </div>

 <div id="chat">
  <div id="text1">
  </div>
   
 </div>

 <div id="write">
  <div  style="width:100%">

   <form action="send.php" method="post" id ="target">
    <input type="text" placeholder="text to write" name="msg_area" onkeypress="sendMsg(event)" style="width:100%;"/></br>

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
 </div>
</div>

</div>

</body>
</html>	
