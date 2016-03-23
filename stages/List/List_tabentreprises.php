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
	                 $Connexion);

	$URL_ListSoc  = '?Trait=List&SlxTable='.$NomTabEntreprises.'&slx='.
	                ($slx == 'NAsc' ? 'NDesc' : 'NAsc' );
	$QuelOrdreSoc = 'Ordre '.  ($slx == 'NAsc' ? 'de' : '')     .'croissant';
	$GifOrderSoc  = ($slx == 'NAsc' ? 'arrow_drop_down' : 'arrow_drop_up');

	$URL_AffichSoc = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable='.$NomTabEntreprises.'&IdentPK=';
	$URL_FormSoc   = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='  .$NomTabEntreprises.'&IdentPK=';
	$URL_DelSoc    = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable='   .$NomTabEntreprises.'&IdentPK=';

    $DroitDel   = GetDroits ($Status, 'DelEntreprise');
    $DroitModif = GetDroits ($Status, 'ModifEntreprise');

	$NbCol = 3 +  ($DroitModif ? 1 : 0) + ($DroitDel ? 1 : 0);

    $Title = 'Liste des entreprises';

?>
<span class="card-title"><h4 class="center"><?=$Title?></h4></span>

                                                                          <?php
     if (! mysql_num_rows ($ReqSoc))
    {
                                                                          ?>
<h5 class="center">
    Aucun stage n'a été trouvé.
</h5>
                                                                          <?php
    }
    else
    {
                                                                          ?>
<table  class="highlight bordered centered grey lighten-5">
  <thead class="grey white-text">
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
					    <a class="white-text" href="<?=$URL_ListSoc?>"
                           <?=AttributsAHRef ($QuelOrdreSoc, $QuelOrdreSoc, '', '');?>
						    ><i class="material-icons white-text" style="font-size: 20px"><?=$GifOrderSoc?></i>
                <b>Raison Sociale</b>&nbsp;
						</a>
					</th>
        </thead>
                
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
					   ><i class="material-icons blue-text text-lighten-1">description</i></a>
                    </td>
                                                                         <?php
									        if ($DroitModif)
                                            {
                                                                          ?>
                    <td valign="top">
                        <a href="<?=$URL_FormSoc.$ObjSoc->PK_Entreprise?>"
                           <?=AttributsAHRef  ('Modifier', 'Modifier', '', '');?>
					   ><i class="material-icons yellow-text text-darken-2">mode_edit</i></a>
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
                             ><i class="material-icons red-text text-darken-2">delete_forever</i>
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
