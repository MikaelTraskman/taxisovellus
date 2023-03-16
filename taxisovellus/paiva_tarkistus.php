<?php

// Jos minuutit on yli 45 ja tunnit 23, siirrytään näyttämään seuraava päivä

	if ($min > "30" && $h =="23" ){
	$ekapaiva = date ("d.m.Y", strtotime("+1 day", strtotime($ekapaiva)));
	}
	while (strtotime($ekapaiva) <= strtotime($vikapaiva)) {
    echo "<option value='$ekapaiva'>".$ekapaiva."</option>";
	$ekapaiva = date ("d.m.Y", strtotime("+1 day", strtotime($ekapaiva)));
}

?>