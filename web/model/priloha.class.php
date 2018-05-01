<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 23.04.18
 * Time: 16:32
 */

namespace database;
use core\core;
use database\database;

class priloha
{
    private $_mysqli;

    public function __construct(){
        $this->_mysqli = new database();
    }

    public function getPrilohaByKategorie($kategorie){
        if (is_string($kategorie)) $url = $kategorie;
        if (is_int($kategorie)) $id = $kategorie;

        $query ='SELECT * FROM priloha WHERE ';
        if (isset($url)) $query .= 'url = "'.$url.'"';
        if (isset($id)) $query .= 'id ='.$id;

        $result = $this->_mysqli->get_results($query);

        return $result;
    }

    public function getAllPriloha(){

    }

    public function addPriloha($kategorieId, $menuItemId){

    }


}