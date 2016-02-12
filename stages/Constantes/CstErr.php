<?php
    // Fichier CstErr.php
	
	// Traitement général des erreurs
	
	$NOERR             = 0;
	$ERRCHAMPNONREMPLI = 10000;
    
	$MsgErr = array();
	
	$ERRSESSIONDEJAOUVERTE = 1;
	$ERRDECONNECTEZVOUS    = 2;
	$ERRLOGININEXISTANT    = 3;
	$ERRPASSWORDINVALIDE   = 4;
	$ERRDEJAINSCRIT        = 5;
	$ERREMAILINVALIDE      = 6;
	$ERRLOGININVALIDE      = 7;
	$ERRLOGINCARINVALIDE   = 8;
	$ERRLOGINDEJAUTILISE   = 9;
	$ERRINSCRIPTINVALIDE   = 10;
	$ERR2PASSWDDIFF        = 11;
	$ERRLGPASSWDINVALIDE   = 12;
	$ERRPASSWDCARINVALIDE  = 13;
	
	$TextMsgErr = array();
	
    $TextMsgErr [$ERRSESSIONDEJAOUVERTE]    = 'Une session est déjà ouverte avec votre login';
    $TextMsgErr [$ERRDECONNECTEZVOUS]       = 'Déconnectez-vous avant d\'en ouvrir une nouvelle';
    $TextMsgErr [$ERRLOGININEXISTANT]       = 'Identifiant inexistant';
    $TextMsgErr [$ERRPASSWORDINVALIDE]      = 'Mot de passe invalide';
    $TextMsgErr [$ERRDEJAINSCRIT]           = 'Vous êtes déjà inscrit(e) !!!';
    $TextMsgErr [$ERREMAILINVALIDE]         = 'e-mail invalide';
	
    $TextMsgErr [$ERRLOGININVALIDE]         = 'Identifiant de plus de '.
	                                           MAXLGLOGIN.' ou de moins de '.
											   MINLGLOGIN.' caractères';
    $TextMsgErr [$ERRLOGINCARINVALIDE]      = 'Identifiant contenant des caractères invalides';
    $TextMsgErr [$ERRLOGINDEJAUTILISE]      = 'Identifiant déjà utilisé';
	
    $TextMsgErr [$ERRINSCRIPTINVALIDE]      = 'Votre inscription n\'a pas encore été validée. Merci d\'attendre le mail de confirmation avant de tenter une nouvelle connexion';

    $TextMsgErr [$ERR2PASSWDDIFF]           = 'Le deuxieme mot de passe n\'est pas identique au premier';
    $TextMsgErr [$ERRLGPASSWDINVALIDE]      = 'Mot de passe de plus de '.
	                                           MAXLGPASSWD.' ou de moins de '.
											   MINLGPASSWD.' caractères';
    $TextMsgErr [$ERRPASSWDCARINVALIDE]     = 'Mot de passe contenant des caractères invalides';
?>
