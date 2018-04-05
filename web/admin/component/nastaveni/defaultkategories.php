<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 31.12.17
 * Time: 13:45
 */

?>

<h3>Správa kategorií</h3>
<form method="post" >
    <?php
    $kategories = $kategorieClass->getAllKategorie();

    foreach($kategories as $kategorie):
        ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td><label># <?= $kategorie['id'] ?><input type="hidden" name="id[]" value="<?= $kategorie['id'] ?>" /></label>
                    <input type="text" value="<?= $kategorie['nazev'] ?>" class="text-medium" name="nazev[]" /></td>
                <td class="action">
                    <form method="post">
                        <input type="hidden" value="<?= $kategorie['id'] ?>" name="id" />
                        <input class="delete" onclick="confirm('Opravdu chcete tuto kategorii vymazat?')" type="submit" name="delete" value="Vymazat" >
                   </form>
                </td>
            </tr>
        </table>
    <?php
    endforeach;
    ?>
    <input type="submit" value="Editovat" name="zmenKategories"/>
    <input type="submit" value="Přidat kategorie" name="addKategories"/>
</form>

