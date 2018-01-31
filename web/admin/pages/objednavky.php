<div id="sidebar">
      <ul class="sideNav">
          <li><a href="?page=objednavky&action=nevyrizene" <?php echo ($_GET['action'] == "nevyrizene")   ?"class=\"active\"":""; ?>>Nevyřízené objednávky</a></li>
          <li><a href="?page=objednavky&action=vyrizene" <?php echo ($_GET['action'] == "vyrizene")  ?"class=\"active\"":""; ?>>Vyřízené objednávky</a></li>
          <li><a href="?page=objednavky&action=celkem" <?php echo ($_GET['action'] == "celkem")   ?"class=\"active\"":""; ?>>Celkem</a></li>
      </ul>
        <!-- // .sideNav -->
    </div>

<?php
$action = $_GET['action'];

require '../model/objednavka.class.php';
$objednavkaClass = new objednavka($mysqli);

switch ($action) {
    case 'nevyrizene':
        require 'component/objednavky/nevyrizene.php';
        break;

    case 'vyrizene':
        require 'component/objednavky/vyrizene.php';
        break;

    case 'celkem':
        require 'component/objednavky/celkem.php';
        break;

    case 'detail':
        require 'component/objednavky/detail.php';
        break;

    default:
        require 'component/objednavky/celkem.php';
        break;
}
