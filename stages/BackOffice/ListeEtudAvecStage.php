<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $NomBaseMathieu  = /*"mathieu"*/"laporte"; 
    $UserMathieu     = /*"mathieu"*/"root";
    $PasswdMathieu   = /*"dehaime"*/"";
    $HoteMathieu     = "localhost";

    $ConnectMathieu = ConnectSelect ($HoteMathieu, $UserMathieu, 
	                              $PasswdMathieu, $NomBaseMathieu);

    $NomBaseStage  = /*"mathieu"*/"stages"; 
    $UserStage     = /*"mathieu"*/"root";
    $PasswdStage   = /*"dehaime"*/"";
    $HoteStage     = "localhost";

    $ConnectStage = ConnectSelect ($HoteStage, $UserStage, 
	                            $PasswdStage, $NomBaseStage);


    define ('STATUS_ETUD2', 6);
    define ('STATUS_ETUDLP', 10);
    $ReqEtud = Query ("SELECT * FROM $NomTabUsers
			 WHERE (FK_Statut = ".STATUS_ETUD2." OR FK_Statut = ".STATUS_ETUDLP.") AND FK_Stage <> ''
			 ORDER BY Nom",
	               $ConnectMathieu);
?>
<h1>Liste des étudiants ayant un stage</h1>
<table>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Entreprise</th>
        <th>Lieu du stage</th>
    <?php
        while ($ObjEtud = mysql_fetch_object ($ReqEtud))
	 {
    ?>
        <tr>
	     <td><?=$ObjEtud->Nom?></td>
	     <td><?=$ObjEtud->Prenom?></td>
            <?php
                $Ville = '';
                $Entreprise = '';
                $ReqStage = Query ("SELECT * FROM `tabstages` WHERE `PK_Stage`=$ObjEtud->FK_Stage", $ConnectStage);
                $ObjStage = mysql_fetch_object ($ReqStage);

                $ReqEntreprise = Query ("SELECT * FROM `tabentreprises` WHERE `PK_Entreprise`=$ObjStage->FK_Entreprise", $ConnectStage);
                $ObjEntreprise = mysql_fetch_object ($ReqEntreprise);
                $Entreprise = $ObjEntreprise->NomE;
                if ($ObjStage->VilleStage != '')
                    $Ville = $ObjStage->VilleStage;
                else
                    $Ville = $ObjEntreprise->Ville;
            ?>
	     <td><?=$Entreprise?></td>
	     <td><?=$Ville?></td>
	 </tr>
    <?php
        }
    ?>
</table>
<?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
