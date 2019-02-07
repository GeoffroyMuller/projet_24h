<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 12:38
 */

namespace justjob\controleur;


use justjob\model\Candidature;
use justjob\model\offreEmploi;
use justjob\vue\vue;

class controleurAffichage
{
    public function afficherListesDesOffresEmplois(){
        $offres = \justjob\model\offreEmploi::all();
        $vue = new vue($offres,'LISTE_OFFRE');
        $vue->render();
    }

    /**
     * Affiche la page de connexion
     */
    public function afficherConnexion(){
        $vue= new vue(null, 'CONNEXION');
        $vue->render();
    }

    public function afficherInscription(){
        $vue = new vue(null,'INSCRIPTION');
        $vue->render();
    }

    public function afficherOffre($id){
        $offre = offreEmploi::where('id','=',$id)->first();
        $vue = new vue($offre,'AFFICHER_OFFRE');
        $vue->render();
    }

    public function afficherCandidature(){
        $candidatures = Candidature::where('idcandidat','=',$_SESSION['profile']['userId'])->first();
        $vue=new vue($candidatures,'CANDIDATURE');
        $vue->render();
    }

    public function afficherHome(){
        $vue = new vue(null,'HOME');
        $vue->render();
    }

}