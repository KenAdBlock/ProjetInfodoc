<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$UtilBD = new UtilBD();
	$ConnectLaporte = $UtilBD->ConnectLaporte();
					   
    // Génération de la table des étudiants
	// ====================================

    if (!isset ($Etape)) $Etape = 'Init';
                                                                           ?>
<h4 class="center">Affectation d'un stage</h4>
                                                                           <?php
    switch ($Etape)
    {
      case 'Valid' :
										$ReqStages = $ConnectStages->query("SELECT $NomTabStages.FK_Entreprise,
	                                                                $NomTabStages.Sujet,
	                                                                $NomTabStages.NiveauStage,
	                                                                $NomTabStages.PK_Stage,								
	                                                                $NomTabStages.NbStagesRestant,								
	                                                                $NomTabEntreprises.PK_Entreprise,
	                                                                $NomTabEntreprises.NomE
	                                                             FROM $NomTabStages, $NomTabEntreprises
	                                                             WHERE PK_Stage = '$FK_Stage' 
																                AND
																       $NomTabEntreprises.PK_Entreprise =
						                                                                $NomTabStages.FK_Entreprise
	                                                             ORDER BY NomE");
										if ($ReqStages->rowCount() == 0)
										   print ('Aucun stage ne correspond à ce numéro');
										else
										{
										 	$ObjStage = $ReqStages->fetch();
											if ($ObjStage['NbStagesRestant'] == 0)
										        print ('Stage déjà pourvu');
											else
											{
												$ReqEtudAffecte = $ConnectLaporte->prepare("SELECT * FROM $NomTabUsers
			  	                                                             				WHERE Identifiant = :LoginCache
																			    			AND FK_STAGE = 0");
												$ReqEtudAffecte->bindValue(':LoginCache', $LoginCache);
												$ReqEtudAffecte->execute();
												if ($ReqEtudAffecte->rowCount() == 0)
										           print ('Étudiant déjà affecté');
										        else
										        {
												    $LibelleNiveau = 'Stage de ';
													switch ($ObjStage['NiveauStage'])
													{
													    case 1 :
														  $LibelleNiveau .= 'DUT';
														  break;
														  
														case 2 :
														  $LibelleNiveau .= 'LP';
														  break;
														  
														case 3 :
														  $LibelleNiveau .= 'DUT ou LP';
														  break;
														  
													}
											                               ?>
<form name="Confirmation" method="POST">
<table>
    <tr>
	    <td colspan="2" style="text-align : center"><?=$LibelleNiveau?></td>
	</tr>
    <tr>
	    <td><b>Étudiant</b>
		<td><?=$NomPrenom?></td>
	</tr>
    <tr>
	    <td><b>login</b>
		<td><?=$LoginCache?></td>
	</tr>
    <tr>
	    <td><b>Entreprise</b>
		<td><?=$ObjStage['NomE']?></td>
	</tr>
</table>
<p class="center">
	<button type="reset" class="waves-effect waves-light btn black white-text" onClick="history.go (-1)">Retour</button>
	<button type="submit" class="waves-effect waves-light btn bleu1 white-text">Valider</button>
</p>
<input type="hidden" name="Etape"       value="Confirm">
<input type="hidden" name="Identifiant" value="<?=$LoginCache?>">
<input type="hidden" name="FK_Stage"    value="<?=$FK_Stage?>">
</form>
                                                                           <?php
										        }
										    }
                                        }
 		break;
		
      case 'Confirm' :
		$Req = $ConnectLaporte->prepare("UPDATE $NomTabUsers 
										 SET FK_Stage = :FK_Stage
										 WHERE Identifiant = :Identifiant");
		$Req->bindValue(':Identidiant', $Identifiant);
		$Req->bindValue(':FK_Stage', $Fk_Stage);
		$Req->execute();

		$Req = $ConnectStages->prepare("UPDATE $NomTabStages 
										SET NbStagesRestant = NbStagesRestant - 1
										WHERE PK_Stage = :FK_Stage");
		$Req->bindValue(':FK_Stage', $Fk_Stage);
		$Req->execute();

		$Etape = 'Init';
		
      case 'Init' :
		$ReqStages = $ConnectStages->prepare("SELECT $NomTabStages.FK_Entreprise,
	                             $NomTabStages.NiveauStage,
	                             $NomTabStages.Sujet,
	                             $NomTabStages.PK_Stage,
					 $NomTabStages.NbStagesRestant,								
					 $NomTabEntreprises.PK_Entreprise,
					 $NomTabEntreprises.NomE
	                         FROM $NomTabStages, $NomTabEntreprises
	                         WHERE $NomTabEntreprises.PK_Entreprise =
						           $NomTabStages.FK_Entreprise
	                         AND PK_Stage = :FK_Stage");
		$ReqStages->bindValue(':FK_Stage', $FK_Stage);
		$ReqStages->execute();
	  if ($ReqStages->rowCount() == 0)
		print ('Aucun stage ne correspond à ce numéro');
	  else
	  {
		$ObjStage = $ReqStages->fetch();
		if ($ObjStage['NbStagesRestant'] == 0)
			print ('Stage déjà pourvu');
		else
		{
   			$LibelleNiveau = 'Stage n° '.$ObjStage['PK_Stage'].' pour ';
                     $Where = ' WHERE ';
			switch ($ObjStage['NiveauStage'])
			{
				case 1 :
					$LibelleNiveau .= 'DUT';
                                   $Where .= 'FK_Statut = 6  OR FK_Statut = 10 ';
					break;
														  
				case 2 :
					$LibelleNiveau .= 'LP';
                                   $Where .= 'FK_Statut = 10 ';
					break;
														  
				case 3 :
					$LibelleNiveau .= 'DUT ou LP';
                                   $Where .= 'FK_Statut = 6 OR FK_Statut = 10 ';
					break;
														  
			}
			$ReqEtud = $ConnectLaporte->query("SELECT * FROM $NomTabUsers".$Where." ORDER BY Nom");
?>

<script language=javascript>
			var TabNoms   = new Array();
			var TabLogins = new Array();
			var NbEtud = 0;
</script>
<?php
                      for ( ; $Obj =  $ReqEtud->fetch(); )
                      {
?>
<script language=javascript>
    			TabNoms   [NbEtud]   = "<?=$Obj['Nom'].' '.$Obj['Prenom']?>";
				TabLogins [NbEtud++] = "<?=$Obj['Identifiant']?>";
</script>
<?php
                       }
?> 
<script language=javascript>
			  var LgPrec = 0;
			  function MAJTxtAffich () 
			  {
				var ChaineCherchee = document.forms["ZoneSaisie"].NomPrenom.value;
       			if (ChaineCherchee.length == 0) return;
				LgCourante = ChaineCherchee.length;
				if (LgCourante <= LgPrec) 
				{
	    				LgPrec = LgCourante;
	    				return;
				}
				LgPrec = LgCourante;
				var NbOccurr = 0;
				var IndOccurr;
				for (var i = 0; i < NbEtud; ++i)
       			{
					if (TabNoms [i].substr (0, LgCourante) == ChaineCherchee)
					{
		    			++NbOccurr;
						IndOccurr = i;
					}
				}
				if (NbOccurr == 1)
				{
         			document.forms["ZoneSaisie"].NomPrenom.value  = TabNoms   [IndOccurr];
	  				document.forms["ZoneSaisie"].LoginCache.value = TabLogins [IndOccurr];
       			}
			  } 
</script> 

<form name="ZoneSaisie" method="POST">
<table border="0" style="text-align : center"><tr><td>
<table>
    <tr>
        <td colspan="2" style="text-align : center">
		<?=$LibelleNiveau?>
		<br />
		Entreprise : <?=$ObjStage['NomE']?>
        </td>
    </tr>
    <tr>
	    <td style="text-align : right"><b>Étudiant</b>
        <td >
			<div class="input-field">
		    <input type="text" name="NomPrenom" maxlength="50" size="30" 
			        value="" onKeyUp="MAJTxtAffich ();">
		    <input type="hidden" name="LoginCache"></div>
        </td>
	</tr>
	<?php /*
    <tr>
	    <td style="text-align : right"><b>N° du stage :</b>
        <td >
		    <input type="text" name="FK_Stage" maxlength="5" size="5" 
			        value="">
        </td>
	</tr>
	*/ ?>
</table>
</td></tr></table>
<p class="center">
	<button type="reset" class="waves-effect waves-light btn black white-text" onClick="history.go (-1)">Réinitialiser</button>
	<button type="submit" class="waves-effect waves-light btn bleu1 white-text">Valider</button>
</p>
<input type="hidden" name="Etape" value="Valid" >
</form>
<script type="text/javascript">document.ZoneSaisie.NomPrenom.focus();</script>
                                                                           <?php
										    }
                                        }

        break;
    }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>

