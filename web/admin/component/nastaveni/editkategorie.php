<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 13.02.2018
 * Time: 23:52
 */

$id = $_GET['id'];
require_once '../model/kategorie.class.php';

$kategorieClass = new kategorie($mysqli);
$kategorieClass->setUpKategorie($id);
?>

<h2><a href="#">Nastavení</a> &raquo; <a href="#" class="active">Kategorie</a></h2>

<div id="main">

    <h3>Úprava kategorie: <?= $kategorieClass->nazev ?></h3>
        <form method="post" action="script/edit_kategorie.script.php" enctype="multipart/form-data" >
            <p>
                <label>Název:</label><input type="text" class="text-long" name="nazev" value="<?= $kategorieClass->nazev ?>" />
                <label><input type="checkbox" name="topmenu" <?php echo ($kategorieClass->topmenu == 1)?'checked':''; ?> />V horním menu</label>
            </p>
            <p>
                Pozadí: <input type="file" name="background" accept="image/*">
                <img src="../img/<?= $kategorieClass->background ?>" />
            </p>

            <p>
                Icon: <input type="file" name="icon" accept="image/*">
                <img src="../img/<?= $kategorieClass->icon ?>" />
            </p>
            <input type="hidden" name="id" value="<?= $kategorieClass->id ?>" />
            <input type="submit" class="btn btn-outline-success" value="Editovat" name="edit_kategorie" />
        </form>


</div>
