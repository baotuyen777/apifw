<?php
echo 111;
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
define('SERVER_ROOT', __DIR__ . DS);

require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';

//config
require 'config/paths.php';
require 'config/database.php';
//library
//lang
error_reporting(E_ALL & ~E_DEPRECATED);
//require 'libs/Database.php';
require 'libs/function.php';
require 'libs/Session.php';
 
Session::init();
$lang_get= Session::get('lang');
        if ($lang_get=='en') {
            require 'libs/lang/en.lang.php';
        }else{
            require 'libs/lang/vi.lang.php';
        }

$app = new Bootstrap();
?>
