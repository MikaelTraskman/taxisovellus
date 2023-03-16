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

	<?php
		$tietokantayhteys=new mysqli('localhost', 'root', '', 'taxi')
		or die ("Yhteytt&auml; tietokantaan ei saatu");
		// Yhteys tietokantaan
		//mysql_select_db("a8675696_taxi")
		//or die ("Valittua tietokantaa ei l&ouml;ytynyt");

		//sql-lause haku

		// Otetaan valmiiksi sy&ouml;tetyt taksin hinnat, hinnat-taulukosta:

		$lause="select lahtohinta, lahtohinta_muu, alvprosentti,taksa1, taksa2, taksa3, taksa4, ennakkotilausarvo, tavarankuljetus, avustus1, avustus2, avustus0, paarilisa from hinnat";

		$tulos=mysqli_query($tietokantayhteys, $lause) or die ("Syyst&auml;, jota en tied&auml;, tietoa ei saatu tietokannasta!").mysqli_error();

		while ($rivi = mysqli_fetch_array($tulos)){


			$lahtohinta=$rivi['lahtohinta'];
			$lahtohinta_muu=$rivi['lahtohinta_muu'];
			$alvprosentti=$rivi['alvprosentti'];
			$taksa1=$rivi['taksa1'];
			$taksa2=$rivi['taksa2'];
			$taksa3=$rivi['taksa3'];
			$taksa4=$rivi['taksa4'];
			$ennakkotilausarvo=$rivi['ennakkotilausarvo'];
			$tavarankuljetus=$rivi['tavarankuljetus'];
			$avustus1=$rivi['avustus1'];
			$avustus2=$rivi['avustus2'];
			$paarilisa=$rivi['paarilisa'];
			$alvprosentti=$rivi['alvprosentti'];

		?>

	<table align="center" width="425" border="2" id="lomake">
		<tr>
		<td>
			<table align="center" width="400" border="0" cellpadding="10" id="lomake">
			<tr>
			<td>
			<font size="+2"><b>Hinnasto</b></font>
			<p>
			Perusmaksu
			<p>
			Perusmaksu lisätään automaattisesti taksamittarin laitettaessa päälle. Hinta lasketaan vuorokauden ajan ja pyhäpäivän mukaan.
			<br>
			<table align="center" border="1"  width="350" cellpadding="10" id="kuitti">
			<tr>
			<td width="200">Arkisin <br>klo 6.00 — 20.00<hr>Lauantaisin ja aattoina<br>klo 6.00 — 16.00</td><td><?php echo $lahtohinta."€"; ?></td>
			</tr>
			<tr>
			<td>
			Muuna aikana</td><td><?php echo $lahtohinta_muu."€"; ?></td>
			</tr>
			<td> 
			Odotusmaksu</td><td>44.60€/h</td>
			</tr>
			</table>
			<p>
			Taksin odotusaikana tai auton pienellä nopeudella liikkuessa hinta lasketaan odotustaksan mukaan.<br>
			Huomioi, että laskuri ei laske odotustaksaa mukaan, sillä laskettu hinta voi vaihdella.<p>
			Matkataksat<p>
			Matkataksat vaihtelevat kilometrien ja henkilömäärän mukaan. Kaksi alle kaksitoista vuotta vanhaa lasta lasketaan yhdeksi henkilöksi.
			<br>
			<table align="center" border="1"  width="350" cellpadding="10" id="kuitti">
			<tr>
				<td width="200"> Taksa I <hr>1-2 henkilöä</td><td><?php echo $taksa1."€"; ?>/km</td>
			</tr>
			<tr>
				<td> Taksa II <hr>3-4 henkilöä</td><td><?php echo $taksa2."€"; ?>/km</td>
			</tr>
			<tr>
				<td> Taksa III <hr>5-6 henkilöä</td><td><?php echo $taksa3."€"; ?>/km</td>
			</tr>
			<tr>
				<td> Taksa IV <hr>7-8 henkilöä</td><td><?php echo $taksa4."€"; ?>/km</td>
			</tr>
			</table>
			<p>
			Lisämaksut
			<p>
			<table align="center" border="1"  width="350" cellpadding="10" id="kuitti">
			<tr>
			<td width="200">
			Ennakkotilausmaksu</td><td><?php echo $ennakkotilausarvo."€"; ?></td>
			</tr>
			</table>
			<p>
			Lisämaksu lisätään, jos taksi tilataan ennakkoon.<p>
			<table align="center" border="1"  width="350" cellpadding="10" id="kuitti">
			<tr>
			<td width="200">
			Lentokenttälisä</td><td>2.30€</td>
			</tr>
			</table>
			<p>
			Lisämaksu peritään, jos taksi lähtee lentokentän taksiasemalta.
			Tämän hinnan taksi joutuu maksamaan päästäkseen terminaalin taksiasemalle.<p>
			<table align="center" border="1"  width="350" cellpadding="10" id="kuitti">
			<tr>
			<td width="200">
			Isokokoisten esineiden ja kotieläimien kuljettaminen</td><td><?php echo $tavarankuljetus."€"; ?></td>
			</tr>
			</table>
			<p>
			Tätä lisämaksua ei peritä normaalikokoisista matkatavaroista sekä opaskoirasta.<p>
			Avustamislisä<p>
			<table align="center" border="1"  width="350" cellpadding="10" id="kuitti">
			<tr>
			<td width="200">
			a) Lisätään, jos asiakas tarvitsee avustamista noutokohteesta autoon tai kuljetuksen päätepisteessä autosta sisätilaan.</td><td><?php echo $avustus1."€"; ?></td>
			</tr>
			<tr>
			<td>
			b) Lisätään, jos asiakas tarvitsee avustusta ja kuljetusta siten kuin a-kohdassa on mainittu ja häntä lisäksi vedetään käsivoimin 
			tai erityisen CEmerkityn porraskiipijän avulla rakennuksen sisällä olevissa portaissa tai luhtikäytävällä varustetun kerrostalon ulkopuolella olevissa portaissa.</td><td><?php echo $avustus2."€"; ?></td>
			</tr>
			<tr>
			<td>Paarilisä</td><td><?php echo $paarilisa."€"; ?></td>
			</tr>
			</table>
			<p>
			Lisätään asiakkaan kuljettamisessa tarvittavien paarien noutamisesta ja asentamisesta autoon ennen varsinaisen kuljetuksen alkua.<br>
			Hinnat sisältävät <?php echo number_format($alvprosentti,0); ?>% arvonlisäveron.<br>
			Taksihinnat ovat samat koko Suomessa ja ovat lain asetettuja.<br>
			Taksikyydin perushinta muodostuu perusmaksusta, kilometri- ja henkilömäärästä. Hintaan lisätään mahdolliset odotus- ja lisämaksut.
			</td>
			</tr>
			</table>
		</td>
		</tr>
		</table>

		<?php

		}

		?>
<!-- InstanceEndEditable --></div>

</body>
<!-- InstanceEnd --></html>