<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    require_once ($PATH_CLASS .'CEntreprise.php');
    require_once ($PATH_RACINE.'Util/UtilPages.php');
    
    if ($Status == TUTEUR) $IdentPK = $FK_EntrepriseUser;

    $ObjTuple = new CEntreprise ($IdentPK);
        
    $ValPK_Entreprise     = $ObjTuple->GetPK_Entreprise();
    $ValNomE              = $ObjTuple->GetNomE();
    $ValAdr1              = $ObjTuple->GetAdr1();
    $ValAdr2              = $ObjTuple->GetAdr2();
    $ValCP                = $ObjTuple->GetCP();
    $ValVille             = $ObjTuple->GetVille();

    $ValCivilite          = $ObjTuple->GetCivilite();
    $ValNomRespAdmin      = $ObjTuple->GetNomR();
    $ValPrenomRespAdmin   = $ObjTuple->GetPrenomR();
    $ValTelRespAdmin      = $ObjTuple->GetTelR();
    $ValMailRespAdmin     = $ObjTuple->GetMailR();
    $ValFaxRespAdmin      = $ObjTuple->GetFaxR();
    $ValPresentEntreprise = $ObjTuple->GetPresentEntreprise();
    $ValSiteEntreprise    = $ObjTuple->GetSiteEntreprise();

    $WidthButton = 100;
?>

	<br />
	<h2 style="text-align : center"><?=$ValNomE?></h2>
	<table align="center" valign="center">
		<colgroup>
			<col width = "210">
			<col width = "450">
		</colgroup>
		<tr>
			<td><i>Adresse :</i></td>
			<td><?=$ValAdr1?>	</td>
		</tr>
<?php
	if ($ValAdr2) 
	{ 
?> 
		<tr>
			<td>&nbsp;       </td>
			<td><?=$ValAdr2?></td>
		</tr>
<?php
	} 
?> 
		<tr>
			<td>&nbsp;                    </td>
			<td><?=$ValCP?> <?=$ValVille?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td>
				<i>Responsable :</i>
			</td>
			<td>
				<?=$ValCivilite?> <b><?=$ValPrenomRespAdmin?> <?=$ValNomRespAdmin?></b>
			</td>
		</tr>
<?php
	if ($ValMailRespAdmin) 
	{ 
?> 
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td><i>Email :</i></td>
<?php
		if (GetDroits ($Status, 'MailToRespAdmin')) 
		{ 
?> 
			<td><a href="mailto:<?=$ValMailRespAdmin?>"><?=$ValMailRespAdmin?></a></td>
		</tr>
<?php
		}
		else
		{
?> 
			<td><?=$ValMailRespAdmin?></td>
		</tr>
<?php
		}
	}
	if ($ValTelRespAdmin) 
	{ 
?>
		<tr>
			<td><i>Tel :</i></td>
			<td> <?=$ValTelRespAdmin?></td>
		</tr>
<?php
	}
	if ($ValFaxRespAdmin) 
	{ 
?>
		<tr>
			<td><i>Fax :</i></td>
			<td><?=$ValFaxRespAdmin?></td>
		</tr>
<?php
	}
	if ($ValPresentEntreprise != '') 
	{ 
?>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td valign="top">
				<i>Pr�sentation de <nobr>l'entreprise :</nobr></i>
			</td>
			<td>
<?php 
	/*
				 GenererRefRq ('AffichEntreprise', ''); 
	*/
?>
				<?=$ValPresentEntreprise?>
<?php /* </blockquote></div> */ ?>
			</td>
		</tr>
<?php
	}
	if ($ValSiteEntreprise != '')  
	{ 
?>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td valign="top">
				<i>Site de <nobr>l'entreprise :</nobr></i>
			</td>
			<td>
				<a href="<?=$ValSiteEntreprise?>" target="_blank"?>
					<?=$ValSiteEntreprise?>
				</a>
			</td>
		</tr>
<?php
	}
?>
	</table>
	<br />
	<table width="100%" style="text-align : center">
		<tr>
			<td>
				<input type="button" 
					   value="Retour" 
					   style="width: <?=$WidthButton?>px" 
					   onClick="history.back()">
<?php
	if (GetDroits ($Status, 'ModifEntreprise'))
	{
?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" 
				       value="Modifier" 
					   style="width: <?=$WidthButton?>px" 
					   onClick="window.location='BackOffice.php?Trait=Form&SlxTable=<?=$NomTabEntreprises?>&IdentPK=<?=$ValPK_Entreprise?>'">
<?php
	}
?>
			</td>
		</tr>
	</table>

</body>
</html>
<?php
}
else
{
?>
	<h2 style="text-align : center">Vous ne pouvez acc�der directement � cette page</h2>
<?php
}
?>
