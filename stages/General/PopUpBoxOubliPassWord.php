<?php
    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
//    $Sender          = "From: marc.laporte@univ-amu.fr";
    $Sender          = "From: darkweizer@gmail.com";

    require_once ($PATH_CONSTANTES.'DEFINE.php');
    require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_CONSTANTES.'CstMsg.php');
	
    // Connexion a mySQL
	// =================
	
    require_once ($PATH_COMMUNS.'IdentRoot.php');
    require_once ($PATH_UTIL.'UtilBD.php');
	
    $ConnectStages = ConnectSelect ($Hote, $User, $Passwd, $NomBase);

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
						   $ConnectStages);
		if ($NoErr = mysql_num_rows ($RewMail))
		{
		    $ObjMail = mysql_fetch_object ($RewMail);
			$NewPassWord      = RandomPassWord ();
			$NewPassWordKrpte = md5 ($NewPassWord);
			$Message = "$ObjMail->Prenom $ObjMail->Nom,\n\nJ'ai le plaisir de vous informer que votre nouveau mot de passe est :\n\n$NewPassWord\n\n M. Laporte\nWebmestre\n$email";
			Query ("UPDATE $NomTabUsers SET PassWord = '$NewPassWordKrpte'
		                WHERE PK_User = '$ObjMail->PK_User';",
				   $ConnectStages);
//	        mail ("marc.laporte@univ-amu.fr", 'Nouveau mot de passe', $Message, $Sender);
	        mail ("darkweizer@gmail.com", 'Nouveau mot de passe', $Message, $Sender);
			$StepPW = 'MAJOK';
		} 
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 
<html> 
<<<<<<< HEAD
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Oubli du mot de passe</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?=$PATH_CSS?>materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?=$PATH_CSS?>style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

		<link rel="icon" type="image/x-icon" href="<?=$PATH_IMG?>favicon.ico">


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
<<<<<<< HEAD
<div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card grey lighten-4 z-depth-1">
            <div class="card-content">
              <span class="card-title"><h5 class="center">Mot de passe oublié</h5></span> 
<form method="post"> 
<p>
		Entrez votre login et votre adresse <nobr>e-mail</nobr> pour récupérer
		un nouveau  mot de passe. 
</p><br>
<p>
		En validant ce formulaire, votre mot de passe sera réinitialisé et
		le nouveau mot de passe vous sera envoyé automatiquement par e-mail.
</p>
<div class="input-field col s12">
<i class="material-icons prefix">account_circle</i>
		<input type="text" name="login" id="login">
		<label for="login">Votre login</label>
	</div>
<div class="input-field col s12">
	<i class="material-icons prefix">email</i>
		<input type="text" name="email" id="email">
		<label for="email">Votre e-mail</label>
</div>
<p class="center">
		<button class="btn waves-effect waves-light white-text blue" type="submit">Valider</button>
		</p>

                                                                           <?php
                                            if (! $NoErr)
										    {
										                                   ?>
<hr>
		   <p class="red-text">
		   	Ces informations ne correspondent à aucun utilisateur enregistré
		   </p>

                                                                           <?php
                                            }
											                               ?>																		   

<input type="hidden" name="StepPW" value="Valid">
</form>
</div>
          </div>
        </div>
      </div>
    </div>
    
                                                                           <?php
                                        }
										else
										{
										                                   ?>
<form method="post">
<div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card grey lighten-4 z-depth-1">
            <div class="card-content">
            	<p>Votre demande a bien été enregistrée.</p>
		
		<br />
		<p>Votre nouveau mot de passe vous sera envoyé automatiquement par courrier électronique dans les plus brefs délais.</p>
<br><p class="center"><button class="btn waves-effect waves-light white-text blue" type="submit" 
		    onClick="window.close()">Fermer la fenêtre</button></p>


</div>
          </div>
        </div>
      </div>
    </div>
    </form>
                                                                           <?php
                                          }
										                                   ?>
<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?=$PATH_JS?>materialize.js"></script>
  <script src="<?=$PATH_JS?>init.js"></script>
</body> 
</html>

