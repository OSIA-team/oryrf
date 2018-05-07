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
    public function getPrilohaByKategorie($kategorie){
        if (is_string($kategorie)) $url = $kategorie;
        if (is_int($kategorie)) $id = $kategorie;

        $query ='SELECT * FROM priloha WHERE ';
        if (isset($url)) $query .= 'url = "'.$url.'"';
        if (isset($id)) $query .= 'id ='.$id;

        $query .= " JOIN ";

        $result = $this->_mysqli->get_results($query);

        return $result;
    }

    public function getAllPriloha(){
        $query = "SELECT * FROM menuitem WHERE priloha = 1";
        $result = $this->_mysqli->get_results($query);
        return $result;
    }

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


}