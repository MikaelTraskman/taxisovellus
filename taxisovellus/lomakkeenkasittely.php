<?php
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

include 'api.php';

include 'db.php';

//sql-lause haku

// Otetaan valmiiksi sy&ouml;tetyt taksin hinnat, hinnat-taulukosta:

$lause="select lahtohinta, lahtohinta_muu, alvprosentti,taksa1, taksa2, taksa3, taksa4, ennakkotilausarvo from hinnat";
//					0			1			   2		3
$tulos=mysqli_query($tietokantayhteys, $lause) or die ("Syyst&auml;, jota en tied&auml;, tietoa ei saatu tietokannasta!").mysqli_error();

//_________________________________________________________________________

// Muutetaan matka kilometreiksi, lasketaan matkan hinta, lasketaan alv

while ($rivi = mysqli_fetch_array($tulos)){
	$matka=((int)$data->rows[0]->elements[0]->distance->value / 1000);

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

?>