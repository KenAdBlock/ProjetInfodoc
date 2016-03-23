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
	<h4 class="center"><?=$ValNomE?></h4>
	<table class="bordered striped">
		<tbody>
		<tr>
			<td width="30%"><i>Adresse :</i></td>
			<td><?=$ValAdr1?></td>
		</tr>
<?php
	if ($ValAdr2) 
	{ 
?> 
		<tr>
			<td>&nbsp;</td>
			<td><?=$ValAdr2?></td>
		</tr>
<?php
	} 
?> 
		<tr>
			<td>&nbsp;</td>
			<td><?=$ValCP?> <?=$ValVille?></td>
		</tr>
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
		<tr>
			<td valign="top">
				<i>Présentation de <nobr>l'entreprise :</nobr></i>
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
		</tbody>
	</table>

	<br/>
		<p class="center">
		<button type="reset" class="waves-effect waves-light btn black white-text" onClick="history.back()">Retour</button>
<?php
	if (GetDroits ($Status, 'ModifEntreprise'))
	{
?>
		<button type="submit" class="waves-effect waves-light btn bleu1 white-text" onClick="window.location='BackOffice.php?Trait=Form&SlxTable=<?=$NomTabEntreprises?>&IdentPK=<?=$ValPK_Entreprise?>'">Modifier</button>
		</p>
<?php
	}
?>

<?php
}
else
{
?>
	<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
