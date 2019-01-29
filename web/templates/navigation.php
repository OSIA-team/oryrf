<nav class="grey darken-4">
<div class="nav-wrapper">
  <a href="?page=home" class="brand-logo">
    <div class="vlajecka-logo">
        <div class="brand"></div>
    </div>
  </a>
  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
  <div class="center menu hide-on-med-and-down">
    <a href="?page=menu">MENU</a></li>
    <a href="?page=kontakt">KDE NÁS NAJDETE</a>
    <a href="?page=rozvoz">ROZVOZ</a>
      <?php
        $stranky = $strankaClass->getAll('page', 'active = 1');
        foreach ($stranky as $stranka):
      ?>
            <a href="?page=<?= $stranka['url'] ?>"><?= $stranka['nazev'] ?></a>
      <?php
        endforeach;
      ?>


      <!--
    <a href="?page=kontakt">KDE NÁS NAJDETE</a>
    <a href="?page=onas">O NÁS</a> -->
  </div>
    <a href="?page=kosik" >
  <ul class="kosik-menu">
    <div class="menu-polozka" id="pocet-kosik"><?= $kosikClass->getPocet() ?></div><div id="cena-kosik"><?= $kosikClass->getCena() ?> Kč</div>
  </ul>
    </a>
  <ul class="side-nav" id="mobile-demo">
    <li><a href="?page=menu">MENU</a></li>
    <li><a href="?page=kontakt">KDE NÁS NAJDETE</a></li>
    <?php
      $stranky = $strankaClass->getAll('page', 'active = 1');
      foreach ($stranky as $stranka):
    ?>
          <li><a href="?page=<?= $stranka['url'] ?>"><?= $stranka['nazev'] ?></a></li>
    <?php
      endforeach;
    ?>
  </ul>
</div>
</nav>
