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
    require "../model/jidlo.class.php";
    $id = $_GET['id'];
    $jidloclass = new Jidlo($mysqli);
    $jidlo = $jidloclass->getJidloById($id);
    ?>

    <div id="main">

        <h3>Upravit jídlo</h3>
        <form action="script/edit_jidlo.script.php" class="jNice" method="POST" enctype="multipart/form-data">
            <fieldset>
                <input type="hidden" value="<?= $id ?>" name="id" />
                <p><label>Název:</label><input type="text" class="text-long" name="nazev" value="<?= $jidlo['nazev'] ?>" /></p>
                <p><label>Popis:</label><textarea rows="1" cols="1" name="popis"><?= $jidlo['popis'] ?></textarea></p>
                <p><label>Ingredience:</label><input type="text" class="text-long" name="ingredience" value="<?= $jidlo['ingredience'] ?>"/>*Oddělit čárkou</p>
                <p><label>Kategorie:</label>
                    <select name="kategorie">
                        <?php
                        require "../model/kategorie.class.php";
                        $kategorie = new kategorie($mysqli);
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
                        require '../model/sezona.class.php';
                        $sezona     = new sezona($mysqli);
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
                    $mchecked = (@$jidlo['menu'] == 1)?'checked':'';
                    ?>

                    <label><input type="checkbox" name="menu" value="1" class="jNiceCheckbox" style="display: block;" <?= $mchecked ?> >Menu</label>
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
            </fieldset>
        </form>

    </div>
    <!-- // #main -->
<?php
endif;
?>
