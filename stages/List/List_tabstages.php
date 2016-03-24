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

      case 'NomEDesc' :
        $OrderReq = "NomE desc, PK_Stage desc";
        break;

      case 'NumAsc' :
        $OrderReq = "PK_Stage asc";
        break;

      case 'NumDesc' :
      default        :
        $Slx      = 'NumDesc';
        $OrderReq = "PK_Stage desc";
    }

    $URL_ListNomE = '?Trait=List&SlxTable='.$NomTabStages.'&Slx=';
    $URL_ListNum  = '?Trait=List&SlxTable='.$NomTabStages.'&Slx=';
    $URL_Affect   = '?Trait=AffectStageEtud&FK_Stage=';

    switch ($Slx)
    {
      case 'NumAsc'  : $URL_ListNum .= 'NumDesc' ; break;
      case 'NumDesc' : $URL_ListNum .= 'NumAsc'  ; break;
    }
    $QuelOrdreNum    = 'Ordre '.($Slx == 'NumAsc' ? 'dé' : '').'croissant';
    $GifOrderNum     = ($Slx == 'NumDesc' ? 'arrow_drop_down' : 'arrow_drop_up');

    switch ($Slx)
    {
        case 'NomEAsc'  : $URL_ListNomE .= 'NomEDesc' ; break;
        case 'NomEDesc' :
        default :
          $Slx = 'NomEDesc';
          $URL_ListNomE .= 'NomEAsc';
    }
    $QuelOrdreNomE   = 'Ordre '.($Slx == 'NomEAsc' ? 'dé' : '').'croissant';
    $GifOrderNomE    = ($Slx == 'NomEDesc' ? 'arrow_drop_down' : 'arrow_drop_up');

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
//        $ReqStages = $ConnectStages->prepare("SELECT *
//                                 FROM $NomTabStages S, $NomTabEntreprises E
//                                 WHERE S.FK_Entreprise = E.PK_Entreprise
//                                   AND E.PK_Entreprise = :EntrepriseUser
//                                 ORDER BY ".$OrderReq);
        
        $ReqStages = $ConnectStages->prepare("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                   AND E.PK_Entreprise = :EntrepriseUser
                                 ORDER BY ".$OrderReq);
        $ReqStages->bindValue(':EntrepriseUser', $FK_EntrepriseUser, PDO::PARAM_INT);
        $ReqStages->execute();
    }
    // Requete générale pour toutes les fiches de stage
    /*
    else if ($Status == ETUDLP)
    {
        $ReqStages = $ConnectStages->query("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                 AND (S.NiveauStage = 2 OR S.NiveauStage = 3)
                                 ORDER BY ".$OrderReq);
    }
    */
    else if ($Status == ETUD2)
    {
//        $ReqStages = $ConnectStages->query("SELECT *
//                                 FROM $NomTabStages S, $NomTabEntreprises E
//                                 WHERE S.FK_Entreprise = E.PK_Entreprise
//                                 AND (S.NiveauStage = 1 OR S.NiveauStage = 3)
//                                 ORDER BY ".$OrderReq);
        
        $ReqStages = $ConnectStages->query("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                 AND (S.NiveauStage = 1 OR S.NiveauStage = 3)
                                 ORDER BY ".$OrderReq);
    }
    else
    {
//        $ReqStages = $ConnectStages->query("SELECT *
//                                 FROM $NomTabStages S, $NomTabEntreprises E
//                                 WHERE S.FK_Entreprise = E.PK_Entreprise
//                                 ORDER BY ".$OrderReq);
        
        $ReqStages = $ConnectStages->query("SELECT *
                                 FROM $NomTabStages S, $NomTabEntreprises E
                                 WHERE S.FK_Entreprise = E.PK_Entreprise
                                 ORDER BY ".$OrderReq);
    }
    {
    ?>

<span class="card-title"><h4 class="center"><?=$Title?></h4></span>
    
                                                                          <?php
        if (! $ReqStages->rowCount())
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

<table  class="highlight bordered centered grey lighten-5">
  <thead class="grey white-text">

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
                                ><i class="material-icons white-text" style="font-size: 20px"><?=$GifOrderNum?></i>
                                <b>Numéro</b>&nbsp;
                                 
                            </a>
                        </th>

                        <th style="text-align : center" valign="top" nowrap>
                          <b>Nombre de stages</b>
                        </th>

                        <th style="text-align : center" valign="top" nowrap>
                            <a class="white-text" href="<?=$URL_ListNomE?>"
                               <?=AttributsAHRef ($QuelOrdreNomE, $QuelOrdreNomE, '', '');?>
                                ><i class="material-icons white-text" style="font-size: 20px"><?=$GifOrderNomE?></i>
                                <b>Entreprise</b>
                            </a>
                        </th>
                    </tr>

                </thead>

                <tbody>
                    
                    <!--<tr><td colspan="<?=$NbCol?>"></td></tr>-->
                    <tr>
                                                                             <?php
                                            while ($ObjStage = $ReqStages->fetch())
                                            {
                                                if ($ObjStage['NbStagesRestant'] == 0)
                                                    if ($DroitStagesNonPourvus)
                                                        continue;
                                                    else
                                                        $BgColor = '#b71c1c';
                                                else
                                                    $BgColor = '#2196f3';
                                                                              ?>
                         <td valign="top">
                            <a href="<?=$URL_AffichStage.$ObjStage['PK_Stage']?>"
                               <?=AttributsAHRef  ('Detail', 'Detail', '', '');?>
                           ><i class="material-icons blue-text text-lighten-1">description</i></a>
                        </td>
                                                                              <?php
                                                if ($DroitAffectStageEtud)
                                                {
                                                    if ($ObjStage['NbStagesRestant'])
                                                    {
                                                                              ?>
                        <td valign="top">
                            <a href="<?=$URL_Affect.$ObjStage['PK_Stage']?>"
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
                            <a href="<?=$URL_FormStage.$ObjStage['PK_Stage']?>"
                               <?=AttributsAHRef  ('Modifier', 'Modifier', '', '');?>
                           ><i class="material-icons yellow-text text-darken-2">mode_edit</i></a>
                        </td>
                                                                            <?php
                                                }
                                                if ($DroitDel)
                                                {
                                                                              ?>
                        <td valign="top">
                            <a href="<?=$URL_DelStage.$ObjStage['PK_Stage']?>"
                               <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
                               onClick="return confirm ('Etes-vous sur de vouloir supprimer <?=$ObjStage['PK_Stage']?> ?')"
                               ><i class="material-icons red-text text-darken-2">delete_forever</i>
                            </a>
                        </td>
                                                                              <?php
                                                }
                                                                              ?>
                        <td valign="top" align="center">
                            <a href="<?=$URL_AffichStage.$ObjStage['PK_Stage']?>"
                               <?=AttributsAHRef  ($Bulle [$ObjStage['NiveauStage']], 'Details stage', '', '');?>
                            >
                            <?=$ObjStage['PK_Stage']?></a>
                        </td>
                        <td style="text-align : center"><?=$ObjStage['NbStagesRestant']?></td>
                        <td valign="top" align="center">
                            <a style="color : <?=$BgColor?>" href="<?=$URL_AffichSoc.$ObjStage['FK_Entreprise']?>"
                               <?=AttributsAHRef  ('Afficher la fiche de l\'entreprise',
                                                   'Details entreprise', '', '');?>
                            >
                            <?=stripslashes ($ObjStage['NomE'])?></a>
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
