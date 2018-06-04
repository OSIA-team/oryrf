<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 24.04.18
 * Time: 22:53
 */
if ($stranka['active'] == 0) die("Stránka není k dispozici");
?>
    <div class="product">
        <div class="obrazek">
            <img src="<?php echo $stranka['image']; ?>" alt="">
            <div class="title"><h3><?= $stranka['nazev'] ?></h3></div>
        </div>
    </div>

<div class="container">
<?php
echo html_entity_decode($stranka['content']);
?>
</div>
