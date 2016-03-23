<?php
//$Expediteur = 'From: marc.laporte@univ-amu.fr';
$Expediteur = 'From: darkweizer@gmail.com';
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
//ini_set("sendmail_from", "marc.laporte@univ-amu.fr");
ini_set("sendmail_from", "darkweizer@gmail.com");
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
<div class="row">
<table>
    <div class="input-field col s12">
        <input id="Destinataire" type="text" name="Destinataire" value="<?=$Obj->Mail?>" width="60">
        <label for="Destinataire"><b>Destinataire</b></label>
    </div>
    <div class="input-field col s12">
        <input id="Sujet" type="text" name="Sujet" value="Nouveaux login et mot de passe" width="60">
        <label for="Sujet"><b>Sujet</b></label>
    </div>
    <div class="input-field col s12">
        <div class="bleu1-text">Message</div><br>
        <textarea id="Message" class="materialize-textarea" name="Message" rows="17" cols="80"><?=$Obj->Prenom?> <?=$Obj->Nom?>,
J'ai le plaisir de vous informer que vous pourrez dorénavant vous connecter et enregistrer vos propositions de stage sur le site

http://infodoc.iut.univ-aix.fr/stages

en utilisant l'identifiant et le mot de passe suivants :

Identifiant  : <?=$Obj->PK_Login?>&nbsp;
Mot de passe : <?=$Obj->PassWord?>&nbsp;

<?=$NomResponsableStages?>&nbsp;
Responsable des stages

<?=$MailResponsableStages?>

        </textarea>

    </div>

</table>
    <p class="center">
        <button type="reset" class="waves-effect waves-light btn black white-text"  onClick="history.back()">Abandonner</button>
        <button type="reset" class="waves-effect waves-light btn black white-text">Reinitialiser</button>
        <button type="submit" class="waves-effect waves-light btn bleu1 white-text">Valider</button>
    </p>
<input type="hidden" name="StepSendMail" value="Valid">
</div>
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
