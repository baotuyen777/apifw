<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
define('SERVER_ROOT', __DIR__ . DS);
/**config */
require 'config.php';
/**library */
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/DB.php';

require 'libs/Helper.php';
//lang
error_reporting(E_ALL & ~E_DEPRECATED);
//require 'libs/function.php';
 
//$lang_get= Session::get('lang');
//        if ($lang_get=='en') {
//            require 'libs/lang/en.lang.php';
//        }else{
//            require 'libs/lang/vi.lang.php';
//        }

$app = new Bootstrap();
?>
