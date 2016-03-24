<?php
    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
    $PATH_UTIL       = $PATH_RACINE.'Util/';
    $PATH_COMMUNS    = $PATH_RACINE.'Communs/';

    require_once ($PATH_CONSTANTES.'DEFINE.php');
    require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_CONSTANTES.'CstMsg.php');
    require_once ($PATH_UTIL.'UtilSession.php');
    require_once ($PATH_UTIL.'UtilBD.php');
    require_once ($PATH_UTIL.'UtilErr.php'); // ValidChampRempli(), ValidPassWord(), 

    require_once ($PATH_COMMUNS.'IdentRoot.php');

	$Title = "Changement de mot de passe";

    // Ouverture de la session
	// =======================
	
    OpenSession  ($NomSession);

	?>
<script xmlns="http://www.w3.org/1999/html">if (! window.opener) location.replace ("<?=$PATH_RACINE?>index.php")</script>
    <?php

    // Vérification qu'il existe bien une session ouverte

	//   et qu'il existe bien un login dans la session ouverte
	
	OpenedSessionAndLoginNonVideIsOK ($JS_HistoryBack);

    // Connexion a mySQL
	// =================


	$UtilBD = new UtilBD();
	$ConnectStages = $UtilBD->ConnectStages();

    // ========================================================================== //

    // Récupération des valeurs transmises par POST et par GET

	
    foreach ($_GET  as $clef => $valeur) $$clef = htmlspecialchars ($valeur);
    foreach ($_POST as $clef => $valeur) $$clef = htmlspecialchars ($valeur);
	
	$WidthDfltPopUpBoxChangePW  = 640;
	$HeightDfltPopUpBoxChangePW = 670;
	
	$WidthPopUpBoxChangePW  = $WidthDfltPopUpBoxChangePW + 10;
	$HeightPopUpBoxChangePW = $HeightDfltPopUpBoxChangePW;
	
    $ArrayLibChamps ['NewPW1'] = $LibPW1 = 'Nouveau mot de passe';
    $ArrayLibChamps ['NewPW2'] = $LibPW2 = 'Le meme mot de passe';
    //
	
	$CodErr       = array();
	$NomChampVide = array();
	$Indic        = array();

	if ($StepChPwd == 'Valid')
	{
        // Validation
		
		foreach ($ArrayLibChamps as $key => $value)
		    $Indic [$key]  = ESPACE;

        if (ValidChampRempli ('NewPW1', $NewPW1, $NomChampVide, $Indic))
	        ValidPassWord ('NewPW1', $NewPW1, $Indic);

        ValidChampRempli ('NewPW2', $NewPW2, $NomChampVide, $Indic);

		if (count ($CodErr) == 0)
    	    if ($NewPW1 != $NewPW2)
			{
				array_push ($CodErr, $ERR2PASSWDDIFF);
			    $Indic ['NewPW2'] = FLECHE;		
			}
 		if (count ($CodErr) == 0)
        {        
		    $NewPWCrypte = md5 ($NewPW1);
			$login       = $_SESSION ['login'];
			$ReqEnreg = $ConnectStages->prepare("UPDATE $NomTabUsers SET
					  		        Password = '$NewPWCrypte'
							    WHERE Login = :login");
			$ReqEnreg->bindValue(':login', $login);
			$ReqEnreg->execute();
            CloseWindow();
		    die;
		}
	}
?>
<html> 
	<head>
        <title><?=$Title?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="icon" type="image/x-icon" href="<?=$PATH_IMG?>favicon.ico">
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="<?=$PATH_CSS?>style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
	<body>
	
		<script language="JavaScript">
		<!--
			this.resizeTo ('<?=$WidthPopUpBoxChangePW?>.',  
						   '<?=$HeightPopUpBoxChangePW?>');
		// -->
		</script>
		
		<div class="container">
			<div class="row">
				<div class="col s12">
					<div class="card grey lighten-4 z-depth-1">
						<div class="card-content">
							<span class="card-title"><h5 class="center">Changement de mot de passe </h5></span>
							<form method="POST">
									<p>
										<b>Attention </b>
									</p>
	
									<ul><li>le mot de passe doit comporter entre <b><?=MINLGPASSWD?></b>
											et <b><?=MAXLGPASSWD?></b> chiffres ou lettres (majuscules ou
											minuscules sauf le <b>ç</b>, et sans accent),
										</li><li>
											les <b>majuscules et les minuscules</b> sont considérées comme des
											<b>caractères différents</b>.
										</li></ul>
	
									<div class="row">
										<div class="input-field col s12">
											<input id="NewPW1" type="password" name="NewPW1" >
											<label for="NewPW1"><?=$Indic ['NewPW1']?>&nbsp;<nobr><?=$LibPW1?><sup>*</sup></nobr></label>
										</div>
										<div class="input-field col s12">
											<input id="NewPW2" type="password" name="NewPW2" >
											<label for="NewPW2"><?=$Indic ['NewPW2']?>&nbsp;<nobr><?=$LibPW2?><sup>*</sup></nobr></label>
										</div>
									</div>
									<div class="center">
										<button type="submit" class="waves-effect waves-light btn bleu1 white-text">Valider</button>
									</div>
						<div class="input-field col s12">
							<hr>
							<blockquote><sup>*</sup>
							<small>Choisissez un mot de passe composé de
								<b><?=MINLGPASSWD?></b> à
								<b><?=MAXLGPASSWD?></b> lettres <br />&nbsp;
								(majuscules ou minuscules <b>sans accents</b>) ou chiffres</small></blockquote>
							<hr><br></div>
							<?php
							if (count ($CodErr))
							{
							?>

							<?php
							while ($Code = array_pop ($CodErr))
							{
								print ('$Code = '.$Code.'<br />');
								if ($Code == $ERRCHAMPNONREMPLI)
									PrintMsgErr (MsgErrNonInit (array_pop ($NomChampVide)));
								else
									PrintMsgErr ($TextMsgErr [$Code]);
							}
							?>
								<?php
								while ($Code = array_pop ($CodErr))
								{
									print ('$Code = '.$Code.'<br />');
									if ($Code == $ERRCHAMPNONREMPLI)
										PrintMsgErr (MsgErrNonInit (array_pop ($NomChampVide)));
									else
										PrintMsgErr ($TextMsgErr [$Code]);
								}
								?>
									<?php
								}
								?>
								<p class="center">
									<button type="submit" class="waves-effect waves-light btn black white-text"
										onClick="window.close()">Fermer la fenetre</button>
								</p>
								<input type="hidden" name="StepChPwd" value="Valid">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<!--  Scripts-->
		<script src="<?=$URL_SITE.$PATH_JQUERY?>jquery-2.2.1.min.js"></script>
		<script src="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.js"></script>
		<script src="<?=$PATH_JS?>init.js"></script>
	</body> 
</html>

