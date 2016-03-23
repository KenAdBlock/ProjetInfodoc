<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
$NomTabEntreprises = tabentreprises0708;
$NomTabStages      = tabstages0708;

    $ReqSoc = $ConnectStages->query("SELECT DISTINCT NomE, Adr1, Adr2, CP, Ville,
	                                   FK_Entreprise, PK_Entreprise, NbStag,
									   NbStagesRestant
	                  FROM $NomTabEntreprises, $NomTabStages
	                  WHERE FK_Entreprise = PK_Entreprise
					    AND  NbStag > NbStagesRestant 
					  ORDER BY NomE");

     if (! $ReqSoc->fetch())
    {
                                                                          ?>
<h4 align="center">
    Aucune entreprise n'a été trouvée.
</h4>
                                                                          <?php
    }
    else
    {
	    $FichEtiq = fopen ('/home/mathieu/public_html/Libres/'.'Etiq2008.a', 'w');
                                                                         ?>
<a href="http://infodoc/~mathieu/Libres/Etiq2008.a">Télecharger</a>	
                                                                          <?php
                                                     while ($ObjSoc = $ReqSoc->fetch())
                                                     {

        $EtiqNomE  = stripslashes (trim ($ObjSoc['NomE']));
        $EtiqAdr1  = stripslashes (trim ($ObjSoc['Adr1']));
        $EtiqAdr2  = stripslashes (trim ($ObjSoc['Adr2']));
        $EtiqCP    = stripslashes (trim ($ObjSoc['CP']));
        $EtiqVille = stripslashes (trim ($ObjSoc['Ville']));
        fwrite ($FichEtiq, $EtiqNomE);
        fwrite ($FichEtiq, "\t$EtiqAdr1");
        fwrite ($FichEtiq, "\t$EtiqAdr2");
        fwrite ($FichEtiq, "\t$EtiqCP");
        fwrite ($FichEtiq, "\t$EtiqVille\n");
                                                     }
	    fclose ($FichEtiq);
    }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
