<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $ReqNewInscripts = Query ("SELECT * FROM $NomTabNewInscripts 
	                               ORDER BY PK_NewInscript", 
	                           $Connexion);

	$URL_Form = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='.$NomTabNewInscripts;
    $URL_Del  = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable='. $NomTabNewInscripts;

    $DroitEnreg   = GetDroits ($Status, 'EnregNewInscript');
    $DroitDel     = GetDroits ($Status, 'DelNewInscript');

	$NbCol = 2 +  ($DroitEnreg ? 1 : 0) + ($DroitDel ? 1 : 0);

    $Title = 'Liste des nouvelles inscriptions';

?>
<span class="card-title"><h4 class="center"><?=$Title?></h4></span>
                                                                          <?php
        if (! mysql_num_rows ($ReqNewInscripts))
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
                                                                          <?php
									    if ($DroitEnreg)
                                        {
                                                                          ?>
                    <th>&nbsp;</th>
                                                                          <?php
									    }
                                                                          ?>
                                                                          <?php
									    if ($DroitDel)
                                        {
                                                                          ?>
                    <th>&nbsp;</th>
                                                                          <?php
									    }
                                                                          ?>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Numéro</b>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Nom - Prénom</b>
					</th>
        </thead>
                <tr>
                                                                           <?php
                                        while ($Obj = mysql_fetch_object ($ReqNewInscripts))
                                        {
                                                                          ?>
                <tr>
                                                                          <?php
									        if ($DroitEnreg)
                                            {
                                                                          ?>
                    <td valign="top">
                        <a href="<?=$URL_Form.'&IdentPK='.$Obj->PK_NewInscript?>"
                           <?=AttributsAHRef  ('Valider', 'Valider', '', '');?>
					   ><i class="material-icons yellow-text text-darken-2">mode_edit</i></a>
                    </td>
                                                                           <?php
									        }
                                                                          ?>
                                                                          <?php
									        if ($DroitDel)
                                            {
                                                                          ?>
                    <td valign="top">
                        <a href="<?=$URL_Del.'&IdentPK='.$Obj->PK_NewInscript?>"
                           <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
                           onClick="return confirm ('Etes-vous sur de vouloir supprimer <?=$Obj->NomTuteur?> <?=$Obj->PrenomTuteur?> ?')"
						   ><i class="material-icons red-text text-darken-2">delete_forever</i>
						</a>
                    </td>
                                                                           <?php
									        }
                                                                          ?>
                    <td valign="top" style="text-align : center">
                        <?=$Obj->PK_NewInscript?>
					</td>
                    <td valign="top" style="text-align : center">
                        <?=$Obj->NomTuteur?> <?=$Obj->PrenomTuteur?>
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
