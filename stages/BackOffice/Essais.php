<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$NomBaseMathieu  = /*"mathieu"*/"laporte"; 
	$NomBaseStages   = "stages"; 
    $UserMathieu     = /*"mathieu"*/"root";
    $PasswdMathieu   = /*"dehaime"*/"";
    $HoteMathieu     = "localhost";
	
	$ConnectMathieu = ConnectSelect ($HoteMathieu, $UserMathieu, 
	                                 $PasswdMathieu, $NomBaseMathieu);
?>

<h1>Liste des notes d'amphis de 1&egrave;re ann&eacute;e</h1>

<?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez acc&eacute;der directement &agrave; cette page
</h2>
<?php
}
?>

