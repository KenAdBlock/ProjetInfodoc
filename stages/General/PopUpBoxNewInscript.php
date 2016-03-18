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

    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

    require_once ($PATH_CONSTANTES.'DEFINE.php');
    require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_CONSTANTES.'CstMsg.php');
	
    // Connexion a mySQL
	// =================
	
    require_once ($PATH_COMMUNS.'IdentRoot.php');
    require_once ($PATH_UTIL.'UtilBD.php');
	
    $Connexion = ConnectSelect ($Hote, $User, $Passwd, $NomBase);

    //

	$ReqEntreprises = Query ("SELECT * FROM $NomTabEntreprises
	                              ORDER BY NomE",
	                         $Connexion);	
    //
	
	$CodErr       = array();

    require_once ($PATH_UTIL.'UtilErr.php');
	
	include_once ($PATH_CLASS.'CNewInscript.php');

    // Récupération des variables envoyées par POST ou GET

    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;
	
    if (!isset ($StepNewInscript)) $StepNewInscript = 'Init';

    $ValidCiviliteTuteur    =
	$ValidNomTuteur         =
	$ValidPrenomTuteur      =
	$ValidTelTuteur         =
	$ValidMailTuteur        =
	$ValidFaxTuteur         =

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
	$ValidVille             =

    $ValidFK_Entreprise     = ESPACE;

    switch ($StepNewInscript)
    {
      case 'Init' :
        // Préparation du nouvel enreg.

        $ObjTuple = new CNewInscript ();
		
        $ValPK_NewInscript = $ObjTuple->GetPK_NewInscript();
        
        $ValidPK_NewInscript = ESPACE;

        $ValCiviliteTuteur    = $ObjTuple->GetCiviliteTuteur();
        $ValNomTuteur         = ProtectApos ($ObjTuple->GetNomTuteur());
        $ValPrenomTuteur      = ProtectApos ($ObjTuple->GetPrenomTuteur());
        $ValTelTuteur         = $ObjTuple->GetTelTuteur();
        $ValMailTuteur        = $ObjTuple->GetMailTuteur();
        $ValFaxTuteur         = $ObjTuple->GetFaxTuteur();

        $ValIs_IdemTuteur     = $ObjTuple->GetIs_IdemTuteur();
        $ValCiviliteRespAdmin = $ObjTuple->GetCiviliteRespAdmin();
        $ValNomRespAdmin      = ProtectApos ($ObjTuple->GetNomRespAdmin());
        $ValPrenomRespAdmin   = ProtectApos ($ObjTuple->GetPrenomRespAdmin());
        $ValTelRespAdmin      = $ObjTuple->GetTelRespAdmin();
        $ValMailRespAdmin     = $ObjTuple->GetMailRespAdmin();
        $ValFaxRespAdmin      = $ObjTuple->GetFaxRespAdmin();

        $ValFK_Entreprise   = $ObjTuple->GetFK_Entreprise();

		$Title = 'Nouvelle inscription';

        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
		
        $ValIs_IdemTuteur  = isset ($Is_IdemTuteur) ? $Is_IdemTuteur : 0;
        $ValCiviliteTuteur = $CiviliteTuteur;

		// Validation du tuteur
	
        if (($ValNomTuteur = trim ($NomTuteur)) == '')
        {
            array_push ($CodErrVide, 'Nom');
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
        $ValFaxTuteur     = $FaxTuteur;
        $ValFK_Entreprise = $FK_Entreprise;

	// Validation du responsable administratif
	if ($ValFK_Entreprise || $ValIs_IdemTuteur)
	{
	    $ValCiviliteRespAdmin =
	    $ValNomRespAdmin      =
	    $ValPrenomRespAdmin   =
	    $ValTelRespAdmin      =
	    $ValMailRespAdmin     =
		$ValFaxRespAdmin      = '';
	} 
	if ($ValFK_Entreprise	  )
		$ValIs_IdemTuteur     = 0;
	else if ($ValIs_IdemTuteur)
		$ValIs_IdemTuteur   = 1;
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
	$ValCiviliteRespAdmin = $CiviliteRespAdmin;
	$ValNomE  = trim ($NomE);
	$ValAdr1  = trim ($Adr1);
	$ValAdr2  = trim ($Adr2);
	$ValCP    = trim ($CP);
	$ValVille = trim ($Ville);

	// Validation de l'entreprise

	if ($ValFK_Entreprise == 0)
	{
            if ($ValNomE == '')
            {
                array_push ($CodErrVide, 'NomE');
                $ValidNomE = FLECHE;
            }
            if ($ValAdr1 == '')
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
	 }
        else
	     {
		   if ($ValNomE  != '') $ValidNomE  = FLECHE;	
		   if ($ValAdr1  != '') $ValidAdr1  = FLECHE;	
		   if ($ValAdr2  != '') $ValidAdr2  = FLECHE;	
		   if ($ValCP    != '') $ValidCP    = FLECHE;	
		   if ($ValVille != '') $ValidVille = FLECHE;	
		   if ($ValNomE  != '' || 
			$ValAdr1  != '' || 
			$ValAdr2  != '' || 
			$ValCP    != '' || 
			$ValVille != '')
		   {
			 $ValidFK_Entreprise = FLECHE;	
		        array_push ($CodErrInval, SOC_ET_INFOS_SOC);
		   }	
	     }

	     $Title = 'Validation';
		
	     if (!$CodErrVide)
            {			
            	  // Préparation de l'enreg. à enregistrer

                $ObjTuple = new CNewInscript ();
			
                $ObjTuple->SetCiviliteTuteur ($ValCiviliteTuteur);
                $ObjTuple->SetNomTuteur      (ProtectApos ($ValNomTuteur));
                $ObjTuple->SetPrenomTuteur   (ProtectApos ($PrenomTuteur));
                $ObjTuple->SetTelTuteur      ($ValTelTuteur);
                $ObjTuple->SetMailTuteur     ($ValMailTuteur);
                $ObjTuple->SetFaxTuteur      ($ValFaxTuteur);
			
                $ObjTuple->SetIs_IdemTuteur     ($ValIs_IdemTuteur);
                $ObjTuple->SetCiviliteRespAdmin ($ValCiviliteRespAdmin);
                $ObjTuple->SetNomRespAdmin      (ProtectApos ($ValNomRespAdmin));
                $ObjTuple->SetPrenomRespAdmin   (ProtectApos ($PrenomRespAdmin));
                $ObjTuple->SetTelRespAdmin      ($ValTelRespAdmin);
                $ObjTuple->SetMailRespAdmin     ($ValMailRespAdmin);
                $ObjTuple->SetFaxRespAdmin      ($ValFaxRespAdmin);

                $ObjTuple->SetNomE  (ProtectApos ($ValNomE));
                $ObjTuple->SetAdr1  (ProtectApos ($ValAdr1));
                $ObjTuple->SetAdr2  (ProtectApos ($ValAdr2));
                $ObjTuple->SetCP    ($ValCP);
                $ObjTuple->SetVille (ProtectApos ($ValVille));
			
                $ObjTuple->SetFK_Entreprise ($ValFK_Entreprise);
            
                $ObjTuple->Insert();
                $StepNewInscript = 'Ack';
			
    		  // Envoyer un mail au responsable des stages
		  // =========================================

		  $Sujet   = 'Nouvel inscrit pour stage';
		  $Message = 'Inscription de :   '.
		             $ValCiviliteTuteur.' '.$ValPrenomTuteur.'   '.$ValNomTuteur.'    à valider';
                $Dest    =  $MailResponsableStages;

		  if ($MachineHote == INFODOC) mail ($Dest, $Sujet, $Message);
			 
		  $Title = 'Accuse d\'inscription';
            }

	     break;
	}
	$WidthDfltPopUpNewInscript  = 650;
	$HeightDfltPopUpNewInscript = ($StepNewInscript == 'Ack' ? 300 : 730);

	$WidthPopUpNewInscript  = $WidthDfltPopUpNewInscript + 10;
	$HeightPopUpNewInscript = $HeightDfltPopUpNewInscript;
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
        this.resizeTo ('<?=$WidthPopUpNewInscript?>',
                       '<?=$HeightPopUpNewInscript?>');
    // -->
    </script>
                                                                           <?php
			                            switch ($StepNewInscript) 
										{
										  case 'Ack' : 
										                                   ?>
    Votre inscription a bien été enregistrée et nous vous en remercions.

    Vous recevrez dans les plus brefs délais un login et un mot de passe pour vous permettre d'entrer les caractéristiques du stage que vous proposez.

<br /><br />
<div style="text-align : right">
<?=$NomResponsableStages?>
<br />
Responsable des stages
</div>
<div style="text-align : center">
<input type="button" value="Fermer la fenêtre"
       onClick="window.close()">
</div>

                                                                           <?php
			                                break;
										   
										  default : 
										                                   ?>

<div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card grey lighten-4 z-depth-1">
            <div class="card-content">
              <span class="card-title"><h4 class="center">Stage proposé par :</h4></span> 
              
              <p class="center"><i>Toutes les rubriques <b>*</b> doivent obligatoirement être remplies</i></p>
                                                                        <?php
                                            if ($CodErrVide) 
                                            { 
                                                                           ?>

<p style="text-align : center; font-size : 12 px;">
    Les <?=FLECHE?> indiquent qu'une rubrique est vide ou erronée

</p> 
                                                                           <?php 
                                            } 
                                                                           ?>
              <div class="row">
                <form method="POST" role="form" class="col s12">
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="NomTuteur" size="50" value="<?=$ValNomTuteur?>" id="NomTuteur" type="text" class="validate">
                      <label for="NomTuteur"><b><?=$ValidNomTuteur?>Nom *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="PrenomTuteur" size="50" value="<?=$ValPrenomTuteur?>" id="PrenomTuteur" type="text" class="validate">
                      <label for="PrenomTuteur"><b><?=$ValidPrenomTuteur?>Prénom *</b></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      <select>
                        <option name="CiviliteTuteur" value="M">M</option>
                        <option name="CiviliteTuteur" value="Mme">Mme</option>
                        <option name="CiviliteTuteur" value="Mlle">Mlle</option>
                      </select>
                      <label><b>&nbsp;Civilité *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="MailTuteur" size="50" value="<?=$ValMailTuteur?>" id="MailTuteur" type="email" class="validate">
                      <label for="MailTuteur"><b><?=$ValidMailTuteur?>Mail *</b></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="TelTuteur" size="50" value="<?=$ValTelTuteur?>" id="TelTuteur" type="text" class="validate">
                      <label for="TelTuteur"><b><?=$ValidTelTuteur?>Tel *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      <input name="FaxTuteur" size="50" value="<?=$ValFaxTuteur?>" id="FaxTuteur" type="text" class="validate">
                      <label for="FaxTuteur">Fax</label>
                    </div>
                  </div>
                  <hr><br>
                  <div class="row">
                    <div class="input-field col s12">
                      <select name="FK_Entreprise">
                          <option value="0">Choisissez</option>
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
                      <label><b>Entreprise *</b></label>
                    </div>
                  </div>
                  <p><i>Si votre entreprise n'apparaît pas dans cette liste, veuillez compléter le cadre ci-dessous.</i></p><br>

                  <h5 class="center">Entreprise</h5>
                  <div class="row">
                    <div class="input-field col s12">
                      
                      <input name="NomE" size="50" value="<?=$ValNomE?>" id="NomE" type="text" class="validate">
                      <label for="NomE"><b><?=$ValidNomE?>Raison sociale *</b></label>
                    </div>
                  </div>
                  <p><i>Pour les grandes entreprises, indiquer le service</i></p>
                  <hr>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="Adr1" size="50" value="<?=$ValAdr1?>" id="Adr1" type="text" class="validate">
                      <label for="Adr1"><b><?=$ValidAdr1?>Adresse *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      <input name="Adr2" size="50" value="<?=$ValAdr2?>" id="Adr2" type="text" class="validate">
                      <label for="Adr2">&nbsp;Adresse 2</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="CP" size="50" value="<?=$ValCP?>" id="CP" type="text" class="validate">
                      <label for="CP"><b><?=$ValidCP?>Code postal *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="Ville" size="50" value="<?=$ValVille?>" id="Ville" type="text" class="validate">
                      <label for="Ville"><b><?=$ValidVille?>Ville *</b></label>
                    </div>
                  </div>
                  <p>
                    <input name="Is_IdemTuteur" value="1"
                   <?=$ValIs_IdemTuteur == 1 ? 'checked' : ''?> type="checkbox" class="filled-in" id="Is_IdemTuteur"/>
                    <label for="Is_IdemTuteur">Responsable administratif</label><br>
                    idem ci-dessus, sinon :
                  </p>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="NomRespAdmin" size="50" value="<?=$ValNomRespAdmin?>" id="NomRespAdmin" type="text" class="validate">
                      <label for="NomRespAdmin"><b><?=$ValidNomRespAdmin?>Nom *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      
                      <input name="PrenomRespAdmin" size="50" value="<?=$ValPrenomRespAdmin?>" id="PrenomRespAdmin" type="text" class="validate">
                      <label for="PrenomRespAdmin"><b><?=$ValidPrenomRespAdmin?>Prénom *</b></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      <select>
                        <option name="CiviliteTuteur" value="M">M</option>
                        <option name="CiviliteTuteur" value="Mme">Mme</option>
                        <option name="CiviliteTuteur" value="Mlle">Mlle</option>
                      </select>
                      <label><b>&nbsp;&nbsp;Civilité *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      <input name="MailRespAdmin" size="50" value="<?=$ValMailRespAdmin?>" id="MailRespAdmin" type="email" class="validate">
                      <label for="MailRespAdmin">&nbsp;Mail</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                      <input name="TelRespAdmin" size="50" value="<?=$ValTelRespAdmin?>" id="TelRespAdmin" type="text" class="validate">
                      <label for="TelRespAdmin"><b><?=$ValidTelRespAdmin?>Tel *</b></label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                      <input name="FaxRespAdmin" size="50" value="<?=$ValFaxRespAdmin?>" id="FaxRespAdmin" type="text" class="validate">
                      <label for="FaxRespAdmin">&nbsp;Fax</label>
                    </div>
                  </div>
                  <p class="right">
                  <button type="reset" class="waves-effect waves-light btn black white-text">Reinitialiser</button>
                  <button type="submit" class="waves-effect waves-light btn blue white-text">Valider</button></p>
                  <input type="hidden" name="StepNewInscript" value="Valid">
                </form>

              </div>
            </div>
          </div>
        </div>

                                                            <?php
                                            }
                                                                               ?>

    <!--  Scripts-->
      <script src="<?=$URL_SITE.$PATH_JQUERY?>jquery-2.2.1.min.js"></script>
      <script src="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.js"></script>
      <script src="<?=$PATH_JS?>init.js"></script>
    </body>
</html>