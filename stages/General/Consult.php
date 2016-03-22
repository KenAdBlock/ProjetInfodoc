<?php
function Consult ($Login, $Libelle, $Status)
{
    global $PATH_BACKOFFICE, $PATH_GENERAL;
	global $NomTabUsers, $NomTabStages, $NomTabStatus, $NomTabEntreprises,
	       $NomTabNewInscripts, $NomTabMailsToSend;
	
	$URL_List           = $PATH_BACKOFFICE.'BackOffice.php?Trait=List&SlxTable=';
	$URL_Form           = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable=';
	$URL_Affich         = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable=';
	$URL_AccesRapideSoc = $PATH_BACKOFFICE.'BackOffice.php?Trait=AccesRapideSoc';
	$URL_BackOffice     = $PATH_BACKOFFICE.'BackOffice.php?Trait=BackOffice';


    $PATH_RACINE = '../';
    $PATH_UTIL = $PATH_RACINE.'Util/';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
    require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_UTIL.'UtilSession.php'); // CloseSession()

    /* * / CloseSessionAndRedirect ($URL_SITE); /* */
    if (IsSessionAndLoginNonVide())
    {
        // Une session est en cours et un login y est enregistré ==>
        //     connexion interdite (prévenir l'appel direct de ce script)
        //     Déconnexion ? ==> fermeture de la session et retour à l'accueil

        if ($Step == 'Decnx')
        {
            CloseSessionAndRedirect ($URL_SITE.$PATH_PHP);
        }
    }
?>

<nav class="bleu1 role="navigation">

    <div class="nav-wrapper container">

      <ul class="left hide-on-med-and-down">
        <li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons left">account_circle</i><?=$Login?></a></li>
      </ul>

      <ul class="right hide-on-med-and-down">
        <li><a href="?Step=Decnx" target="_top"> Déconnexion</a></li>
      </ul> 

      

      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>  

    </div>
  </nav>

<div id="slide-out" class="side-nav grey lighten-4 z-depth-3 black-text">
    <div class="row">
        <div class="col s12">
            <h5 class="center">Bienvenue</h5>
            <p class="center">
                Vous êtes connecté(e) sous le pseudonyme <br>
                <b id="login-connect"><?=$Login?></b>
            </p>
<!--            <p class="center">en tant que <b>--><?//=$Libelle?><!--</b></p>-->
            <p class="center">en tant
			<?php
				if ($Libelle != "responsable de stage"
                    AND $Libelle != "secrétariat"
                    AND $Libelle != "tuteur"
                    AND $Libelle != "professeur") {
			?>
					qu'<b><?= $Libelle ?></b></p>
			<?php
				} else {
			?>
				  	que <b><?= $Libelle ?></b></p>
			<?php
				}
			?>

            <hr>
            <p class="center">


                                                                           <?php
                                        if (GetDroits ($Status, 'ChangerPassWord'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxChangePassWord.php')">
			    Changer de mot de passe</a>
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'NewUser'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_Form.$NomTabUsers?>">
				Nouvel utilisateur</a>
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeUsers'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabUsers?>">
                Liste des utilisateurs</a>
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'NewStage'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_Form.$NomTabStages?>">
			    Nouveau stage
			</a> 
                                                                           <?php
/** /										}
                                        if (GetDroits ($Status, 'ListeForum'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="../forum2014.html" target="principal">
		        Liste des entreprises présentes au Forum des stages
			</a> 
                                                                           <?php
/**/										}
                                        if (GetDroits ($Status, 'ListeFichesStages'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabStages?>">
		        Liste des fiches de stage
			</a>
<!--			--><?php //var_dump($URL_List.$NomTabStages);?> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeFichesStagesEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabStages?>">
		        Vos fiches de stage
			</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'RechercheStage'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=search">
                Rechercher un Stage</a>
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'NewEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_Form.$NomTabEntreprises?>">
                Nouvelle entreprise
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ModifEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_AccesRapideSoc?>">
                Modifier une entreprise
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeDetailsEntreprises'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=ListeDetailsEntreprises">
			    Liste détaillée des entreprises
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeEntreprises'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabEntreprises?>">
			    Liste des entreprises
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ModifInfosUserConnecte'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=ModifInfosUserConnecte">
                Vos Coordonnées
			</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'CoordonneesEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=CoordonneesEntreprise">
                Coordonnées de l'entreprise
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeNewInscripts'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabNewInscripts?>">
                Liste nouveaux inscrits
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeEtudAvecStage'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=ListeEtudAvecStage">
                Liste des étudiants avec stage
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeEtud1A'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Mailing&SsStep=LstEtudiants1A">
                Mailing aux 1<sup>ère</sup> année
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeEtud2A'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=Tous">
                Mailing aux 2<sup>ème</sup> année
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'Mailing'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Mailing">
                Mailing
			</a> 
                                                                           <?php
			                            }
/*
                                        if (GetDroits ($Status, 'AffectStageEtud'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=AffectStageEtud"
			                                             target="principal">
                Affectation d'un stage à un étudiant
			</a>
                                                                           <?php
 			                            }
*/
                                        if (GetDroits ($Status, 'Etiquettes'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Etiquettes">
                Étiquettes
			</a>
                                                                           <?php
 			                            }
                                        if (GetDroits ($Status, 'List_TA'))
			                            {
										                                   ?>
            <hr width="100%" />
            <p class="center">
                <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=List_TA">
                    Liste de la TA
                </a>
                                                                               <?php
                                            }
                                            if ($Status == ADMIN)
                                            {
                                                                               ?>
                <a class="ashadow blue-text" href="<?=$URL_BackOffice?>">
                    BackOffice
                </a>
			</p>
                                                                           <?php
			                            }
										                                   ?>

        </div>
    </div>
</div>

<?php
} // Consult()
?>