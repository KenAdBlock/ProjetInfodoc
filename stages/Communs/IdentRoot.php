<?php
    // fichier IdentRoot.php
    //
    // Identification de la base
    // 
	
	switch ($MachineHote)
	{
	  case INFODOC :
        $NomBase  = "stages"; 
        $User     = "root";
        $Passwd   = $PASSWDBD;
        $Hote     = "localhost";
	    break;
	}
?>