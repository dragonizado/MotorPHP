<?php 
/*
* Dragonizado 2018
*/

// se define un entorno (desarrollo o producción)
define('ENVIRONMENT', $environment);
if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// se crea una constante para crear una url global que dependa del hosting y que sea dinamica
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);


//Se declara la configuracion para la base de datos
define('DB_TYPE', 'mysql');
define('DB_HOST', $dbhost);
define('DB_NAME', $dbname);
define('DB_USER', $dbuser);
define('DB_PASS', $dbpass);
define('DB_CHARSET', 'utf8');

 ?>