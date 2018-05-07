<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 06.05.2018
 * Time: 16:09
 */

$kategorie_id = $_GET['id'];
$prilohaClass = new \database\priloha();
$prilohy = $prilohaClass->getAllPriloha();
$kategorieClass = new \database\kategorie();
$kategorieClass->setUpKategorie($kategorie_id);
// $url = $kategorieClass->getKategorieById($kategorie_id);
$jidloClass = new \database\jidlo();
$active = $jidloClass->getAllPriloha($kategorieClass->url);
/*
echo  "<h4>prilohy</h4>";
echo "<pre>".print_r($prilohy, true)."</pre>";
echo  "<h4>active</h4>";
echo "<pre>".print_r($active, true)."</pre>";
// */

?>
<h2>Přílohy pro kategorii: <?= $kategorieClass->nazev ?></h2>
<div id="main">
    <fieldset>
        <form method="post">
            <?php
                foreach ($prilohy as $priloha):
            ?>
                    <label><input type="checkbox" name="<?= $priloha['id'] ?>" value="1" class="jNiceCheckbox" style="display: block;"><?= $priloha['nazev'] ?></label>
                    <input type="hidden" name="active<?= $priloha['id'] ?>" value="1"/>

            <?php
                endforeach;
            ?>
            <input type="submit" name="prilohy" value="Uložit" />
        </form>
    </fieldset>
</div>

