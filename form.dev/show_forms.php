<?php
 $servername = "localhost";
 $username = "recon_qss";
 $password = "recon_qss";
 $database = "database1";
 // Create connection 
 $link = mysql_connect("$hostname", "$username", "$password");

if ($database) { 
    $dbcheck = mysql_select_db("$database");
        if (!$dbcheck) {
            echo mysql_error();
        }else{
            echo "<p>Successfully connected to the database '" . $database . "'</p>\n";
            // Check table formular
            $formular = "forms_names";
            $sql = "SELECT id, name FROM`$formular`";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                echo "<p>Available forms:</p>\n";
                echo "\n";
                while ($row = mysql_fetch_row($result)) {
                    $form1 = $row[0]."1";
                    echo $row[0] . ", " . $row[1] . "   ";
		    echo '<form action="form.php" method="post" id="'.$form1.'">
                           <button type="submit" form="'.$form1.'" name="goto" value="Goto">Goto</button><input type="hidden" name="form_name" value="'.$row[1].'">
                          </form>
 
         
                          <form action="delete_form.php" method="post" id="'.$row[0].'">
                           <input type="hidden" name="to_edit" value="'.$row[0].'">
                           <button type="submit" form="'.$row[0].'" name ="remove" value="Remove">Remove</button>
                           <button type="submit" form="'.$row[0].'" name="edit" value="Edit">Edit</button>
                          </form>';
		    echo "</br>";
                }
                echo "\n";
            } else {
                echo "<p>The database '" . $database . "' contains no tables.</p>\n";
                echo mysql_error();
            }

	    	
        }
   
}
?>
