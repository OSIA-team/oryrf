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
          <form class="produkt-form">
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
              <?php
              if ($jidlo['priloha_modulo'] == 1):
              ?>
                  <button type="submit" name="pridat_do_kosiku" class="material-icons objednat-btn modal-trigger" data-target="priloha" ><i class="material-icons">shopping_basket</i></button>
              <?php
                endif;
                if($jidlo['priloha_modulo'] == 0):
              ?>
                    <input type="submit" name="pridat_do_kosiku" class="material-icons objednat-btn" value="shopping_basket"/>
              <?php
                endif;
              ?>
          </form>
        </div>


        <div id="priloha" class="modal">
          <div class="modal-content">
            <h4>K hranolkům omáčku nebo dip?</h4>
            <p> Vyzkoušejte naše domácí omáčky a dipy! </p>
            <div class="">
              <input type="checkbox" class="filled-in" id="omacka1" />
              <label for="omacka1">Česneková omáčka <b>35,-Kč</b></label>
            </div>

            <div class="">
              <input type="checkbox" class="filled-in" id="omacka2" />
              <label for="omacka2">Kečupová omáčka <b>35,-Kč</b></label>
            </div>

            <div class="">
              <input type="checkbox" class="filled-in" id="omacka3" />
              <label for="omacka3">Tatarska omáčka <b>35,-Kč</b></label>
            </div>

          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">přidat do košíku</a>
          </div>
        </div>
<?php
endforeach;
 ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.modal').modal();
});


$(function () {

        $('.objednat-btn').on('click', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'script/send-order.php',
            data: $('.produkt-form').serialize(),
            success: function () {
             alert('form was submitted');
            }
          });

        });

      });


$(".ddd").on("click", function () {

    var $button = $(this);
    var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

    if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }

    $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);

});
</script>
