<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $Title = 'Liste des entreprises devant verser la Taxe d\'Apprentissage';

    $ReqVersements = Query ("SELECT * FROM $NomTabTaxe ORDER BY RaisonSocialeSoc",
                            $Connexion);
    ?>
<h4 class="center">
    <?=$Title?>
</h4>
                                                                          <?php
        if (! mysql_num_rows ($ReqVersements))
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
    <thead class="grey darken-1 white-text">
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
                                        mysql_data_seek ($ReqVersements, 0);
                                        while ($ObjVersement = mysql_fetch_object ($ReqVersements))
                                        {
                                                                          ?>

    <tr>
        <td><?=stripslashes ($ObjVersement->RaisonSocialeSoc)?></td>
        <td><?=stripslashes ($ObjVersement->VilleSoc)?></td>
        <td><?=$ObjVersement->CatA?></td>
        <td><?=$ObjVersement->CatAPlusB?></td>
        <td><?=$ObjVersement->CatBPlusC?></td>
        <td><?=stripslashes ($ObjVersement->NomCollecteur)?></td>

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
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
