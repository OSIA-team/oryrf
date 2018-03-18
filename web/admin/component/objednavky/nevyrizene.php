<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 30.01.18
 * Time: 23:01
 */

$objednavky = $objednavkaClass->getAllObjednavkaByStatus(1);
?>

<h2><a href="#">Objednávky</a> &raquo; <a href="#" class="active">Přehled</a></h2>

<div id="main">

    <h3>Nevyřízené objednávky</h3>

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