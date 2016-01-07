<?Php
    // fichier UtilForm.php
    //
    // Utilitaires pour les formulaires
    // 
    //   AttributsAHRef(), GenerButton(), GenerSelect1Attr()

function AttributsAHRef ($Title       = '', $OnMouseOver = '',
//       ============== 
                         $OnMouseOut  = '', $OnMouseDown = '')
{
?>
						   Title       = "<?=$Title?>" 
	                       OnMouseOver = "window.status='<?=$OnMouseOver?>';
						                  return true;"
	                       OnMouseOut  = "window.status='<?=$OnMouseOut?>';
						                  return true;"
	                       OnMouseDown = "window.status='<?=$OnMouseDown?>';
						                  return true;"
<?php

} // (AttributsAHRef)

//
// G�n�ration d'un bouton
//
function GenerButton ($LibButton, $Adresse, $WidthButton)
{
	print ('<input type="button" value="'
	      .$LibButton
		  .'" style="WIDTH: '
		  .$WidthButton
		  .'px" onClick="AffichPage (\''
		  .$Adresse
		  .'\');">'
		  );
			  
} // GenerButton()

//
// G�n�ration d'un select d'un attribut
//     Affichage de l'attribut avec/sans d�codage (appel de FromBd2Html())
//     Ajout possible en d�but ou en fin d'une option suppl�mentaire
//
//     $WidthSelect               : valeur de l'option selected
//     $Requete                   : requete contenant les options
//     $NomSelect                 : 'name' de la balise 'select'
//     $Option                    : identificateur du champ qui sert de 'value' 
//                                      dans les options
//     $LibOption                 : libell� des options
//     $ValOptionSelected         : valeur de l'option selected
//     $WithDecod                 : d�codage de LibOption par appel de FromBd2Html())
//     $LibOptionSuppl            : libell� de l'option suppl�mentaire
//     $OptionSuppl               : valeur de l'option suppl�mentaire 
//     $Entete                    : option suppl�mentaire en d�but de liste

function GenerSelect1Attr ($WidthSelect, $Requete, $NomSelect,
                           $Option, $LibOption, $ValOptionSelected,
                           $WithDecod = 1, 
                           $LibOptionSuppl = '', $OptionSuppl = 0, $Entete = 1)
{
    print ('<select name="'.$NomSelect.'">');
	if ($LibOptionSuppl != '' && $Entete)
    {
        print ('<option value="'.$OptionSuppl.'"');
        if ($OptionSuppl == $ValOptionSelected)
            print (' selected ');
        print (' >'
              .($WithDecod ? FromBd2Html ($LibOptionSuppl) : $LibOptionSuppl)
              .'</option>');
	}
	mysql_data_seek ($Requete, 0);
    while ($Line = mysql_fetch_array ($Requete))
    {
        print ('<option value="'
              .$Line [$Option]
			  .'"');
        if ($ValOptionSelected == $Line [$Option])
            print (' selected ');
        print (' >'
              .($WithDecod ? FromBd2Html ($Line [$LibOption]) 
			               : $Line [$LibOption])
              .'</option>');
    }
	if ($LibOptionSuppl != '' && ! $Entete)
        print ('<option value="'
              .$OptionSuppl
			  .'"');
        if ($OptionSuppl == $ValOptionSelected)
            print (' selected ');
        print (' >'
              .($WithDecod ? FromBd2Html ($LibOptionSuppl) 
			               : $LibOptionSuppl)
              .'</option>');
    print ('</select>');
	
} // GenerSelect1Attr()
?>
