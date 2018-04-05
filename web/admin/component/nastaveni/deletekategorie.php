<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 15.02.2018
 * Time: 0:38
 */

$id = $_GET['id'];

$kategorieClass = new \database\kategorie();
$result = $kategorieClass->deleteKategorie($id);

if ($result){
    header('Location: ?page=nastaveni&action=kategorie');
}