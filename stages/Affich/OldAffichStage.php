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

    $ObjStage = new CStage ($IdentPK);
    $ValPK_Stage = $ObjStage->GetPK_Stage();

    $ValRemarquesGenerales = $ObjStage->GetRemarquesGenerales();

    $ObjEntreprise = new CEntreprise ($ObjStage->GetFK_Entreprise());
    $ObjUser       = new CUser       ($ObjStage->GetFK_Tuteur    ());
	$WidthButton = 100;
    $WidthCadre  = 800
?>
<h2 style="text-align : center;">Fiche de stage n° <?=$ValPK_Stage?></h2>

<table align="center" border="1" width="<?=$WidthCadre?>"><tr><td>
<table cellpadding="2" width="100%">

    <tr>
	    <td>
		    1. Entreprise</i>
		</td>
        <td>
		    <b><?=$ObjEntreprise->GetNomE()?></b>
			<br /><?=$ObjEntreprise->GetAdr1()?>
                                                                           <?php
                                        if ($ObjEntreprise->GetAdr2() != '')
                                        {
                                                                           ?>
			<br /><?=$ObjEntreprise->GetAdr2()?>
                                                                           <?php
                                        }
                                                                           ?>
			<br /><?=$ObjEntreprise->GetCP()?>
			 - <?=$ObjEntreprise->GetVille()?>
			<br />Tel : <?=$ObjEntreprise->GetTelR()?>
        </td>
    </tr>
	<tr>
        <td colspan="2"><table width="100%" border="1" cellpadding="5">
            <tr>
   	   	        <th >&nbsp;</th>
                <th style="text-align : left;">Resp. admin.</th>
                <th style="text-align : left;">Tuteur du stage</th>
            </tr>
            <tr>
                <th>Nom</th>
                <td><?=$ObjEntreprise->GetPrenomR()?> <?=$ObjEntreprise->GetNomR()?></td>
                <td><?=$ObjUser->GetPrenom()?> <?=$ObjUser->GetNom()?></td>
            </tr>
            <tr>
                <th>Tél.</th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <th>e-mail</th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <th>Fax</th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table></td>
    </tr>
	<tr>
	                                                                       <?php
	                                    AffichRubrStage ($Msg_FormStage [MSGFORMSTAGE_MATERIEL], 
									                     $ReqMateriels, 
													     $ObjStage->GetMateriel(),
														 '', MATERIEL_PAR_LIGNE);
	                                                                       ?>
    <tr><td></td><td><hr size="1" noshade width="100%" align="left"></td></tr>
	                                                                       <?php
	                                    AffichRubrStage ($Msg_FormStage [MSGFORMSTAGE_LANG], 
										                 $ReqLangages, 
														 $ObjStage->GetLangages(),
														 $ObjStage->GetAutresLangages(), 
														 LANG_PAR_LIGNE);
																		   ?>
    <tr><td></td><td><hr size="1" noshade width="100%" align="left"></td></tr>
	                                                                       <?php
	                                    AffichRubrStage ($Msg_FormStage [MSGFORMSTAGE_BD], 
										                 $ReqBDs, 
														 $ObjStage->GetBD(),
														 $ObjStage->GetAutresBD(), 
														 BD_PAR_LIGNE);

                                        if ($ObjStage->GetLogicielsSpecifiques ()  ||
                                            $ObjStage->GetMethodesAnalyse ()       ||
                                            $ObjStage->GetMethodesConception ()    ||
                                            $ObjStage->GetMethodesProgrammation () ||
                                            $ObjStage->GetMethodesControleQL ()    ||
                                            $ObjStage->GetMethodesGestionProjet())
										{
																		   ?>
    <tr>
	    <td colspan="2" style="text-align : center; font-weight : bold;">
	        <i><?=$Msg_FormStage [MSGFORMSTAGE_METHODES]?></i>
		</td>
	</tr>
	                                                                       <?php

            // ToDo   $LogicielsSpecifiques;

                                            AffichRubr2Stage ($ObjStage->GetMethodesAnalyse(), 
										                      $Msg_FormStage [MSGFORMSTAGE_ANALYSE]);
                                            AffichRubr2Stage ($ObjStage->GetMethodesConception(), 
										                      $Msg_FormStage [MSGFORMSTAGE_CONCEPTION]);
                                            AffichRubr2Stage ($ObjStage->GetMethodesProgrammation(), 
										                      $Msg_FormStage [MSGFORMSTAGE_PROGRAMMATION]);
                                            AffichRubr2Stage ($ObjStage->GetMethodesControleQL(), 
										                      $Msg_FormStage [MSGFORMSTAGE_CONTROLE_QL]);
                                            AffichRubr2Stage ($ObjStage->GetMethodesGestionProjet(), 
										                      $Msg_FormStage [MSGFORMSTAGE_GESTIONPROJET]);
										}
																		   ?>
    <tr><td></td><td><hr size="1" noshade width="100%" align="left"></td></tr>
	                                                                       <?php                                            
										AffichRubr2Stage ($ObjStage->GetSujet(), 
										                  $Msg_FormStage [MSGFORMSTAGE_SUJET]);
																		   ?>
    <tr><td></td><td><hr size="1" noshade width="100%" align="left"></td></tr>
	                                                                       <?php                                           
/*
	                                    AffichRubrStage ($Msg_FormStage [MSGFORMSTAGE_NATURE_TACHE], 
										                 $ReqNatureTache, 
														 $ObjStage->GetNatureTache(), '', 1);
				
	                                    AffichRubrStage  ($Msg_FormStage [MSGFORMSTAGE_INTEGRATION], 
										                  $ReqIntegration, 
														  $ObjStage->GetIntegration(), '', 1);
	                                    AffichRubrStage  ($Msg_FormStage [MSGFORMSTAGE_ENVIRONSTAGIAIRE], 
										                  $ReqEnvironStage, 
														  $ObjStage->GetEnvironStage(), '', 1);

										AffichRubr2Stage ($ObjStage->GetRqs(), 
										                  $Msg_FormStage [MSGFORMSTAGE_REMARQUES]);
																		   ?>
    <tr><td></td><td><hr size="1" noshade width="100%" align="left"></td></tr>
    <tr>
	    <td colspan="2" style="text-align : center; font-weight : bold;">
	        <i><?=$Msg_FormStage [MSGFORMSTAGE_DESCR_SERVICE]?></i>
		</td>
	</tr>
	<tr>
	    <td colspan="2"><table>
	                                                                       <?php                                            
										AffichRubr2Stage ($ObjStage->GetNPCI(), 
										                  $Msg_FormStage [MSGFORMSTAGE_NBPERS_CI]);
										AffichRubr2Stage ($ObjStage->GetNbStag(), 
										                  $Msg_FormStage [MSGFORMSTAGE_NBSTAGIAIRES]);
										AffichRubr2Stage ($ObjStage->GetNbPS(), 
										                  $Msg_FormStage [MSGFORMSTAGE_NBPERS_SERV]);
										AffichOuiNon     ($Msg_FormStage [MSGFORMSTAGE_OLDSTAGIAIRES],
										                  $ObjStage->GetSTAG()); 
																		   ?>
		</td></table>
	</tr>		
    <tr><td></td><td><hr size="1" noshade width="100%" align="left"></td></tr>
    <tr>
	    <td colspan="2" style="text-align : center; font-weight : bold;">
	        <i><?=$Msg_FormStage [MSGFORMSTAGE_RENS_PRATIQUES]?></i>
		</td>
	</tr>
	<tr>
	    <td colspan="2"><table>
                                                                       <?php
                                        AffichOuiNonDetail ($Msg_FormStage [MSGFORMSTAGE_INDEMN_STAGE],
										                    $ObjStage->GetIndemnStage(), 
                                                            $ObjStage->GetMIndemnStage());
                                        AffichOuiNonDetail ($Msg_FormStage [MSGFORMSTAGE_INDEMN_REPAS],
										                    $ObjStage->GetIR(),  
                                                            $ObjStage->GetMIR());
                                        AffichOuiNonDetail ($Msg_FormStage [MSGFORMSTAGE_INDEMN_TRANSPORT],
										                    $ObjStage->GetIT(),  
                                                            $ObjStage->GetMIT());
                                        AffichOuiNonDetail ($Msg_FormStage [MSGFORMSTAGE_MOYEN_TRANSPORT],
										                    $ObjStage->GetMT(),  
                                                            $ObjStage->GetMMT());
                                        AffichOuiNonDetail ($Msg_FormStage [MSGFORMSTAGE_EMBAUCHE],
										                    $ObjStage->GetEmb(), '');
*/
																		   ?>
	    </table></td>
	</tr>


</table>
</td></tr></table>
<table align="center">
<tr>
<td style="text-align="center">
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
