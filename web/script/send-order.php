<?php
session_start();
//pridat_do_kosiku
foreach (glob("../model/*.php") as $filename)
{
    include $filename;
}
\core\core::$configFile = require_once '../config.php';
$kosikClass = new database\kosik();

    $pocet = $_POST['quntity-1'];
    $jidlo_id = $_POST['jidlo_id'];
    $result = $kosikClass->addInKosik($jidlo_id, $pocet);
    
    echo json_encode(array("true"));

?>
