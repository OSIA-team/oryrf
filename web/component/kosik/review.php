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
var_dump($jidlaVkosiku);
?>
<div class="progres">
    <div class="timeline">
        <div class="timeline-step complete"><p>1</p><div class="header">Košík</div></div>
        <div class="timeline-step"><p>2</p><div class="header">Adresa a platba</div></div>
        <div class="timeline-step"><p>3</p><div class="header">Rekapitulace</div></div>
    </div>
</div>

<form class="" method="post" action="?page=kosik&action=to-checkout">
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
        <input type="hidden" name="cenaCelkem" value="<?= $kosikClass->getCena() ?>" />
        <input type="submit" name="to-checkout" class="col l2 m12  offset-l10 next-btn" value="Pokračovat">
    </div>

</form>

<script type="text/javascript">
$(".close-btn").on("click", function () {

    var $button = $(this);
    var oldSuma = document.getElementById('cenacelkem').innerHTML;
    var cenaZrusena = $button.closest('.polozka').find('h5.cena').text();
    oldSuma = oldSuma.replace(' Kč', '');
    cenaZrusena = cenaZrusena.replace(' Kč', '');

    console.log(cenaZrusena);
    console.log(oldSuma);

    $button.closest('.polozka').find('input.quntity-input').val(0);
    $('#cenacelkem').text((Number(oldSuma)-Number(cenaZrusena))+" Kč");
    $button.closest('.polozka').css("display", "none");
  });
</script>
