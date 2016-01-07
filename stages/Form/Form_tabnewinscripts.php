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
    require_once ($PATH_CLASS.'CNewInscript.php');
    require_once ($PATH_CLASS.'CEntreprise.php');
    require_once ($PATH_CLASS.'CUser.php');
    require_once ($PATH_UTIL.'UtilLogin.php');
    require_once ($PATH_COMMUNS.'FctDiverses.php');
	
    if (!isset ($StepNewInscript))
        $StepNewInscript = (isset ($IdentPK) && $IdentPK != 0) 
		                                              ? 'InitModif' : 'InitNew';

	$ReqEntreprises = Query ("SELECT * FROM $NomTabEntreprises
	                              ORDER BY NomE",
	                         $Connexion);	
    $ValidPK_NewInscript  =
	
    $ValidCiviliteTuteur  =
    $ValidNomTuteur       =
    $ValidPrenomTuteur    =
    $ValidTelTuteur       =
    $ValidMailTuteur      =
    $ValidFaxTuteur       =
    $ValidLoginTuteur     =

    $ValidIs_IdemTuteur     =
    $ValidCiviliteRespAdmin =
    $ValidNomRespAdmin      =
    $ValidPrenomRespAdmin   =
    $ValidTelRespAdmin      =
    $ValidMailRespAdmin     =
    $ValidFaxRespAdmin      =
 
    $ValidNomE              =
    $ValidAdr1              =
    $ValidAdr2              =
    $ValidCP                =
    $ValidVille             = ESPACE;


    switch ($StepNewInscript)
    {
      case 'InitModif' :
      case 'InitNew'   :
	  
        // Pr�paration du nouvel enreg. ou r�cup�ration de l'enreg. � modifier

	    $ObjInscript = new CNewInscript 
		                     ($StepNewInscript == 'InitModif'  ?  $IdentPK : 0);

        $ValPK_NewInscript = $ObjInscript->GetPK_NewInscript();
		
        $ValCiviliteTuteur    = $ObjInscript->GetCiviliteTuteur();
        $ValNomTuteur         = ProtectApos ($ObjInscript->GetNomTuteur());
        $ValPrenomTuteur      = ProtectApos ($ObjInscript->GetPrenomTuteur());
        $ValTelTuteur         = $ObjInscript->GetTelTuteur();
        $ValMailTuteur        = $ObjInscript->GetMailTuteur();
        $ValFaxTuteur         = $ObjInscript->GetFaxTuteur();
        $ValIs_IdemTuteur     = $ObjInscript->GetIs_IdemTuteur();
        $ValCiviliteRespAdmin = ProtectApos ($ObjInscript->GetCiviliteRespAdmin());
        $ValNomRespAdmin      = ProtectApos ($ObjInscript->GetNomRespAdmin());
        $ValPrenomRespAdmin   = ProtectApos ($ObjInscript->GetPrenomRespAdmin());
        $ValTelRespAdmin      = $ObjInscript->GetTelRespAdmin();
        $ValMailRespAdmin     = $ObjInscript->GetMailRespAdmin();
        $ValFaxRespAdmin      = $ObjInscript->GetFaxRespAdmin();

        $ValNomE             = ProtectApos ($ObjInscript->GetNomE());
        $ValAdr1             = ProtectApos ($ObjInscript->GetAdr1());
        $ValAdr2             = ProtectApos ($ObjInscript->GetAdr2());
        $ValCP               = $ObjInscript->GetCP();
        $ValVille            = ProtectApos ($ObjInscript->GetVille());

	 $ValFK_Entreprise    = $ObjInscript->GetFK_Entreprise();

        $ValLoginTuteur      = '';

        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
	
        $ValPK_NewInscript    = $PK_NewInscript;
	 $ValFK_Entreprise     = $FK_Entreprise;
        $ValCiviliteTuteur    = $CiviliteTuteur;
        $ValCiviliteRespAdmin = $CiviliteRespAdmin;
	 $ValIs_IdemTuteur     = isset ($Is_IdemTuteur) ? $Is_IdemTuteur : 0 ;

        if (($ValNomTuteur = trim ($NomTuteur)) == '')
        {
            array_push ($CodErrVide, 'NomTuteur');
            $ValidNomTuteur = FLECHE;
        }

	 if (($ValPrenomTuteur = trim ($PrenomTuteur)) == '')
        {
            array_push ($CodErrVide, 'PrenomTuteur');
            $ValidPrenomTuteur = FLECHE;
        }
        if (($ValTelTuteur = trim ($TelTuteur)) == '')
        {
            array_push ($CodErrVide, 'TelTuteur');
            $ValidTelTuteur = FLECHE;
        }
        if (($ValMailTuteur = trim ($MailTuteur)) == '')
        {
            array_push ($CodErrVide, 'MailTuteur');
            $ValidMailTuteur = FLECHE;
        }
        $ValFaxTuteur    = $FaxTuteur;
	 if ($ValIs_IdemTuteur)
	 {
             $ValCiviliteRespAdmin =
             $ValNomRespAdmin      =
             $ValPrenomRespAdmin   =
             $ValTelRespAdmin      =
             $ValMailRespAdmin     =
             $ValFaxRespAdmin      = '';
	  }
	  else
	  {
            if (($ValNomRespAdmin = trim ($NomRespAdmin)) == '')
            {
                array_push ($CodErrVide, 'NomRespAdmin');
                $ValidNomRespAdmin = FLECHE;
            }
            if (($ValPrenomRespAdmin = trim ($PrenomRespAdmin)) == '')
            {
                array_push ($CodErrVide, 'PrenomRespAdmin');
                $ValidPrenomRespAdmin = FLECHE;
            }
            if (($ValTelRespAdmin = trim ($TelRespAdmin)) == '')
            {
                array_push ($CodErrVide, 'TelRespAdmin');
                $ValidTelRespAdmin = FLECHE;
            }
            $ValMailRespAdmin = trim ($MailRespAdmin);
		    $ValFaxRespAdmin  = trim ($FaxRespAdmin);
        }
	 if ($ValFK_Entreprise)
	 {
            $ValNomE     = '';
            $ValAdr1     = '';
            $ValAdr2     = '';
            $ValCP       = '';
            $ValVille    = '';
	 }
	 else
	 {
            if (($ValNomE = trim ($NomE)) == '')
            {
                array_push ($CodErrVide, 'NomE');
                $ValidNomE = FLECHE;
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
            $ValAdr2 = trim ($Adr2);

	 }
        // Validation du login
		
        if (($ValLoginTuteur = trim ($LoginTuteur)) == '')
        {
            array_push ($CodErrVide, 'LoginTuteur');
            $ValidLoginTuteur = FLECHE;
        }
	 else if ($Err = ErrorLogin ($LoginTuteur))
	 {
	     array_push ($CodErrInval, $Err);
            $ValidLoginTuteur = FLECHE;
        }
        if (! (count ($CodErrVide) || count ($CodErrInval)))
        {
	     if ($ValFK_Entreprise == 0)
	     {				
	         // Cr�ation d'une nouvelle entreprise
				
                $ObjSoc = new CEntreprise ();

                $ObjSoc->SetIs_Valide (1);
                $ObjSoc->SetNomE    (ProtectApos ($ValNomE));
                $ObjSoc->SetAdr1    (ProtectApos ($ValAdr1));
                $ObjSoc->SetAdr2    (ProtectApos ($ValAdr2));
                $ObjSoc->SetCP      ($ValCP);
                $ObjSoc->SetVille   (ProtectApos ($ValVille));
				
		  if ($ValIs_IdemTuteur)
		  {
		      $ValCiviliteRespAdmin = $ValCiviliteTuteur;
		      $ValNomRespAdmin      = $ValNomTuteur;
                    $ObjSoc->SetCivilite ($$ValCiviliteRespAdmin);
                    $ObjSoc->SetNomR     (ProtectApos ($ValNomTuteur));
                    $ObjSoc->SetPrenomR  (ProtectApos ($ValPrenomTuteur));
                    $ObjSoc->SetTelR     ($ValTelTuteur);
                    $ObjSoc->SetMailR    ($ValMailTuteur);
                    $ObjSoc->SetFaxR     ($ValFaxTuteur);
		  }
		  else
		  {
                    $ObjSoc->SetCivilite ($$ValCiviliteRespAdmin);
                    $ObjSoc->SetNomR     (ProtectApos ($ValNomRespAdmin));
                    $ObjSoc->SetPrenomR  (ProtectApos ($ValPrenomRespAdmin));
                    $ObjSoc->SetTelR     ($ValTelRespAdmin);
                    $ObjSoc->SetMailR    ($ValMailRespAdmin);
                    $ObjSoc->SetFaxR     ($ValFaxRespAdmin);
		  }
		  $ObjSoc->Insert();

		  // R�cup�ration de sa cl�
			
		  $ValFK_Entreprise = mysql_insert_id();
	     }
	     // Enregistrement du tuteur
			
	     $ObjUser     = new CUser ();

            $NewPassWord = RandomPassWord();
			
            $ObjUser->SetLogin          ($ValLoginTuteur);
            $ObjUser->SetPassWord       (md5 ($NewPassWord));
            $ObjUser->SetStatus         (TUTEUR);
            $ObjUser->SetCivilite       ($ValCiviliteTuteur);
            $ObjUser->SetNom            (ProtectApos ($ValNomTuteur));
            $ObjUser->SetPrenom         (ProtectApos ($ValPrenomTuteur));
            $ObjUser->SetMail           ($ValMailTuteur);
            $ObjUser->SetTel            ($ValTelTuteur);
            $ObjUser->SetFax            ($ValFaxTuteur);
            $ObjUser->SetFK_Entreprise  ($ValFK_Entreprise);
			
            $ObjUser->Insert();

	     // Suppression de l'inscription de la table
				
	     $ObjInscript = new CNewInscript ($IdentPK);

	     $ObjInscript->Delete();

	     // Enregistrement du mail � envoyer

            Query ("INSERT INTO $NomTabMailsToSend VALUES (
			    	  '$ValLoginTuteur',
				  '$NewPassWord',
				  '$ValCiviliteTuteur',
				  '".addslashes ($ValNomTuteur)."',
				  '".addslashes ($ValPrenomTuteur)."',
                              '$ValMailTuteur');",
		     $Connexion);
										                                   ?>
        <script>
            location.replace("?Trait=List&SlxTable=<?=$NomTabNewInscripts?>");
        </script>
										                                   <?php
		    die;
        }
        break;
    }
    $Titre = 'Validation d\'une inscription';
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
<p style="text-align : center; font-size : 16 px;">
Les <?=FLECHE?> indiquent qu'une rubrique est vide ou erron&eacute;e
</p>
										                                   <?php
                                        }
										                                   ?>
<form method="post"> 
<table align="center" border="0" cellpadding="2" cellspacing="0"> 
     <tr>
        <td valign="top"><?=$ValidCiviliteTuteur?></td>
        <td style="text-align : right" valign="top">
		    <b>Civilit&eacute; : </b>
		</td>
		<td>
		    M<input type="radio" name="CiviliteTuteur" value="M" checked="checked">
		    Mme<input type="radio" name="CiviliteTuteur" value="Mme" <?=$ValCiviliteTuteur == 'Mme' ? 'checked' : ''?>>
		    Mlle<input type="radio" name="CiviliteTuteur" value="Mlle" <?=$ValCiviliteTuteur == 'Mlle' ? 'checked' : ''?>>
		</td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidNomTuteur?></td>
        <td style="text-align : right" valign="top"><b>Nom</b></td>
        <td>
            <input type="text" name="NomTuteur" size="50" value="<?=$ValNomTuteur?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidPrenomTuteur?></td>
        <td style="text-align : right" valign="top"><b>Pr&eacute;nom</b></td>
        <td>
            <input type="text" name="PrenomTuteur" size="50" value="<?=$ValPrenomTuteur?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidTelTuteur?></td>
        <td style="text-align : right" valign="top"><b>Tel</b></td>
        <td>
            <input type="text" name="TelTuteur" size="50" value="<?=$ValTelTuteur?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidMailTuteur?></td>
        <td style="text-align : right" valign="top"><b>Mail</b></td>
        <td>
            <input type="text" name="MailTuteur" size="50" value="<?=$ValMailTuteur?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidFaxTuteur?></td>
        <td style="text-align : right" valign="top">Fax</td>
        <td>
            <input type="text" name="FaxTuteur" size="50" value="<?=$ValFaxTuteur?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidLoginTuteur?></td>
        <td style="text-align : right; color : red" valign="top">
		    <b>Nouveau login</b>
		</td>
        <td>
            <input type="text" name="LoginTuteur" size="50" value="<?=$ValLoginTuteur?>">
        </td>
    </tr>
	<tr>
        <td colspan="4" align="center"><hr></td>
    </tr>
	<tr>
        <td valign="top">&nbsp;</td>
        <td style="text-align : right" valign="top"><b>Entreprise</b></td>
        <td colspan="4" align="left">
		    <select name="FK_Entreprise">
                <option value="0">----------------</option>
		                                                                   <?php
		                                    while ($Obj = 
											     mysql_fetch_object ($ReqEntreprises))
										    {
		                                                                   ?>
                <option value="<?=$Obj->PK_Entreprise?>" 
				        <?=$Obj->PK_Entreprise == $ValFK_Entreprise ? 'selected' : ''?>>
				    <?=$Obj->NomE?>
				</option>
		                                                                   <?php
		                                    }
		                                                                   ?>
            </select>
        </td>
    </tr>
	<tr>
	    <td colspan="3">
            <p style="text-align : center; font-size : 11 px; font-style : italic;">
		    Si aucune entreprise n'est s�lectionn&eacute;e dans cette liste, 
			le cadre ci-dessous doit &ecirc;tre compl&eacute;t&eacute;.
			<br />&nbsp;
			</p>
		</td>
	</tr>
	<tr>
	    <td colspan="3" style="border : 1 solid Blue;">
		    <table width="100%" >
                <tr>
				    <td colspan="3" style="text-align : center">
					    Entreprise
					</td>
				</tr>
				<tr>
                    <td valign="top"><?=$ValidNomE?></td>
                    <td style="text-align : right" valign="top"><b>Raison sociale</b></td>
                    <td>
                        <input type="text" name="NomE" size="50" value="<?=$ValNomE?>">
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
				    <td colspan="3" style="text-align : center">
					    Responsable administratif
						<input type="checkbox" name="Is_IdemTuteur" value="1"
						       <?=$ValIs_IdemTuteur == 1 ? 'checked' : ''?>>
						    idem ci-dessus, sinon :
					</td>
				</tr>
     			<tr>
     			   <td valign="top"><?=$ValidCiviliteRespAdmin?></td>
     			   <td style="text-align : right" valign="top">
					    <b>Civilit&eacute; : </b>
					</td>
					<td>
					    M<input type="radio"    name="CiviliteRespAdmin" value="M" checked="checked">
					    Mme<input type="radio"  name="CiviliteRespAdmin" value="Mme" <?=$ValCiviliteRespAdmin == 'Mme' ? 'checked' : ''?>>
		   			    Mlle<input type="radio" name="CiviliteRespAdmin" value="Mlle" <?=$ValCiviliteRespAdmin == 'Mlle' ? 'checked' : ''?>>
					</td>
  			    </tr>
                <tr>
                    <td valign="top"><?=$ValidNomRespAdmin?></td>
                    <td style="text-align : right" valign="top">
					    <b>Nom</b>
					</td>
                    <td nowrap>
                        <input type="text" name="NomRespAdmin" 
						       size="50" value="<?=$ValNomRespAdmin?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?=$ValidPrenomRespAdmin?></td>
                    <td style="text-align : right" valign="top">
					    <b>Pr&eacute;nom</b></td>
                    <td>
                        <input type="text" name="PrenomRespAdmin" size="50" 
                               value="<?=$ValPrenomRespAdmin?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?=$ValidTelRespAdmin?></td>
                    <td style="text-align : right" valign="top">
					    <b>Tel</b></td>
                    <td>
                        <input type="text" name="TelRespAdmin" size="50"
						       value="<?=$ValTelRespAdmin?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?=$ValidMailRespAdmin?></td>
                    <td style="text-align : right" valign="top">
					    Mail</td>
                    <td>
                        <input type="text" name="MailRespAdmin" size="50"
						       value="<?=$ValMailRespAdmin?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?=$ValidFaxRespAdmin?></td>
                    <td style="text-align : right" valign="top">Fax</td>
                    <td>
                        <input type="text" name="FaxRespAdmin" size="50"
						       value="<?=$ValFaxRespAdmin?>">
                    </td>
                </tr>
	        </table>
		</td>
	</tr>
                                                                           <?php
                                        if (count ($CodErrInval))
										{
                                                                           ?>
	<tr>			
        <td colspan="4" style="text-align : center"><br /><hr></td>
    </tr>
                                                                           <?php
                                            for ($i = 0; $i < count ($CodErrInval); ++$i)
										    {
                                                                           ?>
	<tr>			
        <td colspan="4" style="text-align : center; color : red">
		    <?=$MsgErr [$CodErrInval [$i]]?><br />
        </td>
    </tr>
                                                                           <?php
                                            }
                                        }
                                                                           ?>
	<tr>			
        <td colspan="4" align="center"><br /><hr></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align : center">
		    <input type="button" 
		           value="Abandonner"
		           onClick="history.back()">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="Reinitialiser">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Valider">
        </td>
    </tr>
</table>
<input type="hidden" name="StepNewInscript" value="Valid">

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