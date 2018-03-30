<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 17.03.2018
 * Time: 15:51
 */

$userClass = new \database\user();

$users = $userClass->getUsers(0);
?>
<h2><a href="#">Uživatelé</a> &raquo; <a href="#" class="active">Přehled</a></h2>

<div id="main">

    <h3>Všichni</h3>

    <form>
        <div class="container">
            <?php
            foreach ($users as $user):
                ?>
                <a href="?page=uzivatele&action=detail&id=<?= $user['id'] ?>" class="edit">
                    <div class="row">
                        <div><?= $user['id']." - ".$user['email']." -- ".$user['jmeno']." -- ".$user['mobil']." --- ".$user['username'] ?></div>
                        <div class="action">Detail</div>
                    </div>
                </a>
            <?php
            endforeach;
            ?>
        </div>
    </form>
</div>