<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 26.01.18
 * Time: 23:45
 */

//1. create user (update after review)
//2. create kosik use update on duplicate
//3. create kosik_has_menuItem use update on duplicate

if ($_SESSION['kosik']['user'] == "Anonym"){
    $user_id = $userClass->addUser(array('adresa' => ''));
    $_SESSION['kosik']['user'] = $user_id;
} else {
    $user_id = $_SESSION['kosik']['user'];
}

// kosik = cenaCelkem, user_id
$cenaCelkem = $_POST['cenaCelkem'];
$insert = array(
    'cenaCelkem' => $cenaCelkem,
    'user_id' => $user_id
);


if (!isset($_SESSION['kosik']['kosik_id'])){
    $kosik_id = $kosikClass->createKosik($insert);
    $_SESSION['kosik']['kosik_id'] = $kosik_id;
} else {
    $kosik_id = $_SESSION['kosik']['kosik_id'];
}


foreach ($_POST['id'] as $key =>$id ) {
    $pocet = $_POST['pocet'][$key];
       // $intoDB[]
    $insert = array(
        'kosik_id' => $kosik_id,
        'menuItem_id' => $id,
        'pocet' => $pocet
    );

    $kosikClass->updateInKosik($insert['menuItem_id'], $pocet);

    $query = "SELECT id FROM kosik_has_menuItem WHERE kosik_id={$insert['kosik_id']} AND menuItem_id = {$insert['menuItem_id']}";

    if ($kosikClass->numberRows($query) == 0){
    // insert
        $kosikClass->addToKosikHasMenuItem($insert);
    } else {
    // update
        $update = array(
          'pocet'   => $pocet
        );
        $where = array(
            'menuItem_id' => $insert['menuItem_id'],
            'kosik_id' => $insert['kosik_id']
        );
        $kosikClass->updateKosikHasMenuItem($update, $where);
    }
}
