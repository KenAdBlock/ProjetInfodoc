<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $Title = 'Liste des entreprises devant verser la Taxe d\'Apprentissage';

    $ReqVersements = Query ("SELECT * FROM $NomTabTaxe ORDER BY RaisonSocialeSoc",
                            $Connexion);
    ?>
<h1 style="text-align : center">
    <?=$Title?>
</h1>
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
<table width="100%">
<table align="center" style="border : thin solid black;" >
    <tr>
        <th style="text-align : center">Raison sociale</th>
        <th style="text-align : center">Ville</th>
        <th style="text-align : center">Cat. A</th>
        <th style="text-align : center">Cat. A+B</th>
        <th style="text-align : center">Cat. B+C</th>
        <th style="text-align : center">Organisme</th>
    </tr>
    <tr>
        <th colspan="6"><hr width="100%"></th>
    </tr>
                                                                          <?php
                                        mysql_data_seek ($ReqVersements, 0);
                                        while ($ObjVersement = mysql_fetch_object ($ReqVersements))
                                        {
                                                                          ?>

    <tr>
        <td style="text-align : center"><?=stripslashes ($ObjVersement->RaisonSocialeSoc)?></td>
        <td style="text-align : center"><?=stripslashes ($ObjVersement->VilleSoc)?></td>
        <td style="text-align : center"><?=$ObjVersement->CatA?></td>
        <td style="text-align : center"><?=$ObjVersement->CatAPlusB?></td>
        <td style="text-align : center"><?=$ObjVersement->CatBPlusC?></td>
        <td style="text-align : center"><?=stripslashes ($ObjVersement->NomCollecteur)?></td>
    </tr>
                                                                          <?php
                                        }
                                                                          ?>
</table>
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
</body>
</html>
