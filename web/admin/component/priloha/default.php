<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 06.05.2018
 * Time: 16:06
 */

$kategorieClass = new \database\kategorie();
$kategories = $kategorieClass->getAllKategorie();
?>
<div id="main">

    <h3>Přílohy</h3>
    <div class="container">
        <?php
        foreach ($kategories as $kategorie):
            ?>
            <div>
                <div class="row">
                    <div><?= $kategorie['nazev'] ?></div>

                    <div class="action-kategorie">
                        <a href="?page=priloha&action=editpriloha&id=<?= $kategorie['id'] ?>" class="edit"><div class="action">Spravovat přílohy</div></a>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
