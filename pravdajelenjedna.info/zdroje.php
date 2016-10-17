<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
<body>
<?php
session_start();

$items_num=7;

if (!isset($_SESSION["current_source"]) || $_SESSION["current_source"] >= $items_num ){
 $current = 0;
} else {
 $current = $_SESSION["current_source"];
 if ($current == $items_num-1) {
  $current = 0;
 } else {
  $current++;
 }
}
$_SESSION["current_source"] = $current;

$content = array(
 0 => array("Objavujte Stastie", "https://www.hearth.net/en/"),
 1 => array("Cesty k Sobe", "http://cestyksobe.cz/"),
 2 => array("Slobodny Vysielac", "https://slobodnyvysielac.sk"),
 3 => array("Obciansky Tribunal", "http://obcianskytribunal.sk/"),
 4 => array("Penazna Reforma", "http://www.penaznareforma.sk/"),
 5 => array("Lesoochranarske Zdruzenie Vlk", "http://www.wolf.sk/"),
 6 => array("Ekologicke milovanie sa", "http://www.fuckforforest.com/"),
);


echo '<center><small>|';

for ($x = 0; $x < $items_num; $x++) {
    if ($x == $current) {
     echo  '<b><a href="'. $content[$x][1] .'">'.$content[$x][0].'</a></b> |';
    } else {
     echo  '<a href="'. $content[$x][1] .'">'. $content[$x][0].'</a> |';
    }
}

echo '
</small></br></br></br>
<div>
<iframe width="960" height="540"
<ilayer src='.$content[$current][1].' >
</iframe>
</div>
</center>

';
?>
</body>
</html>