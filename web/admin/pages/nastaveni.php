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
                    require 'pages/sezona.php';
                    break;

                case 'kategorie':
                    require 'pages/kategorie.php';
                    break;

                case 'default':
                    require  'pages/sezona.php';
                    break;
            }


        ?>


    </div>
