<?php
/**
 * objekt pro manipulaci s tabulkou "jidlo" v databazi (Bel3s)
 * @access public
 * @author Kryštof Košut
 */

namespace database;
use core\core;
use database\database;

// TODO: SETUP JIDLO ()
class jidlo {
	private $_mysqli;


	 public function __construct()
 	 {
 	 	$this->_mysqli = new database();
 	 }

   /**
  * Vložení jidlo do databaze
  * @param array (row => value)
  * @return TRUE nebo FALSE podle vysledku z DB
  */
 public function addJidlo($insert_jidlo)
 {
   $add_jidlo = $this->_mysqli->insert("menuItem", $insert_jidlo);
   if ($add_jidlo) {
		 $jidlo_id = $this->_mysqli->lastid();
		 return $jidlo_id;
   }
   else {
     return FALSE;
   }
 }

 /**
  * Navráceni jednoho jidlo podle ID z databaze
  * @param int id
  * @return array or false
  */
 public function getJidloById($id)
 {
   $query = "SELECT * FROM menuItem WHERE id={$id}";
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
  * Získá všechy jidlo uložené v databázi
  * @param limit (nepovinny)
  * @param alko (nepovinny)
  * @return array vsech jidlo
  */
 public function getAllJidlo($limit = NULL)
 {
   $query = "SELECT * FROM menuItem";
   if ($limit != NULL) {
     $query .= " LIMIT ".$limit;
   }

   $result = $this->_mysqli->get_results($query);
  return $result;
 }

 /**
  * Získá všechy jidla uložené v databázi podle kategorie
  * @param kategorie (povinny)
  * @param limit (nepovinny)
  * @return array vsech jidlo
  */
 public function getAllJidloByKategorie($kategorie, $limit = NULL)
 {
   $query = "SELECT * FROM menuItem WHERE kategorie = '{$kategorie}'";
   if ($limit != NULL) {
     $query .= " LIMIT ".$limit;
   }

   $result = $this->_mysqli->get_results($query);
  return $result;
 }

    /**
     * TODO: DODELAT
     * @param $kategorie
     * @param null $limit
     * @return mixed
     */
    public function getAllJidloByKategorieId($kategorie, $limit = NULL)
{
    $query = "SELECT menuItem.nazev, popis, cena, gramaz, prilohy FROM menuItem
            JOIN menuItem_has_kategorie ON menuItem.id = menuItem_has_kategorie.menuItem_id
            WHERE kategorie_id = 5";


    $result = $this->_mysqli->get_results($query);
    return $result;
}

 /**
  * Získá všechy sezoni jidla uložené v databázi
  * @param limit (nepovinny)
  * @param alko (nepovinny)
  * @return array vsech jidlo
  */
 public function getAllJidloSezona($limit = NULL)
 {
   $query = "SELECT * FROM jidlo WHERE sezona = 1";
   if ($limit != NULL) {
     $query .= " LIMIT ".$limit;
   }

   $result = $this->_mysqli->get_results($query);
  return $result;
 }

 /**
  * aktualizuje jidlo v databazi
  * @param array CO (row => value)
  * @param array KDE (row => value)
  * @return true nebo false
  */
 public function editJidlo($update,$where)
 {
   $result 	= $this->_mysqli->update( 'menuItem', $update, $where, 1 );
   if ($result) {
     return true;
   } else {
     return false;
   }
 }

    /**
     * @param $update array
     * @param $where array
     * @return bool
     */
    public function editFotka($update, $where){

     if($this->_mysqli->get_row("SELECT id FROM fotka WHERE jidlo_id =".$where['jidlo_id'])){
     $result 	= $this->_mysqli->update( 'fotka', $update, $where, 1 );
     if ($result) {
         return true;
     } else {
         return false;
     }
     } else {
         \core\core::errorMsg("Can't update photo: Photo you want to update doesnt exists!");
         return false;
     }
 }


 /**
  * vymazání jidlo podle id
  * @param int id
  * @return true nebo false
  */
 public function deleteJidlo($id)
 {
   $delete = array("id" => $id );

   $deleted = $this->_mysqli->delete("menuItem", $delete);
   if ($deleted) {
     return TRUE;
   } else {
     return FALSE;
   }
 }

    /**
     * @param $jidlo_id
     * @param string $name
     * @return bool
     */
    public function addImageToJidlo($jidlo_id, $name = "default.png")
	 {

	 		$insert_jidlo = array(
	 		        'jidlo_id' => $jidlo_id,
                    'nazev'    => $name
                );
			$add_foto = $this->_mysqli->insert("fotka", $insert_jidlo);
			if ($add_foto){
                return true;
            } else {
			    core::errorMsg("Can't proceed insert, please check log_file!");
                return false;
            }

	 }

    /**
     * @param $jidlo_id
     * @return mixed
     */
    public function getFotkaByJidloId($jidlo_id)
     {
         $query = "SELECT * FROM fotka WHERE jidlo_id = $jidlo_id";

		 $result = $this->_mysqli->get_row($query);
		 return $result;
	 }

    /**
     * @param null $limit
     * @return array or false
     */
    public function getRandomJidlo($limit = 3){
            $query = "SELECT * FROM menuItem WHERE priloha != 1 ORDER BY RAND() LIMIT $limit";
            $result = $this->_mysqli->get_results($query);
         return $result;
     }

     public function getAllPriloha($url){
            $query = "SELECT menuItem.id, menuItem.nazev, cena, kategorie FROM menuItem  
                      JOIN priloha p ON menuItem.id = p.menuItem_id
                      JOIN kategorie k ON menuItem.kategorie = k.url
                      WHERE priloha = 1 AND p.active = 1 AND k.url = '$url'
                      ORDER BY kategorie";
            $result = $this->_mysqli->get_results($query);
        return $result;
     }
 }
