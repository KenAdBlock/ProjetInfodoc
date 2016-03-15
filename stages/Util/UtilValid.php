<?php
    // fichier UtilValid.php
    //
    // Foonctions de validation des diff&eacute;rents types
    // 
    //   ValidCodePostal(), ValidDate(), ValidEMail(), 
	//   ValidImage(),      ValidPath(), ValidTelephone(), ValidURL()
//
// G&eacute;n&eacute;ration d'un bouton
//
function ValidCodePostal ($Param)
{
	return true;
			  
} // ValidCodePostal()

function  ValidDate($Param)
{
	return ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $Param);
			  
} // ValidDate()

function  ValidEMail($Param)
{
	return true;
			  
} // ValidEMail()

function  ValidImage($Param)
{
	return true;
			  
} // ValidImage()

function  ValidPath($Param)
{
	return true;
			  
} // ValidPath()

function  ValidTelephone($Param)
{
	return ereg ("([0-9]{8})", $Param);
			  
} // ValidTelephone()

function  ValidURL($Param)
{
	return true;
			  
} // ValidURL()
?>