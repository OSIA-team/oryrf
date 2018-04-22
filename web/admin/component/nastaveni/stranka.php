<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 19.04.18
 * Time: 16:48
 */

$strankaClass = new \database\stranka();
$stranky = $strankaClass->getAllStranka();
?>
<div id="main">

    <h3>Vyberte stránku</h3>
    <div class="container">
        <?php
        foreach ($stranky as $stranka):
            ?>
            <div>
                <div class="row">
                    <div><?= $stranka['nazev'] ?></div>

                    <div class="action-kategorie">
                        <a href="?page=nastaveni&action=editstranka&id=<?= $stranka['id'] ?>" class="edit"><div class="action">Editovat</div></a>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>