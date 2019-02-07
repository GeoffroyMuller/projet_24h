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



$app->post('/ajouterOffreEmploi/',function(){
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

$app->post('/postuler/',function(){
    $controleur = new \justjob\controleur\controleurUtilisateur();
    //Controle des champs et de la connection
    if(isset($_SESSION['profile']) &&
        isset($_POST['transport']) &&
        isset($_POST['idOffre'])){

        $transport = filter_var($_POST['transport'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['idOffre'], FILTER_SANITIZE_NUMBER_INT);
        $controleur->postulerAUneOffre($transport,$id);

        $slim = \Slim\Slim::getInstance();
        $slim->redirect($slim->urlFor('home'));
    }else{
        $slim = \Slim\Slim::getInstance();
        $slim->redirect($slim->urlFor('home'));
    }
})->name('postuler');

$app->post('/inscriptionprocess/',function(){
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['adresse'])){
        $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $adresse = filter_var($_POST['adresse'], FILTER_SANITIZE_STRING);
        $controleur = new \justjob\controleur\controleurConnexion();
        $controleur->inscrire($username, $_POST['password'],$adresse);
    }else{
        $app = \Slim\Slim::getInstance();
        $app->redirect($app->urlFor('erreur',['msg'=>'Veuillez entrer un nom d\'utilisateur et un mot de passe']));
    }
    $app = \Slim\Slim::getInstance();
    $app->redirect($app->urlFor('connexion'));
})->name('inscriptionprocess');

$app->post('/connexionprocess/',function(){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);

            $controleur = new \justjob\controleur\controleurConnexion();
            $controleur->seConnecter($username, $_POST['password']);
        }else{
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor('erreur',['msg'=>'Veuillez entrer un nom d\'utilisateur et un mot de passe']));
        }
        $app = \Slim\Slim::getInstance();
        $app->redirect($app->urlFor('home'));
})->name('connexionprocess');

$app->post('/rechercheAvecCritere/',function(){
    //Gerer tout les composant de critere

    //Faire une redirection avec en parametre les criteres
})->name('rechercherAvecCritere');

$app->post('/envoyerEmail/', function(){

    if(isset($_POST['message']) &&
        isset($_POST['sujet']) && isset($_POST['emailCandidat']) && isset($_POST['emailEmployeur'])){
        $message = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
        $sujet = filter_var($_POST['sujet'],FILTER_SANITIZE_STRING);
        $emailCandidat =filter_var($_POST['emailCandidat'], FILTER_SANITIZE_EMAIL);
        $emailEmployeur = filter_var($_POST['emailEmployeur'],FILTER_SANITIZE_EMAIL);

        $header= 'De :'.$emailEmployeur.'r\n'.'A :'.$emailCandidat;
        mail($emailCandidat, $sujet, $message, $header);

        //Redirection sur la page du profil
    }
})->name('envoyerEmail');




$app->run();