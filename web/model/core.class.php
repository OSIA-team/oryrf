<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 11.03.2018
 * Time: 13:55
 */
namespace core;
use database\database;
class core{
    static $rootdir;
    static $mode;
    static $admin;
    static $configFile;

    static function debugLog($message, $backtrace = NULL){
        $backtrace = ($backtrace == NULL )?"":debug_backtrace();
        $log     =  "Site: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL;
        $log    .=  ($backtrace != NULL)? "Called from:".PHP_EOL.print_r($backtrace, true).PHP_EOL:"";
        $log    .=  (is_array($message))?print_r($message, true).PHP_EOL:$message.PHP_EOL;
        $log    .=  "-------------------------".PHP_EOL;
        file_put_contents('tmp/log_Debug.txt', $log, FILE_APPEND);
    }

    static function setMode(){

    }

    static function getMode(){

    }

    /**
     * @return array
     * get database info from connfig file
     */
    static function getDatabase(){
        $mode = self::$configFile['mode']();
        return self::$configFile['database'][$mode];
    }

    static function errorMsg($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    static function getProjectInfo($implementation_name, $return = 0){
        $mysqli = new database();
        $query = "SELECT value FROM project_info WHERE implementation_name='{$implementation_name}'";
        $result = $mysqli->get_row($query);
        $return = ($result)?$result['value']:$return;
        return $return;
    }

    static function editProjectInfo($implementation_name, $value = 0){
        $mysqli = new database();
        $query = "UPDATE project_info SET value='{$value}' WHERE implementation_name='{$implementation_name}'";
        return $mysqli->query($query);
    }
}