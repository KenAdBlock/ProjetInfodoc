<?php
    
    include ('Class/CEntreprise.php');

    // Récupération des variables envoyées par POST ou GET

    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;
    if (!isset ($Step))
        $Step = isset ($IdentPK) && $IdentPK != 0 ? 'InitModif' : 'InitNew';
    switch ($Step)
    {
      case 'InitModif' :
        // Récupération de l'enreg. à modifier

        $ObjTuple = new CEntreprise ($IdentPK);
        $ValPK_Entreprise = $ObjTuple->GetPK_Entreprise();
        $ValidPK_Entreprise = ESPACE;
        $ValNomE = $ObjTuple->GetNomE();
        $ValidNomE = ESPACE;
        $ValNomR = $ObjTuple->GetNomR();
        $ValidNomR = ESPACE;
        $ValPrenomR = $ObjTuple->GetPrenomR();
        $ValidPrenomR = ESPACE;
        $ValAdr1 = $ObjTuple->GetAdr1();
        $ValidAdr1 = ESPACE;
        $ValAdr2 = $ObjTuple->GetAdr2();
        $ValidAdr2 = ESPACE;
        $ValCP = $ObjTuple->GetCP();
        $ValidCP = ESPACE;
        $ValVille = $ObjTuple->GetVille();
        $ValidVille = ESPACE;
        $ValTelR = $ObjTuple->GetTelR();
        $ValidTelR = ESPACE;
        $ValMailR = $ObjTuple->GetMailR();
        $ValidMailR = ESPACE;
        $ValFaxR = $ObjTuple->GetFaxR();
        $ValidFaxR = ESPACE;
        break;

      case 'InitNew' :
        // Préparation du nouvel enreg.

        $ObjTuple = new CEntreprise ();
        $ValPK_Entreprise = $ObjTuple->GetPK_Entreprise();
        $ValidPK_Entreprise = ESPACE;
        $ValNomE = $ObjTuple->GetNomE();
        $ValidNomE = ESPACE;
        $ValNomR = $ObjTuple->GetNomR();
        $ValidNomR = ESPACE;
        $ValPrenomR = $ObjTuple->GetPrenomR();
        $ValidPrenomR = ESPACE;
        $ValAdr1 = $ObjTuple->GetAdr1();
        $ValidAdr1 = ESPACE;
        $ValAdr2 = $ObjTuple->GetAdr2();
        $ValidAdr2 = ESPACE;
        $ValCP = $ObjTuple->GetCP();
        $ValidCP = ESPACE;
        $ValVille = $ObjTuple->GetVille();
        $ValidVille = ESPACE;
        $ValTelR = $ObjTuple->GetTelR();
        $ValidTelR = ESPACE;
        $ValMailR = $ObjTuple->GetMailR();
        $ValidMailR = ESPACE;
        $ValFaxR = $ObjTuple->GetFaxR();
        $ValidFaxR = ESPACE;
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
        $ValPK_Entreprise = $PK_Entreprise;
        if (trim ($ValPK_Entreprise) == '')
        {
            array_push ($CodErrVide, 'PK_Entreprise');
            $ValidPK_Entreprise = FLECHE;
        }
        else
            $ValidPK_Entreprise = ESPACE;
        $ValNomE = $NomE;
        if (trim ($ValNomE) == '')
        {
            array_push ($CodErrVide, 'NomE');
            $ValidNomE = FLECHE;
        }
        else
            $ValidNomE = ESPACE;
        $ValNomR = $NomR;
        if (trim ($ValNomR) == '')
        {
            array_push ($CodErrVide, 'NomR');
            $ValidNomR = FLECHE;
        }
        else
            $ValidNomR = ESPACE;
        $ValPrenomR = $PrenomR;
        if (trim ($ValPrenomR) == '')
        {
            array_push ($CodErrVide, 'PrenomR');
            $ValidPrenomR = FLECHE;
        }
        else
            $ValidPrenomR = ESPACE;
        $ValAdr1 = $Adr1;
        if (trim ($ValAdr1) == '')
        {
            array_push ($CodErrVide, 'Adr1');
            $ValidAdr1 = FLECHE;
        }
        else
            $ValidAdr1 = ESPACE;
        $ValAdr2 = $Adr2;
        $ValCP = $CP;
        if (trim ($ValCP) == '')
        {
            array_push ($CodErrVide, 'CP');
            $ValidCP = FLECHE;
        }
        else
            $ValidCP = ESPACE;
        $ValVille = $Ville;
        if (trim ($ValVille) == '')
        {
            array_push ($CodErrVide, 'Ville');
            $ValidVille = FLECHE;
        }
        else
            $ValidVille = ESPACE;
        $ValTelR = $TelR;
        $ValMailR = $MailR;
        $ValFaxR = $FaxR;
        $Fleche = FLECHE;

        // on compare l' entreprise entrée avec les entreprises déjà existantes
        $ReqL = Query("SELECT NomE from tabentreprise",$ConnectStages);
        while ($RowL = mysql_fetch_row($ReqL))
        {  
            if ($ValNomE == $RowL[0])
            {    
                $CodErrLog = true;
                $ValidNomE = FLECHE;
            }
        }

        
        if (! count ($CodErrVide))
        {
            // Validation des valeurs des attributs 
        }
        if (!$CodErrVide && !$CodErrInval)
        {
            print ('<h1>Enregistrer</h1>');
            // Préparation de l'enreg. à enregistrer

            $ObjTuple = new CEntreprise ();
            $ObjTuple->SetPK_Entreprise($ValPK_Entreprise);
            $ObjTuple->SetNomE($ValNomE);
            $ObjTuple->SetNomR($ValNomR);
            $ObjTuple->SetPrenomR($ValPrenomR);
            $ObjTuple->SetAdr1($ValAdr1);
            $ObjTuple->SetAdr2($ValAdr2);
            $ObjTuple->SetCP($ValCP);
            $ObjTuple->SetVille($ValVille);
            $ObjTuple->SetTelR($ValTelR);
            $ObjTuple->SetMailR($ValMailR);
            $ObjTuple->SetFaxR($ValFaxR);
            if ($IdentPK == 0)
                $ObjTuple->Insert();
            else
            {
                if ($SaveAsNew)
                    $ObjTuple->Insert();
                else
                    $ObjTuple->Update();
            }

            $Step = 'MAJTabOK';
        }
        break;
    }
    if ($Step == 'MAJTabOK')
    {
        if ($_SESSION['privilege'] == "tuteur")
        {
                                                                       ?>
             <script>location.replace("?Trait=AFFICH&SlxTable=tabentreprise");</script>
                                                                       <?php
        }else
        {
                                                                       ?>
        <script>location.replace("?Trait=LIST&SlxTable=tabentreprise");</script>
                                                                       <?php
        }
    }
    else
    {
                                                                        ?>
        <?php if ($IdentPK==0) {?>
        <h1> Insertion d'une nouvelle entreprise </h1>
        <?php } else {?>
        <h1> Modification d'une entreprise </h1>
        <?php }?>
<p style="text-align : center; font-size : 11 px; font-style : italic;">Toutes les rubriques en <b>gras</b> doivent obligatoirement être remplies</p>
<?php if ($CodErrVide || $CodErrInval) { ?>
<p style="text-align : center; font-size : 16 px;">Les
<?=$Fleche?>indiquent qu'une rubrique est vide ou erronée</p> <?php } ?>
<?php if ($CodErrLog) { ?>
<p style="text-align : center; font-size : 16 px;">Ce nom d'entreprise existe déjà</p>
<?php } ?>
<form method="post">
<table align="center" border="1"><tr><td>
<table cellpadding="2">
    <?php if($ValPK_Entreprise) { ?>
    <tr>
        <td valign="top"><tt><?=$ValidPK_Entreprise?></tt></td>
        <td style="text-align : right" valign="top"><b>Numéro</b></td>
        <td>
            <?=$ValPK_Entreprise?>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td valign="top"><tt><?=$ValidNomE?></tt></td>
        <td style="text-align : right" valign="top"><b>Raison Sociale</b></td>
        <td>
            <input type="text" name="NomE" size="50" value="<?=$ValNomE?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidNomR?></tt></td>
        <td style="text-align : right" valign="top"><b>Nom du
        Responsable</b></td>
        <td>
            <input type="text" name="NomR" size="50" value="<?=$ValNomR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidPrenomR?></tt></td>
        <td style="text-align : right" valign="top"><b>Prénom du
        Responsable</b></td>
        <td>
            <input type="text" name="PrenomR" size="50" value="<?=$ValPrenomR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAdr1?></tt></td>
        <td style="text-align : right" valign="top"><b>Adresse</b></td>
        <td>
            <input type="text" name="Adr1" size="50" value="<?=$ValAdr1?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAdr2?></tt></td>
        <td style="text-align : right" valign="top">Adresse 2</td>
        <td>
            <input type="text" name="Adr2" size="50" value="<?=$ValAdr2?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidCP?></tt></td>
        <td style="text-align : right" valign="top"><b>Code postal</b></td>
        <td>
            <input type="text" name="CP" size="50" value="<?=$ValCP?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidVille?></tt></td>
        <td style="text-align : right" valign="top"><b>Ville</b></td>
        <td>
            <input type="text" name="Ville" size="50" value="<?=$ValVille?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidTelR?></tt></td>
        <td style="text-align : right" valign="top">Tel du Responsable</td>
        <td>
            <input type="text" name="TelR" size="50" value="<?=$ValTelR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMailR?></tt></td>
        <td style="text-align : right" valign="top">Mail du Responsable</td>
        <td>
            <input type="text" name="MailR" size="50" value="<?=$ValMailR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidFaxR?></tt></td>
        <td style="text-align : right" valign="top">Fax du Responsable</td>
        <td>
            <input type="text" name="FaxR" size="50" value="<?=$ValFaxR?>">
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align : center">
            <input type="button" value="Abandonner"
                    onClick="history.go (-1)">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="Réinitialiser">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" 
                   value="Valider" >
        </td>
    </tr>
</table>
</td></tr></table>
<input type="hidden" name="Step" value="Valid" >
<input type="hidden" name="PK_Entreprise" value="<?=$ValPK_Entreprise?>" >
</form>
                                                                       <?php
    }
                                                                       ?>

</body>
</html>
