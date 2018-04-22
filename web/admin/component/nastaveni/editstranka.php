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

        <!-- Include stylesheet -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

        <!-- Create the editor container -->
        <form method="post" onsubmit="javascript: return process();" enctype="multipart/form-data" >
            <img src="../img/<?= $stranka['image'] ?>" height="150px" /> <br>
            <input type="file" accept="image/*" name="image" value="Vybrat novou fotku" />
            <div id="editor">

            </div>
            <input type="hidden" name="content" id="hiddenContent" value="<?= $stranka['content'] ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" name="editStranka" value="Uložit změny" />
        </form>

        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow'
            });
            quill.setText("<?= $stranka['content'] ?>");


            function process() {
                var html = quill.root.innerHTML;
                //var delta = quill.getContents();
                document.getElementById("hiddenContent").value = html;

                return true;
            }

        </script>
    </div>
</div>

