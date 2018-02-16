<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 15.02.2018
 * Time: 0:38
 */

$id = $_GET['id'];
require_once '../model/kategorie.class.php';

$kategorieClass = new kategorie($mysqli);
$result = $kategorieClass->deleteKategorie($id);

if ($result){
    header('Location: ?page=nastaveni&action=kategorie');
}