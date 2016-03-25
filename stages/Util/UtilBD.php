<?php

$PATH_RACINE     = '../';
$PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

require_once ($PATH_CONSTANTES.'CstGales.php');

	class UtilBD {

		function ConnectLaporte()
		{
			try{

				$DbLaporte = new PDO('mysql:host='.$GLOBALS['HOSTLPT'].';dbname='.$GLOBALS['NAMELPT'], $GLOBALS['USERLPT'], $GLOBALS['PASSWDBDLPT'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				return $DbLaporte;

			}
			catch(PDOException $e){
				echo "Connexion à la base : <b>laporte</b> avec l'utilisateur : <b>root</b> a échoué. ".utf8_encode($e->getMessage());
				exit;
			}

		} // ConnectLaporte()

		function ConnectStages()
		{
			try{

				$DbStages = new PDO('mysql:host='.$GLOBALS['HOSTSTG'].';dbname='.$GLOBALS['NAMESTG'], $GLOBALS['USERSTG'], $GLOBALS['PASSWDBDSTG'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				return $DbStages;

			}
			catch(PDOException $e){
				echo "Connexion à la base : <b>stages</b> avec l'utilisateur : <b>root</b> a échoué. ".utf8_encode($e->getMessage());
				exit;
			}

		} // ConnectStages()

		function ConnectInformationShema()
		{
			try{

				$DbStages = new PDO('mysql:host=localhost;dbname=INFORMATION_SCHEMA', "root", $GLOBALS['PASSWDBD'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				return $DbStages;

			}
			catch(PDOException $e){
				echo "Connexion à la base : <b>INFORMATION_SCHEMA</b> avec l'utilisateur : <b>root</b> a échoué. ".utf8_encode($e->getMessage());
				exit;
			}

		} // ConnectInformationShema()

	}
?>
