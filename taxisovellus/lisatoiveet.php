<?php
include 'db.php';

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
}
	
//echo "tavarankuljetus ".$tavarankuljetus."<br>";
//echo "avustus1 ".$avustus1."<br>";
//echo "avustus2 ".$avustus2."<br>";
//echo "avustus0 ".$avustus0."<br>";
//echo "paarilisa ".$paarilisa."<br>";

        ?>