<?php
    header("Content-type: text/css; charset: UTF-8");
//Yhteys tietokantaan
		include 'db.php';
 ?>

.error {
  color: #DC143C;
}

p.big {
    line-height: 2;
}

a:link {
	text-decoration: none;
	color: #CCCCCC;
}
a:hover
{
color:#000;
}
a:hover
{
background-color:#FFFF99;
} 
a:visited {
    color: #CCC;
}

#ylaosa {
	background-color: #000000;
	position: absolute;
	height: 60px;
	width: 100%;
	left: 0px;
	top: 0px;
	font-family: Arial, Helvetica, sans-serif;
	color: #CCC;
	}

#logo {
	background-image: url(<?php echo $logo ?>);
	background-repeat: no-repeat;
	background-position: 0% 0%;
	background-size: 20% 48px;

	}


#keski {
	position: absolute;
	left: 30px;
	top: 65px;
	right: 110px;
	bottom: 0px;
	padding: 10px;
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
	line-height: 1.3em;
}

#lomake {
	background-color: rgba(102, 179, 227, 0.863);
}

#kuitti  {
	background-color: #FFFFFF;
}


.keskita {
	text-align: center;
}
h1 {
	color: #CCC;
	font-family: Tahoma, Geneva, sans-serif;
}
html {
	background: url(<?php echo $taustakuva ?>) no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
