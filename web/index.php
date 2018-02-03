<?php
/**
 * @file index.php
 */

require_once('model/public/PhpConsole/__autoload.php');

$handler = PhpConsole\Handler::getInstance();
$handler->start(); // start handling PHP errors & exceptions
$handler->debug("Debug message: ".$_SERVER['PHP_SELF'] );
// $handler->getConnector()->setSourcesBasePath($_SERVER['DOCUMENT_ROOT']); // so files paths on client will be shorter (optional)

 session_start();

 // debug if not loged in

// Constanty pro tridu database
define( 'DISPLAY_DEBUG', false );
define( 'SEND_ERRORS_TO', 'k.kosut@gmail.com' );
// require database class
require 'model/database.class.php';
$mysqli = new database();

require 'model/kategorie.class.php';
$kategorieClass = new kategorie($mysqli);

require 'model/kosik.class.php';
$kosikClass = new kosik($mysqli);

require 'model/user.class.php';
$userClass = new user($mysqli);

require 'model/jidlo.class.php';
$menuItem = new jidlo($mysqli);

require 'model/objednavka.class.php';
$objednavkaClass = new objednavka($mysqli);

// determinate scripts
 if (isset($_POST['to-checkout'])){
     require_once 'script/review.script.php';

     unset($_POST);
     header("Location:?page=kosik&action=to-checkout");

 } elseif (isset($_POST['finish-order'])){
     require_once 'script/finish-order.script.php';

     unset($_POST);
     header("Location:?page=kosik&action=finish-order");
 }


if (isset($_POST['pridat_do_kosiku'])){
    $pocet = $_POST['quntity-1'];
    $jidlo_id = $_POST['jidlo_id'];
    $kosikClass->addInKosik($jidlo_id, $pocet);
}

// handle redirects from forms

require 'templates/head.php';
require 'templates/header.php';
require 'templates/navigation.php';

//define page selected
$id         = (isset($_GET['id']))?htmlspecialchars($_GET['id']):"";
$page       = (isset($_GET['page']))?$_GET['page']:'home';

switch ($page){
    case 'menu':
         $urlKategorie  = (isset($_GET['kategorie']))?htmlspecialchars($_GET['kategorie']):"";
         $kategorie  = $kategorieClass->getKategorieByURL($urlKategorie);
         $kategorie  = $kategorie['nazev'];

         require 'templates/foodnav.php';
         require 'templates/produkty.php';
        break;
    case 'home':
         require 'templates/home.html';
        break;
    case 'kosik':
         require 'component/kosik/kosik.php';
        break;
    case 'onas':
        break;
    case 'kontakt':
        break;
}

require 'templates/footer.php';
print_r($_SESSION);
