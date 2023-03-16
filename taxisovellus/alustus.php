<?php

$tunnus=rand(10,9999999);
// Start date
$ekapaiva = date('d.m.Y');
// End date
$vikapaiva = date ("d.m.Y", strtotime("+1 year"));

$min = date('i') ;
$h = date('H');

$paivamaara = date('d.m.Y');
$pv_kk = date('d.m');
$kk = date('m');
$paiva = date('d');
$viikonpaiva = date('D');
$vuosi = date('Y');

?>