<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:45
 */


// stripslashes?
$action = (isset($_GET['action']))?$_GET['action']:'prehled';
?>
<div id="sidebar">
    <ul class="sideNav">
        <li><a href="?page=jidlo&action=prehled" <?php echo ($action == "prehled")  ?"class=\"active\"":""; ?>>Přehled</a></li>
        <li><a href="?page=jidlo&action=pridat"  <?php echo ($action == "pridat")   ?"class=\"active\"":""; ?>>Přidat</a></li>
    </ul>
    <!-- // .sideNav -->
</div>
<?php


if (file_exists('component/jidlo/'.$action.'.php')){
    require_once 'component/jidlo/'.$action.'.php';
} else {
    // error
    require_once 'component/jidlo/prehled.php';
}
