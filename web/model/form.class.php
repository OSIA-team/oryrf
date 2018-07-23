<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 11.03.2018
 * Time: 18:12
 */

namespace core;
use database\database;
use database\jidlo;
use database\kategorie;
use database\objednavka;
use database\user;
use core\upload;
use core\core;
use database\stranka;
use database\priloha;

class form
{

    private $_mysqli;
    private $data = array();
    private $forms = array(
        'addKategorie' => 'addKategorie',
        'edit_jidlo' => 'editJidlo',
        'edit_kategorie' => 'editKategorie',
        'pridat_jidlo' => 'pridatJidlo',
        'upload_img' => 'uploadImgJidlo',
        'obj-status' => 'objStatus',
        'editUser'  => 'editUser',
        'editStranka' => 'editStranka',
        'edit_alert'  => 'editAlert',
        'prilohy'     => 'prilohy'
     //   'register' => 'register'
    );

    public function __construct($data){

        $this->_mysqli = new database();

        foreach ($data as $key => $value) {
            $this->data[$key] = $this->_mysqli->filter($value);
        }

        foreach ($this->forms as $name => $function){
            if (isset($this->data[$name])){
                $this->$function();
                continue;
            }
        }
    }

    private function addKategorie() {

         $kategorieClass = new kategorie();

        if (isset($_FILES['icon']['name'])){
            $upload = new upload($_FILES['icon'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                $upload->image_resize = true;
                $upload->image_ratio = true;
                $upload->image_x = 226;
                $upload->image_y = 226;
                $upload->image_ratio_crop = true;
                // Presuneme fotku ze slozky temp
                $upload->Process("../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    $icon   = $_FILES['icon']['name'];
                } else {
                    die($upload->error);
                }
            }
        } else {
            $icon = '';
        }

        if (isset($_FILES['background']['name'])){
            $upload = new upload($_FILES['background'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                $upload->image_resize = true;
                //  $upload->image_ratio = true;
                $upload->image_x = 3000;
                $upload->image_y = 1500;
                //  $upload->image_ratio_crop = true;
                // Presuneme fotku ze slozky temp
                $upload->Process("../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    $background   = $_FILES['background']['name'];
                } else {
                    die($upload->error);
                }
            }
        } else {
            $background = '';
        }
       //$background = (isset($background))?$background:"";
       // $icon       = (isset($this->data['icon']))?$this->data['icon']:"";
        $topmenu    = (isset($this->data['topmenu']))?1:0;
        $url        = strtolower($kategorieClass->remove_accents($this->data['nazev']));

        $insert = array(
            'nazev' => "{$this->data['nazev']}",
            'topmenu' => $topmenu,
            'icon'  => $icon,
            'background' => $background,
            'url'   => "{$url}"
        );

        $insered_id = $kategorieClass->addKategorie($insert);
        if ($insered_id){
            // return true;
            header("Location: ?page=nastaveni&action=kategorie");
        } else {
            return false;
            //echo 'error';
        }

    }

    private function editJidlo() {
        $menuItem = new jidlo();
        $priloha                = (!isset($this->data['priloha']))     ? 0 : 1 ;
        $priloha_modulo         = (!isset($this->data['priloha_modulo']))     ? 0 : 1 ;

        $where = [
            'id' => $this->data['id']
        ];

        $update = array(
            'nazev'       => "{$this->data['nazev']}",
            'popis'       => "{$this->data['popis']}",
            'ingredience' => "{$this->data['ingredience']}",
            'kategorie'   => "{$this->data['kategorie']}",
            'gramaz'      => "{$this->data['gramaz']}",
            'cena'        => $this->data['cena'],
            'priloha'       => $priloha,
            'priloha_modulo' => $priloha_modulo
        );

        $edit = $menuItem->editJidlo($update, $where);

        if ($_FILES['my_field']['name'] != "") {

            // trida upload preda $_FILES
            // uprava nazvu aby nebyly mezery
            $_FILES['my_field']['name'] = str_replace(" ", "-", mt_rand() . $_FILES['my_field']['name']);
            // Upload object
            $upload = new upload($_FILES['my_field'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                $upload->image_resize = true;
                $upload->image_ratio = true;
                $upload->image_x = 226;
                $upload->image_y = 226;
                // $upload->image_precrop              = '5%';
                $upload->image_ratio_crop           = false;
                // Presuneme fotku ze slozky temp
                //die("ok");
                $upload->process("../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    // Vlozeni fotky/obrazku do databaze
                    // priprava promennych
                    $photo_name = $_FILES['my_field']['name'];
                    // Object pro manipulaci s tabulkou fotka v databazy

                    $update = array(
                        'nazev' => $photo_name
                    );
                    $where = array(
                        'jidlo_id' => $this->data['id']
                    );

                    $upload_foto = $menuItem->editFotka($update, $where);
                }
            }
        } else {
            $upload_foto = true;
        }


            if ($edit AND $upload_foto) {
                header("Location: ?page=jidlo&action=prehled");
            } else {
                // error
                echo "error";
            }

    }

    private function editKategorie(){
        // var_dump($this->data); die();
        $kategorieClass= new kategorie();
        $kategorieClass->setUpKategorie($this->data['id']);

        if (isset($_FILES['icon']['name']) AND $_FILES['icon']['name'] != ""){

            $upload = new upload($_FILES['icon'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                // $upload->image_resize = true;
                //  $upload->image_ratio = true;
                // $upload->image_ratio_crop = true;
                // Presuneme fotku ze slozky temp
                $upload->Process("../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    $icon   = $_FILES['icon']['name'];
                } else {
                    die($upload->error);
                }
            }
        } else {
            $icon = $kategorieClass->icon;
        }

        if (isset($_FILES['background']['name'])  AND $_FILES['background']['name'] != ""){
            $upload = new upload($_FILES['background'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
               // $upload->image_resize = false;
                //  $upload->image_ratio = true;
               // $upload->image_x = 3000;
               // $upload->image_y = 1500;
                //  $upload->image_ratio_crop = true;
                // Presuneme fotku ze slozky temp
                $upload->Process("../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    $background   = $_FILES['background']['name'];
                } else {
                    die($upload->error);
                }
            }
        } else {
            $background = $kategorieClass->background;
        }

        $topmenu    = (isset($this->data['topmenu']))?1:0;
        $url        = str_replace(" ", "_", strtolower($kategorieClass->remove_accents_wp($this->data['nazev'])));
        $update = array(
            'nazev' => "{$this->data['nazev']}",
            'topmenu' => $topmenu,
            'icon'  => $icon,
            'background' => $background,
            'url'   => "{$url}"
        );

        $where = array(
            'id' => $this->data['id']
        );

        $result = $kategorieClass->updateKategorie($update, $where, $kategorieClass->url);
        if ($result){
            header("Location: ?page=nastaveni&action=kategorie");
        } else {
            echo '<h2>ERROR</h2>';
            echo '<pre>';
            var_dump($result);
            echo '</pre>';
        }
    }

    private function pridatJidlo(){
        $menuItem = new jidlo();

        $priloha = (isset($this->data['priloha']))?$this->data['priloha']:'';
        $priloha_modulo = (isset($this->data['priloha_modulo']))?$this->data['priloha_modulo']:'';
        $insert_jidlo = array(
            'nazev'             => "{$this->data['nazev']}",
            'popis'             => "{$this->data['popis']}",
            'ingredience'       => "{$this->data['ingredience']}",
            'kategorie'         => "{$this->data['kategorie']}",
            'gramaz'            => "{$this->data['gramaz']}",
            'cena'              => $this->data['cena'],
            'priloha_modulo'    => $priloha_modulo,
            'priloha'           => $priloha
        );



        $jidlo_id = $menuItem -> addJidlo($insert_jidlo);

        if ($jidlo_id != FALSE) {
            header("Location: ?page=jidlo&action=upload_img&id={$jidlo_id}");
        } else {
            # error
        }
    }

    private function uploadImgJidlo(){
        $jidlo = new jidlo();
        $this->_mysqli->fk(0);
        if (isset($this->data['preskocit'])){
            $upload_img = $jidlo->addImageToJidlo($this->data['jidlo_id']);
            # upload default image
            header("Location: ?page=jidlo&action=detail&id=$this->data['jidlo_id']");
        }
        elseif(isset($this->data['nahrat'])) {

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
        $upload->Process("../img/");
            // Jestli se zadarilo
        if ($upload->processed) {
            // Vlozeni fotky/obrazku do databaze
            // priprava promennych
        $photo_name   = $_FILES['my_field']['name'];
            // Object pro manipulaci s tabulkou fotka v databazy
        $insert_fotka = $jidlo->addImageToJidlo($this->data['jidlo_id'], $photo_name);
        if ($insert_fotka){
        header("Location: ?page=jidlo&action=prehled");
            } else {
                echo "error";
            }

            } else {
                die($upload->error);
            }
        }

        }
        $this->_mysqli->fk(1);
    }

    private function finishOrder(){


    }

    private function register(){
      /*  $password = crypt($this->data['password'],'$2a$07$thisisspartabel3syoknow$');

        $insert = array(
            'password' => (string)$password,
            'email' => (string)$this->data['email'],
            'jmeno' => (string)$this->data['jmeno'],
            'prijmeni' => (string)$this->data['prijmeni'],
            'mobil' =>  (string)$this->data['telefon'],
            'adresa' => (string)$this->data['adresa'],
            'registered' => 1
        );

        $userClass = new user();
        $userId = $userClass->addUser($insert);
        if ($userId) $userClass->createLoginSession($userId);
        if (!$userId) // */
    }

    private function objStatus(){
        $objednavka = new objednavka();

        switch ($this->data['obj-status']){
            case 'Storno':
                    if(!$objednavka->changeStatus(3,$this->data['id'])){
                        \core\core::debugLog("Change obj status to: 3 Failed");
                    }
                break;

            case 'Vydat':
                    if(!$objednavka->changeStatus(2,$this->data['id'])){
                \core\core::debugLog("Change obj status to: 2 Failed");
            }
                break;

            default:
                    //error
                    \core\core::debugLog('Bad status to change status value: '.$this->data['obj-status']);
                break;
        }
    }

    private function editUser(){
        $userClass = new user();
        $update = array(
            'email' => (string)$this->data['email'],
            'jmeno' => (string)$this->data['jmeno'],
            'prijmeni' => (string)$this->data['prijmeni'],
            'mobil' => (string)$this->data['mobil'],
            'adresa'=> (string)$this->data['adresa']
        );
        $where = array('id' => $userClass->id);

        $result = $userClass->editUser($update, $where);
        if (!$result){
            die('error');
        }
    }

    private function editStranka(){
      //  var_dump($_POST); die();
        $strankaClass = new stranka();
        $strankaClass->setUpStranka($this->data['id']);

        if (isset($_FILES['image']['name'])  AND $_FILES['image']['name'] != ""){
            $upload = new upload($_FILES['image'], "cs_CS");
            // Overeni zda je obrazek uspesne nahran do tmp slozky
            if ($upload->uploaded) {
                // Manipulace s obrazkem
                $upload->image_resize = true;
                //  $upload->image_ratio = true;
                $upload->image_x = 3000;
                $upload->image_y = 1500;
                //  $upload->image_ratio_crop = true;
                // Presuneme fotku ze slozky temp
                $upload->Process("../img/");
                // Jestli se zadarilo
                if ($upload->processed) {
                    $image  = $_FILES['image']['name'];
                } else {
                    die($upload->error);
                }
            }
        } else {
            $image = $strankaClass->image;
        }

        $update = array(
            'content'   => (string)$this->data['content'],
            'image'     => (string)$image,
            'active'    => $this->data['active']
        );
        $where = array(
            'id' => (int)$this->data['id']
        );

        $result = $strankaClass->editStranka($update,$where);
        if (!$result){
            die('error');
        }
    }

    private function editAlert(){
        // var_dump($this->data);die();
        $this->disableOrders();

        $active = $this->data['active'];
        $content = $this->data['content'];
        $id = $this->data['id'];
        $strankaClass = new stranka();
        $update = array(
            'content' => $content,
            'active'  => $active
        );
        $where = array(
            'id' => $id
        );
        $result = $strankaClass->editStranka($update,$where);
        if (!$result) die("Error");
    }

    private function disableOrders(){
        if(isset($this->data['disable_orders']) AND $this->data['disable_orders'] == 1){
            core::editProjectInfo('disable_orders', 1);
        } else {
            core::editProjectInfo('disable_orders', 0);
        }
    }

    private function prilohy(){
        // echo "ok"; die();
        unset($this->data['prilohy']);
        $kategorie_id = $this->data['kategorie_id'];
        unset($this->data['kategorie_id']);
        $prilohaClass = new priloha();
        $result = $prilohaClass->deleteFromKat($kategorie_id);

        foreach ($this->data as $id => $active){
            $prilohaClass->insertPriloha($id, $kategorie_id);
        }
    }
}