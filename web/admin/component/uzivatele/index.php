<?php



// stripslashes?
$action = (isset($_GET['action']))?$_GET['action']:'prehled';

if (file_exists('component/uzivatele/'.$action.'.php')){
    require_once 'component/uzivatele/'.$action.'.php';
} else {
    // error
    require_once 'component/uzivatele/prehled.php';
}