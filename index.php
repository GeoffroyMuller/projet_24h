<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 09:49
 */

require_once 'vendor/autoload.php';

define ('SITE_ROOT', realpath(dirname(__FILE__)));
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('./src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

session_start();

$app = new \Slim\Slim ;



$app->get('/',function(){
    $app =\Slim\Slim::getInstance();
    $app->redirect($app->urlFor('listes'));
});


$app->run();