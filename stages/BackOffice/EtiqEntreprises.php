<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $PATH_RACINE     = '../';
    $PATH_DEFINE     = $PATH_RACINE.'Constantes/';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

    require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_UTIL.'UtilBD.php');

    switch ($Option)
	{
	  case 'Toutes' :
        $ReqSoc = Query ("SELECT * FROM $NomTabEntreprises ORDER BY NomE", 
	                     $ConnectStages);
	    break;
		
	  case '0708AvecStagiaire' :
        $NomTabEntreprises = tabentreprises0708;
        $NomTabStages      = tabstages0708;

        $ReqSoc = Query ("SELECT DISTINCT NomE, Adr1, Adr2, CP, Ville,
	                                       FK_Entreprise, PK_Entreprise,
										   NbStag, NbStagesRestant
	                          FROM $NomTabEntreprises, $NomTabStages
	                          WHERE FK_Entreprise = PK_Entreprise
					                AND  NbStag > NbStagesRestant 
					          ORDER BY NomE", 
	                 $ConnectStages);
	    break;

	  case 'Avant2008' :
	  case '2008-2009' :
	  case '2009-2010' :
        $ReqSoc = Query ("SELECT * 
                          FROM $NomTabEntreprises, $NomTabAnneesEntreprises
                          WHERE $NomTabAnneesEntreprises.LibAnnee = '$Option'
                            AND  $NomTabAnneesEntreprises.FirstID       <= $NomTabEntreprises.PK_Entreprise
                            AND  $NomTabEntreprises.PK_Entreprise <= $NomTabAnneesEntreprises.LastID
                          ORDER BY NomE", 
	                     $ConnectStages);
	    break;
	}


    $UtilBD = new UtilBD();
    $ConnectStages = $UtilBD->ConnectInformationShema();
    
    $ReqCulName = Query ("SELECT COLUMN_NAME FROM COLUMNS where TABLE_NAME='$NomTabEntreprises' AND (COLUMN_NAME='NomE' OR COLUMN_NAME='Adr1' OR COLUMN_NAME='Adr2' OR COLUMN_NAME='CP' OR COLUMN_NAME='Ville')", $ConnectStagesInfor_Shema);
    $var = mysql_data_seek($ReqCulName, 0);
    if (! mysql_num_rows ($ReqSoc))
    {
                                                                          ?>
<h4 align="center">
    Aucune entreprise n'a été trouvée.
</h4>
                                                                          <?php
    }
    else
    {
        if($openfile){
            redirect ($PATH_LIBRES."Etiquettes.ods");
            $OPENFILE = false;
        }
	    $FichEtiq =
		fopen ($PATH_LIBRES.'Etiquettes.ods', 'w');
                                                     mysql_data_seek ($ReqSoc, 0);
                                                     fwrite($FichEtiq,chr(239) . chr(187) . chr(191));
        $cpt = 0;
        while($ObjSocs = mysql_fetch_object($ReqCulName)){
            if($cpt>0)
                fwrite($FichEtiq,"\t");
            fwrite ($FichEtiq, $ObjSocs->COLUMN_NAME);
            $cpt++;
        }
        fwrite($FichEtiq,"\n\n");
                                                     while ($ObjSoc = mysql_fetch_object ($ReqSoc))
                                                     {
        $EtiqNomE  = stripslashes (trim ($ObjSoc->NomE));
        $EtiqAdr1  = stripslashes (trim ($ObjSoc->Adr1));
        $EtiqAdr2  = stripslashes (trim ($ObjSoc->Adr2));
        $EtiqCP    = stripslashes (trim ($ObjSoc->CP));
        $EtiqVille = stripslashes (trim ($ObjSoc->Ville));
        fwrite ($FichEtiq, $EtiqNomE);
        fwrite ($FichEtiq, "\t$EtiqAdr1");
        fwrite ($FichEtiq, "\t$EtiqAdr2");
        fwrite ($FichEtiq, "\t$EtiqCP");
        fwrite ($FichEtiq, "\t$EtiqVille\n");
                                                     }
	    fclose ($FichEtiq);
//        redirect($PATH_LIBRES.'Etiquettes.ods');

         echo '<a href='.$PATH_LIBRES.'Etiquettes.ods target="_blank">Telecharger</a>';

    }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
