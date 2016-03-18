<?php 
  if(isset($_GET['page'])){
          $thisPage=$_GET['page'];
  }
  else{ 
          $thisPage = "home.php";
  } 
  
  $thisPage = substr($thisPage, 0, -4);
?>

<nav id="nav">
       
	  <ul>
          <h1> Page of XXXXX </h1>
          <br>
          Manuals on computer administration, software programming and web page design
          <br><br>
          Information about Truth, Nature, Law, Reality, Unconscious and Care
          <br><br>
          <br><br> 

		<li class="border_top" <?php if ($thisPage=="home") echo " id=\"currentpage\""; ?>>
		  <a href="../index.php?page=home.php">Home</a>
		</li>
		<li class="border" <?php if ($thisPage=="blogs") echo " id=\"currentpage\""; ?>>
		  <a href="../blogs.php">Blogs</a>
		</li>
                <li class="border" <?php if ($thisPage=="library") echo " id=\"currentpage\""; ?>>
		  <a href="library.php">Library</a>
		</li>
		<li class="border" <?php if ($thisPage=="about") echo " id=\"currentpage\""; ?>>
		  <a href="../index.php?page=about.php">About</a>
		</li>
		<li class="border" <?php if ($thisPage=="contact") echo " id=\"currentpage\""; ?>>
		  <a href="../index.php?page=contact.php">Contact</a>
		</li>
	  </ul>
</nav>