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
<title>Asetukset</title>
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
			  <?php
				include 'menu.php';
				?>
    		</td>

    		</tr>

    		</table>

    <h2> <center>Asetukset</center> </h2>
    <hr>
    	<form method="post" action="">
			<table width="530" cellpadding="2" cellspacing="12" border="0">

  			<tr>
			<td valign="top" width="140"><center><input type="submit" name="hinnat" value="Hinnat">&nbsp;<input type="submit" name="kayttajat" value="Käyttäjät"></center></td>
			</td>
			</tr>

			<?php

			if (isset($_POST['hinnat'])){

					header("Location: hinnat.php");

						}

			if (isset($_POST['kayttajat'])){

					header("Location: kayttajat.php");

						}

			?>
 
			<tr>



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
