<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $NomBaseMathieu  = /*"mathieu"*/"laporte"; 
    $NomBaseStages   = "stages"; 
    $UserMathieu     = /*"mathieu"*/"root";
    $PasswdMathieu   = /*"dm2ml"*/"";
    $HoteMathieu     = "localhost";
    $ConnectMathieu = ConnectSelect ($HoteMathieu,   $UserMathieu,
                                     $PasswdMathieu, $NomBaseMathieu);
					   
    // Génération de la table des étudiants
	// ====================================

    if (!isset ($Etape)) $Etape = 'Init';
                                                                           ?>
<h1>Affectation d'un stage</h1>
                                                                           <?php
    switch ($Etape)
    {
      case 'Valid' :
                                        $ReqStages = Query ("SELECT $NomTabStages.FK_Entreprise,
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
	                                                             ORDER BY NomE",
	                                                        $Connexion);
										if (mysql_num_rows ($ReqStages) == 0)
										   print ('Aucun stage ne correspond � ce num�ro');
										else
										{
										 	$ObjStage = mysql_fetch_object ($ReqStages);
											if ($ObjStage->NbStagesRestant == 0)
										        print ('Stage d�j� pourvu');
											else
											{
                                                $ReqEtudAffecte = Query ("SELECT * FROM $NomTabUsers
			  	                                                             WHERE Identifiant = '$LoginCache'
																			    AND FK_STAGE = 0",
	                                                                     $ConnectMathieu);
										        if (mysql_num_rows ($ReqEtudAffecte) == 0)
										           print ('Etudiant d�j� affect�');
										        else
										        {
												    $LibelleNiveau = 'Stage de ';
													switch ($ObjStage->NiveauStage)
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
	    <td><b>Etudiant</b>
		<td><?=$NomPrenom?></td>
	</tr>
    <tr>
	    <td><b>login</b>
		<td><?=$LoginCache?></td>
	</tr>
    <tr>
	    <td><b>Entreprise</b>
		<td><?=$ObjStage->NomE?></td>
	</tr>
</table>
<p>
    <input type="reset" value="Retour" onClick="history.go (-1)">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="Valider" >
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
		Query ("UPDATE $NomTabUsers 
		            SET FK_Stage = '$FK_Stage'
		            WHERE Identifiant = '$Identifiant'",
			   $ConnectMathieu);

		Query ("UPDATE $NomTabStages 
		            SET NbStagesRestant = NbStagesRestant - 1
		            WHERE PK_Stage = '$FK_Stage'",
			   $Connexion);

		$Etape = 'Init';
		
      case 'Init' :
        $ReqStages = Query ("SELECT $NomTabStages.FK_Entreprise,
	                             $NomTabStages.NiveauStage,
	                             $NomTabStages.Sujet,
	                             $NomTabStages.PK_Stage,
					 $NomTabStages.NbStagesRestant,								
					 $NomTabEntreprises.PK_Entreprise,
					 $NomTabEntreprises.NomE
	                         FROM $NomTabStages, $NomTabEntreprises
	                         WHERE $NomTabEntreprises.PK_Entreprise =
						           $NomTabStages.FK_Entreprise
	                         AND PK_Stage = ".$FK_Stage,
	                      $Connexion);
	  if (mysql_num_rows ($ReqStages) == 0)
		print ('Aucun stage ne correspond � ce num�ro');
	  else
	  {
		$ObjStage = mysql_fetch_object ($ReqStages);
		if ($ObjStage->NbStagesRestant == 0)
			print ('Stage d�j� pourvu');
		else
		{
   			$LibelleNiveau = 'Stage n� '.$ObjStage->PK_Stage.' pour ';
                     $Where = ' WHERE ';
			switch ($ObjStage->NiveauStage)
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
			$ReqEtud = Query ("SELECT * FROM $NomTabUsers".$Where." ORDER BY Nom", $ConnectMathieu);
?>

<script language=javascript>
			var TabNoms   = new Array();
			var TabLogins = new Array();
			var NbEtud = 0;
</script>
<?php 
	               mysql_data_seek ($ReqEtud, 0);

                      for ( ; $Obj =  mysql_fetch_object ($ReqEtud); )
                      {
?>
<script language=javascript>
    				TabNoms   [NbEtud]   = "<?=$Obj->Nom.' '.$Obj->Prenom?>";
				TabLogins [NbEtud++] = "<?=$Obj->Identifiant?>";
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
		Entreprise : <?=$ObjStage->NomE?>
        </td>
    </tr>
    <tr>
	    <td style="text-align : right"><b>Etudiant :</b>
        <td >
		    <input type="text" name="NomPrenom" maxlength="50" size="30" 
			        value="" onKeyUp="MAJTxtAffich ();">
		    <input type="hidden" name="LoginCache">
        </td>
	</tr>
	<?php /*
    <tr>
	    <td style="text-align : right"><b>N� du stage :</b>
        <td >
		    <input type="text" name="FK_Stage" maxlength="5" size="5" 
			        value="">
        </td>
	</tr>
	*/ ?>
</table>
</td></tr></table>
<p>
    <input type="reset" value="Reinitialiser">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="Valider" >
</p>
<input type="hidden" name="Etape" value="Valid" >
</form>
<script type="text/javascript"><!-- document.ZoneSaisie.NomPrenom.focus(); //--></script> 
                                                                           <?php
										    }
                                        }

        break;
    }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez acc�der directement � cette page</h2>
<?php
}
?>

