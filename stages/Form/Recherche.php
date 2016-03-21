<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $ReqOS         = Query ("SELECT * FROM $NomTabOS",             $ConnectStages);
    $ReqLangages   = Query ("SELECT * FROM $NomTabLangages",       $ConnectStages);
    $ReqMateriels  = Query ("SELECT * FROM $NomTabMateriels",      $ConnectStages);
    $ReqLans       = Query ("SELECT * FROM $NomTabReseauxLocaux",  $ConnectStages);
    $ReqWans       = Query ("SELECT * FROM $NomTabReseauxPublics", $ConnectStages);
    $ReqBDs        = Query ("SELECT * FROM $NomTabBasesDonnees",   $ConnectStages);

	$ValidMateriel =
	$ValidReseauxLocaux =
	$ValidAutresRL = 
	$ValidResPublics = 
	$ValidAutresRP = 
	$ValidLangages = 
	$ValidAutresL = 
	$ValidAutresSE = 
	$ValidBasesD = 
                           '&nbsp;';
?>
<form action="BackOffice.php?Trait=List&SlxTable=<?=$NomTabStages?>" method="post">
<table align="center" border="1"><tr><td>
<table cellpadding="2">
    <tr>
        <td valign="top">
		    <tt><?=$ValidMateriel?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Matériel utilisé</b>
		</td>
		<td><table><tr>
		                                                                   <?php
										while ($Obj = mysql_fetch_object ($ReqMateriels))
										{ 
		                                                                   ?>
            <td valign="top" nowrap>
                <input type="checkbox" name="<?=$Obj->Code?> value="<?=$Obj->CodeBin?>">
                <?=$Obj->Libelle?>
	    	</td>
		                                                                   <?php
										} 
		                                                                   ?>
		</tr></table></td>
    </tr>
	<tr>
        <td valign="top">
		    <tt><?=$ValidReseauxLocaux?></tt>
		</td>
	    <td style="text-align : right" valign="top">
		    <b>Réseaux locaux</b>
		</td>
	    <td>
		  <table><tr>
 		                                                                   <?php
										while ($Obj = mysql_fetch_object ($ReqLans))
										{ 
		                                                                   ?>
            <td valign="top" nowrap>
                <input type="checkbox" name="<?=$Obj->Code?> value="<?=$Obj->CodeBin?>">
                <?=$Obj->Libelle?>
	    	</td>
		                                                                   <?php
										} 
		                                                                   ?>
          </tr></table>
		</td>
	</tr>
	<tr>
        <td valign="top">
		    <tt><?=$ValidAutresRL?></tt>
		</td>
		<td>&nbsp;</td>
        <td valign="top">
			Autres&nbsp;&nbsp;<input type="text" name="AutresRL" size="50" value="<?=$ValAutresRL?>">
        </td>
    </tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidResPublics?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Réseaux publics</b>
		</td>
		<td><table><tr>
		                                                                   <?php
										while ($Obj = mysql_fetch_object ($ReqWans))
										{ 
		                                                                   ?>
            <td valign="top" nowrap>
                <input type="checkbox" name="<?=$Obj->Code?> value="<?=$Obj->CodeBin?>">
                <?=$Obj->Libelle?>
	    	</td>
		                                                                   <?php
										} 
		                                                                   ?>
		</tr></table></td>
    </tr>
	<tr>
        <td valign="top"><tt>
		    <?=$ValidAutresRP?></tt>
		</td>
		<td>&nbsp;</td>
        <td valign="top">
			Autres&nbsp;&nbsp;<input type="text" name="AutresRP" size="50" value="<?=$ValAutresRP?>">
        </td>
    </tr>
	<tr>
        <td valign="top">
		    <tt><?=$ValidLangages?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Langages</b>
		</td>
		<td><table><tr>
		                                                                   <?php
($ReqLangages);
										while ($Obj = mysql_fetch_object ($ReqLangages))
										{ 
		                                                                   ?>
            <td valign="top" nowrap>
                <input type="checkbox" name="<?=$Obj->Code?> value="<?=$Obj->CodeBin?>">
                <?=$Obj->Libelle?>
	    	</td>
		                                                                   <?php
										} 
		                                                                   ?>
		</tr></table></td>
	</tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidAutresL?></tt>
		</td>
		<td>&nbsp;</td>
        <td valign="top">
			Autres&nbsp;&nbsp;<input type="text" name="AutresL" size="50" value="<?=$ValAutresL?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt>
		    <?=$ValidSystExpl?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Systèmes d'exploitation </b>
		</td>
		<td><table><tr>
		                                                                   <?php
										while ($Obj = mysql_fetch_object ($ReqOS))
										{ 
		                                                                   ?>
            <td valign="top" nowrap>
                <input type="checkbox" name="<?=$Obj->Code?> value="<?=$Obj->CodeBin?>">
                <?=$Obj->Libelle?>
	    	</td>
		                                                                   <?php
										} 
		                                                                   ?>
		</tr></table></td>
    </tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidAutresSE?></tt>
		</td>
		<td>&nbsp;</td>
        <td valign="top">
		    Autres&nbsp;&nbsp;<input type="text" name="AutresSE" size="50" value="<?=$ValAutresSE?>">
        </td>
    </tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidBasesD?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Bases de données</b>
		</td>
		<td><table><tr>
		                                                                   <?php
										while ($Obj = mysql_fetch_object ($ReqBDs))
										{ 
		                                                                   ?>
            <td valign="top" nowrap>
                <input type="checkbox" name="<?=$Obj->Code?> value="<?=$Obj->CodeBin?>">
                <?=$Obj->Libelle?>
	    	</td>
		                                                                   <?php
										} 
		                                                                   ?>
		</tr></table></td>
    </tr>
    <tr>
        <td valign="top"><tt>
		    <?=$ValidAutresBD?></tt>
		</td>
		<td>&nbsp;</td>
        <td valign="top">
		    Autres&nbsp;&nbsp;<input type="text" name="AutresBD" size="50" value="<?=$ValAutresBD?>">
        </td>
    </tr>
	<tr><td>&nbsp;</td></tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidAtGL?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Ateliers de Génie Logiciel</b>
		</td>
        <td>
            <input type="text" name="AtGL" size="50" value="<?=$ValAtGL?>">
        </td>
    </tr>
    <tr>
	    <td>&nbsp;</td>
	    <td style="text-align : center">
		    <br /><b><u>METHODES OU STANDARDS : </u></b>
		</td>
	    <td>&nbsp;</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidMA?></tt>
		</td>
        <td style="text-align : right" valign="top" nowrap>
		    <b>Analyse</b></td>
        <td valign="top">
            <input type="text" name="MA" size="50" value="<?=$ValMA?>">
        </td>
    </tr>

    <tr>
        <td valign="top"><tt>
		    <?=$ValidMCpt?></tt>
		</td>
        <td style="text-align : right" valign="top" nowrap>
		    <b>Conception</b>
		</td>
        <td valign="top">
            <input type="text" name="MCpt" size="50" value="<?=$ValMCpt?>">
        </td>
    </tr>

    <tr>
        <td valign="top">
		    <tt><?=$ValidMP?></tt>
		</td>
        <td style="text-align : right" valign="top" nowrap>
		    <b>Programmation</b>
		</td>
        <td valign="top">
            <input type="text" name="MP" size="50" value="<?=$ValMP?>">
        </td>
    </tr>

    <tr>
        <td valign="top">
		    <tt><?=$ValidMCtrl?></tt>
		</td>
        <td style="text-align : right" valign="top" nowrap>
		    <b>Controle qualité logicielle</b>
		</td>
        <td valign="top">
            <input type="text" name="MCtrl" size="50" value="<?=$ValMCtrl?>">
        </td>
    </tr>

    <tr>
        <td valign="top">
		    <tt><?=$ValidMGP?></tt>
		</td>
        <td style="text-align : right" valign="top" nowrap>
		    <b>Gestion de projet</b></td>
        <td valign="top">
            <input type="text" name="MGP" size="50" value="<?=$ValMGP?>">
        </td>
    </tr>
</td></tr></table>
<p></p>

<table cellpadding="5">
    <tr>
	    <td colspan="3">
	        <b><u>RENSEIGNEMENTS PRATIQUES</u></b>
		</td>
	</tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidIS?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Indemnités de Stage</b>
		</td>
        <td>
		    Oui<input type="radio" name=IST value="1" checked>
		    Non<input type="radio" name=IST value="0">
		</td>
    </tr>
    <tr>
        <td valign="top">
		<tt><?=$ValidIR?></tt>
		</td>
        <td style="text-align : right" valign="top">
		<b>Indemnités de Repas</b>
		</td>
        <td>
		    Oui<input type="radio" name=IR value="1" checked>
		    Non<input type="radio" name=IR value="0">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt>
		    <?=$ValidIT?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Indemnités de Transport</b>
		</td>
        <td>
		    Oui<input type="radio" name=IT value="1" checked>
		    Non<input type="radio" name=IT value="0">
        </td>
    </tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidMT?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Moyen de Transport</b>
		</td>
        <td>
		    Oui<input type="radio" name=MT value="1" checked>
		    Non<input type="radio" name=MT value="0">
        </td>
    </tr>
	<tr><td></td></tr>
    <tr>
        <td valign="top">
		    <tt><?=$ValidEmb?></tt>
		</td>
        <td style="text-align : right" valign="top">
		    <b>Possibilité d'embauche après le stage</b>
		</td>
        <td>
		    Oui<input type="radio" name=Emb value="1" checked>
		    Non<input type="radio" name=Emb value="0">
        </td>
    </tr>
	<tr><td>&nbsp;</td></tr>
    <tr>
	    <td>&nbsp;</td>
		<td align ="center">
            <input type="button" value="Retour"
                    onClick="history.go (-1)">
          </td>
		  <td align="center">
             <input type="submit" value="Rechercher" >
         </td>
	</tr>
</table>
</td></tr></table>
<input type="hidden" name="Recherche"   value="1">
<input type="hidden" name="StepConsult" value="Valid" >
<input type="hidden" name="PK_Stage"    value="<?=$ValPK_Stage?>" >
</form>

<?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>

