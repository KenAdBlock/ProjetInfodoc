<?php
    // fichier UtilBD.php
    //
    // Utilitaires :
    // 
    //   ConnectSelect(), Query()

	class UtilBD {
//    function ConnectSelect ($Hote, $User, $Passwd, $NomBase)
//    {
////		var_dump("hote : " .$Hote. " user : " .$User. " pass : " .$Passwd. " nom base : ". $NomBase. "<br>");
//
//	    global $MsgErr, $ERRSELECT, $ERRCONNECT, $new_link;
//		
//        // Connexion à mySQL
//
//        $ConnectStages = @mysql_connect ($Hote, $User, $Passwd, true) /*or die ($MsgErr [$ERRCONNECT] .'Hote : '.$Hote.'<br>User : '.$User)*/;
//
//        // Sélection de la base
//		
//        $Result = @mysql_select_db ($NomBase, $ConnectStages);
////		                 or die ($MsgErr [$ERRSELECT].$NomBase);
//
//
//		if(!$Result){
//			var_dump("Connexion à la base : <b>".$Hote."</b> avec l'utilisateur : <b>".$User. "</b> a échoué.");
//			echo mysql_error($ConnectStages);
//			exit;
//		}
//
//		mysql_set_charset('utf8', $ConnectStages);
//		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
//
////        $new_link = true;
//        return $ConnectStages;
//
//    } // ConnectSelect()

	function ConnectLaporte()
    {
		try{

			$DbLaporte = new PDO('mysql:host=localhost;dbname=laporte', "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			return $DbLaporte;

		}
		catch(PDOException $e){
			echo "Connexion à la base : <b>laporte</b> avec l'utilisateur : <b>root</b> a échoué. ".$e->getMessage();
			exit;
		}	    

    } // Connect()
	
	
	function ConnectStages()
    {
		try{

			$DbStages = new PDO('mysql:host=localhost;dbname=stages', "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			return $DbStages;

		}
		catch(PDOException $e){
			echo "Connexion à la base : <b>stages</b> avec l'utilisateur : <b>root</b> a échoué. ".$e->getMessage();
			exit;
		}	    

    } // Connect()

	function Query ($Requete, $ConnectStages)
	{
	   global $MsgErr, $ERRREQUEST;

	    $Result = @mysql_query($Requete, $ConnectStages);
//	                 or die ($MsgErr [$ERRREQUEST].$Requete);

		if(!$Result){
			var_dump($Requete);
			echo mysql_error($ConnectStages);
			exit;
		}

		return $Result;
		
	} // Query()
}
?>
