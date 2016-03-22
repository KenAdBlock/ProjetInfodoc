<?php
	$PATH_RACINE      = '../';
	$PATH_CONSTANTES  = $PATH_RACINE.'Constantes/';

	require_once ($PATH_CONSTANTES.'DEFINE.php');
	require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_CONSTANTES.'CstErr.php');
    require_once ($PATH_CONSTANTES.'CstErrBD.php');
	
	// Connexion a mySQL
	// =================
	
	require_once ($PATH_CONSTANTES. 'CstErrBD.php');
    require_once ($PATH_UTIL.       'UtilBD.php');

    $UtilBD = new UtilBD();
    $ConnectStages = $UtilBD->ConnectStages();

	// Récupérations des variables envoyées par POST ou GET
	// ====================================================
	
    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;

?>
<html>
    <head>
        <title>Lettre TA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="icon" type="image/x-icon" href="<?=$PATH_IMG?>favicon.ico">
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="<?=$PATH_CSS?>style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    </head>

    <body  onLoad="putFocus(0, 0);">
    <header>
        <div class="row container">
            <div class="col s6">
                <img  class="left responsive-img" src="<?=$PATH_GIFS?>Logo_IUT.jpg" alt="IUT Aix en Provence">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card grey lighten-4 z-depth-1">
                    <div class="card-content">                                                                              <?php
                                     if (isset ($StepValid))
                                     {
        /* ==========================  Remerciements    ==========================*/
                                                                                  ?>
        <p>
        Vous avez fait le choix de soutenir notre formation, en nous versant la taxe d'apprentissage.

        Ce formulaire nous permettra d'en effectuer le suivi.
        </p>
        <p>

        Nous vous remercions de l'intérêt que vous avez porté à notre démarche.
</p>

        Nous vous aviserons du versement dès sa transmission par l'organisme collecteur.

        <br /><br />
         Cordialement
        </p>


        <p class="right-align">
        Patricia Gaitan
        <br />
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Responsable du département
        </p>


         <p class="center"><button class="btn waves-effect waves-light white-text black" type="submit"
                           onClick="window.close()">Fermer la fenêtre</button></p>
                                                                          <?php
        /* ==========================  Enregistrement   ==========================*/

                    $ConnectStages->query("INSERT INTO $NomTabTaxe VALUES (
                              NULL,
                              '".addslashes ($RaisonSocialeSoc)."',
                              '".addslashes ($AdresseSoc)."',
                              '$CodePostalSoc',
                              '".addslashes ($VilleSoc)."',
                              '$Contact',
                              '$Tel',
                              '$Mail',
                              '$CatA',
                              '$CatAPlusB',
                              '$CatBPlusC',
                              '".addslashes ($NomCollecteur)."',
                              '".addslashes ($AdresseCollect)."',
                              '$CodePostalCollect',
                              '".addslashes ($VilleCollect)."');");

        /* ==========================  mail d'information  ======================*/

        $SujetDuMail = 'Taxe d\'apprentissage';
        $TexteDuMail = "La société \n\n".$RaisonSocialeSoc.
                       "\n\nversera \n".
                       "\nCatégorie A : " .$CatA.
                       "\nCatégorie A + B : ".$CatAPlusB.
                       "\nCatégorie B + C : ".$CatBPlusC.
                       "\n\npar l'intermédiaire de l'organisme \n\n".$NomCollecteur;
        $TexteDuMail = wordwrap ($TexteDuMail, 70);
        mail  ($MailAdministrateur, $SujetDuMail, stripslashes ($TexteDuMail));
        mail  ($MailSecretariatTA,  $SujetDuMail, stripslashes ($TexteDuMail));
                                     }
                                     else
                                     {
                                                                                  ?>
        <span class="card-title"><h4 class="center">Formulaire de versement de la Taxe d'apprentissage </br>
                                sur les salaires 2010</h4></span>
        <hr>
         <h5 class="black-text">Votre Entreprise</h5>
         <div class="row">
         <form action="" method="POST" role="form" class="col s12">
         <div class="row">
            <div class="input-field col s12">
                <input name="RaisonSocialeSoc" size="66" id="RaisonSocialeSoc" type="text" class="validate">
                <label for="RaisonSocialeSoc">Raison sociale</label>
            </div>
            <div class="input-field col s12">
            <div class="bleu1-text">Adresse </div><br>
                 <textarea name="AdresseSoc" id="AdresseSoc" class="materialize-textarea"></textarea>
            </div>
            <div class="input-field col l6 m6 s12">
                <input id="CodePostalSoc" name="CodePostalSoc" type="text" size="15" class="validate">
                <label for="CodePostalSoc">Code postal </label>
            </div>
            <div class="input-field col l6 m6 s12">
                <input id="VilleSoc" name="VilleSoc" type="text" size="40" class="validate">
                <label for="VilleSoc">Ville </label>
            </div>
            <div class="input-field col s12">
                <input name="Contact" size="66" id="Contact" type="text" class="validate">
                <label for="Contact">Personne ou service à contacter</label>
            </div>
            <div class="input-field col l6 m6 s12">
                <input id="Tel" name="Tel" type="text" class="validate">
                <label for="Tel">Tel</label>
            </div>
            <div class="input-field col l6 m6 s12">
                  <input id="Mail" name="Mail" type="text" class="validate">
                  <label for="Mail">Mail</label>
            </div>
            </div>

            <p>
                Le département Informatique de l'I.U.T. d'Aix-en-Provence est habilité à percevoir <b class="red-text">un versement Hors-quota ou barème au titre de la catégorie B</b>.
                (Il est toutefois possible de cumuler des catégories voisines, par exemple A+B ou B+C.
            </p>
            <div class="row">
                <div class="input-field col l6 m6 s12">
                    <input id="CatA" name="CatA" type="text" class="validate">
                    <label for="CatA">Catégorie B - Montant </label>
                </div>
                <div class="input-field col l6 m6 s12">
                     <input id="CatAPlusB" name="CatAPlusB" type="text" class="validate">
                     <label for="CatAPlusB">Par cumul, catégories A+B - Montant</label>
                </div>
                 <div class="input-field col l6 m6 s12">
                     <input id="CatBPlusC" name="CatBPlusC" type="text" class="validate">
                     <label for="CatBPlusC">Par cumul, catégories B+C - Montant</label>
                 </div>
                 </div>

            <p>
               Lors de votre versement auprès d'un organisme collecteur, veuillez bien préciser l'établissement bénéficiaire :
            </p>
            <p class="center">
                <b class="red-text">Département INFORMATIQUE de l'IUT d'Aix-en-Provence</b>
            </p>

            <hr>
            <h5 class="black-text">L'organisme collecteur </h5>
            <div class="row">
                 <div class="input-field col s12">
                    <input name="NomCollecteur" size="66" id="NomCollecteur" type="text" class="validate">
                    <label for="NomCollecteur">Nom de l'organisme </label>
                </div>
                <div class="input-field col s12">
                <div class="bleu1-text">Adresse </div><br>
                    <textarea name="AdresseCollect" id="AdresseCollect" class="materialize-textarea"></textarea>
                </div>
                <div class="input-field col l6 m6 s12">
                    <input id="CodePostalCollect" name="CodePostalCollect" type="text" size="15" class="validate">
                    <label for="CodePostalCollect">Code postal </label>
                </div>
                <div class="input-field col l6 m6 s12">
                     <input id="VilleCollect" name="VilleCollect" type="text" size="40" class="validate">
                     <label for="VilleCollect">Ville </label>
                </div>
            </div>

            <p class="center">
                <button type="reset" class="waves-effect waves-light btn black white-text">Reinitialiser</button>
                <button type="submit" class="waves-effect waves-light btn bleu1 white-text">Valider</button></p>
        <input type="hidden" name="StepValid">
        </form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php /*
<p  style="text-align : right">
<small>Institut Universaire de Technologie d'Aix-en-Provence
<br />
Département Informatique - Avenue Gaston Berger - 13625 Aix-en-Provence cedex 1
<br />
Téléphone : 04 42 93 90 43 - Télécopie : 04 42 93 90 74 - mel : informatique@iut.univmed.fr
</small>
</p>
*/?>
                                                                          <?php
                             }
                                                                          ?>
     <!--  Scripts-->
     <script language="JavaScript">
          <!-- Begin
           function putFocus(formInst, elementInst) {
               if (document.forms.length > 0) {
                    document.forms[formInst].elements[elementInst].focus();
                }
           }
           // The second number in the "onLoad" command in the body
           // tag determines the form's focus. Counting starts with '0'
           //  End -->
     </script>
     <script src="<?=$URL_SITE.$PATH_JQUERY?>jquery-2.2.1.min.js"></script>
     <script src="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.js"></script>
     <script src="<?=$PATH_JS?>init.js"></script>
    </body>
</html>