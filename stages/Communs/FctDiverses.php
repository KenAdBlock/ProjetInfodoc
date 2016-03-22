<?php
//
// Fichier FctDiverses.php
//
// IsInSet(), CalcCodeBin(), ErrorLogin(), NormaliserTel()
// 
// AffichOuiNon(), AffichOuiNonDetail(), AffichRubrStage()
// AffichRubr2Stage(), AffichSepar(), AffichTitre()

// SaisieOuiNon(), SaisieOuiNonEtAutre(), SaisieRubrTextArea()
// SaisieRubrInput(), SaisieRubrStage(), SaisieRubrStageEtAutre()

function NormaliserTel (&$Tel)
{
    return 0;
	/*                                                          * /
	// Supprimé le 09/10/2007 à la demande de Sylvie

    $Chaine = $Tel;
    for ($i = 0, $j = 0; $i < strlen ($Chaine); ++$i)
	    if ($Chaine [$i] != ' ' && $Chaine [$i] != '-')
		    $Chaine [$j++] = $Chaine [$i];
	for ( ; $j < strlen ($Chaine); ++$j) $Chaine [$j] = ' ';
	$Chaine = trim ($Chaine);
	if (! ctype_digit ($Chaine)) return CARINVAL_IN_TEL;
	if (strlen ($Chaine) != 10)  return LGINVAL_IN_TEL;
	$Tel = '              ';
	for ($j = 0, $i = 0; $i < 10; )
	{
	    $Tel [$j++] = $Chaine [$i++];
	    if (($i % 2) == 0) ++$j;
	}
	return 0;
	/*   */
		
} // NormaliserTel()
		
function ErrorLogin ($Login, $IsNew = 1)
//       ==========
{
    global $NomTabUsers, $ConnectStages;
	
    // 7 à 12 caractères alpha-numériques + '_'
	
    $Nb = substr_count ($Login, "_");
	$Lg = strlen ($Login);
	if ($Nb == $Lg) return LOGINUNDERSCORE;

    $LoginSans_ = str_replace ("_", "x", $Login);
	
	if (! ctype_alnum ($LoginSans_)) return LOGINCARINVAL;
	
	if ($Lg < MINLGLOGIN || $Lg > MAXLGLOGIN) return LOGINNBCARINVAL;

	if ($IsNew)
	{

		$ReqUsers = $ConnectStages->prepare("SELECT Login FROM $NomTabUsers WHERE Login = :Login");
		$ReqUsers->bindValue(':Login', $Login);
		$ReqUsers->execute();
	    if ($ReqUsers->rowCount()) return LOGINDEJAPRIS;
	}

	return 0;

} // ErrorLogin()

function CalcCodeBin ($Requete)
//       ===========
{
	$CodeBin = 0;
    while ($Obj = $Requete->fetch())
	    if ($_POST [$Obj['Code']]) $CodeBin += $Obj['CodeBin'];

	return $CodeBin;

}  // CalcCodeBin ()

function IsInSet ($Val, $Masque)
//       =======
{
    return ((0 + $Val) & (0 + $Masque)) == (0 + $Val);
	
} // IsSet()

function SaisieRubrStage ($SymboleValid, $Libelle, $Requete, $Masque, 
//       ===============
                          $NbParLigne = 1,
						  $Align = 'right') 
{
    $Bold    = $SymboleValid == '' ? '' : '<b>';
    $FinBold = $SymboleValid == '' ? '' : '</b>';
						                                                   ?>
    <div class="input-field col s12">
		<?=$SymboleValid?>
        
		    <?=$Bold.$Libelle.$FinBold?>
        
		
		
										                                   <?php
                                        $Reste = 100;
                                        for ($i = $NbParLigne; $i; --$i)
										{
    										$Width = $Reste / $i;
											$Reste -= $Width;
										                                   ?>
             
										                                   <?php
										}
										                                   ?>
		
										                                   <?php
										$NbSurLigne = 0;
		                                while ($Obj = $Requete->fetch())
										{
										    if ($NbSurLigne == 0)
											{
										                                   ?>
            
										                                   <?php
											}
										                                   ?>
				<div class="input-field col s12">
                    <input class="filled-in" id="<?=$Obj['Libelle']?>"type="checkbox" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>"
					       <?=(IsInSet ($Obj['CodeBin'], $Masque)) ? 'checked' : ''?>>

		            <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
		            </div>
										                                   <?php
											if (++$NbSurLigne == $NbParLigne)
											{
										        $NbSurLigne = 0;
										                                   ?>			
			
										                                   <?php
										    }
										}
									    if ($NbSurLigne != 0)
										{
										                                   ?>			
			
										                                   <?php
										}
										                                   ?>
        
	</div>
										                                   <?php
} // SaisieRubrStage()

function SaisieRubrStageEtAutre ($SymboleValid, $Libelle, $Requete, $Masque,
//       ======================
                                 $SymboleValidAutre, $NameAutre, $ValAutre, 
								 $NbParLigne = 1) 
{
    SaisieRubrStage ($SymboleValid, $Libelle, $Requete, $Masque, $NbParLigne);
										                                   ?>
    <div class="row">
    	<div class="input-field col s12">
		<?=$SymboleValidAutre?>
        
        
            <input type="text" name="<?=$NameAutre?>" id="<?=$NameAutre?>" size="50" 
			       value="<?=$ValAutre?>">
			       <label for="<?=$NameAutre?>">Autres</label>
        </div>
    </div>
										                                   <?php
} // SaisieRubrStageEtAutre()

function SaisieCkeckBox ($Libelle, $NameCheckBox, $ValeurCheckBox, $Align = 'right')
//       ==============
{
                                        $SymboleValid = '' ;
                                        if ($Align == 'right')
										{
                                                                          ?>
    <tr>
        <td style="text-align : right" valign="top"; colspan="2">
		    <?=$Libelle?>
		</td>
		<td valign="top">
            <input type="checkbox" name="<?=$NameCheckBox?>" value="1"
		           <?=$ValeurCheckBox ? 'checked' : ''?>
		</td>
	</tr>
                                                                          <?php
		                                }
										else
										{
                                                                          ?>
    <tr>
		<td  style="text-align : right" valign="top" colspan="2" >
            <input type="checkbox" name="<?=$NameCheckBox?>" value="1"
		           <?=$ValeurCheckBox ? 'checked' : ''?>
		</td>
        <td style="text-align : left" valign="top">
		    <?=$Libelle?>
		</td>
	</tr>
                                                                          <?php
		                                }
} // SaisieCkeckBox()

function SaisieOuiNon ($Libelle, $NameRadioBtn, $ValeurRadioBtn, $Align = 'left',
//       ============
                       $LibelleOui = 'Oui', $LibelleNon = 'Non')
{
    $SymboleValid = '' ;
                                                                          ?>
    <div class="row">
    <div class="col s4">
	    <?=$SymboleValid?>

		    <p><br><?=$Libelle?></p>
		
        </div>
        <div class="input-field col s8">
            <input id="<?=$Libelle?>.<?=$LibelleOui?>" type="radio" name="<?=$NameRadioBtn?>" value="1"
			       <?=$ValeurRadioBtn == 1 ? 'checked' : ''?> >
			       <label for="<?=$Libelle?>.<?=$LibelleOui?>"><?=$LibelleOui?></label>
            <input id="<?=$Libelle?>.<?=$LibelleNon?>" type="radio" name="<?=$NameRadioBtn?>" value="0"
			       <?=$ValeurRadioBtn == 1 ? '' : 'checked'?> >
			       <label for="<?=$Libelle?>.<?=$LibelleNon?>"><?=$LibelleNon?></label>
		
	</div>
	</div>
                                                                          <?php
} // SaisieOuiNon()

function SaisieOuiNonEtAutre ($SymboleValid, $Libelle, $NameRadioBtn, $ValeurRadioBtn,
//       ===================
                              $LibelleAutre, $NameAutre, $ValeurAutre, 
							  $Align = 'left')
{
                                                                          ?>
    <div class="row">
    	<div class="col s12"></div>
    <div class="col s4">
	    <?=$SymboleValid?>
	<p><br><?=$Libelle?></p>
	</div>
	<div class="input-field col s4">
		    <input id="<?=$Libelle?>.'oui'" type="radio" name="<?=$NameRadioBtn?>" value="1"
			       <?=$ValeurRadioBtn == 1 ? 'checked' : ''?> >
			       <label for="<?=$Libelle?>.'oui'">Oui</label>
            <input id="<?=$Libelle?>.'non'" type="radio" name="<?=$NameRadioBtn?>" value="0"
			       <?=$ValeurRadioBtn == 1 ? '' : 'checked'?> >
			       <label for="<?=$Libelle?>.'non'">Non</label>
		    
		    
        
    </div>
    <div class="input-field col s12">
<input id="<?=$Libelle?>.<?=$LibelleAutre?>" type="text" name="<?=$NameAutre?>" size="25" 
			       value="<?=$ValeurAutre?>">
			       <label for="<?=$Libelle?>.<?=$LibelleAutre?>"><?=$LibelleAutre?></label>
    </div>
    </div>
                                                                           <?php
} // SaisieOuiNonEtAutre()

function SaisieRubrInput ($Libelle, $NameInput, $ValeurInput, 
//       ===============
                          $SymboleValid = '', $Obligatoire = 0, $Align = 'left')
{
    $Bold    = $Obligatoire ? '<b>' : '';
    $FinBold = $Obligatoire ? '</b>' : '';
                                                                            ?>

    <div class="input-field col s12 m6 l6">
        <?=$SymboleValid?>
		
		    
	    
        
            <input id="<?=$Libelle?>" type="text" name="<?=$NameInput?>"
			       value="<?=$ValeurInput?>">
			       <label for="<?=$Libelle?>"><?=$Bold.$Libelle.$FinBold?></label>
        
    </div>
                                                                          <?php
} // SaisieRubrInput()

function SaisieRubrIntEnum ($Libelle, $NameInput, $ValeurInput, $ValFirst, 
//       =================
                            $ValLast, $Align = 'left')
{
    $SymboleValid = ' ' ;                                                                           ?>
   <div class="row">
   <div class="input-field col s12">
        <?=$SymboleValid?>
		
		    

<select class="browser-default" name="<?=$NameInput?>" size="1">
                                                                          <?php
                                        for ($i = $ValFirst; $i <= $ValLast; ++$i)
										{
										                                  ?>
<option value="<?=$i?>" <?=$ValeurInput == $i ? 'selected' : '' ?> ><?=$i?></option>
                                                                          <?php
                                        }
										                                  ?>
</select>
<label><?=$Libelle?></label>
        </div>
         </div>                                                                 <?php
} // SaisieRubrIntEnum()

function SaisieRubrStringEnum ($Libelle, $NameInput, $ValeurInput, 
                               $ValPossibles, $Align = 'left')
//       ===============
{
    $SymboleValid = ' ' ;                                                                           ?>

        <?=$SymboleValid?>
        <div class="row">
<div class="input-field col s12">
<select class="browser-default" name="<?=$NameInput?>" size="1">
                                                                          <?php
                                        for ($i = 0; $i < count ($ValPossibles); ++$i)
										{
										                                  ?>
<option value="<?=$ValPossibles [$i]?>" <?=$ValeurInput == $ValPossibles [$i] ? 'selected' : '' ?> ><?=$ValPossibles [$i]?></option>
                                                                          <?php
                                        }
										                                  ?>
</select>
<label><?=$Libelle?></label>
</div>
</div>
                                                                          <?php
} // SaisieRubrIntEnum()

function SaisieRubrTextArea ($Libelle, $NameTextArea, $ValeurTextArea, 
//       ==================
                             $SymboleValid, 
							 $ColsTextArea, 
							 $RowsTextArea, 
							 $Align = 'left')
{
    $Bold    = $SymboleValid == '' ? '' : '<b>';
    $FinBold = $SymboleValid == '' ? '' : '</b>';
                                                                           ?>
    <tr>
        <td valign="top"><?=$SymboleValid?></td>
        <td style="text-align : <?=$Align?>" valign="top">
		    <?/*=$Bold.$Libelle.$FinBold*/?>
		    <?=$Bold.$Libelle.$FinBold?>
	    </td>
        <td>
            <textarea name="<?=$NameTextArea?>" 
			          cols="<?=$ColsTextArea?>" 
			          rows="<?=$RowsTextArea?>"
			    ><?=stripslashes ($ValeurTextArea)?>
			</textarea>
        </td>
    </tr>
                                                                          <?php
} // SaisieRubrTextArea()

function SaisieSujet ($Libelle, $NameTextArea, $ValeurTextArea, 
//       ===========
                             $SymboleValid, 
							 $ColsTextArea, 
							 $RowsTextArea, 
							 $Align = 'left')
{
    $Bold    = $SymboleValid == '' ? '' : '<b>';
    $FinBold = $SymboleValid == '' ? '' : '</b>';
                                                                           ?>
    <div class="input-field col s12">
        <?=$SymboleValid?>
        <?=$Bold.$Libelle.$FinBold?>
            <textarea id="<?=$Libelle?>" class="materialize-textarea" name="<?=$NameTextArea?>" 
			          cols="<?=$ColsTextArea?>" 
			          rows="<?=$RowsTextArea?>"
			    ><?=stripslashes ($ValeurTextArea)?></textarea>
			    <label for="<?=$Libelle?>"><?=$Bold.$Libelle.$FinBold?></label>
        
    </div>
                                                                          <?php
} // SaisieSujet()

function AffichTitre ($Libelle, $Niveau = 1, $Align = 'left', $FontWeight = 'bold')
//       ===========
{
	$Spaces = '';
    // for ($i = 2; $i < $Niveau; ++$i) $Spaces .= '&nbsp; &nbsp; &nbsp; ';
                                                                           ?>
	<tr>
	    <td></td>
        <td colspan="2">
		    <h<?=$Niveau?> style="text-align : <?=$Align?>; font-weight : <?=$FontWeight?>" >
		        <?=$Spaces.$Libelle?>
		    </h<?=$Niveau?>>
		</td>
	</tr>
                                                                          <?php
} // AffichTitre()

function AffichSepar ()
//       ===========
{
                                                                           ?>
    <tr>
	    <td colspan="3">
		    <hr size="1" noshade width="100%" align="left">
		</td>
	</tr>
                                                                          <?php
} // AffichSepar()

function AffichLigneVierge ()
//       ===========
{
                                                                           ?>
    <tr><td colspan="3">&nbsp;</td></tr>
                                                                          <?php
} // AffichLigneVierge()
	
function AffichRubrStage ($Libelle, $Requete, $Masque, $Autres = '', 
//       ===============
                          $NbParLigne = 1)
{
    global $PATH_GIFS;
										                                   ?>
    
    <tr>
        <td style="text-align : right" valign="top">
		    <i><?=stripslashes ($Libelle)?></i>
        </td>
		<td valign="top"><table width="100%">
		<colgroup>
										                                   <?php
                                        $Reste = 100;
                                        for ($i = $NbParLigne; $i; --$i)
										{
    										$Width = $Reste / $i;
											$Reste -= $Width;
										                                   ?>
             <col width="<?=$Width?>%">
										                                   <?php
										}
										                                   ?>
		</colgroup>
										                                   <?php
										$NbSurLigne = 0;
		                                while ($Obj = $Requete->fetch())
										{
										    if ($NbSurLigne == 0)
											{
										                                   ?>
            <tr>
										                                   <?php
											}
										                                   ?>			
			    
				<td nowrap valign="top">
		            <img src="<?=$PATH_GIFS?><?=(IsInSet ($Obj['CodeBin'], $Masque)) ? 'cbv' : 'cb'?>.jpg"
			             height="13" width="13">
			        &nbsp;
		            <?=stripslashes ($Obj['Libelle'])?>
		        </td>
										                                   <?php
											if (++$NbSurLigne == $NbParLigne)
											{
										        $NbSurLigne = 0;
										                                   ?>			
			</tr>
										                                   <?php
										    }
										}
									    if ($NbSurLigne != 0)
										{
										                                   ?>			
			</tr>
										                                   <?php
										    }
										                                   ?>
        </table></td>
	</tr>
										                                   <?php
	                                    if ($Autres != '') 
										{
										                                   ?>
	<tr>
	    <td></td>
        <td colspan="2">
		    <i>Autres : </i><?=$Autres?>
		</td>
	</tr>
										                                   <?php
										}
} // AffichRubrStage()

function AffichRubr2Stage ($Rubrique, $Libelle)
{
                                        if ($Rubrique != '') 
                                        {
                                                                          ?>
	<tr>
		<td></td>
	    <td><i><?=stripslashes ($Libelle)?></i></td>
	    <td><?=nl2br($Rubrique)?></td>
	</tr>
                                                                          <?php
                                        }
} // AffichRubr2Stage()

function AffichOuiNonDetail ($Libelle, $Valeur, $Detail)
{
   global $PATH_GIFS;
                                                                          ?>
    <tr>
		<td></td>
        <td style="text-align : right" valign="top">
		    <i><?=$Libelle?></i>
		</td>
		<td valign="top">
		    <img src="<?=$PATH_GIFS?><?=$Valeur ? 'cbv' : 'cb'?>.jpg" height="13" width="13">
		</td>
	</tr>
                                                                          <?php
                                        if ($Detail != '')
										{
                                                                          ?>
	<tr>
        <td style="text-align : right" valign="top">
            <i>Détails</i>
        </td>
        <td valign="top">
            <?=$Detail?>
        </td>
    </tr>
                                                                          <?php
                                        }
} // AffichOuiNonDetail()

function AffichOuiNon ($Libelle, $Valeur)
{
                                                                          ?>
   	<tr>
		<td></td>
	    <td><i><?=$Libelle?></i></td>
        <td><?=$Valeur ? 'oui' : 'non';?></td>
	</tr>
                                                                          <?php
} // AffichOuiNon()

?>