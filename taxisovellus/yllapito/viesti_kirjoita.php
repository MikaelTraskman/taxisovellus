<b>Kirjoita viesti:</b>
        <p>
		<form action="" method="post">
		
		Vastaanottaja:<br>
		<select name="valinta" size="1">
		<?php
			while ($rivi = mysqli_fetch_array($tulos)){
			echo "<option value=\"$rivi[1]\">";

			echo "$rivi[1]
			</option>";
			}
		?>
		</select>

		<p>
		<textarea name="kirjoitettuviesti" style="width:250px;height:100px"></textarea>
		<p>
		<input type="submit" name="lahetaviesti" value="Lähetä Viesti">

		</form>
