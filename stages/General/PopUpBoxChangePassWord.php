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

    // Ouverture de la session
	// =======================
	
    OpenSession  ($NomSession);

	?>
    <script>if (! window.opener) location.replace ("<?=$PATH_RACINE?>index.php")</script>
    <?php

    // Vérification qu'il existe bien une session ouverte

	//   et qu'il existe bien un login dans la session ouverte
	
	OpenedSessionAndLoginNonVideIsOK ($JS_HistoryBack);

    // Connexion a mySQL
	// =================
	
	
    $Connexion = ConnectSelect ($Hote, $User, $Passwd, $NomBase);

    // ========================================================================== //

    // Récupération des valeurs transmises par POST et par GET

	
    foreach ($_GET  as $clef => $valeur) $$clef = htmlspecialchars ($valeur);
    foreach ($_POST as $clef => $valeur) $$clef = htmlspecialchars ($valeur);
	
	$WidthDfltPopUpBoxChangePW  = 550;
	$HeightDfltPopUpBoxChangePW = 530;
	
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
		    $ReqEnreg = Query ("UPDATE $NomTabUsers SET
					  		        Password = '$NewPWCrypte'
							    WHERE Login = '$login'",
						    $Connexion);
            CloseWindow();
		    die;
		}
	}
?>
<html> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title>Changement de mot de passe</title> 

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link href="<?=$PATH_CSS?>materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
            	<span class="card-title"><h5 class="center">Changement de mot de passe</h5></span> 
<form method="post"> 
<table align="center" border="0" cellpadding="2" cellspacing="0"> 
    <tr>
	    <td colspan="4">
		    <br /><b>Attention </b>: 
		    <ul><li>le mot de passe doit comporter entre <b><?=MINLGPASSWD?></b> 
		    et <b><?=MAXLGPASSWD?></b> chiffres ou lettres (majuscules ou 
		    minuscules sauf le <b>ç</b>, et sans accent),

            </li><li>
		    les <b>majuscules et les minuscules</b> sont considérées comme des
		     <b>caractères différents</b>.

            </li></ul>
		</td>
	</tr>
	<tr>
	    <td nowrap valign="top"><?=$Indic ['NewPW1']?></td> 
	    <td align="right"><nobr><b><?=$LibPW1?></b> <sup>*</sup></nobr></td>
		<td colspan="4"><div class="input-field col s12"><input type="password" name="NewPW1" id="NewPW1">
		</div></td>

	</tr>
	<tr>
	    <td nowrap valign="top"><?=$Indic ['NewPW2']?></td> 
	    <td align="right"><nobr><b><?=$LibPW2?></b> <sup>*</sup></nobr></td>
		<td colspan="4"><div class="input-field col s12"><input type="password" name="NewPW2">
		</div></td>

		
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td>
	<td colspan="4" align="right"><button class="btn waves-effect waves-light white-text blue" type="submit">Valider</button></td>
<td>&nbsp;</td></tr>
	
	<tr>
        <td colspan="4" align="left"
		    ><blockquote><sup>*</sup>
			 <small>Choisissez un mot de passe composé de
			 <b><?=MINLGPASSWD?></b> à
			 <b><?=MAXLGPASSWD?></b> lettres <br />&nbsp; (majuscules ou
			 minuscules <b>sans accents</b>) ou chiffres</small></blockquote>
             <hr>
		</td>
    </tr>
                                                                           <?php
                                        if (count ($CodErr))
										{
                                                                           ?>
    <tr>
        <td colspan="4">
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
        </td>
    </tr>
	<tr>
        <td colspan="4" align="center"><hr>
		</td>
	</tr>
                                                                           <?php
                                        }
                                                                           ?>
	<tr>
        <td class="center" colspan="4" align="center">
		    <button class="btn waves-effect waves-light white-text blue" type="submit" 
		           
		           onClick="window.close()">Fermer la fenetre</button></td>
    </tr>
	<tr>
        <td colspan="4" align="center"><hr></td>
    </tr>
</table>
<input type="hidden" name="StepChPwd" value="Valid">
</form>
</div>
          </div>
        </div>
      </div>
      <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?=$PATH_JS?>materialize.js"></script>
  <script src="<?=$PATH_JS?>init.js"></script>
</body> 
</html>

