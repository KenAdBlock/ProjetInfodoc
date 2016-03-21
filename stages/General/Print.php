<?php
    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

    include_once ($PATH_CONSTANTES.'CstGales.php');
	require_once ($PATH_CONSTANTES.'DEFINE.php');
	require_once ($PATH_CONSTANTES.'CstGales.php');

    // Ouverture de la session
	// =======================
	
    require_once ($PATH_UTIL.'UtilSession.php');
    OpenSession ($NomSession);

	//
		
    $IsConnected = isset ($_SESSION ['login']) && $_SESSION ['login'] != '';
	
	if ($IsConnected)
	{
		foreach ($_POST as $clef => $valeur) $$clef = $valeur;
        if ($Step == 'Decnx')
		{
		    $IsConnected = false;
			$_SESSION ['login'] = '';
		}
	}
	require_once ($PATH_CONSTANTES.'CstErr.php');
    require_once ($PATH_UTIL      .'UtilLogin.php');
	require_once ($PATH_UTIL      .'UtilPages.php');
	require_once ($PATH_COMMUNS   .'FctDiverses.php');

    // Connexion a mySQL
	
    require_once ($PATH_UTIL.'UtilBD.php');

	$UtilBD = new UtilBD();
	$ConnectStages = $UtilBD->ConnectStages();

	// Construction des droits
/*
	$_SESSION ['Statut']  = GetStatutByLogin ($CodeBin);
	$_SESSION ['CodeBin'] = $CodeBin;

    $_SESSION ['IsAdmin']             = IsAdmin();
	$_SESSION ['IsProtectedFromCopy'] = !IsAdmin() && !IsML() && !IsEtud();
	$_SESSION ['IsCoursAutorises']    = $IsConnected;
	$_SESSION ['IsTPsAutorises']      = IsAdmin() || IsML() || IsEtud() || IsProfIUTAix();
	$_SESSION ['IsDocsAutorises']     = IsAdmin();
	$_SESSION ['IsLiensAutorises']    = IsAdmin();
	$_SESSION ['IsDiversAutorises']   = IsAdmin();
	$_SESSION ['CodeBin']             = $CodeBin;
*/
    $Origine = 'Index';
	
	foreach ($_GET as $clef => $valeur) $$clef = $valeur;

    $ObjPage = SearchPage ($SlxPage, $NomFichierZip, $CorrigeZip, 
	                       $CheminsCorriges, $PathRelCorrige);
    $Module     = $ObjPage->Module;
    $SousModule = $ObjPage->SousModule;
	$IsSommaire = $ObjPage->IsSommaire;

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="<?=$PATH_CSS?>Feuille.css" type="text/css">

    <!--meta http-equiv="Content-Type" content="text/html; charset=windows-1252"-->

    <title>IUT Informatique Aix - D. Mathieu</title>

    <script type="text/javascript"><?php include ($PATH_JS.'PopUps.js')?></script>
</head>

<body bgcolor="#ffffff"
      topmargin="0" leftmargin="0" marginwidth="0" marginheight="0"
     >
<script language="JavaScript">
<!--
    window.resizeTo (<?php print ($LargeurZoneAffich); ?> + 100, screen.availHeight);
//-->
</script>

<table align="center" border="0" 
       width="<?=$LargeurZoneAffich?>" cellpadding="5">
	<tr>
	    <td>
	                                                                       <?php
                                        $NiveauH = -1;
	                                    if ($SlxPage == 'CnxPrealable')
	                                        include ($PATH_PAGESLIBRES.'CnxPrealable.php');
	                                    else
	                                    {
	                                        if ($ObjPage->Titre != '') 
											                               ?>
                    <h1 class="TitrePage"><?=$ObjPage->Titre?><?=$TousCorriges ? " - Corrigés" : "";?></h1>
	                                                                       <?php 
											if ($ObjPage->SousTitre != '') 
											                               ?>
                    <h2 class="TitrePage"><?=$ObjPage->SousTitre?></h2>
	                                                                      <?php 
											$CheminCompletPage = $PATH_RACINE.$ObjPage->Repertoire.'/';
	                                        $NomFichierComplet = $CheminCompletPage.$ObjPage->NomFichier;
	                                        if (file_exists ($NomFichierComplet))
											{
												InclureRqPreliminaires ($CheminCompletPage.'RqPreliminaires.php', $ObjPage->IsRqPreliminaires);
		                                        include ($NomFichierComplet);
												if ($IsSommaire) 
		                                        {
                                                    $NiveauH = 0;
		                                            $ReqPages = Query ("SELECT * FROM $NomTabPages
		                                                                    WHERE NomPageMere = '$SlxPage' 
		                                                                    ORDER BY OrdrePartiel",
		                                                               $ConnectStages);
		                                            while ($ObjAutrePage = mysql_fetch_object ($ReqPages))
		                                            {
									                    $ObjNewPage = SearchPage ($ObjAutrePage->NomPage, $NomFichierZip, $CorrigeZip,
															                      $CheminsCorriges, $PathRelCorrige); 
	                                        if ($ObjNewPage->Titre != '') 
											                               ?>
                    <h1 class="TitrePage"><?=$ObjNewPage->Titre?></h1>
	                                                                       <?php 
											if ($ObjNewPage->SousTitre != '') 
											                               ?>
                    <h2 class="TitrePage"><?=$ObjNewPage->SousTitre?></h2>
	                                                                       <?php 
											            $CheminCompletPage = $PATH_RACINE.$ObjNewPage->Repertoire.'/';
	                                                    $NomFichierComplet = $CheminCompletPage.$ObjNewPage->NomFichier;
	                                                    if (file_exists ($NomFichierComplet))
											            {
												InclureRqPreliminaires ($CheminCompletPage.'RqPreliminaires.php', 
												                         $ObjNewPage->IsRqPreliminaires);
		                                                    include ($NomFichierComplet);

														}
													}
		                                        } 
        							            GenerFootNotes();
		                                    }

	                                        else
	                                        {
	                                            $NomFichierIntrouvable = $NomFichierComplet;
	                                            include ($PATH_PAGESLIBRES.'FichierIntrouvable.php');
	                                        }
	                                    }
										                                   ?>
	    </td>
	</tr>
</table>

<!-- Notice de Copyright -->

<!-- Copyright (c) 2000-2008 Didier MATHIEU.                                                -->
<!-- Permission is granted to copy, distribute and/or modify this document under the terms  -->
<!-- of the GNU Free Documentation License, Version 1.1 or any later version published by   -->
<!-- the Free Software Foundation.                                                          -->

<!-- The source code of this page may be redistributed and/or modified according to the     -->
<!-- terms of the GNU General Public License, as it has been published by the Free Software -->
<!-- Foundation (version 2 and above)                                                       -->

</body>
</html>
<?php

    mysql_close ($ConnectStages);
?>
<script type="text/javascript" language="javascript1.2">
<!--
// Do print the page
if (typeof(window.print) != 'undefined') {
    window.print();
}
//-->
</script>
            
