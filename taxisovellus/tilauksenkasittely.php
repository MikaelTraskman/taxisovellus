<?php

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

        include 'db.php';
	
	// Pistet&auml;&auml;n tilauksen tiedot tietokantaan:

	$muistiin = "insert into tilaus 
				(tunnus, puhnro, email, mista, minne, matka, lisatoiveet, lisatoiveethinta, hinta, 
				alv, brutto, alvprossa, saapumispvm, saapumisklo, viesti, tilauspvm, tilausklo, matkustajamaara, ennakkotilauslisamaksu) 
							 values 
				('$tunnus','$puhnro','$email','$mista','$minne','$matka','$lisatoiveet','$lisatoiveethinta','$hinta',
				'$alv','$brutto','$alvprossa','$saapumispvm','$saapumisklo','$viesti','$tilauspvm','$tilausklo','$matkustajamaara','$ennakkotilauslisamaksu')";
	//               1         2         3	     4	     5        6        	7      				8         	  9      
	//			  10      11          12           13          	  14		   15			16			17              18                  19

	mysqli_query($tietokantayhteys, $muistiin) or die ("Tieto ei tallentunut tietokantaan".mysqli_error($tietokantayhteys));

	// Otetaan tilauksen tiedot "tilaus"-taulukosta:

	$lause="select tunnus, puhnro, email, mista, minne, matka, lisatoiveet, hinta, alv, brutto, alvprossa, saapumispvm, saapumisklo, viesti, tilauspvm, tilausklo from tilaus where tunnus=$tunnus";
	//               0	     1       2      3	   4	  5     	 6     	  7     8      9      10      		11      	12        13		 14			15
	$tulos=mysqli_query($tietokantayhteys, $lause) or die ("Syyst&auml;, jota en tied&auml;, tietoa ei saatu tietokannasta").mysqli_error($tietokantayhteys);

	while ($rivi = mysqli_fetch_array($tulos)){

	
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
		include 'alt_tulos.php';
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

</form>

<?php
	}