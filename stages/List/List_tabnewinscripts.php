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
<h1 style="text-align : center">
    <?=$Title?>
</h1>
                                                                          <?php
        if (! mysql_num_rows ($ReqNewInscripts))
        {
                                                                          ?>
<h4 align="center">
    Il n'y a actuellement aucun nouvel inscrit dans la liste.
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
                <tr><td colspan="<?=$NbCol?>"><hr></td></tr>
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
					   ><img src="<?=$PATH_GIFS?>b_edit.png" border="0"></a>
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
						   ><img src="<?=$PATH_GIFS?>b_deltbl.png"
						         border="0">
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
