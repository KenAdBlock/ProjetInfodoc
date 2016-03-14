<?php 
// Fichier CstMsg.php
//
$NoMsg = 0;
define ('MSGFORMSTAGE_NIVEAUSTAGE',        ++$NoMsg);

define ('MSGFORMSTAGE_1',                  ++$NoMsg);
define ('MSGFORMSTAGE_1_1',                ++$NoMsg);
define ('MSGFORMSTAGE_TUTEUR',             ++$NoMsg);
define ('MSGFORMSTAGE_2',                  ++$NoMsg);

define ('MSGFORMSTAGE_PRECISEZ',           ++$NoMsg);

define ('MSGFORMSTAGE_ENV_MATERIEL',       ++$NoMsg);
define ('MSGFORMSTAGE_ENV_LOGICIEL',       ++$NoMsg);

define ('MSGFORMSTAGE_LANGAGES',           ++$NoMsg);
define ('MSGFORMSTAGE_BD',                 ++$NoMsg);
define ('MSGFORMSTAGE_LOGICIELS_SPEC',     ++$NoMsg);
define ('MSGFORMSTAGE_METHODES_STANDARDS', ++$NoMsg);

define ('MSGFORMSTAGE_ANALYSE',            ++$NoMsg);
define ('MSGFORMSTAGE_CONCEPTION',         ++$NoMsg);
define ('MSGFORMSTAGE_PROGRAMMATION',      ++$NoMsg);
define ('MSGFORMSTAGE_CONTROLE_QL',        ++$NoMsg);
define ('MSGFORMSTAGE_GESTIONPROJET',      ++$NoMsg);

define ('MSGFORMSTAGE_SUJET',              ++$NoMsg);
define ('MSGFORMSTAGE_NATURE_TACHE',       ++$NoMsg);
define ('MSGFORMSTAGE_INTEGRATION',        ++$NoMsg);

define ('MSGFORMSTAGE_REMARQUES',          ++$NoMsg);
define ('MSGFORMSTAGE_DESCR_SERVICE',      ++$NoMsg);
define ('MSGFORMSTAGE_NBPERS_CI',          ++$NoMsg);
define ('MSGFORMSTAGE_NBSTAGIAIRES',       ++$NoMsg);
define ('MSGFORMSTAGE_NBPERS_SERV',        ++$NoMsg);
define ('MSGFORMSTAGE_OLDSTAGIAIRES',      ++$NoMsg);
define ('MSGFORMSTAGE_ENVIRONSTAGIAIRE',   ++$NoMsg);
define ('MSGFORMSTAGE_SEUL',               ++$NoMsg);
define ('MSGFORMSTAGE_COLL_INFORM',        ++$NoMsg);

//define ('MSGFORMSTAGE_PROGRAMMATION',      ++$NoMsg);
//define ('MSGFORMSTAGE_ANALYSE',            ++$NoMsg);
define ('MSGFORMSTAGE_INTEGRPROJETGLOBAL', ++$NoMsg);
define ('MSGFORMSTAGE_ENTITEINDEPENDANTE', ++$NoMsg);

define ('MSGFORMSTAGE_RENS_PRATIQUES',   ++$NoMsg);
define ('MSGFORMSTAGE_INDEMN_STAGE',     ++$NoMsg);
define ('MSGFORMSTAGE_INDEMN_REPAS',     ++$NoMsg);
define ('MSGFORMSTAGE_INDEMN_TRANSPORT', ++$NoMsg);
define ('MSGFORMSTAGE_MOYEN_TRANSPORT',  ++$NoMsg);
define ('MSGFORMSTAGE_EMBAUCHE',         ++$NoMsg);

$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGE       ] = 'Ce stage s\'adresse &agrave; des étudiants de ';
$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGEDUT    ] = 'DUT';
$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGELP     ] = 'Licence pro SIL';
$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGEINDIFF ] = 'Indiff&eacute;rent';
$Msg_FormStage [MSGFORMSTAGE_1                 ] = '1. Entreprise';
$Msg_FormStage [MSGFORMSTAGE_1_1               ] = '1.1 Ma&icirc;tre de stage';
$Msg_FormStage [MSGFORMSTAGE_ADRSTAGE          ] = 'Si l\'adresse du lieu de stage est diff&eacute;rente de celle de l\'entreprise, veillez remplir le cadre ci-dessous';
$Msg_FormStage [MSGFORMSTAGE_TUTEUR            ] = 'Tuteur de stage : ';
$Msg_FormStage [MSGFORMSTAGE_2                 ] = '2. Environnement du stagiaire dans le cadre de sa t&acirc;che';
$Msg_FormStage [MSGFORMSTAGE_ENV_MATERIEL      ] = '2.1 Environnement mat&eacute;riel';
$Msg_FormStage [MSGFORMSTAGE_ENV_LOGICIEL      ] = '2.2 Environnement logiciel'; 
$Msg_FormStage [MSGFORMSTAGE_DESCR_SERVICE     ] = '1.2 Service';
$Msg_FormStage [MSGFORMSTAGE_RENS_PRATIQUES    ] = '1.3 Renseignements pratiques';
$Msg_FormStage [MSGFORMSTAGE_METHODES_STANDARDS] = '2.3 M&eacute;thodes ou standards';
$Msg_FormStage [MSGFORMSTAGE_SUJET             ] = '3. Sujet';

//define ('MSGFORMSTAGE_LANGAGES',           ++$NoMsg);
//define ('MSGFORMSTAGE_BD',                 ++$NoMsg);
//define ('MSGFORMSTAGE_LOGICIELS_SPEC',     ++$NoMsg);
//define ('MSGFORMSTAGE_METHODES_STANDARDS', ++$NoMsg);

$Msg_FormStage [MSGFORMSTAGE_LANGAGES          ] = 'Langages de programmation'; 
$Msg_FormStage [MSGFORMSTAGE_BD                ] = 'Bases de donn&eacute;es';
$Msg_FormStage [MSGFORMSTAGE_LOGICIELS_SPEC    ] = 'Logiciels sp&eacute;cifiques &agrave; l\'entreprise';

$Msg_FormStage [MSGFORMSTAGE_STDANALYSE        ] = '&nbsp; &nbsp; &nbsp; &nbsp; - d\'Analyse';
$Msg_FormStage [MSGFORMSTAGE_STDCONCEPTION     ] = '&nbsp; &nbsp; &nbsp; &nbsp; - de Conception';
$Msg_FormStage [MSGFORMSTAGE_STDPROGRAMMATION  ] = '&nbsp; &nbsp; &nbsp; &nbsp; - de Programmation';
$Msg_FormStage [MSGFORMSTAGE_STDCONTROLE_QL    ] = '&nbsp; &nbsp; &nbsp; &nbsp; - de Controle qualit&eacute; logicielle';
$Msg_FormStage [MSGFORMSTAGE_STDGESTIONPROJET  ] = '&nbsp; &nbsp; &nbsp; &nbsp; - de Gestion de projet';

$Msg_FormStage [MSGFORMSTAGE_NATURE_TACHE    ] = 'Nature de la t&acirc;che :';
$Msg_FormStage [MSGFORMSTAGE_PROGRAMMATION   ] = '&nbsp; &nbsp; &nbsp; &nbsp; - programmation';
$Msg_FormStage [MSGFORMSTAGE_ANALYSE         ] = '&nbsp; &nbsp; &nbsp; &nbsp; - analyse';

$Msg_FormStage [MSGFORMSTAGE_INTEGRATION     ] = 'Encadrement du stagiaire, le travail de l\'&eacute;tudiant : ';
$Msg_FormStage [MSGFORMSTAGE_INTEGRPROJETGLOBAL] = '&nbsp; &nbsp; &nbsp; &nbsp; - s\'int&egrave;gre-t-il dans un projet global ?';
$Msg_FormStage [MSGFORMSTAGE_ENTITEINDEPENDANTE] = '&nbsp; &nbsp; &nbsp; &nbsp; - constitue-t-il une entit&eacute; ind&eacute;pendante ? ';

$Msg_FormStage [MSGFORMSTAGE_REMARQUES       ] = 'Remarques g&eacute;n&eacute;rales : ';
$Msg_FormStage [MSGFORMSTAGE_NBPERS_CI       ] = 'Nombre de personnes du Centre Informatique : ';
$Msg_FormStage [MSGFORMSTAGE_NBSTAGIAIRES    ] = 'Nombre de stagiaires pr&eacute;vus : ';
$Msg_FormStage [MSGFORMSTAGE_NBPERS_SERV     ] = 'Nombre de personnes du service o&ugrave; sera affect&eacute; le stagiaire : ';
$Msg_FormStage [MSGFORMSTAGE_OLDSTAGIAIRES   ] = 'L\'entreprise a-t-elle d&eacute;j&agrave; accueilli des stagiaires <br />&nbsp; &nbsp; de notre d&eacute;partement auparavant ? ';
$Msg_FormStage [MSGFORMSTAGE_ENVIRONSTAGIAIRE] = 'Le stagiaire travaillera-t-il ';
$Msg_FormStage [MSGFORMSTAGE_SEUL            ] = 'seul ';
$Msg_FormStage [MSGFORMSTAGE_COLL_INFORM     ] = 'en collaboration avec un informaticien';

$Msg_FormStage [MSGFORMSTAGE_INDEMN_STAGE    ] = 'Indemnit&eacute;s mensuelles (&euro;/mois) &nbsp; &nbsp; ';
$Msg_FormStage [MSGFORMSTAGE_INDEMN_REPAS    ] = 'Repas';
$Msg_FormStage [MSGFORMSTAGE_INDEMN_TRANSPORT] = 'Transport';
$Msg_FormStage [MSGFORMSTAGE_MOYEN_TRANSPORT ] = 'Moyen de Transport';
$Msg_FormStage [MSGFORMSTAGE_EMBAUCHE        ] = 'Possibilit&eacute; d\'embauche apr&egrave;s le stage';

$Msg_FormStage [MSGFORMSTAGE_PRECISEZ        ] = 'Si oui, pr&eacute;cisez ';

define ('MATERIEL_PAR_LIGNE', 1);
define ('LANG_PAR_LIGNE',     2);
define ('BD_PAR_LIGNE',       1);

$IndCodErr = 0;

define ('ERRCONNECT',        ++$IndCodErr);
define ('ERRSELECT',         ++$IndCodErr);
define ('ERRREQUEST',        ++$IndCodErr);

define ('LOGINUNDERSCORE',   ++$IndCodErr);
define ('LOGINCARINVAL',     ++$IndCodErr);
define ('LOGINNBCARINVAL',   ++$IndCodErr);
define ('LOGINDEJAPRIS',     ++$IndCodErr);
define ('TUTEUR_SOC_IMPOSS', ++$IndCodErr);
define ('STATUS_SOC_IMPOSS', ++$IndCodErr);
define ('STATUS_SANS_SOC',   ++$IndCodErr);
define ('SOC_ET_INFOS_SOC',  ++$IndCodErr);
define ('NPCI_NON_NUM',      ++$IndCodErr);
define ('NBSTAG_NON_NUM',    ++$IndCodErr);
define ('NBSTAG_NUL',        ++$IndCodErr);
define ('CARINVAL_IN_TEL',   ++$IndCodErr);
define ('LGINVAL_IN_TEL',    ++$IndCodErr);
define ('INDEMN_REPAS_INCORRECTE',     ++$IndCodErr);
define ('INDEMN_TRANSPORT_INCORRECTE', ++$IndCodErr);
define ('LOGICIELS_SPEC_INCORRECTS',   ++$IndCodErr);
define ('CHAMP_NON_REMPLI',            ++$IndCodErr);
define ('INDEMN_INVALIDE',             ++$IndCodErr);
define ('INDEMN_INSUFFISANTE',         ++$IndCodErr);

$MsgErr = array();

$MsgErr [ERRCONNECT]         = '<font color="#ff0000">'
                               .'Erreur mysql_connect() de connexion &agrave; :<br /><br />'
		    			       .'</font>';
$MsgErr [ERRSELECT]         = '<font color="#ff0000">'
                              .'Erreur mysql_select_db() de s&eacute;lection de la base : '	
			                  .'</font>';							   
$MsgErr [ERRREQUEST]        = '<font color="#ff0000">'
                              .'Echec de la requ&ecirc;te :<br /><br />'			   
			                  .'</font>';
$MsgErr [LOGINUNDERSCORE]   = '<font color="#ff0000">'
                              .'Login invalide'
			                  .'</font>';
$MsgErr [LOGINCARINVAL]     = '<font color="#ff0000">'
                              .'Caract&egrave;re invalides dans le login'
			                  .'</font>';
$MsgErr [LOGINNBCARINVAL]   = '<font color="#ff0000">'
                              .'Login trop long ou trop court'
			                  .'</font>';
$MsgErr [LOGINDEJAPRIS]     = '<font color="#ff0000">'
                              .'Login d&eacute;j&agrave; attribu&eacute;'
			                  .'</font>';
$MsgErr [TUTEUR_SOC_IMPOSS] = '<font color="#ff0000">'
                              .'Ce tuteur n\'est pas dans l\'entreprise s&eacute;lectionn&eacute;e'
			                  .'</font>';
$MsgErr [STATUS_SOC_IMPOSS] = '<font color="#ff0000">'
                              .'Pour le statut de tuteur, choisir une entreprise'
			                  .'</font>';
$MsgErr [STATUS_SANS_SOC]   = '<font color="#ff0000">'
                              .'Pas d\'entreprise pour ce statut'
			                  .'</font>';
$MsgErr [SOC_ET_INFOS_SOC]  = '<font color="#ff0000">'
                              .'Une entreprise est s&eacute;lectionn&eacute;e, ne pas remplir les infos'
			                  .'</font>';
$MsgErr [NPCI_NON_NUM]      = '<font color="#ff0000">'
                              .'Caract&egrave;re non num&eacute;rique dans le champ <b>Nombre de personnes du C.I.</b>'
			                  .'</font>';
$MsgErr [NPSERVICE_NON_NUM] = '<font color="#ff0000">'
                              .'Caract&egrave;re non num&eacute;rique dans le champ <b>Nombre de personnes du service</b>'
			                  .'</font>';
$MsgErr [NBSTAG_NON_NUM]    = '<font color="#ff0000">'
                              .'Caract&egrave;re non num&eacute;rique dans le champ <b>Nombre de stagiaires pr&eacute;vus</b>'
			                  .'</font>';
$MsgErr [NBSTAG_NUL]        = '<font color="#ff0000">'
                              .'Valeur nulle dans le champ <b>Nombre de stagiaires pr&eacute;vus</b>'
			                  .'</font>';
$MsgErr [CARINVAL_IN_TEL]   = '<font color="#ff0000">'
                              .'Caract&egrave;re invalide dans un num&eacute;ro de tel. ou un fax'
			                  .'</font>';
$MsgErr [LGINVAL_IN_TEL]    = '<font color="#ff0000">'
                              .'Num&eacute;ro de tel. ou fax trop long ou trop court'
			                  .'</font>';

$MsgErr [INDEMN_INVALIDE]    = '<font color="#ff0000">'
                               .'champ <b>Indemnit&eacute;s mensuelles</b> invalide'
			                   .'</font>';
$MsgErr [INDEMN_INSUFFISANTE] = '<font color="#ff0000">'
                               .'champ <b>Indemnit&eacute;s mensuelles</b> inf&eacute;rieur au minimum l&eacute;gal de '
							   .MINIMUM_LEGAL_INDEMNITES
							   .' &euro;'
			                   .'</font>';

$MsgErr [INDEMN_REPAS_INCORRECTE]     = '<font color="#ff0000">'
                                       .'Incoh&eacute;rence dans le champ  <b>'
								       .$Msg_FormStage [MSGFORMSTAGE_INDEMN_REPAS]
								       .'</b>'
		    			               .'</font>';

$MsgErr [INDEMN_TRANSPORT_INCORRECTE] = '<font color="#ff0000">'
                                       .'Incoh&eacute;rence dans le champ  <b>'
								       .$Msg_FormStage [MSGFORMSTAGE_INDEMN_TRANSPORT]
								       .'</b>'
		    			               .'</font>';
$MsgErr [LOGICIELS_SPEC_INCORRECTS] = '<font color="#ff0000">'
                                       .'Incoh&eacute;rence dans le champ  <b>'
								       .$Msg_FormStage [MSGFORMSTAGE_LOGICIELS_SPEC]
								       .'</b>'
		    			               .'</font>';

$MsgErr [CHAMP_NON_REMPLI]     = ' est un champ obligatoire non rempli';
?>
