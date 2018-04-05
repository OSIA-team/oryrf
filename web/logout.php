<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 16.03.2018
 * Time: 20:35
 */

session_start();
session_destroy();
$url = $_SERVER['HTTP_REFERER'];
header("Location: ".$url);
