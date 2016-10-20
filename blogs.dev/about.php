<?php
 function writeText($size, $color, $text){
 echo '
   <center>
   <font size="' .$size. '" color="' .$color. '">
    '. $text .'! </br>
   </font>
   </center>
  ';
 }
 function nl(){
  echo '</br>';
 }
 $size=3;

 writeText($size, "red", "Know Thyself"); 
 writeText($size, "orange", "Say No");  
 writeText($size, "yellow", "Do Not Steal");
 writeText($size, "green", "Be Sovereign");
 writeText($size, "blue", "Live symbiotically"); 
 writeText($size, "darkblue", "Show Compassion");
 writeText($size, "purple", "Achieve Abundance");
 nl();
 writeText($size, "red", "Erkenne dich selbst"); 
 writeText($size, "orange", "Sag Nein");  
 writeText($size, "yellow", "Stiehl nicht");
 writeText($size, "green", "Sei Souverän");
 writeText($size, "blue", "Lebe symbiotisch"); 
 writeText($size, "darkblue", "Empfinde Mitgefühl");
 writeText($size, "purple", "Erreiche Fülle");
?>