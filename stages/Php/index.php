<?php
    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
    $PATH_GENERAL		= $PATH_RACINE.'General/';

    include_once ($PATH_CONSTANTES.'CstGales.php');

	require_once ($PATH_BACKOFFICE.'Fonctions.php');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Stages</title>

		<link rel="icon" type="image/x-icon" href="<?=$PATH_IMG?>favicon.ico">
		<!-- CSS  -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="<?=$PATH_CSS?>style.css" type="text/css" rel="stylesheet" media="screen,projection"/>


	    <script language="javascript">
			function popup(page)
			{
				window.open (page, "titre", "width=600, height=400, scrollbars=yes");
			}
		</script>
    </head>

    <body>

	<?php
		include ($PATH_GENERAL."Entete.php");
		include ($PATH_GENERAL."MenuGauche.php");
		include ($PATH_GENERAL."Generalites.php");
		Footer();
	?>

        <script src="<?=$URL_SITE.$PATH_JQUERY?>jquery-2.2.1.min.js"></script>
        <script src="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.js"></script>
        <script src="<?=$PATH_JS?>init.js"></script>

    </body>
</html>
