<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 23:10
 */

$action = (isset($_GET['action']))?$_GET['action']:'kategorie';
?>
<div id="sidebar">
      <ul class="sideNav">
          <li><a href="?page=nastaveni&action=kategorie" <?php echo ($action == "kategorie")  ?"class=\"active\"":""; ?>>Správa kategorií</a></li>
          <li><a href="?page=nastaveni&action=sezona" <?php echo ($action == "sezona")   ?"class=\"active\"":""; ?>>Správa sezón</a></li>
          <li><a href="?page=nastaveni&action=stranka" <?php echo ($action == "stranka")   ?"class=\"active\"":""; ?>>Správa stránek</a></li>
          <li><a href="?page=nastaveni&action=alert" <?php echo ($action == "alert")   ?"class=\"active\"":""; ?>>Nastavení upozornění</a></li>
      </ul>
        <!-- // .sideNav -->
    </div>

 <?php
// stripslashes?


if (file_exists('component/nastaveni/'.$action.'.php')){
    require_once 'component/nastaveni/'.$action.'.php';
} else {
    // error
    echo "error";
   // require_once 'component/nastaveni/kategorie.php';
}

        ?>