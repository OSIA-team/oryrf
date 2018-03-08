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

    require_once '../model/user.class.php';
    require_once '../model/database.class.php';
    $mysqli = new database();
    $userClass = new user($mysqli);
    $password = crypt($password,'$2a$07$thisisspartabel3syoknow$');

    $insert = array(
        'password' => (string)$password,
        'email' => (string)$email,
        'jmeno' => (string)$jmeno,
        'prijmeni' => (string)$prijmeni,
        'mobil' =>  (string)$telefon,
        'registered' => 1
    );

    $userId = $userClass->addUser($insert);
    if (!$userId){
        echo json_encode(array('false'));
        die();
    }
    $userClass->createLoginSession($userId);
    echo json_encode(array('true'));
    die();



} else {
    die('Un-authorized entrance');
}
