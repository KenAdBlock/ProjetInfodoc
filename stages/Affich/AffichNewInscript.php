<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    include ($PATH_CLASS.'CNewInscript.php');

    $ObjTuple = new CNewInscript ($IdentPK);
        
    $ValPK_NewInscript   = $ObjTuple->GetPK_Entreprise();

    $ValNomTuteur;
    $ValPrenomTuteur;
    $ValTelTuteur;
    $ValMailTuteur;
    $ValFaxTuteur;

    $ValNomRespAdmin;
    $ValPrenomRespAdmin;
    $ValTelRespAdmin;
    $ValMailRespAdmin;
    $ValFaxRespAdmin;

    $ValNomE;
    $ValAdr1;
    $ValAdr2;
    $ValCP;
    $Ville;

    $WidthButton = 100;
?>

<br>
<h2 align="center"><?=$ValNomE?></h2>
<table align="center" valign="center">
<colgroup>
    <col width = "110">
    <col width = "250">
    <tr>
        <td>
            <i>Adresse :</i>
        </td>
        <td><?=$ValAdr1?></td>
    </tr>
                                                                           <?php
									    if ($ValAdr2) 
										{ 
										                                   ?> 
    <tr>
        <td>&nbsp;</td>
        <td><?=$ValAdr2?></td>
    </tr>
                                                                           <?php
									    } 
										                                   ?> 
    <tr>
        <td>&nbsp;</td>
        <td><?=$ValCP?> <?=$ValVille?></td>
    </tr>
    <tr>
        <td>
		    <i>Responsable :</i>
        </td>
        <td>
		    <b><?=$ValPrenomRespAdmin?> <?=$ValNomRespAdmin?></b>
        </td>
    </tr>
                                                                           <?php
									    if ($ValMailRespAdmin) 
										{ 
										                                   ?> 
    <tr>
        <td><i>Email :</i></td>
		<td><a href="mailto:<?=$ValMailRespAdmin?>"><?=$ValMailRespAdmin?></a></td>
    </tr>
                                                                           <?php
									    }
										if ($ValTelRespAdmin) 
										{ 
										                                   ?>
    <tr>
	    <td><i>Tel :</i></td>
		<td> <?=$ValTelRespAdmin?></td>
	</tr>
                                                                           <?php
									    }
										if ($ValFaxRespAdmin) 
										{ 
										                                   ?>
    <tr>
	    <td><i>Fax :</i></td>
		<td><?=$ValFaxRespAdmin?></td>
	</tr>
                                                                           <?php
									    }
										                                   ?>
</table>
<br />
<table width="100%" style="text-align : center">
    <tr>
        <td>
            <input type="button" value="Retour" 
	           style="width: <?=$WidthButton?>px" 
                   onClick="history.back()">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" value="Modifier" 
	               style="width: <?=$WidthButton?>px" 
                   onClick="window.location='BackOffice.php?Trait=Form&SlxTable=<?=$NomTabEntreprises?>&IdentPK=<?=$ValPK_Entreprise?>'">
        </td>
    </tr>
</table>

</body>
</html>
<?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez acc�der directement � cette page</h2>
<?php
}
?>
