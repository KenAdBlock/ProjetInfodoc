<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $ReqSocs = $ConnectStages->query("SELECT * FROM $NomTabEntreprises ORDER BY NomE");
	$URL_Form  = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='
	            .$NomTabEntreprises;

?>
<h4 class="center">Recherche rapide d'entreprise</h4>
<div class="row">
<form action="<?=$URL_Form?>" method="post">
    <div class="row">
    <div class="input-field col s12">
        <select class="browser-default" name="IdentPK" >
            <?php
            while ($ObjSoc = $ReqSocs->fetch())
            {
                ?>
                <option value="<?=$ObjSoc['PK_Entreprise']?>"><?=stripslashes (trim ($ObjSoc['NomE']))?></option>
                <?php
            }
            ?>
        </select>
    </div>
    </div>
    <p class="center">
        <button type="button" class="waves-effect waves-light btn black white-text"  onClick="history.back()">Retour</button>
        <button type="submit" class="waves-effect waves-light btn bleu1 white-text">Modifier</button>
    </p>
</form>
</div>
<?php
}
else
{
?>
<h4 class="center">Vous ne pouvez accéder directement à cette page</h4>
<?php
}
?>
