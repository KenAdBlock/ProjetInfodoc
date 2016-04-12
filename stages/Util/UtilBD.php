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
				echo "Connexion à la base : <b>".$GLOBALS['NAMELPT']."</b> avec l'utilisateur : <b>".$GLOBALS['USERLPT']."</b> a échoué. ".utf8_encode($e->getMessage());
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
				echo "Connexion à la base : <b>".$GLOBALS['NAMESTG']."</b> avec l'utilisateur : <b>".$GLOBALS['USERSTG']."</b> a échoué. ".utf8_encode($e->getMessage());
				exit;
			}

		} // ConnectStages()

	}
?>
