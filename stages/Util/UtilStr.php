<?php
    // fichier UtilStr.php
    //
    // Utilitaires de transformations de chaines
    // 
    //   FromBd2Html()

    function FromBd2Html ($Chaine)
    {
        return nl2br (stripslashes (trim ($Chaine)));
    }
	
?>
