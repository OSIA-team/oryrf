<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.03.18
 * Time: 15:33
 */
session_start();

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
        foreach (glob("../model/*.php") as $filename)
        {
            include $filename;
        }
\core\core::$configFile = require_once '../config.php';
    $userClass = new \database\user();
    $kosikClass = new \database\kosik();

   // $kosikClass->deleteTempKosik();

    $userId = $userClass->checkIfExists($email, $password);

    if (!$userId) {
        echo 'false';
    } else {
        $userClass->createLoginSession($userId);
        echo 'true';
    }