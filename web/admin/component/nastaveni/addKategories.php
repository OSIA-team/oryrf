<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 31.12.17
 * Time: 13:46
 */
?>
<h3>Přidat Kategorii</h3>
  <form method="post" enctype="multipart/form-data" >
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td><input type="text" class="medium" name="nazev" placeholder="Název kategorie" /></td>
            <td><label><input type="checkbox" name="topmenu" />V horním menu</label></td>
        </tr>

    </table>
        <input type="hidden" name="proceed" value="TRUE" />
        <input type="submit" name="addKategorie" value="Přidat" />
  </form>