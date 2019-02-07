<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 10:33
 */

namespace justjob\vue;

use justjob\model\offreEmploi;

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
        $connexion = $this->app->urlFor('connexionprocess');
        $html =<<<END
 <div class="container">
            <div class="px-2 mx-auto" style="width: 333px; margin: 0 auto;">
                    <form class="form-signin" method="post" action="$connexion" >

                        <h1 class="h3 mb-3 font-weight-normal">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Veuillez vous connecter</font>
                            </font></h1>
                        <label>Pseudo d'utilisateur</label>
                        <input name="inputUserName" type="text" id="inputUserName" class="form-control" placeholder="Entrer le nom d'utilisateur" required="" autofocus="">
                        <br>
                        <label>Mot de passe</label>
                        <input name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Entrer le mot de passe" required="">
                        <br>

                        <input class="btn btn-primary btn-block" type="submit" value="Se connecter" >

                    </form>
                </div>

    </div>
END;

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
                <label>Adresse postale </label>
                <input name="inputadresspostal" type="text" id="inputadresspostal" class="form-control" placeholder="Entrer votre adresse postal" required="">
                <br>
                <label>Mot de passe</label>
                <input name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Entrer le mot de passe" required="">
                <br>
                <label>Vérification du mot de passe</label>
                <input name="verifinputPassword"type="password" id="verifinputPassword" class="form-control" placeholder="Entrer le mot de passe" required="">
                <br>
                <label>En situation de handicap :</label>
                <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="radioOui" value="oui">
                        <label class="form-check-label" for="radioOui">
                          Oui
                        </label>
                        &nbsp;&nbsp;
                        <input class="form-check-input" type="radio" name="radio" id="radioNon" value="non" checked>
                        <label class="form-check-label" for="radioNon">
                          Non
                        </label>
                </div>
                <input name="inputHandicap" type="text" id="descriphandicap" class="form-control" placeholder="Décrivez votre handicap">
                <br>

                <input  class="btn btn-primary btn-block" id="submit" type="submit" value="S'inscrire">

            </form>
        </div>
END;
        return $html;
    }

    public function htmlOffreEmplois(){
        $html=<<<END

<div class="container">
    <form class="form-horizontal" action="/action_page.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="metier">Quoi ?</label>
            <div class="col-sm-5">
                <input type="metier" class="form-control" id="metier" placeholder="Entrer métier" name="metier">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="ville">Où ?</label>
            <div class="col-sm-5">
                <input type="ville" class="form-control" id="ville" placeholder="Entrer Ville" name="ville">
            </div>
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" id="boutonRecherche">Rechercher</button>

            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-sm-6 border" style="width: 300px;">
        <form class="triche" method ="post">
            <div class="form-group mx-auto" style="width: 300px;">
                <label for="Distance">Distance</label>
                <select class="form-control" id="Distance">
                    <option>Lieu exact</option>
                    <option>Dans un rayon de 5 km</option>
                    <option>Dans un rayon de 10 km</option>
                    <option>Dans un rayon de 15 km</option>
                    <option>Dans un rayon de 25 km</option>
                    <option>Dans un rayon de 50 km</option>
                    <option>Dans un rayon de 100 km</option>
                </select>
            </div>
            <div class="form-group mx-auto " style="width: 300px;">
                <label for="estimSalaire">Estimation Salaire</label>
                <select class="form-control" id="estimSalaire">
                    <option>Lieu exact</option>
                    <option>20 000 €</option>
                    <option>25 000 €</option>
                    <option>30 000 €</option>
                    <option>35 000 €</option>
                    <option>45 000 €</option>
                </select>
            </div>
            <div class="form-group mx-auto" style="width: 300px;">
                <label for="Lieu">Lieu</label>
                <textarea class="form-control" id="Lieu" rows="1" style="resize:none;"></textarea>
            </div>

            <div class="form-group mx-auto" id="categorie" style="width: 300px;">
                <label for="Cat" id="categorie-label">Catégorie</label>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input checkbox-recherche" id="check1">
                    <label class="form-check-label categorie-label" for="check1">Administratif : assistant comptabe</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check2">
                    <label class="form-check-label categorie-label" for="check2">Administratif : comptable</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check3">
                    <label class="form-check-label categorie-label" for="check3">Administratif : secrétaire</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check4">
                    <label class="form-check-label categorie-label" for="check4">Administratif : standardiste</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check5">
                    <label class="form-check-label categorie-label" for="check5">Bâtiment/Travaux Publics : conducteur d'engin</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check6">
                    <label class="form-check-label categorie-label" for="check6">Bâtiment/Travaux Publics : manoeuvre</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check7">
                    <label class="form-check-label categorie-label" for="check7">Bâtiment/Travaux Publics : maçon</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check8">
                    <label class="form-check-label categorie-label" for="check8">Bâtiment/Travaux Publics : électricien</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check9">
                    <label class="form-check-label categorie-label" for="check9">Commerce et vente : assistant commercial</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check10">
                    <label class="form-check-label categorie-label" for="check10">Commerce et vente : commercial</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check11">
                    <label class="form-check-label categorie-label" for="check11">Commerce et vente : manager</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check12">
                    <label class="form-check-label categorie-label" for="check12">Commerce et vente : vendeur polyvalent</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check13">
                    <label class="form-check-label categorie-label" for="check13">Logistique : magasinier</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check14">
                    <label class="form-check-label categorie-label" for="check14">Logistique : préparateur de commandes</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check15">
                    <label class="form-check-label categorie-label" for="check15">Restauration et hôtellerie  : aide cuisinier</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check16">
                    <label class="form-check-label categorie-label" for="check16">Restauration et hôtellerie  : cuisinier</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check17">
                    <label class="form-check-label categorie-label" for="check18">Restauration et hôtellerie  : employé polyvalent</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check18">
                    <label class="form-check-label categorie-label" for="check18">Restauration et hôtellerie  : serveur</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check19">
                    <label class="form-check-label categorie-label" for="check19">Transport : cariste</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check20">
                    <label class="form-check-label categorie-label" for="check20">Transport : chauffeur de bus</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check21">
                    <label class="form-check-label categorie-label" for="check21">Transport : conducteur poids lourd</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check22">
                    <label class="form-check-label categorie-label" for="check22">Transport : livreur</label>
                </div>
            </div>
        </form>
    </div>
END;
        foreach ($this->elements as $offre){
            $nom = $offre->nom;
            $descr = $offre->description;
            $lieux = $offre->lieu;
            $urlOffre = $this->app->urlFor('offre',['id'=>$offre->id]);

            $html=$html.<<<END
  <div class="col-sm-9"><div class="container triche">
  <a href="$urlOffre">
        <div class="panel-group">

            <div class="panel panel-info">
                <div class="panel-heading"$nom</div>
                <div class="panel-body">$descr - Lieux : $lieux</div>
            </div>

        </div>
        </div>
        </a>
    </div></div>
END;

        }



        return $html;
    }

    public function htmlOffre(){
        $element = $this->elements;
        $urlSupp = $this->app->urlFor('supprimerOffre',['id'=>$element->id]);
        $html=<<<END
 <div class="panel panel-info">
        <div class="panel-heading">$element->nom</div>
        <div class="panel-body">$element->description - Lieux : $element->lieu</div>
      </div>

      <div class="row">
          <div class="col-sm-4"><a href="$urlSupp"><button type="submit" class="btn btn-default" id="boutonSupprimer">Supprimer l'offre</button></div></a>
          <div class="col-sm-4"><button type="submit" class="btn btn-default" id="boutonFermer">Fermer l'offre</button></div>
          <div class="col-sm-4"><button type="submit" class="btn btn-default" id="boutonCandidater">Candidater pour l'offre</button></div>
      </div>

END;
        return $html;

    }

    public function htmlCandidature(){
        $elements = $this->elements;
        $html=<<<END
 <div class="container">
        <h2>Liste des candidatures</h2>
        <div class="panel-group">
END;

        foreach ($elements as $element){
            $offre = offreEmploi::where('id','=',$element->idoffre);
            $html=<<<END
          <div class="panel panel-info">
            <div class="panel-heading">$offre->nom</div>
            <div class="panel-body">$offre->description</div>
          </div>
END;
        }
        $html=$html.<<<END
        </div>
      </div>
END;




        return $html;
    }

    public function htmlHome(){
        $html = <<<END
    <h1 style="text-align:center;">JustJob</h1>


    <div class="container" style="width:30%">
      <h2>Nos offres récentes</h2>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="../images/offre.jpg" alt="Mirabelle" style="width:100%;">
          </div>

          <div class="item">
            <img src="../images/offre.jpg" alt="Mushu" style="width:100%;">
          </div>

          <div class="item">
            <img src="../images/offre.jpg" alt="Chaton" style="width:100%;">
          </div>

          <div class="item">
            <img src="../images/offre.jpg" alt="Party" style="width:100%;">
          </div>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

<footer style="text-align:center;">
    <p>by</p><img src="../images/logo2.png" alt="logo" style="width:10%">
</footer>

END;
        return $html;

    }

    public function render(){
        $urlCandidature = $this->app->urlFor('candidature');
        $urlDeco = $this->app->urlFor('deconnexion');
        $urlHome = $this->app->urlFor('home');
        $estConnecte = isset($_SESSION['profile']);
        $consulterOffre = $this->app->urlFor('offreEmplois');
        $urlInscription = $this->app->urlFor('inscription');
        $urlConnexion= $this->app->urlFor('connexion');
        if($estConnecte){
            $nom =$_SESSION['profile']['username'];
            $navbar = <<<END
            <nav class="navbar-inverse" id="navtriche">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="$urlHome">JustJob</a>
          </div>

          <ul class="nav navbar-nav">
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="creerOffres.html">Mes offres</a></li>
                      <li><a href="$consulterOffre">Consulter les offres</a></li>
                  </ul>
              </li>

              <li><a href="$urlCandidature">Mes candidatures</a></li>

              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Transports<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="mesTrajets.html">Mes trajets</a></li>
                    <li><a href="$consulterOffre">Consulter les trajets</a></li>
                  </ul>
              </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
              <li><a href=""><span class="glyphicon glyphicon-user"></span> Bonjour, $nom !</a></li>
              <li><a href="$urlDeco"><span class="glyphicon glyphicon-log-in"></span> Deconnexion</a></li>
          </ul>
      </div>
  </nav>

END;

        }else{
    $navbar = <<<END
<nav class="navbar-inverse" id="navtriche">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="$urlHome">JustJob</a>
          </div>

          <ul class="nav navbar-nav">
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Offres<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="creerOffres.html">Mes offres</a></li>
                      <li><a href="$consulterOffre">Consulter les offres</a></li>
                  </ul>
              </li>

              <li><a href="$urlCandidature">Mes candidatures</a></li>

              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Transports<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="mesTrajets.html">Mes trajets</a></li>
                    <li><a href="consulterTrajets.html">Consulter les trajets</a></li>
                  </ul>
              </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
              <li><a href="$urlInscription"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
              <li><a href="$urlConnexion"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
          </ul>
      </div>
  </nav>
END;

        }

        switch($this->selecteur){
            case 'LISTE_OFFRE' :
                $content = $this->htmlOffreEmplois();
                break;

            case 'CONNEXION' :
                $content = $this->htmlConnexion();
                break;

            case 'INSCRIPTION' :
                $content = $this->htmlInscription();
                break;
            case 'AFFICHER_OFFRE':
                $content = $this->htmlOffre();
                break;

                case 'CANDIDATURE':
            $content = $this->htmlCandidature();
            break;

            case 'HOME':
                $content = $this->htmlHome();
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
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
  $navbar

    $content
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
         <script src = "../../js/Inscription.js"></script>
       </body>
</html>
END;
        echo $html;
    }
}