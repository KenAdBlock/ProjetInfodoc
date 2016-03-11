<?php
    // Fichier UtilPages.php
	//
	// GenererRefRq(),

	function GenererRefRq ($NumRq, $Libelle = 'Remarque')
	{
                                                                           ?>
<b><?=$Libelle?></b> :
<a name="Rq<?=$NumRq?>"></a>
<a id="ARq<?=$NumRq?>" href="#Rq<?=$NumRq?>" 
   onclick="return ShowAndHide ('TxtRq<?=$NumRq?>', 'ARq<?=$NumRq?>')"
    >voir</a>
</p>

<div id="TxtRq<?=$NumRq?>" style="display : none; background: <?=COLOR_TXTRQ_DFLT?>;" >
<blockquote><p>
                                                                           <?php
	} // GenererRef()
?>
