<?php
 include('session.php');
 session_start();
 $_SESSION['page1opens']++;
?>
<html>
 <head>
  <title>Your Home Page</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <script type="text/JavaScript" src="http://code.jquery.com/jquery-latest.js">
  </script>
  <script>
   $(document).ready(function(){
    $("#chats").load("chats.php");
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
      <b><a href="profileuserdisplay.php"> MyProfile</a></b>;
      <b><a href="allprofiles.php"> AllProfiles</a></b>;
      <b id="logout"><a href="logout.php">Logout</a></b>;
      <b><a href="deleteprofile.php">DeleteAll</a></b>
     </div> <!-- div "text" -->
    </div> <!-- div "me" -->
    
    <div id="chatroom">
     <form action="chat_create.php" method="post" id="createchat">
      <b>Create chatroom:</b></br>
      </br>
      Name:
      <input type="text" name="chatname"></br>
      </br>
      Users:
      <input type="text" name="chatusers"></br></br>
      <input type="submit" name="createsubmit"  value="Create">
     </form></br></br>
     <form action="chat_delete.php" method="post" id="deletechat">
      <b> Delete chatroom: </b></br>
      </br>
      Name:
      <input type="text" name="chatname"></br></br>
      <input type="submit" name="deletesubmit" value="Delete">
     </form></br>
     <b> List of available chatrooms:</b></br>
     <div id="chats">
     </div> <!-- div "chats" -->
    </div> <!-- div "chatroom" -->   

   </div> <!-- div "left" -->
  

   <div id="logged">
    <div id="text2">
     <div id="refresh">
     </div> <!-- div "refresh" i-->
    </div> <!-- div "text2"-->
   </div> <!-- div "logged"-->
  </div> <!-- div "all" -->
 </body>
</html>	
