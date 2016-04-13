<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$UtilBD = new UtilBD();
	$ConnectLaporte = $UtilBD->ConnectLaporte();

?>

<h4 class="center">Liste des notes d'amphis de 1ère année</h4>

<?php
}
else
{
?>
	<h4 class="center">Vous ne pouvez accéder directement à cette page</h4>
<?php
}
?>

