<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ylläpito</title>
</head>

<body>

			<?php
			date_default_timezone_set('Europe/Helsinki');

			$min = date('i') ;

			?>
			<?php
				session_start();
				if(isset($_POST['kirjaudu'])){

				$kayttaja=$_POST['kayttaja'];
				$salasana=$_POST['salasana'];

				include 'db.php';


				//sql-lause haku
				$lause="select * from kayttajat where kayttaja='$kayttaja' and salasana='$salasana'";

				//tuodaan tietoa tietokannasta
				$tulos=mysqli_query($tietokantayhteys,$lause) or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);

				if (mysqli_fetch_array($tulos)>0){

				$_SESSION['kayttaja']=$kayttaja;

				?>

	<table align="center" border="1">
	<tr>
	<td>

			<table width="530" cellpadding="4" cellspacing="12" border="0">

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

    		<h2> <center>Ylläpito</center> </h2>
    		<hr>
    		<form method="post" action="">
			<table width="515" cellpadding="4" cellspacing="12" border="0">

  			<tr>
  			<td>

  					<center>

  				Sisäänkirjautuminen:

  				<p>

  				<form method="post" action="kirjautumissivu.php">
				<table>
				<tr>
					<td>
						<?php
						echo "Tervetuloa ".$_SESSION['kayttaja'];
						echo "<br>";
						echo "Olet kirjautunut sisään!";
						?>
					</td>
				</tr>
					<td>

					</td>
				</table>

				</form>
					</center>

  			</td>
  			</tr>
  		</table>

	</td>
	</tr>
	</table>

				<?php
		
//				header("Location:index.php");
				}
	
			}
				else {
					?>

	<table align="center" border="1">
	<tr>
	<td>

			<table width="530" cellpadding="4" cellspacing="12" border="0">

  			<tr>
  			<td>
    	<th>
    	</th>
    		</td>

    		</tr>

    		</table>

    		<h2> <center>Ylläpito</center> </h2>
    		<hr>
    		<form method="post" action="">
			<table width="515" cellpadding="4" cellspacing="12" border="0">

  			<tr>
  			<td>

  					<center>

  				Sisäänkirjautuminen:

  				<p>

  				<form method="post" action="kirjautumissivu.php">
				<table>
				<tr>
					<td>k&auml;ytt&auml;j&auml;tunnus </td><td><input type="text" name="kayttaja"></td>
				</tr>
				<tr>
					<td>salasana</td><td><input type="password" name="salasana"></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" name="kirjaudu" value="kirjaudu sis&auml;lle"></td>
				</tr>
				</table>

				</form>
					</center>

  			</td>
  			</tr>
  		</table>

	</td>
	</tr>
	</table>

					<?php
				}
			?>


</body>
</html>
