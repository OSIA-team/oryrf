<div class="products">
<?php

  if (!$kategorie){
      $jidla = $menuItem->getRandomJidlo();
  } else {
      $jidla    = $menuItem->getAllJidloByKategorie($urlKategorie);
  }

  // Write out
  foreach($jidla as $jidlo):

  $foto = $menuItem->getFotkaByJidloId($jidlo['id']);
  //Zjistim pocet v kosiku pro lepsi ovladani

 ?>
      <div class="product">
          <form method="post">
            <div class="obrazek">
               <img src="<?php echo $foto['path'].$foto['nazev']; ?>" alt="">
               <div class="title"><h3><?= $jidlo['nazev'] ?></h3></div>
            </div>
            <p><?= $jidlo['popis'] ?></p>
            <h4 class="background"><span>cena</span></h4>
            <div class="cena">
                <div class="text"><?= $jidlo['cena'] ?> Kč, <?= $jidlo['gramaz'] ?></div>
                <div class="sp-quantity">
                    <div class="sp-input"><input type="text" class="quntity-input" name="quntity-1" value="1" /></div>
                    <div class="sp-plus fff ddd">+</div>
                    <div class="sp-minus fff ddd">-</div>
                </div>
            </div>

                <input type="hidden" name="jidlo_id" value="<?= $jidlo['id'] ?>" />
                <input type="submit" name="pridat_do_kosiku" class="material-icons" value="shopping_basket"/>
          </form>
        </div>
<?php
endforeach;
 ?>
</div>
