<?php

if (!isset($_POST["current"])){
 $current = 0;
} else {
 $current = $_POST["current"];
}

if (isset($_POST["stlac"])) {
 if (strcmp($_POST["stlac"], "=>") == 0){
  $current++;
  if ($current == 17){
   $current = 0;
  }
 }
 if (strcmp($_POST["stlac"], "<=") == 0){
  $current--;
  if ($current == -1) {
   $current = 17;
  }
 }
}

$content = array(
 0 => array("Pravda", "Pravda prechadza tromi fazami. V prvej je zosmiesnena. V druhej je nasilne oponovana a v tretej je akceptovana ako zjavna.", "Arthur Schopenhauer"),
 1 => array("Realita", "Nie je ziadna realita. Su len ;udia, co to nevedia a ludia co to vedia a nepovedia, pretože môžu kontrolovat; ludí, ktorí to nevedia. </br> To je Pravda, alebo to je aspon dostatocne pravdivé.", "Terenz Mckenna"),
 2 => array("Priroda", "Priroda je viditelny Duch; Duch je neviditelna Priroda.","Schelling"),
 3 => array("Zem", "Tato planeta je suvisly celok, je mysliaca, citiaca, zamyslajuca sa bytost, </br> ktoru by si z hladiska nasich struktur viery bolo hlupe predstavovat inak ako zensku.", "Terenze Mckenna"),
 4 => array("Boh", "Ja nie som veriaci, ja nepotrebujem verit v Boha, pretoze viem, ze Boh exituje.", "Erik Lux"),
 5 => array("Fulcrum", "Boh je stacionarna energia, ktora nemoze byt vytvoren, ale moze byt len vyjadrena.", "Walter Russel"),
 6 => array("Rovnovaha", "Boh ma jediny Zakon, a ten zakon sa ta da zosumarizovat jednym slovom a to je Rovnovaha.", "Richard Grant"),
 7 => array("Pricina a Dosledok", "Kazda akcia vyvola rovnaku, ale opacne smerujucu reakciu s casovym oneskorenim.", "Kybalion"),
 8 => array("Mier", "Cim viac tuzime po miery, tym viac sily davame vojne.", "Walter Russel"),
 9 => array("Nerovnovaha", "Na hojdacke su na jednej strane dve deti a na druhej jedno, </br>clovek to uvedie do rovnovahy pridanim stvrteho dietata k tomu jednemu (dosledok na dosiahnutie dosledku), </br> Boh to uvedie do rovnovahy tym, ze posunie fulcrum  blizsie k dvom detom (zmena priciny na dosiahnutie dosledku).", "Richard Grant"),
 10 => array("Zdravie", "Dovod rakoviny je tuzba po dobrom zdravy a strach s rakoviny.", "Richard Grant"),
 11 => array("Problemy", "Zbavil som sa vsetkych mojich problemov tak, ze som im nedoprial ziadnu myslienku.", "Richard Grant"),
 12 => array("Pohyb", "Boh vyjadruje lasku v pohybe a ten pohyb, je to co volame elektrina.", "Walter Russel"),
 13 => array("Vedomie", "Vedomie je jediny zdroj energie vo vesmire, je to ta vec, ktora pohana Vesmir.", "Walter Russell"),
 14 => array("Mysel", "Musime sa dostat z navonok citiaceho a hodnotiaceho tela do vnutorne vediacej mysle.", "Walter Russell"),
 15 => array("Nepriatel", "Ak nie je ziadny nepriatel vo vnutri, nepriatel na vonok nam nemoze sposobi ziadnu skodu.", "Eric Thomas"),
 16 => array("Liecenie", "Ak mas akykolvek problem navonok vo Vesmire, vyliec ho v sebe.", "Richard Grant"),
 17 => array("Jedna mysel", "Sme jednej mysle, a kazda myslienka a kazde konani je zazite kazdou vedomou bytostou vo vesmire.", "Richard Grant"),
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

echo 
'</br><b>
'.$content[$current][0] 
.'</b></br></br>
<div><i>
'.$content[$current][1].'
</i></div></center><div align="right"><small>'.$content[$current][2].'</small></div>
';


?>
