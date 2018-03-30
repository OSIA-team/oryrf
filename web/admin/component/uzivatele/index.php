<?php
// stripslashes?
$action = (isset($_GET['action']))?$_GET['action']:'vsichni';

?>
<div id="sidebar">
      <ul class="sideNav">
          <li><a href="?page=uzivatele&action=vsichni" <?php echo ($action == "vsichni")  ?"class=\"active\"":""; ?>>Všichni</a></li>
          <li><a href="?page=uzivatele&action=registrovani" <?php echo ($action == "registrovani")   ?"class=\"active\"":""; ?>>Registrovaní</a></li>
          <li><a href="?page=uzivatele&action=neregistrovani" <?php echo ($action == "neregistrovani")  ?"class=\"active\"":""; ?>>Neregistrovaní</a></li>
      </ul>
        <!-- // .sideNav -->
    </div>
<?php


if (file_exists('component/uzivatele/'.$action.'.php')){
    require_once 'component/uzivatele/'.$action.'.php';
} else {
    // error
    echo 'error';
    // require_once 'component/uzivatele/prehled.php';
}