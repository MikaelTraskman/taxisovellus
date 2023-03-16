<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();

include 'db.php';
if (isset($_SESSION['kayttaja'])){
$kayttaja=$_SESSION['kayttaja'];
//sql-lause haku
$lause="select * from kayttajat";

$tulos=mysqli_query($tietokantayhteys,$lause) or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);
?>
<title>Taksitilaukset</title>
</head>

<body>

			<?php
			date_default_timezone_set('Europe/Helsinki');

			$min = date('i') ;

			?>


	<table align="center" border="1">
	<tr>
	<td>

			<table width="530" cellpadding="4" cellspacing="12" border="0">

  			<tr>
  			<td>
			  <?php
				include 'menu.php';
				?>
    		</td>

    		</tr>

    		</table>

    <h2> <center>Tilaukset</center> </h2>
    <hr>
    	<form method="post" action="">
			<table width="515" cellpadding="4" cellspacing="12" border="0">

  			<tr>
			<td valign="top">Lähtöpaikka:<p>Aikavälillä:
			</td>
			<td valign="top">
			<!-- Tulostetaan kaupunki-valikko -->
			<input type="text" name="lahtopaikka" >
			<p>
				<?php
				$ekapaiva = date('d.m.Y');
				?>

			<input type="text" name="ekapaiva" id="muutos" value="<?php echo $ekapaiva;?>">
			 - 
			<input type="text" name="vikapaiva" id="muutos" value="<?php echo $ekapaiva;?>">
			<p>
			<input type="submit" name="etsi" value="Etsi">

		</form>
			</td>
			</tr>
  
			</table>

<?php
	if (isset($_POST['poista'])){

	$id=$_POST['ID'];

	// sending query
	include 'db.php';

	mysqli_query($tietokantayhteys, "DELETE FROM tilaus WHERE ID = '$id'")
	or die(mysqli_error($tietokantayhteys));

	$lahtopaikka=$_POST['lahtopaikka'];
	$ekapaiva=date ('Y-m-d', strtotime($_POST['ekapaiva']));
	$vikapaiva=date ('Y-m-d', strtotime($_POST['vikapaiva']));

	$epaiva = date ("d.m.Y", strtotime("$ekapaiva"));

	$vpaiva= date ("d.m.Y", strtotime("$vikapaiva"));

?>
	<table width="520" cellpadding="4" cellspacing="12" border="0">
	<tr><td>
<?php echo $epaiva." - ".$vpaiva; ?>
	</td></tr>
  	</table>

<hr>

	<table width="520" cellpadding="4" cellspacing="8" border="0">
	
			<?php
			include 'db.php';
				
			$result=mysql_query("SELECT * FROM tilaus where mista LIKE '%$lahtopaikka%' ORDER BY 'ID' ASC");
			
			while($test = mysql_fetch_array($result))
			{
				$spvm=date ('Y-m-d', strtotime($test['saapumispvm']));
				$id = $test['ID'];

				if ($ekapaiva <= $spvm && $spvm <= $vikapaiva) {	
				echo "<tr>";
				?>
				<form action=" " method="post">
				<?php
				echo "<input type='hidden' name='ekapaiva' value='$ekapaiva'>";
				echo "<input type='hidden' name='vikapaiva' value='$vikapaiva'>";
				echo "<input type='hidden' name='lahtopaikka' value='$lahtopaikka'>";
				echo "<input type='hidden' name='ID' value='$id'>";

				?>
				<td valign="top"><input type="submit" name="poista" value="poista"></td>
				<?php
				echo "<td style='LINE-HEIGHT:20px;'><font color='black'>Matka: <b>" . $test['mista'] ." || ". $test['minne'] ."</b><br>";
				?>
				<table>
					<tr><td width='150'>
				<?php

				echo "Saapumisaika<br>lähtöpisteeseen: </td><td>". $test['saapumispvm'] .", ". $test['saapumisklo']. "</td></tr>";
				echo "<tr><td>Lisätarpeet: </td><td>". $test['lisatoiveet'] ."</td></tr>";
				echo "<tr><td>Hinta-arvio<br>(Hinta + alv " .$test['alvprossa']." %): </td><td>". $test['brutto'] ."€ </td></tr>";						
				echo "<tr><td>Matkustajamäärä: </td><td>" . $test['matkustajamaara'] ."</td></tr>";
				echo "<tr><td>Puhelinnumero: </td><td>" . $test['puhnro'] ."</td></tr>";
				echo "<tr><td>Sähköposti: </td><td>". $test['email']."</td></tr>";
				echo "<tr><td>Matkan pituus: </td><td>". $test['matka'] ."km </td></tr>";
				echo "<tr><td>Hinta lisätarpeista<br>(laskettu hintaan): </td><td>". $test['lisatoiveethinta'] ."€ </td></tr>";
				echo "<tr><td>Viesti: </td><td>" .$test['viesti']."</td></tr>";
				echo "<tr><td>Tilaus tehty: </td><td>". $test['tilauspvm'] .", ". $test['tilausklo']." ";

				?>
					</td></tr>
				</table>
				<hr>
				</td>
				<?php					
				echo "</tr>";
				}
			}
			?>
			</table>

			<?php

		}

			?>


<?php


// ----------------------------------
	
	if (isset($_POST['etsi'])){

	$lahtopaikka=$_POST['lahtopaikka'];
	$ekapaiva=date ('Y-m-d', strtotime($_POST['ekapaiva']));
	$vikapaiva=date ('Y-m-d', strtotime($_POST['vikapaiva']));

	$epaiva = date ("d.m.Y", strtotime("$ekapaiva"));

	$vpaiva= date ("d.m.Y", strtotime("$vikapaiva"));

?>
	<table width="520" cellpadding="4" cellspacing="12" border="0">
	<tr><td>
<?php echo $epaiva." - ".$vpaiva; ?>
	</td></tr>
  	</table>

<hr>

	<table width="520" cellpadding="4" cellspacing="8" border="0">
	
			<?php
			include 'db.php';
				
			$result=mysqli_query($tietokantayhteys, "SELECT * FROM tilaus where mista LIKE '%$lahtopaikka%' ORDER BY 'ID' DESC");
			
			while($test = mysqli_fetch_array($result))
			{
				$spvm=date ('Y-m-d', strtotime($test['saapumispvm']));
				$id = $test['ID'];

				if ($ekapaiva <= $spvm && $spvm <= $vikapaiva) {	
				echo "<tr>";
				?>
				<form action=" " method="post">
				<?php
				echo "<input type='hidden' name='ekapaiva' value='$ekapaiva'>";
				echo "<input type='hidden' name='vikapaiva' value='$vikapaiva'>";
				echo "<input type='hidden' name='lahtopaikka' value='$lahtopaikka'>";
				echo "<input type='hidden' name='ID' value='$id'>";

				?>
				<td valign="top"><input type="submit" name="poista" value="poista"></td>
				</form>
				<?php
				echo"<td style='LINE-HEIGHT:20px;'><font color='black'>Matka: <b>" . $test['mista'] ." || ". $test['minne'] ."</b><br>";
				?>
				<table>
					<tr><td width='150'>
				<?php
				echo "Saapumisaika<br>lähtöpisteeseen: </td><td>". $test['saapumispvm'] .", ". $test['saapumisklo']. "</td></tr>";
				echo "<tr><td>Lisätarpeet: </td><td>". $test['lisatoiveet'] ."</td></tr>";
				echo "<tr><td>Hinta-arvio<br>(Hinta + alv " .$test['alvprossa']." %): </td><td>". $test['brutto'] ."€ </td></tr>";						
				echo "<tr><td>Matkustajamäärä: </td><td>" . $test['matkustajamaara'] ."</td></tr>";
				echo "<tr><td>Puhelinnumero: </td><td>" . $test['puhnro'] ."</td></tr>";
				echo "<tr><td>Sähköposti: </td><td>". $test['email']."</td></tr>";
				echo "<tr><td>Matkan pituus: </td><td>". $test['matka'] ."km </td></tr>";
				echo "<tr><td>Hinta lisätarpeista<br>(laskettu hintaan): </td><td>". $test['lisatoiveethinta'] ."€ </td></tr>";
				echo "<tr><td>Viesti: </td><td>" .$test['viesti']."</td></tr>";
				echo "<tr><td>Tilaus tehty: </td><td>". $test['tilauspvm'] .", ". $test['tilausklo']." ";

				?>
					</td></tr>
				</table>
				<hr>
				</td>
				<?php					
				echo "</tr>";
				}
			}
			?>
			</table>
			<?php
		}

			?>
		

	</td>
	</tr>
	</table>

</body>
<?php } ?>
</html>
