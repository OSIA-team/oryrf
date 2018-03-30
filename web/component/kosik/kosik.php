<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 31.12.17
 * Time: 23:21
 */

$action = (isset($_GET['action']))?$_GET['action']:'';

switch ($action){
    case 'to-checkout':
        require_once 'component/kosik/checkout.php';
        break;

    case 'finish-order':
        require_once 'component/kosik/finish-order.php';
        break;

    default:
        require_once 'component/kosik/review.php';
        break;
}


?>