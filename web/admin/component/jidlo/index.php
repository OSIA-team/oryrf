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
switch ($action){
    case 'prehled':
        require_once 'component/jidlo/prehled.php';
        break;

    case 'kategorie':
        require_once 'component/jidlo/kategorie.php';
        break;

    case 'pridat':
        require_once 'component/jidlo/pridat.php';
        break;

    case 'upload_img':
        require_once 'component/jidlo/upload_img.php';
        break;

    case 'detail':
        require_once 'component/jidlo/detail.php';
        break;

    case 'edit':
        require_once 'component/jidlo/edit.php';
        break;

    case 'delete':
        require_once 'component/jidlo/delete.php';
        break;

    default:
        require_once 'component/jidlo/prehled.php';
        break;
}