<?php
/**
 * objekt pro manipulaci s tabulkou "doprace" v databazi (Optimas)
 * @access public
 * @author Kryštof Košut
 */

namespace database;
use database\database;

class user {
	private $_mysqli;

	public $id;
	public $email;
	public $jmeno;
	public $prijmeni;
	public $mobil;
	public $adresa;


	 public function __construct()
 	 {
 	 	$this->_mysqli = new namespace\database();
 	 	if (isset($_SESSION['user_id'])){
 	 	    $this->setUpUser($_SESSION['user_id']);
        }
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

    /**
     * @param $email
     * @param $password not hashed
     * @return id or false
     */
    public function checkIfExists($email, $password){
        $password = crypt($password,'$2a$07$thisisspartabel3syoknow$');
        $query = "SELECT id FROM user WHERE email = '{$email}' AND password = '{$password}' AND registered = 1";
        if($rec = $this->_mysqli->get_row($query)){
            return $rec['id'];
        } else {
            return false;
        }
    }

    public function createLoginSession($id){
        $_SESSION['user_id'] = $id;
    }

    private function setUpUser($id){
        $query = "SELECT * FROM user WHERE id =$id";
        $rec = $this->_mysqli->get_row($query);
        if ($rec){
            $this->id       = $id;
            $this->email    = $rec['email'];
            $this->jmeno    = $rec['jmeno'];
            $this->prijmeni = $rec['prijmeni'];
            $this->mobil    = $rec['mobil'];
            $this->adresa   = $rec['adresa'];
        } else {
            return false;
            die('User auth Error');
        }

        return true;
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

    /**
     * @return mixed
     */
    public function getAdresa()
    {
        return $this->adresa;
    }

    /**
     * @return mixed
     */
    public function getJmeno()
    {
        return $this->jmeno;
    }

    /**
     * @return mixed
     */
    public function getPrijmeni()
    {
        return $this->prijmeni;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getMobil()
    {
        return $this->mobil;
    }


}
