<?php
 require_once("../db/connectdb.php");                                                                                                                                                                                 
 echo "Chatting...<br />";
 $mydb = new db();
 // Establishing Connection with Server by passing server_name, user_id and password as a parameter
 $mydb->db_set("localhost", "recon_qss", "recon_qss");
 $connection = $mydb->db_connect();
 // // Selecting Database
 $mydb->db_change("database1");
 //
 $time = time ();
 $result = mysql_query("SELECT * FROM msgs ORDER BY timestamp ASC", $connection);
 while ($row = mysql_fetch_array($result)) {    
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
