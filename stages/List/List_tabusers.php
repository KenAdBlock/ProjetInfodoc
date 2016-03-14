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
    $ReqUsers = Query ("SELECT $NomTabUsers.*, $NomTabStatus.Libelle
	                        FROM $NomTabUsers, $NomTabStatus
							WHERE $NomTabUsers.Status = $NomTabStatus.Code
                            ORDER BY ".$OrderReq,
                       $Connexion);

	$URL_ListNom    = '?Trait=List&SlxTable='.$NomTabUsers.'&Slx=';
	switch ($Slx)
	{
      case 'SDescNAsc' : $URL_ListNom .= 'NAscSAsc' ; break;
	  case 'NAscSAsc'  : $URL_ListNom .= 'NDescSAsc'; break;
	  default          : $URL_ListNom .= 'NAscSAsc' ; break;
	}
	$QuelOrdreNom    = 'Ordre '.($Slx == 'NAscSAsc' ? 'de' : '').'croissant';
	$GifOrderNom     = $PATH_GIFS.
                      ($Slx == 'NDescSAsc' ? 'asc' : 'desc').'_order.png';

	$URL_ListStatus  = '?Trait=List&SlxTable='.$NomTabUsers.'&Slx=';
	switch ($Slx)
	{
	  case 'SAscNAsc'  : $URL_ListStatus .= 'SDescNAsc'; break;
      case 'SDescNAsc' : $URL_ListStatus .= 'SAscNAsc' ; break;
	  default          : $URL_ListStatus .= 'SAscNAsc' ; break;
	}
	$QuelOrdreStatus = 'Ordre '.($Slx == 'SAscNAsc' ? 'de' : '').'croissant';
	$GifOrderStatus  = $PATH_GIFS.
                       ($Slx == 'SDescNAsc' ? 'asc' : 'desc').'_order.png';

	$URL_ListLogin = '?Trait=List&SlxTable='.$NomTabUsers.'&Slx=';
	switch ($Slx)
	{
	  case 'LoginAsc'  : $URL_ListLogin .= 'LoginDesc' ; break;
	  default          : $URL_ListLogin .= 'LoginAsc'  ; break;	
	}
	$QuelOrdreLogin = 'Ordre '.($Slx == 'LoginAsc' ? 'de' : '').'croissant';
	$GifOrderLogin  = $PATH_GIFS.
                       ($Slx == 'LoginDesc' ? 'asc' : 'desc').'_order.png';
					   
	$URL_ModifUser  = $PATH_BACKOFFICE.'BackOffice.php?Trait=Form&SlxTable='.$NomTabUsers;
	$URL_DelUser    = $PATH_BACKOFFICE.'BackOffice.php?Trait=Del&SlxTable=' .$NomTabUsers;
                  
?>
<h1 style="text-align : center">
    <?=$Title?>
</h1>
                                                                          <?php
     if (! mysql_num_rows ($ReqUsers))
    {
                                                                          ?>
<h4 align="center">
    Aucun utilisateur n'a &eacute;t&eacute; trouv&eacute;.
</h4>
                                                                          <?php
    }
    else
    {
                                                                          ?>

<table align="center" border="0" cellpadding="2">
    <tr>
        <td valign="top">
            <table cellpadding="2">
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a href="<?=$URL_ListLogin?>"
                           <?=AttributsAHRef ($QuelOrdreLogin, $QuelOrdreLogin, '', '');?>
						    ><b>Login</b>&nbsp;
							 <img border="0" src="<?=$GifOrderLogin?>">
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a href="<?=$URL_ListStatus?>"
                           <?=AttributsAHRef ($QuelOrdreStatus, $QuelOrdreStatus, '', '');?>
						    ><b>Statut</b>&nbsp;
							 <img border="0" src="<?=$GifOrderStatus?>">
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <a href="<?=$URL_ListNom?>"
                           <?=AttributsAHRef ($QuelOrdreNom, $QuelOrdreNom, '', '');?>
						    ><b>Nom</b>&nbsp;
							 <img border="0" src="<?=$GifOrderNom?>">
						</a>
					</th>
                    <th style="text-align : center" valign="top" nowrap>
					    <b>Pr&eacute;nom</b>
					</th>
                </tr>
                <tr><td colspan="6"><hr></td></tr>
                                                                       <?php
                                                     mysql_data_seek ($ReqUsers, 0);
                                                     while ($ObjUser = mysql_fetch_object ($ReqUsers))
                                                     {
                                                                       ?>
                <tr>
                    <td valign="top">
                        <a href="<?=$URL_ModifUser.'&IdentPK='.$ObjUser->PK_User?>"
                           <?=AttributsAHRef  ('Modifier', 'Modifier', '', '');?>
					   ><img src="<?=$PATH_GIFS?>b_edit.png" border="0"></a>
                    </td>
                    <td valign="top">
                        <a href="<?=$URL_DelUser.'&IdentPK='.$ObjUser->PK_User?>"
                           <?=AttributsAHRef  ('Supprimer', 'Supprimer', '', '');?>
                           onClick="return confirm ('Etes-vous sur de vouloir supprimer <?=$ObjUser->Nom?> ?')"
						   ><img src="<?=$PATH_GIFS?>b_deltbl.png"
						         border="0">
						</a>
                    </td>
                    <td valign="top" style="text-align : center">
					    <?=$ObjUser->Login?>
					</td>
                    <td valign="top" style="text-align : center">
					    <?=$ObjUser->Status?>
					</td>
                    <td valign="top" style="text-align : center">
                        <?=$ObjUser->Nom?>
					</td>
                    <td valign="top">
					    <?=$ObjUser->Prenom?>
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
<h2 style="text-align : center">Vous ne pouvez acc&eacute;der directement &agrave; cette page</h2>
<?php
}
?>
