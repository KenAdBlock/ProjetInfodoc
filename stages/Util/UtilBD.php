<?php
    // fichier UtilBD.php
    //
    // Utilitaires :
    // 
    //   ConnectSelect(), Query()

    function ConnectSelect ($Hote, $User, $Passwd, $NomBase)
    {
	    global $MsgErr, $ERRSELECT, $ERRCONNECT;
		
        // Connexion � mySQL

        $Connexion = @mysql_connect ($Hote, $User, $Passwd)
		                 or die ($MsgErr [$ERRCONNECT]
                                .'Hote : '.$Hote.'<br>User : '.$User);

        // S�lection de la base
		
        @mysql_select_db ($NomBase, $Connexion)
		                 or die ($MsgErr [$ERRSELECT].$NomBase);

        return $Connexion;

    } // ConnectSelect()

	function Query ($Requete, $Connexion)
	{
	    global $MsgErr, $ERRREQUEST;

	    $Result = @mysql_query ($Requete, $Connexion) 
	                 or die ($MsgErr [$ERRREQUEST].$Requete);
					 
		return $Result;
		
	} // Query()
	
?>