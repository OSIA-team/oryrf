<?php
/**
 * objekt pro manipulaci s tabulkou "doprace" v databazi (Optimas)
 * @access public
 * @author Kryštof Košut
 */
class kategorie {
	private $_mysqli;


	 public function __construct($mysqli)
 	 {
 	 	$this->_mysqli = $mysqli;
 	 }

	 /**
		* Získá všechy kategorie uložené v databázi
		* @param limit (nepovinny)
		* @return array vsech kategorie
		*/
	 public function getAllKategorie($where = NULL, $limit = NULL)
   {
		 $query = "SELECT * FROM kategorie";
		 if ($limit != NULL) {
			 $query .= " LIMIT ".$limit;
		 } if ($where != NULL){
		     $query .= " WHERE ".$where;
		 }
		 $result = $this->_mysqli->get_results($query);
		return $result;
   }

    /**
     * @param $id integer
     * @return bool
     */
    public function deleteKategorie($id){
       $delete = array("id" => $id );

       $deleted = $this->_mysqli->delete("kategorie", $delete);
       if ($deleted) {
           return TRUE;
       } else {
           return FALSE;
       }
   }

    /**
     * @param $update array
     * @param $where array
     * @return bool
     */
    public function updateKategorie($update, $where)
   {
       $result 	= $this->_mysqli->update( 'kategorie', $update, $where, 1 );
       if ($result) {
           return true;
       } else {
           return false;
       }
   }

    /**
     * @param $insert array
     * @return bool
     */
    public function addKategorie($insert)
    {
        $add = $this->_mysqli->insert("kategorie", $insert);
        if ($add) {
            $lid = $this->_mysqli->lastid();
            return $lid;
        }
        else {
            return FALSE;
        }
    }

    /**
     * @param $url string
     * @return array or false
     */
    public function getKategorieByURL($url){
            $url = htmlspecialchars($url);
            $query = "SELECT * FROM kategorie WHERE url = '{$url}'";
            $result = $this->_mysqli->get_row( $query );
        return $result;
    }
 }
