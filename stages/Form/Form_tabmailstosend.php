<?php
$Expediteur = 'From: marc.laporte@univ-amu.fr';
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	if ($StepSendMail == 'Valid')
	{
/*
                     Query ("DELETE FROM $NomTabMailsToSend 
	                       WHERE PK_Login = '$IdentPK'", 
	                           $Connexion);
*/
ini_set("SMTP", "smtp.univ-amu.fr");
ini_set("sendmail_from", "marc.laporte@univ-amu.fr");
        mail ($Destinataire, stripslashes ($Sujet), stripslashes ($Message), $Expediteur);
	
	 $URL_List = $PATH_BACKOFFICE.'BackOffice.php?Trait=List&SlxTable='.$NomTabMailsToSend;
        redirect ($URL_List);
	}
	else
	{
        $ReqMail = Query ("SELECT * FROM $NomTabMailsToSend 
	                           WHERE PK_Login = '$IdentPK'", 
	                               $Connexion);
        $Obj = mysql_fetch_object ($ReqMail);
                                                                           ?>
<form method="post">
<table>
    <tr>
        <td style="text_align : right;" valign="top">
            Destinataire : 
        </td>
        <td valign="top">
		    <input type="text" name="Destinataire" value="<?=$Obj->Mail?>" size="60">
		</td>
    </tr>
    <tr>
        <td style="text_align : right;" valign="top">
            Sujet : 
        </td>
        <td valign="top">
		    <input type="text"  name="Sujet" value="Nouveaux login et mot de passe"
			        size="60">
		</td>
    </tr>
    <tr>
        <td style="text_align : right;" valign="top">
            Message : 
        </td>
		<td valign="top">
            <textarea  cols="80" rows="17" name="Message">
         <?=$Obj->Prenom?> <?=$Obj->Nom?>,

J'ai le plaisir de vous informer que vous pourrez dorénavant vous connecter et enregistrer vos propositions de stage sur le site

http://infodoc.iut.univ-aix.fr/stages

en utilisant l'identifiant et le mot de passe suivants :

Identifiant  : <?=$Obj->PK_Login?>&nbsp;
Mot de passe : <?=$Obj->PassWord?>&nbsp;


<?=$NomResponsableStages?>&nbsp;
Responsable des stages

<?=$MailResponsableStages?>
</textarea>
		</td>
    </tr> 
</table>
<input type="button" onClick="history.back()" value="Abandonner">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Reinitaliser">
<input type="submit" value="Envoyer">
<input type="hidden" name="StepSendMail" value="Valid">
</form>
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
