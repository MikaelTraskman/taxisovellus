<?php

   if (empty($_POST["mista"])) {
     $mistaErr = "* Anna l&auml;ht&ouml;piste!";
   } else {
     $mista = $_POST["mista"];
     // check if mista only contains letters and whitespace
     if (!preg_match("/^[a-öA-Ö:,.; ]*$/",$mista)) {
       $mistaErr = " Ei erityismerkkejä!";
     }
   }
  

   if (empty($_POST["minne"])) {
     $minneErr = "* Anna m&auml;&auml;r&auml;np&auml;&auml;!";
   } else {
     $minne = $_POST["minne"];
     // check if minne only contains letters and whitespace
     if (!preg_match("/^[a-öA-Ö:,.; ]*$/",$minne)) {
       $minneErr = " Ei erityismerkkejä!";
     }
   }

 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
	}

?>