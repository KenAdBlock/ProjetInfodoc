<?php
    session_start();
	
	$PATH_RACINE     = '../';
	$PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
	$PATH_GIFS       = '/gif/';
	$PATH_CSS        = $PATH_RACINE.'css/';
	$PATH_JS         = $PATH_RACINE.'js/';
	$PATH_GENERAL    = $PATH_RACINE.'General/';
	$PATH_POPUPS     = $PATH_RACINE.'General/';
	$PATH_UTIL       = $PATH_RACINE.'Util/';

	include_once ($PATH_CONSTANTES.'DEFINE.php');
	include_once ($PATH_CONSTANTES.'CstGales.php');
	include_once ($PATH_CONSTANTES.'CstErr.php');
	include_once ($PATH_UTIL.      'UtilErr.php');

    // Vérification qu'il existe bien une session ouverte
	//   et qu'il existe bien un login dans la session ouverte
	include_once ($PATH_GENERAL.'AreSessionAndLogin.php');
	
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;

    // Connexion a mySQL
	
    include_once ($PATH_UTIL.'UtilBD.php');

	$UtilBD = new UtilBD();
	$ConnectStages = $UtilBD->ConnectStages();

	$WidthDfltPopUpBoxChangePW  = 550;
	$HeightDfltPopUpBoxChangePW = 530;
	
	$WidthPopUpBoxChangePW  = $WidthDfltPopUpBoxChangePW + 10;
	$HeightPopUpBoxChangePW = $HeightDfltPopUpBoxChangePW;
	
    $ArrayLibChamps ['NewPW1'] = $LibPW1 = 'Nouveau mot de passe';
    $ArrayLibChamps ['NewPW2'] = $LibPW2 = 'Le même mot de passe';

    //
	
	$CodErr       = array();
	$NomChampVide = array();
	$Indic        = array();

	if ($Step == 'Valid')
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
			$Identifiant = $_REQUEST ['IdentPK'];
		    $ReqEnreg = $ConnectStages->prepare("UPDATE $NomTabUsers SET
					  		        Pass = '$NewPWCrypte'
								WHERE PK_User = :Identifiant");
			$ReqEnreg->bindValue(':Identifiant', $Identifiant);
			$ReqEnreg->execute();
                                                                              ?>
<script language="JavaScript">
<!--
    opener.location='<?=$PATH_RACINE?>BackOffice.php?Trait=AFFICH&SlxTable=tabusers&IdentPK=<?=$Identifiant?>';
	window.close();
// -->
</script>
                                                                           <?php
			die;
		}
	}
?>
<html> 
<head> 

<title>Changement de mot de passe</title> 

<LINK REL=STYLESHEET TYPE=text/css HREF="<?php $PATH_CSS?>stages.css">
        
</head> 
<body>

<script language="JavaScript">
<!--
    this.resizeTo ('<?=$WidthPopUpBoxChangePW?>.',  
                   '<?=$HeightPopUpBoxChangePW?>');
// -->
</script>

<h1>Changement de mot de passe</h1>

<form method="post"> 
<table align="center" border="0" cellpadding="2" cellspacing="0"> 
    <tr>
		<br /><b>Attention </b>: 
		<ul><li>le mot de passe doit comporter entre <b><?=MINLGPASSWD?></b> et <b><?=MAXLGPASSWD?></b> chiffres ou lettres (majuscules ou minuscules sauf le <b>ç</b>, et sans accent),
</li><li>les <b>majuscules et les minuscules</b> sont considérées comme des <b>caractères différents</b>.
</li></ul>
		</td>
	</tr>
	<tr>
	    <td nowrap valign="top"><?=$Indic ['NewPW1']?></td> 
	    <td align="right"><nobr><b><?=$LibPW1?></b> <sup>*</sup></nobr></td>
		<td><input type="password" name="NewPW1"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	    <td nowrap valign="top"><?=$Indic ['NewPW2']?></td> 
	    <td align="right"><nobr><b><?=$LibPW2?></b> <sup>*</sup></nobr></td>
		<td><input type="password" name="NewPW2"></td>
		<td align="left"><input type="submit" value="Valider"></td>
	</tr>
	<tr>
        <td colspan="4" align="left"
		    ><blockquote><sup>*</sup><small>Choisissez un mot de passe composé de <b><?=MINLGPASSWD?></b> à
			 <b><?=MAXLGPASSWD?></b> lettres <br />&nbsp; (majuscules ou minuscules <b>sans accents</b>) ou chiffres</small></blockquote>
<hr></td>
    </tr>
                                                                           <?php
                                        if (count ($CodErr))
										{
                                                                           ?>
    <tr>
        <td colspan="4">
                                                                           <?php										
                                            while ($Code = array_pop ($CodErr))
                                                if ($Code == $ERRCHAMPNONREMPLI)
                                                    PrintMsgErr (MsgErrNonInit (array_pop ($NomChampVide)));
                                                else
                                                    PrintMsgErr ($TextMsgErr [$Code]);
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
        <td colspan="4" align="center"><input type="submit" 
		    value="Fermer la fenetre"
		    onClick="window.close()"></td>
    </tr>
	<tr>
        <td colspan="4" align="center"><hr></td>
    </tr>
</table>
<input type="hidden" name="Step" value="Valid">
</form>

</body> 
</html>

