<?php
	include_once ('DEFINE.php');

    // Fichier CstGales.php

    /*  * / $MachineHote = PCDM;     /*   */ 
    /*  * / $MachineHote = ALLEGRO;  /*   */ 
    /*  */  $MachineHote = INFODOC;  /*   */

	$NomSession = 'Stages';


	// Vaiable de connexion à la base de donnée lpt (laporte)

	$HOSTLPT = "localhost";
	$NAMELPT = 'laporte';
	$USERLPT = 'root';
	$PASSWDBDLPT = "";


	// Vaiable de connexion à la base de donnée stg (stages)
	$HOSTSTG = "localhost";
	$NAMESTG = 'stages';
	$USERSTG = 'root';
	$PASSWDBDSTG = "";



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
	
//    $MailResponsableStages = "marc.laporte@univ-amu.fr";
    $MailResponsableStages = "darkweizer@gmail.com";
	$NomResponsableStages  = "Marc LAPORTE";
//    $MailAdministrateur    = "marc.laporte@univ-amu.fr";
    $MailAdministrateur    = "darkweizer@gmail.com";
	$NomAdministrateur     = "Marc LAPORTE";
	$MailSecretariatTA     = "sophie.mebkhout	@univ-amu.fr";
	$MailBidon             = "bidon@bidon.fr";

	// URLs standard
	// =============

    $URLUnivMediterranee   = 'http://www.univ-amu.fr/';
    $URL_IUT               = 'http://iut.univ-amu.fr/';
    $URL_DEPTINFO          = 'http://iut.univ-amu.fr/departements/informatique-info-aix/';

    $port = $_SERVER['SERVER_PORT'];

    if($port != '80') {
        $port = ':' . $port;
    } else {
        $port = '';
    }
	
	switch ($MachineHote)
	{
	  case PCDM :
	    $URL_SERVEUR_SITE  = 'http://127.0.0.1' . $port . '/';
	    $RACINE            = '/stages/';
	    break;
		
	  case ALLEGRO :
	    $URL_SERVEUR_SITE  = 'http://allegro.iut.univ-aix.fr/';
	    $RACINE            = 'mathieu/stages/';
	    break;

	  case INFODOC :
	    $URL_SERVEUR_SITE = 'http://infodoc.esy.es' . $port . '/';
	    $RACINE           = 'stages/';
	    break;
	}
	$URL_SITE            = $URL_SERVEUR_SITE.$RACINE;

	// Chemins standard
	// ================
	
	$PATH_JS            = $PATH_RACINE.'js/';
	$PATH_CSS           = $PATH_RACINE.'css/';
    $PATH_IMG           = $PATH_RACINE.'Img/';
    $PATH_GIFS          = $PATH_RACINE.'gif/';
    $PATH_UTIL          = $PATH_RACINE.'Util/';
    $PATH_GENERAL       = $PATH_RACINE.'General/';
    $PATH_COMMUNS       = $PATH_RACINE.'Communs/';
    $PATH_BACKOFFICE    = $PATH_RACINE.'BackOffice/';
	$PATH_LIST          = $PATH_RACINE.'List/';
	$PATH_FORM          = $PATH_RACINE.'Form/';
	$PATH_AFFICH        = $PATH_RACINE.'Affich/';
	$PATH_CLASS         = $PATH_RACINE.'Class/';
	$PATH_LIBRES        = $PATH_RACINE.'Libres/';

	$PATH_PHP           = 'Php/';
    $PATH_VENDOR        = 'Vendor/';
    $PATH_JQUERY        = $PATH_VENDOR.'jquery/';
    $PATH_MATERIALIZE   = $PATH_VENDOR.'materialize/';

	
?>
