<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$UtilBD = new UtilBD();
	$ConnectLaporte = $UtilBD->ConnectLaporte();

?>

<h1>Liste des notes d'amphis de 1ère année</h1>

<?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page
</h2>
<?php
}
?>

