<?php
/**
 * @access public
 * @author Kryštof Košut
 */

namespace database;
use mysqli;
use core\core;
class database {
	private $_host				= 'localhost';
	private $_user				= 'root';
	private $_password			= '';
	private $_database			= 'Bel3s';
	private $_mysqli			= NULL;
	private $_inst 				= NULL;

	/**
	 * Allow the class to send admins a message alerting them to errors
	 * on production sites
	 */
	public function log_db_errors( $error, $query, $severity )
	{

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: Admin <'.SEND_ERRORS_TO.'>' . "\r\n";
			$headers .= 'From: Bel3s <system@your-site.com>' . "\r\n";

			$message = '<p>An error has occurred:</p>';

			$message .= '<p>Error at '. date('Y-m-d H:i:s').': ';
			$message .= 'Query: '.  $query .'<br />';
			$message .= $error;
			$message .= '</p>';
			$message .= '<p>Severity: '. $severity .'</p>';

			\core\core::debugLog($message);

			mail( SEND_ERRORS_TO, 'Database Error', $message, $headers);

			if( DISPLAY_DEBUG )
			{
					echo $message;
			}
	}


	public function __construct()
	{
	   global $connection;
	   $connectInfo = \core\core::getDatabase();
		@$this->_mysqli = new mysqli( $connectInfo['host'], $connectInfo['user'], $connectInfo['password'], $connectInfo['database'] );

        if( mysqli_connect_errno() )
        {
            $this->log_db_errors( "Connect failed: %s\n", mysqli_connect_error(), 'Fatal' );
            exit();
        }
		$this->_mysqli->set_charset("utf8");
	}

	public function __destruct()
	{
		$this->disconnect();
	}



/**
	 * Sanitize user data
	 *
	 * @access public
	 * @param string, array
	 * @return string, array
	 *
	 */
	public function filter( $data )
	{
			if( !is_array( $data ) )
			{
				$data = trim( htmlentities( $data ) );
				$data = mysqli_real_escape_string( $this->_mysqli, $data );
			}
			else
			{
					//Self call function to sanitize array data
					$data = array_map( array( 'DB', 'filter' ), $data );
			}
		return $data;
	}



	/**
	 * @access public
	 * @param string
	 * @return string
	 */
public function query($query)
{
	$query = $this->_mysqli->query( $query );
		if( mysqli_error( $this->_mysqli ) )
		{
			$this->log_db_errors( "query ".mysqli_error( $this->_mysqli ), $query, 'Fatal' );
		return false;
		}
		else
		{
		return true;
		}
	mysqli_free_result( $query );
}

/**
 * @param string
 * @return array
 * @access public
 * Perfom query to retrieve array of associated results
 *
 */

public function get_results($query)
{
		// die(var_dump($query));
	$row = array();
	$query = $this->_mysqli->query( $query );
	if( mysqli_error( $this->_mysqli ) )
	{
			$this->log_db_errors( "get_results ".mysqli_error( $this->_mysqli ), $query, 'Fatal' );
			return false;
	}
	else
	{
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
			{
					$row[] = $r;
			}
			mysqli_free_result( $query );

			return $row;
	}
}

/**
 * Return specific row based on db query
 *
 * @access public
 * @param string
 * @return array
 *
 */
public function get_row( $query )
{
		$query = $this->_mysqli->query( $query );
		if( mysqli_error( $this->_mysqli ) )
		{
				$this->log_db_errors( "get_row ".mysqli_error( $this->_mysqli ), $query, 'Fatal' );
				return false;
		}
		else
		{
				$r = mysqli_fetch_array( $query , MYSQLI_ASSOC );
				mysqli_free_result( $query );
				return $r;
		}
}


/**
	 * Delete data from table
	 *
	 * @access public
	 * @param string table name
	 * @param array where parameters table column => column value
	 * @param int max number of rows to remove.
	 * @return bool
	 *
	 */
	 public function delete( $table, $where = array(), $limit = '' )
 	{
 			$sql = "DELETE FROM ". $table;
 			foreach( $where as $field => $value )
 			{
 					$value = $value;
 					$clause[] = "$field = '$value'";
 			}
 			$sql .= " WHERE ". implode(' AND ', $clause);

 			if( !empty( $limit ) )
 			{
 					$sql .= " LIMIT ". $limit;
 			}

 			$query = mysqli_query( $this->_mysqli, $sql );

 			if( mysqli_error( $this->_mysqli ) )
 			{
 					// return false; //
 					$this->log_db_errors( "delete ".mysqli_error( $this->_mysqli ), $sql, 'Fatal' );
 					return false;
 			}
 			else
 			{
 					return true;
 			}
 	}

	/**
	 * Insert data into database table
	 *
	 * @access public
	 * @param string table name
	 * @param array table column => column value
	 * @return bool
	 *
	 */
	public function insert( $table, $variables = array() )
	{

			$sql = "INSERT INTO ". $table;
			$fields = array();
			$values = array();
        	foreach( $variables as $field => $value )
			{
					$fields[] = $field;
					$values[] = "'".$value."'";
			}
			$fields = ' (' . implode(', ', $fields) . ')';
			$values = '('. implode(', ', $values) .')';

			$sql .= $fields .' VALUES '. $values;

        //var_dump($sql); die();
			$query = mysqli_query( $this->_mysqli, $sql );

			if( mysqli_error( $this->_mysqli ) )
			{
					//return false;
					$this->log_db_errors( "insert ".mysqli_error( $this->_mysqli ), $sql, 'Fatal' );
					return false;
			}
			else
			{
					return true;
			}
	}


	/**
	 * Update data in database table
	 *
	 * @access public
	 * @param string table name
	 * @param array values to update table column => column value
	 * @param array where parameters table column => column value
	 * @param int limit
	 * @return bool
	 *
	 */
	public function update( $table, $variables = array(), $where = array(), $limit = '' )
	{

			$sql = "UPDATE ". $table ." SET ";
			foreach( $variables as $field => $value )
			{

					$updates[] = "`$field` = '$value'";
			}
			$sql .= implode(', ', $updates);

			foreach( $where as $field => $value )
			{
					$value = $value;

					$clause[] = "$field = '$value'";
			}
			$sql .= ' WHERE '. implode(' AND ', $clause);

			if( !empty( $limit ) )
			{
					$sql .= ' LIMIT '. $limit;
			}

			$query = mysqli_query( $this->_mysqli, $sql );

			if( mysqli_error( $this->_mysqli ) )
			{
					$this->log_db_errors( "update ".mysqli_error( $this->_mysqli ), $sql, 'Fatal' );
					return false;
			}
			else
			{
					// die($sql);
					return true;
			}
	}

	/**
	 * Get last auto-incrementing ID associated with an insertion
	 *
	 * @access public
	 * @param none
	 * @return int
	 *
	 */
	public function lastid()
	{
			return mysqli_insert_id( $this->_mysqli );
	}

	/**
	  * Output results of queries
	  *
	  * @access public
    * @param string variable
    * @param bool echo [true,false] defaults to true
    * @return string
    *
	 */
	 public function display( $variable, $echo = true )
	    {
	        $out = '';
	        if( !is_array( $variable ) )
	        {
	            $out .= $variable;
	        }
	        else
	        {
	            $out .= '<pre>';
	            $out .= print_r( $variable, TRUE );
	            $out .= '</pre>';
	        }
	        if( $echo === true )
	        {
	            echo $out;
	        }
	        else
	        {
	            return $out;
	        }
	    }

			/**
	     * Count number of rows found matching a specific query
	     *
	     * @access public
	     * @param string
	     * @return int
	     *
	     */
	    public function num_rows( $query )
	    {
	        $query = $this->_mysqli->query( $query );
	        if( mysqli_error( $this->_mysqli ) )
	        {
	           // $this->log_db_errors( "num_rows ".mysqli_error( $this->_mysqli ), $query, 'Fatal' );
	            return mysqli_error( $this->_mysqli );
	        }
	        else
	        {
	            return mysqli_num_rows( $query );
	        }
	        mysqli_free_result( $query );
	    }

			/**
			 * 1 = check; 0 = no-check
			 */
			public function fk($value)
			{
				$query = $this->_mysqli->query( "SET foreign_key_checks = ".$value );
				if( mysqli_error( $this->_mysqli ) )
				{
						$this->log_db_errors( "fk ".mysqli_error( $this->_mysqli ), $query, 'Fatal' );
						return FALSE;
				} else {
					return TRUE;
				}
			}
			/**
 * Disconnect from db server
 * Called automatically from __destruct function
 */
public function disconnect()
{
 @mysqli_close( $this->_mysqli );
}


}
?>
