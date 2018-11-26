<?php 
/*
* Dragonizado 2018
*/

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);


if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

require APP . 'config/config.php';
require APP . 'config/dbcore.php';

require APP . 'core/app.php';
require APP . 'core/controller.php';


$app = new app();
 ?>