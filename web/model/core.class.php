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

}