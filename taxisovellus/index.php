<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Taksi</title>
    <link rel='stylesheet' type='text/css' href='yllapito/kuvanlataus/tyylit.php' />
    </head>

    <body>
    <div id="ylaosa">
    <!--<table width="100%" border="2">
    <tr><td valign="top"> -->

    <table align="center" width="470" height="45" cellscpacing="20" id="logo" border="0">
  	<tr>
        <td style="width:120px">
  	    <font size="+3"><b></b></font>
  	    </td><td> 
        <b>
        <a href="index.php"><font color="#cccccc">&nbsp;Tilaus&nbsp;</font></a>&nbsp;&nbsp;
        <a href="hinnasto.php"><font color="#cccccc">&nbsp;Hinnasto&nbsp;</font></a>&nbsp;&nbsp;
        <a href="yhteyslomake.php"><font color="#cccccc">&nbsp;Yhteyslomake</font></a>
	    </b>
 	    </td>
    </tr>
	</table>
	
    <!--</td></tr>
    </table> -->
    </div>

    <div id="keski">

	<table align="center" width="425" border="2" cellpadding="10" id="lomake">
		<tr>
		<td>

<?php
date_default_timezone_set('Europe/Helsinki');

// Virheilmoitukset

$mistaErr = $minneErr = "";
$mista = $minne = "";

        if (isset($_POST['laske'])){
                include 'virheilmoitukset_paikat.php';
        }
                include 'alustus.php';
?>
    <font size="+2"><b>&nbsp;Arvioi taksimatkan pituus ja hinta</b></font><p>
    <form method="post" action="">
    
    <table border=0 cellpadding=2>
    <tr>
        <td>
        Lähtöpiste:
        </td>
        <td>
        <input type="text" name="mista" value="<?php echo $mista;?>">
        <span class="error"> <?php echo $mistaErr;?></span>
        </td>
    </tr>
    <tr>
        <td>
        Määränpää:
        </td>
        <td>
        <input type="text" name="minne" value="<?php echo $minne;?>">
        <span class="error"> <?php echo $minneErr;?></span>
        </td>
    </tr>
    </table>


    <table border=0 cellpadding=2>
    <tr>
        <td valign="top">
        <b>Haluttu saapumisaika lähtöpisteeseen:</b>
        </td>
    </tr>
    </table>

    <table border=0 cellpadding=2>
    <tr>
        <td valign="top">Päivämärä:</td><td>
            <select name="pvm">
<?php
                // Jos minuutit on yli 45 ja tunnit 23, siirrytään näyttämään seuraava päivä
                include 'paiva_tarkistus.php';
?>
            </select>
        </td>
    </tr>
    <tr>
        <td valign="top">Kellonaika:</td>
        <td>
        <font size="-1"><b>tunnit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;minuutit</b></font><br>
        <!-- Tulostetaan tunnit-valikko -->
            <select name="tunnit">
                <?php
                // Jos minuutit on yli 45, korotetaan tunteja yhdellä
                // Näytetään ensimmäisenä nykyiset tunnit ja tulostetaan valinnoiksi 23 saakka
                // palautetaan tunnit nykyiseen
                // Jatketaan valintoja keskiyöstä kunnes saavutetaan vuorokausi täyteen
                include 'tunnit_tarkistus.php';
                                ?>
            </select>

            <!-- Tulostetaan minuutit-valikko, jossa valinnat 15-minuutin välein -->
            <select name="minuutit">
<?php
                include 'minuutit_tarkistus.php';
?>
            </select>
        </td>
    </tr>

    <tr>
        <td valign="top">
        Matkustajamäärä: 
        </td>
        <td>
        <!-- Matkustajamäärä kysytään -->
            <select name="matkustajamaara">
<?php
                include 'matkustajamaara.php';
?>
            </select>
        <br><font size=-1><hr><i>kaksi alle 12-vuotiasta lasta <br>lasketaan yhdeksi henkilöksi.<i></font>
        </td>
    </tr>
    </table>
<?php
               include 'lisatoiveet.php';
?>

    <table border=0 cellpadding=0 width=250>
    <tr>
        <td valign="top">

<script type="text/javascript" src="lisatoiveet.js"></script>

        <a href="javascript:ReverseDisplay('lisatoiveet')">
        <font color="#00008B"><u>Valitse lisätoiveet</u></font>
        </a>
        <br>
            <div id="lisatoiveet" style="display:none;">
            <table border=0 cellpadding=2 width=250>
            <tr>
                <td>
                    <a href="javascript:ReverseDisplay('tavarainfo')"><font color="#000000"> - Tavarankuljetus</font></a>
                    <br>
                    <div id="tavarainfo" style="display:none;">
                    <table border=0 cellspacing=2>
                    <tr>
                        <td>
                        <font size=-1><i>Isokokoisten esineiden (mm. sukset, televisiot) ja lemmikkieläinten kuljetus.	
                        <?php echo $tavarankuljetus." &#8364;"; ?>
                        <hr>Lisämaksua ei saa periä asiakkaan tavanomaisista matkatavaroista eikä opaskoirasta.</i></font>
                        </td>
                        <td valign='top'>
                        <input type="checkbox" name="lisamaksu[]" value="Tavarankuljetus">
                        </td>
                    </tr>
                    </table>
                    </div>
                <a href="javascript:ReverseDisplay('avustusinfo')"><font color="#000000"> - Avustus</font></a>
                <br>
                    <div id="avustusinfo" style="display:none;">
                    <table border=0 cellpadding=2>
                    <tr>
                        <td>
                        <font size=-1><i>Jos asiakas tarvitsee avustamista ja kuljetus edellyttää invavarusteista autoa	
                        <?php echo $avustus1." &#8364;"; ?> 
                        <hr></i></font>
                        </td>
                        <td valign='top'>
                        <input type="radio" name="lisamaksu[]" value="Avustus, invavarusteinen auto">
                        </td>
                    <tr>
                        <td>
                        <font size=-1><i>Avustamislisämaksu -kuten edellä, mutta avustaminen tapahtuu portaissa käsivoimin tai porraskiipijää hyväksi käyttäen
                        <?php echo $avustus2." &#8364;"; ?> 
                        <hr></i></font>
                        </td>
                        <td valign='top'>
                        <input type="radio" name="lisamaksu[]" value="Avustus portaissa, invavarusteinen auto">
                        </td>
                    </tr>

                    <tr>
                        <td>
                        <font size=-1><i>Ei avustusta 
                        </i></font>
                        </td>
                        <td valign='top'>
                        <input type="radio" name="lisamaksu[]" value="Ei avustusta" CHECKED>
                        </td>
                    </tr>
                    </table>
                    </div>
                <a href="javascript:ReverseDisplay('paari-info')"><font color="#000000"> - Paarilisä</font></a>
                <br>
                    <div id="paari-info" style="display:none;">
                    <table border=0 cellspacing=2>
                    <tr>
                        <td>
                        <font size=-1><i>Asiakkaan kuljettamisessa tarvittavien paarien noutaminen ja autoon asentaminen ennen kuljetuksen alkua
                        <?php echo $paarilisa." &#8364;"; ?>
                        </i></font>
                        </td>
                        <td valign='top'>
                        <input type="checkbox" name="lisamaksu[]" value="Paarilisä">
                        </td>
                    </tr>
                    </table>
                    </div>

                </td>
            </tr>

            </table>
            </div>

<?php
    $checkbox = ' ';
?>

        </td>
    </tr>
    </table>

    <table border=0 cellpadding=0>
    <tr>
        <td>
            <p>
        </td>
        <td>
        <input type="submit" name="laske" value="Laske matka ja hinta">
        </td>
    </tr>
    </table>

    </form>

<?php
    $yhteystietoErr = "";
    $puhnro = $email = $viesti = "";

    if (isset($_POST['tilaus'])){
                include 'virheilmoitukset_yhteystiedot.php';
                include 'tilauksenkasittely.php';
    }
    $checkbox = isset($_POST['lisamaksu']) ? $_POST['lisamaksu'] : 0;
    // Otetaan lomakkeesta sy&ouml;tetyt tiedot (kun painetaan "Laske matka ja hinta" seuraavaa tapahtuu:

    if (isset($_POST['laske'])){
        include 'lomakkeenkasittely.php';
    }
?>


    </td>
    </tr>
    </table>
    </body>
</html>