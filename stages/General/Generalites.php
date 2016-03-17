<?php
   $PATH_RACINE     = '../';
   $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

   include_once ($PATH_CONSTANTES.'CstGales.php');
 
	$URL_PROGR_DUT = $PATH_CONSTANTES.'dut_info_aix.pdf';
	$URL_PROGR_LP  = $PATH_CONSTANTES.'_lp_da2i.pdf';

?>

<nav class="blue" role="navigation">

  <div class="nav-wrapper container">

    <ul class="left hide-on-med-and-down">
      <li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons left">account_circle</i>Se connecter</a></li>
    </ul>

    <ul class="right hide-on-med-and-down">
      <li><a href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxNewInscript.php')"><i class="material-icons left">create</i>Nouvelle inscription</a></li>
    </ul>

    <div id="nav-mobile" class="side-nav">
      <div class="row">
        <div class="col s12">

          <p class="center black-text">
            Si vous désirez nous verser de la
            <a class="waves-effect waves-light btn blue lighten-2 white-text" href="../Libres/LettreTA.php" target="_blanc">Taxe d'apprentissage</a>
            merci de cliquer ci-dessus
          </p>
          <form action="" method="POST" role="form">
            <h5 class="center">Connexion</h5>
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefixx" type="text" class="validate black-text">
              <label for="icon_prefix">Login</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">https</i>
              <input id="icon_telephone" type="password" class="validate black-text">
              <label for="icon_telephone">Pass</label>
            </div>
            <p class="center">
              <a href="home.html" class="waves-effect waves-light btn white-text amber lighten-1"><i class="material-icons left">label</i>Se connecter</a>
            </p>
            <p class="center">
              <a class="waves-effect waves-light btn blue white-text modal-trigger" href="#modal_pass_oublie"><i class="material-icons left">restore</i>Mot de passe oublié</a>
            </p>
            <p>
              <a class="waves-effect waves-light btn blue white-text" href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxNewInscript.php')"><i class="material-icons left">create</i>Nouvelle inscription</a>
            </p>
          </form>
          <p class="center">
            <!--<a href="#"><img class="responsive-img hoverable z-depth-1" width="200" src="../img/logo_alumni.jpg"></a>-->
          </p>

        </div>
      </div>
    </div>

    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>


    <!-- Modal Structure -->
    <div id="modal_pass_oublie" class="modal">
      <div class="modal-content black-text">
        <h4>Mot de passe oublié</h4>
        <p>
          Entrez votre login et votre adresse e-mail pour récupérer un nouveau mot de passe.
        </p>
        <p>
          En validant ce formulaire, votre mot de passe sera réinitialisé et le nouveau mot de passe vous sera envoyé automatiquement par e-mail.
        </p>
        <form action="" method="POST" role="form">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="icon_prefixx" type="text" class="validate">
            <label for="icon_prefix">Login</label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="icon_telephone" type="text" class="validate">
            <label for="icon_telephone">E-mail</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-yellow btn-flat">Valider</a>
      </div>
    </div>

  </div>

</nav>

<main>

  <div class="container">
    <div class="row">
<!--    <div class="row no-margin-bottom">-->
      <div class="col s12">
        <div class="card grey lighten-4 z-depth-1" id="objectif" style="opacity: 1;">
          <div class="card-content">
            <span class="card-title"><h4 class="center">OBJECTIFS DES STAGES</h4></span>

            <p class="center">
              <b>Année Universitaire 2015/2016</b>
            </p> <br>

            <p>
              <b>Etudiants de 2<sup>ème</sup> année 10 semaines :</b> du 11 avril au 17 juin 2016 <br>

              <b>Etudiants de Licence Professionnelle SIL - DA2I <sup><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Systèmes Informatiques et Logiciels - Développement et Administration Internet et Intranet">1</a></sup> 12 semaines :</b> du 18 avril au 08 juillet 2016
            </p> <br>

            <p>Une des originalités de la formation dispensée dans les I.U.T. et dans les licences professionnelles se traduit par la nécessité pour les étudiants d'effectuer un stage obligatoire en entreprise. D'une durée de dix ou douze semaines selon le cas (D.U.T ou Licence Professionnelle), le stage poursuit les quatre objectifs suivants : </p>
            <ol style="list-style-type:lower-alpha;">
              <li>
                <span>
                 favoriser et développer les relations entre l'Université et les partenaires professionnels ;
                 </span>
              </li>
              <li>
                <span>
                 mettre l'étudiant en situation de production sur une tâche bien précise de manière à exploiter, sur le terrain de la vie professionnelle, les connaissances, les techniques et les méthodes acquises lors de leur formation ;
                 </span>
              </li>
              <li>
                <span>
                 permettre à l'étudiant de s'adapter au cas particulier de l'entreprise et du service informatique où il se trouve et d'améliorer sa connaissance du milieu professionnel ;
                 </span>
              </li>
              <li>
                <span>
                 à l'issue du stage, l'étudiant doit remettre un rapport de stage et faire un exposé oral devant un jury. Ces étapes sont nécessaires pour obtenir le diplôme (Diplôme Universitaire de Technologie ou Licence Professionnelle).
                 </span>
              </li>
            </ol>

            <p>
              Pendant toute cette période, l'étudiant est suivi par un enseignant du département (son tuteur) qui travaille en collaboration avec le maître de stage du stagiaire dans l'entreprise.
            </p>

            <p>
              Au début du stage, l'étudiant a des connaissances et l'expérience nécessaires pour s'intégrer à une équipe d'informaticiens (conception et développement); pour mieux situer les connaissances et le savoir-faire des étudiants, vous pouvez consulter les descriptifs de nos enseignements du <a href="http://infodoc.iut.univ-aix.fr/~laporte/stages/Constantes/dut_info_aix.pdf">DUT du département Informatique de l'IUT d'Aix-en-Provence</a> ou en <a href="http://infodoc.iut.univ-aix.fr/~laporte/stages/Constantes/_lp_da2i.pdf">licence professionnelle</a>.
            </p>

            <p>
              Sur le plan des modalités administratives, je dois préciser que l'étudiant stagiaire bénéficie de la sécurité sociale étudiante durant toute cette période; une convention de stage est établie entre l'entreprise d'accueil et l'I.U.T .
            </p> <br>

            <h5>Gratification :</h5>
            <p>
              Pour l'instant, l'article 30 de la loi nº 2009-1437 du 24/11/09, modifiée par la loi du 10 juillet 2014, impose pour tous les stages de plus de deux mois la gratification des stagiaires dans le privé comme dans le public au taux de 15% du plafond de la Sécurité Sociale, soit 1109.60€ pour tout le stage de DUT et 1361,60€ pour celui de LP - taux au 01/09/2015 (<a href="https://www.service-public.fr/simulateur/calcul/gratification-stagiaire">https://www.service-public.fr/simulateur/calcul/gratification-stagiaire</a>).
            </p> <br>

          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<footer class="page-footer">
<!--  <div class="amber">-->
  <div class="footer-perso amber">
    <div class="container">
<!--      <div class="row">-->
      <div class="row no-margin-bottom">
        <div class="col s12">
          <p class="right white-text">
            Le responsable des stages : <b><a class="white-text" href="mailto:marc.laporte@univ-amu.fr">  Marc Laporte</a></b>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
