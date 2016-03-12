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
    $GifOrderNum     = ($Slx == 'NumDesc' ? 'arrow_drop_down' : 'arrow_drop_up');
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

<span class="card-title"><h4 class="center"><?=$Title?></h4></span>
    
                                                                          <?php
        if (! mysql_num_rows ($ReqStages))
        {
                                                                          ?>
<h5 class="center">
    Aucun stage n'a été trouvé.
</h5>
                                                                          <?php
        }
        else
        {
                                                                          ?>

<table  class="highlight bordered centered grey lighten-3">
  <thead class="grey darken-1 white-text">

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
                            <a class="white-text" href="<?=$URL_ListNum?>"
                               <?=AttributsAHRef ($QuelOrdreNum, $QuelOrdreNum, '', '');?>
                                ><i class="material-icons white-text right" style="font-size: 20px"><?=$GifOrderNum?></i>
                                <b>Numéro</b>&nbsp;
                                 
                            </a>
                        </th>

                        <th>Nbre stages restant</th>

                        <th style="text-align : center" valign="top" nowrap>
                            <a class="white-text" href="<?=$URL_ListNomE?>"
                               <?=AttributsAHRef ($QuelOrdreNomE, $QuelOrdreNomE, '', '');?>
                                <b>Entreprise</b>
                            </a>
                        </th>
                    </tr>

                </thead>

                <tbody>
                    
                    <!--<tr><td colspan="<?=$NbCol?>"></td></tr>-->
                    <tr>
                                                                             <?php
                                            mysql_data_seek ($ReqStages, 0);
                                            while ($ObjStage = mysql_fetch_object ($ReqStages))
                                            {
                                                if ($ObjStage->NbStagesRestant == 0)
                                                    if ($DroitStagesNonPourvus)
                                                        continue;
                                                    else
                                                        $BgColor = '#2196f3';
                                                else
                                                    $BgColor = '#b71c1c';
                                                                              ?>
                         <td valign="top">
                            <a href="<?=$URL_AffichStage.$ObjStage->PK_Stage?>"
                               <?=AttributsAHRef  ('Detail', 'Detail', '', '');?>
                           ><i class="material-icons blue-text text-lighten-1">description</i></a>
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
                           ><i class="material-icons blue-text text-lighten-1">input</i></a>
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
                           ><i class="material-icons yellow-text text-darken-2">mode_edit</i></a>
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
                               ><i class="material-icons red-text text-darken-2">delete_forever</i>
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
                        <td valign="top" align="center">
                            <a style="color : <?=$BgColor?>" href="<?=$URL_AffichSoc.$ObjStage->FK_Entreprise?>"
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

<?php
        }
    }
}
else
{
    ?>
    <h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
    <?php
}
    ?>
