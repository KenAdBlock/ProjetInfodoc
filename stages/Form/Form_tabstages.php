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
    $WidthSelect       = 350;
	$ColsTextAreaDflt  = 60;
	$RowsTextAreaDflt  = 6;

    require_once ($PATH_COMMUNS.'FctDiverses.php'); // IsInSet()
	
    $ReqLangages     = Query ("SELECT * FROM $NomTabLangages",       $Connexion);
    $ReqMateriels    = Query ("SELECT * FROM $NomTabMateriels",      $Connexion);
    $ReqBDs          = Query ("SELECT * FROM $NomTabBasesDonnees",   $Connexion);

    require_once ($PATH_CLASS.'CStage.php');

    // R�cup�ration des variables envoy�es par POST ou GET

    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;
	
    if (!isset ($StepStage))
        $StepStage = isset ($IdentPK) && $IdentPK != 0 ? 'InitModif' : 'InitNew';

    $ValidNiveauStage                     =
    $ValidFK_Entreprise                   =
    $ValidFK_Tuteur                       =

    $ValidMateriel                        =
    $ValidLangages                        =
    $ValidAutresLangages                  =
    $ValidBD                              =
    $ValidAutresBD                        =
	
	$ValidLogicielsSpecifiques            =
	$ValidMethodesAnalyse                 =
	$ValidMethodesConception              =
	$ValidMethodesProgrammation           =
	$ValidMethodesControleQL              =
	$ValidMethodesGestionProjet           =
	
	$ValidSujet                           =

	$ValidIsNatureTacheProgr              =
	$ValidIsNatureStageAnalyse            =
	$ValidIsIntegrationProjetGlobal       =
	$ValidIsIntegrationEntiteIndependante =

	$ValidRemarquesGenerales              =
	
	$ValidNbPersCentreInfo                =
	$ValidAreOldStagiaires                =
	$ValidNbStagesProposes                =
	$ValidNbStagesRestant                 =
	$ValidNbPersonnesService              =
	$ValidIsStagiaireSeul                 =
	
	$ValidIndemnitesMensuellesStage       =
	$ValidIndemnitesRepas                 =
	$ValidIndemnitesTransport             =
	$ValidIsEmbauchePossible              =

	$ValidAdr1Stage                       =
	$ValidAdr2Stage                       =
	$ValidCPStage                         =
	$ValidVilleStage                      = ESPACE;

	$ValPossiblesNbPerson = array();
	$ValPossiblesNbPerson [0] = '0';
	$ValPossiblesNbPerson [1] = '1';
	$ValPossiblesNbPerson [2] = '2';
	$ValPossiblesNbPerson [3] = '< 5';
	$ValPossiblesNbPerson [4] = '< 10';
	$ValPossiblesNbPerson [5] = '10 et plus';
		
    switch ($StepStage)
    {
      case 'InitModif' :
      case 'InitNew' :

	    $ObjStage = new CStage ($StepStage == 'InitModif' ? $IdentPK : 0);

		// ToDo ; V�rifier que l'utilisateur a bien acc�s au stage
		
        $ValPK_Stage      = $ObjStage->GetPK_Stage();
        $ValFK_Entreprise = $Status == TUTEUR ? $FK_EntrepriseUser
		                                      : $ObjStage->GetFK_Entreprise();

		if ($ValFK_Entreprise != 0)
		{
		    $ReqSoc  = Query ("SELECT NomE FROM $NomTabEntreprises
			                       WHERE PK_Entreprise = $ValFK_Entreprise;",
			                  $Connexion);
			$ObjSoc  = mysql_fetch_object ($ReqSoc);
			$ValNomE = $ObjSoc->NomE;
		}
		else
		    $ValNomE = '';

        $ValNiveauStage                     = $ObjStage->GetNiveauStage();

        $ValMateriel                        = $ObjStage->GetMateriel();
        $ValLangages                        = $ObjStage->GetLangages();
        $ValAutresLangages                  = $ObjStage->GetAutresLangages();
        $ValBD                              = $ObjStage->GetBD();
        $ValAutresBD                        = $ObjStage->GetAutresBD();
		
        $ValLogicielsSpecifiques            = $ObjStage->GetLogicielsSpecifiques();
        $ValLogicielsSpecOuiNon             = $ValLogicielsSpecifiques != '';
        $ValMethodesAnalyse                 = $ObjStage->GetMethodesAnalyse();
        $ValMethodesConception              = $ObjStage->GetMethodesConception();
        $ValMethodesProgrammation           = $ObjStage->GetMethodesProgrammation();
        $ValMethodesControleQL              = $ObjStage->GetMethodesControleQL();
        $ValMethodesGestionProjet           = $ObjStage->GetMethodesGestionProjet();

        $ValSujet                           = $ObjStage->GetSujet();

        $ValIsNatureTacheProgr              = $ObjStage->GetIsNatureTacheProgr();
        $ValIsNatureStageAnalyse            = $ObjStage->GetIsNatureStageAnalyse();
        $ValIsIntegrationProjetGlobal       = $ObjStage->GetIsIntegrationProjetGlobal();
        $ValIsIntegrationEntiteIndependante = $ObjStage->GetIsIntegrationEntiteIndependante();

        $ValRemarquesGenerales              = $ObjStage->GetRemarquesGenerales();
		
        $ValNbPersCentreInfo                = $ObjStage->GetNbPersCentreInfo();
        $ValAreOldStagiaires                = $ObjStage->GetAreOldStagiaires();
        $ValNbStagesProposes                = $ObjStage->GetNbStagesProposes();
        $ValNbStagesRestant                 = $ObjStage->GetNbStagesRestant();
        $ValNbPersonnesService              = $ObjStage->GetNbPersonnesService();
        $ValIsStagiaireSeul                 = $ObjStage->GetIsStagiaireSeul();

        $ValIndemnitesMensuellesStage       = $ObjStage->GetIndemnitesMensuellesStage();
        $ValIndemnitesRepas                 = $ObjStage->GetIndemnitesRepas();
        $ValIndemnitesRepasOuiNon           = $ValIndemnitesRepas != '';
        $ValIndemnitesTransport             = $ObjStage->GetIndemnitesTransport();
        $ValIndemnitesTransportOuiNon       = $ValIndemnitesTransport != '';
        $ValIsEmbauchePossible              = $ObjStage->GetIsEmbauchePossible();

        $ValAdr1Stage                       = $ObjStage->GetAdr1Stage();
        $ValAdr2Stage                       = $ObjStage->GetAdr2Stage();
        $ValCPStage                         = $ObjStage->GetCPStage();
        $ValVilleStage                      = $ObjStage->GetVilleStage();

        $ValFK_Tuteur                       = $ObjStage->GetFK_Tuteur();
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();

        $ValPK_Stage      = $PK_Stage;
        $ValFK_Entreprise = $FK_Entreprise;
        $ValNiveauStage   = $NiveauStage;

        $ValMateriel       = CalcCodeBin ($ReqMateriels);
        $ValLangages       = CalcCodeBin ($ReqLangages); 
		$ValAutresLangages = trim ($AutresLangages);
        $ValBD             = CalcCodeBin ($ReqBDs);
        $ValAutresBD       = trim ($AutresBD);
		
        $ValMethodesAnalyse                 = $MethodesAnalyse;
        $ValMethodesConception              = $MethodesConception;
        $ValMethodesProgrammation           = $MethodesProgrammation;
        $ValMethodesControleQL              = $MethodesControleQL;
        $ValMethodesGestionProjet           = $MethodesGestionProjet;

        $ValIsNatureTacheProgr              = $IsNatureTacheProgr;
        $ValIsNatureStageAnalyse            = $IsNatureStageAnalyse;
        $ValIsIntegrationProjetGlobal       = $IsIntegrationProjetGlobal;
        $ValIsIntegrationEntiteIndependante = $IsIntegrationEntiteIndependante;

        $ValRemarquesGenerales              = trim ($RemarquesGenerales);
		
        $ValNbPersCentreInfo                = $NbPersCentreInfo;
        $ValAreOldStagiaires                = $AreOldStagiaires;
        $ValNbStagesProposes                = $NbStagesProposes;

		// A voir
		
        $ValNbStagesRestant                 = $NbStagesRestant;
		
        $ValNbPersonnesService              = $NbPersonnesService;
        $ValIsStagiaireSeul                 = $IsStagiaireSeul;
		
        $ValIndemnitesMensuellesStage       = $IndemnitesMensuellesStage;
        if (! is_numeric ($ValIndemnitesMensuellesStage))
		{
			array_push ($CodErrInval, INDEMN_INVALIDE);
            $ValidIndemnitesMensuellesStage = FLECHE;
		}
		else if ($ValIndemnitesMensuellesStage < MINIMUM_LEGAL_INDEMNITES)
		{
			array_push ($CodErrInval, INDEMN_INSUFFISANTE);
            $ValidIndemnitesMensuellesStage = FLECHE;
		}

        $ValIndemnitesRepasOuiNon  = $IndemnitesRepasOuiNon;
		$ValIndemnitesRepas        = trim ($IndemnitesRepas);
        if (($ValIndemnitesRepasOuiNon && $ValIndemnitesRepas == '') ||
		    (! $ValIndemnitesRepasOuiNon && $ValIndemnitesRepas != ''))
        {
			array_push ($CodErrInval, INDEMN_REPAS_INCORRECTE);
            $ValidIndemnitesRepas = FLECHE;
        }
		
        $ValIndemnitesTransportOuiNon = $IndemnitesTransportOuiNon;
		$ValIndemnitesTransport = trim ($IndemnitesTransport);
        if (($ValIndemnitesTransportOuiNon && $ValIndemnitesTransport == '') ||
		    (! $ValIndemnitesTransportOuiNon && $ValIndemnitesTransport != ''))
        {
			array_push ($CodErrInval, INDEMN_TRANSPORT_INCORRECTE);
            $ValidIndemnitesTransport = FLECHE;
        }	

        $ValLogicielsSpecOuiNon = $LogicielsSpecOuiNon;
		$ValLogicielsSpecifiques = trim ($LogicielsSpec);
        if (($ValLogicielsSpecOuiNon && $ValLogicielsSpecifiques == '') ||
		    (! $ValLogicielsSpecOuiNon && $ValLogicielsSpecifiques != ''))
        {
			array_push ($CodErrInval, LOGICIELS_SPEC_INCORRECTS);
            $ValidLogicielsSpec = FLECHE;
        }	
        $ValIsEmbauchePossible = $IsEmbauchePossible;

        if (($ValSujet = trim ($Sujet)) == '')
        {
            array_push ($CodErrVide, 'Sujet');
            $ValidSujet = FLECHE;
        }

        $ValAdr1Stage  = trim ($Adr1Stage);
        $ValAdr2Stage  = trim ($Adr2Stage);
        $ValCPStage    = trim ($CPStage);
        $ValVilleStage = trim ($VilleStage);

		if ($ValAdr1Stage != '' || $ValAdr2Stage  != '' || 
		    $ValCPStage   != '' || $ValVilleStage != '')
		{
            if ($ValAdr1Stage == '')
            {
                array_push ($CodErrVide, 'Adresse du lieu de stage');
                $ValidAdr1Stage = FLECHE;
            }
            if ($ValCPStage == '')
            {
                array_push ($CodErrVide, 'Code postal du lieu de stage');
                $ValidCPStage = FLECHE;
            }
            if ($ValVilleStage == '')
            {
                array_push ($CodErrVide, 'Ville du lieu de stage');
                $ValidVilleStage = FLECHE;
            }
		}			
        $ValFK_Tuteur = $FK_Tuteur;
		
        // Recherche de l'entreprise � partir du tuteur

		$ReqTuteur = Query ("SELECT FK_Entreprise FROM $NomTabUsers
			                              WHERE PK_User = $ValFK_Tuteur;",
								     $Connexion);
        
        $ObjTuteur = mysql_fetch_object ($ReqTuteur);
		$ValFK_Entreprise = $ObjTuteur->FK_Entreprise;

        if (! ($CodErrVide || $CodErrInval))
        {
            // Pr�paration de l'enregistrement
			
            $ObjStage = new CStage ();
			
            $ObjStage->SetPK_Stage      ($ValPK_Stage);
            $ObjStage->SetFK_Entreprise ($ValFK_Entreprise);

            $ObjStage->SetNiveauStage ($ValNiveauStage);

            $ObjStage->SetMateriel       ($ValMateriel);
            $ObjStage->SetLangages       (ProtectApos ($ValLangages));
            $ObjStage->SetAutresLangages (ProtectApos ($ValAutresLangages));
            $ObjStage->SetBD             ($ValBD);
            $ObjStage->SetAutresBD       (ProtectApos ($ValAutresBD));
		
            $ObjStage->SetLogicielsSpecifiques  (ProtectApos ($ValLogicielsSpecifiques));
/*
?>
<script type="text/javascript">
alert('<?php echo 'Oui ? '.$ValLogicielsSpecOuiNon.' '.ProtectApos ($ValLogicielsSpecifiques).' '.$ObjStage->GetLogicielsSpecifiques(); ?>');
</script>
<?php
*/
            $ObjStage->SetMethodesAnalyse       (ProtectApos ($ValMethodesAnalyse));
            $ObjStage->SetMethodesConception    (ProtectApos ($ValMethodesConception));
            $ObjStage->SetMethodesProgrammation (ProtectApos ($ValMethodesProgrammation));
            $ObjStage->SetMethodesControleQL    (ProtectApos ($ValMethodesControleQL));
            $ObjStage->SetMethodesGestionProjet (ProtectApos ($ValMethodesGestionProjet));

            $ObjStage->SetSujet (ProtectApos ($ValSujet));

            $ObjStage->SetIsNatureTacheProgr              ($ValIsNatureTacheProgr);
            $ObjStage->SetIsNatureStageAnalyse            ($ValIsNatureStageAnalyse);
            $ObjStage->SetIsIntegrationProjetGlobal       ($ValIsIntegrationProjetGlobal);
            $ObjStage->SetIsIntegrationEntiteIndependante ($ValIsIntegrationEntiteIndependante);

            $ObjStage->SetRemarquesGenerales              (ProtectApos ($ValRemarquesGenerales));

            $ObjStage->SetNbPersCentreInfo   ($ValNbPersCentreInfo);
            $ObjStage->SetAreOldStagiaires   ($ValAreOldStagiaires);
            $ObjStage->SetNbStagesProposes   ($ValNbStagesProposes);
            $ObjStage->SetNbStagesRestant    ($ValNbStagesProposes);
            $ObjStage->SetNbPersonnesService ($ValNbPersonnesService);
            $ObjStage->SetIsStagiaireSeul    ($ValIsStagiaireSeul);

            $ObjStage->SetIndemnitesMensuellesStage ($ValIndemnitesMensuellesStage);
            $ObjStage->SetIndemnitesRepas           (ProtectApos ($ValIndemnitesRepas));
            $ObjStage->SetIndemnitesTransport       (ProtectApos ($ValIndemnitesTransport));
            $ObjStage->SetIsEmbauchePossible        ($ValIsEmbauchePossible);

            $ObjStage->SetAdr1Stage                 (ProtectApos ($ValAdr1Stage));
            $ObjStage->SetAdr2Stage                 (ProtectApos ($ValAdr2Stage));
            $ObjStage->SetCPStage                   ($ValCPStage);
            $ObjStage->SetVilleStage		   (ProtectApos ($ValVilleStage));

            $ObjStage->SetFK_Tuteur ($ValFK_Tuteur);

            if ($IdentPK == 0 || $SaveAsNew)
                $ObjStage->Insert();
            else
                $ObjStage->Update();

            $StepStage = 'MAJTabOK';
        }
        break;
    }
	$Bold    = $Status == TUTEUR ? '' : '<b>';
    $FinBold = $Status == TUTEUR ? '' : '</b>';

    if ($Status != TUTEUR)    // ==> ADMIN || RESP || SECR
	    $ReqTuteurs = Query ("SELECT DISTINCT $NomTabUsers.Nom, $NomTabUsers.Prenom, $NomTabUsers.PK_User, $NomTabEntreprises.NomE 
		                          FROM $NomTabUsers, $NomTabEntreprises 
		                          WHERE $NomTabUsers.Status = '".TUTEUR."'
								    AND $NomTabUsers.FK_Entreprise = $NomTabEntreprises.PK_Entreprise
								  ORDER BY NomE, Nom", 
	                         $Connexion);

                                        if ($StepStage == 'MAJTabOK')
                                        {
	                                        if ($Reafficher)
	                                        {
                                                                           ?>
<script>location.replace("?Trait=Form&SlxTable=tabstages&IdentPK=<?=$IdentPK?>");</script>
                                                                           <?php
	                                        }
	                                        else
	                                        {
                                                                           ?>
<script>location.replace("?Trait=List&SlxTable=tabstages");</script>
                                                                           <?php
	                                        }
                                                                           ?>
<script>location.replace("?Trait=List&SlxTable=tabstages");</script>
                                                                           <?php
	                                    }
	                                    else
	                                    {
	                                        if ($IdentPK == 0)
										    {
                                                                           ?>
<h1>Cr&eacute;ation d'une nouvelle fiche de stage</h1>
                                                                           <?php
                                            }
                                            else
                                            {
                                                                           ?>
<h1>Modification de la fiche de stage <?=$IdentPK?></h1>
                                                                           <?php
	                                        }
                                                                           ?>

<form method="post">
<p style="text-align : center;">
<?=$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGE]?>

<nobr  style="font-weight : bold; color : red">
&nbsp; &nbsp; &nbsp; <?=$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGEDUT]?>
<input type="radio" name="NiveauStage" value="1"
			       <?=$ValNiveauStage == 1 ? 'checked' : ''?> >
&nbsp; &nbsp; &nbsp; <?=$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGELP]?>
<input type="radio" name="NiveauStage" value="2"
			       <?=$ValNiveauStage == 2 ? 'checked' : ''?> >
&nbsp; &nbsp; <?=$Msg_FormStage [MSGFORMSTAGE_NIVEAUSTAGEINDIFF]?>
<input type="radio" name="NiveauStage" value="3"
			       <?=$ValNiveauStage == 3 ? 'checked' : ''?> >
</nobr>

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
<table cellpadding="2" align="center" style="border : 2px solid blue">
<colgroup>
    <col width = "10">
    <col width = "200">
    <col width = "170">
	
   <tr><td colspan="3"><table>
    <?php 
	    /* ================================= */
	    /* 1. Entreprise                     */
	    /* ================================= */
        AffichTitre ($Msg_FormStage [MSGFORMSTAGE_1], 2);

	    /* ================================= */
	    /*    1.1 Tuteur                     */
	    /* ================================= */
        AffichTitre ($Msg_FormStage [MSGFORMSTAGE_1_1], 3);
		    ?>
	</table></td></tr>
	<tr>
	    <td><?=$ValidFK_Tuteur?></td>
            <?php /*		<td style="text-align : left" valign="top">&nbsp;
<?=$Bold?><?=$Msg_FormStage [MSGFORMSTAGE_TUTEUR]?><?=$FinBold?>
		</td>*/ ?>
		<td colspan="2">
                                                                         <?php
		                                if ($Status == TUTEUR)
										{
                                                                         ?>		
		    <b><big><?=$PrenomUser?> <?=$NomUser?></big></b>
            <input type="hidden" name="FK_Tuteur", value="<?=$_SESSION ['PK_User']?>">
		                                                                 <?php
										}
										else
										{
                                                                         ?>
            <select name="FK_Tuteur" size="1" style="width: <?=$WidthSelect?>px">;
                <option value="0" <?=$ValFK_Tuteur == 0 ? 'selected' : ''?> >----------------</option>
                                                                         <?php
		                                    while ($ObjTuteur = mysql_fetch_object ($ReqTuteurs))
										    {
                                                                         ?>
                <option value="<?=$ObjTuteur->PK_User?>"
                        <?=$ObjTuteur->PK_User == $ValFK_Tuteur ? 'selected' : ''?>
						   ><?=$ObjTuteur->Prenom?> <?=$ObjTuteur->Nom?> - <?=$ObjTuteur->NomE?>
				</option>
                                                                         <?php
										    }
                                                                         ?>
			</select>
                                                                         <?php
										}
                                                                         ?>
        </td>
	</tr>
                                                                         <?php
	    /* ================================= */
	    /*     Adresse du lieu de stage      */
	    /* ================================= */
        AffichTitre ($Msg_FormStage [MSGFORMSTAGE_ADRSTAGE], 4, 'left', 'normal');

                                                                         ?>
	    <tr><td></td><td colspan="2"><table cellpadding="2" align="center" 
		                           style="border : 2px solid blue" width="100%">
    <tr>
        <td valign="top"><?=$ValidAdr1Stage?></td>
        <td style="text-align : right" valign="top"><b>Adresse</b></td>
        <td>
            <input type="text" name="Adr1Stage" size="50" value="<?=$ValAdr1Stage?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidAdr2Stage?></td>
        <td style="text-align : right" valign="top">Adresse 2</td>
        <td>
            <input type="text" name="Adr2Stage" size="50" value="<?=$ValAdr2Stage?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidCPStage?></td>
        <td style="text-align : right" valign="top"><b>Code postal</b></td>
        <td>
            <input type="text" name="CPStage" size="50" value="<?=$ValCPStage?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><?=$ValidVilleStage?></td>
        <td style="text-align : right" valign="top"><b>Ville</b></td>
        <td>
            <input type="text" name="VilleStage" size="50" value="<?=$ValVilleStage?>">
        </td>
    </tr>
		</table></td></tr>
                                                                         <?php
                                        AffichLigneVierge();
		
	    /* ================================= */
	    /*     1.2 Service                   */
	    /* ================================= */
                                        AffichTitre (
                                            $Msg_FormStage [MSGFORMSTAGE_DESCR_SERVICE], 
                                            3);

                                        SaisieRubrStringEnum (
                                            $Msg_FormStage [MSGFORMSTAGE_NBPERS_CI],     
                                            'NbPersCentreInfo', 
                                            $ValNbPersCentreInfo, 
                                            $ValPossiblesNbPerson, 
                                            'left');

                                        SaisieOuiNon    (
                                            $Msg_FormStage [MSGFORMSTAGE_OLDSTAGIAIRES],
                                            'AreOldStagiaires', 
                                            $ValAreOldStagiaires, 
                                            'left');

                                        SaisieRubrIntEnum (
                                            $Msg_FormStage [MSGFORMSTAGE_NBSTAGIAIRES],  
                                            'NbStagesProposes', 
                                            $ValNbStagesProposes, 
                                            1, 
                                            4, 
                                            'left');

                                        SaisieRubrStringEnum (
                                            $Msg_FormStage [MSGFORMSTAGE_NBPERS_SERV],   
                                            'NbPersonnesService', 
                                            $ValNbPersonnesService, 
                                            $ValPossiblesNbPerson, 
                                            'left');

                                        SaisieOuiNon (
                                            $Msg_FormStage [MSGFORMSTAGE_ENVIRONSTAGIAIRE],
                                            'IsStagiaireSeul', 
                                            $ValIsStagiaireSeul, 
                                            'left',
                                            $Msg_FormStage [MSGFORMSTAGE_SEUL],
                                            $Msg_FormStage [MSGFORMSTAGE_COLL_INFORM]);


                                                                         ?>
	</table></td></tr>
	<tr><td colspan="3"><table>
                                                                         <?php
                                        AffichLigneVierge();

	    /* ================================= */
	    /*     1.3 Renseignements pratiques  */
	    /* ================================= */


                                        AffichTitre ($Msg_FormStage [MSGFORMSTAGE_RENS_PRATIQUES], 3);
		                                                                 ?>							
<tr><td colspan="3">
<div style="background-color : Silver; border : thin solid Black;">
<blockquote><p>
<span style="color : red;">Gratification :</span>

<br /><br />
L'article 30 de la loi n� 2009-1437 du 24/11/09, modifi&eacute;e par  la loi n�2014-788 du 10 juillet 2014, impose pour tous les stages de plus de deux mois la gratification des 
stagiaires dans le priv&eacute; comme dans le public au taux de 13,75% du plafond de la S&eacute;curit&eacute; Sociale, soit <?=MINIMUM_LEGAL_INDEMNITES?> euros/mois - taux au 30/12/14.
</p></blockquote>
</div>
</td></tr>
                                                                         <?php
                                        SaisieRubrInput (
                                            $Msg_FormStage [MSGFORMSTAGE_INDEMN_STAGE],
                                            'IndemnitesMensuellesStage', 
                                            $ValIndemnitesMensuellesStage,
										    $ValidIndemnitesMensuellesStage);

                                        SaisieOuiNonEtAutre (
										    $ValidIndemnitesRepas,
                                            $Msg_FormStage [MSGFORMSTAGE_INDEMN_REPAS], 
                                            'IndemnitesRepasOuiNon', 
                                            $ValIndemnitesRepasOuiNon, 
                                            $Msg_FormStage [MSGFORMSTAGE_PRECISEZ],
                                            'IndemnitesRepas', 
                                            $ValIndemnitesRepas);
											
                                        SaisieOuiNonEtAutre (
										    $ValidIndemnitesTransport,
                                            $Msg_FormStage [MSGFORMSTAGE_INDEMN_TRANSPORT], 
                                            'IndemnitesTransportOuiNon', 
                                            $ValIndemnitesTransportOuiNon, 
                                            $Msg_FormStage [MSGFORMSTAGE_PRECISEZ],
                                            'IndemnitesTransport', 
                                            $ValIndemnitesTransport);
											
                                        SaisieOuiNon (
                                            $Msg_FormStage [MSGFORMSTAGE_EMBAUCHE], 
                                            'IsEmbauchePossible', 
                                            $ValIsEmbauchePossible);

                                        AffichLigneVierge();
	/*
	    =================================
	    2. Environnement du stagiaire ... 
	    =================================
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_2], 2);
	      
	/*
	    ==========================
	    2.1 Environnement mat�riel 
	    ==========================
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_ENV_MATERIEL], 3);

                                       SaisieRubrStage (
									       '', // $ValidMateriel, 
										   "", 
                                           $ReqMateriels, 
                                           $ValMateriel, 
                                           MATERIEL_PAR_LIGNE);                                        AffichLigneVierge();

                                        AffichLigneVierge();
	/*
	    ==========================
	    2.2 Environnement logiciel 
	    ==========================
	*/
       
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_ENV_LOGICIEL], 3);

                                       SaisieRubrStageEtAutre (
									       '', // $ValidLangages,
                                           $Msg_FormStage [MSGFORMSTAGE_LANGAGES], 
                                           $ReqLangages,  
										   $ValLangages, 
										   $ValidAutresLangages, 
										   'AutresLangages',
                                           $ValAutresLangages, 
										   LANG_PAR_LIGNE);
										   
                                       AffichLigneVierge();
									   
                                       SaisieRubrStageEtAutre (
									       '', // $ValidBD, 
										   $Msg_FormStage [MSGFORMSTAGE_BD], 
										   $ReqBDs,  
										   $ValBD, 
										   $ValidAutresBD, 
										   'AutresBD', 
										   $ValAutresBD, 
										   BD_PAR_LIGNE);
                                       AffichLigneVierge();
											
                                       SaisieOuiNonEtAutre (
										    $ValidLogicielsSpec,
                                            $Msg_FormStage [MSGFORMSTAGE_LOGICIELS_SPEC], 
                                            'LogicielsSpecOuiNon', 
                                            $ValLogicielsSpecOuiNon, 
                                            $Msg_FormStage [MSGFORMSTAGE_PRECISEZ],
                                            'LogicielsSpec', 
                                            $ValLogicielsSpecifiques);

                                       AffichLigneVierge();
	/*
	    =========================
	    2.3 M�thodes ou standards 
	    =========================
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_METHODES_STANDARDS], 3);

                                       SaisieRubrInput (
									       $Msg_FormStage [MSGFORMSTAGE_STDANALYSE],
										   'MethodesAnalyse', 
										   $ValMethodesAnalyse);
                                       SaisieRubrInput (
									       $Msg_FormStage [MSGFORMSTAGE_STDCONCEPTION],
									       'MethodesConception',
									       $ValMethodesConception);
                                       SaisieRubrInput (
									       $Msg_FormStage [MSGFORMSTAGE_STDPROGRAMMATION],
									       'MethodesProgrammation',
									       $ValMethodesProgrammation);
                                       SaisieRubrInput (
									       $Msg_FormStage [MSGFORMSTAGE_STDCONTROLE_QL],
									       'MethodesControleQL',
									       $ValMethodesControleQL);
                                       SaisieRubrInput (
									       $Msg_FormStage [MSGFORMSTAGE_STDGESTIONPROJET],
									       'MethodesGestionProjet',
									       $ValMethodesGestionProjet);

                                       AffichSepar ();
	/*
	    ========
	    3. Sujet
	    ========
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_SUJET], 2);
	   
                                        SaisieSujet (
									        '',
									        'Sujet',
									        $ValSujet,
									        $ValidSujet,
										    120, // $ColsTextAreaDflt,
										    15,  // $RowsTextAreaDflt,
										    'left');

                                        AffichSepar ();
									
                                        AffichTitre (
										    $Msg_FormStage [MSGFORMSTAGE_NATURE_TACHE], 
											4);
									
                                        SaisieOuiNon (
										    $Msg_FormStage [MSGFORMSTAGE_PROGRAMMATION],
											 'IsNatureTacheProgr', 
											 $ValIsNatureTacheProgr,
											 'left');
                                        SaisieOuiNon (
										    $Msg_FormStage [MSGFORMSTAGE_ANALYSE],
											 'IsNatureStageAnalyse', 
											 $ValIsNatureStageAnalyse,
											 'left');
											 
                                        AffichLigneVierge();

                                        AffichTitre (
										    $Msg_FormStage [MSGFORMSTAGE_INTEGRATION], 
											4);

                                        SaisieOuiNon (
										    $Msg_FormStage [MSGFORMSTAGE_INTEGRPROJETGLOBAL],
											 'IsIntegrationProjetGlobal', 
											 $ValIsIntegrationProjetGlobal,
											 'left');
                                        SaisieOuiNon (
										    $Msg_FormStage [MSGFORMSTAGE_ENTITEINDEPENDANTE],
											 'IsIntegrationEntiteIndependante', 
											 $ValIsIntegrationEntiteIndependante,
											 'left');

                                        AffichLigneVierge();

                                        AffichTitre (
										    $Msg_FormStage [MSGFORMSTAGE_REMARQUES], 
											4);

                                        SaisieSujet (
                                            '',
                                            'RemarquesGenerales', 
                                            $ValRemarquesGenerales,
											'',
										    120, // $ColsTextAreaDflt,
										    5,  // $RowsTextAreaDflt,
										'left');
												
                                        if (count ($CodErrInval) || count ($CodErrVide))
										{
                                                                           ?>
	<tr>			
         <td colspan="3" align="center"><br /><hr></td>
    </tr>
                                                                           <?php
                                        }
										if (count ($CodErrInval))
										{
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
                                        if (count ($CodErrVide))
										{
                                            for ($i = 0; $i < count ($CodErrVide); ++$i)
										    {
                                                                           ?>
	<tr>			
        <td colspan="3" style="text-align : center; color : red">
		    <b><?=$CodErrVide [$i]?></b><?=$MsgErr [CHAMP_NON_REMPLI]?><br />
        </td>
    </tr>
                                                                           <?php
                                            }
                                        }
                                        if (count ($CodErrInval) || count ($CodErrVide))
										{
                                                                           ?>
	<tr>			
         <td colspan="3" align="center"><br /><hr></td>
    </tr>
                                                                           <?php
                                         }
                                                                           ?>
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

<input type="hidden" name="StepStage" value="Valid" >
<input type="hidden" name="PK_Stage" value="<?=$ValPK_Stage?>" >
</form>
                                                                       <?php
                                        }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez acc&eacute;der directement � cette page</h2>
<?php
}
?>
