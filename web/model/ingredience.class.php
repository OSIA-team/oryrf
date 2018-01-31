<?php
/**
 * objekt pro manipulaci s tabulkou "ingredience" v databazi (Bel3s)
 * @access public
 * @author Kryštof Košut
 */
class ingredience {
	private $_mysqli;


	 public function __construct($mysqli)
 	 {
 	 	$this->_mysqli = $mysqli;
 	 }

   /**
  * Vložení ingredience do databaze
  * @param array (row => value)
  * @return TRUE nebo FALSE podle vysledku z DB
  */
 public function addIngredience($insert_ingredience)
 {
   $add_ingredience = $this->_mysqli->insert("ingredience", $insert_ingredience);
   if ($add_ingredience) {
     return TRUE;
   }
   else {
     return FALSE;
   }
 }

 /**
  * Navráceni jednoho ingredience podle ID z databaze
  * @param int id
  * @return array or false
  */
 public function getIngredienceById($id)
 {
   $query = "SELECT * FROM ingredience WHERE id={$id}";
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
  * Získá všechy ingredience uložené v databázi
  * @param limit (nepovinny)
  * @return array vsech ingredience
  */
 public function getAllIngredience($limit = NULL)
 {
   $query = "SELECT * FROM ingredience";
   if ($limit != NULL) {
     $query .= " LIMIT ".$limit;
   }
   $result = $this->_mysqli->get_results($query);
  return $result;
 }

 /**
  * aktualizuje ingredience v databazi
  * @param array CO (row => value)
  * @param array KDE (row => value)
  * @return true nebo false
  */
 public function editIngredience($update,$where)
 {
   $result 	= $this->_mysqli->update( 'ingredience', $update, $where, 1 );
   if ($result) {
     return true;
   } else {
     return false;
   }
 }


 /**
  * vymazání ingredience podle id
  * @param int id
  * @return true nebo false
  */
 public function deleteIngredience($id)
 {
   $delete = array("id" => $id );

   $deleted = $this->_mysqli->delete("ingredience", $delete);
   if ($deleted) {
     return TRUE;
   } else {
     return FALSE;
   }
 }
 }
