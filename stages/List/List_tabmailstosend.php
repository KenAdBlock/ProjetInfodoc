<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $ReqMails = $ConnectStages->query("SELECT * FROM $NomTabMailsToSend 
	                                   ORDER BY Nom");

	$URL_Form = $PATH_BACKOFFICE.'BackOffice.php?Trait=SendMail&SlxTable='.$NomTabMailsToSend;
	$URL_Del = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable='.$NomTabMailsToSend;

    $Title = 'Liste des mails à envoyer';
?>
<span class="card-title"><h4 class="center"><?=$Title?></h4></span>
                                                                          <?php
        if (! $ReqMails->rowCount())
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
                    <th colspan="2">&nbsp;</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Numéro</b>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Nom - Prénom</b>
					</th>
        </thead>

                <tr>
                                                                           <?php
                                        while ($Obj = $ReqMails->fetch())
                                        {
                                                                          ?>
                <tr>
                    <td valign="top">
                        <a href="<?=$URL_Form.'&IdentPK='.$Obj['PK_Login']?>"
                           <?=AttributsAHRef  ('Envoyer', 'Envoyer', '', '');?>
					   ><i class="material-icons yellow-text text-darken-2">mode_edit</i></a>
                    </td>
                    <td valign="top">
                        <a href="<?=$URL_Del.'&IdentPK='.$Obj['PK_Login']?>"
                           <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
					   ><i class="material-icons red-text text-darken-2">delete_forever</i></a>
                    </td>
                    <td valign="top" style="text-align : center">
                        <?=$Obj['PK_Login']?>
					</td>
                    <td valign="top" style="text-align : center">
                        <?=$Obj['Nom']?> <?=$Obj['Prenom']?>
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
