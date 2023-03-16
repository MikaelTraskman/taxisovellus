<?php
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