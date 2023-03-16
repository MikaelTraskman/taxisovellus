<?php
$min = date('i') ;

	if ($min > "00" && $min < "15"){
	echo "<option value='30'>30</option>";
	echo "<option value='45'>45</option>";	
	echo "<option value='00'>00</option>";	
	echo "<option value='15'>15</option>";
	} 
	elseif ($min > "15" && $min < "30"){
	echo "<option value='45'>45</option>";
	echo "<option value='00'>00</option>";
	echo "<option value='15'>15</option>";
	echo "<option value='30'>30</option>";
	}
	elseif ($min > "30" && $min < "45"){
	echo "<option value='00'>00</option>";
	echo "<option value='15'>15</option>";
	echo "<option value='30'>30</option>";
	echo "<option value='45'>45</option>";
	}
	else {
	echo "<option value='15'>15</option>";
	echo "<option value='30'>30</option>";
	echo "<option value='45'>45</option>";
	echo "<option value='00'>00</option>";
	}

?>