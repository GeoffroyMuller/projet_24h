<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 10:33
 */

namespace justjob\vue;

class vue
{
    /**
     * @var $elements
     *      Tableau des éléments à afficher
     */
    private $elements;

    private $selecteur;

    private $app;

    /**
     * VueParticipant constructor.
     * @param $tabAffichage
     */
    public function __construct($tabAffichage,$selecteur)
    {
        $this->elements = $tabAffichage;
        $this->selecteur = $selecteur;
        $this->app = \Slim\Slim::getInstance();
    }

    public function render(){

        switch($this->selecteur){
            case 'LIST_ITEMS' :
                $content = $this->htmlItemsListe();
                break;
        }
        $html=<<<END
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <title>WishList !</title>
                <meta charset="UTF-8">
                <link href="../../css/style.css" rel="stylesheet">
            </head>
 
END;
        echo $html;
    }
}