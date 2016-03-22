<?php
    ini_set('display_error', 1);

    $PATH_RACINE     = '../';
    $PATH_DEFINE     = $PATH_RACINE.'Constantes/';
    require_once ($PATH_DEFINE.'DEFINE.php');
/**/	if (MAXLGLOGIN == 0) {
        define ('MAXLGLOGIN', 12);    // surcharge define ('MAXLGLOGIN', 10); de site mathieu
    }

    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

    require_once ($PATH_CONSTANTES.'CstGales.php');

    // Ouverture de la session
	// =======================

/**/    $PATH_UTIL       = $PATH_RACINE.'Util/';
    require_once ($PATH_UTIL.'UtilSession.php');
    OpenSession  ($NomSession);

	// Connexion a mySQL
	// =================

    require_once ($PATH_COMMUNS.   'IdentRoot.php');
	require_once ($PATH_CONSTANTES.'CstErrBD.php');
    require_once ($PATH_UTIL.      'UtilBD.php');    // ConnectSelect(), Query()
    require_once ($PATH_UTIL.      'UtilLogin.php'); // IsEtudByLogin(), IsProfByLogin()

    $Connexion = ConnectSelect ($Hote, $User, $Passwd, $NomBase);

    $NomBaseMathieu  = "laporte";
    $UserMathieu     = "root";
    $PasswdMathieu   = $PASSWDBD;
    $HoteMathieu     = "localhost";

	$ConnectMathieu = ConnectSelect ($HoteMathieu, $UserMathieu,
	                                 $PasswdMathieu, $NomBaseMathieu);

	// Récupérations des variables envoyées par POST ou GET
	// ====================================================

    if (isset ($_SESSION))
	    foreach ($_SESSION as $clef => $valeur) $$clef = $valeur;

    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;
	$LoginProv = '';

    require_once ($PATH_UTIL.'UtilDivers.php');  // CloseWindow(), Redirect()
    require_once ($PATH_UTIL.'UtilSession.php'); // CloseSession()

/* * / CloseSessionAndRedirect ($URL_SITE); /* */
    if (IsSessionAndLoginNonVide())
    {
        // Une session est en cours et un login y est enregistré ==>
        //     connexion interdite (prévenir l'appel direct de ce script)
        //     Déconnexion ? ==> fermeture de la session et retour à l'accueil
        //     Sinon         ==> vérifier autorisation

        if ($Step == 'Decnx')
        {
            CloseSessionAndRedirect ($URL_SITE.$PATH_PHP);
        }
    }
    else
    {
        if (!isset ($Step))
            $Step = 'Accueil';
		else if ($Step == 'Cnx')
		{
            $login    = trim ($login);
            $password = trim ($password);
            if ($login == '' || $password == '')
            {
                CloseSessionAndRedirect ('',
				                         $Msg = 'Champs "login" ou "pass" non remplis');
            }
            else
			{
                if (IsEtudByLogin ($login) || IsProfByLogin ($login))
				{
				   	if (IsEtudByLogin ($login))
					{
    					$ReqWhere = " AND (FK_Statut = '".STATUTETUD2."'
 						            OR FK_Statut = '".STATUTETUD1."'
                                                      OR FK_Statut = '".STATUTETUDLP."')";
					}
					else
					{
    					$ReqWhere = " AND (FK_Statut = '".STATUTADMIN."'
						               OR FK_Statut = '".STATUTPROFIUTAIX."'
						               OR FK_Statut = '".STATUTML."')";
					}
                    $ReqUser = Query ("SELECT $NomTabUsers.* FROM $NomTabUsers WHERE Identifiant  = '$login'".$ReqWhere, $ConnectMathieu);
                    if ($NbUsers = mysql_num_rows ($ReqUser))
					{
					    // Récupération de toutes les informations utiles


					    $User = mysql_fetch_object ($ReqUser);

                        $UserPassWord      = $User->PassWord;
                        $UserNom           = $User->Nom;
                        $UserPrenom        = $User->Prenom;
                        $UserPK_User       = $User->PK_Id;

						switch ($User->FK_Statut)
						{
						  case STATUTETUD1  : $LeStatus = ETUD1;  break;
						  case STATUTETUD2  : $LeStatus = ETUD2;  break;
						  case STATUTETUDLP : $LeStatus = ETUDLP; break;
						  case STATUTPROF   : $LeStatus = PROF;   break;
						  case STATUTADMIN  : $LeStatus = ADMIN;  break;

						}
						// Ce n'est pas un tuteur =>

                        $UserFK_Entreprise = 0;
					}
                }
			    else                    // recherche dans la base "stages"
			    {
                     $ReqUser = Query ("SELECT $NomTabUsers.*, $NomTabStatus.Libelle
				                           FROM $NomTabUsers, $NomTabStatus
						    			   WHERE Login  = '$login'
							    		   AND   Status = $NomTabStatus.Code ",
						              $Connexion);
					if ($NbUsers = mysql_num_rows ($ReqUser))
					{
					    // Récupération de toutes les informations utiles

					    $User = mysql_fetch_object ($ReqUser);
						$UserPassWord      = $User->PassWord;
                        $UserNom           = $User->Nom;
                        $UserPrenom        = $User->Prenom;
                        $UserPK_User       = $User->PK_User;
						$LeStatus          = $User->Status;

						// C'est un tuteur (ou admin, resp, secr ) =>
                        $UserFK_Entreprise = $User->FK_Entreprise;
                    }
				}
			    if ($NbUsers)
				{
					if (md5 ($password) != $UserPassWord)
					{
					    $_SESSION ['LoginProv'] = $login;
                        CloseSessionAndRedirect ('',
						                         $Msg = 'Mot de passe invalide');
					}
					else
					{
                        $_SESSION ['login']             = $login;
                        $_SESSION ['Step']              = 'Consult';
                        $_SESSION ['FK_EntrepriseUser'] = $UserFK_Entreprise;
                        $_SESSION ['NomUser']           = $UserNom;
                        $_SESSION ['PrenomUser']        = $UserPrenom;
                        $_SESSION ['PK_User']           = $UserPK_User;
                        $_SESSION ['PK_UserCible']      = $UserPK_User;
	                    $_SESSION ['Status']            = $LeStatus;


                        $ReqLibStatus = Query("SELECT $NomTabStatus.Libelle FROM $NomTabStatus WHERE Code = '$LeStatus'", $Connexion);

                        $ObjLibStatus = mysql_fetch_object ($ReqLibStatus);
                        $_SESSION ['LibStatus']         = $ObjLibStatus->Libelle;
    					Redirect ('');
                    }
				}
				else
				{
                    CloseSessionAndRedirect ('', $Msg = '"login" inexistant');
				}
			}
        }
	}
	require_once ('Accueil.php');     // Accueil()
	require_once ('Consult.php');     // Consult()
    require_once ('Entete.php');
    ShowEntete();
	include ('GetDroits.php');


switch ($Step)
{
  case 'Accueil' :
	Accueil ($LoginProv);
	break;

  case 'Consult' :
    Consult ($login, $_SESSION ['LibStatus'], $Status);

    break;
}
?>
