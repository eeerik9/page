<?php

if (!isset($_POST["current"])){
 $current = 0;
} else {
 $current = $_POST["current"];
}

if (isset($_POST["stlac"])) {
 if (strcmp($_POST["stlac"], "=>") == 0){
  $current++;
  if ($current == 7){
   $current = 0;
  }
 }
 if (strcmp($_POST["stlac"], "<=") == 0){
  $current--;
  if ($current == -1) {
   $current = 6;
  }
 }
}

$content = array(
 0 => array("Objavujte Stastie", "https://www.hearth.net/en/"),
 1 => array("Cesty k Sobe", "http://cestyksobe.cz/"),
 2 => array("Slobodny Vysielac", "https://slobodnyvysielac.sk"),
 3 => array("Obciansky Tribunal", "http://obcianskytribunal.sk/"),
 4 => array("Penazna Reforma", "http://www.penaznareforma.sk/"),
 5 => array("Lesoochranarske Zdruzenie Vlk", "http://www.wolf.sk/"),
 6 => array("Ekologicke milovanie sa", "http://www.fuckforforest.com/"),
);

echo '

<center>
<table>
<tr>
<form method="POST">
<td>
<input name="stlac" type="submit" value="<=" style="width:100"><input name="current" type="hidden" value="'.$current.'" >
</td>
</form>
<form method ="POST">
<td>
<input name="stlac" type="submit" value="=>" style="width:100"><input name="current" type="hidden" value="'.$current.'" >
</td>
</form>
</tr>
</table>
</br>
';
echo '<small>|';
for ($x = 0; $x < 7; $x++) {
    echo  $content[$x][0].' |';
}
echo '
</small></br><b><i>
<a href='.$content[$current][1].' > '.$content[$current][0].' </a>
</i></b></br></br>
<div>
<iframe width="960" height="540"
<ilayer src='.$content[$current][1].' >
</iframe>
</div>
</center>

';
?>