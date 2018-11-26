<?php 
/*
* Dragonizado 2018
*/
define("APPNAME",$config['appname']);
define('_DEFAULTFOLDER_TEMPLATE_',$config['template']);
define("CONTROLLERS_FOLDER",$config['controllers_folder'].DIRECTORY_SEPARATOR);


// se define un entorno (desarrollo o producción)
define('ENVIRONMENT', $config['enviroment']);
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
define("DB_TYPE",$config['dbtype']);
define("DB_HOST",$config['dbhost']);
define("DB_NAME",$config['dbname']);
define("DB_USER",$config['dbuser']);
define("DB_PASS",$config['dbpass']);
define('DB_CHARSET', 'utf8');

 ?>