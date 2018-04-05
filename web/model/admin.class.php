<?php
/**
 * objekt pro manipulaci s tabulkou "doprace" v databazi (Optimas)
 * @access public
 * @author Kryštof Košut
 */
class admin {
	private $_mysqli;


	 public function __construct($mysqli)
 	 {
 	 	$this->_mysqli = $mysqli;
 	 }
}
