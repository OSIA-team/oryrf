<?php
/**
 * objekt pro manipulaci s tabulkou "piti" v databazi (Bel3s)
 * @access public
 * @author Kryštof Košut
 */
class piti {
	private $_mysqli;


	 public function __construct($mysqli)
 	 {
 	 	$this->_mysqli = $mysqli;
 	 }

   /**
  * Vložení piti do databaze
  * @param array (row => value)
  * @return TRUE nebo FALSE podle vysledku z DB
  */
 public function addPiti($insert_piti)
 {
   $add_piti = $this->_mysqli->insert("piti", $insert_piti);
   if ($add_piti) {
     return TRUE;
   }
   else {
     return FALSE;
   }
 }

 /**
  * Navráceni jednoho piti podle ID z databaze
  * @param int id
  * @return array or false
  */
 public function getPitiById($id)
 {
   $query = "SELECT * FROM piti WHERE id={$id}";
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

 /**
  * Získá všechy piti uložené v databázi
  * @param limit (nepovinny)
  * @param alko (nepovinny)
  * @return array vsech piti
  */
 public function getAllPiti($limit = NULL, $alko = NULL)
 {
   $query = "SELECT * FROM piti";
   if ($limit != NULL) {
     $query .= " LIMIT ".$limit;
   }
   if ($alko != NULL) {
     $query .= " WHERE alko=".$alko;
   }
   $result = $this->_mysqli->get_results($query);
  return $result;
 }

 /**
  * aktualizuje piti v databazi
  * @param array CO (row => value)
  * @param array KDE (row => value)
  * @return true nebo false
  */
 public function editPiti($update,$where)
 {
   $result 	= $this->_mysqli->update( 'piti', $update, $where, 1 );
   if ($result) {
     return true;
   } else {
     return false;
   }
 }


 /**
  * vymazání piti podle id
  * @param int id
  * @return true nebo false
  */
 public function deletePiti($id)
 {
   $delete = array("id" => $id );

   $deleted = $this->_mysqli->delete("piti", $delete);
   if ($deleted) {
     return TRUE;
   } else {
     return FALSE;
   }
 }
 }
