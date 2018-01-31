<nav class="grey darken-4">
<div class="nav-wrapper">
  <a href="?page=home" class="brand-logo">
    <div class="vlajecka-logo">
        <img src="pict/logo_bezpozadi.png" alt="logo" width="98" height="53">
    </div>
  </a>
  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
  <div class="center menu hide-on-med-and-down">
    <a href="?page=menu">MENU</a></li>
    <a href="?page=kontakt">KDE NÁS NAJDETE</a>
    <a href="?page=onas">O NÁS</a>
  </div>
    <a href="?page=kosik" >
  <ul class="kosik-menu">
    <div class="menu-polozka"><?= $kosikClass->getPocet() ?></div><div><?= $kosikClass->getCena() ?> Kč</div>
  </ul>
    </a>
  <ul class="side-nav" id="mobile-demo">
    <li><a href="sass.html">MENU</a></li>
    <li><a href="badges.html">KDE NÁS NAJDETE</a></li>
    <li><a href="collapsible.html">O NÁS</a></li>
  </ul>
</div>
</nav>
