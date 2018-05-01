<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 26.04.18
 * Time: 22:45
 */
$strankaClass = new \database\stranka();
$alert = $strankaClass->strankaExists('alert');
$active = ($alert['active'] == 1)?'checked':'';
//  TODO: ZAKAZOVANI OBJEDNAVEK
$disable_orders = (\core\core::getProjectInfo('disable_orders') == 1)?'checked':'';
?>
<div id="main">

    <h3>Upozornění</h3>
    <div class="container">
        <form method="post" style="margin-top: 20px;">
            <p><label>Obsah upozornění:</label><br>
                <textarea cols="80" rows="2" name="content"><?= $alert['content'] ?></textarea>
                <input type="hidden" name="id" value="<?= $alert['id'] ?>"/>
            </p>
            <br>
            <br>
            <p>
            <label>
                <input type="checkbox" name="active" value="1" class="jNiceCheckbox" style="display: block;" <?= $active ?> >Aktivní
            </label>
            </p>
            <br>
            <p>
                <label>
                    <input type="checkbox" name="disable_orders" value="1" class="jNiceCheckbox" style="display: block;" <?= $disable_orders ?> > Zakázat objednávky
                </label>
            </p>
            <br>
            <input type="hidden" name="id" value="<?= $alert['id'] ?>" />
            <input type="submit" class="btn btn-outline-success" value="Editovat" name="edit_alert" />
        </form>
    </div>
</div>

