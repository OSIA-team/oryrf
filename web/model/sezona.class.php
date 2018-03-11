<?php
/**
 * objekt pro manipulaci s tabulkou "sezona" v databazi (Bel3s)
 * @access public
 * @author Kryštof Košut
 */
namespace database;
use database\database;

class sezona {
	private $_mysqli;


	 public function __construct()
 	 {
 	 	$this->_mysqli = new database();
 	 }


    /**
     * @param null $limit
     * @return mixed
     */
    public function getAllSezona($limit = NULL)
   {
     $query = "SELECT * FROM sezona";
     if ($limit != NULL) {
       $query .= " LIMIT ".$limit;
     }

     $result = $this->_mysqli->get_results($query);
    return $result;
   }

    /**
     * @param $id int
     * @return array on true
     */
    public function getSezonaById($id)
   {
       $query = "SELECT * FROM sezona WHERE id=$id";

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
 }

?>
