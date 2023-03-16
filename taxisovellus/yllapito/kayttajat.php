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
<title>Käyttäjät</title>
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
			<td valign="top"><input type="submit" name="hinnat" value="Hinnat">&nbsp;<input type="submit" name="kayttajat" value="Käyttäjät"></td>
			</td>
			</tr>
 
			<tr>
			<td valign="top">
			<b>Käyttäjät</b><p>
		</form>

			<?php

			if (isset($_POST['kayttajat'])){

			header("Location: kayttajat.php");

			}

			if (isset($_POST['hinnat'])){

			header("Location: hinnat.php");

			}


			
			if (isset($_POST['virk'])){

					header("Location: kayttajat.php");

						}

		?>

    		<table>
    		<tr><td valign="top">

		<form method="post" action"">
		<table cellspacing="2" width="255">
		<tr><td height="10" valign="top"><u><i>Valitse käyttäjä</i></u><br></td><td></td></tr>
		<tr><td valign="top">

		<?php

			include 'db.php';
			
			$result=mysqli_query($tietokantayhteys,"select * from kayttajat");

			?>

			<form action="" id="" method="post">

			<select name="kayttaja" size="1">

			<?php
			while($test = mysqli_fetch_array($result)){

			echo "<option value=".$test['kayttaja'].">";

			echo $test['kayttaja'];
			echo "</option>";

			echo "<p>";

			}

		?>	
			</select>

		</form>
		</td></tr>
		<tr>
		<td><input type="submit" name="etsi" value="Etsi" /></td>
		</tr>
		</tr>
		<tr>
		<td  height="80"></td>
		</tr>
		</table>

			</td><td>

		<table cellspacing="2" width="120" height="160" border="0">
		<form method="post" action"">
		<tr><td height="10" valign="top"><u><i>Lisää käyttäjä</i></u> <br></td><td><i>(ei välilyöntejä)</i></td></tr>
		<tr>
		<td>Käyttäjä:</td>
		<td><input type="text" name="kayttaja" /></td>
		</tr>
		<tr>
		<td>Käyttäjätyyppi </td>
		<td><input type="text" name="kayttajatyyppi" /></td>
		</tr>
		<tr>
		<td>Sähköposti</td>
		<td><input type="text" name="email" /></td>
		</tr>
		<tr>
		<td>Salasana</td>
		<td><input type="password" name="salasana" /></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="lisaa" value="Lisää" /></td>
		</tr>
		</table>

		</form>

			</td></tr>
			</table>


    		<table>
    		<tr ><td valign="top" width="500">		

    			<hr>
		<table width="400">
		<?php
		if (isset($_POST['lisaa']))
		{	   
		include 'db.php';
	
			 		$kayttaja=$_POST['kayttaja'] ;
			 		$kayttajatyyppi=$_POST['kayttajatyyppi'] ;
					$email=$_POST['email'] ;					
					$salasana=$_POST['salasana'] ;
		
//		mysqli_query($tietokantayhteys,"insert into kayttajat values('$kayttaja','$kayttajatyyppi','$email','$salasana')".mysqli_error($tietokantayhteys));

			$lause="insert into kayttajat(kayttaja, kayttajatyyppi, email, salasana) 
			values('$kayttaja','$kayttajatyyppi','$email','$salasana')";

			mysqli_query($tietokantayhteys, $lause) or die ("Tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);

			header("Location: kayttajat.php");
				
	        }

	     
	     		if (isset($_POST['muokkaa'])){
				?>
				 <form method="post" action="">
				 <tr>
				 <input type="hidden" name="ID" value="<?php echo $_POST["ID"];?>">
				 <td><b>Käyttäjä: </b><input type="text" size="10" name="kayttaja" value="<?php echo $_POST["kayttaja"];?>"><br>
				 <b>Käyttäjätyyppi: </b><input type="text" size="10" name="kayttajatyyppi" value="<?php echo $_POST["kayttajatyyppi"];?>"><br>
				 <b>Sähköposti: </b><br><input type="text" size="25" name="email" value="<?php echo $_POST["email"];?>"><br>
				 <b>Salasana: </b><input type="text" size="10" name="salasana" value="<?php echo $_POST["salasana"];?>">

				 <td align="left" valign="top"><input type="submit" name="tallenna" value="Tallenna"><p><input type="submit" name="virk" value="Takaisin"></td>

				 </tr>
				 </form>

				<?php
				}
		//-----------------------------
				if (isset($_POST['tallenna'])){
				$id=$_POST['ID'];
				$kayttaja=$_POST['kayttaja'];
				$kayttajatyyppi=$_POST['kayttajatyyppi'];
				$email=$_POST['email'];
				$salasana=$_POST['salasana'];

				include 'db.php';

				mysqli_query($tietokantayhteys,"UPDATE kayttajat SET kayttaja ='$kayttaja', kayttajatyyppi = '$kayttajatyyppi', email= '$email', salasana = '$salasana' WHERE kayttaja = '$kayttaja'")
				or die(mysql_error());

				include 'db.php';
	
				$result=mysqli_query($tietokantayhteys,"SELECT * FROM kayttajat WHERE kayttaja='$kayttaja'");
			
				while($test = mysqli_fetch_array($result)){

				?>
				 <form method="post" action="">
				 <tr>
				 <td><b>Käyttäjä: </b><?php echo $test["kayttaja"];?><br><b>Käyttäjätyyppi: </b><?php echo $test["kayttajatyyppi"];?><br>
				 	<b>Sähköposti: </b><br><?php echo $test["email"];?><br><b>Salasana: </b><?php echo $test["salasana"];?>
				 </td>
				 <input type="hidden" name="ID" value="<?php echo $test["ID"];?>">
				 <input type="hidden" name="kayttaja" value="<?php echo $test["kayttaja"];?>">
				 <input type="hidden" name="kayttajatyyppi" value="<?php echo $test["kayttajatyyppi"];?>">
				 <input type="hidden" name="email" value="<?php echo $test["email"];?>">
				 <input type="hidden" name="salasana" value="<?php echo $test["salasana"];?>">
				 <?php
				 if ($_SESSION['kayttaja']==$kayttaja || $_SESSION['kayttaja']=='paakayttaja'){
				 ?>
				 <td align="left" valign="top"><input type="submit" name="muokkaa" value="Muokkaa"><p><input type="submit" name="poista" value="Poista"></td>
				 <?php } ?>
				 </tr>
				 </form>
				<?php

				}
						}

		//----------------------------
	     if (isset($_POST['etsi'])){

	     	$kayttaja=$_POST['kayttaja'];

			include 'db.php';
				
			$result=mysqli_query($tietokantayhteys,"SELECT * FROM kayttajat WHERE kayttaja='$kayttaja'");
			
			while($test = mysqli_fetch_array($result)){


				?>
				 <form method="post" action="">
				 <tr>
				 <td><b>Käyttäjä: </b><?php echo $test["kayttaja"];?><br><b>Käyttäjätyyppi: </b><?php echo $test["kayttajatyyppi"];?><br>
				 	<b>Sähköposti: </b><br><?php echo $test["email"];?>
				 	<?php
				 	if ($_SESSION['kayttaja']==$kayttaja){
				 	?>
				 	<br><b>Salasana: </b><?php echo $test["salasana"];?>
				 	<?php } ?>
				 </td>
				 <input type="hidden" name="ID" value="<?php echo $test["ID"];?>">
				 <input type="hidden" name="kayttaja" value="<?php echo $test["kayttaja"];?>">
				 <input type="hidden" name="kayttajatyyppi" value="<?php echo $test["kayttajatyyppi"];?>">
				 <input type="hidden" name="email" value="<?php echo $test["email"];?>">
				 <input type="hidden" name="salasana" value="<?php echo $test["salasana"];?>">

				 <?php
				 if ($_SESSION['kayttaja']==$kayttaja || $_SESSION['kayttaja']=='paakayttaja'){
				 ?>
				 </td>
				 <td align="left" valign="top"><input type="submit" name="muokkaa" value="Muokkaa"><p><input type="submit" name="poista" value="Poista"></td>
				 <?php } ?>
				 </tr>
				 </form>
				<?php

				}

			}

		//----------------------------------------------------------

			if (isset($_POST['poista'])){

					$id=$_POST['ID'];
						// sending query
					include 'db.php';

					mysqli_query($tietokantayhteys,"DELETE FROM kayttajat WHERE ID = '$id'")
					or die(mysql_error());

					header("Location: kayttajat.php");

				}



//			mysql_close($conn);

			?>
			</table>

			 </td>
			</tr>
		</form>
			</table>


			</td>
			</tr>
  
			</table>


	</td>
	</tr>
	</table>
</body>
<?php } ?>
</html>
