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

    /**
     * @param string $role (page, alert)
     * @return array
     */
    public function getAll($role = 'page', $where = NULL){
        $query = "SELECT * FROM stranka WHERE role = '{$role}'";
        if($where != NULL) $query .= " AND ".$where;
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

    /**
     * @param $url string
     * @return array|bool
     */
    public function strankaExists($url){
        $query = 'SELECT * FROM stranka WHERE url = "' . $url . '"';
        $result = $this->_mysqli->get_row($query);
        if ($result){
            return $result;
        } else {
            return FALSE;
        }
    }


}