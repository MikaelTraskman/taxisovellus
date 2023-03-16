<?php  
$tietokantayhteys=new mysqli('localhost', 'root', '', 'taxi')
or die ("Yhteytt&auml; tietokantaan ei saatu");

$lause="SELECT * FROM kuvat WHERE sivusto='taksisivusto'";

$result=mysqli_query($tietokantayhteys, $lause);
			
while($test = mysqli_fetch_array($result)){

	$taustakuva = $test['taustakuva'];
	$logo = $test['logo'];
}
?>