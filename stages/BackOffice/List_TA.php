<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $Title = 'Liste des entreprises devant verser la Taxe d\'Apprentissage';

    $ReqVersements = $ConnectStages->query("SELECT * FROM $NomTabTaxe ORDER BY RaisonSocialeSoc");
    ?>
<h4 class="center">
    <?=$Title?>
</h4>
                                                                          <?php
        if (! $ReqVersements->rowCount())
        {
                                                                          ?>
<h4 align="center">
    Aucune entreprise n'a été trouvée.
</h4>
                                                                          <?php
        }
        else
        {
                                                                          ?>

<table class="highlight bordered centered grey lighten-5">
    <thead class="grey white-text">
    <tr>
        <th>Raison sociale</th>
        <th>Ville</th>
        <th>Cat. A</th>
        <th>Cat. A+B</th>
        <th>Cat. B+C</th>
        <th>Organisme</th>

    </tr>
    </thead>
                                                                          <?php
                                        while ($ObjVersement = $ReqVersements->fetch())
                                        {
                                                                          ?>

    <tr>
        <td><?=stripslashes ($ObjVersement['RaisonSocialeSoc'])?></td>
        <td><?=stripslashes ($ObjVersement['VilleSoc'])?></td>
        <td><?=$ObjVersement['CatA']?></td>
        <td><?=$ObjVersement['CatAPlusB']?></td>
        <td><?=$ObjVersement['CatBPlusC']?></td>
        <td><?=stripslashes ($ObjVersement['NomCollecteur'])?></td>
    </tr>
                                                                          <?php
                                        }
                                                                          ?>
</table>

                                                                          <?php
        }
}
else
{
?>
    <h4 class="center">Vous ne pouvez accéder directement à cette page</h4>
<?php
}
?>
