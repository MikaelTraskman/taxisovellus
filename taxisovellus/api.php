<?php
//directions
$api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$mista."&destinations=".$minne."&key=<!-- avaintunnus -->");

$data = json_decode($api);


?>