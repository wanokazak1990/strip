<?php 
namespace app;
session_start();
if(!isset($_SESSION['cartCount']))
	$_SESSION['cartCount']=array();

//СУММА ЗАКАЗА
if(!isset($_SESSION['cartSum']))
	$_SESSION['cartSum'] = 0;

require 'app/autoloader.php';
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('TEMPLATE',ROOT.'/app/views');
define ('DEFAULT_CLASS','Content');
define ('DEFAULT_METHOD','Index');
/*

*/
$autoloader = 'autoloader\\' . "autoloader";
$autoloader = new $autoloader;
$app = new \app\core\Router();
$app->run();



