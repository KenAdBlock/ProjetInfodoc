<?php
		header("Location:log.php"); // redirection si OK

/*
require_once('connexion.php'); //identifiants de connexion � la BD.

session_start(); // d�but de session
if (isset($_POST['login']))
{ 
	$login = $_POST['login']; // mise en variable du nom d'utilisateur
	$pass = md5($_POST['pass']); // mise en variable du mot de passe crypt�
	
// requete sur la table administrateurs (on r�cup�re les infos de la personne)
    mysql_select_db($NomBase);
    $verif_query=sprintf("SELECT * FROM tabusers WHERE login='$login' AND pass='$pass'"); // requ�te sur la base administrateurs
    $verif = mysql_query($verif_query) or die(mysql_error());
    $row_verif = mysql_fetch_assoc($verif);
    $utilisateur = mysql_num_rows($verif);

	
	if ($utilisateur) // On teste s'il y a un utilisateur correspondant
    {
	    session_register("authentification"); // enregistrement de la session
        
		// d�claration des variables de session
		$_SESSION['privilege'] = $row_verif['Privilege'];
		$_SESSION['NomS'] = $row_verif['Nom'];
		$_SESSION['PrenomS'] = $row_verif['Prenom'];
		$_SESSION['Login'] = $row_verif['Login'];
		header("Location:log.php"); // redirection si OK
    }
	else //Si l'utilisateur n'est pas reconnu
    {
		header("Location:log.php?erreur=login");
	}
}
// Gestion de la d�connexion
if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout')
{
    session_unset("authentification");//on tue la session
    header("Location:stages.html");  // puis on revient � l'accueil
}
/*                */

?>
<html>

<head>
<base target="principal">
<meta name="Microsoft Theme" content="laverne 111">
<meta name="Microsoft Border" content="none">
</head>

<body background="_themes/laverne/lvbkgnd.jpg" bgcolor="#FFFFFF" text="#000000" link="#006666" vlink="#666666" alink="#FF66CC">

<?php /*    * /
<p></p><p></p>
<form target ="_top" action="" method="post" name="connect">
  <p align="center" <strong>
  
      <!-- Si l'utilisateur n'est pas reconnu -->
      <? if(isset($_GET['erreur']) && ($_GET['erreur'] == "login"))
      { ?>
           <span>Erreur ! login ou pass incorrect, veuillez recommencer</span>        <? } ?>

      <!-- Si aucune session n'est ouverte ou que les droits sont
      insuffisants pour afficher une page -->
      <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) 
      { ?>
           <span>Echec d'authentification : Aucune session n'est ouverte</span>
           <span>ou vous n'avez pas les droits pour afficher cette page </span>
      <?php } ?>
  </strong></p>
  
  <div align="center">
  <p align ="center">
  <? if(!isset($_GET['erreur'])) { ?>
    Si vous avez d�j� un login 
  <? } ?>
    
  </p>
    <table width="100" border="0" cellpadding="0" cellspacing="0" bordercolor="# 
CCCCCC">
      <tr>
        <td><table width="100"  border="0" cellpadding="5" cellspacing="0" bgco 
lor="#eeeeee">
          <tr>
            <td width="50%"><span>login</span></td>
            <td width="50%"><input name="login" type="text" id="login" size="10"></td>
          </tr>
          <tr>
            <td width="50%"><span>pass</span></td>
            <td width="50%"><input name="pass" type="password" id="pass" size="10"></td>
          </tr>
          <tr>
            <td height="34" colspan="2"><div align="center">
                <input type="submit" name="Submit" value="Se connecter">
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table>

</form>

/*                 */ ?>
</body>
</html>
