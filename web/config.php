<?php
/**
 * Created by PhpStorm.
 * User: kkosu
 * Date: 17.03.2018
 * Time: 12:00
 */

return [
    'mode' => function(){
        if ($_SERVER['SERVER_NAME'] == 'local.osia' OR $_SERVER['SERVER_NAME'] == 'localhost'){
            return 'dev';
        }
        elseif ($_SERVER['SERVER_NAME'] == 'test.bel3s.cz'){
            return 'test';
        }
        else {
            return 'production';
        }
    },
    'database' => [
        'dev' => [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'Bel3s'
        ],

        'test' => [
            'host' => 'c093um.forpsi.com',
            'user' => 'f104889',
            'password' => '3Tp2Enu',
            'database' => 'f104889'
        ],

        'production' => [
            'host' => 'c093um.forpsi.com',
            'user' => 'f104889',
            'password' => '3Tp2Enu',
            'database' => 'f104889'
        ]
    ]
];