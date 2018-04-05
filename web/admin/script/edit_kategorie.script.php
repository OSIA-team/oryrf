<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 14.02.2018
 * Time: 23:05
 */

if (isset($_POST['edit_kategorie'])) {


    require '../../model/database.class.php';
    $mysqli = new database();

    require '../../model/kategorie.class.php';
    $kategorieClass = new kategorie($mysqli);

    require '../../model/jidlo.class.php';
    require '../../model/public/upload.class.php';
    // $upload = new upload();

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    $kategorieClass->setUpKategorie($id);

    if (isset($_FILES['icon']['name']) AND $_FILES['icon']['name'] != ""){

        $upload = new upload($_FILES['icon'], "cs_CS");
        // Overeni zda je obrazek uspesne nahran do tmp slozky
        if ($upload->uploaded) {
            // Manipulace s obrazkem
            $upload->image_resize = true;
          //  $upload->image_ratio = true;
            $upload->image_x = 226;
            $upload->image_y = 226;
           // $upload->image_ratio_crop = true;
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
        $icon = $kategorieClass->icon;
    }

    if (isset($_FILES['background']['name'])  AND $_FILES['background']['name'] != ""){
        $upload = new upload($_FILES['background'], "cs_CS");
        // Overeni zda je obrazek uspesne nahran do tmp slozky
        if ($upload->uploaded) {
            // Manipulace s obrazkem
            $upload->image_resize = true;
          //  $upload->image_ratio = true;
            $upload->image_x = 3000;
            $upload->image_y = 1500;
          //  $upload->image_ratio_crop = true;
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
        $background = $kategorieClass->background;
    }

    $topmenu    = (isset($topmenu))?1:0;
    $url        = strtolower($kategorieClass->remove_accents($nazev));

    $update = array(
        'nazev' => "{$nazev}",
        'topmenu' => $topmenu,
        'icon'  => $icon,
        'background' => $background,
        'url'   => "{$url}"
    );

    $where = array(
        'id' => $id
    );

        $result = $kategorieClass->updateKategorie($update, $where, $kategorieClass->url);
        if ($result){
            header("Location: ../?page=nastaveni&action=kategorie");
        } else {
            var_dump($result);
        }
    }