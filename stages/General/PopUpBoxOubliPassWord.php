<?php
    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
    $Sender          = "From: marc.laporte@univ-amu.fr";

    require_once ($PATH_CONSTANTES.'DEFINE.php');
    require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_CONSTANTES.'CstMsg.php');
	
    // Connexion a mySQL
	// =================
	
    require_once ($PATH_COMMUNS.'IdentRoot.php');
    require_once ($PATH_UTIL.'UtilBD.php');
	
    $Connexion = ConnectSelect ($Hote, $User, $Passwd, $NomBase);

	require_once ($PATH_UTIL.'UtilLogin.php');
	
	$WidthDfltPopUpBoxOubliPW  = 400;
	$HeightDfltPopUpBoxOubliPW = 290;
	
	$WidthPopUpBoxOubliPW  = $WidthDfltPopUpBoxOubliPW + 10;
	$HeightPopUpBoxOubliPW = $HeightDfltPopUpBoxOubliPW;
	
	foreach ($_POST as $clef => $valeur) $$clef = $valeur;
	
	if (!isset ($StepPW)) $StepPW = 'Init';
	
	$NoErr = 1;
	if ($StepPW == 'Valid')
	{
		$RewMail = Query ("SELECT * FROM $NomTabUsers
		                       WHERE Mail = '$email'
							    AND  Login = '$login';",
						   $Connexion);
		if ($NoErr = mysql_num_rows ($RewMail))
		{
		    $ObjMail = mysql_fetch_object ($RewMail);
			$NewPassWord      = RandomPassWord ();
			$NewPassWordKrpte = md5 ($NewPassWord);
			$Message = "$ObjMail->Prenom $ObjMail->Nom,\n\nJ'ai le plaisir de vous informer que votre nouveau mot de passe est :\n\n$NewPassWord\n\n M. Laporte\nWebmestre\n$email";
			Query ("UPDATE $NomTabUsers SET PassWord = '$NewPassWordKrpte'
		                WHERE PK_User = '$ObjMail->PK_User';",
				   $Connexion);
	        mail ("marc.laporte@univ-amu.fr", 'Nouveau mot de passe', $Message, $Sender);
			$StepPW = 'MAJOK';
		} 
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 
<html> 
	<head>
		<title>Oubli du mot de passe</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<link rel="icon" type="image/x-icon" href="<?=$PATH_IMG?>favicon.ico">
		<!-- CSS -->
		<link rel="stylesheet" href="<?=$PATH_CSS?>PopUps.css" type="text/css">
		<link rel=stylesheet type=text/css href="<?=$PATH_CSS?>stages.css">
	</head>

	<body>
	<script language="JavaScript">
	<!--
		this.resizeTo ('<?=$WidthPopUpBoxOubliPW?>.', '<?=$HeightPopUpBoxOubliPW?>');
	// -->
	</script>
                                                                           <?php
                                        if ($StepPW != 'MAJOK')
										{
										                                   ?>
	<form method="post">
	<table bgcolor="#E6E6E6" border="0" cellpadding="5" cellspacing="0">
		<tr>
			<td colspan="3">
			Entrez votre login et votre adresse <nobr>e-mail</nobr> pour récupérer
			un nouveau  mot de passe.
			<br /><br />
			En validant ce formulaire, votre mot de passe sera réinitialisé et
			le nouveau mot de passe vous sera envoyé automatiquement par e-mail.
			</td>
		</tr>
		<tr>
			<td align="right"><nobr><b>Votre login</b></td>
			<td><input type="text" name="login"></td>
			<td></td>
		</tr>
		<tr>
			<td align="right"><nobr><b>Votre e-mail</b></td>
			<td><input type="text" name="email"></td>
			<td align="left"><input type="submit" value="Valider"></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><hr></td>
		</tr>
																			   <?php
												if (! $NoErr)
												{
																			   ?>
		<tr>
			<td colspan="3" align="center" style="color : red">
			   Ces informations ne correspondent à aucun utilisateur enregistré
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><hr></td>
		</tr>
																			   <?php
												}
																			   ?>
		<tr>
			<td colspan="3" align="center"><input type="submit"
				value="Fermer la fenetre"
				onClick="window.close()">
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><hr></td>
		</tr>
	</table>
	<input type="hidden" name="StepPW" value="Valid">
	</form>
																			   <?php
											}
											else
											{
																			   ?>
	<form method="post">
	<table bgcolor="#E6E6E6" border="0" cellpadding="5" cellspacing="0">
		<tr>
			<td colspan="3">
			Votre demande a bien été enregistrée.
			<br /><br />
			Votre nouveau mot de passe vous sera envoyé automatiquement par courrier électronique dans les plus brefs délais.
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input type="submit"
				value="Fermer la fenêtre"
				onClick="window.close()">
			</td>
		</tr>
	</table>
	</form>
																			   <?php
											  }
																			   ?>
	</body>
</html>

