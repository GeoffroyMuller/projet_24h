<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 09:57
 */

namespace justjob\controleur;

use Slim\Slim;

class controleurConnexion
{

    /**
     *  Fonction permettant d'ajouter un nouvel utilisateur à la base
     * @param $uName
     * @param $uPass
     */
    public function inscrire($uName, $uPass,$uAdresse,$email,$handicap){
        $hash = password_hash($uPass, PASSWORD_DEFAULT);
                $utilisateur = new \justjob\model\Utilisateur();
                $utilisateur->pass = $hash;
                $utilisateur->nom = $uName;
                $utilisateur->adresse = $uAdresse;
                $utilisateur->email = $email;
                $utilisateur->handicap = $handicap;
                $utilisateur->save();

    }


    /**
     * Méthode permettant de charger le profil de l'utilisateur dans une variable session
     * @param $uName
     */
    private function chargerProfil($uId){
        $utilisateur = \justjob\model\Utilisateur::where('id','=',$uId)->first();
        session_destroy();
        session_start();
        $_SESSION['profile']['username'] = $utilisateur->nom;
        $_SESSION['profile']['userId'] = $utilisateur->id;
        $_SESSION['profile']['email'] = $utilisateur->email;
        $_SESSION['profile']['client_ip'] = $_SERVER['REMOTE_ADDR'];
    }


    /**
     * Méthode permettant de se déconnecter
     */
    public function deconnexion(){
        session_destroy();
        session_start();
    }

    /**
     * Méthode permettant de se connecter
     * @param $uName
     * @param $uPass
     */
    public function seConnecter($uName, $uPass){
        //Check credential

            $utilisateur = \justjob\model\Utilisateur::where('nom','=',$uName)->first();
            if(is_null($utilisateur)){
                throw new \mywishlist\Exception\AuthException("Le login saisi est incorrect");
            }

            if(password_verify($uPass,$utilisateur->pass)){
                $this->chargerProfil($utilisateur->id);
            }else{
                $slim = Slim::getInstance();
                $slim->redirect($slim->urlFor('connexion'));
            }


    }









}