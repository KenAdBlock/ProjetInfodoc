<?php
    // fichier UtilBD.php
    //
    // Utilitaires :
    // 
    //   ConnectSelect(), Query()

    function ConnectSelect ($Hote, $User, $Passwd, $NomBase)
    {
//		var_dump("hote : " .$Hote. " user : " .$User. " pass : " .$Passwd. " nom base : ". $NomBase. "<br>");

	    global $MsgErr, $ERRSELECT, $ERRCONNECT, $new_link;
		
        // Connexion à mySQL

        $Connexion = @mysql_connect ($Hote, $User, $Passwd, true) /*or die ($MsgErr [$ERRCONNECT] .'Hote : '.$Hote.'<br>User : '.$User)*/;

        // Sélection de la base
		
        $Result = @mysql_select_db ($NomBase, $Connexion);
//		                 or die ($MsgErr [$ERRSELECT].$NomBase);


		if(!$Result){
			var_dump("Connexion à la base : <b>".$Hote."</b> avec l'utilisateur : <b>".$User. "</b> a échoué.");
			echo mysql_error();
			exit;
		}

		mysql_set_charset('utf8', $Connexion);
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

//        $new_link = true;
        return $Connexion;

    } // ConnectSelect()

	function Query ($Requete, $Connexion)
	{
	   global $MsgErr, $ERRREQUEST;

	    $Result = @mysql_query($Requete, $Connexion);
//	                 or die ($MsgErr [$ERRREQUEST].$Requete);

		if(!$Result){
			var_dump($Requete);
			echo mysql_error();
			exit;
		}

		return $Result;
		
	} // Query()
	
?>
