<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 10.02.2018
 * Time: 22:54
 */

///////////////////////////////////////////////////////////////////////////
// action upload_img
///////////////////////////////////////////////////////////////////////////
if($_GET['action'] == "upload_img"):
    ?>


    <h2>Jídlo &raquo; <span class="active">Nahrát obrázek k jídlu</span></h2>

    <div id="main">

        <h3>Přidat obrázek k jídlu</h3>
        <form action="script/upload_img_jidlo.script.php" class="jNice" method="POST" enctype="multipart/form-data">
            <fieldset>
                <p><label>Název:</label> <?= $_GET['id'] ?></p>

                <input type="file" accept="image/*" name="my_field" value="Vybrat novou fotku" /><br>
                <input type="hidden" value="<?= $_GET['id'] ?>" name="jidlo_id" />
                <input type="submit" value="Nahrát" name="nahrat" />
                <input type="submit" value="Přeskočit" name="preskocit" />
                <p>* V případě přeskočení kroku bude nahrán výchozí obrázek </p>
            </fieldset>
        </form>

    </div>
    <!-- // #main -->
<?php
endif;
?>
