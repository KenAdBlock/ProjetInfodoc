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
    require_once ($PATH_CLASS.'CEntreprise.php');
    require_once ($PATH_COMMUNS.'FctDiverses.php');

    if (! GetDroits ($Status, 'ModifEntreprise')) $IdentPK = $_SESSION ['FK_EntrepriseUser'];

    if (!isset ($StepConsult))
        $StepConsult = (isset ($IdentPK) && $IdentPK != 0) 
		                                              ? 'InitModif' : 'InitNew';

    $ValidPK_Entreprise     =
    $ValidCivilite          =
    $ValidNomE              =
    $ValidNomR              =
    $ValidPrenomR           =
    $ValidAdr1              =
    $ValidAdr2              =
    $ValidCP                =
    $ValidVille             =
    $ValidTelR              =
    $ValidMailR             =
    $ValidFaxR              =
    $ValidPresentEntreprise =
    $ValidSiteEntreprise    = ESPACE;

    switch ($StepConsult)
    {
      case 'InitModif' :
      case 'InitNew'   :
	  
        // Pr�paration du nouvel enreg. ou r�cup�ration de l'enreg. � modifier

	    $ObjTuple = new CEntreprise 
		                         ($StepConsult == 'InitModif'  ?  $IdentPK : 0);

        $ValPK_Entreprise = $ObjTuple->GetPK_Entreprise();
		
        $ValNomE              = $ObjTuple->GetNomE();
        $ValCivilite          = $ObjTuple->GetCivilite();
        $ValNomR              = $ObjTuple->GetNomR();
        $ValPrenomR           = $ObjTuple->GetPrenomR();
        $ValAdr1              = $ObjTuple->GetAdr1();
        $ValAdr2              = $ObjTuple->GetAdr2();
        $ValCP                = $ObjTuple->GetCP();
        $ValVille             = $ObjTuple->GetVille();
        $ValTelR              = $ObjTuple->GetTelR();
        $ValMailR             = $ObjTuple->GetMailR();
        $ValFaxR              = $ObjTuple->GetFaxR();
        $ValPresentEntreprise = $ObjTuple->GetPresentEntreprise();
		if (trim ($ObjTuple->GetSiteEntreprise()) == 'http://' )
			 $ObjTuple->SetSiteEntreprise('');
        $ValSiteEntreprise    = $ObjTuple->GetSiteEntreprise();
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
		
		// Champs non valid�s
		
        $ValPK_Entreprise     = $PK_Entreprise;
        $ValAdr2              = $Adr2;
        $ValMailR             = $MailR;
        $ValFaxR              = $FaxR;
        $ValPresentEntreprise = $PresentEntreprise;
	    if (trim ($SiteEntreprise) == 'http://' )
			 $SiteEntreprise = '';
        $ValSiteEntreprise    = $SiteEntreprise;
			
		// Champs valid�s
		
		$ValNomE = trim ($NomE);
        if (! GetDroits ($Status, 'ModifEntreprise'))
		    $ValidNomE = ESPACE;
		else if ($ValNomE == '')
        {
            array_push ($CodErrVide, 'NomE');
            $ValidNomE = FLECHE;
        }
        $ValCivilite = $Civilite;
        if (($ValNomR = trim ($NomR)) == '')
        {
            array_push ($CodErrVide, 'NomR');
            $ValidNomR = FLECHE;
        }
        if (($ValPrenomR = trim ($PrenomR)) == '')
        {
            array_push ($CodErrVide, 'PrenomR');
            $ValidPrenomR = FLECHE;
        }
        if (($ValAdr1 = trim ($Adr1)) == '')
        {
            array_push ($CodErrVide, 'Adr1');
            $ValidAdr1 = FLECHE;
        }
        if (($ValCP = trim ($CP)) == '')
        {
            array_push ($CodErrVide, 'CP');
            $ValidCP = FLECHE;
        }
        if (($ValVille = trim ($Ville)) == '')
        {
            array_push ($CodErrVide, 'Ville');
            $ValidVille = FLECHE;
        }
        if (($ValTelR = trim ($TelR)) == '')
        {
            array_push ($CodErrVide, 'TelR');
            $ValidTelR = FLECHE;
        }
		else if ($Err = NormaliserTel ($ValTelR))
		{
		    array_push ($CodErrInval, $Err);
            $ValidTelR = FLECHE;
		}
        $ValMailR = trim ($MailR);
        if (($ValFaxR = trim ($FaxR)) != '' && ($Err = NormaliserTel ($ValFaxR)))
		{
		    array_push ($CodErrInval, $Err);
            $ValidFaxR = FLECHE;
		}
        if (! count ($CodErrVide))
        {
            // Validation des valeurs des attributs 
        }
        if (! ($CodErrVide  || $CodErrInval))
        {
            $ObjTuple = new CEntreprise     ();
            $ObjTuple->SetPK_Entreprise     ($ValPK_Entreprise);
            $ObjTuple->SetNomE              (ProtectApos ($ValNomE));
            $ObjTuple->SetCivilite          ($ValCivilite);
            $ObjTuple->SetNomR              (ProtectApos ($ValNomR));
            $ObjTuple->SetPrenomR           (ProtectApos ($ValPrenomR));
            $ObjTuple->SetAdr1              (ProtectApos ($ValAdr1));
            $ObjTuple->SetAdr2              (ProtectApos ($ValAdr2));
            $ObjTuple->SetCP                ($ValCP);
            $ObjTuple->SetVille             (ProtectApos ($ValVille));
            $ObjTuple->SetTelR              ($ValTelR);
            $ObjTuple->SetMailR             ($ValMailR);
            $ObjTuple->SetFaxR              ($ValFaxR);
            $ObjTuple->SetPresentEntreprise ($ValPresentEntreprise);
			
			if (substr ($ValSiteEntreprise, 0, 7) != 'http://')
			    $ValSiteEntreprise = 'http://'.$ValSiteEntreprise;
            $ObjTuple->SetSiteEntreprise    ($ValSiteEntreprise);

            if ($ValPK_Entreprise == 0)
                $ObjTuple->Insert();
            else 
			    $ObjTuple->Update();
                                                                       ?>
        <script>location.replace("?Trait=List&SlxTable=<?=$NomTabEntreprises?>");</script>
                                                                       <?php
			die;
        }
        break;
    }
    if ($IdentPK == 0)
		$Titre = 'Cr&eacute;ation d\'une nouvelle entreprise';
    else
		$Titre = 'Modification de l\'entreprise '.$IdentPK;
										                                ?>
<h1>
    <?=$Titre?>
</h1>
 
<p style="text-align : center; font-size : 11 px; font-style : italic;">
Toutes les rubriques en <b>gras</b> doivent obligatoirement &ecirc;tre remplies
</p>
										                                   <?php
                                        if ($CodErrVide || $CodErrInval)
                                        {
										                                   ?>
<p style="text-align : center; font-size : 16 px;">Les
<?=FLECHE?> indiquent qu'une rubrique est vide ou erron&eacute;e</p>
										                                   <?php
                                        }
										                                   ?>
<form method="post">
<table align="center" border="1"><tr><td>
<table cellpadding="2">
										                                   <?php
										if ($ValPK_Entreprise)
										{
										                                   ?>
    <tr>
        <td valign="top"><?=$ValidPK_Entreprise?></td>
        <td style="text-align : right" valign="top"><b>Num&eacute;ro</b></td>
        <td>
            <?=$ValPK_Entreprise?>
        </td>
    </tr>
										                                   <?php
                                        }
										                                   ?>
    <tr>
        <td valign="top"><?=$ValidNomE?></td>
        <td style="text-align : right" valign="top"><b>Raison Sociale</b></td>
        <td>
										                                   <?php
										if ($StepConsult == 'InitNew' || 
									        GetDroits ($Status, 'ModifEntreprise'))
										{
										                                   ?>
            <input type="text" name="NomE" size="50" value="<?=$ValNomE?>">
										                                   <?php
                                        }
										else
										{
										                                   ?>
            <?=$ValNomE?>
            <input type="hidden" name="NomE" size="50" value="<?=$ValNomE?>">
										                                   <?php
                                        }
										                                   ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align : center; font-size : 11 px; 
		                       font-style : italic;">
            Pour les grandes entreprises, indiquer le service
			<hr>
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidAdr1?></td>
        <td style="text-align : right" valign="top"><b>Adresse</b></td>
        <td>
            <input type="text" name="Adr1" size="50" value="<?=$ValAdr1?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidAdr2?></td>
        <td style="text-align : right" valign="top">Adresse 2</td>
        <td>
            <input type="text" name="Adr2" size="50" value="<?=$ValAdr2?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidCP?></td>
        <td style="text-align : right" valign="top"><b>Code postal</b></td>
        <td>
            <input type="text" name="CP" size="50" value="<?=$ValCP?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidVille?></td>
        <td style="text-align : right" valign="top"><b>Ville</b></td>
        <td>
            <input type="text" name="Ville" size="50" value="<?=$ValVille?>">
        </td>
    </tr>
    <tr>
        <td valign="top" colspan="3">Responsable administratif</td>
    </tr>
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
        <td valign="top"><?=$ValidNomR?></td>
        <td style="text-align : right" valign="top">
		    <b>Nom : </b>
		</td>
        <td>
            <input type="text" name="NomR" size="50" value="<?=$ValNomR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidPrenomR?></td>
        <td style="text-align : right" valign="top">
		    <b>Pr&eacute;nom : </b>
		</td>
        <td>
            <input type="text" name="PrenomR" size="50" 
                   value="<?=$ValPrenomR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidTelR?></td>
        <td style="text-align : right" valign="top"><b>Tel. : </b></td>
        <td>
            <input type="text" name="TelR" size="50" value="<?=$ValTelR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidMailR?></td>
        <td style="text-align : right" valign="top">Mail : </td>
        <td>
            <input type="text" name="MailR" size="50" value="<?=$ValMailR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidFaxR?></td>
        <td style="text-align : right" valign="top">Fax : </td>
        <td>
            <input type="text" name="FaxR" size="50" value="<?=$ValFaxR?>">
        </td>
    </tr>



    <tr>
        <td valign="top"><?=$ValidPresentEntreprise?></td>
        <td style="text-align : right" valign="top">
		    Pr&eacute;sentation de l'entreprise :
		</td>
        <td>
            <textarea name="PresentEntreprise" cols="60" rows="5"
			    ><?=stripslashes ($ValPresentEntreprise)?></textarea>
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidSiteEntreprise?></td>
        <td style="text-align : right" valign="top">
		    URL du site de l'entreprise :
		</td>
        <td>
            <input type="text" name="SiteEntreprise" 
			       size="50" value="<?=$ValSiteEntreprise?>">
        </td>
    </tr>
                                                                           <?php
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
            <input type="submit" 
                   value="Valider" >
        </td>
    </tr>
</table>
</td></tr></table>
<input type="hidden" name="StepConsult" value="Valid" >
<input type="hidden" name="PK_Entreprise" value="<?=$ValPK_Entreprise?>" >
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

