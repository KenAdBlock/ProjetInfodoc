<?php
    // fichier UtilDivers.php
    //
    // Utilitaires divers
	// 
	//  CloseWindow(),   Redirect(), CloseSessionAndRedirect()
	//  NbJoursDuMois(), Today()

	// Fenetre
	// =======
	//
	//   CloseWindow()
	//
	// URL - Redirections
	// ==================
	//
	//   Redirect()
	//
	// Dates
	// =====
    //   NbJoursDuMois(), Today()
	//
	
	
	// Fenetre
	// =======
	//
	function CloseWindow ($Msg = '')
	{
	                                    if ($Msg != '')
		                                {
	                                                                       ?>
        <script type="text/javascript">alert ('<?=$Msg?>')</script>
	                                                                       <?php
                                        }
	                                                                       ?>
        <script type="text/javascript">window.close()</script>
	                                                                       <?php
	} // CloseWindow()

	// URL - Redirections
	// ==================
	//
	function Redirect ($URL, $Msg = '')
    {
	                                    if ($Msg != '')
		                                {
	                                                                       ?>
        <script type="text/javascript">alert ('<?=$Msg?>')</script>
	                                                                       <?php
                                        }
        die ('<meta http-equiv="refresh" content="0;URL='.$URL.'">');

    } // Redirect()

	// Dates
	// =====
	//
    function Today ($IntervJours = 0) 
	{
	    // Renvoie la date du jour + $IntervJours, sous la forme YYYY-MM-JJ
		
	    return date ('Y-m-d', 
		             mktime (0, 0, 0,
					         date ('m'), date ('d') + $IntervJours, date ('Y'))); 

	} // Today()

    function NbJoursDuMois ($Annee   = 0 /* année courante par défaut     */, 
	                        $NumMois = 0 /* de 1 à 12; Si 0, mois courant */) 
	{
	    if (0 == $Annee || 0 == $NumMois)
		{
		    $Annee   = date ('Y');
		    $NumMois = date ('n');
		}
	    return date ("t", mktime (0, 0, 0, $NumMois, 1, $Annee));
		
	} // NbJoursDuMois()
?>