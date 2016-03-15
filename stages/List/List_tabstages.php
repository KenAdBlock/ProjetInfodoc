<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $Title = 'Liste des Stages';
    $Bulle = array();
    $Bulle [1] = 'DUT';
    $Bulle [2] = 'LP';
    $Bulle [3] = 'DUT ou LP';
    switch ($Slx)
    {
      case 'NomEAsc' :
        $OrderReq = "NomE asc, PK_Stage asc";
        break;

      case 'NumAsc' :
        $OrderReq = "PK_Stage asc";
        break;

      case 'NumDesc' :
      default        :
        $Slx      = 'NumDesc';
        $OrderReq = "PK_Stage desc";
    }

    $URL_ListNomE = '?Trait=List&SlxTable='.$NomTabStages.'&Slx=NomEAsc';
    $URL_ListNum  = '?Trait=List&SlxTable='.$NomTabStages.'&Slx=';
    $URL_Affect   = '?Trait=AffectStageEtud&FK_Stage=';

    switch ($Slx)
    {
      case 'NomEAsc' :
      case 'NumAsc'  : $URL_ListNum .= 'NumDesc' ; break;
      case 'NumDesc' : $URL_ListNum .= 'NumAsc'  ; break;

    }
    $QuelOrdreNum    = 'Ordre '.($Slx == 'NumAsc' ? 'de' : '').'croissant';
    $GifOrderNum     = $PATH_GIFS.
                      ($Slx == 'NumDesc' ? 'asc' : 'desc').'_order.png';
    $QuelOrdreNomE   = 'Ordre croissant';

    $URL_AffichStage = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable='.$NomTabStages.'&IdentPK=';
    $URL_FormStage   = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='  .$NomTabStages.'&IdentPK=';
    $URL_AffichSoc   = $PATH_BACKOFFICE.'BackOffice.php?Trait=Affich&SlxTable='.$NomTabEntreprises.'&IdentPK=';
    $URL_DelStage    = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable='   .$NomTabStages.'&IdentPK=';

    $DroitDel              = GetDroits ($Status, 'DelStage');
    $DroitModif            = GetDroits ($Status, 'ModifStage');
    $DroitAffectStageEtud  = GetDroits ($Status, 'AffectStageEtud');
    $DroitStagesNonPourvus = GetDroits ($Status, 'ListeFichesStagesNonPourvus');
    $NbCol = 4 + ($DroitAffectStageEtud ? 1 : 0) +
                 ($DroitModif           ? 1 : 0) +
                 ($DroitDel             ? 1 : 0);

    if ($Status == TUTEUR)
    {
        $ReqStages = Query ("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                   AND E.PK_Entreprise = $FK_EntrepriseUser
                                 ORDER BY ".$OrderReq,
                            $Connexion);
    }
    // Requete générale pour toutes les fiches de stage
    /*
    else if ($Status == ETUDLP)
    {
        $ReqStages = Query ("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                 AND (S.NiveauStage = 2 OR S.NiveauStage = 3)
                                 ORDER BY ".$OrderReq,
                            $Connexion);
    }
    */
    else if ($Status == ETUD2)
    {
        $ReqStages = Query ("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                 AND (S.NiveauStage = 1 OR S.NiveauStage = 3)
                                 ORDER BY ".$OrderReq,
                            $Connexion);
    }
    else
    {
        $ReqStages = Query ("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                 ORDER BY ".$OrderReq,
                            $Connexion);
    }
    {
    ?>

<h1 style="text-align : center">
    <?=$Title?>
</h1>
                                                                          <?php
        if (! mysql_num_rows ($ReqStages))
        {
                                                                          ?>
<h4 align="center">
    Aucun stage n'a &eacute;t&eacute; trouv&eacute;.
</h4>
                                                                          <?php
        }
        else
        {
                                                                          ?>
<h4 style="text-align : center;">
    Pour afficher les informations relatives &agrave; un stage, cliquez sur son num&eacute;ro.
</h4>
<table  align="center">
    <tbody>
    <tr>
        <td valign="top">
            <table cellpadding="5">
                <tbody>
                    <tr>
                        <th>&nbsp;</th>
                                                                             <?php
                                                if ($DroitAffectStageEtud)
                                                {
                                                                              ?>
                        <th>&nbsp;</th>
                                                                              <?php
                                                }
                                                if ($DroitModif)
                                                {
                                                                              ?>
                        <th>&nbsp;</th>
                                                                              <?php
                                                }
                                                if ($DroitDel)
                                                {
                                                                              ?>
                        <th>&nbsp;</th>
                                                                              <?php
                                                }
                                                                              ?>
                        <th style="text-align : center" valign="top" nowrap>
                            <a href="<?=$URL_ListNum?>"
                               <?=AttributsAHRef ($QuelOrdreNum, $QuelOrdreNum, '', '');?>
                                ><b>Num&eacute;ro</b>&nbsp;
                                 <img border="0" src="<?=$GifOrderNum?>">
                            </a>
                        </th>

                        <th>Nbre stages restant</th>

                        <th style="text-align : center" valign="top" nowrap>
                            <a href="<?=$URL_ListNomE?>"
                               <?=AttributsAHRef ($QuelOrdreNomE, $QuelOrdreNomE, '', '');?>
                                <b>Entreprise</b>
                            </a>
                        </th>
                    </tr>
                    <tr><td colspan="<?=$NbCol?>"><hr></td></tr>
                    <tr>
                                                                             <?php
                                            mysql_data_seek ($ReqStages, 0);
                                            while ($ObjStage = mysql_fetch_object ($ReqStages))
                                            {
                                                if ($ObjStage->NbStagesRestant == 0)
                                                    if ($DroitStagesNonPourvus)
                                                        continue;
                                                    else
                                                        $BgColor = '#ffc2c2';
                                                else
                                                    $BgColor = '#efefef';
                                                                              ?>
                         <td valign="top">
                            <a href="<?=$URL_AffichStage.$ObjStage->PK_Stage?>"
                               <?=AttributsAHRef  ('Detail', 'Detail', '', '');?>
                           ><img src="<?=$PATH_GIFS?>b_browse.png" border="0"></a>
                        </td>
                                                                              <?php
                                                if ($DroitAffectStageEtud)
                                                {
                                                    if ($ObjStage->NbStagesRestant)
                                                    {
                                                                              ?>
                        <td valign="top">
                            <a href="<?=$URL_Affect.$ObjStage->PK_Stage?>"
                               <?=AttributsAHRef  ('Affecter', 'Affecter', '', '');?>
                           ><img src="<?=$PATH_GIFS?>b_insrow.png" border="0"></a>
                        </td>

                                                                              <?php
                                                    }
                                                    else
                                                    {
                                                                              ?>
                         <td>&nbsp;</td>
                                                                               <?php
                                                    }
                                                                              ?>
                                                                              <?php
                                                }
                                                if ($DroitModif)
                                                {
                                                                              ?>
                        <td valign="top">
                            <a href="<?=$URL_FormStage.$ObjStage->PK_Stage?>"
                               <?=AttributsAHRef  ('Modifier', 'Modifier', '', '');?>
                           ><img src="<?=$PATH_GIFS?>b_edit.png" border="0"></a>
                        </td>
                                                                            <?php
                                                }
                                                if ($DroitDel)
                                                {
                                                                              ?>
                        <td valign="top">
                            <a href="<?=$URL_DelStage.$ObjStage->PK_Stage?>"
                               <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
                               onClick="return confirm ('Etes-vous sur de vouloir supprimer <?=$ObjStage->PK_Stage?> ?')"
                               ><img src="<?=$PATH_GIFS?>b_deltbl.png"
                                     border="0">
                            </a>
                        </td>
                                                                              <?php
                                                }
                                                                              ?>
                        <td valign="top" align="center">
                            <a href="<?=$URL_AffichStage.$ObjStage->PK_Stage?>"
                               <?=AttributsAHRef  ($Bulle [$ObjStage->NiveauStage], 'Details stage', '', '');?>
                            >
                            <?=$ObjStage->PK_Stage?></a>
                        </td>
                        <td style="text-align : center"><?=$ObjStage->NbStagesRestant?></td>
                        <td valign="top" align="center" style="background-color : <?=$BgColor?>" >
                            <a href="<?=$URL_AffichSoc.$ObjStage->FK_Entreprise?>"
                               <?=AttributsAHRef  ('Afficher la fiche de l\'entreprise',
                                                   'Details entreprise', '', '');?>
                            >
                            <?=stripslashes ($ObjStage->NomE)?></a>
                        </td>
                    </tr>
                                                                              <?php
                                            }
                                                                              ?>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<?php
        }
    }
}
else
{
    ?>
    <h2 style="text-align : center">Vous ne pouvez acc&eacute;der directement &agrave; cette page</h2>
    <?php
}
    ?>