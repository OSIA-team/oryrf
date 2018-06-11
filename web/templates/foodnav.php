<?php
$kategories = $kategorieClass->getAllKategorie('topmenu = 1');
?>
    <div class="banner" style="
            width: 100%;
            height: 350px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-image: url('img/<?= $kategorieBackground ?>');">
      <div class="jidelnicek">
        <ul>
            <?php
                foreach($kategories as $kat):
            ?>
                <a href="?page=menu&kategorie=<?= $kat['url'] ?>"><li><img src="img/<?= $kat['icon'] ?>" alt="<?= $kat['alt'] ?>"><?= $kat['nazev'] ?></li></a>
            <?php
                endforeach;
            ?>
        </ul>
      </div>
      <h1><?= ucfirst($kategorie) ?></h1>
    </div>
<?php
$kategories = $kategorieClass->getAllKategorie("visible = 1 ");
?>
<section class="container product-list">
  <div class="navigation-sidebar">
    <nav>
      <ul>
          <?php
            foreach ($kategories as $kat):
          ?>
                <a href="?page=menu&kategorie=<?= $kat['url'] ?>"><li
                        <?php
                            if($urlKategorie == $kat['url']){
                                echo "class=\"active\"";
                            }
                        ?>
                    ><?= $kat['nazev'] ?><i class="large material-icons">navigate_next</i></li></a>
          <?php
           endforeach;

           unset($kategories);
          ?>
      </ul>
    </nav>
  </div>
