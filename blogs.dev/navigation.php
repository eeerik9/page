<?php 
  if(isset($_GET['page'])){
          $thisPage=$_GET['page'];
  }
  else{ 
          $thisPage = "home.php";
  } 
  
  $thisPage = substr($thisPage, 0, -4);
?>

<nav id="navigation">
	  <ul id="inner">
                <li <?php if ($thisPage=="home") echo " id=\"currentpage\""; ?>>
		  <a href="menu_test.php?page=home.php">Home <?php echo "[thisPage =".$thisPage."]"; ?>

</a>
		</li>
		<li <?php if ($thisPage=="test") echo " id=\"currentpage\""; ?>>
		  <a href="menu_test.php?page=test.php">Test</a>
		</li>

<li >
		  <a href="web.php">Back

</a>
		</li>
                
	  </ul>
</nav>