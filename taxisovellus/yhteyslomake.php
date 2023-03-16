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
<?php
$nimi="";
$email="";
$nimiErr ="";
$emailErr ="";

if (isset($_POST['laheta'])){


  if (empty($_POST["nimi"])) {
     $nimiErr = "<br>* Anna nimesi!";
   } else {
     $nimi = $_POST["nimi"];
     // check if mista only contains letters and whitespace
     if (!preg_match("/^[a-öA-Ö:,.; ]*$/",$nimi)) {
       $nimiErr = "<br> Ei erityismerkkejä!";
     }
   }


   if (empty($_POST["email"])) {
     $emailErr = "<br>* Puuttuva sähköpostiosoite!";
   } else {

	$email = $_POST["email"];
     	if ($email != "") {
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $yhteystietoErr = "<br>* Vääränlainen sähköpostiformaatti!";
     	}

			}
	}


 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
	}

}
?>

<div id="ylaosa">
<table width="100%">
<tr><td valign="top">

  <table align="center" width="500" height="45" cellscpacing="20" id="logo">
    <tr><td style="width:120px">
  	<font size="+3"><b></b></font>
  	</td><td> 
    <b>
    <a href="index.php"><font color="#cccccc">&nbsp;Tilaus&nbsp;</font></a>&nbsp;&nbsp;
	<a href="hinnasto.php"><font color="#cccccc">&nbsp;Hinnasto&nbsp;</font></a>&nbsp;&nbsp;
	<a href="yhteyslomake.php"><font color="#cccccc">&nbsp;Yhteyslomake&nbsp;</font></a>
	</b>
 	</td></tr>
	</table>
	
</td></tr>
</table>
</div>

<div id="keski"><!-- InstanceBeginEditable name="EditRegion3" -->

	<table align="center" width="425" border="2" id="lomake">
		<tr>
		<td>
	<table cellpadding="12">
	<tr>
	<td valign="top">
	<font size="+2"><b>Yhteyslomake</b></font>
	<p>
	<form action="" method="post">
	Nimi:<br>
	<input type="text" name="nimi" style="width:300px" value="<?php echo $nimi;?>">
   <span class="error"> <?php echo $nimiErr;?></span><br>
	E-mail:<br>
	<input type="text" name="email" style="width:300px" value="<?php echo $email;?>">
   <span class="error"> <?php echo $emailErr;?></span><br>
	Viesti:<br>
	<textarea name="viesti" style="width:350px;height:200px"></textarea>
	<br><br>
	<input type="hidden" name="kayttajatyyppi" value="asiakas">
	<input type="submit" name="laheta" value=" Lähetä ">
	<input type="reset" value=" Tyhjennä ">
	</form>
	<?php

	include 'db.php';
	// Yhteys tietokantaan

	if(isset($_POST['laheta'])){
	$lahettaja=$_POST['nimi'];
	$vastaanottaja="henkilöstö";
	$kayttajatyyppi=$_POST['kayttajatyyppi'];
	$viesti=$_POST['viesti'];
	$email=$_POST['email'];
	$lahetetty=date ("d.m.Y");

	$Hakkeriesto = array("<",">");

  	if(preg_match("#(".implode("|",$Hakkeriesto).")#i", $nimi)) {
    echo " ";
  	} 

  	elseif(preg_match("#(".implode("|",$Hakkeriesto).")#i", $email)) {
    echo " ";
  	}

  	elseif(preg_match("#(".implode("|",$Hakkeriesto).")#i", $viesti)) {
    echo " ";
  	}

  	else {


	if ($nimi == "" && $email == ""){
		echo " ";
	}
	elseif ($nimi == ""){
		echo " ";
	}
	elseif ($email == ""){
	echo " ";
	}
	else {


	$lause="insert into viesti(lahettaja, vastaanottaja, kayttajatyyppi, viesti, email, lahetetty) 
	values('$lahettaja','$vastaanottaja','$kayttajatyyppi','$viesti','$email','$lahetetty')";

	mysqli_query($tietokantayhteys, $lause) or die ("Tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);

	echo "<br><font color='#DC143C'><b>Viesti otettu vastaan!</b></font><br>";
	}

		}
	}
	
	?>
	</td>
	</tr>

	</table>

		</td>
		</tr>

		</table>
<!-- InstanceEndEditable --></div>

</body>
<!-- InstanceEnd --></html>