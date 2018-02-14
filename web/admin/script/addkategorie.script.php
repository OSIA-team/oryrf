<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 12.02.2018
 * Time: 21:30
 */

if (isset($_POST['addKategorie'])){
    require '../../model/database.class.php';
    $mysqli = new database();

    require '../../model/kategorie.class.php';
    $kategorieClass = new kategorie($mysqli);

    require '../../model/public/upload.class.php';
    // $upload = new upload();

    if (isset($_FILES['icon']['name'])){
        $upload = new upload($_FILES['icon'], "cs_CS");
        // Overeni zda je obrazek uspesne nahran do tmp slozky
        if ($upload->uploaded) {
            // Manipulace s obrazkem
            $upload->image_resize = true;
            $upload->image_ratio = true;
            $upload->image_x = 226;
            $upload->image_y = 226;
            $upload->image_ratio_crop = true;
            // Presuneme fotku ze slozky temp
            $upload->Process("../../img/");
            // Jestli se zadarilo
            if ($upload->processed) {
                $icon   = $_FILES['icon']['name'];
            } else {
                die($upload->error);
            }
        }
    } else {
        $icon = '';
    }

    if (isset($_FILES['background']['name'])){
        $upload = new upload($_FILES['background'], "cs_CS");
        // Overeni zda je obrazek uspesne nahran do tmp slozky
        if ($upload->uploaded) {
            // Manipulace s obrazkem
            $upload->image_resize = true;
            $upload->image_ratio = true;
            $upload->image_x = 226;
            $upload->image_y = 226;
            $upload->image_ratio_crop = true;
            // Presuneme fotku ze slozky temp
            $upload->Process("../../img/");
            // Jestli se zadarilo
            if ($upload->processed) {
                $background   = $_FILES['background']['name'];
            } else {
                die($upload->error);
            }
        }
    } else {
        $background = '';
    }


    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    $background = (isset($background))?$background:"";
    $icon       = (isset($icon))?$icon:"";
    $url        = $kategorieClass->remove_accents($nazev);
// */
    $topmenu    = (isset($topmenu))?1:0;

    $url = strtolower($kategorieClass->remove_accents($nazev));

    $insert = array(
        'nazev' => "{$nazev}",
        'topmenu' => $topmenu,
        'icon'  => $icon,
        'background' => $background,
        'url'   => "{$url}"
    );

    $insered_id = $kategorieClass->addKategorie($insert);
    if ($insered_id){
        // redirect
    } else {
        echo 'error';
    }




















}