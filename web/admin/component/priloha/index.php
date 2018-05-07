<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 06.05.2018
 * Time: 15:25
 */

// stripslashes?
$action = (isset($_GET['action']))?$_GET['action']:'vsichni';

?>
    <div id="sidebar">
        <ul class="sideNav">
            <li><a href="?page=priloha&action=default" <?php echo ($action == "default")  ?"class=\"active\"":""; ?>>Výchozí</a></li>
        </ul>
        <!-- // .sideNav -->
    </div>
<?php


if (file_exists('component/priloha/'.$action.'.php')){
    require_once 'component/priloha/'.$action.'.php';
} else {
    // error
    echo 'error';
    // require_once 'component/uzivatele/prehled.php';
}