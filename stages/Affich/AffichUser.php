<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    include ($PATH_CLASS.'CUser.php');
    if ($Status == PROF || $Status == ETUD1 || $Status == ETUD2 || $Status == ETUDLP)
	{
	    $ReqUser = Query ("SELECT PK_User FROM $NomTabUsers 
		                        WHERE Login = '$login'",
						   $Connexion); 
        $ObjUser = mysql_fetch_object ($ReqUser);
		$IdentPK = $ObjUser->PK_User;
    }
	else
	{
		$IdentPK = $PK_User;
	}
    $ObjTuple = new CUser ($IdentPK);
	
    $ValPK_User       = $ObjTuple->GetPK_User();
    $ValLogin         = $ObjTuple->GetLogin();
    $ValStatus        = $ObjTuple->GetStatus();
    $ValCivilite      = $ObjTuple->GetCivilite();
    $ValNom           = $ObjTuple->GetNom();
    $ValPrenom        = $ObjTuple->GetPrenom();
    $ValMail          = $ObjTuple->GetMail();
    $ValTel           = $ObjTuple->GetTel();
    $ValFax           = $ObjTuple->GetFax();
    $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
 
    $ReqStatus = Query ("SELECT Code FROM $NomTabStatus 
	                         WHERE Code = '$ValStatus'",
						$Connexion);
	$ObjStatus = mysql_fetch_object ($ReqStatus);
	$LibelleStatus = $ObjStatus->Code;
    
    if ($ValFK_Entreprise)
    {
       $ReqSoc = Query ("SELECT NomE FROM $NomTabEntreprises
	                         WHERE PK_Entreprise = $ValFK_Entreprise",
						$Connexion); 
       $ObjSoc = mysql_fetch_object ($ReqSoc);
	   $NomE   = $ObjSoc->NomE;
    }
?>

<SCRIPT language="javascript">
    function popup(page) {
    window.open(page,"titre","width=600,height=400");
    }
</SCRIPT>

<h2 align="center">Utilisateur n� <?=$ValPK_User?></h2>
<table align="center" valign="center">
<colgroup>
    <col width = "110">
    <col width = "250">
    <tr>
        <td><i>Login :</i></td>
        <td><b><?=$ValLogin?></b></td>
	</tr>
    <tr>
	    <td><i>Statut :</i></td>
		<td><b><?=$LibelleStatus?></b></td>
</table>
<br>
<table align="center" valign="center">
<colgroup>
    <col width = "110">
    <col width = "250">
    <tr>
        <td><i>Coordonn�es :</i></td><td>
            <?=$ValCivilite?> <b><?=$ValPrenom?> <?=$ValNom?></b>
        </td>
    </tr>
    <tr>
        <td><i>Email :</i></td>
        <td><a href="mailto:<?=$ValMail?>"><?=$ValMail?></a></td></tr>
    <tr>
        <td><i>Tel :</i></td>
        <td> <?=$ValTel?></td>
    </tr>
                                                                           <?php
                                        if ($ValFax)
	                                    {
										                                   ?>
    <tr>
        <td><i>Fax :</i></td>
        <td><?=$ValFax?></td>
    </tr>
                                                                           <?php
                                        }
										                                   ?>
                                                                           <?php
                                        if ($ValStatus == TUTEUR)
	                                    {
										                                   ?>
    <tr>
        <td><i>Entreprise :</i></td>
        <td><?=$NomE?></td>
	</tr>
                                                                           <?php
                                        }
										                                   ?>
</table>
<hr color="black" width="360">
<p align="center"> <a
href="BackOffice.php?Trait=Form&SlxTable=<?=$NomTabUsers?>&IdentPK=<?=$ValPK_User?>">
Modifier</a>
</p>
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