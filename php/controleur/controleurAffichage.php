<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 12:38
 */

namespace justjob\controleur;


use justjob\vue\vue;

class controleurAffichage
{
    public function afficherListesDesOffresEmplois(){
        $offres = \justjob\model\offreEmploi::all()->get();
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

}