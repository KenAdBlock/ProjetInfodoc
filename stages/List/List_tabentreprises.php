<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    switch ($slx)
	{		
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

	$URL_ListSoc  = '?Trait=List&SlxTable='.$NomTabEntreprises.'&slx='.
	                ($slx == 'NAsc' ? 'NDesc' : 'NAsc' );
	$QuelOrdreSoc = 'Ordre '.  ($slx == 'NAsc' ? 'de' : '')     .'croissant';
	$GifOrderSoc  = $PATH_GIFS.($slx == 'NAsc' ? 'desc' : 'asc').'_order.png';

	$URL_AffichSoc = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable='.$NomTabEntreprises.'&IdentPK=';
	$URL_FormSoc   = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='  .$NomTabEntreprises.'&IdentPK=';
	$URL_DelSoc    = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable='   .$NomTabEntreprises.'&IdentPK=';

    $DroitDel   = GetDroits ($Status, 'DelEntreprise');
    $DroitModif = GetDroits ($Status, 'ModifEntreprise');

	$NbCol = 3 +  ($DroitModif ? 1 : 0) + ($DroitDel ? 1 : 0);

    $Title = 'Liste des entreprises';

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
                    <th>&nbsp;</th>
                                                                          <?php
									        if ($DroitModif)
                                            {
                                                                          ?>
                    <th>&nbsp;</th>
                                                                          <?php
									        }
									        if ($DroitDel)
                                            {
                                                                          ?>
                    <th>&nbsp;</th>
                                                                          <?php
									        }
                                                                          ?>
                    <th style="text-align : center" valign="top" nowrap>
					    <a href="<?=$URL_ListSoc?>"
                           <?=AttributsAHRef ($QuelOrdreSoc, $QuelOrdreSoc, '', '');?>
						    ><b>Raison Sociale</b>&nbsp;
							 <img border="0" src="<?=$GifOrderSoc?>">
						</a>
					</th>
                <tr><td colspan="<?=$NbCol?>"><hr></td></tr>
                <tr>
                                                                       <?php
                                                     mysql_data_seek ($ReqSoc, 0);
                                                     while ($ObjSoc = mysql_fetch_object ($ReqSoc))
                                                     {
                                                                       ?>
                <tr>
                      <td valign="top">
                        <a href="<?=$URL_AffichSoc.$ObjSoc->PK_Entreprise?>"
                           <?=AttributsAHRef  ('Detail', 'Detail', '', '');?>
					   ><img src="<?=$PATH_GIFS?>b_browse.png" border="0"></a>
                    </td>
                                                                         <?php
									        if ($DroitModif)
                                            {
                                                                          ?>
                    <td valign="top">
                        <a href="<?=$URL_FormSoc.$ObjSoc->PK_Entreprise?>"
                           <?=AttributsAHRef  ('Modifier', 'Modifier', '', '');?>
					   ><img src="<?=$PATH_GIFS?>b_edit.png" border="0"></a>
                    </td>
                                                                          <?php
									        }
									        if ($DroitDel)
                                            {
                                                                          ?>
                     <td valign="top">
                        <a href="<?=$URL_DelSoc.$ObjSoc->PK_Entreprise?>"
                           <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
                           onClick="return confirm ('Etes-vous sur de vouloir supprimer <?=addslashes($ObjSoc->NomE)?> ?')"
                             ><img src="<?=$PATH_GIFS?>b_deltbl.png"
						         border="0">
						</a>
                    </td>
                                                                          <?php
									        }
                                                                          ?>
                    <td valign="top" style="text-align : center">
                        <?=stripslashes (trim ($ObjSoc->NomE))?>
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
