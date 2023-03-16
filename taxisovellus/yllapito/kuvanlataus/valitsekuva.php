<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<body>

<?php
 include("db.php");  

    $target_file =$_GET['kuva'];
    $kuvankaytto =$_GET['kuvankaytto'];

 if ($kuvankaytto!="poista") {
    //$tietokantayhteys=mysql_connect("mysql16.000webhost.com","a8675696_root","74k5151vu570")
    //or die ("Yhteytt&auml; tietokantaan ei saatu");
    // Yhteys tietokantaan
   // mysql_select_db("a8675696_taxi")
    //or die ("Valittua tietokantaa ei l&ouml;ytynyt");

    mysqli_query($tietokantayhteys, "UPDATE kuvat SET $kuvankaytto ='$target_file' WHERE sivusto = 'taksisivusto'")
                or die(mysqli_error($tietokantayhteys));
} else {
        unlink($target_file);
} 
    
    header("Location: kuvanlatauslomake.php");


?> 
?> 

</body>
</html> 