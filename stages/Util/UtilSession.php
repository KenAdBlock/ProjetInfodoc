<?php
    // Fichier UtilSessions.php
	//
	// Utilitaires concernant les sessions et le login associ�
    // 
	// Dans ce site, une session n'est valide que si la variable 'login' y est
	//   enregistr�e (sauf justement pendant que le client se connecte !)
	//
	// CloseSession(), CloseSessionAndRedirect(), OpenSession(), PurgeSession(), 
	// IsOpenedSession(), IsSessionAndLoginNonVide(), 
	// IsOKSessionAndLoginObligatoires(), OpenedSessionAndLoginNonVideIsOK()
	// IsLoginNonVideInSession(),
	//
/*
IsOKOpenedSessionAndLoginNonVide()
================================
// V�rification qu'il existe bien une session ouverte 
//   et qu'il existe bien un login NON VIDE dans la session ouverte
//   Dans le premier cas, la fen�tre est referm�e
//   Dans le second cas, redirection vers l'URL pass�e en param�tre 
//       (la Home Page, en principe)

IsOKSessionAndLoginObligatoires()
===============================
// Termine le script et redirige vers l'URL pass�e en param�tre 
//   (en principe la page d'accueil) si aucune session 
//   n'est ouverte  ou s'il n'existe pas de 'login' non vide dans 
//   la session ouverte

IsOpenedSession()
===============
// V�rification qu'une session est ouverte 
//   et qu'il existe un login VIDE OU NON dans la session ouverte

IsLoginNonVideInSession() 
=======================
// V�rification que le 'login' de la session ouverte est NON VIDE

IsSessionAndLoginNonVide() 
========================
// V�rification qu'une session est ouverte
//   et qu'il existe un 'login' NON VIDE dans la session ouverte
 
PurgeSession()
============
// D�truit toutes les variables de session
	
*/
require_once ($PATH_UTIL.'UtilDivers.php');

// D�truit toutes les variables de session
//		
function PurgeSession()
//       ============
{
    $_SESSION = array();

} // PurgeSession()
	
function CloseSession ()
//       ============
{
    PurgeSession();
	if (isset ($_COOKIE [session_name()])) 
        setcookie (session_name(), '', time()-42000, '/');

    // Finalement, on détruit la session.

    session_destroy();

} // CloseSession()

function CloseSessionAndRedirect ($URL, $Msg = '')
//       =======================
{
    CloseSession ();
	
	                                    if ($Msg != '')
		                                {
	                                                                       ?>
     <script type="text/javascript">alert ('<?=$Msg?>')</script>
	                                                                       <?php
                                        }
     die ('<meta http-equiv="refresh" content="0;URL='.$URL.'">');

} // CloseSessionAndRedirect()

function OpenSession ($SessionName)
//       ===========
{
    session_name  ($SessionName);
	session_start ();

} // OpenSession()
	
// Vérification qu'une session DU SITE est ouverte
//   et qu'il existe un login (vide ou pas) dans la session ouverte
//
function IsOpenedSession()
//       ===============
{
    return isset ($_SESSION) && isset ($_SESSION ['login']);
	 
} // IsOpenedSession()

// V�rification que le 'login' de la session ouverte est non vide
//
function IsLoginNonVideInSession() 
//       =======================
{
    return '' != $_SESSION ['login'];
	
} // IsLoginNonVideInSession()

// V�rification si une session est ouverte
//   et s'il existe un 'login' non vide dans la session ouverte
//   
function IsSessionAndLoginNonVide() 
//       ========================
{
    return IsOpenedSession () && IsLoginNonVideInSession();
	
} // IsSessionAndLoginNonVide()
 
// Termine le script et redirige vers l'URL pass�e en param�tre 
//   (en principe la page d'accueil) si aucune session 
//   n'est ouverte  ou s'il n'existe pas de 'login' non vide dans 
//   la session ouverte
//
function DebutSession()
{
    if ($_SESSION ['login'] == 'casnic.10') $_SESSION ['Statut'] = ADMIN;
    
    ConstrDroits ();

} // DebutSession()

function IsOKSessionAndLoginObligatoires(
//       ===============================
	                  $URL, $Message = "Connexion pr�alable n�cessaire") 
{
	if (IsSessionAndLoginNonVide()) return true;
		
	PurgeSession();
			                                                               ?>
    <script type="text/javascript">
		alert ("<?=$Message?>");
	</script>
	                                                                       <?php
    Redirect ($URL);
    die;
		
} // IsOKSessionAndLoginObligatoires()

// V�rification qu'il existe bien une session ouverte 
//   et qu'il existe bien un login NON VIDE dans la session ouverte
//   Dans le premier cas, la fen�tre est referm�e
//   Dans le second cas, redirection vers l'URL pass�e en param�tre 
//       (la Home Page, en principe)

function OpenedSessionAndLoginNonVideIsOK ($URL)
//       ================================
{
    global $IsConnected;
	
	if (IsOpenedSession() && IsLoginNonVideInSession())
	{
	    $IsConnected = true;
		return true;
	}
	return false;
	
} // OpenedSessionAndLoginNonVideIsOK()

?>
