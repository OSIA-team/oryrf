<?php
/**
 * objekt pro manipulaci s tabulkou "doprace" v databazi (Optimas)
 * @access public
 * @author Kryštof Košut
 */
class user {
	private $_mysqli;


	 public function __construct($mysqli)
 	 {
 	 	$this->_mysqli = $mysqli;
 	 }

    /**
     * new user to db
     * @param array (row => value)
     * @return insered ID nebo FALSE podle vysledku z DB
     */
    public function addUser($insert)
    {
        $add = $this->_mysqli->insert("user", $insert);
        if ($add) {
            $id = $this->_mysqli->lastid();
            return $id;
        }
        else {
            return FALSE;
        }
    }

    public function checkIfExists(){


    }

    public function newUserId(){

    }

    public function editUser($update,$where)
    {
        $result 	= $this->_mysqli->update( 'user', $update, $where, 1 );
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


}
