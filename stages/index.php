<?php
    $PATH_RACINE     = './';
    $PATH_CONSTANTES = 'Constantes/';

    include_once ($PATH_CONSTANTES.'CstGales.php');

?>
<html>
    <link rel="stylesheet" href="<?=$PATH_CSS?>stages.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="Img/favicon.ico">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Stages</title>
	</head>

	<frameset rows="170,*" frameborder="0" border="0" framespacing="1"> 
		<frame name="banniere" scrolling="no" 
			   target="sommaire"
			   src="<?=$PATH_GENERAL?>Entete.php" 
			   marginwidth="4" 
			   marginheight="0">
		<frameset cols="170,*" >
			<frame name="login" scrolling="yes" 
				   target="principal"
				   src="<?=$PATH_GENERAL?>MenuGauche.php">
			<frameset cols="*"> 
				<frame name="principal" 
					   src="<?=$PATH_GENERAL?>Generalites.php" scrolling="yes"
					   target="sommaire">
			</frameset>
			<noframes>
			
				<body bgcolor="#FFFFFF" text="#3366CC" link="#0000FF" vlink="#000080" alink="#FF6600"><!--mstheme--><font face="Comic Sans MS">

					<p>
						Cette page utilise des cadres, mais votre navigateur ne les prend pas en
						charge.
					 </p>

					<!--mstheme--></font>
				</body>
				
			</noframes>
		</frameset>

	</frameset>

</html>