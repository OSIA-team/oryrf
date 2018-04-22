<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 19.04.18
 * Time: 16:49
 */

namespace database;
use database\database;


class stranka {
    private $_mysqli;
    public $image;


    public function __construct()
    {
        $this->_mysqli = new database();
    }

    public function getAllStranka(){
        $query = "SELECT * FROM stranka";
        $result = $this->_mysqli->get_results($query);
        return $result;
    }

    public function getFullStrankaById($id){
        $query = "SELECT * FROM stranka WHERE id={$id}";
        if( $this->_mysqli->num_rows( $query ) > 0 )
        {
            $result = $this->_mysqli->get_row( $query );
            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    public function editStranka($update,$where){
        $result = $this->_mysqli->update('stranka', $update, $where, 1);

        //var_dump($result); die();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteStranka(){}

    public function setUpStranka($id){
        $data = $this->getFullStrankaById($id);
        $this->background = $data['image'];
    }


}