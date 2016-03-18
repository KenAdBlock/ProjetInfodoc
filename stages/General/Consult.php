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

?>

<nav class="blue" role="navigation">

    <div class="nav-wrapper container">

      <ul class="left hide-on-med-and-down">
        <li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons left">account_circle</i><?=$Login?></a></li>
      </ul>

      <ul class="right hide-on-med-and-down">
        <li><a href="?Step=Decnx" target="_top"> D&eacute;connexion</a></li>  
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
            <b><?=$Login?></b> 
            </p>
            <p class="center">en tant que <b><?=$Libelle?></b></p>

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
            <a class="ashadow blue-text" href="<?=$URL_Form.$NomTabUsers?>" 
			   target="principal">Nouvel utilisateur</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeUsers'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabUsers?>" 
			   target="principal">Liste des utilisateurs</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'NewStage'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_Form.$NomTabStages?>" target="principal">
			    Nouveau stage
			</a> 
                                                                           <?php
/** /										}
                                        if (GetDroits ($Status, 'ListeForum'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="../forum2014.html" target="principal">
		        Liste des entreprises pr&eacute;sentes au Forum des stages
			</a> 
                                                                           <?php
/**/										}
                                        if (GetDroits ($Status, 'ListeFichesStages'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabStages?>" target="principal">
		        Liste des fiches de stage
			</a>
<!--			--><?php //var_dump($URL_List.$NomTabStages);?> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeFichesStagesEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabStages?>" target="principal">
		        Vos fiches de stage
			</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'RechercheStage'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=search"
			   target="principal">Rechercher un Stage</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'NewEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_Form.$NomTabEntreprises?>" target="principal">
                Nouvelle entreprise
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ModifEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_AccesRapideSoc?>" target="principal">
                Modifier une entreprise
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeDetailsEntreprises'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=ListeDetailsEntreprises" target="principal">
			    Liste d&eacute;taill&eacute;e des entreprises
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ListeEntreprises'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabEntreprises?>" target="principal">
			    Liste des entreprises
		    </a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'ModifInfosUserConnecte'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=ModifInfosUserConnecte" target="principal">
                Vos Coordonn&eacute;es
			</a> 
                                                                           <?php
										}
                                        if (GetDroits ($Status, 'CoordonneesEntreprise'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=CoordonneesEntreprise" target="principal">
                Coordonn&eacute;es de l'entreprise
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeNewInscripts'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_List.$NomTabNewInscripts?>" target="principal">
                Liste nouveaux inscrits
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeEtudAvecStage'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=ListeEtudAvecStage" target="principal">
                Liste des &eacute;tudiants avec stage
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeEtud1A'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Mailing&SsStep=LstEtudiants1A" target="principal">
                Mailing aux 1<sup>&egrave;re</sup> ann&eacute;e
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'ListeEtud2A'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=Tous" target="principal">
                Mailing aux 2<sup>&egrave;me</sup> ann&eacute;e
			</a> 
                                                                           <?php
			                            }
                                        if (GetDroits ($Status, 'Mailing'))
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Mailing" target="principal">
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
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=Etiquettes"
			                                             target="principal">
                Etiquettes
			</a>
                                                                           <?php
 			                            }
                                        if (GetDroits ($Status, 'List_TA'))
			                            {
										                                   ?>
<hr width="100%" />
<p class="center">
            <a class="ashadow blue-text" href="<?=$PATH_BACKOFFICE?>BackOffice.php?Trait=List_TA"
			                                             target="principal">
                Liste de la TA
			</a>
                                                                           <?php
 			                            }
                                        if ($Status == ADMIN)
			                            {
										                                   ?>
            <a class="ashadow blue-text" href="<?=$URL_BackOffice?>" target="principal">
                BackOffice
			</a> 
			</p>
                                                                           <?php
			                            }
										                                   ?>


										                                   </p>
</div>
</div>
</div>

<?php
} // Consult()
?>