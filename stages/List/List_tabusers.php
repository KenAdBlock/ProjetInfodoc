<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $Title = 'Liste des utilisateurs';

    switch ($Slx)
	{
	  case 'LoginAsc' :
	    $OrderReq = "Login asc";
	    break;
		
	  case 'LoginDesc' :
	    $OrderReq = "Login desc";
	    break;
		
	  case 'SAscNAsc' :
	    $OrderReq = "Status asc, Nom asc";
	    break;
		
	  case 'SDescNAsc' :
	    $OrderReq = "Status desc, Nom asc";
	    break;
		
	  case 'NDescSAsc' :
	    $OrderReq = "Nom desc, Status asc";
	    break;
		
	  case 'NAscSAsc' :
	  default         :
	    $Slx      = 'NAscSAsc';
	    $OrderReq = "Nom asc, Status asc";
	}

	$ReqUsers = $ConnectStages->query("SELECT $NomTabUsers.*, $NomTabStatus.Libelle
	                        FROM $NomTabUsers, $NomTabStatus
							WHERE $NomTabUsers.Status = $NomTabStatus.Code
                            ORDER BY ".$OrderReq);

	$URL_ListNom    = '?Trait=List&SlxTable='.$NomTabUsers.'&Slx=';
	switch ($Slx)
	{
      case 'SDescNAsc' : $URL_ListNom .= 'NAscSAsc' ; break;
	  case 'NAscSAsc'  : $URL_ListNom .= 'NDescSAsc'; break;
	  default          : $URL_ListNom .= 'NAscSAsc' ; break;
	}
	$QuelOrdreNom    = 'Ordre '.($Slx == 'NAscSAsc' ? 'de' : '').'croissant';
	$GifOrderNom     = ($Slx == 'NDescSAsc' ? 'arrow_drop_down' : 'arrow_drop_up');

	$URL_ListStatus  = '?Trait=List&SlxTable='.$NomTabUsers.'&Slx=';
	switch ($Slx)
	{
	  case 'SAscNAsc'  : $URL_ListStatus .= 'SDescNAsc'; break;
      case 'SDescNAsc' : $URL_ListStatus .= 'SAscNAsc' ; break;
	  default          : $URL_ListStatus .= 'SAscNAsc' ; break;
	}
	$QuelOrdreStatus = 'Ordre '.($Slx == 'SAscNAsc' ? 'de' : '').'croissant';
	$GifOrderStatus  = ($Slx == 'SDescNAsc' ? 'arrow_drop_down' : 'arrow_drop_up');

	$URL_ListLogin = '?Trait=List&SlxTable='.$NomTabUsers.'&Slx=';
	switch ($Slx)
	{
	  case 'LoginAsc'  : $URL_ListLogin .= 'LoginDesc' ; break;
	  default          : $URL_ListLogin .= 'LoginAsc'  ; break;	
	}
	$QuelOrdreLogin = 'Ordre '.($Slx == 'LoginAsc' ? 'de' : '').'croissant';
	$GifOrderLogin  = ($Slx == 'LoginDesc' ? 'arrow_drop_down' : 'arrow_drop_up');
					   
	$URL_ModifUser  = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='.$NomTabUsers;
	$URL_DelUser    = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable=' .$NomTabUsers;
                  
?>

<span class="card-title"><h4 class="center"><?=$Title?></h4></span>
                                                                          <?php
     if (! $ReqUsers->rowCount())
    {
                                                                          ?>
<h4 align="center">
    Aucun utilisateur n'a été trouvé.
</h4>
                                                                          <?php
    }
    else
    {
                                                                          ?>

<table  class="highlight bordered centered grey lighten-4">
  <thead class="grey white-text">
  	<tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a class="white-text" href="<?=$URL_ListLogin?>"
                           <?=AttributsAHRef ($QuelOrdreLogin, $QuelOrdreLogin, '', '');?>
						    ><i class="material-icons white-text " style="font-size: 20px"><?=$GifOrderLogin?></i>
						    <b>Login</b>&nbsp;
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a class="white-text" href="<?=$URL_ListStatus?>"
                           <?=AttributsAHRef ($QuelOrdreStatus, $QuelOrdreStatus, '', '');?>
						    ><i class="material-icons white-text " style="font-size: 20px"><?=$GifOrderStatus?></i>
						    <b>Statut</b>&nbsp;
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a class="white-text" href="<?=$URL_ListNom?>"
                           <?=AttributsAHRef ($QuelOrdreNom, $QuelOrdreNom, '', '');?>
						    ><i class="material-icons white-text " style="font-size: 20px"><?=$GifOrderNom?></i>
						    <b>Nom</b>&nbsp;
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Prénom</b>
					</th>
                </tr>
                </thead>
                                                                       <?php
                                                     while ($ObjUser = $ReqUsers->fetch())
                                                     {
                                                                       ?>
                <tr>
                    <td valign="top">
                        <a href="<?=$URL_ModifUser.'&IdentPK='.$ObjUser['PK_User']?>"
                           <?=AttributsAHRef  ('Modifier', 'Modifier', '', '');?>
					   ><i class="material-icons yellow-text text-darken-2">mode_edit</i></a>
                    </td>
                    <td valign="top">
                        <a href="<?=$URL_DelUser.'&IdentPK='.$ObjUser['PK_User']?>"
                           <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
                           onClick="return confirm ('Etes-vous sur de vouloir supprimer <?=$ObjUser['Nom']?> ?')"
						   ><i class="material-icons red-text text-darken-2">delete_forever</i>
						</a>
                    </td>
                    <td valign="top" style="text-align : center">
					    <?=$ObjUser['Login']?>
					</td>
                    <td valign="top" style="text-align : center">
					    <?=$ObjUser['Status']?>
					</td>
                    <td valign="top" style="text-align : center">
                        <?=$ObjUser['Nom']?>
					</td>
                    <td valign="top">
					    <?=$ObjUser['Prenom']?>
					</td>
                </tr>
                                                                       <?php
                                                     }
                                                                       ?>
            </table>
        </td>
        </td>
    </tr>
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
