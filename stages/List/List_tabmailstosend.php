<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $ReqMails = Query ("SELECT * FROM $NomTabMailsToSend 
	                               ORDER BY Nom", 
	                           $Connexion);

	$URL_Form = $PATH_BACKOFFICE.'BackOffice.php?Trait=SendMail&SlxTable='.$NomTabMailsToSend;
	$URL_Del = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable='.  $NomTabMailsToSend;

    $Title = 'Liste des mails &agrave; envoyer';
?>
<h1 style="text-align : center">
    <?=$Title?>
</h1>
                                                                          <?php
        if (! mysql_num_rows ($ReqMails))
        {
                                                                          ?>
<h4 align="center">
    Il n'y a actuellement aucun mail &agrave; envoyer.
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
                    <th colspan="2">&nbsp;</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Num&eacute;ro</b>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Nom - Pr&eacute;nom</b>
					</th>
                <tr><td colspan="5"><hr></td></tr>
                <tr>
                                                                           <?php
                                        while ($Obj = mysql_fetch_object ($ReqMails))
                                        {
                                                                          ?>
                <tr>
                    <td valign="top">
                        <a href="<?=$URL_Form.'&IdentPK='.$Obj->PK_Login?>"
                           <?=AttributsAHRef  ('Envoyer', 'Envoyer', '', '');?>
					   ><img src="<?=$PATH_GIFS?>b_edit.png" border="0"></a>
                    </td>
                    <td valign="top">
                        <a href="<?=$URL_Del.'&IdentPK='.$Obj->PK_Login?>"
                           <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
					   ><img src="<?=$PATH_GIFS?>b_deltbl.png" border="0"></a>
                    </td>
                    <td valign="top" style="text-align : center">
                        <?=$Obj->PK_Login?>
					</td>
                    <td valign="top" style="text-align : center">
                        <?=$Obj->Nom?> <?=$Obj->Prenom?>
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
<h2 style="text-align : center">Vous ne pouvez acc&eacute;der directement &agrave; cette page</h2>
<?php
}
?>
