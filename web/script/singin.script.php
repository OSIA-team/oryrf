<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.03.18
 * Time: 15:33
 */
session_start();
if (isset($_POST['login'])){
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
    require_once '../model/user.class.php';
    require_once '../model/database.class.php';
    $mysqli = new database();
    $userClass = new user($mysqli);

    $userId = $userClass->checkIfExists($email, $password);

    if (!$userId) {
        echo json_encode(array('false'));
        die();
    }

    //TODO: Zalozit session
    $userClass->createLoginSession($userId);
    echo json_encode(array('true'));
    die();
} else {
    die('Un-authorized entrance');
}


