<?php
 include("session.php");
 session_start();
 $link = get_link();
 $ret = pg_query(
  $link,
  "DELETE FROM login WHERE username='{$login_session}'"
 );
 $ret = pg_query(
  $link,
  "DELETE FROM profile WHERE username='{$login_session}'"
 );
 $target_dir ="uploads/".trim($login_session)."/";
 $files = glob($target_dir . '*', GLOB_MARK);
 foreach($files as $file){
  unlink($file);
 }
 rmdir($target_dir);
 session_destroy();
 header('Location: index.php');
 pg_close($link);
?>
