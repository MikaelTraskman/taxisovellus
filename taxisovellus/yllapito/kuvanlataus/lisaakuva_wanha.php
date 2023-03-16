<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
$target_dir = 'kuvat/';
$target_file = $target_dir . basename($_FILES['LadattavaTiedosto']['name']);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//$muutettavakuva = $_GET['id'];

// Check if image file is a actual image or fake image
if(isset($_POST['lataakuva'])) {
    $check = getimagesize($_FILES['LadattavaTiedosto']['tmp_name']);
    if($check !== false) {
        echo "Tiedosto on kuva - " . $check['mime'] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "Tiedosto ei ole kuva.<br>";
        $uploadOk = 0;
    }
}

$tiedostonimi = basename($_FILES['LadattavaTiedosto']['name']);
//$tiedostonimi=preg_replace('`[^a-z0-9-_.]`i','',strtolower(preg_match_replace(" ","_",$tiedostonimi)));
$tiedostonimi=preg_replace("[^a-z0-9-_.]'i' ","",strtolower(preg_replace(" ","_",$tiedostonimi)));
$target_file = $target_dir . $tiedostonimi;

// Check if file already exists
if (file_exists($target_file)) {
    echo "Samainen tiedosto on jo tallennettu.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES['LadattavaTiedosto']['size'] > 500000) {
    echo "Tiedosto on liian suuri.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Vain JPG, JPEG, PNG & GIF - tiedostot sallittuja.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Tiedostoasi ei onnistuttu tallentamaan.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['LadattavaTiedosto']['tmp_name'], $target_file)) {
        echo "Tiedosto ". basename( $_FILES['LadattavaTiedosto']['name']). " on ladattu onnistuneesti.<br>";
        echo "<img src ='".$target_file. "'><br>";
    } else {
        echo "Valitettavasti ladattaessa tapahtui virhe.";
    }
}


    header("Location: kuvanlatauslomake.php");



?> 

</body>
</html> 