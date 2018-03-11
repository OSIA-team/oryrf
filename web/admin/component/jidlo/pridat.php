<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:51
 */

///////////////////////////////////////////////////////////////////////////
// action pridat
///////////////////////////////////////////////////////////////////////////
if($_GET['action'] == "pridat"):
    ?>


    <h2><a href="#">Jídlo</a> &raquo; <a href="#" class="active">Přidat</a></h2>

    <div id="main">

        <h3>Přidat jídlo</h3>
        <form class="jNice" method="POST">
            <fieldset>
                <p><label>Název:</label><input type="text" class="text-long" name="nazev" required/></p>
                <p><label>Popis:</label><textarea rows="1" cols="1" name="popis"></textarea></p>
                <p><label>Ingredience:</label><input type="text" class="text-long" name="ingredience"/>*Oddělit čárkou</p>
                <p><label>Kategorie:</label>
                    <select name="kategorie">
                        <?php

                        $kategorie = new \database\kategorie();
                        $kategorie_item = $kategorie->getAllKategorie();
                        foreach ($kategorie_item as $key => $value) {
                            echo "<option value=\"{$value['url']}\">{$value['nazev']}</option>";
                        }
                        // var_dump($kategorie_item);

                        $sezona = new \database\sezona();
                        $sezony = $sezona->getAllSezona();
                        ?>
                    </select>
                </p>
                <p><label>Gramáž:</label><input type="text" class="text-medium" name="gramaz" required/>*Připsat i g/ks/ml</p>

                <p><label>Cena:</label><input type="text" class="text-medium" name="cena" required/>Kč</p>

                <p><label>Sezóna</label>
                    <select name="sezona">
                        <?php foreach($sezony as $sezona): ?>
                            <option value="<?= $sezona['id'] ?>"><?= $sezona['nazev'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>

                <p>
                    <!-- <label><input type="checkbox" name="jidlo" value="1" class="jNiceCheckbox" style="display: block;" checked="checked">       Jídlo</label>
                     <label><input type="checkbox" name="piti" value="1" class="jNiceCheckbox" style="display: block;">        Pití</label>
                     <label><input type="checkbox" name="priloha" value="1" class="jNiceCheckbox" style="display: block;">     Příloha</label>
                     <label><input type="checkbox" name="alko" value="1" class="jNiceCheckbox" style="display: block;">        Alkohol</label>
                     <label><input type="checkbox" name="hracka" value="1" class="jNiceCheckbox" style="display: block;">      Hračka</label> -->
                    <label><input type="checkbox" name="menu" value="1" class="jNiceCheckbox" style="display: block;">Menu</label>
                </p>

                <input type="submit" value="Přidat" name="pridat_jidlo" />
            </fieldset>
        </form>

    </div>
    <!-- // #main -->
<?php
endif;
?>