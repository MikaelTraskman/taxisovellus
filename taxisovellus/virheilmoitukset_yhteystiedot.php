<?php

   if (empty($_POST["puhnro"]) && empty($_POST["email"])) {
     $yhteystietoErr = "* Anna yhteystieto!";
   } else {
     $puhnro = $_POST["puhnro"];

     if (!preg_match("/^[0-9 ]*$/",$puhnro)) {
       $yhteystietoErr = "* Vain numeroita!";
     }

     $email = $_POST["email"];
     	if ($email != "") {
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $yhteystietoErr = "* Vääränlainen sähköpostiformaatti!";
     }
 	}
   }
 

 	if (empty($_POST["viesti"])) {
    $viesti = "";
  	} else {
    $viesti = $_POST["viesti"];
  	}

   function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
    }

?>
