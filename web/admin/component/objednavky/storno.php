<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 17.03.2018
 * Time: 15:46
 */

$objednavky = $objednavkaClass->getAllObjednavkaByStatus(3);
?>

<h2><a href="#">Objednávky</a> &raquo; <a href="#" class="active">Přehled</a></h2>

<div id="main">

    <h3>Stornované objednávky</h3>

    <form>
        <div class="container">
            <?php
            foreach ($objednavky as $objednavka):
                ?>
                <a href="?page=objednavky&action=detail&id=<?= $objednavka['id'] ?>" class="edit">
                    <div class="row">
                        <div><?= $objednavka['id']." - ".$objednavka['email']." -- ".$objednavka['adresadoruceni']." -- ".$objednavka['mobil']." --- ".$objednavka['cenacelkem']." Kč" ?></div>
                        <div class="action">Detail</div>
                    </div>
                </a>
            <?php
            endforeach;
            ?>
        </div>
    </form>
</div>