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
$lause="select * from kayttajat;";

$tulos=mysqli_query($tietokantayhteys,$lause) 
or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);
?>
<title>Viestit</title>
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

    <h2> <center>Viestit</center> </h2>
    <hr>
			<table width="525" cellpadding="8" cellspacing="5" border="0">

  			<tr>
			<td valign="top" width="220">
			<?php
			include 'viestit_saapuneet.php';
			?>
			</td>
			<td valign="top">
			<?php
			include 'viesti_kirjoita.php';
			?>			
			</td>
			</tr>
  
			</table>
<?php
	if (isset($_POST['etsi'])){

    $vastaanottaja=$_POST['vastaanottaja'];
    $ekapaiva=date ('Y-m-d', strtotime($_POST['ekapaiva']));
    $vikapaiva=date ('Y-m-d', strtotime($_POST['vikapaiva']));
        
    $epaiva = date ("d.m.Y", strtotime("$ekapaiva"));
        
    $vpaiva= date ("d.m.Y", strtotime("$vikapaiva"));
        
?>
    <table width="520" cellpadding="0" cellspacing="0" border="0">
    <tr><td>
	<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;".$epaiva." - ".$vpaiva; ?>
    </td></tr>
    </table>
        
    <hr>
        
    <table width="520" cellpadding="4" cellspacing="8" border="0">
            
                    
    <?php
        
    //include 'db.php';
        
    $result=mysqli_query($tietokantayhteys, "select * from viesti where vastaanottaja LIKE '%$vastaanottaja%' ORDER BY 'ID' ASC;")
            or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);
        
                    
            while($test = mysqli_fetch_array($result))
            {
                $spvm=date ('Y-m-d', strtotime($test['lahetetty']));
                $id = $test['ID'];
                $lahettaja = $test['lahettaja'];
                $viesti = $test['viesti'];
                $kayttajatyyppi = $test['kayttajatyyppi'];
        
                if ($ekapaiva <= $spvm && $spvm <= $vikapaiva) {	
                echo "<tr>";
    ?>
        <form action=" " method="post">
    <?php
            echo "<input type='hidden' name='ekapaiva' value='$ekapaiva'>";
            echo "<input type='hidden' name='vikapaiva' value='$vikapaiva'>";
            echo "<input type='hidden' name='vastaanottaja' value='$vastaanottaja'>";
            echo "<input type='hidden' name='ID' value='$id'>";
        
    ?>
            <td valign="top"><input type="submit" name="poista" value="poista">
    <?php
        
            echo "<input type='hidden' name='lahettaja' value='$lahettaja'>";
            echo "<input type='hidden' name='viesti' value='$viesti'>";
        	echo "<input type='hidden' name='ID' value='$id'>";
        
        	if ($vastaanottaja==$_SESSION['kayttaja']) {
        
            echo "<p><input type='submit' name='vastaa' value='vastaa'></p>";
        
            }
    ?>
            </td>
            </form>
    <?php
        
            echo "<td><b>Lähettäjä: </b>".$test['lahettaja']."<br><b>Vastaanottaja: </b>".$test['vastaanottaja'];
            if ($kayttajatyyppi = "asiakas") {
            echo "<br> <b>Sähköposti: </b>".$test['email']."<br>";
            }
            echo "<b>Käyttäjätyyppi: </b>".$test['kayttajatyyppi']."<br><b>Lähetetty: </b>".$test['lahetetty']."<br><b>Viesti: </b><br>".$test['viesti']." </br><hr></td>";
                                            
            echo "</tr>";
        
            }
        
                }
    ?>
            </table>
    <?php
                }
        
    ?>

<?php	
		include 'db.php';

	    if(isset($_POST['lahetaviesti'])){
	    $lahettaja=$_SESSION['kayttaja'];
	    $vastaanottaja=$_POST["valinta"];
	    $viesti=$_POST["kirjoitettuviesti"];
	    $kayttajatyyppi="henkilöstö";
	    $email=" ";
		$lahetetty=date ("d.m.Y");
		
		//echo "'$lahettaja','$vastaanottaja','$kayttajatyyppi','$viesti','$email','$lahetetty'";
        $lause="insert into viesti(lahettaja, vastaanottaja, kayttajatyyppi, viesti, email, lahetetty) 
        values('$lahettaja','$vastaanottaja','$kayttajatyyppi','$viesti','$email','$lahetetty')";
	
		mysqli_query($tietokantayhteys, $lause) or die ("Tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);
	
	    ?>
	    <table border="0" width="212"><tr><td align="right"><font color='red'><b>Viesti lähetetty! &nbsp;&nbsp;</b></font></td></tr></table>

	    <?php
        }
		// ----------------------	
        ?>

<?php
	if (isset($_POST['poista'])){

	$id=$_POST['ID'];

	// sending query
	//include 'db.php';
	$sql_delete= "delete from viesti WHERE ID = '$id'";
	//$sql_delete = "DELETE FROM users WHERE id = '{$id}'";
    mysqli_query($tietokantayhteys,$sql_delete) or mysqli_error($tietokantayhteys);
	//("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);


	$vastaanottaja=$_POST['vastaanottaja'];
	$ekapaiva=date ('Y-m-d', strtotime($_POST['ekapaiva']));
	$vikapaiva=date ('Y-m-d', strtotime($_POST['vikapaiva']));

	$epaiva = date ("d.m.Y", strtotime("$ekapaiva"));

	$vpaiva= date ("d.m.Y", strtotime("$vikapaiva"));

?>
	<table width="520" cellpadding="0" cellspacing="0" border="0">
	<tr><td>
<?php echo $epaiva." - ".$vpaiva; ?>
	</td></tr>
  	</table>

<hr>

	<table width="520" cellpadding="4" cellspacing="8" border="0">
	
			<?php

			//include 'db.php';
			
			$result=mysqli_query($tietokantayhteys, "select * from viesti where vastaanottaja LIKE '%$vastaanottaja%' ORDER BY 'ID' ASC")
			or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);
			
			while($test = mysqli_fetch_array($result))
			{
				$spvm=date ('Y-m-d', strtotime($test['lahetetty']));
				$id = $test['ID'];
				$vastaanottaja = $test['vastaanottaja'];

				if ($ekapaiva <= $spvm && $spvm <= $vikapaiva) {	
				echo "<tr>";

				?>
				<form action=" " method="post">
				<?php
				echo "<input type='hidden' name='ekapaiva' value='$ekapaiva'>";
				echo "<input type='hidden' name='vikapaiva' value='$vikapaiva'>";
				echo "<input type='hidden' name='vastaanottaja' value='$vastaanottaja'>";
				echo "<input type='hidden' name='ID' value='$id'>";

				?>
				<td valign="top"><input type="submit" name="poista" value="poista">
				<?php
					if ($vastaanottaja==$_SESSION['kayttaja']) {

					echo "<p><input type='submit' name='vastaa' value='vastaa'></p>";

					}
				?>
				</td>
				</form>
				<?php
				echo "<td><b>Lähettäjä: </b>".$test['lahettaja']."<br><b>Vastaanottaja: </b>".$test['vastaanottaja']."<br> <b>Sähköposti: </b>".$test['email']."<br>";
				echo "<b>Käyttäjätyyppi: </b>".$test['kayttajatyyppi']."<br><b>Lähetetty: </b>".$test['lahetetty']."<br><b>Viesti: </b><br>".$test['viesti']." </br><hr></td>";
					
				echo "</tr>";
				}
			}
			?>
			</table>
			<?php
		}

			?>

<?php

//-----------------------------------

if(isset($_POST['vastaa'])){

	$id = $_POST['ID'];

	$vastaanottaja = $_POST['lahettaja'];
	$viesti = $_POST['viesti'];

?>
	<table width="520" cellpadding="4" cellspacing="12" border="0">
	<tr><td>

	</td></tr>
  	</table>

<hr>

	<table width="520" cellpadding="4" cellspacing="8" border="0">
	
			<?php

			//include 'db.php';

			$result=mysqli_query($tietokantayhteys, "select * from viesti where ID = '$id'")
			or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);
			
			while($test = mysqli_fetch_array($result))
			{

				echo "<tr>";
				?>
				<form action=" " method="post">
				<?php
				echo "<input type='hidden' name='vastaanottaja' value='$vastaanottaja'>";
				echo "<input type='hidden' name='viesti' value='$viesti'>";
				echo "<input type='hidden' name='ID' value='$id'>";

				?>
				<td valign="top">
				</td>
				
				<?php

				echo "<td valign='top'><b>Lähettäjä: </b>".$_SESSION['kayttaja']."<br><b>Vastaanottaja: </b>".$_POST['lahettaja']."<br>";
				echo "<b>Viesti: </b><br>".$viesti."<p><b>Vastaus:</b><br>";
				?>
				<textarea style="width:350px;height:200px" name="vastausviesti" value="vastausviesti"></textarea><br>
				<?php
				echo "<p><input type='submit' name='Takaisin' value='takaisin'> <input type='submit' name='lahetavastaus' value='Lähetä'>";
				echo "</td>";									
				echo "</tr>";
				echo "</form>";
			}

}

	if(isset($_POST['lahetavastaus'])){
	$lahettaja=$_SESSION['kayttaja'];
	$vastaanottaja=$_POST["vastaanottaja"];
	$kayttajatyyppi="henkilöstö";
	$viesti=$_POST["vastausviesti"];
	$email=" ";
	$lahetetty=date ("d.m.Y");

	//include 'db.php';

	$lause="insert into viesti(lahettaja, vastaanottaja, kayttajatyyppi, viesti, email, lahetetty) 
	values('$lahettaja','$vastaanottaja','$kayttajatyyppi','$viesti','$email','$lahetetty')";

	mysqli_query($tietokantayhteys,$lause) or die ("Tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);

	
	
	?>
	<table border="0" width="525"><tr><td align="right"><font color='red'><b>Vastaus lähetetty! &nbsp;&nbsp;</b></font></td></tr></table>

	<?php
	}
// ----------------------------------

			?>
		

	</td>
	</tr>
	</table>

</body>
<?php } ?>
</html>
