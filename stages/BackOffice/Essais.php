<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$NomBaseMathieu  = /*"mathieu"*/"laporte"; 
	$NomBaseStages   = "stages"; 
    $UserMathieu     = /*"mathieu"*/"root";
<<<<<<< HEAD
    $PasswdMathieu   = /*"dehaime"*/"";
=======
    $PasswdMathieu   = /*"dehaime"*/$PASSWDBD;
>>>>>>> a0950c541eb61b8b8e8fc2a845716fc963a75536
    $HoteMathieu     = "localhost";
	
	$ConnectLaporte = ConnectSelect ($HoteMathieu, $UserMathieu, 
	                                 $PasswdMathieu, $NomBaseMathieu);
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

