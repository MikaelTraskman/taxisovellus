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