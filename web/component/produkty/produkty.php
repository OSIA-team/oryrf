<div class="products">
<?php

  if (!$kategorie){
      $jidla = $menuItem->getRandomJidlo();
  } else {
      $jidla    = $menuItem->getAllJidloByKategorie($urlKategorie);
  }
  $i = 1;
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

<?php
  $i++;
endforeach;
 ?>

 <div id="priloha" class="modal">
   <div class="modal-content">
       <?php
        //TODO: Editave v administraci
       ?>
     <h4>Vyberte si přílohu<span class="badge">nepovinné</span></h4>
     <form class="prilohy">
         <?php
             $lastKat = "";
             $prilohaClass = new \database\priloha();
             $prilohy = $prilohaClass->getPrilohaByKategorieId($kategorieClass->id);
             foreach ($prilohy as $priloha):
                 if($lastKat != $priloha['kategorie']){
                    echo "<div class='priloha-kategorie'>";
                     echo "<h5>".$priloha['kategorie']."</h5>";
                     $lastKat = $priloha['kategorie'];
                 }
         ?>
           <div class="">
           <input type="checkbox" class="filled-in" name="jidlo_id[]" id="priloha<?= $priloha['id'] ?>" value="<?= $priloha['id'] ?>"/>
           <label class="omacka-label" for="priloha<?= $priloha['id'] ?>"><?= $priloha['nazev'] ?> <b><?= $priloha['cena'] ?> Kč</b></label>
         </div>
       <?php

                 $next = next($prilohy);
                    if ( $next['kategorie'] != $priloha['kategorie'] ){
                        echo "</div>";
                    } // */

         endforeach;
       ?>
     </form>
   </div>
   <div class="modal-footer">
     <a href="#!" class="modal-action modal-close waves-effect add-priloha waves-red btn">přidat přílohu</a>
   </div>
 </div>
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
            data: $(this).closest('.produkt-form').serialize(),
            dataType: 'json',
            async: false,
            success: function (d) {

             if(d.stav == "true"){
               $( "#add-success" ).slideDown(500).delay(5000).slideUp( 500 );
             }
             else{
               $( "#add-error" ).slideDown(500).delay(5000).slideUp( 500 );
             }

             document.getElementById('pocet-kosik').innerHTML = d.pocet;
             document.getElementById('cena-kosik').innerHTML = d.cena+" Kč";
            }
          });

        });


        $('.add-priloha').on('click', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'script/send-order.php',
            data: $(this).closest('div').prev().closest('.modal-content').find('.prilohy').serialize(),
            dataType: 'json',
            async: false,
            success: function (d) {
              document.getElementById('pocet-kosik').innerHTML = d.pocet;
              document.getElementById('cena-kosik').innerHTML = d.cena+" Kč";
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
