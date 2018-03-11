<?php
/**
 * objekt pro manipulaci s tabulkou "doprace" v databazi (Optimas)
 * @access public
 * @author Kryštof Košut
 */

namespace database;
use database\database;

class objednavka {
	private $_mysqli;

	 public function __construct()
 	 {
 	 	$this->_mysqli = new database();
 	 }

   /**
  * Vložení objednavka do databaze
  * @param array (row => value)
  * @return TRUE nebo FALSE podle vysledku z DB
  */
 public function addObjednavka($insert_objednavka)
 {
   $add_objednavka = $this->_mysqli->insert("objednavka", $insert_objednavka);
   if ($add_objednavka) {
     return TRUE;
   }
   else {
     return FALSE;
   }
 }

 /**
  * Navráceni jednoho objednavka podle ID z databaze
  * @param int id
  * @return array or false
  */
 public function getObjednavkaById($id)
 {
   $query = "SELECT * FROM objednavka WHERE id={$id}";
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
  * Získá všechy objednavka uložené v databázi
  * @param limit (nepovinny)
  * @return array vsech objednavka
  */
 public function getAllObjednavka($limit = NULL)
 {
   $query = "SELECT * FROM objednavka";
   if ($limit != NULL) {
     $query .= " LIMIT ".$limit;
   }
   $result = $this->_mysqli->get_results($query);
  return $result;
 }

 /**
  * aktualizuje objednavka v databazi
  * @param array CO (row => value)
  * @param array KDE (row => value)
  * @return true nebo false
  */
 public function editObjednavka($update,$where)
 {
   $result 	= $this->_mysqli->update( 'objednavka', $update, $where, 1 );
   if ($result) {
     return true;
   } else {
     return false;
   }
 }


 /**
  * vymazání objednavka podle id
  * @param int id
  * @return true nebo false
  */
 public function deleteObjednavka($id)
 {
   $delete = array("id" => $id );

   $deleted = $this->_mysqli->delete("objednavka", $delete);
   if ($deleted) {
     return TRUE;
   } else {
     return FALSE;
   }
 }

 public function getAllInObjednavka($id){
     $query = "SELECT menuItem.nazev, 
	(kosik_has_menuItem.pocet * menuItem.cena) as cenaZaPocet,
    menuItem.cena,
    kosik_has_menuItem.pocet,
    objednavka.adresadoruceni,
    objednavka.cenacelkem,
    objednavka.poznamka,
    user.username,
    user.jmeno
    FROM `objednavka` 
    
    JOIN kosik ON objednavka.kosik_id = kosik.id
    JOIN kosik_has_menuItem ON kosik_has_menuItem.kosik_id=kosik.id
    JOIN menuItem ON menuItem.id = kosik_has_menuItem.menuItem_id
    JOIN user ON user.id=objednavka.user_id
    
    WHERE objednavka.id = $id";
     if( $this->_mysqli->num_rows( $query ) > 0 )
     {
         $result = $this->_mysqli->get_results( $query );
         return $result;
     }
     else
     {
         return FALSE;
     }


 }



 }
