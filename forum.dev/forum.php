<?php 
 include ("db_connect.php");
  
  session_start();
  if (isset($_SESSION['prihlaseny'])){
   echo '
    <form action="pridajtemu.php" method="post">
     Nazov:</br>
     <input name="nazov" type="text"></br>
     Tema:</br>
     <input name="tema" type="text"></br>
     <input name="stlacil" type="submit" value="Vloz">
    </form>
   ';
  }  

 
  echo '
  <table border="1" style="width:100%">
   <tr>
    <th style="width: 4%">Id</th>
    <th style="width: 60%">Tema</th>
    <th style="width: 8%">Autor</th>
    <th style="width: 8%">Pozretia</th>
    <th style="width: 20%">Vytvorene</th>
   </tr>
 ';
 
 $link = get_link();
 $sql = "SELECT * FROM forum_topics";
 $ret = mysql_query($sql, $link);
 while ($row = mysql_fetch_assoc($ret)){
 echo "<tr>";
 echo "<td>".$row['id']. "</td>";
 echo "<td>".$row['topic']. "</td>";
 echo "<td>".$row['author']. "</td>";
 echo "<td>".$row['views']. "</td>";
 echo "<td>".$row['posted']. "</td>";
 echo "</tr>";
 }

 echo '
  </table>
 ';
?>
