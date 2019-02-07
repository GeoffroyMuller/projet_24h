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
})->name('home');



$app->post('/ajouterOffreEmploi',function(){
    $controleur = new \justjob\controleur\controleurUtilisateur();
    //Controle des champs et de la connection
    if(isset($_SESSION['profile']) &&
    isset($_POST['nom']) &&
    isset($_POST['descr']) &&
    isset($_POST['lieu'])){

        $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
        $descr = filter_var($_POST['descr'], FILTER_SANITIZE_STRING);
        $lieu =filter_var($_POST['lieu'],FILTER_SANITIZE_STRING);
        $controleur->creerUneOffreEmploi($nom,$descr,$lieu);

        $slim = \Slim\Slim::getInstance();
        $slim->redirect($slim->urlFor('home'));
    }else{
        $slim = \Slim\Slim::getInstance();
        $slim->redirect($slim->urlFor('home'));
    }


})->name('ajouterOffreEmploi');


$app->run();