<?php

$PATH_RACINE     = '../';
$PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

require_once ($PATH_CONSTANTES.'CstGales.php');

	class UtilBD {

		function ConnectLaporte()
		{
			try{

				$DbLaporte = new PDO('mysql:host=localhost;dbname=laporte', "root", $GLOBALS['PASSWDBD'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				return $DbLaporte;

			}
			catch(PDOException $e){
				echo "Connexion à la base : <b>laporte</b> avec l'utilisateur : <b>root</b> a échoué. ".$e->getMessage();
				exit;
			}

		} // ConnectLaporte()

		function ConnectStages()
		{
			try{

				$DbStages = new PDO('mysql:host=localhost;dbname=stages', "root", $GLOBALS['PASSWDBD'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				return $DbStages;

			}
			catch(PDOException $e){
				echo "Connexion à la base : <b>stages</b> avec l'utilisateur : <b>root</b> a échoué. ".$e->getMessage();
				exit;
			}

		} // ConnectStages()

		function ConnectInformationShema()
		{
			try{

				$DbStages = new PDO('mysql:host=localhost;dbname=INFORMATION_SCHEMA', "root", $PASSWDBD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				return $DbStages;

			}
			catch(PDOException $e){
				echo "Connexion à la base : <b>INFORMATION_SCHEMA</b> avec l'utilisateur : <b>root</b> a échoué. ".$e->getMessage();
				exit;
			}

		} // ConnectStages()

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
