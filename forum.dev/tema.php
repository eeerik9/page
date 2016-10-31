<html>
 <head>
 </head> 
 <body>
  <center>
   |<a href="index.php">Forum</a>|<a href="http://pravdajelenjedna.info">Pravdajelenjedna</a>|
  </center></br></br>
  <?php
   include ("db_connect.php");

   session_start();
   $name= mysql_escape_string($_GET["n"]);

   $link = get_link();
   $sql = "SELECT * FROM forum_topics WHERE name= '{$name}'";
   $ret = mysql_query($sql, $link);
   $row = mysql_fetch_assoc($ret);
   $views = $row['views'];
   $views = $views +1;
   $sql = "UPDATE forum_topics SET views = '{$views}' WHERE name = '{$name}'";
   $ret = mysql_query($sql, $link);
   if(isset($_SESSION['prihlaseny'])){
    echo '
     <form action="pridajspravu.php" method="post" enctype="multipart/form-data">
      Obrazok:</br>
      <input type="file" name="obrazok" id="fileToUpload"></br>
      Sprava:</br>
      <input name="sprava" type="text" style="width:100%"></br>
      <input name="tema" type="hidden" value="'.$name.'">
      <input name="stlacil" type="submit" value="Vloz">
     </form>
    ';
   }
 
    
   echo ' 
    <table border="1" style="width:100%">
     <th style="width: 2%">Id</th>
     <th style="width: 18%">Info</th>
     <th style="width: 78%">Sprava</th>';
     if (isset($_SESSION['prihlaseny'])){
      echo '<th style="widht: 2%">X</th>';
     }
   
     $sql = "SELECT * FROM $name";
     $ret = mysql_query($sql, $link);
     while ($row = mysql_fetch_assoc($ret)){
      echo "<tr>";
       echo "<td>".$row['id']. "</td>";
       echo "<td>Autor: ".$row['author']."</br>Zverejnene: ".$row['posted']."</td>";
       echo "<td>Obrazok:</br> <img src=".$row['pict']."></br>Text:</br> ".$row['msg']."</td>";
       if (isset($_SESSION['prihlaseny'])){
        echo "<td>
               <form action='odoberspravu.php' method='post'>
                <input type='submit' name='stlacil' value='X'>
                <input type='hidden' name='tema' value='".$name."'>
                <input type='hidden' name='id' value='".$row['id']."'>
               </form>
              </td>";
      }
      echo "</tr>";
     }
   echo '
    </table>
   ';
   mysql_close($link);
  ?>
 </body>
</html>
