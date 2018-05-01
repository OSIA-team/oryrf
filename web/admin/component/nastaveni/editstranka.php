<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 19.04.18
 * Time: 21:03
 */
(int)$id = $_GET['id'];
$strankaClass = new \database\stranka();
$stranka = $strankaClass->getFullStrankaById($id);
$active = ($stranka['active'] == 1)?'checked':'';
if (!$stranka){
    //error
    echo "error";
    die();
}
?>
<div id="main">
    <h3>Upravit stránku <?= $stranka['nazev'] ?></h3>
    <div class="container">
        <form method="post" style="margin-top: 20px;">
        <script type="text/javascript" src="style/js/nicEdit.js"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        </script>

        <textarea name="content" cols="100" rows="20">
            <?= $stranka['content'] ?>
        </textarea>
        <br />
            <label>
                <input type="checkbox" name="active" value="1" class="jNiceCheckbox" style="display: block;" <?= $active ?> >Aktivní
            </label>
            <br /> <br />
          <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" name="editStranka" value="Uložit změny" />
        </form>

    </div>
</div>

