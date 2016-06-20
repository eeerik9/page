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
            $formular = "formular";
            $sql = "SELECT id, text, timestamp FROM`$formular`";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                echo "<p>Available forms:</p>\n";
                echo "<pre>\n";
                while ($row = mysql_fetch_row($result)) {
                    echo $row[0] .", ".  $row[1]. ", " . $row[2] . "\n";

                }
                echo "</pre>\n";
            } else {
                echo "<p>The database '" . $database . "' contains no tables.</p>\n";
                echo mysql_error();
            }
        }
   
}
?>
