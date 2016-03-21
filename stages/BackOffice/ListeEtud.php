<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$NomBaseMathieu  = /*"mathieu"*/"laporte"; 
    $UserMathieu     = /*"mathieu"*/"root";
<<<<<<< HEAD
    $PasswdMathieu   = /*"dehaime"*/"";
=======
    $PasswdMathieu   = /*"dehaime"*/$PASSWDBD;
>>>>>>> a0950c541eb61b8b8e8fc2a845716fc963a75536
    $HoteMathieu     = "localhost";

	$ConnectLaporte = ConnectSelect ($HoteMathieu, $UserMathieu, 
	                                 $PasswdMathieu, $NomBaseMathieu);

    define ('STATUS_ETUD1', 5);
    define ('STATUS_ETUD2', 6);
    $ReqEtud = Query ("SELECT * FROM $NomTabUsers
			  	            WHERE FK_Statut = "
							.($Trait == 'ListeEtud1A' ? STATUS_ETUD1 : STATUS_ETUD2)."
						    ORDER BY Nom",
	                   $ConnectLaporte);
?>
<h1>Liste des étudiants de <?=$Trait == 'ListeEtud1A' ? 'première' : 'deuxième'?> année</h1>

<table>
                                                                           <?php
                                        while ($ObjEtud = mysql_fetch_object ($ReqEtud))
										{
										                                   ?>
    <tr>
	    <td><?=$ObjEtud->Nom?></td>
	    <td><?=$ObjEtud->Prenom?></td>
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
