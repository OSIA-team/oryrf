<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 24.01.18
 * Time: 23:17
 */

$jidlaVkosiku = array();
$obsahKosiku = $_SESSION['kosik']['obsah'];
$counter = 1;
foreach ($obsahKosiku as $id => $pocet){
    $jidlaVkosiku[$counter]['jidlo'] = $menuItem->getJidloById($id);
    $jidlaVkosiku[$counter]['jidlo']['fotka'] = $menuItem->getFotkaByJidloId($id);
    $jidlaVkosiku[$counter]['jidlo']['pocet'] = $pocet;
    $counter++;
}
unset($obsahKosiku);
// var_dump($jidlaVkosiku);
?>
<section class="kosik_wrap">
<div class="progres">
    <div class="timeline">
        <div class="timeline-step complete"><p>1</p><div class="header">Košík</div></div>
        <div class="timeline-step"><p>2</p><div class="header">Adresa a platba</div></div>
        <div class="timeline-step"><p>3</p><div class="header">Rekapitulace</div></div>
    </div>
</div>

<form class="produkt-form" method="post" action="?page=kosik&action=to-checkout">
    <section class="kosik">
        <?php
        foreach ($jidlaVkosiku as $jidla):
            foreach ($jidla as $jidlo):
                // print_r($jidlo);
                ?>

                <div class="polozka row">
                    <div class="col s12 l2">
                        <a href="#"> <img src="<?= $jidlo['fotka']['path']. $jidlo['fotka']['nazev'] ?>"> </a>
                    </div>
                    <div class="popis col s12 l4">
                        <h3><?= $jidlo['nazev'] ?></h3>
                        <h4>Popis</h4>
                        <h5 class="mnozstvi"><?= $jidlo['popis'] ?></h5>
                    </div>
                    <div class="col s6 l2">
                        <h5 class="cena"><?= $jidlo['cena']*$jidlo['pocet'] ?> Kč</h5>
                        <input type="hidden" name="prize" class="prize-of-food" value="<?= $jidlo['cena']  ?>" />
                    </div>
                    <div class="col s6 l2">
                        <div class="sp-quantity">
                            <input type="hidden" name="id[]" value="<?= $jidlo['id']  ?>" />
                            <input type="hidden" name="jidlo_id" value="<?= $jidlo['id']  ?>" />
                            <div class="sp-input"><input type="text" class="quntity-input" name="pocet[]" value="<?= $jidlo['pocet'] ?>" /></div>
                            <div class="sp-plus fff ddd">+</div>
                            <div class="sp-minus fff ddd">-</div>
                        </div>
                    </div>
                    <i class="tiny material-icons close-btn">close</i>
                </div>
            <?php
            endforeach;
        endforeach;
        ?>
    </section>

    <div class="suma row">
        <div class="col s6 l2 offset-s0 offset-l8">Celkem</div>
        <div class="col s6  l2" id="cenacelkem"><?= $kosikClass->getCena() ?> Kč</div>
        <input type="hidden" id="cenacelkemInput" name="cenaCelkem" value="<?= $kosikClass->getCena() ?>" />
        <input type="submit"
               name="to-checkout"
               class="col l2 m12  offset-l10 next-btn"
               value="Pokračovat"
            <?php
                echo (\core\core::getProjectInfo('disable_orders') == 1)?"disabled":"";
            ?>
        >
    </div>

</form>
</section>
<script type="text/javascript">


$(".close-btn").on("click", function () {

    var $button = $(this);
    var oldSuma = document.getElementById('cenacelkem').innerHTML;
    var cenaZrusena = $button.closest('.polozka').find('h5.cena').text();
    var itemsInKosik = 0;
    var pocetInput = document.getElementsByClassName('quntity-input');
    var kosikPocet = document.getElementById('pocet-kosik');
    var cenaKosik = document.getElementById('cena-kosik').innerHTML;

    cenaKosik = cenaKosik.replace(' Kč', '');
    oldSuma = oldSuma.replace(' Kč', '');
    cenaZrusena = cenaZrusena.replace(' Kč', '');



    $button.closest('.polozka').find('input.quntity-input').val(0);
    //console.log($button.closest('.polozka').find("input[name='jidlo_id']").val());
    $('#cenacelkem').text((Number(oldSuma)-Number(cenaZrusena))+" Kč");
    $('#cenacelkemInput').val((Number(oldSuma)-Number(cenaZrusena)));
    $button.closest('.polozka').css("display", "none");

    //$('form.produkt-form').hide();

    for (var j = 0; j < pocetInput.length; j++) {
      itemsInKosik = Number(itemsInKosik) + Number(pocetInput[j].value);
    }

      cenaKosik -= Number(cenaZrusena);
      document.getElementById('cena-kosik').innerHTML = cenaKosik + " Kč";
      kosikPocet.innerHTML = itemsInKosik;
      checkEmptyOrder();

      var formValue = $('form.produkt-form').serialize();
          formValue = formValue+"&change=true";

      $.ajax({
        type: 'post',
        url: 'script/send-order.php',
        data: formValue,
        dataType: 'json',
        async: false,
        success: function (d) {

         if(d.stav == "true"){
           //$( "#add-success" ).slideDown(500).delay(5000).slideUp( 500 );
           //console.log('ok')
         }
         else{
           //$( "#add-error" ).slideDown(500).delay(5000).slideUp( 500 );
           //console.log('false')
         }

        }
      });

      console.log(formValue);
      });

  $(".ddd").on("click", function () {

      var $button = $(this);
      var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();
      var cenaJidla = $(this).closest('div.polozka').find('input.prize-of-food').val();
      var cenaPolozka = $(this).closest('div.polozka').find('h5.cena');
      var cena = document.getElementsByClassName('cena');
      var pocetInput = document.getElementsByClassName('quntity-input');
      var suma = 0;
      var itemsInKosik = 0;

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
      cenaPolozka.html(newVal*cenaJidla+" Kč");

      for (var i = 0; i < cena.length; i++) {
        var mystring = cena[i].innerHTML
        mystring = mystring.replace(' Kč','');


        suma = Number(suma)+Number(mystring);
        //console.log('upravena suma'+suma);

        document.getElementById('cenacelkem').innerHTML = suma+" Kč";
        document.getElementById('cena-kosik').innerHTML = suma+" Kč";
        document.getElementById('cenacelkemInput').value = suma;
      }

      for (var j = 0; j < pocetInput.length; j++) {
        itemsInKosik = Number(itemsInKosik) + Number(pocetInput[j].value);
      }
        checkEmptyOrder();
        document.getElementById('pocet-kosik').innerHTML = itemsInKosik;


        var data = $(this).closest('.produkt-form').serialize();
        data = data +"&change=true";

        $.ajax({
          type: 'post',
          url: 'script/send-order.php',
          data: data,
          dataType: 'json',
          async: false,
          success: function (d) {

           if(d.stav == "true"){
             //$( "#add-success" ).slideDown(500).delay(5000).slideUp( 500 );
             //console.log('ok')
           }
           else{
             //$( "#add-error" ).slideDown(500).delay(5000).slideUp( 500 );
             //console.log('false')
           }

          }
        });
  });


  function checkEmptyOrder(){     //ukontroluje jestli košík není prázdný
       if($('#cenacelkemInput').val() == "0"){  //pokud je
        $('.next-btn').addClass('disabled');    //nastaví tlačítko na disabled
      }else{
        $('.next-btn').removeClass('disabled'); //pokud není prázdný odstraní třídu disabled
      }

  }


checkEmptyOrder();

</script>
