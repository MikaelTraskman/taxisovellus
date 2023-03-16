<?php
$i=2;
$tiedostot='kuvat';
$kansio=scandir("$tiedostot");

	?>
	<form action="scandir.php" method="post" name="kuvalomake" enctype="multipart/form-data">
	<?php
	while ($i<count($kansio)){
	print("<img src=\"$tiedostot/$kansio[$i]\" width=\"200\"><br>".$kansio[$i]."
	<input type=\"radio\" name=\"radio\" value=\"$kansio[$i]\"><br>
	<br>"
	);
	$i++;
	}
	?>
	<input type="submit" name="submit" value="lataa">
	</form>
	<?php
	if (isset($_POST['submit'])){
	$kuva=$_POST['radio'];
	
	}

//tulostetaan kansion sisältö ruudulle
//tehdään 
?>