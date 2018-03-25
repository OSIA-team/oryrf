<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 25.03.2018
 * Time: 12:54
 */

$action = (isset($_GET['action']))?$_GET['action']:'';

switch ($action){
    case 'profil':
        require_once 'component/user/profil.phtml';
        break;

    case 'edit':
        require_once 'component/user/edit.phtml';
        break;

    default:
        require_once 'component/user/profil.phtml';
        break;
}

