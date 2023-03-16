<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/malli.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Taksi</title>
<!-- InstanceEndEditable -->
<link rel='stylesheet' type='text/css' href='yllapito/kuvanlataus/tyylit.php' />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<div id="ylaosa">
<table width="100%">
<tr><td valign="top">

  <table align="center" width="500" height="45" cellscpacing="20" id="logo">
  	<tr><td style="width:120px">
  	<font size="+3"><b></b></font>
  	</td><td> 
    <b>
    <a href="index.php"><font color="#cccccc">&nbsp;Tilaus&nbsp;</font></a>&nbsp;&nbsp;<a href="hinnasto.php"><font color="#cccccc">&nbsp;Hinnasto&nbsp;</font></a>&nbsp;&nbsp;<a href="yhteyslomake.php"><font color="#cccccc">&nbsp;Yhteyslomake&nbsp;</font></a>
	</b>
 	</td></tr>
	</table>
	
</td></tr>
</table>
</div>

<div id="keski"><!-- InstanceBeginEditable name="EditRegion3" -->

	<table align="center" width="425" border="2" cellpadding="10" id="lomake">
		<tr>
		<td>

<?php
date_default_timezone_set('Europe/Helsinki');

// Virheilmoitukset

$mistaErr = $minneErr = "";
$mista = $minne = "";

if (isset($_POST['laske'])){

   if (empty($_POST["mista"])) {
     $mistaErr = "* Anna l&auml;ht&ouml;piste!";
   } else {
     $mista = $_POST["mista"];
     // check if mista only contains letters and whitespace
     if (!preg_match("/^[a-öA-Ö:,.; ]*$/",$mista)) {
       $mistaErr = " Ei erityismerkkejä!";
     }
   }
  

   if (empty($_POST["minne"])) {
     $minneErr = "* Anna m&auml;&auml;r&auml;np&auml;&auml;!";
   } else {
     $minne = $_POST["minne"];
     // check if minne only contains letters and whitespace
     if (!preg_match("/^[a-öA-Ö:,.; ]*$/",$minne)) {
       $minneErr = " Ei erityismerkkejä!";
     }
   }

 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
	}

}


?>
<font size="+2"><b>&nbsp;Arvioi taksimatkan pituus ja hinta</b></font><p>


<?php

$tunnus=rand(10,9999999);
// Start date
$ekapaiva = date('d.m.Y');
// End date
$vikapaiva = date ("d.m.Y", strtotime("+1 year"));

$min = date('i') ;
$h = date('H');

$paivamaara = date('d.m.Y');
$pv_kk = date('d.m');
$kk = date('m');
$paiva = date('d');
$viikonpaiva = date('D');
$vuosi = date('Y');

?>

<form method="post" action=""> 

<table border=0 cellpadding=2>
 <tr>
 <td>
 Lähtöpiste:
 </td>
 <td>
 <input type="text" name="mista" value="<?php echo $mista;?>">
   <span class="error"> <?php echo $mistaErr;?></span>
 </td>
 </tr>

 <tr>
 <td>
 Määränpää:
 </td>
 <td>
 <input type="text" name="minne" value="<?php echo $minne;?>">
   <span class="error"> <?php echo $minneErr;?></span>
 </td>
 </tr>
</table>

<table border=0 cellpadding=2>
 <tr>
 <td valign="top">
 <b>Haluttu saapumisaika lähtöpisteeseen:</b>
 </td>
 </tr>
</table>

<table border=0 cellpadding=2>
 <tr>
 <td valign="top">Päivämärä:</td><td>
 <select name="pvm">

<?php

// Jos minuutit on yli 45 ja tunnit 23, siirrytään näyttämään seuraava päivä

	if ($min > "30" && $h =="23" ){
	$ekapaiva = date ("d.m.Y", strtotime("+1 day", strtotime($ekapaiva)));
	}
	while (strtotime($ekapaiva) <= strtotime($vikapaiva)) {
    echo "<option value='$ekapaiva'>".$ekapaiva."</option>";
	$ekapaiva = date ("d.m.Y", strtotime("+1 day", strtotime($ekapaiva)));
}

?>

</select>
</td>
</tr>


<tr>
<td valign="top">Kellonaika:</td>
<td>
<font size="-1"><b>tunnit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;minuutit</b></font><br>
<!-- Tulostetaan tunnit-valikko -->
<select name="tunnit">

<?php

// Jos minuutit on yli 45, korotetaan tunteja yhdellä

	$h = date('H');

	if ($min > "30"){
	$h = $h+ 1;
	}

// Näytetään ensimmäisenä nykyiset tunnit ja tulostetaan valinnoiksi 23 saakka
while($h < 24) {

	echo "<option value='$h'>".$h."</option>";
    	$h++;
}
// palautetaan tunnit nykyiseen
$h = date('H');
$keskiyo = "00";

// Jatketaan valintoja keskiyöstä kunnes saavutetaan vuorokausi täyteen
while($keskiyo <= $h) {

	echo "<option value='$keskiyo'>".$keskiyo."</option>";
    	$keskiyo++;
}

?>

</select>



<!-- Tulostetaan minuutit-valikko, jossa valinnat 15-minuutin välein -->
<select name="minuutit">

<?php

$min = date('i') ;

	if ($min > "00" && $min < "15"){
	echo "<option value='30'>30</option>";
	echo "<option value='45'>45</option>";	
	echo "<option value='00'>00</option>";	
	echo "<option value='15'>15</option>";
	} 
	elseif ($min > "15" && $min < "30"){
	echo "<option value='45'>45</option>";
	echo "<option value='00'>00</option>";
	echo "<option value='15'>15</option>";
	echo "<option value='30'>30</option>";
	}
	elseif ($min > "30" && $min < "45"){
	echo "<option value='00'>00</option>";
	echo "<option value='15'>15</option>";
	echo "<option value='30'>30</option>";
	echo "<option value='45'>45</option>";
	}
	else {
	echo "<option value='15'>15</option>";
	echo "<option value='30'>30</option>";
	echo "<option value='45'>45</option>";
	echo "<option value='00'>00</option>";
	}

?>

</select>
</td></tr>

<tr>
<td valign="top">
Matkustajamäärä: 
</td>
<td>
<!-- Matkustajamäärä kysytään -->
<select name="matkustajamaara">

<?php

$matkustajamaara="1";
while($matkustajamaara < 9) {

	echo "<option value='$matkustajamaara'>".$matkustajamaara."</option>";
    	$matkustajamaara++;
}
	
?>

</select>
<br><font size=-1><hr><i>kaksi alle 12-vuotiasta lasta <br>lasketaan yhdeksi henkilöksi.<i></font>
</td>
</tr>
</table>

<?php

$tietokantayhteys=new mysqli('localhost', 'root', '', 'taxi')
or die ("Yhteytt&auml; tietokantaan ei saatu");
// Yhteys tietokantaan
//mysqli_select_db($tietokantayhteys, "taxi")
//or die ("Valittua tietokantaa ei l&ouml;ytynyt");

//sql-lause haku

// Otetaan valmiiksi sy&ouml;tetyt lisätoiveiden hinnat, hinnat-taulukosta:

$lause="select tavarankuljetus, avustus1, avustus2, avustus0, paarilisa from hinnat";

$tulos=mysqli_query($tietokantayhteys, $lause) or die ("Syyst&auml;, jota en tied&auml;, tietoa ei saatu tietokannasta!").mysqli_error();

while ($rivi = mysqli_fetch_array($tulos)){
	$tavarankuljetus=$rivi['tavarankuljetus'];
	$avustus1=$rivi['avustus1'];
	$avustus2=$rivi['avustus2'];
	$avustus0=$rivi['avustus0'];
	$paarilisa=$rivi['paarilisa'];
	
//echo "tavarankuljetus ".$tavarankuljetus."<br>";
//echo "avustus1 ".$avustus1."<br>";
//echo "avustus2 ".$avustus2."<br>";
//echo "avustus0 ".$avustus0."<br>";
//echo "paarilisa ".$paarilisa."<br>";

?>

<table border=0 cellpadding=0 width=250>
<tr>
<td valign="top">

<!--
Seuraava scripti osoitteesta: http://www.willmaster.com/blog/css/show-hide-div-layer.php
-->
<script type="text/javascript" language="JavaScript"><!--
function HideContent(d) {
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
document.getElementById(d).style.display = "block";
}
function ReverseDisplay(d) {
if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
else { document.getElementById(d).style.display = "none"; }
}
//--></script>

<!--<a href="javascript:ShowContent('uniquename')">
Click to show.
</a>

<a href="javascript:HideContent('uniquename')">
Click to hide.
</a> -->


<a href="javascript:ReverseDisplay('lisatoiveet')">
<font color="#00008B"><u>Valitse lisätoiveet</u></font>
</a>
<br>

<div id="lisatoiveet" style="display:none;">
<table border=0 cellpadding=2 width=250>
<tr><td>

<a href="javascript:ReverseDisplay('tavarainfo')"><font color="#000000"> - Tavarankuljetus</font></a>
<br>
<div id="tavarainfo" style="display:none;">
<table border=0 cellspacing=2>
<tr>
<td>
<font size=-1><i>Isokokoisten esineiden (mm. sukset, televisiot) ja lemmikkieläinten kuljetus.	
<?php echo $tavarankuljetus." &#8364;"; ?>
<hr>Lisämaksua ei saa periä asiakkaan tavanomaisista matkatavaroista eikä opaskoirasta.</i></font>
</td><td valign='top'>
<input type="checkbox" name="lisamaksu[]" value="Tavarankuljetus">
</td>
</tr>
</table>
</div>

<a href="javascript:ReverseDisplay('avustusinfo')"><font color="#000000"> - Avustus</font></a>
<br>
<div id="avustusinfo" style="display:none;">
<table border=0 cellpadding=2>
<tr>
<td>
<font size=-1><i>Jos asiakas tarvitsee avustamista ja kuljetus edellyttää invavarusteista autoa	
<?php echo $avustus1." &#8364;"; ?> 
<hr></i></font>
</td><td valign='top'>
<!--<input type="checkbox" name="lisamaksu" value="avustus1"> -->
<input type="radio" name="lisamaksu[]" value="Avustus, invavarusteinen auto">
</td>

<tr>

<td>
<font size=-1><i>Avustamislisämaksu -kuten edellä, mutta avustaminen tapahtuu portaissa käsivoimin tai porraskiipijää hyväksi käyttäen
<?php echo $avustus2." &#8364;"; ?> 
<hr></i></font>
</td><td valign='top'>
<!--<input type="checkbox" name="lisamaksu" value="avustus2"> -->
<input type="radio" name="lisamaksu[]" value="Avustus portaissa, invavarusteinen auto">
</td>
</tr>

<tr>
<td>
<font size=-1><i>Ei avustusta 
</i></font>
</td><td valign='top'>
<!--<input type="checkbox" name="lisamaksu" value="avustus0"> -->
<input type="radio" name="lisamaksu[]" value="Ei avustusta" CHECKED>
</td>
</tr>
</table>
</div>

<a href="javascript:ReverseDisplay('paari-info')"><font color="#000000"> - Paarilisä</font></a>
<br>
<div id="paari-info" style="display:none;">
<table border=0 cellspacing=2>
<tr>
<td>
<font size=-1><i>Asiakkaan kuljettamisessa tarvittavien paarien noutaminen ja autoon asentaminen ennen kuljetuksen alkua
<?php echo $paarilisa." &#8364;"; ?> </i></font>
</td><td valign='top'>
<input type="checkbox" name="lisamaksu[]" value="Paarilisä">
</td>
</tr>
</table>
</div>

</td>
</tr>

</table>
</div>

<?php
$checkbox = ' ';
?>

</td>
</tr>
</table>

<table border=0 cellpadding=0>
<tr>
<td>
	<p>
</td>
<td>
<input type="submit" name="laske" value="Laske matka ja hinta">
</td>
</tr>

</table>

</form>



<?php

$yhteystietoErr = "";
$puhnro = $email = $viesti = "";

if (isset($_POST['tilaus'])){

   if (empty($_POST["puhnro"]) && empty($_POST["email"])) {
     $yhteystietoErr = "* Anna yhteystieto!";
   } else {
     $puhnro = $_POST["puhnro"];

     if (!preg_match("/^[0-9 ]*$/",$puhnro)) {
       $yhteystietoErr = "* Vain numeroita!";
     }

     $email = $_POST["email"];
     	if ($email != "") {
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $yhteystietoErr = "* Vääränlainen sähköpostiformaatti!";
     }
 	}

   }
 

 	if (empty($_POST["viesti"])) {
    $viesti = "";
  	} else {
    $viesti = $_POST["viesti"];
  	}

   function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
	}

	$tunnus=$_POST['tunnus'];
	$matka=$_POST['matka'];
	$lisatoiveet=$_POST['lisatoiveet'];
	$lisatoiveethinta=$_POST['lisatoiveethinta'];
	$hinta=$_POST['hinta'];
	$alv=$_POST['alv'];
	$brutto=$_POST['brutto'];
	$alvprossa=$_POST['alvprossa'];
	$mista=$_POST['mista'];
	$minne=$_POST['minne'];
	$matkustajamaara=$_POST['matkustajamaara'];
	$puhnro=$_POST['puhnro'];
	$email=$_POST['email'];
	$saapumispvm=$_POST['pvm'];
	$saapumisklo=$_POST['klo'];
	$viesti=$_POST['viesti'];
	$tilauspvm=date('d.m.Y');
	$tilausklo=date('H:i:s');

	$ennakkotilauslisamaksu=$_POST['ennakkotilauslisamaksu'];
	
	if ($yhteystietoErr==""){

	$tietokantayhteys=mysql_connect("mysql16.000webhost.com","a8675696_root","74k5151vu570")
	or die ("Yhteytt&auml; tietokantaan ei saatu");
	// Yhteys tietokantaan
	mysql_select_db("a8675696_taxi")
	or die ("Valittua tietokantaa ei l&ouml;ytynyt");
	
	// Pistet&auml;&auml;n tilauksen tiedot tietokantaan:

	$muistiin="insert into tilaus values('','$tunnus','$puhnro','$email','$mista','$minne','$matka','$lisatoiveet','$lisatoiveethinta','$hinta','$alv','$brutto','$alvprossa','$saapumispvm','$saapumisklo','$viesti','$tilauspvm','$tilausklo','$matkustajamaara','$ennakkotilauslisamaksu')";
	//                                   0	    1         2         3	     4	     5        6        	7      				8         	  9      10      11          12           13          	  14		   15			16			17
	mysql_query($muistiin) or die ("Tieto ei tallentunut tietokantaan".mysql_error());

	// Otetaan tilauksen tiedot "tilaus"-taulukosta:

	$lause="select tunnus, puhnro, email, mista, minne, matka, lisatoiveet, hinta, alv, brutto, alvprossa, saapumispvm, saapumisklo, viesti, tilauspvm, tilausklo from tilaus where tunnus=$tunnus";
	//               0	     1       2      3	   4	  5     	 6     	  7     8      9      10      		11      	12        13		 14			15
	$tulos=mysql_query($lause,$tietokantayhteys) or die ("Syyst&auml;, jota en tied&auml;, tietoa ei saatu tietokannasta").mysql_error();

	while ($rivi = mysql_fetch_array($tulos)){

	
	$tunnus=$rivi[0];
	$matka=$rivi[5];
	$hinta=$rivi[7];
	$lisatoiveet=$rivi[6];
	$alv=$rivi[8];
	$brutto=$rivi[9];
	$alvprossa=$rivi[10];
	$mista=$rivi[3];
	$minne=$rivi[4];
	$puhnro=$rivi[1];
	$email=$rivi[2];
	$saapumispvm=$rivi[11];
	$saapumisklo=$rivi[12];
	$viesti=$rivi[13];
	$tilauspvm=$rivi[14];
	$tilausklo=$rivi[15];

	?>
	<hr>
			<table align="center" width="425" border="2" id="lomake">
			<tr>
			<td>
	<table border=0 cellpadding=5 width=424 >
	<tr>
	</tr><tr>
	<td><font color='#DC143C'><b>Tilaus otettu vastaan!</b></font><br></td><td>  </td>
	</tr><tr>
	<td><b>Matkatiedot</b></td><td></td>
	</tr><tr>
	<td>Tunnus: </td><td> <?php echo $tunnus;?>  </td>
	</tr><tr>
	<td>Mistä: </td><td> <?php echo $mista;?>  </td>
	</tr><tr>
	<td>Minne: </td><td> <?php echo $minne;?>  </td>
	</tr><tr>
	<td> Matkan pituus: </td><td> <?php echo round($matka,2);?>  km </td>
	</tr><tr>
	<td>Matkustajamäärä</td> <td><?php echo $matkustajamaara;?></td>
	</tr>
	<?php
	if ($lisatoiveet != "") {
	echo "<tr><td> Lisätoiveet: </td><td> <b>".$lisatoiveet."</b> </td></tr>";
	echo "<tr><td>Hinta lisätoiveista: </td> <td>".number_format($lisatoiveethinta,2)." &#8364; </td></tr>";
	}
	?>
	<tr>
	<td><b>Hinta</b></td><td></td>
	</tr>
	<?php
	 if ($ennakkotilauslisamaksu != 0) {
	echo "<tr><td>Ennakkotilauslisämaksu: </td> <td>".number_format($ennakkotilauslisamaksu,2). " &#8364;</td></tr>";
	}
	?>
	<tr>
	<td> Hinta: </td><td> <?php echo number_format($hinta,2);?>  &#8364;</td>
	</tr><tr>
	<td> Alv: </td><td> <?php echo number_format($alv,2);?>  &#8364; <?php echo $alvprossa;?> %</td>
	</tr><tr>
	<td> <font size="+1">Hinta + Alv: </font></td><td> <font size="+1"><?php echo number_format($brutto,2);?>  &#8364;</font></td>
	</tr>
	<tr>
	<td><b>Yhteystiedot</b></td><td></td>
	</tr>
	<?php
	if ($puhnro != "") {
	echo "<tr><td> Puh: </td><td>".$puhnro." </td></tr>";
	}
	 if ($email != "") {
	echo "<tr><td>Sähköposti: </td> <td>".$email. " </td></tr>";
	}
	?>
	<tr>
	<td><b>Aikatiedot</b></td><td></td>
	</tr>
	<tr>
	<td>Taksi saapuu lähtöpaikkaan: </td><td> <?php echo $saapumispvm;?>  klo: <?php echo $saapumisklo;?>  </td>
	</tr><tr>
	<td> Tilattu: </td><td> <?php echo $tilauspvm;?>  klo: <?php echo $tilausklo;?>   </td>
	</tr>
	</table>
	<?php
	if ($viesti != "") {
	echo "<table width=424 cellpadding=5 id='lomake'><tr><td><b>Viesti:</b><p>".$viesti. " </td></tr></table>";
	}
	?>
	</td></tr></table>
	<hr>
	<?php

	}

							}

	else {

echo "<hr>";

echo "<br>";
echo "<table border=0 cellpadding=3 cellspacing=2>";

echo "<table border=0 cellpadding=2>";
echo "<tr><td border=0><font size='+2'>".$mista." || ".$minne." </font></td></tr>";
echo "</table>";
echo "<table border=0 cellpadding=2 >";
echo "<tr><td width='130'>Saapumisaika<br>l&auml;ht&ouml;pisteeseen:</td> <td>".$saapumispvm."<br>klo ".$saapumisklo."</td></tr>";
echo "<tr><td>Matkustajamäärä</td> <td>".$matkustajamaara."</td></tr>";
echo "<tr><td>Matka:</td> <td>".number_format($matka,2). " km</td></tr>";

if ($lisatoiveet != "") {
	echo "<tr><td>Lisätoiveet: </td> <td>".$lisatoiveet."</td></tr>";
	echo "<tr><td>Hinta lisätoiveista: </td> <td>".number_format($lisatoiveethinta,2)." &#8364; </td></tr>";
	}

 if ($ennakkotilauslisamaksu != 0) {
	echo "<tr><td>Ennakkotilauslisämaksu</td> <td>".number_format($ennakkotilauslisamaksu,2). " &#8364;</td></tr>";
	}

echo "<tr><td>Hinta:</td> <td>".number_format($hinta,2). " &#8364;</td></tr>";
echo "<tr><td>Alv:</td> <td>".number_format($alv,2). " &#8364; <i>(".round($alvprossa,0)." %)</i></td></tr>";
echo "<tr><td>Hinta + Alv: </td> <td>".number_format($brutto,2)." &#8364;</td></tr>";
echo "</table>";
echo "<br>";
?>
<h2>Tilaa taksi</h2>

<form id="tilaus" action=" " method="post">
<table border=0 cellpadding=2>
<tr><td><b>Yhteystiedot:<br></b></td> <td></td></tr>
<tr><td>Puhelinnumero</td> <td><input type="text" name="puhnro" value="<?php echo $puhnro;?>">
   <span class="error"> <?php echo $yhteystietoErr;?></span>
</td></tr>
<tr><td>S&auml;hk&ouml;posti</td> <td><input type="text" name="email" value="<?php echo $email;?>">
   <span class="error"> <?php echo $yhteystietoErr;?></span>

</td></tr>
<tr><td>Viesti</td> <td><textarea name="viesti" rows="5" cols="40"><?php echo $viesti;?></textarea></td></tr>
<tr><td><?php
echo "<input type='hidden' name='tunnus' value='$tunnus'>";
echo "<input type='hidden' name='matka' value='$matka'>";
echo "<input type='hidden' name='lisatoiveet' value='$lisatoiveet'>";
echo "<input type='hidden' name='lisatoiveethinta' value='$lisatoiveethinta'>";
echo "<input type='hidden' name='hinta' value='$hinta'>";
echo "<input type='hidden' name='ennakkotilauslisamaksu' value='$ennakkotilauslisamaksu'>";
echo "<input type='hidden' name='alv' value='$alv'>";
echo "<input type='hidden' name='brutto' value='$brutto'>";
echo "<input type='hidden' name='alvprossa' value='$alvprossa'>";
echo "<input type='hidden' name='mista' value='$mista'>";
echo "<input type='hidden' name='minne' value='$minne'>";
echo "<input type='hidden' name='pvm' value='$saapumispvm'>";
echo "<input type='hidden' name='klo' value='$saapumisklo'>";
echo "<input type='hidden' name='matkustajamaara' value='$matkustajamaara'>";
?></td> <td><input type="submit" name="tilaus" value="Tilaa"></td></tr>
</table>

<!-- </table> -->

</form>

<?php
	}

}

$checkbox = isset($_POST['lisamaksu']) ? $_POST['lisamaksu'] : 0;

// Otetaan lomakkeesta sy&ouml;tetyt tiedot (kun painetaan "Laske matka ja hinta" seuraavaa tapahtuu:

if (isset($_POST['laske'])){

$lisatoiveet='';
$lisatoiveetyhteensa='0';

for ($ruksi=0; $ruksi<sizeof($checkbox);$ruksi++) {

$toive=$checkbox[$ruksi];


$lisahinta=" ";

	if ($toive == "Tavarankuljetus"){
	$lisahinta=$tavarankuljetus;
	}
	elseif ($toive == "Avustus, invavarusteinen auto"){
	$lisahinta=$avustus1;
	}
	elseif ($toive == "Avustus portaissa, invavarusteinen auto"){
	$lisahinta=$avustus2;
	}
	elseif ($toive == "Paarilisä"){
	$lisahinta=$paarilisa;
	}
	else {
	$lisahinta=$avustus0;}

	
	$lisatoiveetyhteensa+=$lisahinta;

	if ($toive == "Ei avustusta"){
	$lisatoiveet.="";
	}
	else{
	$lisatoiveet.="| ".$toive." |";
	}

	
}
	

$mista=$_POST['mista'];
$minne=$_POST['minne'];
$pvm=$_POST['pvm'];
$tunnit=$_POST['tunnit'];
$minuutit=$_POST['minuutit'];
$matkustajamaara=$_POST['matkustajamaara'];

  $Hakkeriesto = array("<",">");

  if(preg_match("#(".implode("|",$Hakkeriesto).")#i", $mista)) {
    echo " ";
  } 

  elseif(preg_match("#(".implode("|",$Hakkeriesto).")#i", $minne)) {
    echo " ";
  }
  	else {


	if ($mista == "" && $minne == ""){
		echo " ";
	}
	elseif ($minne == ""){
		echo " ";
	}
	elseif ($mista == ""){
	echo " ";
	}
	else {

// L&auml;hetet&auml;&auml;n tiedot google mapsiin ja lasketaan et&auml;isyys saaduilla tiedoilla:

//directions

	// Our parameters
	$params = array(
		'origin'		=> $mista,
		'destination'	=> $minne,
		'sensor'		=> 'true',
		'units'			=> 'imperial'
	);
	$params_string=0;
	
	// Join parameters into URL string
	foreach($params as $var => $val){
   		$params_string .= '&' . $var . '=' . urlencode($val);  
	}
	
	// Request URL
	$url = "http://maps.googleapis.com/maps/api/directions/json?".ltrim($params_string, '&');
	
	// Make our API request
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$return = curl_exec($curl);
	curl_close($curl);
	
	// Parse the JSON response
	$directions = json_decode($return);
	
	// Show the total distance
	if(isset($directions->routes[0]->legs[0]->distance->text)){
		print($directions->routes[0]->legs[0]->distance->text);
	}
	else { 
		 //some error?
		print('virhe!');	
	}
	//print('<p><strong>Total distance:</strong> ' . $directions->routes[0]->legs[0]->distance->text . '</p>');
	
	// Loop through each step
	//print('<ol>');
	//foreach($directions->routes[0]->legs[0]->steps as $step) {
		//print('<li>'.$step->html_instructions.'</li>');
	//}
	//print('</ol>');

//-------


$tietokantayhteys== new mysqli('localhost', 'root', '', 'taxi')
or die ("Yhteytt&auml; tietokantaan ei saatu");
// Yhteys tietokantaan
//mysqli_select_db("taxi")
//or die ("Valittua tietokantaa ei l&ouml;ytynyt");

//sql-lause haku

// Otetaan valmiiksi sy&ouml;tetyt taksin hinnat, hinnat-taulukosta:

$lause="select lahtohinta, lahtohinta_muu, alvprosentti,taksa1, taksa2, taksa3, taksa4, ennakkotilausarvo from hinnat";
//					0			1			   2		3
$tulos=mysqli_query($tietokantayhteys, $lause) or die ("Syyst&auml;, jota en tied&auml;, tietoa ei saatu tietokannasta!").mysqli_error();

//_________________________________________________________________________

// Muutetaan matka kilometreiksi, lasketaan matkan hinta, lasketaan alv

while ($rivi = mysqli_fetch_array($tulos)){
	$matka=$directions->routes[0]->legs[0]->distance->text*1.609344;

// ---------- Lasketaan matkustajamäärä mukaan

	// taksa1, taksa2, taksa3, taksa4

	//1 - 2 henkilöä
	$taksa1=$rivi['taksa1'];
	//3 - 4 henkilöä
	$taksa2=$rivi['taksa2'];
	//5 - 6 henkilöä
	$taksa3=$rivi['taksa3'];
	//Yli 6 henkilöä
	$taksa4=$rivi['taksa4'];

	//matkustajahinta

	$matkustajahinta="0";

	if ($matkustajamaara > "0" && $matkustajamaara < "3") {
	$matkustajahinta=$taksa1;
	}
	elseif ($matkustajamaara > "2" && $matkustajamaara < "5") {
	$matkustajahinta=$taksa2;
	}
	elseif ($matkustajamaara > "4" && $matkustajamaara < "7") {
	$matkustajahinta=$taksa3;
	}
	else {
	$matkustajahinta=$taksa4;		
	}

	$kmhinta=$matkustajahinta;
	
	$hinta_ark_6_20_la_aat_6_16=$kmhinta*$matka+$rivi['lahtohinta'];
	
	$hinta_muu=$kmhinta*$matka+$rivi['lahtohinta_muu'];
	
	$alvprossa=$rivi[2];
	

$tilauspvm = strtotime($pvm);

$tilausviikonpaiva = date('D',$tilauspvm);

$tilaus_pv_kk = date('d.m',$tilauspvm);

$tilausvuosi = date('Y',$tilauspvm);

// Aatot tunnistetaan
//___________________________________________________________________________

// Aatot
$uudenvuodenaatto = "31.12";
$vapunaatto = "30.04";

// Juhannusaatto = Kesäkuun 19. ja 26. päivän väliset perjantai (aatto) ja lauantai (juhannuspäivä)

$juhannusalku = strtotime("19.6.$tilausvuosi");
$juhannusloppu = strtotime("26.6.$tilausvuosi");

$perjantai = strtotime("friday", $juhannusalku);
if ($juhannusalku <= $juhannusloppu) {
	$juhannusaatto = date("d.m", $perjantai);
}


$jouluaatto = "24.12";


//echo"Uusivuosi: ".$uudenvuodenaatto."<br>Vapunaatto: ".$vapunaatto."<br>Juhannusaatto: ".$juhannusaatto."<br>Jouluaatto: ".$jouluaatto."<p>";

//___________________________________________________________________
//	echo "<hr>";
//	echo "Päivämäärä:".$pvm."<br>";
//	echo " ".$tilauspvm."<br>";
//	echo "päivä.kk: ".$tilaus_pv_kk."<br>";
//	echo "vuosi: ".$tilausvuosi."<br>";
//	echo "tunti: ".$tunnit."<br><hr>";
	
	

	if ($tilaus_pv_kk==$uudenvuodenaatto){
		$aatto=$uudenvuodenaatto;
//	echo $aatto." Uusivuosi";
		}
	elseif ($tilaus_pv_kk==$vapunaatto){
		$aatto=$vapunaatto;
//	echo $aatto." Vappu";
		}
	elseif ($tilaus_pv_kk==$juhannusaatto){
		$aatto=$juhannusaatto;
//	echo $aatto." Jussi";
		}
	elseif ($tilaus_pv_kk==$jouluaatto){
		$aatto=$jouluaatto;
//	echo $aatto." Joulu";
		}
	else{
		$aatto="";
//	echo $aatto."Ei aatto";
	}


//---------------------------------------------------------------------

//	Arkisin klo 6 - 20
//	Lauantaisin ja aattoina klo 6 - 16	5,90 €
//  Muina ajankohtina			9,00 €

// Aattojen tsekkaus:

if ($tilaus_pv_kk == $aatto && $tilausviikonpaiva != "Sat" && $tunnit > "5" && $tunnit < "16") {
    $perushinta=$hinta_ark_6_20_la_aat_6_16;
} 

elseif ($tilaus_pv_kk == $aatto && $tilausviikonpaiva == "Sat" && $tunnit > "5" && $tunnit < "16") {
    $perushinta=$hinta_ark_6_20_la_aat_6_16;
}

elseif ($tilaus_pv_kk != $aatto && $tilausviikonpaiva == "Sat" && $tunnit > "5" && $tunnit < "16") {
    $perushinta=$hinta_ark_6_20_la_aat_6_16;
} 

elseif ($tilaus_pv_kk != $aatto && $tilausviikonpaiva != "Sat" && $tunnit > "5" && $tunnit < "20") {
    $perushinta=$hinta_ark_6_20_la_aat_6_16;
}

else {
   $perushinta=$hinta_muu;
}

//echo "Hinta: ".number_format($perushinta,2)." &#8364;<br><hr>";


//	echo "Aatto tai La (6-16): ".number_format($rivi[1],2)." &#8364;<br>";
//	echo "Arkena (6-20): ".number_format($rivi[1],2)." &#8364;<br>";
//	echo "Muina aikoina: ".number_format($rivi[0],2)." &#8364;<br>";

// -------- Ennakkotilauslisämaksu -kun kuljetus on tilattu vähintään 30 minuuttia ennen asiakkaan ilmoittamaa lähtöaikaa		7,10 €

$ennakkotilauslisamaksu = 0;
$ennakkotilausarvo =$rivi['ennakkotilausarvo'];

//Nykyaika
$paivamaara = date('d.m.Y');
$min = date('i') ;
$h = date('H');

//puoli tuntia tilauksen jälkeen
$puoli_minuutit = date("i", strtotime("+30 minutes"));
$puoli_tunnit = date("H", strtotime("+30 minutes"));
$puoli_pvm = date("d.m.Y", strtotime("+30 minutes"));


if ($tunnit == $puoli_tunnit && $puoli_minuutit >= $minuutit && $pvm == $puoli_pvm) {
	$ennakkotilauslisamaksu = 0;
}

//Tunnin vaihtuessa samana päivänä:
else if ($tunnit < $puoli_tunnit && $puoli_minuutit <= $minuutit && $pvm == $puoli_pvm) {
	$ennakkotilauslisamaksu = 0;
}

//Vuorokauden vaihtuessa

else if ($tunnit == "23" && $puoli_tunnit == "00" && $puoli_minuutit < $minuutit && $pvm < $puoli_pvm|| $tunnit == "00" && $puoli_tunnit == "00" && $puoli_minuutit > $minuutit && $pvm == $puoli_pvm) {
	$ennakkotilauslisamaksu = 0;
}

else {
	$ennakkotilauslisamaksu = $ennakkotilausarvo;
}


//_____LASKETAAN HINNAT YHTEEN!!!_________________

		$hinta=$perushinta+$ennakkotilauslisamaksu+$lisatoiveetyhteensa;

//________________ Alv_______________

		$alv=$hinta/100*$rivi[2];



	$brutto=$hinta+$alv;


echo "<hr>";

echo "<br>";
echo "<table border=0 cellpadding=3 cellspacing=2>";

echo "<table border=0 cellpadding=2>";
echo "<tr><td border=0><font size='+2'>".$mista." || ".$minne." </font></td></tr>";
echo "</table>";
echo "<table border=0 cellpadding=2 >";
//echo "<tr><td>".$mista."<hr></td> <td>=>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$minne."<hr></td></tr>";
echo "<tr><td width='130'>Saapumisaika<br>l&auml;ht&ouml;pisteeseen:</td> <td>".$pvm."<br>klo ".$tunnit.":".$minuutit."</td></tr>";
echo "<tr><td>Matkustajamäärä</td> <td>".$matkustajamaara."</td></tr>";
echo "<tr><td>Matka:</td> <td>".number_format($matka,2). " km</td></tr>";

if ($lisatoiveet != "") {
	echo "<tr><td>Lisätoiveet: </td> <td>".$lisatoiveet."</td></tr>";
	echo "<tr><td>Hinta lisätoiveista: </td> <td>".number_format($lisatoiveetyhteensa,2)." &#8364; </td></tr>";
	}

if ($ennakkotilauslisamaksu != 0) {
	echo "<tr><td>Ennakkotilauslisämaksu</td> <td>".number_format($ennakkotilauslisamaksu,2). " &#8364;</td></tr>";
	}

echo "<tr><td>Hinta:</td> <td>".number_format($hinta,2). " &#8364;</td></tr>";
echo "<tr><td>Alv:</td> <td>".number_format($alv,2). " &#8364; <i>(".round($alvprossa,0)." %)</i></td></tr>";
echo "<tr><td>Hinta + Alv: </td> <td>".number_format($brutto,2)." &#8364;</td></tr>";
echo "</table>";
echo "<br>";
?>
<h2>Tilaa taksi</h2>

<form action=" " method="post">
<table border=0 cellpadding=2>
<tr><td><b>Yhteystiedot:<br></b></td> <td></td></tr>
<tr><td>Puhelinnumero</td> <td><input type="text" name="puhnro" value="<?php echo $puhnro;?>">
   <span class="error"> <?php echo $yhteystietoErr;?></span>
</td></tr>
<tr><td>S&auml;hk&ouml;posti</td> <td><input type="text" name="email" value="<?php echo $email;?>">
   <span class="error"> <?php echo $yhteystietoErr;?></span>

</td></tr>
<tr><td>Viesti</td> <td><textarea name="viesti" rows="5" cols="40"><?php echo $viesti;?></textarea></td></tr>

<?php
echo "<input type='hidden' name='tunnus' value='$tunnus'>";
echo "<input type='hidden' name='matka' value='$matka'>";
echo "<input type='hidden' name='lisatoiveet' value='$lisatoiveet'>";
echo "<input type='hidden' name='lisatoiveethinta' value='$lisatoiveetyhteensa'>";
echo "<input type='hidden' name='hinta' value='$hinta'>";
echo "<input type='hidden' name='ennakkotilauslisamaksu' value='$ennakkotilauslisamaksu'>";
echo "<input type='hidden' name='alv' value='$alv'>";
echo "<input type='hidden' name='brutto' value='$brutto'>";
echo "<input type='hidden' name='alvprossa' value='$alvprossa'>";
echo "<input type='hidden' name='mista' value='$mista'>";
echo "<input type='hidden' name='minne' value='$minne'>";
echo "<input type='hidden' name='pvm' value='$pvm'>";
echo "<input type='hidden' name='klo' value='$tunnit:$minuutit'>";
echo "<input type='hidden' name='yhteystietoErr' value='$yhteystietoErr'>";
echo "<input type='hidden' name='matkustajamaara' value='$matkustajamaara'>";
?>
<tr><td></td> <td><input type="submit" name="tilaus" value="Tilaa"></td></tr>

</table>

</table>

</form>

<?php

				}
			}
	
	}

	}

}

?>

</td>
</tr>

</table>
<!-- InstanceEndEditable --></div>

</body>
<!-- InstanceEnd --></html>
