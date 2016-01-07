<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    switch ($Option)
	{
	  case 'Toutes' :
        $ReqSoc = Query ("SELECT * FROM $NomTabEntreprises ORDER BY NomE", 
	                     $Connexion);
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
	                 $Connexion);
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
	                     $Connexion);
	    break;
	}
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
	    $FichEtiq = 
		fopen ('/home/mathieu/public_html/stages/Libres/Etiquettes.xls', 'w');
                                                     mysql_data_seek ($ReqSoc, 0);
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
        redirect ($URL_SITE."Libres/Etiquettes.xls");
/*
        <a href="http://infodoc/~mathieu/stages/Libres/Etiquettes.xls"
		         target="_blank">Telecharger</a>
*/      
    }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
