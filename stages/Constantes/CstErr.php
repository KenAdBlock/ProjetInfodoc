<?php
    // Fichier CstErr.php
	
	// Traitement g&eacute;n&eacute;ral des erreurs
	
	$NOERR             = 0;
	$ERRCHAMPNONREMPLI = 10000;

	$new_link = false;

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
	
    $TextMsgErr [$ERRSESSIONDEJAOUVERTE]    = 'Une session est d&eacute;j&agrave; ouverte avec votre login';
    $TextMsgErr [$ERRDECONNECTEZVOUS]       = 'D&eacute;connectez-vous avant d\'en ouvrir une nouvelle';
    $TextMsgErr [$ERRLOGININEXISTANT]       = 'Identifiant inexistant';
    $TextMsgErr [$ERRPASSWORDINVALIDE]      = 'Mot de passe invalide';
    $TextMsgErr [$ERRDEJAINSCRIT]           = 'Vous &ecirc;tes d&eacute;j&agrave; inscrit(e) !!!';
    $TextMsgErr [$ERREMAILINVALIDE]         = 'e-mail invalide';
	
    $TextMsgErr [$ERRLOGININVALIDE]         = 'Identifiant de plus de '.
	                                           MAXLGLOGIN.' ou de moins de '.
											   MINLGLOGIN.' caract&egrave;res';
    $TextMsgErr [$ERRLOGINCARINVALIDE]      = 'Identifiant contenant des caract&egrave;res invalides';
    $TextMsgErr [$ERRLOGINDEJAUTILISE]      = 'Identifiant d&eacute;j&agrave; utilis&eacute;';
	
    $TextMsgErr [$ERRINSCRIPTINVALIDE]      = 'Votre inscription n\'a pas encore &eacute;t&eacute; valid&eacute;e. Merci d\'attendre le mail de confirmation avant de tenter une nouvelle connexion';

    $TextMsgErr [$ERR2PASSWDDIFF]           = 'Le deuxieme mot de passe n\'est pas identique au premier';
    $TextMsgErr [$ERRLGPASSWDINVALIDE]      = 'Mot de passe de plus de '.
	                                           MAXLGPASSWD.' ou de moins de '.
											   MINLGPASSWD.' caract&egrave;res';
    $TextMsgErr [$ERRPASSWDCARINVALIDE]     = 'Mot de passe contenant des caract&egrave;res invalides';
?>
