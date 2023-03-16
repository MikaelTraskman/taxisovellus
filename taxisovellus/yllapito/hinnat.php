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
<title>Hinnat</title>
</head>

<body>
			<?php
			date_default_timezone_set('Europe/Helsinki');

			$min = date('i') ;

			?>


	<table align="center" border="1">
	<tr>
	<td>

			<table width="530" cellpadding="6" cellspacing="12" border="0">

  			<tr>
  			<td>
  		<center>
    	<table>
    		<tr>
    		<td>
    	<a href="tilaukset.php" method="post" name="tilaukset"> Tilaukset </a>&nbsp;&nbsp;
    	</td>
    	<td>
    	<a href="viestit.php" name="viestit"> Viestit </a>&nbsp;&nbsp;
    	</td>
    	<td>
    	<a href="asetukset.php" name="asetukset"> Asetukset </a>&nbsp;&nbsp;
    	</td>
    	<td>
    	<a href="kuvanlataus/kuvanlatauslomake.php" name="kuvanlataus"> Kuvanlataus </a>
    	</td>
    	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    	<td>
    	<i><?php echo $_SESSION['kayttaja'] ?></i><hr>
    	<form method="post" action="">
		<input type="submit" name="nappi" value="kirjaudu ulos">
		</form>
		<?php
		if (isset($_POST['nappi'])){
		unset($_SESSION['kayttaja']);
		header("Location:index.php");
		}
		?>
		</td>
			</tr>
    	</table>
    	</center>
    		</td>

    		</tr>

    		</table>

    <h2> <center>Asetukset</center> </h2>
    <hr>
    	<form method="post" action="">
			<table width="530" cellpadding="2" cellspacing="12" border="0">

  			<tr>
			<td valign="top" width="140"><input type="submit" name="hinnat" value="Hinnat">&nbsp;<input type="submit" name="kayttajat" value="Käyttäjät"><td></td><td width="160"></td>
			</td>
			</tr>
 
			<tr>
			<td valign="top">

			<?php

			if (isset($_POST['kayttajat'])){

			header("Location: kayttajat.php");

			}

			if (isset($_POST['hinnat'])){

			header("Location: hinnat.php");

			}


			include("db.php");
				
			$result=mysqli_query($tietokantayhteys, "SELECT * FROM hinnat");
			
			while($test = mysqli_fetch_array($result))
			{
				$id = $test['ID'];
				if (isset($_POST['virk'])){

					header("Location: hinnat.php");

						}

				echo "<tr>";
				echo "<td><b>Hinnat</b></td><td></td><td></td>";
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_lahtohinta'])){
							$id=$_POST['ID'];
							$lahtohinta=$_POST['lahtohinta'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET lahtohinta ='$lahtohinta' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_lahtohinta'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Lähtohinta</td><td><font color='black'><input type='text' size='4' name='lahtohinta' value='".$test['lahtohinta']."'> &#8364;</font></td><td><input type='submit' name='tall_lahtohinta' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Lähtohinta</td><td><font color='black'>" .$test['lahtohinta']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_lahtohinta' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";

				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_lahtohinta_muu'])){
							$id=$_POST['ID'];
							$lahtohinta_muu=$_POST['lahtohinta_muu'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET lahtohinta_muu ='$lahtohinta_muu' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_lahtohinta_muu'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Lähtohinta muu</td><td><font color='black'><input type='text' size='4' name='lahtohinta_muu' value='".$test['lahtohinta_muu']."'> &#8364;</font></td><td><input type='submit' name='tall_lahtohinta_muu' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Lähtohinta muu</td><td><font color='black'>" .$test['lahtohinta_muu']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_lahtohinta_muu' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";

				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_alvprosentti'])){
							$id=$_POST['ID'];
							$alvprosentti=$_POST['alvprosentti'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET alvprosentti ='$alvprosentti' WHERE ID = '$id'")
								or die(mysqli_error($tietokantayhteys)); 
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_alvprosentti'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Alvprosentti</td><td><font color='black'><input type='text' size='4' name='alvprosentti' value='".$test['alvprosentti']."'> % </font></td><td><input type='submit' name='tall_alvprosentti' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
					echo "<td>Alvprosentti</td><td><font color='black'>" .$test['alvprosentti']." % </font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_alvprosentti' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";

				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_taksa1'])){
							$id=$_POST['ID'];
							$taksa1=$_POST['taksa1'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET taksa1 ='$taksa1' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_taksa1'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Taksa1</td><td><font color='black'><input type='text' size='4' name='taksa1' value='".$test['taksa1']."'> &#8364;/km</font></td><td><input type='submit' name='tall_taksa1' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Taksa1</td><td><font color='black'>" .$test['taksa1']." &#8364;/km</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_taksa1' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_taksa2'])){
							$id=$_POST['ID'];
							$taksa2=$_POST['taksa2'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET taksa2 ='$taksa2' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_taksa2'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Taksa2</td><td><font color='black'><input type='text' size='4' name='taksa2' value='".$test['taksa2']."'> &#8364/km </font></td><td><input type='submit' name='tall_taksa2' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Taksa2</td><td><font color='black'>" .$test['taksa2']." &#8364;/km</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_taksa2' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_taksa3'])){
							$id=$_POST['ID'];
							$taksa3=$_POST['taksa3'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET taksa3 ='$taksa3' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_taksa3'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Taksa3</td><td><font color='black'><input type='text' size='4' name='taksa3' value='".$test['taksa3']."'> &#8364/km </font></td><td><input type='submit' name='tall_taksa3' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Taksa3</td><td><font color='black'>" .$test['taksa3']." &#8364;/km</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_taksa3' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_taksa4'])){
							$id=$_POST['ID'];
							$taksa4=$_POST['taksa4'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET taksa4 ='$taksa4' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_taksa4'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Taksa4</td><td><font color='black'><input type='text' size='4' name='taksa4' value='".$test['taksa4']."'> &#8364/km </font></td><td><input type='submit' name='tall_taksa4' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Taksa4</td><td><font color='black'>" .$test['taksa4']." &#8364;/km</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_taksa4' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_tavarankuljetus'])){
							$id=$_POST['ID'];
							$tavarankuljetus=$_POST['tavarankuljetus'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET tavarankuljetus ='$tavarankuljetus' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_tavarankuljetus'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Tavarankuljetus</td><td><font color='black'><input type='text' size='4' name='tavarankuljetus' value='".$test['tavarankuljetus']."'> &#8364;</font></td><td><input type='submit' name='tall_tavarankuljetus' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Tavarankuljetus</td><td><font color='black'>" .$test['tavarankuljetus']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_tavarankuljetus' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";

				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_avustus1'])){
							$id=$_POST['ID'];
							$avustus1=$_POST['avustus1'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET avustus1 ='$avustus1' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_avustus1'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Avustus1</td><td><font color='black'><input type='text' size='4' name='avustus1' value='".$test['avustus1']."'> &#8364;</font></td><td><input type='submit' name='tall_avustus1' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Avustus1</td><td><font color='black'>" .$test['avustus1']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_avustus1' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_avustus2'])){
							$id=$_POST['ID'];
							$avustus2=$_POST['avustus2'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET avustus2 ='$avustus2' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_avustus2'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Avustus2</td><td><font color='black'><input type='text' size='4' name='avustus2' value='".$test['avustus2']."'> &#8364;</font></td><td><input type='submit' name='tall_avustus2' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Avustus2</td><td><font color='black'>" .$test['avustus2']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_avustus2' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_avustus0'])){
							$id=$_POST['ID'];
							$avustus0=$_POST['avustus0'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET avustus0 ='$avustus0' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_avustus0'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Ei avustusta</td><td><font color='black'><input type='text' size='4' name='avustus0' value='".$test['avustus0']."'> &#8364;</font></td><td><input type='submit' name='tall_avustus0' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Ei avustusta</td><td><font color='black'>" .$test['avustus0']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_avustus0' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_paarilisa'])){
							$id=$_POST['ID'];
							$paarilisa=$_POST['paarilisa'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET paarilisa ='$paarilisa' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_paarilisa'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Paarilisa</td><td><font color='black'><input type='text' size='4' name='paarilisa' value='".$test['paarilisa']."'> &#8364;</font></td><td><input type='submit' name='tall_paarilisa' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Paarilisa</td><td><font color='black'>" .$test['paarilisa']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_paarilisa' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";


						if (isset($_POST['tall_ennakkotilausarvo'])){
							$id=$_POST['ID'];
							$ennakkotilausarvo=$_POST['ennakkotilausarvo'];

								mysqli_query($tietokantayhteys, "UPDATE hinnat SET ennakkotilausarvo ='$ennakkotilausarvo' WHERE ID = '$id'")
								or die(mysql_error($tietokantayhteys));  
	
								header("Location: hinnat.php");
						}

					if (isset($_POST['muok_ennakkotilausarvo'])){
					echo "<form>";
					$id=$_POST['ID'];
					echo "<input type='hidden' name='ID' value='$id'>";
					echo "<td>Ennakkotilaushinta</td><td><font color='black'><input type='text' size='4' name='ennakkotilausarvo' value='".$test['ennakkotilausarvo']."'> &#8364;</font></td><td><input type='submit' name='tall_ennakkotilausarvo' value='Tallenna'>&nbsp;<input type='submit' name='virk' value='Takaisin'></td>";
					echo "</form>";

					}
					else {
				echo "<td>Ennakkotilaushinta</td><td><font color='black'>" .$test['ennakkotilausarvo']." &#8364;</font></td><td>";
				 if ($_SESSION['kayttaja']=='paakayttaja'){ echo "<input type='submit' name='muok_ennakkotilausarvo' value='Muokkaa'> ";
				}
				echo "&nbsp;</td>";
					}
				echo "<input type='hidden' name='ID' value='$id'>";
				
				//----------
				echo "</tr><tr>";
									
				echo "</tr>";
			}
			mysqli_close($tietokantayhteys);
			?>


			</td>
			</tr>
		</form>
  
			</table>


	</td>
	</tr>
	</table>
</body>
<?php } ?>
</html>
