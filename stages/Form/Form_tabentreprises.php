<?php
function ProtectApos ($String)
{
    $NewString = "";
    $String = str_split ($String);

    for ($i = 0; $i < count ($String); ++$i)
    {
        if ($String [$i] == "'")
            $NewString .= "&apos;";
        else
            $NewString .= $String [$i];
    }
    return $NewString;

} // ProtectApos()

if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    require_once ($PATH_CLASS.'CEntreprise.php');
    require_once ($PATH_COMMUNS.'FctDiverses.php');

    if (! GetDroits ($Status, 'ModifEntreprise')) $IdentPK = $_SESSION ['FK_EntrepriseUser'];

    if (!isset ($StepConsult))
        $StepConsult = (isset ($IdentPK) && $IdentPK != 0)
            ? 'InitModif' : 'InitNew';

    $ValidPK_Entreprise     =
    $ValidCivilite          =
    $ValidNomE              =
    $ValidNomR              =
    $ValidPrenomR           =
    $ValidAdr1              =
    $ValidAdr2              =
    $ValidCP                =
    $ValidVille             =
    $ValidTelR              =
    $ValidMailR             =
    $ValidFaxR              =
    $ValidPresentEntreprise =
    $ValidSiteEntreprise    = ESPACE;

    switch ($StepConsult)
    {
        case 'InitModif' :
        case 'InitNew'   :

            // Préparation du nouvel enreg. ou récupération de l'enreg. à modifier

            $ObjTuple = new CEntreprise
            ($StepConsult == 'InitModif'  ?  $IdentPK : 0);

            $ValPK_Entreprise = $ObjTuple->GetPK_Entreprise();

            $ValNomE              = $ObjTuple->GetNomE();
            $ValCivilite          = $ObjTuple->GetCivilite();
            $ValNomR              = $ObjTuple->GetNomR();
            $ValPrenomR           = $ObjTuple->GetPrenomR();
            $ValAdr1              = $ObjTuple->GetAdr1();
            $ValAdr2              = $ObjTuple->GetAdr2();
            $ValCP                = $ObjTuple->GetCP();
            $ValVille             = $ObjTuple->GetVille();
            $ValTelR              = $ObjTuple->GetTelR();
            $ValMailR             = $ObjTuple->GetMailR();
            $ValFaxR              = $ObjTuple->GetFaxR();
            $ValPresentEntreprise = $ObjTuple->GetPresentEntreprise();
            if (trim ($ObjTuple->GetSiteEntreprise()) == 'http://' )
                $ObjTuple->SetSiteEntreprise('');
            $ValSiteEntreprise    = $ObjTuple->GetSiteEntreprise();
            break;

        case 'Valid' :
            $CodErrVide  = array();
            $CodErrInval = array();

            // Champs non validés

            $ValPK_Entreprise     = $PK_Entreprise;
            $ValAdr2              = $Adr2;
            $ValMailR             = $MailR;
            $ValFaxR              = $FaxR;
            $ValPresentEntreprise = $PresentEntreprise;
            if (trim ($SiteEntreprise) == 'http://' )
                $SiteEntreprise = '';
            $ValSiteEntreprise    = $SiteEntreprise;

            // Champs validés

            $ValNomE = trim ($NomE);
            if (! GetDroits ($Status, 'ModifEntreprise'))
                $ValidNomE = ESPACE;
            else if ($ValNomE == '')
            {
                array_push ($CodErrVide, 'NomE');
                $ValidNomE = FLECHE;
            }
            $ValCivilite = $Civilite;
            if (($ValNomR = trim ($NomR)) == '')
            {
                array_push ($CodErrVide, 'NomR');
                $ValidNomR = FLECHE;
            }
            if (($ValPrenomR = trim ($PrenomR)) == '')
            {
                array_push ($CodErrVide, 'PrenomR');
                $ValidPrenomR = FLECHE;
            }
            if (($ValAdr1 = trim ($Adr1)) == '')
            {
                array_push ($CodErrVide, 'Adr1');
                $ValidAdr1 = FLECHE;
            }
            if (($ValCP = trim ($CP)) == '')
            {
                array_push ($CodErrVide, 'CP');
                $ValidCP = FLECHE;
            }
            if (($ValVille = trim ($Ville)) == '')
            {
                array_push ($CodErrVide, 'Ville');
                $ValidVille = FLECHE;
            }
            if (($ValTelR = trim ($TelR)) == '')
            {
                array_push ($CodErrVide, 'TelR');
                $ValidTelR = FLECHE;
            }
            else if ($Err = NormaliserTel ($ValTelR))
            {
                array_push ($CodErrInval, $Err);
                $ValidTelR = FLECHE;
            }
            $ValMailR = trim ($MailR);
            if (($ValFaxR = trim ($FaxR)) != '' && ($Err = NormaliserTel ($ValFaxR)))
            {
                array_push ($CodErrInval, $Err);
                $ValidFaxR = FLECHE;
            }
            if (! count ($CodErrVide))
            {
                // Validation des valeurs des attributs
            }
            if (! ($CodErrVide  || $CodErrInval))
            {
                $ObjTuple = new CEntreprise     ();
                $ObjTuple->SetPK_Entreprise     ($ValPK_Entreprise);
                $ObjTuple->SetNomE              (ProtectApos ($ValNomE));
                $ObjTuple->SetCivilite          ($ValCivilite);
                $ObjTuple->SetNomR              (ProtectApos ($ValNomR));
                $ObjTuple->SetPrenomR           (ProtectApos ($ValPrenomR));
                $ObjTuple->SetAdr1              (ProtectApos ($ValAdr1));
                $ObjTuple->SetAdr2              (ProtectApos ($ValAdr2));
                $ObjTuple->SetCP                ($ValCP);
                $ObjTuple->SetVille             (ProtectApos ($ValVille));
                $ObjTuple->SetTelR              ($ValTelR);
                $ObjTuple->SetMailR             ($ValMailR);
                $ObjTuple->SetFaxR              ($ValFaxR);
                $ObjTuple->SetPresentEntreprise ($ValPresentEntreprise);

                if (substr ($ValSiteEntreprise, 0, 7) != 'http://')
                    $ValSiteEntreprise = 'http://'.$ValSiteEntreprise;
                $ObjTuple->SetSiteEntreprise    ($ValSiteEntreprise);

                if ($ValPK_Entreprise == 0)
                    $ObjTuple->Insert();
                else
                    $ObjTuple->Update();
                ?>
                <script>location.replace("?Trait=List&SlxTable=<?=$NomTabEntreprises?>");</script>
                <?php
                die;
            }
            break;
    }
    if ($IdentPK == 0)
        $Titre = 'Création d\'une nouvelle entreprise';
    else
        $Titre = 'Modification de l\'entreprise '.$IdentPK;
    ?>
    <h4 class="center">
        <?=$Titre?>
    </h4>

    <p class="center">
        <i>Toutes les rubriques en <b>gras</b> doivent obligatoirement être remplies</i>
    </p>
    <?php
    if ($CodErrVide || $CodErrInval)
    {
        ?>
        <p style="text-align : center; font-size : 16px;">Les
            <?=FLECHE?>indiquent qu'une rubrique est vide ou erronée</p>
        <?php
    }
    ?>

<div class="row">
    <div class="col s12">
    <form method="post">
                        <?php
                        if ($ValPK_Entreprise)
                        {
                            ?>
                            <div class="row">
                                <div class="col l6 m6 s12">
                                <p><b><?=$ValidPK_Entreprise?>Numéro </b><?=$ValPK_Entreprise?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="input-field col s12">
                            <label for="NomE"><b><?=$ValidNomE?>Raison sociale</b></label>
                                <?php
                                if ($StepConsult == 'InitNew' ||
                                    GetDroits ($Status, 'ModifEntreprise'))
                                {
                                    ?>
                                    <input name="NomE" size="50" id="NomE" type="text" class="validate" value="<?=$ValNomE?>">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <?=$ValNomE?>
                                    <input name="NomE" size="50" id="NomE" type="text" class="validate" value="<?=$ValNomE?>">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <p class="center"><i>Pour les grandes entreprises, indiquer le service</i></p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 m6 s12">
                                <input name="Adr1" size="50" id="Adr1" type="text" class="validate" value="<?=$ValAdr1?>">
                                <label for="Adr1"><b><?=$ValidAdr1?>Adresse </b></label>
                            </div>
                            <div class="input-field col l6 m6 s12">
                                <input name="Adr2" size="50" id="Adr2" type="text" class="validate" value="<?=$ValAdr2?>">
                                <label for="Adr2">Adresse 2</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 m6 s12">
                                <input name="CP" size="50" id="CP" type="text" class="validate" value="<?=$ValCP?>">
                                <label for="CP"><b><?=$ValidCP?>Code postal </b></label>
                            </div>
                            <div class="input-field col l6 m6 s12">
                                <input name="Ville" size="50" id="Ville" type="text" class="validate" value="<?=$ValVille?>">
                                <label for="Ville"><b><?=$ValidVille?>Ville </b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 m6 s12">
                               Responsable administratif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l1 m1 s1">
                                <label for="Nom"><b><?=$ValidCivilite?>Civilité</b></label>
                            </div>
                            <div class="col l6 s12 m12">
                                <div class="input-field col l4 m4 s4">
                                    <p>
                                        <input name="Civilite" type="radio" id="CiviliteM" value="M" checked="checked" />
                                        <label for="CiviliteM">M</label>
                                    </p>
                                </div>
                                <div class="input-field col l4 m4 s4">
                                    <p>
                                        <input name="Civilite" type="radio" id="CiviliteMme" value="Mme" <?=$ValCivilite == 'Mme' ? 'checked' : ''?>/>
                                        <label for="CiviliteMme">Mme</label>
                                    </p>
                                </div>
                                <div class="input-field col l4 m4 s4">
                                    <p>
                                        <input name="Civilite" type="radio" id="CiviliteMlle" value="Mlle" <?=$ValCivilite == 'Mlle' ? 'checked' : ''?>  />
                                        <label for="CiviliteMlle">Mlle</label>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l6 m6 s12">
                                <input name="NomR" size="50" id="NomR" type="text" class="validate" value="<?=$ValNomR?>">
                                <label for="NomR"><b><?=$ValidNomR?>Nom</b></label>
                            </div>
                            <div class="input-field col l6 m6 s12">
                                <input name="PrenomR" size="50" id="PrenomR" type="text" class="validate" value="<?=$ValPrenomR?>">
                                <label for="PrenomR"><b><?=$ValidPrenomR?>Prénom</b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 m6 s12">
                                <input name="TelR" size="50" id="TelR" type="text" class="validate" value="<?=$ValTelR?>">
                                <label for="TelR"><b><?=$ValidTelR?>Tel</b></label>
                            </div>
                            <div class="input-field col l6 m6 s12">
                                <input name="MailR" size="50" id="MailR" type="email" class="validate" value="<?=$ValMailR?>">
                                <label for="MailR"><b><?=$ValidMailR?>Mail</b></label>
                            </div>
                            <div class="input-field col l6 m6 s12">
                                <input name="FaxR" size="50"  id="FaxR" type="text" class="validate" value="<?=$ValFaxR?>">
                                <label for="FaxR">Fax</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="bleu1-text"><?=$ValidPresentEntreprise?>Présentation de l'entreprise</div><br>
                                <textarea name="PresentEntreprise" id="PresentEntreprise" class="materialize-textarea"><?=stripslashes ($ValPresentEntreprise)?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="SiteEntreprise" size="50"  id="SiteEntreprise" type="text" class="validate" value="<?=$ValSiteEntreprise?>">
                                <label for="SiteEntreprise"><?=$ValidSiteEntreprise?>URL du site de l'entreprise</label>
                            </div>
                        </div>
                        <?php
                        if (count ($CodErrInval))
                        {
                            ?>
                            <tr>
                                <td colspan="3" style="text-align : center"><br /><hr></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < count ($CodErrInval); ++$i)
                            {
                                ?>
                                <tr>
                                    <td colspan="3" style="text-align : center; color : red">
                                        <?=$MsgErr [$CodErrInval [$i]]?><br />
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <br>

                        <p class="center">
                            <button type="button" class="waves-effect waves-light btn black white-text"  onClick="history.go (-1)">Abandonner</button>
                            <button type="reset" class="waves-effect waves-light btn black white-text">Réinitialiser</button>
                            <button type="submit" class="waves-effect waves-light btn jaune white-text">Valider</button>
                        </p>
        <input type="hidden" name="StepConsult" value="Valid" >
        <input type="hidden" name="PK_Entreprise" value="<?=$ValPK_Entreprise?>" >
    </form>
        </div>
</div>

    <?php
}
else
{
    ?>
    <h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
    <?php
}
?>

