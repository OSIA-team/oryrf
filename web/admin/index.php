<?php
// Check if user is logged in
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}


$prefix = "../";
require_once('../model/public/PhpConsole/__autoload.php');

$handler = PhpConsole\Handler::getInstance();
$handler->start(); // start handling PHP errors & exceptions
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

	$page = (isset($_GET['page']))?$_GET['page']:"jidlo";
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
    <!-- Compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
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
        	<li><a href="?page=jidlo" 					<?php echo ($page=="jidlo")						?"class=\"active\"":""; ?>>Jídlo				</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="?page=objednavky" 		        <?php echo ($page=="objednavky")			    ?"class=\"active\"":""; ?>>Objednavky			</a></li>
            <li><a href="?page=uzivatele" 			    <?php echo ($page=="uzivatele")				    ?"class=\"active\"":""; ?>>Uživatelé			</a></li>
            <li><a href="?page=nastaveni" 			    <?php echo ($page=="nastaveni")				    ?"class=\"active\"":""; ?>>Nastavení			</a></li>
        	<li class="logout"><a href="logout.php">Odhlásit se</a></li>
        </ul>
        <!-- // #end mainNav -->

        <div id="containerHolder">
			<div id="container">
										<?php
                                            if (file_exists("component/".$page."/index.php")){
                                                require_once "component/".$page."/index.php";
                                            } else {
                                                //error page
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
