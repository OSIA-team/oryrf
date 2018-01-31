<?php
/**
 * User: krystofkosut
 * Date: 26.12.17
 * Time: 17:49
 */

if (isset($_POST['edit_jidlo'])){

    require '../../model/database.class.php';
    $mysqli = new database();

    require '../../model/jidlo.class.php';
    $menuItem = new jidlo($mysqli);


    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    $jidlo      = (!isset($jidlo))    ? 0 : 1 ;
    $piti       = (!isset($piti))     ? 0 : 1 ;
    $priloha    = (!isset($priloha))  ? 0 : 1 ;
    $alko       = (!isset($alko))     ? 0 : 1 ;
    $hracka     = (!isset($hracka))   ? 0 : 1 ;
    $menu       = (!isset($menu))   ? 0 : 1 ;

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

            require '../../model/public/upload.class.php';
            //var_dump($_FILES);

            // trida upload preda $_FILES
            // uprava nazvu aby nebyly mezery
            $_FILES['my_field']['name'] = str_replace(" ", "-", mt_rand() . $_FILES['my_field']['name']);
            // Upload object
            $upload = new upload($_FILES['my_field'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                $upload->image_resize = true;
                $upload->image_ratio_y = true;
                $upload->image_x = 500;
                $upload->image_y = 500;
               // $upload->image_precrop              = '5%';
                $upload->image_ratio_crop           = '500px 500px';
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