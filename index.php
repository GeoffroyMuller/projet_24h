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
$db->addConnection(parse_ini_file('./php/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

session_start();

$app = new \Slim\Slim ;







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
    if(isset($_POST['inputUserName']) && isset($_POST['inputPassword']) && isset($_POST['inputadresspostal']) &&
    isset($_POST['inputEmail'])){

        $value = $_POST['radio'];
        if($value === "oui"){
            if(isset($_POST['inputHandicap'])){
                $handicap = filter_var($_POST['inputHandicap'],FILTER_SANITIZE_STRING);
            }else{
                $handicap = "Aucun";
            }
        }else{
            $handicap = "Aucun";
        }

        $username = filter_var($_POST['inputUserName'],FILTER_SANITIZE_STRING);
        $adresse = filter_var($_POST['inputadresspostal'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['inputEmail'],FILTER_SANITIZE_EMAIL);
        $controleur = new \justjob\controleur\controleurConnexion();
        $controleur->inscrire($username, $_POST['inputPassword'],$adresse,$email,$handicap);
    }else{
        $app = \Slim\Slim::getInstance();
        $app->redirect($app->urlFor('inscription'));
    }
    $app = \Slim\Slim::getInstance();
    $app->redirect($app->urlFor('connexion'));
})->name('inscriptionprocess');

$app->post('/connexionprocess/',function(){
        if(isset($_POST['inputUserName']) && isset($_POST['inputPassword'])){
            $username = filter_var($_POST['inputUserName'],FILTER_SANITIZE_STRING);

            $controleur = new \justjob\controleur\controleurConnexion();
            $controleur->seConnecter($username, $_POST['inputPassword']);
        }else{
            $app = \Slim\Slim::getInstance();
            $app->redirect($app->urlFor('connexion'));
        }
        $app = \Slim\Slim::getInstance();
        $app->redirect($app->urlFor('connexion'));
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

$app->get('/connexion/',function(){
    $controleur= new \justjob\controleur\controleurAffichage();
    $controleur->afficherConnexion();
})->name('connexion');

$app->get('/inscription/',function(){
    $controleur= new \justjob\controleur\controleurAffichage();
    $controleur->afficherInscription();
})->name('inscription');

$app->get('/offresEmplois/',function (){
    $controleur = new justjob\controleur\controleurAffichage();
    $controleur->afficherListesDesOffresEmplois();
})->name('offreEmplois');

$app->get('/deconnexion/',function(){
    $controleur = new \justjob\controleur\controleurConnexion();
    $controleur->deconnexion();
    $app = \Slim\Slim::getInstance();
    $app->redirect($app->urlFor('connexion'));

})->name('deconnexion');


$app->run();