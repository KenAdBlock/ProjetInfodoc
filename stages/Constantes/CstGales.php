<?php
	include_once ('DEFINE.php');

    // Fichier CstGales.php

    /*  * / $MachineHote = PCDM;     /*   */ 
    /*  * / $MachineHote = ALLEGRO;  /*   */ 
    /*  */  $MachineHote = INFODOC;  /*   */

	$NomSession = 'Stages';

    // Noms des tables

    $NomTabUsers             = 'tabusers';
    $NomTabStages            = 'tabstages';
    $NomTabStatus            = 'tabstatus';
    $NomTabEntreprises       = 'tabentreprises';
    $NomTabLangages          = 'tablangages';
    $NomTabOS                = 'tabos';
    $NomTabMateriels         = 'tabmateriels';
    $NomTabReseauxLocaux     = 'tabreseauxlocaux';
    $NomTabReseauxPublics    = 'tabreseauxpublics';
    $NomTabBasesDonnees      = 'tabbasesdonnees';
    $NomTabNatureTaches      = 'tabnaturetaches';
	$NomTabNewInscripts      = 'tabnewinscripts';
    $NomTabIntegration       = 'tabintegration';
    $NomTabEnvironStage      = 'tabenvironstage';
	$NomTabMailsToSend       = 'tabmailstosend';
	$NomTabTaxe              = 'tabtaxe';
	$NomTabAnneesEntreprises = 'tabanneesentreprises';
	
    $MailResponsableStages = "marc.laporte@univ-amu.fr";
	$NomResponsableStages  = "Marc LAPORTE";
    $MailAdministrateur    = "marc.laporte@univ-amu.fr";
	$NomAdministrateur     = "Marc LAPORTE";
	$MailSecretariatTA     = "sophie.mebkhout	@univ-amu.fr";
	$MailBidon             = "bidon@bidon.fr";

	// URLs standard
	// =============

    $URLUnivMediterranee   = 'http://www.univ-amu.fr/';
    $URL_IUT               = 'http://iut.univ-amu.fr/';
    $URL_DEPTINFO          = 'http://iut.univ-amu.fr/departements/informatique-info-aix/';
	
	switch ($MachineHote)
	{
	  case PCDM :
	    $URL_SERVEUR_SITE  = 'http://127.0.0.1/';
	    $RACINE            = '/stages/';
	    break;
		
	  case ALLEGRO :
	    $URL_SERVEUR_SITE  = 'http://allegro.iut.univ-aix.fr/';
	    $RACINE            = 'mathieu/stages/';
	    break;

	  case INFODOC :
	    $URL_SERVEUR_SITE = 'http://infodoc.iut.univ-aix.fr/';
	    $RACINE           = '~laporte/stages/';
	    break;
	}
	$URL_SITE            = $URL_SERVEUR_SITE.$RACINE;

	// Chemins standard
	// ================
	
	$PATH_CSS        = $PATH_STAGES.'css/';
    $PATH_GIFS       = $PATH_RACINE.'gif/';
    $PATH_UTIL       = $PATH_RACINE.'Util/';
    $PATH_GENERAL    = $PATH_STAGES.'General/';
    $PATH_COMMUNS    = $PATH_STAGES.'Communs/';
    $PATH_BACKOFFICE = $PATH_STAGES.'BackOffice/';
	$PATH_LIST       = $PATH_STAGES.'List/';
	$PATH_FORM       = $PATH_STAGES.'Form/';
	$PATH_AFFICH     = $PATH_STAGES.'Affich/';
	$PATH_CLASS      = $PATH_STAGES.'Class/';
	$PATH_LIBRES     = $PATH_STAGES.'Libres/';
	
?>
