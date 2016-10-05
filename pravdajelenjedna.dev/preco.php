<?php

$items_num = 28;

if (!isset($_POST["current"])){
 $current = 0;
} else {
 $current = $_POST["current"];
}

if (isset($_POST["stlac"])) {
 if (strcmp($_POST["stlac"], "=>") == 0){
  $current++;
  if ($current == $items_num){
   $current = 0;
  }
 }
 if (strcmp($_POST["stlac"], "<=") == 0){
  $current--;
  if ($current == -1) {
   $current = $items_num -1;
  }
 }
}

$content = array(
 0 => array("Pravda", "Pravda prechadza tromi fazami. V prvej je zosmiesnena. V druhej je nasilne oponovana a v tretej je akceptovana ako zjavna.", "Arthur Schopenhauer"),
 1 => array("Realita", "Nie je ziadna realita. Su len ludia, co to nevedia a ludia co to vedia a nepovedia, pretoze mozu kontrolovat; ludi, ktori to nevedia. </br> To je Pravda, alebo to je aspon dostatocne pravdive.", "Terenz Mckenna"),
 2 => array("Realita", "Nanestastie to co vacsina ludi vnima ako realne vramci reality je v podstate nerealne. Za realne povazujeme ekonomicky system, legalese, stanovy a regulacie politikov. Ked v skutocnosti su tieto veci najfitivnejsie aspekty naseho celeho socialneho systemu. Su vytvorenie na zotrocenie populacie a extrahovanie vsetkeho co je realne od 
ludi.","Max Igan"),
 3 => array("Priroda", "Priroda je viditelny Duch; Duch je neviditelna Priroda.","Schelling"),
 4 => array("Zem", "Tato planeta je suvisly celok, je mysliaca, citiaca, zamyslajuca sa bytost, </br> ktoru by si z hladiska nasich struktur viery bolo hlupe predstavovat inak ako zensku.", "Terenze Mckenna"),
 5 => array ("Vlastnictvo Zeme", "V realite neexistuje licencia ci doklad na vlastnenie Zeme, existuje len Pravo na symbiozu s nou.", "Erik Lux"),
 6 => array("Boh", "Ja nie som veriaci, ja nepotrebujem verit v Boha, pretoze viem, ze Boh exituje. (Dokaz: Napriklad Mandelbrotova mnozina :D)", "Erik Lux"),
 7 => array("Poznaj Boha", "Ak nemas zaujem byt rovnym Bohu, nemozes Boha obsiahnut. Pretoze podobne sa pozna len s podobnym. Zi cisto od vsetkeho co je korporatne, expanduj s podobnym mimo akejkolvek miery. Pozdvihni sa nad vsetok cas a stan sa vecnym, len potom obsiahnes Boha. Mysli si, ze pre teba nic nie je nemozne. Snivaj, ze aj ty si nesmrtelny. A ze si schopny pochopit vsetky veci, ktore su v tvojej myslienke. Poznaj kazdy odbor a kazdu vedu. Najdi si domov u kazdej zivej bytosti. Urob sa vyssim ako vsetky vysky a hlbsim ako najhlbsia hlbka. Prines do seba vsetky opozita kvality; teplo; chladno; sucho; tekutost; mysli si, ze si vsade naraz; na Zemi; na mori; na nebi; mysli ze si sa nenarodil; ze si v maternici; ze si mlady; ze si stary; ze si zomrel; ze si na svete mimo tohoto; predstav si to vsetko vo svojej mysli naraz, vsetky miesta, vo vsetkych casoch, vsetky substancie a magnitudy spolu, len vtedy mozes obsiahnut Boha. Ale ak odstrihnes svoju dusu a svoje telo. Zalozis sa a povies neviem nic. Neviem robit nic. Bojim sa ci vystupim do neba. Nie som si isty kto som a kto by som mal byt, tak co potom chces ty robit s Bohom? Hermetici ucili velmi odlisnu filozofiu ako uskromni sa, tvrdo pracuj a poslusne nasleduj co hlasa nabozenstvo, politika alebo peniaze.", "Corpus Hermetica"),
 8 => array("Fulcrum", "Boh je stacionarna energia, ktora nemoze byt vytvorena, ale moze byt len vyjadrena.", "Walter Russell"),
 9 => array("Rovnovaha", "Boh ma jediny Zakon, a ten zakon sa ta da zosumarizovat jednym slovom a to je Rovnovaha.", "Richard Grant"),
 10 => array("Pricina a Dosledok", "Kazda akcia vyvola rovnaku, ale opacne smerujucu reakciu s casovym oneskorenim.", "Kybalion"),
 11 => array("Mier", "Cim viac tuzime po miery, tym viac sily davame vojne.", "Walter Russell"),
 12 => array("Nerovnovaha", "Na hojdacke su na jednej strane dve deti a na druhej jedno, vsetky deti vazia rovnako. </br>Clovek to uvedie do rovnovahy pridanim stvrteho dietata k tomu jednemu (dosledok na dosiahnutie dosledku), </br> Boh to uvedie do rovnovahy tym, ze posunie fulcrum  blizsie k dvom detom (zmena priciny na dosiahnutie dosledku).", "Richard Grant"),
 13 => array("Zdravie", "Dovod rakoviny je tuzba po dobrom zdravy a strach s rakoviny.", "Richard Grant"),
 14 => array("Problemy", "Zbavil som sa vsetkych mojich problemov tak, ze som im nedoprial ziadnu myslienku.", "Richard Grant"),
 15 => array("Pohyb", "Boh vyjadruje lasku v pohybe a ten pohyb, je to co volame elektrina.", "Walter Russell"),
 16 => array("Vedomie", "Vedomie je jediny zdroj energie vo vesmire, je to ta vec, ktora pohana Vesmir.", "Walter Russell"),
 17 => array("Nekonecne Vedomie", "Ty nie si si svoje meno (David Icke), nie si svoje povolanie (televizny reporter), a nie si ani svoj zaujem (sportovec). </br> Ty si vsetko co kedy bolo, co kedy je a co kedy bude. </br> Si nekonecne vedomie majuce zazitok.", "David Icke"),
 18 => array("Mysel", "Musime sa dostat z navonok citiaceho a hodnotiaceho tela do vnutorne vediacej mysle.", "Walter Russell"),
 19 => array("Jedna mysel", "Sme jednej mysle, a kazda myslienka a kazde konani je zazite kazdou vedomou bytostou vo vesmire.", "Richard Grant"),
 20 => array("Kontrola mysle", "Ak si nikdy nepocul o kontrole mysle alebo si myslis, ze nema nic spolocne s tebou, mam pre teba novinku, si to pravdepodobne ty, ktoreho mysel je hlboko kontrolovana.", "Erik Lux"),
 21 => array("Zotrocenie", "Nik nie je viac beznadejne zotroceni ako ti, ktori veria, ze su slobodni.", "Johann Wolfgang von Goethe"),
 22 => array("Nepriatel", "Ak nie je ziadny nepriatel vo vnutri, nepriatel navonok nam nemoze sposobit ziadnu skodu.", "Eric Thomas"),
 23 => array("Liecenie", "Ak mas akykolvek problem navonok vo Vesmire, vyliec ho v sebe.", "Richard Grant"),
 
 24 => array("Zmena", "Vacsina ludi v emocnej situaci mysli v emociach zapisanych v situaciach v dectve, analyzuje zivot vramci danej emocie, co robim, co mam robit. Ale ak sa clovek ide do pozmeneneho stavu a stane sa nikym, nicim, nikde a v ziadnom case. To je moment v ktorom sa stavaju rydzim vedomim.", "Joe Dispenza"),
 25 => array("Imunita", "Je tvoja zodpovednost si udrzat svoje obranne zlozky, Imunitu, s tebou. Vzdanim sa imunity v prospech par zvolenych sa nielen stanes slabym, ale naviac zvysujes sancu pouziatia tychto sil proti tebe samemu ako v pripade rakovinovych buniech a ich anti-telovej agendy.", "Erik Lux"),
 26 => array("Tvoj zivot, tvoja cesta", "Tvoj zivot je tvoja cesta. Nie tych idiotov, ktori ti vravia, co je mozne, co mozes robit a co si mozes mysliet. Je to len a len tvoja cesta, tvoja vlastna cesta !!!", "Bill Hicks"),
 26 => array("Sposob (Ako?)", "Sposob sa odraza v tebe ako nekonecny zdroj tvojej inspiracie, ako zdroj tvojej vasne, tvojej mudrosti, tvojho entuziazmu, tvojej intuicie, tvojho duchovneho ohna, tvojej lasky. Sposob zoberie chaos vesmiru a vdychne don zivot a usporiada ho. Ked je sposob vyjadreny myslou, je to genius. Ked je vnimany ocami, je to krasa. Ked je citeny zmyslami, je to ladnost. Ked prijaty do srdca, je to laska. A preto dusa nie je nic co by sa dalo najst. Dusa je sposob akym veci robis.", "Wayseer"),

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
</br><small>
';

for ($x = 0; $x < $items_num; $x++) {
    echo  $content[$x][0].' |';
}


echo 
'</small></br><b>
'.$content[$current][0] 
.'</b></br></br>
<div><i>
'.$content[$current][1].'
</i></div></center><div align="right"><small>'.$content[$current][2].'</small></div>
<center>
<div style="background-color: black">
<img src="images/seedoflife1.png" eight="280" width="280"/></br>
<font color="white">Copyright &#169;. All Rights Reserved.</font>
</center>
</div>
';


?>	