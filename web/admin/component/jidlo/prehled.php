<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:45
 */

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