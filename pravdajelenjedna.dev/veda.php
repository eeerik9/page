<?php

if (!isset($_POST["current"])){
 $current = 0;
} else {
 $current = $_POST["current"];
}

if (isset($_POST["stlac"])) {
 if (strcmp($_POST["stlac"], "=>") == 0){
  $current++;
  if ($current == 2){
   $current = 0;
  }
 }
 if (strcmp($_POST["stlac"], "<=") == 0){
  $current--;
  if ($current == -1) {
   $current = 1;
  }
 }
}

$dir ="materialy/";
$content = array(
 0 => array("Prirodny Zakon", $dir."prirodnyzakon.pdf"),
 1 => array("Vladcovia", $dir."archons.pdf"),
);
echo '
<center>
<table>
<tr>
<form method="POST">
<td>
<input name="current" type="hidden" value="'.$current.'" ><input name="stlac" type="submit" value="<=" style="width:100"> 
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
for ($x = 0; $x < 2; $x++) {
    echo  $content[$x][0].' |';
}
echo 
'</small></br><b><i>
'.$content[$current][0] 
.'</i></b></br></br>
<div>
<object data='.$content[$current][1].' type="application/pdf" width="860px" height="540px" />
</div>
</center>
';
?>