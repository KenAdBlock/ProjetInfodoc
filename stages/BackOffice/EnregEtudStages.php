<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $UtilBD = new UtilBD();
    $ConnectStages = $UtilBD->ConnectStages();

    define ('STATUS_ETUD2', 6);

    $ReqEtud = Query ("SELECT * FROM $NomTabUsers
			  	            WHERE FK_Statut = ".STATUS_ETUD2."
						    ORDER BY Nom",
	                   $ConnectLaporte);
					   
    // Génération de la table des étudiants
	// ====================================

    if (!isset ($Etape)) $Etape = 'Init';
                                                                           ?>
<h1>Affectation des étudiants aux stages<?=isset ($Etape) && $Etape == 'Valid' ? ' actualisée' : ''?></h1>
                                                                           <?php
    switch ($Etape)
    {
      case 'Valid' :
                                        $ReqStages = Query ("SELECT $NomTabStages.FK_Entreprise,
	                                                                $NomTabStages.Sujet,
	                                                                $NomTabStages.PK_Stage,								
	                                                                $NomTabEntreprises.PK_Entreprise,
	                                                                $NomTabEntreprises.NomE
	                                                             FROM $NomTabStages, $NomTabEntreprises
	                                                             WHERE $NomTabEntreprises.PK_Entreprise =
						                                                                $NomTabStages.FK_Entreprise
	                                                             ORDER BY NomE",
	                                                        $ConnectStages);
	                                    mysql_data_seek ($ReqStages, 0);
                                        for ($i = 0 ; $Obj = mysql_fetch_object ($ReqStages); ++$i)
                                        {
			                                $Nom = 'TxtSaisi'.$i;
                                            Query ("UPDATE $NomTabStages 
											            SET Etudiant = '".$$Nom."'
	                                                    WHERE PK_Stage = '$Obj->PK_Stage'",
	                                                $ConnectStages);										     
                                        }
      case 'Init' :
        $ReqStages = Query ("SELECT $NomTabStages.FK_Entreprise,
	                                $NomTabStages.Sujet,
	                                $NomTabStages.PK_Stage,								
								    $NomTabEntreprises.PK_Entreprise,
								    $NomTabEntreprises.NomE
	                            FROM $NomTabStages, $NomTabEntreprises
	                         WHERE $NomTabEntreprises.PK_Entreprise =
						           $NomTabStages.FK_Entreprise
						     ORDER BY NomE",
	                       $ConnectStages);
?>

<script language=javascript>
var TabNoms = new Array();
var NbEtud = 0;
                                                                           <?php 
	                                    mysql_data_seek ($ReqEtud, 0);
                                        for ( ; $Obj =  mysql_fetch_object ($ReqEtud); )
                                        {
                                                                           ?>
    TabNoms [NbEtud++] = "<?=$Obj->Nom.' '.$Obj->Prenom?>";
                                                                           <?php
                                        }
                                                                           ?>
var LgPrec = 0;
function MAJTxtAffich (ind) 
{
	var ChaineCherchee = document.forms["ZoneSaisie"].elements[ind].value;
    if (ChaineCherchee.length == 0) return;
	LgCourante = ChaineCherchee.length;
	if (LgCourante <= LgPrec) 
	{
	    LgPrec = LgCourante;
	    return;
	}1
	LgPrec = LgCourante;
	var NbOccurr = 0;
	var IndOccurr;
	for (var i = 0; i < NbEtud; ++i)
    {
		if (TabNoms [i].substr (0, LgCourante) == ChaineCherchee)
		{
		    ++NbOccurr;
			IndOccurr = i;
		}
	}
	if (NbOccurr == 1)
      document.forms["ZoneSaisie"].elements[ind].value = TabNoms [IndOccurr]; 
} 
</script> 

<form name="ZoneSaisie" method="POST">
<table border="5" style="text-align : center"><tr><td>
<table>
    <tr>
        <th>Entreprise</th>
        <th>Sujet</th>
        <th>Etudiant</th>
    </tr>
                                                                           <?php
	                                    mysql_data_seek ($ReqStages, 0);
                                        for ($i = 0 ; $Obj = mysql_fetch_object ($ReqStages); ++$i)
                                        {
                                                                           ?>
    <tr>
        <td>
		    <?=$Obj->NomE?>
        </td>
        <td>
		    <?=substr ($Obj->Sujet, 0, 30).'...'?>
        </td>
        <td>
            <input type="text" name="TxtSaisi<?=$i?>" maxlength="50" size="30" 
			 value="<?=$Obj->Etudiant == '' ? '' : $Obj->E1tudiant?>" onKeyUp="MAJTxtAffich(<?=$i?>)"> 
        </td>
    </tr>
                                                                           <?php
                                        }
                                                                           ?>
</table>
</td></tr></table>
<p style="text-align : center">
    <input type="reset" value="Reinitialiser">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="Valider" >
</p>
<input type="hidden" name="Etape" value="Valid" >
</form>
                                                                           <?php
        break;
    }
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>

