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
	                 $Connexion);

	$URL_AffichSoc = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable='.$NomTabEntreprises.'&IdentPK=';

	$URL_ListSoc  = '?Trait=ListeDetailsEntreprises&slx='.
	                ($slx == 'NAsc' ? 'NDesc' : 'NAsc' );
	$QuelOrdreSoc = 'Ordre '.  ($slx == 'NAsc' ? 'de' : '')     .'croissant';
	$GifOrderSoc  = ($slx == 'NAsc' ? 'arrow_drop_down' : 'arrow_drop_up');

	$URL_ListResp  = '?Trait=ListeDetailsEntreprises&slx='.
	                ($slx == 'NomRespAsc' ? 'NomRespDesc' : 'NomRespAsc' );
	$QuelOrdreResp = 'Ordre '.  ($slx == 'NomRespAsc' ? 'de' : '')     .'croissant';
	$GifOrderResp  = ($slx == 'NomRespAsc' ? 'arrow_drop_down' : 'arrow_drop_up');

    $Title = 'Liste détaillée des entreprises';

?>
<h4 class="center">
    <?=$Title?>
</h4>
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

<div style="width:100%; overflow:auto;">
<table class="highlight bordered centered grey lighten-4 small-text">
 <thead class="grey darken-1 white-text">

                <tr>
                    <th style="text-align : center" valign="top" nowrap>
					    <a class="white-text" href="<?=$URL_ListSoc?>"
                           <?=AttributsAHRef ($QuelOrdreSoc, $QuelOrdreSoc, '', '');?>
						    ><i class="material-icons white-text right" style="font-size: 20px"><?=$GifOrderSoc?></i>
                <b>Raison Sociale</b>
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a class="white-text" href="<?=$URL_ListResp?>"
                           <?=AttributsAHRef ($QuelOrdreResp, $QuelOrdreResp, '', '');?>
						    ><i class="material-icons white-text right" style="font-size: 20px"><?=$GifOrderResp?></i>
                <b>Responsable</b>
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
                </tr></thead>

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
