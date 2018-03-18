<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:58
 */

///////////////////////////////////////////////////////////////////////////
// action delete
///////////////////////////////////////////////////////////////////////////
if ($_GET['action'] == "delete"):

    $id = $_GET['id'];
    $jidlo = new \database\jidlo();
    $delete = $jidlo->deleteJidlo($id);

    /** @var DibiResult $delete */
    if ($delete){
        echo "Its gone!";
    } else {
        echo "error";
    }

endif;
?>