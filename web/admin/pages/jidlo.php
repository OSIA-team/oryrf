<div id="sidebar">
      <ul class="sideNav">
          <li><a href="?page=jidlo&action=prehled" <?php echo ($_GET['action'] == "prehled")  ?"class=\"active\"":""; ?>>Přehled</a></li>
          <li><a href="?page=jidlo&action=pridat"  <?php echo ($_GET['action'] == "pridat")   ?"class=\"active\"":""; ?>>Přidat</a></li>
      </ul>
        <!-- // .sideNav -->
    </div>

    <!-- // #sidebar -->

    <!-- h2 stays for breadcrumbs -->
    <?php
    $crumbs = multiexplode(array("/", "?page=","&action="),$_SERVER["REQUEST_URI"]);
      foreach($crumbs as $crumb){
          $breadcrumbs[] = ucfirst(str_replace(array(".php","_")," ",$crumb) . ' ');
      }

        // var_dump($breadcrumbs);
     ?>

    <?php
    ///////////////////////////////////////////////////////////////////////////
    // action prehled
    ///////////////////////////////////////////////////////////////////////////
    if($_GET['action'] == "prehled"):
        require '../model/kategorie.class.php';
        $kategorieClass = new kategorie($mysqli);
        $kategories = $kategorieClass->getAllKategorie();
        ?>
        <h2><a href="#">Jídlo</a> &raquo; <a href="#" class="active">Přehled</a></h2>

        <div id="main">

        <h3>Vyberte kategorii</h3>

    <form>
            <div class="container">

            <?php
            foreach ($kategories as $kategorie):
            ?>
              <a href="?page=jidlo&action=kategorie&url=<?= $kategorie['url'] ?>" class="edit">
                  <div class="row">
                    <div><?= $kategorie['nazev'] ?></div>
                    <div class="action">Prohlížet</div>
                </div>
                </a>
            <?php
            endforeach;
        ?>
      </div>
        </form>
        </div>
        <?php
    endif;
        ?>

     <?php
     ///////////////////////////////////////////////////////////////////////////
     // action kategorie
     ///////////////////////////////////////////////////////////////////////////
     if($_GET['action'] == "kategorie"):
         $kategorie_url = $_GET['url'];
       ?>


    <h2><a href="#">Jídlo</a> &raquo; <a href="#" class="active">Přehled</a></h2>

    <div id="main">

<h3>Seznam jídla podle kategorie</h3>

<table cellpadding="0" cellspacing="0">
<?php
  $i=1;
  require '../model/jidlo.class.php';
  $menuItem = new jidlo($mysqli);
  $items = $menuItem->getAllJidloByKategorie($kategorie_url);
  foreach ($items as $item):
  //  var_dump($item);
  echo (($i%2)==0)?"<tr class=\"odd\">":"<tr>";
?>

                  <td><?= $item['nazev'] ?></td>
                  <td class="action"><a href="?page=jidlo&action=detail&id=<?= $item['id']?>" class="view">Detail</a><a href="?page=jidlo&action=edit&id=<?= $item['id']?>" class="edit">Upravit</a><a onclick="confirm('Opravdu chcete tento produkt vymazat?')" href="?page=jidlo&action=delete&id=<?= $item['id']?>" class="delete">Vymazat</a></td>
              </tr>

<?php
$i++;
  endforeach;
 ?>
</table>
            <?php /*
<h3>Another section</h3>
<form action="" class="jNice">
          <fieldset>
              <p><label>Sample label:</label><input type="text" class="text-long" /></p>
              <p><label>Sample label:</label><input type="text" class="text-medium" /><input type="text" class="text-small" /><input type="text" class="text-small" /></p>
                <p><label>Sample label:</label>
                <select>
                  <option>Select one</option>
                  <option>Select two</option>
                  <option>Select tree</option>
                  <option>Select one</option>
                  <option>Select two</option>
                  <option>Select tree</option>
                </select>
                </p>
              <p><label>Sample label:</label><textarea rows="1" cols="1"></textarea></p>
                <input type="submit" value="Submit Query" />
            </fieldset>
        </form> */ ?>
    </div>
    <!-- // #main -->
    <?php
  endif;
     ?>
     <?php
     ///////////////////////////////////////////////////////////////////////////
     // action pridat
     ///////////////////////////////////////////////////////////////////////////
     if($_GET['action'] == "pridat"):
       ?>


    <h2><a href="#">Jídlo</a> &raquo; <a href="#" class="active">Přidat</a></h2>

    <div id="main">

<h3>Přidat jídlo</h3>
<form action="script/pridat_jidlo.script.php" class="jNice" method="POST">
          <fieldset>
              <p><label>Název:</label><input type="text" class="text-long" name="nazev" required/></p>
              <p><label>Popis:</label><textarea rows="1" cols="1" name="popis"></textarea></p>
              <p><label>Ingredience:</label><input type="text" class="text-long" name="ingredience"/>*Oddělit čárkou</p>
              <p><label>Kategorie:</label>
                <select name="kategorie">
                  <?php
                  require "../model/kategorie.class.php";
                  $kategorie = new kategorie($mysqli);
                    $kategorie_item = $kategorie->getAllKategorie();
                      foreach ($kategorie_item as $key => $value) {
                        echo "<option value=\"{$value['url']}\">{$value['nazev']}</option>";
                      }
                    // var_dump($kategorie_item);
                    require '../model/sezona.class.php';
                    $sezona = new sezona($mysqli);
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

     <?php
     ///////////////////////////////////////////////////////////////////////////
     // action upload_img
     ///////////////////////////////////////////////////////////////////////////
     if($_GET['action'] == "upload_img"):
       ?>


    <h2>Jídlo &raquo; <span class="active">Nahrát obrázek k jídlu</span></h2>

    <div id="main">

<h3>Přidat obrázek k jídlu</h3>
<form action="script/upload_img_jidlo.script.php" class="jNice" method="POST" enctype="multipart/form-data">
          <fieldset>
              <p><label>Název:</label> <?= $_GET['id'] ?></p>

                <input type="file" accept="image/*" name="my_field" value="Vybrat novou fotku" /><br>
                <input type="hidden" value="<?= $_GET['id'] ?>" name="jidlo_id" />
                <input type="submit" value="Nahrát" name="nahrat" />
                <input type="submit" value="Přeskočit" name="preskocit" />
                <p>* V případě přeskočení kroku bude nahrán výchozí obrázek </p>
            </fieldset>
        </form>

    </div>
    <!-- // #main -->
    <?php
  endif;
     ?>

    <?php
    ///////////////////////////////////////////////////////////////////////////
    // action detail
    ///////////////////////////////////////////////////////////////////////////
    if($_GET['action'] == "detail"):
        require '../model/jidlo.class.php';

        if (isset($_GET['id'])){
            $id = $_GET['id'];

        }
        $jidloClass = new Jidlo($mysqli);
        $jidlo = $jidloClass->getJidloById($id);
        // var_dump($jidlo);
        ?>
        <h2>Detail:</h2>
            <div id="main">

                <h3><?= $jidlo['nazev'] ?></h3>
                <fieldset>
                        <input type="hidden" value="<?= $id ?>" name="id" disabled />
                        <p><label>Název:</label><input type="text" class="text-long" name="nazev" value="<?= $jidlo['nazev'] ?>" disabled /></p>
                        <p><label>Popis:</label><textarea rows="1" cols="1" name="popis" disabled><?= $jidlo['popis'] ?></textarea></p>
                        <p><label>Ingredience:</label><input type="text" class="text-long" name="ingredience" value="<?= $jidlo['ingredience'] ?>" disabled />*Oddělit čárkou</p>
                        <p><label>Kategorie:</label>
                            <select name="kategorie" disabled>
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
                        <p><label>Gramáž:</label><input type="text" class="text-medium" name="gramaz" value="<?= $jidlo['gramaz'] ?>" disabled />*Připsat i g/ks/ml</p>

                        <p><label>Cena:</label><input type="text" class="text-medium" name="cena" value="<?= $jidlo['cena'] ?>" disabled />Kč</p>

                        <p><label>Sezóna</label>
                            <select name="sezona" disabled>
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
                            $mchecked = ($jidlo['menu'] == 1)?'checked':'';
                            ?>    <label><input type="checkbox" name="menu" value="1" class="jNiceCheckbox" style="display: block;" <?= $mchecked ?> disabled />Menu</label>
                        </p>
                        <p>
                            <?php
                            $fotka = $jidloClass->getFotkaByJidloId($id);
                            //var_dump($fotka);
                            ?>
                            <img src="../<?= $fotka['path'].$fotka['nazev'] ?>" height="150px" /> <br>
                        </p>
                    </fieldset>



        </div>
    <?php
        endif;
    ?>

    <?php
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
                        /*
                        $jchecked = ($jidlo['jidlo'] == 1)?'checked':'';
                        $pchecked = ($jidlo['piti'] == 1)?'checked':'';
                        $prchecked = ($jidlo['priloha'] == 1)?'checked':'';
                        $achecked = ($jidlo['alko'] == 1)?'checked':'';
                        $hchecked = ($jidlo['hracka'] == 1)?'checked':'';
                        */
                        $mchecked = ($jidlo['menu'] == 1)?'checked':'';
                        ?>
                       <!-- <label><input type="checkbox" name="jidlo" value="1" class="jNiceCheckbox" style="display: block;" <?= $jchecked ?> >       Jídlo</label>
                        <label><input type="checkbox" name="piti" value="1" class="jNiceCheckbox" style="display: block;" <?= $pchecked ?>>        Pití</label>
                        <label><input type="checkbox" name="priloha" value="1" class="jNiceCheckbox" style="display: block;" <?= $prchecked ?>>     Příloha</label>
                        <label><input type="checkbox" name="alko" value="1" class="jNiceCheckbox" style="display: block;" <?= $achecked ?>>        Alkohol</label>
                        <label><input type="checkbox" name="hracka" value="1" class="jNiceCheckbox" style="display: block;" <?= $hchecked ?>>      Hračka</label> -->
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

    <?php
    ///////////////////////////////////////////////////////////////////////////
    // action edit
    ///////////////////////////////////////////////////////////////////////////
    if ($_GET['action'] == "delete"):
        require '../model/jidlo.class.php';
        $id = $_GET['id'];
        $jidlo = new Jidlo($mysqli);
        $delete = $jidlo->deleteJidlo($id);

        /** @var DibiResult $delete */
        if ($delete){
            echo "Its gone!";
        } else {
            echo "error";
        }

        endif;
        ?>
