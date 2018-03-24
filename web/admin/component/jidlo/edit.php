<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:56
 */

///////////////////////////////////////////////////////////////////////////
// action edit
///////////////////////////////////////////////////////////////////////////
if ($_GET['action'] == "edit"):

    $id = $_GET['id'];
    $jidloclass = new \database\jidlo();
    $jidlo = $jidloclass->getJidloById($id);
    ?>
<h2>Upravit</h2>
    <div id="main">

        <h3><?= $jidlo['nazev'] ?></h3>
        <fieldset>
        <form class="jNice" method="POST" enctype="multipart/form-data">

                <input type="hidden" value="<?= $id ?>" name="id" />
                <p><label>Název:</label><input type="text" class="text-long" name="nazev" value="<?= $jidlo['nazev'] ?>" /></p>
                <p><label>Popis:</label><textarea rows="1" cols="1" name="popis"><?= $jidlo['popis'] ?></textarea></p>
                <p><label>Ingredience:</label><input type="text" class="text-long" name="ingredience" value="<?= $jidlo['ingredience'] ?>"/>*Oddělit čárkou</p>
                <p><label>Kategorie:</label>
                    <select name="kategorie">
                        <?php

                        $kategorie = new \database\kategorie();
                        $kategorie_item = $kategorie->getAllKategorie();
                        foreach ($kategorie_item as $key => $value) {
                            $selected = ( $value['url'] == $jidlo['kategorie'])?'selected':'';
                            $nazev = $value['nazev'];
                            $url = $value['url'];
                            echo "<option value=\"$url\" $selected >$nazev";
                        }
                        ?>
                    </select>
                </p>
                <p><label>Gramáž:</label><input type="text" class="text-medium" name="gramaz" value="<?= $jidlo['gramaz'] ?>"/>*Připsat i g/ks/ml</p>

                <p><label>Cena:</label><input type="text" class="text-medium" name="cena" value="<?= $jidlo['cena'] ?>"/>Kč</p>

                <p><label>Sezóna</label>
                    <select name="sezona">
                        <?php

                        $sezona     = new \database\sezona();
                        $sezony     = $sezona->getAllSezona();
                        $jsezona    = $sezona->getSezonaById($jidlo['id_sezona']);

                        foreach($sezony as $sezona):
                            $selected = ($sezona == $jsezona )?'selected':'';
                            ?>
                            <option value="<?= $sezona['id'] ?>" <?= $selected ?>><?= $sezona['nazev'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>

                <p>
                    <?php
                    $pchecked = (@$jidlo['priloha'] == 1)?'checked':'';
                    $pmchecked = (@$jidlo['priloha_modulo'] == 1)?'checked':'';
                    ?>

                    <label><input type="checkbox" name="priloha" value="1" class="jNiceCheckbox" style="display: block;" <?= $pchecked ?> >Je příloha</label>
                    <label><input type="checkbox" name="priloha_modulo" value="1" class="jNiceCheckbox" style="display: block;" <?= $pmchecked ?> >Má přílohu</label>
                </p>

                <p>
                    <?php
                    $fotka = $jidloclass->getFotkaByJidloId($id);
                    //var_dump($fotka);
                    ?>
                    <img src="../<?= $fotka['path'].$fotka['nazev'] ?>" height="150px" /> <br>
                    <input type="file" accept="image/*" name="my_field" value="Vybrat novou fotku" />

                </p>

                <input type="submit" value="Editovat" name="edit_jidlo" />

        </form>
        </fieldset>

    </div>
    <!-- // #main -->
<?php
endif;
?>
