<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 10:16
 */

namespace justjob\controleur;


use justjob\model\offreEmploi;

class controleurUtilisateur
{
    /**
     * Permet de modifier son profil
     * @param $nomUtilisateur
     * @param $motDePasse
     */
    public function modificationProfil($nomUtilisateur, $motDePasse){
        $utilisateur = \justjob\model\Utilisateur::where('nom','=',$_SESSION['profile']['username'])->first();
        if(!is_null($nomUtilisateur)){
            $utilisateur->nom = $nomUtilisateur;
        }

        if(!is_null($motDePasse)){
            $newMotDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
            $utilisateur->pass = $newMotDePasse;
        }
        $utilisateur->save();
        session_destroy();
    }


    /**
     * Ajoute une offre d'emploi dans la base de donnée
     * @param $nom
     * @param $description
     * @param $lieu
     */
    public function creerUneOffreEmploi($nom,$description,$lieu){
        $offre = new offreEmploi();
        $offre->nom = $nom;
        $offre->description = $description;
        $offre->lieu = $lieu;
        $offre->idemployeur = $_SESSION['profile']['userId'];
        $offre->save();
    }
}