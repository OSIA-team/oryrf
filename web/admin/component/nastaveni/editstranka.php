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
if (!$stranka){
    //error
    echo "error";
    die();
}
?>
<div id="main">
    <h3>Upravit stránku <?= $stranka['nazev'] ?></h3>
    <div class="container">
        <script type="text/javascript" src="style/js/nicEdit.js"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        </script>

        <h4>First Textarea</h4>
        <textarea name="area1" cols="40"></textarea>
        <br />
            <input type="hidden" name="content" id="hiddenContent" value="<?= $stranka['content'] ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" name="editStranka" value="Uložit změny" />
        </form>

    </div>
</div>

