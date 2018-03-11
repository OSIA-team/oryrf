<?php
/**
 * User: krystofkosut
 * Date: 26.12.17
 * Time: 17:49
 */

/*
require_once('../../model/public/PhpConsole/__autoload.php');
$connector = PhpConsole\Connector::getInstance();
$connector->setPassword("789ae456ae123");
$connector->startEvalRequestsListener(); // must be called in the end of all configurations

$handler = PhpConsole\Handler::getInstance();
$handler->start(); // start handling PHP errors & exceptions
*/
if (isset($_POST['edit_jidlo'])){

    require '../../model/database.class.php';
    $mysqli = new database();

    require '../../model/jidlo.class.php';
    $menuItem = new jidlo($mysqli);


    foreach ($_POST as $key => $value) {
        $$key = $value;
    }


    $menu       = (!isset($menu))     ? 0 : 1 ;

    $where = [
        'id' => $id
    ];

    $update = array(
        'nazev'       => "{$nazev}",
        'popis'       => "{$popis}",
        'ingredience' => "{$ingredience}",
        'kategorie'   => "{$kategorie}",
        'gramaz'      => "{$gramaz}",
        'cena'        => $cena
    );

        $edit = $menuItem->editJidlo($update, $where);


        if ($_FILES['my_field']['name'] != "") {

            // trida upload preda $_FILES
            // uprava nazvu aby nebyly mezery
            $_FILES['my_field']['name'] = str_replace(" ", "-", mt_rand() . $_FILES['my_field']['name']);
            // Upload object
            $upload = new upload($_FILES['my_field'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                $upload->image_resize = true;
                $upload->image_ratio = true;
                $upload->image_x = 226;
                $upload->image_y = 226;
               // $upload->image_precrop              = '5%';
                $upload->image_ratio_crop           = true;
                // Presuneme fotku ze slozky temp
                $upload->Process("../../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    // Vlozeni fotky/obrazku do databaze
                    // priprava promennych
                    $photo_name = $_FILES['my_field']['name'];
                    // Object pro manipulaci s tabulkou fotka v databazy

                    $update = array(
                        'nazev' => $photo_name
                    );
                    $where = array(
                        'jidlo_id' => $id
                    );

                    $upload_foto = $menuItem->editFotka($update, $where);
                    /*var_dump($update); var_dump($where);
                    var_dump($upload_foto); die();*/
                }
            }
                } else {
                    $upload_foto = true;
                }

                if ($edit AND $upload_foto) {
    header("Location: ../?page=jidlo&action=prehled");
} else {
    // error
    echo "error";
}
} else {
    echo "error2";
}