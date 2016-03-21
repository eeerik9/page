<?php
$search_output = "";
if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
	
    $dir_open = opendir('../../mantakchia');

    while(false !== ($filename = readdir($dir_open))){


        if($filename != "." 
             && $filename != ".." 
             && strpos( strtolower($filename), strtolower($_POST['searchquery']) ) == TRUE ) {
            $link = "<a href='mantakchia/$filename'> $filename </a><br />";
            $search_output = $search_output.$link;
        }
        
    }

closedir($dir_open);
}
?>
<div>
<h2>Search the Library</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  Search: <input name="searchquery" type="text" size="70" maxlength="88">

  <input name="myBtn" type="submit">
  <br><br>
</form>


<?php echo $search_output; ?>
</div>