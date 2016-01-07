<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $ReqSocs = Query ("SELECT * FROM $NomTabEntreprises ORDER BY NomE",
	                  $Connexion);
	$URL_Form  = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='
	            .$NomTabEntreprises;

?>
<h1>Recherche rapide d'entreprise</h1>
<form action="<?=$URL_Form?>" method="post">
<table align="center" border="1 px" cellpadding="5">
    <tr>
        <td>
            <select name="IdentPK" size="20">
                                                                           <?php
                                        while ($ObjSoc = mysql_fetch_object ($ReqSocs))
                                        {
                                                                           ?>
                <option value="<?=$ObjSoc->PK_Entreprise?>"><?=stripslashes (trim ($ObjSoc->NomE))?></option>
                                                                           <?php
                                        }
                                                                           ?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="text-align : center">
                <input type="button" value="Retour"
                       onClick="history.back()">&nbsp; &nbsp; &nbsp; 
                <input type="submit" value="Modifier">
        </td>
    </tr>
</table>
</form>

<?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
