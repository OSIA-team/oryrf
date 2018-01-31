<?php

if (isset($_POST['pridat_jidlo'])) {


require '../../model/database.class.php';
$mysqli = new database();

require '../../model/jidlo.class.php';
$menuItem = new jidlo($mysqli);


foreach ($_POST as $key => $value) {
  $$key = $value;
}
/*
$jidlo      = (!isset($jidlo))    ? 0 : 1 ;
$piti       = (!isset($piti))     ? 0 : 1 ;
$priloha    = (!isset($priloha))  ? 0 : 1 ;
$alko       = (!isset($alko))     ? 0 : 1 ;
$hracka     = (!isset($hracka))   ? 0 : 1 ;
$menu       = (!isset($menu))     ? 0 : 1 ;
*/

$insert_jidlo = array(
      'nazev'       => "{$nazev}",
      'popis'       => "{$popis}",
      'ingredience' => "{$ingredience}",
      'kategorie'   => "{$kategorie}",
      'gramaz'      => "{$gramaz}",
      'cena'        => $cena
);

var_dump($jidlo);

$jidlo_id = $menuItem -> addJidlo($insert_jidlo);

if ($jidlo_id != FALSE) {
  header("Location: ../?page=jidlo&action=upload_img&id={$jidlo_id}");
} else {
  # error
}

}



 ?>
