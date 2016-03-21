<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    require_once ($PATH_COMMUNS.'FctDiverses.php'); // IsInSet()
	
    $ReqLangages     = Query ("SELECT * FROM $NomTabLangages",       $ConnectStages);
    $ReqMateriels    = Query ("SELECT * FROM $NomTabMateriels",      $ConnectStages);
    $ReqBDs          = Query ("SELECT * FROM $NomTabBasesDonnees",   $ConnectStages);

    require_once ($PATH_CLASS.'CStage.php');
    require_once ($PATH_CLASS.'CUser.php');
    require_once ($PATH_CLASS.'CEntreprise.php');

    $ObjStage      = new CStage      ($IdentPK);
    $ObjEntreprise = new CEntreprise ($ObjStage->GetFK_Entreprise());
    $ObjUser       = new CUser       ($ObjStage->GetFK_Tuteur    ());

    if ($ObjStage->GetAdr1Stage() != '')
	{
        $Adr1Stage  = $ObjStage->GetAdr1Stage ();
        $Adr2Stage  = $ObjStage->GetAdr2Stage ();
        $CPStage    = $ObjStage->GetCPStage   ();
        $VilleStage = $ObjStage->GetVilleStage();
	}
	else
	{
        $Adr1Stage  = $ObjEntreprise->GetAdr1 ();
        $Adr2Stage  = $ObjEntreprise->GetAdr2 ();
        $CPStage    = $ObjEntreprise->GetCP   ();
        $VilleStage = $ObjEntreprise->GetVille();
	}

    $ValPK_Stage = $ObjStage->GetPK_Stage();

    $ValRemarquesGenerales = $ObjStage->GetRemarquesGenerales();

	$WidthButton = 100;
    $WidthCadre  = 800;
	
	$MsgProposeA = array();
	$MsgProposeA [1] = 'aux étudiants de DUT';
	$MsgProposeA [2] = 'aux étudiants de Licence Professionnelle';
	$MsgProposeA [3] = 'aux étudiants de DUT ou de Licence Professionnelle';
?>
<h2 style="text-align : center;">Annee 2015-2016 : fiche de stage n° <?=$ValPK_Stage?></h2>

<h3 style="text-align : center;">
    proposé <?=$MsgProposeA [$ObjStage->GetNiveauStage()]?>
</h3>

<table align="center" style="border : 2px solid blue" width="<?=$WidthCadre?>"><tr><td>
<table  cellpadding="2" width="100%">
                                                                          <?php
	    /* ================================= */
	    /* 1. Entreprise                     */
	    /* ================================= */
        AffichTitre ($Msg_FormStage [MSGFORMSTAGE_1], 2);
                                                                          ?>
	<tr>
	    <td></td>
        <td valign="top"><b>Nom :</b></td>
        <td valign="top"><b><?=$ObjEntreprise->GetNomE()?></b></td>
	</tr>
	<tr>
	    <td></td>
        <td valign="top"><nobr><b>Adresse du lieu de stage :</nobr></i></td>
        <td valign="top"><?=$Adr1Stage?></td>
	</tr>
	                                                                       <?php
                                        if ($Adr2Stage != '')
										{
                                                                          ?>
	<tr>
	    <td></td>
        <td>&nbsp;</td>
        <td valign="top"><?=$Adr2Stage?></td>
	</tr>
	                                                                       <?php
                                        }
                                                                          ?>
	<tr>
	    <td></td>
        <td>&nbsp;</td>
        <td valign="top"><?=$CPStage?> - <?=$VilleStage?></td>
	</tr>
	                                                                       <?php
                                        if ($ObjEntreprise->GetPresentEntreprise() != '')
										{
                                            AffichLigneVierge();
                                                                          ?>
 	<tr>
	    <td></td>
        <td valign="top"><nobr><b>Présentation de l'entreprise :</b></nobr></td>
        <td valign="top"><?=$ObjEntreprise->GetPresentEntreprise()?></td>
	</tr>
	                                                                       <?php
										}
                                        if ($ObjEntreprise->GetSiteEntreprise() != '')
										{
                                            AffichLigneVierge();
                                                                          ?>
 	<tr>
	    <td></td>
        <td valign="top"><b>Site web de l'entreprise :</b> </td>
		<td><a href="<?=$ObjEntreprise->GetSiteEntreprise()?>" target="_blank">
			    <?=$ObjEntreprise->GetSiteEntreprise()?>
			</a>
		</td>
	</tr>
	                                                                       <?php
										}
                                        AffichLigneVierge();
                                                                         ?>
 	<tr>
	    <td></td>
        <td colspan="2"><nobr><b>Renseignements administratifs :</b></nobr></td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="3">
	    	<table width="100%" style="border : 1px solid blue" cellpadding="5">
                <tr style="text-align : left; background-color : #00b1ff">
       	   	        <th >&nbsp;</th>
                    <th >Responsable administratif</th>
                    <th >Maître de stage</th>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td><?=$ObjEntreprise->GetPrenomR()?>
					    <?=$ObjEntreprise->GetNomR()?>
					</td>
                    <td><?=$ObjUser->GetPrenom()?>
					    <?=$ObjUser->GetNom()?>
					</td>
                </tr>
                <tr style="background-color : #d4d4d4">
                    <th>Tél.</th>
                    <td><?=$ObjEntreprise->GetTelR()?>&nbsp;</td>
                    <td><?=$ObjUser->GetTel()?>&nbsp;</td>
                </tr>
                <tr >
                    <th>e-mail</th>
                    <td><?=$ObjEntreprise->GetMailR()?>&nbsp;</td>
                    <td><?=$ObjUser->GetMail()?>&nbsp;</td>
                </tr>
               <tr style="background-color : #d4d4d4">
                    <th>Fax</th>
                    <td><?=$ObjEntreprise->GetFaxR()?>&nbsp;</td>
                    <td><?=$ObjUser->GetFax()?>&nbsp;</td>
                </tr>
            </table>
		</td>
    </tr>
                                                                           <?php
                                        AffichLigneVierge();
                                                                           ?>
 	<tr>
	    <td></td>
        <td colspan="2"><nobr><b>Service</b></nobr></td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2"><?=$Msg_FormStage [MSGFORMSTAGE_NBPERS_CI]?>
		                <?=$ObjStage->GetNbPersCentreInfo()?></td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2">L'entreprise 
		     <?=$ObjStage->GetAreOldStagiaires() ? 'a déjà'
			                                     : 'n\'a encore jamais'?>
		     accueilli des stagiaires de notre département auparavant
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2"><?=$Msg_FormStage [MSGFORMSTAGE_NBSTAGIAIRES]?>
		                <?=$ObjStage->GetNbStagesProposes()?> 
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2"><?=$Msg_FormStage [MSGFORMSTAGE_NBPERS_SERV]?>
		                <?=$ObjStage->GetNbPersonnesService()?> 
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2">Le stagiaire travaillera
		     <?=$ObjStage->GetIsStagiaireSeul() 
			     ? $Msg_FormStage [MSGFORMSTAGE_SEUL]
			     : $Msg_FormStage [MSGFORMSTAGE_COLL_INFORM]?>
		</td>
	</tr>
                                                                           <?php
                                        AffichLigneVierge();
                                                                           ?>
 	<tr>
	    <td></td>
        <td colspan="2"><b><nobr>Renseignements pratiques</nobr></b>
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2">Indemnités mensuelles :
		                <?=$ObjStage->GetIndemnitesMensuellesStage();?> &euro;
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2">Repas :
		                <?=($ObjStage->GetIndemnitesRepas() == '')
						     ? 'non' : $ObjStage->GetIndemnitesRepas();?>
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2">Transport :
		                <?=($ObjStage->GetIndemnitesTransport() == '')
						     ? 'non' : $ObjStage->GetIndemnitesTransport();?>
		</td>
	</tr>
 	<tr>
	    <td></td>
        <td colspan="2"><?=$Msg_FormStage [MSGFORMSTAGE_EMBAUCHE]?> :
		                <?=($ObjStage->GetIsEmbauchePossible())
						     ? 'oui' : 'non'?>
		</td>
	</tr>
                                                                           <?php
                                        AffichLigneVierge();
	/*
	    =================================
	    2. Environnement du stagiaire ... 
	    =================================
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_2], 2);
	/*
	    ==========================
	    2.1 Environnement matériel
	    ==========================
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_ENV_MATERIEL], 3);

	                                    AffichRubrStage (
                                            $Msg_FormStage [MSGFORMSTAGE_MATERIEL], 
                                            $ReqMateriels, 
                                            $ObjStage->GetMateriel(),
                                            '',
                                            MATERIEL_PAR_LIGNE);
       AffichSepar ();
    /*
	    ==========================
	    2.2 Environnement logiciel 
	    ==========================
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_ENV_LOGICIEL], 3);

       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_LANGAGES], 4, 'bold');

	                                    AffichRubrStage (
                                            $Msg_FormStage [MSGFORMSTAGE_LANG],
                                            $ReqLangages,
                                            $ObjStage->GetLangages(),
                                            $ObjStage->GetAutresLangages(),
                                            LANG_PAR_LIGNE);
 
       AffichLigneVierge ();
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_BD], 4, 'bold');
	   
	                                    AffichRubrStage (
                                            '',
                                            $ReqBDs,
                                            $ObjStage->GetBD(),
                                            $ObjStage->GetAutresBD(),
                                            BD_PAR_LIGNE);
       AffichLigneVierge ();
																		   ?>
 	<tr>
	    <td></td>
        <td colspan="2"><?=$Msg_FormStage [MSGFORMSTAGE_LOGICIELS_SPEC]?> :
		                <?=($ObjStage->GetLogicielsSpecifiques() == '')
						     ? 'non' : $ObjStage->GetLogicielsSpecifiques()?>
		</td>
	</tr>
	                                                                       <?php
       AffichSepar ();
	/*
	    =========================
	    2.3 Méthodes ou standards
	    =========================
	*/
                                        if ($ObjStage->GetMethodesAnalyse ()      != '' ||
                                            $ObjStage->GetMethodesConception ()   != '' ||
                                            $ObjStage->GetMethodesProgrammation ()!= '' ||
                                            $ObjStage->GetMethodesControleQL ()   != '' ||
                                            $ObjStage->GetMethodesGestionProjet() != '')
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_METHODES_STANDARDS], 3);
																		   ?>
 	<tr>
	    <td></td>
        <td colspan="2"><table cellspacing="5">

	                                                                       <?php
       AffichRubr2Stage ($ObjStage->GetMethodesAnalyse(),
                         $Msg_FormStage [MSGFORMSTAGE_STDANALYSE]);

       AffichRubr2Stage ($ObjStage->GetMethodesConception(),
                         $Msg_FormStage [MSGFORMSTAGE_STDCONCEPTION]);

       AffichRubr2Stage ($ObjStage->GetMethodesProgrammation(),
                         $Msg_FormStage [MSGFORMSTAGE_STDPROGRAMMATION]);

       AffichRubr2Stage ($ObjStage->GetMethodesControleQL(),
                         $Msg_FormStage [MSGFORMSTAGE_STDCONTROLE_QL]);

       AffichRubr2Stage ($ObjStage->GetMethodesGestionProjet(),
                         $Msg_FormStage [MSGFORMSTAGE_STDGESTIONPROJET]);
																		   ?>
		</table></td>
	</tr>
	                                                                       <?php
	/*
	    ========
	    3. Sujet
	    ========
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_SUJET], 2);
																		   ?>
 	<tr>
	    <td></td>
        <td colspan="2"><table cellspacing="5">
	                                                                       <?php
       AffichRubr2Stage ($ObjStage->GetSujet(), '');
																		   ?>
		</table></td>
	</tr>
	                                                                       <?php	   
       AffichLigneVierge ();

       AffichTitre  ($Msg_FormStage [MSGFORMSTAGE_NATURE_TACHE], 4, 'normal');   
																		   ?>
 	<tr>
	    <td></td>
        <td colspan="2"><table cellspacing="5">
	                                                                       <?php
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_PROGRAMMATION], $ObjStage->GetIsNatureTacheProgr());
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_ANALYSE],       $ObjStage->GetIsNatureStageAnalyse());
																		   ?>
		</table></td>
	</tr>
	                                                                       <?php

       AffichLigneVierge();

       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_INTEGRATION], 4, 'normal');
																		   ?>
 	<tr>
	    <td></td>
        <td colspan="2"><table cellspacing="5">
	                                                                       <?php
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_INTEGRPROJETGLOBAL], $ObjStage->GetIsIntegrationProjetGlobal());
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_ENTITEINDEPENDANTE], $ObjStage->GetIsIntegrationEntiteIndependante());
																		   ?>
		</table></td>
	</tr>

</table>
<table width="100%">
<tr><td colspan="2">&nbsp;</td></tr>

<tr>
<td style="text-align : left">
<a href="<?=$PATH_GENERAL?>Print.php?SlxPage=<?=$SlxPage?>" 
			   title="Imprimer"
			   target="_blank"
		       onMouseOver="window.status='Imprimer'; return true"
               onMouseOut ="window.status=''; return true"
                ></a><img src="<?=$PATH_GIFS?>PrintCourant.gif" border="0">
</td>
<td style="text-align : center;" valign = center">
    <input type="button" value="Retour" style="width : <?=$WidthButton?>px" 
	       onClick="history.go (-1)">
                                                                       <?php
                                        if (GetDroits ($Status, 'ModifStage'))
                                        {
																		   ?>

    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
    <input type="button" value="Modifier" style="width : <?=$WidthButton?>px"
	       onClick="window.location='?Trait=Form&SlxTable=<?=$NomTabStages?>&IdentPK=<?=$ObjStage->GetPK_Stage()?>'">
	</a>
</td></tr></table>
</td></tr></table>
            
                                                                       <?php
                                        }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
