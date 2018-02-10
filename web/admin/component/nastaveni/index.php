<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 23:10
 */
?>
<div id="sidebar">
      <ul class="sideNav">
          <li><a href="?page=nastaveni&action=kategorie" <?php echo ($_GET['action'] == "kategorie")  ?"class=\"active\"":""; ?>>Správa kategorií</a></li>
          <li><a href="?page=nastaveni&action=sezona" <?php echo ($_GET['action'] == "sezona")   ?"class=\"active\"":""; ?>>Správa sezón</a></li>
          <li><a href="?page=nastaveni&action=sezona" <?php echo ($_GET['action'] == "sezona")   ?"class=\"active\"":""; ?>>Správa stránek</a></li>
      </ul>
        <!-- // .sideNav -->
    </div>

 <?php
    $action = (@isset($_GET['action']))?$_GET['action']:"prehled";
?>
<h2>Nastavení</h2>
    <div id="main">
        <?php
            switch ($action)
            {
                case 'sezona':
                    require 'component/nastaveni/sezona.php';
                    break;

                case 'kategorie':
                    require 'component/nastaveni/kategorie.php';
                    break;

                case 'default':
                    require  'component/nastaveni/sezona.php';
                    break;
            }


        ?>


    </div>
