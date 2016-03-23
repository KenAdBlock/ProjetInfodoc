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
	  
        // Préparation du nouvel enreg. ou récupération de l'enreg. à modifier

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
	         // Création d'une nouvelle entreprise
				
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

		  // Récupération de sa clé
			
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

	     // Enregistrement du mail à envoyer

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
<h4 class="center">
    <?=$Titre?>
</h4>
 
<p class="center">
<i>Toutes les rubriques en <b>gras</b> doivent obligatoirement être remplies</i>
</p>
										                                   <?php
                                        if ($CodErrVide || $CodErrInval)
                                        {
										                                   ?>
<p style="text-align : center; font-size : 16px;">
Les <?=FLECHE?>indiquent qu'une rubrique est vide ou erronée
</p>
										                                   <?php
                                        }
										                                   ?>
<div class="row">
<form method="post" role="form" class="col s12">
<table align="center" border="0" cellpadding="2" cellspacing="0">

     <div class="row">
         <div class="input-field col l1 m1 s1">
              <label><b><?=$ValidCiviliteTuteur?>Civilité</b></label>
         </div>
         <div class="col l6 s12 m12">
            <div class="input-field col l4 m4 s4">
                <p>
                    <input name="CiviliteTuteur" type="radio" id="CiviliteM" value="M" checked="checked" />
                     <label for="CiviliteM">M</label>
                </p>
            </div>
            <div class="input-field col l4 m4 s4">
                 <p>
                    <input name="CiviliteTuteur" type="radio" id="CiviliteMme" value="Mme" <?=$ValCiviliteTuteur == 'Mme' ? 'checked' : ''?>/>
                     <label for="CiviliteMme">Mme</label>
                 </p>
            </div>
            <div class="input-field col l4 m4 s4">
                <p>
                    <input name="CiviliteTuteur" type="radio" id="CiviliteMlle" value="Mlle" <?=$ValCiviliteTuteur == 'Mlle' ? 'checked' : ''?>  />
                    <label for="CiviliteMlle">Mlle</label>
                </p>
            </div>
         </div>
     </div>

    <div class="row">
        <div class="input-field col l6 m6 s12">
            <input name="NomTuteur" size="50" value="<?=$ValNomTuteur?>" id="NomTuteur" type="text" class="validate">
            <label for="NomTuteur"><b><?=$ValidNomTuteur?>Nom :</b></label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input name="PrenomTuteur" size="50" value="<?=$ValPrenomTuteur?>" id="PrenomTuteur" type="text" class="validate">
            <label for="PrenomTuteur"><b><?=$ValidPrenomTuteur?>Prénom : </b></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l6 m6 s12">
            <input name="TelTuteur" size="50" id="TelTuteur" type="text" class="validate" value="<?=$ValTelTuteur?>">
            <label for="TelTuteur"><b><?=$ValidTelTuteur?>Tel :</b></label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input name="MailTuteur" size="50" id="MailTuteur" type="text" class="validate" value="<?=$ValMailTuteur?>">
            <label for="MailTuteur"><b><?=$ValidMailTuteur?>Mail :</b></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l6 m6 s12">
            <input name="FaxTuteur" size="50"  id="FaxTuteur" type="text" class="validate" value="<?=$ValFaxTuteur?>">
            <label for="FaxTuteur"><?=$ValidFaxTuteur?>Fax :</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input id="LoginTuteur" type="text" class="validate" name="LoginTuteur" size="50" value="<?=$ValLoginTuteur?>">
            <label for="LoginTuteur"><b><?=$ValidLoginTuteur?>Nouveau login :</b></label>
        </div>
    </div>

    <hr><br>

    <div class="row">
        <div class="input-field col s12">
            <select name="FK_Entreprise">
                <option value="0">----------------</option>
                <?php
                while ($Obj =  mysql_fetch_object ($ReqEntreprises))
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
            <label><b>Entreprise :</b></label>
        </div>
    </div>
	<div class="row">
            <p class="center">
		    <i>Si aucune entreprise n'est sélectionnée dans cette liste,le cadre ci-dessous doit être complété.</i>
			</p>
    </div>


<table class="cadre"><tr><td>
                <h5 class="center">Entreprise</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <input name="NomE" size="50" value="<?=$ValNomE?>" id="NomE" type="text" class="validate">
                        <label for="NomE"><b><?=$ValidNomE?>Raison sociale</b></label>
                    </div>
                </div>
                    <p><i>Pour les grandes entreprises, indiquer le service</i></p>
                    <hr>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input name="Adr1" size="50" value="<?=$ValAdr1?>" id="Adr1" type="text" class="validate">
                        <label for="Adr1"><b><?=$ValidAdr1?>Adresse</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="Adr2" size="50" value="<?=$ValAdr2?>" id="Adr2" type="text" class="validate">
                        <label for="Adr2">Adresse 2</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input name="CP" size="50" value="<?=$ValCP?>" id="CP" type="text" class="validate">
                        <label for="CP"><b><?=$ValidCP?>Code postal</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="Ville" size="50" value="<?=$ValVille?>" id="Ville" type="text" class="validate">
                        <label for="Ville"><b><?=$ValidVille?>Ville</b></label>
                    </div>
                </div>
                <p>
                    <input name="Is_IdemTuteur" value="1"
                        <?=$ValIs_IdemTuteur == 1 ? 'checked' : ''?> type="checkbox" class="filled-in" id="Is_IdemTuteur"/>
                    <label for="Is_IdemTuteur">Responsable administratif</label><br>
                    idem ci-dessus, sinon :
                </p>
                <div class="row">
                    <div class="input-field col l1 m1 s1">
                        <label><b><?=$ValidCiviliteRespAdmin?>Civilité</b></label>
                    </div>
                    <div class="col l6 s12 m12">
                        <div class="input-field col l4 m4 s4">
                            <p><input name="CiviliteRespAdmin" type="radio" id="CiviliteM" value="M"  <?=$ValCiviliteRespAdmin == 'M' ? 'checked' : ''?> />
                               <label for="CiviliteM">M</label></p>
                        </div>
                        <div class="input-field col l4 m4 s4">
                            <p><input name="CiviliteRespAdmin" type="radio" id="CiviliteMme" value="Mme" <?=$ValCiviliteRespAdmin == 'Mme' ? 'checked' : ''?>/>
                               <label for="CiviliteMme">Mme</label></p>
                        </div>
                        <div class="input-field col l4 m4 s4">
                            <p><input name="CiviliteRespAdmin" type="radio" id="CiviliteMlle" value="Mlle" <?=$ValCiviliteRespAdmin == 'Mlle' ? 'checked' : ''?>  />
                               <label for="CiviliteMlle">Mlle</label></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input name="NomRespAdmin" size="50" value="<?=$ValNomRespAdmin?>" id="NomRespAdmin" type="text" class="validate">
                        <label for="NomRespAdmin"><b><?=$ValidNomRespAdmin?>Nom </b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="PrenomRespAdmin" size="50" value="<?=$ValPrenomRespAdmin?>" id="PrenomRespAdmin" type="text" class="validate">
                        <label for="PrenomRespAdmin"><b><?=$ValidPrenomRespAdmin?>Prénom </b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <input name="TelRespAdmin" size="50" value="<?=$ValTelRespAdmin?>" id="TelRespAdmin" type="text" class="validate">
                        <label for="TelRespAdmin"><b><?=$ValidTelRespAdmin?>Tel</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="MailRespAdmin" size="50" value="<?=$ValMailRespAdmin?>" id="MailRespAdmin" type="email" class="validate">
                        <label for="MailRespAdmin">Mail</label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <input name="FaxRespAdmin" size="50" value="<?=$ValFaxRespAdmin?>" id="FaxRespAdmin" type="text" class="validate">
                        <label for="FaxRespAdmin">Fax</label>
                    </div>
                </div>
                </td></tr></table>
                <br>
                                                                           <?php
                                        if (count ($CodErrInval))
										{
                                                                           ?>
                <hr>
                                                                           <?php
                                            for ($i = 0; $i < count ($CodErrInval); ++$i)
										    {
                                                                           ?>
            <div class="row">
		            <?=$MsgErr [$CodErrInval [$i]]?><br />
            </div>
                                                <?php
                                            }
                                        }
                                                                           ?>
                <hr>
                <br>

        <p class="center">
            <button type="reset" class="waves-effect waves-light btn black white-text"  onClick="history.back()">Abandonner</button>
            <button type="reset" class="waves-effect waves-light btn black white-text">Reinitialiser</button>
            <button type="submit" class="waves-effect waves-light btn bleu1 white-text">Valider</button>
        </p>

<input type="hidden" name="StepNewInscript" value="Valid">

</form>
</div>                                                                   <?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>