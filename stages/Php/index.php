<?php
    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';
    $PATH_GENERAL		= $PATH_RACINE.'General/';

    include_once ($PATH_CONSTANTES.'CstGales.php');

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Stages</title>
		
		<!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>


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
	?>

	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  	<script src="../js/materialize.js"></script>
  	<script src="../js/init.js"></script>

    </body>
</html>
