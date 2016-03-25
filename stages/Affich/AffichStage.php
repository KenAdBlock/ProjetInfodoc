<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    require_once ($PATH_COMMUNS.'FctDiverses.php'); // IsInSet()
	
	$ReqLangages = $ConnectStages->query("SELECT * FROM $NomTabLangages");
	$ReqMateriels = $ConnectStages->query("SELECT * FROM $NomTabMateriels");
	$ReqBDs = $ConnectStages->query("SELECT * FROM $NomTabBasesDonnees");

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
<span class="card-title"><h4 class="center">Année 2015-2016 : fiche de stage n° <?=$ValPK_Stage?></h4></span>

<h6 class="center">
    <b>proposé <?=$MsgProposeA [$ObjStage->GetNiveauStage()]?></b>
</h6>
	<hr>
                                                                         <?php
	    /* ================================= */
	    /* 1. Entreprise                     */
	    /* ================================= */
        AffichTitre ($Msg_FormStage [MSGFORMSTAGE_1], 2);
                                                                          ?>
            <div class="row">
        	    <div class="col s5"><b>Nom :</b></div>
            	<div class="col s7"><b><?=$ObjEntreprise->GetNomE()?></b></div>
			</div>
			<div class="row">
                <div class="col s5"><b>Adresse du lieu de stage :</b></div>
                <div class="col s7"><?=$Adr1Stage?></div>
            </div>
	
	                                                                       <?php
                                        if ($Adr2Stage != '')
										{
                                                                          ?>
            <div class="row">
                <div class="col s7 push-s5"><?=$Adr2Stage?></div>
            </div>
	
	                                                                       <?php
                                        }
                                                                          ?>
			<div class="row">
                <div class="col s7 push-s5"><?=$CPStage?> - <?=$VilleStage?></div>
            </div>
        
	
	                                                                       <?php
                                        if ($ObjEntreprise->GetPresentEntreprise() != '')
										{
                                            AffichLigneVierge();
                                                                          ?>
 			<div class="row">
                <div class="col s5"><b>Présentation de l'entreprise :</b></div>
                <div class="col s7"><?=$ObjEntreprise->GetPresentEntreprise()?></div>
            </div>
      
	
	                                                                       <?php
										}
                                        if ($ObjEntreprise->GetSiteEntreprise() != '')
										{
                                            AffichLigneVierge();
                                                                          ?>
			<div class="row">
                <div class="col s5"><b>Site web de l'entreprise :</b></div>
                <div class="col s7"><a href="<?=$ObjEntreprise->GetSiteEntreprise()?>" target="_blank">
			    <?=$ObjEntreprise->GetSiteEntreprise()?>
			</a></div>
            </div>
		
		                                                                 <?php
										}
                                        AffichLigneVierge();
                                                                         ?>
				<br>

        	<b>Renseignements administratifs :</b><br><br>
					<div class="info-table">
	    	<table class="bordered striped" >
				<thead class="bleu1 white-text">
				<tr>
       	   	        <th >&nbsp;</th>
                    <th >Responsable administratif</th>
                    <th >Maître de stage</th>
                </tr>
				</thead>
                <tr>
                    <th>Nom</th>
                    <td><?=$ObjEntreprise->GetPrenomR()?>
					    <?=$ObjEntreprise->GetNomR()?>
					</td>
                    <td><?=$ObjUser->GetPrenom()?>
					    <?=$ObjUser->GetNom()?>
					</td>
                </tr>
                <tr>
                    <th>Tél.</th>
                    <td><?=$ObjEntreprise->GetTelR()?>&nbsp;</td>
                    <td><?=$ObjUser->GetTel()?>&nbsp;</td>
                </tr>
                <tr>
                    <th>e-mail</th>
                    <td><?=$ObjEntreprise->GetMailR()?>&nbsp;</td>
                    <td><?=$ObjUser->GetMail()?>&nbsp;</td>
                </tr>
               <tr>
                    <th>Fax</th>
                    <td><?=$ObjEntreprise->GetFaxR()?>&nbsp;</td>
                    <td><?=$ObjUser->GetFax()?>&nbsp;</td>
                </tr>
            </table>
		</div>
                                                                           <?php
                                        AffichLigneVierge();
                                                                           ?>
<div class="row">
	<div class="col s12">
		

        <b>Service</b>

        <ul>
        	<li>
        <?=$Msg_FormStage [MSGFORMSTAGE_NBPERS_CI]?>
		                <?=$ObjStage->GetNbPersCentreInfo()?>
			</li>
			<li>
        L'entreprise 
		     <?=$ObjStage->GetAreOldStagiaires() ? 'a déjà'
			                                     : 'n\'a encore jamais'?>
		     accueilli des stagiaires de notre département auparavant
			</li>
			<li>
        <?=$Msg_FormStage [MSGFORMSTAGE_NBSTAGIAIRES]?>
		                <?=$ObjStage->GetNbStagesProposes()?> 
			</li>
			<li>
        <?=$Msg_FormStage [MSGFORMSTAGE_NBPERS_SERV]?>
		                <?=$ObjStage->GetNbPersonnesService()?> 
			</li>
			<li>
        Le stagiaire travaillera
		     <?=$ObjStage->GetIsStagiaireSeul() 
			     ? $Msg_FormStage [MSGFORMSTAGE_SEUL]
			     : $Msg_FormStage [MSGFORMSTAGE_COLL_INFORM]?>
			</li>
		
        </ul>           
        	</div>
                                                      <?php
                                        AffichLigneVierge();
                                                                           ?>

	<div class="col s12">
        <b>Renseignements pratiques</b>
		<ul>
			<li>
        Indemnités mensuelles :
		                <?=$ObjStage->GetIndemnitesMensuellesStage();?> &euro;
			</li>
			<li>
        Repas :
		                <?=($ObjStage->GetIndemnitesRepas() == '')
						     ? 'non' : $ObjStage->GetIndemnitesRepas();?>
			</li>
			<li>
        Transport :
		                <?=($ObjStage->GetIndemnitesTransport() == '')
						     ? 'non' : $ObjStage->GetIndemnitesTransport();?>
			</li>
			<li>
        <?=$Msg_FormStage [MSGFORMSTAGE_EMBAUCHE]?> :
		                <?=($ObjStage->GetIsEmbauchePossible())
						     ? 'oui' : 'non'?>
						     </li>
		</ul>

  </div>
</div>                 
<hr>                                                          <?php
                                        

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
		AffichLigneVierge ();
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_LANGAGES], 6, 'bold');

	                                    AffichRubrStage (
                                            $Msg_FormStage [MSGFORMSTAGE_LANG],
                                            $ReqLangages,
                                            $ObjStage->GetLangages(),
                                            $ObjStage->GetAutresLangages(),
                                            LANG_PAR_LIGNE);
 
       AffichLigneVierge ();
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_BD], 6, 'bold');
	   
	                                    AffichRubrStage (
                                            '',
                                            $ReqBDs,
                                            $ObjStage->GetBD(),
                                            $ObjStage->GetAutresBD(),
                                            BD_PAR_LIGNE);
       AffichLigneVierge ();
																		   ?>

        <?=$Msg_FormStage [MSGFORMSTAGE_LOGICIELS_SPEC]?> :
		                <?=($ObjStage->GetLogicielsSpecifiques() == '')
						     ? 'non' : $ObjStage->GetLogicielsSpecifiques()?>
		
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
		
	                                                                       <?php
	/*
	    ========
	    3. Sujet
	    ========
	*/
       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_SUJET], 2);
																		   ?>
 	
	                                                                       <?php
       AffichRubr2Stage ($ObjStage->GetSujet(), '');
																		   ?>
		
	                                                                     <?php	   
       AffichLigneVierge ();

       AffichTitre  ($Msg_FormStage [MSGFORMSTAGE_NATURE_TACHE], 4, 'normal');   
																		   ?>
 	
	                                                                       <?php
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_PROGRAMMATION], $ObjStage->GetIsNatureTacheProgr());
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_ANALYSE],       $ObjStage->GetIsNatureStageAnalyse());
																		   ?>
		
	                                                                       <?php

       

       AffichTitre ($Msg_FormStage [MSGFORMSTAGE_INTEGRATION], 4, 'normal');
																		   ?>

	                                                                       <?php
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_INTEGRPROJETGLOBAL], $ObjStage->GetIsIntegrationProjetGlobal());
       AffichOuiNon ($Msg_FormStage [MSGFORMSTAGE_ENTITEINDEPENDANTE], $ObjStage->GetIsIntegrationEntiteIndependante());
																		   ?>
		
<br><br>

<div class="row">
<div class="col s1 ">
<a href="<?=$PATH_GENERAL?>Print.php?SlxPage=<?=$SlxPage?>" 
			   title="Imprimer"
			   target="_blank"
		       onMouseOver="window.status='Imprimer'; return true"
               onMouseOut ="window.status=''; return true"
                ><img src="<?=$PATH_GIFS?>PrintCourant.gif" border="0">
</a>
</div>
<div class="col s11 center">
<button type="reset" class="waves-effect waves-light btn black white-text" onClick="history.go()">Retour</button>
	<?php
	if (GetDroits ($Status, 'ModifStage'))
	{
	?>
<button type="reset" class="waves-effect waves-light btn bleu1 white-text" onClick="window.location='?Trait=Form&SlxTable=<?=$NomTabStages?>&IdentPK=<?=$ObjStage->GetPK_Stage()?>'">Modifier</button>
</div>
</div>


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
