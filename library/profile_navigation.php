<nav id="nav">
	  <ul>
          <h1> XXXXX Library </h1>
          <b>Welcome : <i><?php echo $login_session; echo ' '; echo $nick_session; ?></i></b>
          <br>
          Books on yoga, conspiration theories, forbidden science, natural law, common law, inner psyche, true history of men, magic plants, sexuality, authority and much more ..
          <br><br>
          List of authors, list of inspirational websites, books to read accompanied by some art         
          <br><br>
          <br> 

		<li class="border_top" <?php if ($thisPage=="authors") echo " id=\"currentpage\""; ?>>
		  <a href="profile.php?page=authors.php">Authors</a>
		</li>
		<li class="border" <?php if ($thisPage=="websites") echo " id=\"currentpage\""; ?>>
		  <a href="profile.php?page=websites.php">Websites</a>
		</li>
		<li class="border" <?php if ($thisPage=="books") echo " id=\"currentpage\""; ?>>
		  <a href="profile.php?page=books.php">Books</a>
		</li>
		<li class="border" <?php if ($thisPage=="art") echo " id=\"currentpage\""; ?>>
		  <a href="profile.php?page=art.php">Art</a>
		</li>
                <li class="border" <?php if ($thisPage=="logout") echo " id=\"currentpage\""; ?>>
		  <a href="logout.php">Log Out</a>
		</li>
	  </ul>
</nav>