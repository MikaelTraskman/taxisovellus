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
<link rel='stylesheet' type='text/css' href='tyylit.php' />
</head>

<body>

<div id="ylaosa">
<table width="100%">
<tr><td valign="top">

  <table align="center" width="500" height="45" cellscpacing="20" id="logo">
    <tr><td style="width:120px">
  	<font size="+3"><b></b></font>
  	</td>
      <td>
      <a href="../tilaukset.php" method="post" name="tilaukset"> Tilaukset </a>&nbsp;&nbsp;
      </td>
      <td>
      <a href="../viestit.php" name="viestit"> Viestit </a>&nbsp;&nbsp;
      </td>
      <td>
      <a href="../asetukset.php" name="asetukset"> Asetukset </a>
      </td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>
      <font size="-1">&nbsp;&nbsp;<i><?php echo $_SESSION['kayttaja'] ?></i></font><br>
      <form method="post" action="">
    <input type="submit" name="nappi" value="kirjaudu ulos">
    </form>
    <?php
    if (isset($_POST['nappi'])){
    unset($_SESSION['kayttaja']);
    header("Location:../index.php");
    }
    ?>
    </td>
      </tr>
      </table>
	</table>
	
</td></tr>
</table>
</div>

<div id="keski"><!-- InstanceBeginEditable name="EditRegion3" -->

	<table align="center" width="425" border="2" cellpadding="10" id="lomake">
		<tr>
		<td>

	<font size="+2"><b>&nbsp;Valitse käytettävä kuva:</b></font><p>
    <table border = "0">
      <tr><td valign="top" width="40%">
          <font size="-1"><b>Käyttötarkoitus</b></font>
    <?php
    $kuvankaytto="taustakuva";

      if(isset($_POST['kuvankaytto'])) {
        $kuvankaytto=$_POST['kuvankaytto'];

        if($kuvankaytto=='logo'){
        ?>
        <br>
        <form action="" method="post">
        <select name="kuvankaytto" onchange="this.form.submit()" size="1">
          <option value="logo">Logo</option>
          <option value="taustakuva">Taustakuva</option>
          <option value="poista">Poista arkistosta</option>
        </select>
        <noscript><input type="submit" value="Aseta" name="kuvankaytto"></noscript>
        </form>
        <p>
 
        <?php
        }
  
        elseif($kuvankaytto=='poista'){
        ?>
        <br>
        <form action="" method="post">
        <select name="kuvankaytto" onchange="this.form.submit()" size="1">
          <option value="poista">Poista arkistosta</option>
          <option value="taustakuva">Taustakuva</option>
          <option value="logo">Logo</option>
        </select>
        <noscript><input type="submit" value="Aseta" name="kuvankaytto"></noscript>
        </form>
        <p>
        <?php
        }
        else
        {
        ?>
        <br>
        <form action="" method="post">
        <select name="kuvankaytto" onchange="this.form.submit()" size="1">
          <option value="taustakuva">Taustakuva</option>
          <option value="logo">Logo</option>
          <option value="poista">Poista arkistosta</option>
        </select>
        <noscript><input type="submit" value="Aseta" name="kuvankaytto"></noscript>
        </form>
        <p>
        <?php
        }

      }
      else
          {
        ?>
        <br>
        <form action="" method="post">
        <select name="kuvankaytto" onchange="this.form.submit()" size="1">
          <option value="taustakuva">Taustakuva</option>
          <option value="logo">Logo</option>
          <option value="poista">Poista arkistosta</option>
        </select>
        <noscript><input type="submit" value="Aseta" name="kuvankaytto"></noscript>
        </form>
        <p>
        <?php
        }

    ?>

      </td><td valign="top" width="50%" style="border:solid 2px #000; padding: 5px">

  <font size="-1"><b>Lataa arkistoon uusi kuva</b></font>
    <hr>
    <form action="lisaakuva.php" method="post" enctype="multipart/form-data">
    <input type="file" name="LadattavaTiedosto" id="LadattavaTiedosto"><br>
    <input type="submit" value="Lisää" name="lataakuva">
    </form>
        </td></tr>
      </table>

      <hr>

	<font size="-1"><b>Kuvanvalinta</b></font>
    <p>
      <?php
      $i=3;
      $tiedostot='kuvat';
      $kansio=scandir("$tiedostot");
        while ($i<count($kansio)){
        print("<a href=valitsekuva.php?kuva=".$tiedostot."/".$kansio[$i]."&kuvankaytto=".$kuvankaytto.">
          <img src=\"$tiedostot/$kansio[$i]\" height=\"90\"></a>&nbsp;"
      );
      $i++;
      }
      ?>
    <p>
    <hr>


		</td>
		</tr>
	</table>
</div>



</body>
<?php } ?>
</html> 