<?php
 include("session.php");
 session_start();
 $link = get_link();
 $sql="DELETE FROM chat_login_sessions WHERE username='{$login_session}'";
 mysql_query($sql, $link);
 $sql="DELETE FROM chat_login WHERE username='{$login_session}'";
 mysql_query($sql, $link);
 $sql="DELETE FROM chat_profile WHERE username='{$login_session}'";
 mysql_query($sql,$link);
 $target_dir ="uploads/".trim($login_session)."/";
 $files = glob($target_dir . '*', GLOB_MARK);
 foreach($files as $file){
  unlink($file);
 }
 rmdir($target_dir);
 session_destroy();
 header('Location: index.php');
 mysql_close($link);
?>
