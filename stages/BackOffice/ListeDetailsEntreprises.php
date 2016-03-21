<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    switch ($slx)
	{		
	  case 'NomRespDesc' :
	    $OrderReq = "NomR desc, PrenomR asc";
	    break;

	  case 'NomRespAsc' :
	    $OrderReq = "NomR asc, PrenomR asc";
	    break;

	  case 'NDesc' :
	    $OrderReq = "NomE desc";
	    break;
		
	  case 'NAsc' :
	  default         :
	    $slx      = 'NAsc';
	    $OrderReq = "NomE asc";
	}
    $ReqSoc = Query ("SELECT * FROM $NomTabEntreprises ORDER BY ".$OrderReq, 
	                 $ConnectStages);

	$URL_AffichSoc = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable='.$NomTabEntreprises.'&IdentPK=';

	$URL_ListSoc  = '?Trait=ListeDetailsEntreprises&slx='.
	                ($slx == 'NAsc' ? 'NDesc' : 'NAsc' );
	$QuelOrdreSoc = 'Ordre '.  ($slx == 'NAsc' ? 'de' : '')     .'croissant';
	$GifOrderSoc  = $PATH_GIFS.($slx == 'NAsc' ? 'desc' : 'asc').'_order.png';

	$URL_ListResp  = '?Trait=ListeDetailsEntreprises&slx='.
	                ($slx == 'NomRespAsc' ? 'NomRespDesc' : 'NomRespAsc' );
	$QuelOrdreResp = 'Ordre '.  ($slx == 'NomRespAsc' ? 'de' : '')     .'croissant';
	$GifOrderResp  = $PATH_GIFS.($slx == 'NomRespAsc' ? 'desc' : 'asc').'_order.png';

    $Title = 'Liste détaillée des entreprises';

?>
<h1 style="text-align : center">
    <?=$Title?>
</h1>
                                                                          <?php
     if (! mysql_num_rows ($ReqSoc))
    {
                                                                          ?>
<h4 align="center">
    Aucune entreprise n'a été trouvée.
</h4>
                                                                          <?php
    }
    else
    {
                                                                          ?>
<table  align="center">
    <tr>
        <td valign="top">
            <table cellpadding="5">
                <tr>
                    <th style="text-align : center" valign="top" nowrap>
					    <a href="<?=$URL_ListSoc?>"
                           <?=AttributsAHRef ($QuelOrdreSoc, $QuelOrdreSoc, '', '');?>
						    ><b>Raison Sociale</b>&nbsp;
							 <img border="0" src="<?=$GifOrderSoc?>">
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a href="<?=$URL_ListResp?>"
                           <?=AttributsAHRef ($QuelOrdreResp, $QuelOrdreResp, '', '');?>
						    ><b>Responsable</b>&nbsp;
							 <img border="0" src="<?=$GifOrderResp?>">
						</a>
					</th>
					<th style="text-align : center" valign="top" nowrap>Adr1</th>
					<th style="text-align : center" valign="top" nowrap>Adr2</th>
					<th style="text-align : center" valign="top" nowrap>Code postal</th>
					<th style="text-align : center" valign="top" nowrap>Ville</th>
					<th style="text-align : center" valign="top" nowrap>tel.</th>
					<th style="text-align : center" valign="top" nowrap>mail</th>
					<th style="text-align : center" valign="top" nowrap>fax</th>
					<th style="text-align : center" valign="top" nowrap>site web</th>
                <tr><td colspan="10"><hr></td></tr>
                <tr>
                                                                       <?php
                                                     mysql_data_seek ($ReqSoc, 0);
                                                     while ($ObjSoc = mysql_fetch_object ($ReqSoc))
                                                     {
                                                                          ?>
                    <td valign="top" style="text-align : left">
                        <a href="<?=$URL_AffichSoc.$ObjSoc->PK_Entreprise?>"					
                           <?=AttributsAHRef  ('Detail', 'Detail', '', '');?>
                           ><?=stripslashes (trim ($ObjSoc->NomE))?>
						</a>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=$ObjSoc->Civilite?> <?=stripslashes (trim ($ObjSoc->NomR))?> <?=stripslashes (trim ($ObjSoc->PrenomR))?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=stripslashes (trim ($ObjSoc->Adr1))?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=stripslashes (trim ($ObjSoc->Adr2))?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=$ObjSoc->CP?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=stripslashes (trim ($ObjSoc->Ville))?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=$ObjSoc->TelR?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=$ObjSoc->MailR?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=$ObjSoc->FaxR?>
					</td>
                    <td valign="top" style="text-align : left">
                        <?=$ObjSoc->SiteEntreprise?>
					</td>
                </tr>
                                                                       <?php
                                                     }
                                                                       ?>
            </table>
        </td>
    </tr>
</table>
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
