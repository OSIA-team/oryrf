<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 28.01.18
 * Time: 20:30
 */

class email
{
    private $_mysqli;

    public function __construct($mysqli)
    {
        $this->_mysqli = $mysqli;
    }


}