<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 30.01.18
 * Time: 23:25
 */

$id = $_GET['id'];

$objednavka = $objednavkaClass->getAllInObjednavka($id);
?>

    <h2><a href="#">Objednávky</a> &raquo; <a href="#" class="active">Detail</a></h2>

    <div id="main">

        <h3>Objednávka číslo: <?= $id ?></h3>
        <table class="ObjDetail">
            <thead>
                <tr>
                    <th>Jídlo</th> <th>Počet kusů</th> <th>Cena za kus</th><th>Cena celkem</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($objednavka as $jidlo => $detail):
            ?>
                <tr>
                    <td><?= $detail['nazev'] ?></td>
                    <td><?= $detail['pocet'] ?> ks</td>
                    <td><?= $detail['cena'] ?> Kč</td>
                    <td><?= $detail['cenaZaPocet'] ?> Kč</td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table> <br><br>

        <p>
            <b>Příjemce objednávky:</b> <?= $objednavka[0]['username'] ?>, <?= $objednavka[0]['jmeno'] ?><br><br><br><br>
            <b>Adresa doručení:</b> <?= $objednavka[0]['adresadoruceni'] ?> <br><br>
            <b>Poznámka:</b> <br> <?= $objednavka[0]['poznamka'] ?> <br><br>
            <b>Cena celkem:</b> <?= $objednavka[0]['cenacelkem'] ?> Kč
        </p>



        <?php
        // var_dump($objednavka);
        ?>

    </div>



