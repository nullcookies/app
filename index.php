<?php
require 'config/rb.php';

session_start();

define('ROOT', dirname(__FILE__));
//define('BASE_PATH','http://aut.local/');

R::setup( 'mysql:host=127.0.0.1;dbname=app_ajax','root', '' );

if ( !R::testconnection() )
{
    exit ('Нет соединения с базой данных');
}
require_once(ROOT.'/components/autoload.php');

$router = new Router();
$router->run();