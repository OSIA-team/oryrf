<?php

// Constanty pro tridu database
define( 'DISPLAY_DEBUG', false );
define( 'SEND_ERRORS_TO', 'k.kosut@gmail.com' );
// require database class
require '../model/database.class.php';
$mysqli = new database();

function multiexplode ($delimiters,$string) {

	$ready = str_replace($delimiters, $delimiters[0], $string);
	$launch = explode($delimiters[0], $ready);
	return  $launch;
}

	$page = (isset($_GET['page']))?$_GET['page']:"";
 ?>
<!DOCTYPE html PUBLIC >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bel3s Administrace</title>

<!-- CSS -->
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>
</head>

<body>
	<div id="wrapper">
    	<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
    	<h1><span>Bel3s</span></h1>

        <!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
        <ul id="mainNav">
        	<li><a href="?page=jidlo&action=prehled" 					<?php echo ($page=="jidlo")						?"class=\"active\"":""; ?>>Jídlo				</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="?page=objednavky&action=prehled" 		        <?php echo ($page=="objednavky")			    ?"class=\"active\"":""; ?>>Objednavky			</a></li>
            <li><a href="?page=uzivatele&action=prehled" 			    <?php echo ($page=="uzivatele")				    ?"class=\"active\"":""; ?>>Uživatelé			</a></li>
            <li><a href="?page=nastaveni&action=prehled" 			    <?php echo ($page=="nastaveni")				    ?"class=\"active\"":""; ?>>Nastavení			</a></li>
        	<li class="logout"><a href="logout.php">Odhlásit se</a></li>
        </ul>
        <!-- // #end mainNav -->

        <div id="containerHolder">
			<div id="container">
										<?php
												// page determination

													switch ($page) {
															case 'jidlo':
																require 'pages/jidlo.php';
															break;

															case 'piti':
																require 'pages/piti.php';
															break;

															case 'ingredience':
																require 'pages/ingredience.php';
															break;

															case 'objednavky':
																require 'pages/objednavky.php';
															break;

															case 'uzivatele':
																require 'pages/uzivatele.php';
															break;

															case 'nastaveni':
																require 'pages/nastaveni.php';
															break;

															default:
																# code...
															break;
													}

										 ?>
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>
        <!-- // #containerHolder -->

        <p id="footer">With love. <a href="http://www.osia.cz">OSIA Team</a></p>
    </div>
    <!-- // #wrapper -->
</body>
</html>
