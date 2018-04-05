<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:50
 */
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

            $menuItem = new \database\jidlo();
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