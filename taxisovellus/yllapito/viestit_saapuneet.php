<form action="" id="" method="post">

<b>Näytä saapuneet viestit:</b>
			<p>
			<!-- Tulostetaan käyttäjät-valikko -->
            <!-- <form method="post" action=""> -->
			Vastaanottaja:<br>

			<?php
			$_SESSION['kayttaja'];

			include 'db.php';
			
			$result=mysqli_query($tietokantayhteys, "select * from viesti;")
			or die ("Syyst&auml;, jota en tied&auml;, tieto ei tallentunut tietokantaan").mysqli_error($tietokantayhteys);

			?>
			<select name="vastaanottaja" size="1">

			<?php
//			while($test = mysql_fetch_array($result)){

			echo "<option value=".$_SESSION['kayttaja'].">";

			echo $_SESSION['kayttaja'];
			echo "</option>";

			echo "<option value='henkilöstö'>";

			echo 'henkilöstö';
			echo "</option>";

//			}
			?>	
			</select>

			<p>
			Aikavälillä:<br>

				<?php
				$ekapaiva = date('d.m.Y');
				?>

			<input type="text" name="ekapaiva" id="muutos" value="<?php echo $ekapaiva;?>" style="width: 60px;">
			 - 
			<input type="text" name="vikapaiva" id="muutos" value="<?php echo $ekapaiva;?>" style="width: 60px;">
			<p>
			<input type="submit" name="etsi" value="Etsi">

</form>

