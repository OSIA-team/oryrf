<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.03.18
 * Time: 16:45
 */
session_start();
if (isset($_POST['register'])) {
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
    require_once '../model/core.class.php';
    \core\core::$configFile = require_once '../config.php';

    require_once '../model/user.class.php';
    require_once '../model/database.class.php';
    $userClass = new \database\user();
    // Check if email exists in database and is registered
    $database = new \database\database();
    $registed = $database->get_row("SELECT id FROM user WHERE email = \"{$email}\"AND registered = 1 LIMIT 1");
    if ($registed){
        echo json_encode(array('stav' => 'User alredy registered'));
        die();
    }


    $password = crypt($password,'$2a$07$thisisspartabel3syoknow$');

    $insert = array(
        'password' => (string)$password,
        'email' => (string)$email,
        'jmeno' => (string)$jmeno,
        'prijmeni' => (string)$prijmeni,
        'mobil' =>  (string)$telefon,
        'adresa' => (string)$adresa,
        'registered' => 1
    );

    $userId = $userClass->addUser($insert);
    if (!$userId){
        echo json_encode(array('stav' => 'false'));
        die();
    }
    $userClass->createLoginSession($userId);
    echo json_encode(array('stav' => 'true'));
    die();



} else {
    die('Un-authorized entrance');
}
