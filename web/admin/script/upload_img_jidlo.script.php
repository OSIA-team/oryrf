<?php
// ID jídla
$jidlo_id = $_POST['jidlo_id'];

require '../../model/database.class.php';
$mysqli = new database();

require '../../model/jidlo.class.php';
$jidlo = new jidlo($mysqli);

// Preskocit = defaultni obrazek (resi defaultni hodnoty v db)
if (isset($_POST['preskocit'])) {

  $upload_img = $jidlo->addImageToJidlo($jidlo_id);
  # upload default image
    header("Location: ../?page=jidlo&action=detail&id=$jidlo_id");
}
elseif(isset($_POST['nahrat'])) {

  require '../../model/public/upload.class.php';
  //var_dump($_FILES);

    // trida upload preda $_FILES
    // uprava nazvu aby nebyly mezery
    $_FILES['my_field']['name'] = str_replace(" ", "-", mt_rand().$_FILES['my_field']['name']);
    // Upload object
    $upload = new upload($_FILES['my_field'], "cs_CS");
    // Overeni zda je obrazek uspesne nahran do tmp slozky
    if ($upload->uploaded) {
        // Manipulace s obrazkem
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 226;
        $upload->image_y = 226;
        $upload->image_ratio_crop           = true;
        // Presuneme fotku ze slozky temp
        $upload->Process("../../img/");
        // Jestli se zadarilo
        if ($upload->processed) {
            // Vlozeni fotky/obrazku do databaze
            // priprava promennych
            $photo_name   = $_FILES['my_field']['name'];
            // Object pro manipulaci s tabulkou fotka v databazy
            $insert_fotka = $jidlo->addImageToJidlo($jidlo_id, $photo_name);
            if ($insert_fotka){
                header("Location: ../?page=jidlo&action=prehled");
            } else {
              echo "error";
            }

        } else {
            die($upload->error);
        }
    }

}


 ?>
