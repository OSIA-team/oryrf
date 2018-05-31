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

    /**
     * @param $kategorie
     * @return array
     * NEPOUZIVA SE
     */
    public function getPrilohaByKategorieId($kategorie_id){
        $query = "SELECT menuitem.id, menuitem.nazev, cena, kategorie.nazev AS kategorie FROM priloha
                LEFT JOIN menuitem ON menuitem.id = priloha.jidlo_id
                LEFT JOIN kategorie ON menuitem.kategorie = kategorie.url
                WHERE kategorie_id =  $kategorie_id";

        return $this->_mysqli->get_results($query);

        /*
        if (is_string($kategorie)) $url = $kategorie;
        if (is_int($kategorie)) $id = $kategorie;

        $query ='SELECT * FROM priloha WHERE ';
        if (isset($url)) $query .= 'url = "'.$url.'"';
        if (isset($id)) $query .= 'id ='.$id;

        $query .= " JOIN ";

        $result = $this->_mysqli->get_results($query);

        return $result;
        // */
    }

    public function getAllPriloha(){
        $query = "SELECT * FROM menuitem WHERE priloha = 1";
        $result = $this->_mysqli->get_results($query);
        return $result;
    }

    /**
     * @param $kategorieId
     * @param $menuItemId
     * @param $id
     * @param int $active
     * @return bool
     * nepouziva se
     */
    public function addPriloha($kategorieId, $menuItemId, $id, $active = 1){
        $query = "SELECT id FROM priloha WHERE menuItem_id = $menuItemId AND kategorie_id = $kategorieId";
        $exists = $this->_mysqli->num_rows($query);
        // UPDATE
        if ($exists){
            $update = array(
                'active' => $active
            );
            $where = array(
                'menuItem_id' => $menuItemId,
                'kategorie_id' => $kategorieId
            );
            $result = $this->_mysqli->update("priloha", $update, $where);
        }
        // INSERT
        else {
            $insert = array(
                'menuItem_id' => $menuItemId,
                'kategorie_id' => $kategorieId,
                'active' => 1
            );
            $result = $this->_mysqli->insert("priloha", $insert);
        }
        return $result;
    }

    /**
     * @param $kategorieId
     * @return bool
     */
    public function deleteFromKat($kategorieId){
       return  $this->_mysqli->delete("priloha", ["kategorie_id" => $kategorieId]);
    }

    public function insertPriloha($jidlo_id, $kategorie_id){
        return $this->_mysqli->insert("priloha", ["jidlo_id" => $jidlo_id, "kategorie_id" => $kategorie_id, "active" => 1]);
    }

    public function isActive($id, $kategori_id){
        return $this->_mysqli->get_row("SELECT active FROM priloha WHERE jidlo_id = $id AND kategorie_id = $kategori_id");
    }

}