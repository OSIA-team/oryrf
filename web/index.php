<?php
/**
 * @file index.php
 */
// require_once 'model/public/PHPMailer/PHPMailerAutoload.php';
// redirect to https
if($_SERVER['SERVER_NAME'] == 'bel3s.cz'){
    if (!$_SERVER['HTTPS']){
        $redirect = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: '.$redirect);
        exit();
    }
}

foreach (glob("model/*.php") as $filename)
{
    include $filename;
}
\core\core::$configFile = require_once 'config.php';
//if(PhpConsole\Connector::getInstance()->isActiveClient()) {

// $handler->debug("Debug message: ".$_SERVER['PHP_SELF'] );
// $handler->getConnector()->setSourcesBasePath($_SERVER['DOCUMENT_ROOT']); // so files paths on client will be shorter (optional)

 session_start();
// var_dump($_SESSION);
 // debug if not loged in

// Constanty pro tridu database
define( 'DISPLAY_DEBUG', false );
define( 'SEND_ERRORS_TO', 'k.kosut@gmail.com' );
// require database class
// $mysqli = new database();

if (isset($_POST)){
    $form = new \core\form($_POST);
}

$kategorieClass = new database\kategorie();

$kosikClass = new database\kosik();

$userClass = new database\user();

$menuItem = new \database\jidlo();

$objednavkaClass = new \database\objednavka();

$strankaClass = new \database\stranka();

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



//define page selected
$id         = (isset($_GET['id']))?htmlspecialchars($_GET['id']):"";
$page       = (isset($_GET['page']))?$_GET['page']:'home';

require 'templates/head.php';
require 'templates/header.php';
require 'templates/navigation.php';


switch ($page){
    case 'menu':
        $urlKategorie  = (isset($_GET['kategorie']))?htmlspecialchars($_GET['kategorie']):"";
        $kategorie  = $kategorieClass->getKategorieByURL($urlKategorie);
        $kategorieClass->setUpKategorie($kategorie['id']);
        $kategorie  = $kategorie['nazev'];
        $kategorieBackground = $kategorieClass->background;
        if (!isset($kategorieBackground)){
            $kategorieBackground = 'default.jpg';
        }

         require 'templates/foodnav.php';
         require 'component/produkty/produkty.php';
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
          require 'pages/kontakt.html';
        break;
  case 'seznam-alergenu':
        require 'pages/alergeny.html';
      break;

  case 'obchodni-podminky':
        require 'pages/podminky.html';
      break;

case 'ochrana-osobnich-udaju':
      require 'pages/ochrana-udaju.html';
    break;

    case 'rozvoz':
        require 'pages/rozvoz.php';
      break;

    case 'souhlas-se-zpracovanim-osobnich-udaju':
          require 'pages/souhlas-se-zpracovanim-udaju.html';
        break;

    case 'user':
            require 'component/user/index.php';
        break;

    default:
        $stranka = $strankaClass->strankaExists((string)$page);
            if($stranka){
                require_once 'component/custom/index.php';
            } else {
                require_once 'templates/error_page.php';
            }
        break;
}

require 'templates/footer.php';
//print_r($_SESSION);
//}
