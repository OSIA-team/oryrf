<?php

namespace PhpConsole;



spl_autoload_register(function ($class) {
	if(strpos($class, __NAMESPACE__) === 0) {
		/** @noinspection PhpIncludeInspection */
        $admin = strstr($_SERVER['PHP_SELF'], "admin" );
        $prefix = ($admin)?"../":"";
		require_once($prefix.'model/public/'.str_replace('\\', '/', $class) . '.php');
	}
});
