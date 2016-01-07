<?php
    // fichier UtilForm.php
    //
    // Utilitaires pour la (d�)-connexion
    // 
    //   GenerSendPassWord(), IsAdmin(), RandomPassWord(), GetStatutByLogin()
	//
    //   IsAdmin(), IsML(), IsEtud1(), IsEtud2(), IsEtud()
//
// G�n�ration d'un mot de passe al�atoire
//
function RandomPassWord ($MaxLg = MAXLGPASSWD)
{
    $LesCaracteres  = "AabBCDEFcdefghGHJKijkmLMNnPQRSTUVWXYpqrsZtwxyz23456789"; //caract�res possibles
	$NbCarPossibles = strlen ($LesCaracteres);
    srand ((double) microtime() * 1000000);
/**/	$NewPassWord = "";
    for ($i = $MaxLg; $i--; ) $NewPassWord .= $LesCaracteres [rand() % $NbCarPossibles]; 
    return $NewPassWord;
	
} // RandomPassWord()

function GenerSendPassWord ($Login) 
{
	global $MonEMail, $Connexion;

	/* Chargement des infos de l'utilisateur */
	
	$ReqUser = Query ("SELECT EMail FROM tabusers WHERE Login = '$Login'",
	                  $Connexion);
	
	$Obj = mysql_fetch_object ($ReqUser);

	/* initialise le mot de passe */

	$NewPassWord       = RandomPassWord();
	$NewPassWordCrypte = md5 ($NewPassWord);

	/*echo $nouveau_mot_passe;*/

/**/	$ReqUpdate = Query ("UPDATE tabusers SET mot_passe = PASSWORD('$NewPassWord') WHERE nom_utilisateur = '$nom_utilisateur'");

	/* envoie par email */

	$Msg = 'Votre nouveau mot de passe est : '.$NewPassWord;
	
	mail ($Obj->EMail, 'Nouveau mot de passe', $Msg, "From: $MonEMail");

} // GenerPassWord()

function GetStatutByLogin (&$CodeBin)
{
    global $NomTabUsers, $NomTabStatuts, $Connexion;
	
	$CodeBin = 0;
    if (! isset ($_SESSION ['login']) || $_SESSION ['login'] == '') return '';

	$LoginSession = $_SESSION ['login'];
	$ReqUser = Query ("SELECT $NomTabUsers.*, $NomTabStatuts.Statut, 
	                          $NomTabStatuts.CodeBin
	                   FROM $NomTabUsers, $NomTabStatuts
		    	       WHERE $NomTabUsers.FK_Statut = $NomTabStatuts.PK_Statut
			    		 AND $NomTabUsers.Identifiant = '$LoginSession'",
	                  $Connexion);
	if (mysql_num_rows ($ReqUser) != 1) return '';
	
    $ObjUser = mysql_fetch_object ($ReqUser);
	
	$CodeBin = $ObjUser->CodeBin;

	return $ObjUser->Statut;

} // GetStatutByLogin()

function IsAdmin      () { return $_SESSION ['Statut'] == ADMIN;      }
function IsML         () { return $_SESSION ['Statut'] == ML;         }
function IsProfIUTAix () { return $_SESSION ['Statut'] == PROFIUTAIX; }
function IsProfIUT    () { return $_SESSION ['Statut'] == PROFIUT;    }
function IsEnseignant () { return $_SESSION ['Statut'] == ENSEIGNANT; }
function IsAncien     () { return $_SESSION ['Statut'] == ANCIEN;     }
function IsEtud1      () { return $_SESSION ['Statut'] == ETUD1;      }
function IsEtud2      () { return $_SESSION ['Statut'] == ETUD2;      }

function IsEtud       () { return IsEtud1() || IsEtud2();             }
?>
