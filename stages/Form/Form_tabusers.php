<?php
    function ProtectApos ($String)
    {
        $NewString = "";
        $String = str_split ($String);
        
        for ($i = 0; $i < count ($String); ++$i)
        {
            if ($String [$i] == "'")
                $NewString .= "&apos;";
            else
                $NewString .= $String [$i];
        }
        return $NewString;
        
    } // ProtectApos()

if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    require_once ($PATH_CLASS.'CUser.php');
    require_once ($PATH_UTIL.'UtilLogin.php');
    require_once ($PATH_COMMUNS.'FctDiverses.php');

	$ReqStatus      = Query ("SELECT * FROM $NomTabStatus",     
	                         $Connexion);
	$ReqEntreprises = Query ("SELECT NomE, PK_Entreprise 
	                              FROM $NomTabEntreprises
								  ORDER BY NomE",
	                         $Connexion);
    if (! GetDroits ($Status, 'ModifUser')) $IdentPK = $_SESSION ['PK_User'];
	
    if (!isset ($StepConsult))
        $StepConsult = (isset ($IdentPK) && $IdentPK != 0) ? 'InitModif' : 'InitNew';

    $ValidPK_User       =
    $ValidLogin         =

    $ValidCivilite      =
    $ValidNom           =
    $ValidPrenom        =
    $ValidMail          =
    $ValidTel           =
    $ValidFax           =
    $ValidFK_Entreprise = ESPACE;

    switch ($StepConsult)
    {
      case 'InitModif' :
      case 'InitNew'   :
	  
        // Pr&eacute;paration du nouvel enreg. ou r&eacute;cup&eacute;ration de l'enreg. � modifier

	    $ObjTuple = new CUser ($StepConsult == 'InitModif'? $IdentPK : 0);

        $ValPK_User       = $ObjTuple->GetPK_User();
        $ValLogin         = $ObjTuple->GetLogin();
        $ValPassWord      = $ObjTuple->GetPassWord();
        $ValStatus        = $ObjTuple->GetStatus();
        $ValCivilite      = $ObjTuple->GetCivilite();
        $ValNom           = $ObjTuple->GetNom();
        $ValPrenom        = $ObjTuple->GetPrenom();
        $ValMail          = $ObjTuple->GetMail();
        $ValTel           = $ObjTuple->GetTel();
        $ValFax           = $ObjTuple->GetFax();
        $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
        $ValPK_User  = $PK_User;
        $ValCivilite = $Civilite;

        if (($ValNom = trim ($Nom)) == '')
        {
            array_push ($CodErrVide, 'Nom');
            $ValidNom = FLECHE;
        }
		if (($ValPrenom = trim ($Prenom)) == '')
        {
            array_push ($CodErrVide, 'Prenom');
            $ValidPrenom = FLECHE;
        }
        if (($ValTel = trim ($Tel)) == '')
        {
            array_push ($CodErrVide, 'Tel');
            $ValidTel = FLECHE;
        }
		else if ($Err = NormaliserTel (&$ValTel))
		{
		    array_push ($CodErrInval, $Err);
            $ValidTel = FLECHE;
		}
        if (($ValMail = trim ($Mail)) == '')
        {
            array_push ($CodErrVide, 'Mail');
            $ValidMail = FLECHE;
        }
        if (($ValFax = trim ($Fax)) != '' && ($Err = NormaliserTel (&$ValFax)))
		{
		    array_push ($CodErrInval, $Err);
            $ValidFax = FLECHE;
		}

        // Validation du Login
		
		$ValLogin    = trim ($Login);
		$ValPassWord = trim ($PassWord);
        if ($IdentPK == 0)
		{
		    if (($ValLogin = trim ($Login)) == '')
            {
                array_push ($CodErrVide, 'Login');
                $ValidLogin = FLECHE;
            }
            else if ($Err = ErrorLogin ($ValLogin))
            {
		        array_push ($CodErrInval, $Err);
                $ValidLogin = FLECHE;
			}
        }
		$ValFK_Entreprise = $FK_Entreprise;
		if (($ValStatus = $StatusUser) == TUTEUR && 
		     $ValFK_Entreprise == 0)
        {
		    array_push ($CodErrInval, STATUS_SOC_IMPOSS);
            $ValidStatus        =
            $ValidFK_Entreprise = FLECHE;
        }
		if (($ValStatus = $StatusUser) != TUTEUR && 
		     $ValFK_Entreprise != 0)
        {
		    array_push ($CodErrInval, STATUS_SANS_SOC);
            $ValidStatus        =
            $ValidFK_Entreprise = FLECHE;
        }
        if (! ($CodErrVide || $CodErrInval))
        {
            // Pr�paration de l'enregistrement

            $ObjTuple = new CUser ();
			
            $ObjTuple->SetPK_User       ($ValPK_User);
            $ObjTuple->SetLogin         ($ValLogin);
            $ObjTuple->SetStatus        ($ValStatus);
            $ObjTuple->SetCivilite      ($ValCivilite);
            $ObjTuple->SetNom           (ProtectApos ($ValNom));
            $ObjTuple->SetPrenom        (ProtectApos ($ValPrenom));
            $ObjTuple->SetMail          ($ValMail);
            $ObjTuple->SetTel           ($ValTel);
            $ObjTuple->SetFax           ($ValFax);
            $ObjTuple->SetFK_Entreprise ($ValFK_Entreprise);
            
            if ($IdentPK == 0)
			{
                $NewPassWord = RandomPassWord();
                $ObjTuple->SetPassWord (md5 ($NewPassWord));
                $ObjTuple->Insert();
				
				// Enregistrement du mail � envoyer
				
				Query ("INSERT INTO $NomTabMailsToSend VALUES (
			    	  	   '$ValLogin',
				 	       '$NewPassWord',
				 	       '$ValCivilite',
				 	       '$ValNom',
				 	       '$ValPrenom',
                  	       '$ValMail');",
			            $Connexion);
			}
            else
            {
			    $ObjTuple->SetPassWord ($ValPassWord);
                $ObjTuple->Update();
			}
            if (GetDroits ($Status, 'ListeUsers'))
			{
                                                                           ?>
<script>location.replace("?Trait=List&SlxTable=<?=$NomTabUsers?>");</script>
                                                                           <?php
			}
			else
			{
                                                                           ?>
<script>location.replace("?Trait=Affich&SlxTable=<?=$NomTabUsers?>");</script>
                                                                           <?php
			}
        }
        break;
    }
                                        if ($IdentPK)
									    {
										                                   ?>
<h1>Modification de l'utilisateur <?=$ValPK_User?></h1>
                                                                           <?php
                                        }
                                        else
                                        {
                                                                           ?>
<h1>Cr&eacute;ation d'un nouvel utilisateur </h1>
                                                                           <?php
                                        }
										                                   ?>
<p style="text-align : center; font-size : 11 px; font-style : italic;">
Toutes les rubriques en <b>gras</b> doivent obligatoirement &ecirc;tre remplies
</p>

										                                   <?php
                                        if ($CodErrVide || $CodErrInval)
                                        {
										                                   ?>
<p style="text-align : center; font-size : 16 px;">
Les <?=FLECHE?> indiquent qu'une rubrique est vide ou erron&eacute;e
</p>
										                                   <?php
                                        }
										                                   ?>
<?php /*
<form method="post" action="<?=$PATH_GENERAL?>Generalites.php" target="principal"> 
*/ ?>
<form method="post"> 
<table align="center" border="0" cellpadding="2" cellspacing="0"> 
     <tr>
        <td valign="top"><?=$ValidCivilite?></td>
        <td style="text-align : right" valign="top">
		    <b>Civilit&eacute; : </b>
		</td>
		<td>
		    M<input type="radio" name="Civilite" value="M" checked="checked">
		    Mme<input type="radio" name="Civilite" value="Mme" <?=$ValCivilite == 'Mme' ? 'checked' : ''?>>
		    Mlle<input type="radio" name="Civilite" value="Mlle" <?=$ValCivilite == 'Mlle' ? 'checked' : ''?>>
		</td>
    </tr>
   <tr>
        <td valign="top"><?=$ValidNom?></td>
        <td style="text-align : right" valign="top"><b>Nom</b></td>
        <td>
            <input type="text" name="Nom" size="50" value="<?=$ValNom?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidPrenom?></td>
        <td style="text-align : right" valign="top"><b>Pr&eacute;nom</b></td>
        <td>
            <input type="text" name="Prenom" size="50" value="<?=$ValPrenom?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidTel?></td>
        <td style="text-align : right" valign="top"><b>Tel</b></td>
        <td>
            <input type="text" name="Tel" size="50" value="<?=$ValTel?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidMail?></td>
        <td style="text-align : right" valign="top"><b>Mail</b></td>
        <td>
            <input type="text" name="Mail" size="50" value="<?=$ValMail?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidFax?></td>
        <td style="text-align : right" valign="top">Fax</td>
        <td>
            <input type="text" name="Fax" size="50" value="<?=$ValFax?>">
        </td>
    </tr>
			                                                               <?php
										if ($IdentPK == 0)
										{
                                                                           ?>
    <tr>
        <td valign="top"><?=$ValidLogin?></td>
        <td style="text-align : right; color : red" valign="top">
		    <b>Nouveau login</b>
		</td>
        <td>
            <input type="text" name="Login" size="50" value="<?=$ValLogin?>">
        </td>
    </tr>
			                                                               <?php
										}
										else
										{
                                                                           ?>
			<input type="hidden" name="Login" value="<?=$ValLogin?>">														   
			                                                               <?php
										}
										if ($StepConsult == 'InitNew' || 
										     GetDroits ($Status, 'ModifUser'))
										{
                                                                           ?>



    <tr>
        <td><?=$ValidStatus?></td>
		<td style="text-align : right" valign="top"><b>Statut</b></td>
		<td>
		    <select name="StatusUser">
			                                                               <?php
			                                while ($ObjStatus = mysql_fetch_object ($ReqStatus))
										    {
                                                                           ?>
                <option value="<?=$ObjStatus->Code?>" 
				        <?=$ObjStatus->Code == $ValStatus ? 'selected' : ''?>>
				    <?=$ObjStatus->Libelle?>
				</option>
			                                                               <?php
			                                }
                                                                           ?>
			</select>
		</td>
	</tr>
    <tr>
        <td><?=$ValidFK_Entreprise?></td>
		<td style="text-align : right; valign="top">
		    Pour un tuteur, pr&eacute;ciser l'<b>entreprise</b>
		</td>
		<td>
		    <select name="FK_Entreprise">
                <option value="0"
				        <?=$ValFK_Entreprise == 0 ? 'selected' : ''?>
				    >----------------
				</option>
			                                                               <?php
			                                while ($ObjSoc = mysql_fetch_object ($ReqEntreprises))
										    {
                                                                           ?>
                <option value="<?=$ObjSoc->PK_Entreprise?>" 
				        <?=$ObjSoc->PK_Entreprise == $ValFK_Entreprise ? 'selected' : ''?>>
				    <?=$ObjSoc->NomE?>
				</option>
			                                                               <?php
			                                }
                                                                           ?>
			</select>
		</td>
    </tr>
			                                                               <?php
										}
										else
										{
                                                                           ?>

<input type="hidden" name="StatusUser"    value="<?=$ValStatus?>">
<input type="hidden" name="FK_Entreprise" value="<?=$ValFK_Entreprise?>">
    		                                                               <?php
										}
                                        if (count ($CodErrInval))
										{
                                                                           ?>
	<tr>			
        <td colspan="3" style="text-align : center"><br /><hr></td>
    </tr>
                                                                           <?php
                                            for ($i = 0; $i < count ($CodErrInval); ++$i)
										    {
                                                                           ?>
	<tr>			
        <td colspan="3" style="text-align : center; color : red">
		    <?=$MsgErr [$CodErrInval [$i]]?><br />
        </td>
    </tr>
                                                                           <?php
                                            }
                                        }
                                                                           ?>
	<tr>			
        <td colspan="3" align="center"><br /><hr></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align : center">
            <input type="button" value="Abandonner"
                    onClick="history.go (-1)">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="Reinitialiser">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Valider" >
        </td>
    </tr>
</table>
</td></tr></table>
<input type="hidden" name="StepConsult" value="Valid" >
<input type="hidden" name="PK_User" value="<?=$ValPK_User?>" >
<input type="hidden" name="PassWord" value="<?=$ValPassWord?>" >
</form>
                                                                           <?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez acc&eacute;der directement &agrave; cette page</h2>
<?php
}
?>