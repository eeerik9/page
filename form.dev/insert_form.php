<?php
 $servername = "localhost"; 
 $username = "recon_qss"; 
 $password = "recon_qss"; 
 $database = "database1"; 
 // Create connection 
 $link = mysql_connect("$hostname", "$username", "$password");
        if (!$link) {
            echo "<p>Could not connect to the server '" . $hostname . "'</p>\n";
            echo mysql_error();
        }else{
            echo "<p>Successfully connected to the server '" . $hostname . "'</p>\n";
          printf("MySQL client info: %s\n", mysql_get_client_info());
          printf("MySQL host info: %s\n", mysql_get_host_info());
          printf("MySQL server version: %s\n", mysql_get_server_info());
          printf("MySQL protocol version: %s\n", mysql_get_proto_info());
        }
    if ($link && !$database) {
        echo "<p>No database name was given. Available databases:</p>\n";
        $db_list = mysql_list_dbs($link);
        echo "<pre>\n";
        while ($row = mysql_fetch_array($db_list)) {
            echo $row['Database'] . "\n";
        }
        echo "</pre>\n"; 
}
if ($database) {
    $dbcheck = mysql_select_db("$database");
        if (!$dbcheck) {
            echo mysql_error();
        }else{
            echo "<p>Successfully connected to the database '" . $database . "'</p>\n";
            // Check tables
            $sql = "SHOW TABLES FROM `$database`";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                echo "<p>Available tables:</p>\n";
                echo "<pre>\n";
                while ($row = mysql_fetch_row($result)) {
                    echo "{$row[0]}\n";
                }
                echo "</pre>\n";
            } else {
                echo "<p>The database '" . $database . "' contains no tables.</p>\n";
                echo mysql_error();
            }
        }
   
}

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

if ($database) {
    $dbcheck = mysql_select_db("$database");
        if (!$dbcheck) {
            echo mysql_error();
        }else{
            echo "<p>Successfully connected to the database '" . $database . "'</p>\n";
            // Check table formular
            $formular = "formular";
            $text = $_POST['area'];
            $sql = "INSERT INTO formular (text, timestamp) 
                   VALUES ('$text', now())";
            if (!mysql_query($sql, $link)) {
             die("Error: " . $sql . "</br>" . $link->error);
          
	}
		echo "New record created successfully";
mysql_close($link);
}
}
header( 'Location: index.php' ) ;
?>
