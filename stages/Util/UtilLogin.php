<?php
    // fichier UtilForm.php
    //
    // Utilitaires pour la (dé)-connexion
    // 
    //   GenerSendPassWord(), IsAdmin(), RandomPassWord(), GetStatutByLogin()
	//
    //   IsAdmin(), IsML(), IsEtud1(), IsEtud2(), IsEtud()
//
// Génération d'un mot de passe aléatoire
//
function RandomPassWord ($MaxLg = MAXLGPASSWD)
{
    $LesCaracteres  = "AabBCDEFcdefghGHJKijkmLMNnPQRSTUVWXYpqrsZtwxyz23456789"; //caractères possibles
	$NbCarPossibles = strlen ($LesCaracteres);
    srand ((double) microtime() * 1000000);
/**/	$NewPassWord = "";
    for ($i = $MaxLg; $i--; ) $NewPassWord .= $LesCaracteres [rand() % $NbCarPossibles]; 
    return $NewPassWord;
	
} // RandomPassWord()

function GenerSendPassWord ($Login) 
{
	global $MonEMail, $ConnectStages;

	/* Chargement des infos de l'utilisateur */
	
	$ReqUser = $ConnectStages->query("SELECT EMail FROM tabusers WHERE Login = '$Login'");
	$Obj = $ReqUser->fetch();

	/* initialise le mot de passe */

	$NewPassWord       = RandomPassWord();
	$NewPassWordCrypte = md5 ($NewPassWord);

	/*echo $nouveau_mot_passe;*/

/**/	$ConnectStages->query("UPDATE tabusers SET mot_passe = PASSWORD('$NewPassWord') WHERE nom_utilisateur = '$nom_utilisateur'");

	/* envoie par email */

	$Msg = 'Votre nouveau mot de passe est : '.$NewPassWord;
	
	mail ($Obj['EMail'], 'Nouveau mot de passe', $Msg, "From: $MonEMail");

} // GenerPassWord()

function GetStatutByLogin (&$CodeBin)
{
    global $NomTabUsers, $NomTabStatuts, $ConnectStages;
	
	$CodeBin = 0;
    if (! isset ($_SESSION ['login']) || $_SESSION ['login'] == '') return '';

	$LoginSession = $_SESSION ['login'];
	$ReqUser = $ConnectStages->prepare("SELECT $NomTabUsers.*, $NomTabStatuts.Statut, 
	                          $NomTabStatuts.CodeBin
	                   FROM $NomTabUsers, $NomTabStatuts
		    	       WHERE $NomTabUsers.FK_Statut = $NomTabStatuts.PK_Statut
			    		 AND $NomTabUsers.Identifiant = :LoginSession");
	$ReqUser->bindValue(':LoginSession', $LoginSession);
	$ReqUser->execute();
	if ($ReqUser->rowCount() != 1) return '';
	
    $ObjUser = $ReqUser->fetch();
	
	$CodeBin = $ObjUser['CodeBin'];

	return $ObjUser['Statut'];

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

function IsEtudByLogin  ($login) { return strlen ($login) ==  6;      }
function IsProfByLogin  ($login) { return strpos ($login, '.') === 1; }

?>
