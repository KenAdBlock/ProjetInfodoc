<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$UtilBD = new UtilBD();
	$ConnectLaporte = $UtilBD->ConnectLaporte();

    define ('STATUS_ETUD2', 6);
	
	$ReqEtud = $ConnectLaporte->query("SELECT * FROM $NomTabUsers
			  	            WHERE FK_Statut = ".STATUS_ETUD2." AND FK_Stage = ''
						    ORDER BY Nom");
?>
<h4 class="center">Liste des étudiants n'ayant pas de stage</h4>

<table>
                                                                           <?php
                                        while ($ObjEtud = $ReqEtud->fetch())
										{
										                                   ?>
    <tr>
	    <td><?=$ObjEtud['Nom']?></td>
	    <td><?=$ObjEtud['Prenom']?></td>
	    <td><?=$ObjEtud['FK_Stage']?></td>
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
	<h4 class="center">Vous ne pouvez accéder directement à cette page</h4>
<?php
}
?>
