<?php
$action = (isset($_GET['action']))?$_GET['action']:'celkem';

?>

<div id="sidebar">
      <ul class="sideNav">
          <li><a href="?page=objednavky&action=celkem" <?php echo ($action == "celkem")   ?"class=\"active\"":""; ?>>Celkem</a></li>
          <li><a href="?page=objednavky&action=nevyrizene" <?php echo ($action == "nevyrizene")   ?"class=\"active\"":""; ?>>Nevyřízené objednávky</a></li>
          <li><a href="?page=objednavky&action=vyrizene" <?php echo ($action == "vyrizene")  ?"class=\"active\"":""; ?>>Vyřízené objednávky</a></li>
          <li><a href="?page=objednavky&action=storno" <?php echo ($action == "storno")   ?"class=\"active\"":""; ?>>Stornované</a></li>
      </ul>
        <!-- // .sideNav -->
    </div>

<?php

$objednavkaClass = new \database\objednavka();

// stripslashes?


if (file_exists('component/objednavky/'.$action.'.php')){
    require_once 'component/objednavky/'.$action.'.php';
} else {
    // error
    require_once 'component/objednavky/celkem.php';
}
