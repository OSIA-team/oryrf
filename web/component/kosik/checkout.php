<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 24.01.18
 * Time: 23:23
 */
?>


<div class="progres">
    <div class="timeline">
        <div class="timeline-step complete"><p>1</p><div class="header">Košík</div></div>
        <div class="timeline-step complete"><p>2</p><div class="header">Adresa a platba</div></div>
        <div class="timeline-step"><p>3</p><div class="header">Hotovo</div></div>
    </div>
</div>

<section class="mid-step">
    <h4>Způsob doručení a adresa</h4>
    <form class="" method="post" action="?page=kosik&action=finish-order">
        <div class="row">
            <div class="input-field col s12">
                <select name="zpusobdoruceni">
                    <option value="" disabled selected>Zvolte typ doručení</option>
                    <option value="1">Osobně</option>
                    <option value="2">Rozvozem do 40minut</option>
                </select>
            </div>
            <div class="input-field col s12">
                <select name="zpusobplaceni">
                    <option value="" disabled selected>Zvolte typ platby</option>
                    <option value="Stravenkami">Stravenkami</option>
                    <option value="Hotově">Hotově</option>
                    <option value="Kartou u kurýra">Kartou u kurýra</option>
                </select>
            </div>
            <div class="input-field col s6">
                <input id="first_name" type="text" class="validate" name="jmeno" required>
                <label for="first_name">Jméno</label>
            </div>
            <div class="input-field col s6">
                <input id="number" type="text" class="validate" name="mobil" required>
                <label for="number">Telefoní číslo</label>
            </div>
            <div class="input-field col s12">
                <input id="email" type="email" class="validate" name="email" required>
                <label data-error="Špatně zadaný email" for="email">E-mail</label>
            </div>
            <div class="input-field col s12">
                <input id="adresa" type="text" class="validate" name="adresa" required>
                <label data-error="nevyplněná adresa" for="email">Doručovací adresa</label>
            </div>
            <div class="input-field col s12">
                <textarea id="textarea1" class="materialize-textarea" name="poznamka"></textarea>
                <label for="textarea1">Poznámka k objednávce</label>
            </div>
            <div class="row">
                <h4 class="col s12">Kdy chcete doručit jídlo?</h4>
                <p class="col s6 m3">
                    <input name="group1" type="radio" id="test1" name="casdoruceni" value="Co nejdříve" checked="checked" onclick="schovPicker();"/>
                    <label for="test1">Co nejdříve</label>
                </p>
                <p class="col s6 m3">
                    <input name="group1" type="radio" id="test2" name="casdoruceni" value="Později" onclick="zobrazPicker();"/>
                    <label for="test2">Později</label>
                </p>
            </div>
            <div id="picker" class="row">
                <div class="input-field col s12 m6">
                    <label for="timepicker_ampm_dark">Čas pozdějšího doručení</label>
                    <input id="timepicker_ampm_dark" class="timepicker" type="time" name="cas">
                </div>
            </div>
            <input type="submit" name="finish-order" class="col s12 m6  offset-l10 next-btn" value="Dokončit objednávku">
        </div>
    </form>


</section>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();

        $('.timepicker').pickatime({
            default: 'now', // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: true, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function(){} //Function for after opening timepicker
        });
    });

    function zobrazPicker(){
        $("#picker").show();
    }
    function schovPicker(){
        $("#picker").hide();
    }
</script>
</html>
