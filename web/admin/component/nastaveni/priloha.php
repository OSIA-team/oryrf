<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 23.04.18
 * Time: 16:21
 */

$kategorieClass = new \database\kategorie();
$kategories = $kategorieClass->getAllKategorie();
?>

<h2><a href="#">Nastaveni</a> &raquo; <a href="#" class="active">Správa Příloh</a></h2>

<div id="main">

    <h3>Vyberte kategorii</h3>

    <form>
        <div class="container">
            <?php
            foreach ($kategories as $kategorie):
                ?>
                <div>
                    <div class="row">
                        <div><?= $kategorie['nazev'] ?></div>
                        <div class="action-kategorie">
                            <a href="?page=nastaveni&action=priloha&selectedKatId=<?= $kategorie['id'] ?>" class="edit"><div class="action">Spravovat přílohy</div></a>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </form>
</div>