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

    public function htmlConnexion(){
        $html ='aya';

        return $html;
    }

    public function htmlInscription(){
        $urlProcess = $this->app->urlFor('inscriptionprocess');
        $html=<<<END
         <div class="mx-auto" style="width: 333px;margin: 0 auto;">
            <form class="form-signin" method="POST" action="$urlProcess">
                <h1 class="h3 mb-3 font-weight-normal">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Inscription</font>
                    </font>
                </h1>
                <label>Pseudo d'utilisateur</label>
                <input name="inputUserName" type="text" id="inputUserName" class="form-control" placeholder="Entrer le nom d'utilisateur" required="" autofocus="">
                <br>
                <label>Adresse email</label>
                <input name="inputEmail" type="email" id="inputEmail" class="form-control" placeholder="Entrer une adresse email" required="" autofocus="">
                <br>
                <label>Mot de passe</label>
                <input name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Entrer le mot de passe" required="">
                <br>
                <label>Vérification du mot de passe</label>
                <input name="verifinputPassword"type="password" id="verifinputPassword" class="form-control" placeholder="Entrer le mot de passe" required="">
                <br>
                <label>En situation de handicap :</label>
                <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="radioOui" value="option1">
                        <label class="form-check-label" for="radioOui">
                          Oui
                        </label>
                        &nbsp;&nbsp;
                        <input class="form-check-input" type="radio" name="radio" id="radioNon" value="option2" checked>
                        <label class="form-check-label" for="radioNon">
                          Non
                        </label>
                </div>
                <input type="text" id="descriphandicap" class="form-control" placeholder="Décrivez votre handicap" required="">
                <br>

                <input type="submit" value="S'inscrire">

            </form>
        </div>
END;
        return $html;
    }

    public function render(){

        switch($this->selecteur){
            case 'LISTE_OFFRE' :
                $content = $this->htmlItemsListe();
                break;

            case 'CONNEXION' :
                $content = $this->htmlConnexion();
                break;

            case 'INSCRIPTION' :
                $content = $this->htmlInscription();
                break;
        }
        $html=<<<END
        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JustJob - Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body class="text-center">
  <nav class="navbar-inverse">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="../index.html">JustJob</a>
          </div>

          <ul class="nav navbar-nav">
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="creerOffres.html">Mes offres</a></li>
                      <li><a href="ListeOffres.html">Consulter les offres</a></li>
                  </ul>
              </li>

              <li><a href="candidature.html">Mes candidatures</a></li>

              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Transports<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="mesTrajets.html">Mes trajets</a></li>
                    <li><a href="consulterTrajets.html">Consulter les trajets</a></li>
                  </ul>
              </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
              <li><a href="inscription.html"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
              <li><a href="connexion.html"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
          </ul>
      </div>
  </nav>

    $content
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        </body>
</html>
END;
        echo $html;
    }
}