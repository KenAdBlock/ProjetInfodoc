<?php
    include_once ('Class/CUser.php');//bonjour

    // R&eacute;cup&eacute;ration des variables envoy&eacute;es par POST ou GET

    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;
    if (!isset ($Step))
        $Step = isset ($IdentPK) && $IdentPK != 0 ? 'InitModif' : 'InitNew';
    switch ($Step)
    {
      case 'InitModif' :
	  
        // R&eacute;cup&eacute;ration de l'enreg. &agrave; modifier

        $ObjTuple = new CUser ($IdentPK);
        $ValPK_User = $ObjTuple->GetPK_User();
        $ValidPK_User = ESPACE;
        $ValLogin = $ObjTuple->GetLogin();
        $ValidLogin = ESPACE;
        $ValPass =$ObjTuple->GetPass();
        if ($ValPass) $DejaPass = 1;
        $ValidPass = ESPACE;
        $ValPrivilege = $ObjTuple->GetPrivilege();
        $ValidPrivilege = ESPACE;
        $ValNom = $ObjTuple->GetNom();
        $ValidNom = ESPACE;
        $ValPrenom = $ObjTuple->GetPrenom();
        $ValidPrenom = ESPACE;
        $ValMail = $ObjTuple->GetMail();
        $ValidMail = ESPACE;
        $ValTel = $ObjTuple->GetTel();
        $ValidTel = ESPACE;
        $ValFax = $ObjTuple->GetFax();
        $ValidFax = ESPACE;
        $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
        $ValidFK_Entreprise = ESPACE;
        break;

      case 'InitNew' :
        // Pr&eacute;paration du nouvel enreg.

        $ObjTuple = new CUser ();
        $ValPK_User = $ObjTuple->GetPK_User();
        $ValidPK_User = ESPACE;
        $ValLogin = $ObjTuple->GetLogin();
        $ValidLogin = ESPACE;
        $ValPass = $ObjTuple->GetPass();
        $ValidPass = ESPACE;
        $ValPrivilege = $ObjTuple->GetPrivilege();
        $ValidPrivilege = ESPACE;
        $ValNom = $ObjTuple->GetNom();
        $ValidNom = ESPACE;
        $ValPrenom = $ObjTuple->GetPrenom();
        $ValidPrenom = ESPACE;
        $ValMail = $ObjTuple->GetMail();
        $ValidMail = ESPACE;
        $ValTel = $ObjTuple->GetTel();
        $ValidTel = ESPACE;
        $ValFax = $ObjTuple->GetFax();
        $ValidFax = ESPACE;
        $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
        $ValidFK_Entreprise = ESPACE;
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
        $ValPK_User = $PK_User;
        if (trim ($ValPK_User) == '')
        {
            array_push ($CodErrVide, 'PK_User');
            $ValidPK_User = FLECHE;
        }
        else
            $ValidPK_User = ESPACE;
        $ValLogin = $Login;
        if (trim ($ValLogin) == '')
        {
            array_push ($CodErrVide, 'Login');
            $ValidLogin = FLECHE;
        }
        else
            $ValidLogin = ESPACE;
			
        if ($IdentPK == 0)
        {
            $ValPass = $Pass;
            if (trim ($ValPass) == '')
            {
                array_push ($CodErrVide, 'Pass');
                $ValidPass = FLECHE;
            }
            else
                $ValidPass = ESPACE;
            }
            $ValPrivilege = $Privilege;
            if (IdentPK==0)
            {
                if (trim ($ValPrivilege) == '')
                {
                    array_push ($CodErrVide, 'Privilege');
                    $ValidPrivilege = FLECHE;
                }
                else
                    $ValidPrivilege = ESPACE;
                }
                $ValNom = $Nom;
                if (trim ($ValNom) == '')
                {
                    array_push ($CodErrVide, 'Nom');
                    $ValidNom = FLECHE;
                }
                else
                    $ValidNom = ESPACE;
                $ValPrenom = $Prenom;
                if (trim ($ValPrenom) == '')
                {
                    array_push ($CodErrVide, 'Prenom');
                    $ValidPrenom = FLECHE;
                }
                else
                    $ValidPrenom = ESPACE;
					
                $ValMail = $Mail;
                $ValTel  = $Tel;
                $ValFax  = $Fax;
                if ($ValPrivilege == 'tuteur')
                    $ValFK_Entreprise = $FK_Entreprise;

                // l'attribut entreprise doit &ecirc;tre selectionn&eacute; seulement si le
                // privil&egrave;ge selectionn&eacute; est Tuteur
		
                if ((trim ($ValFK_Entreprise) != '') && (trim ($ValPrivilege) != 'tuteur'))
                    $CodErrTut = true;        
        
                // on compare le login entr&eacute; avec les logins d&eacute;j&agrave;  existants pour
                // &eacute;viter qu'il y en ai 2 identiques
        if ($IdentPK ==0)
        {
            $ReqL = Query("SELECT Login from tabusers",$Connexion);
            while ($RowL = mysql_fetch_row($ReqL))
            {
                if ($ValLogin == $RowL[0])
                {
                    $CodErrLog = true;
                    $ValidLogin = FLECHE;
                }
            }
        }
        
        $Fleche = FLECHE;
         
        if (!$CodErrVide && !$CodErrInval && !$CodErrLog && !$CodErrTut)
        {
            print ('<h1>Enregistrer</h1>');
            // Pr&eacute;paration de l'enreg. &agrave; enregistrer

            $ObjTuple = new CUser ();
            $ObjTuple->SetPK_User($ValPK_User);
            $ObjTuple->SetLogin($ValLogin);
            $ObjTuple->SetPass(md5($ValPass));
            $ObjTuple->SetPrivilege($ValPrivilege);
            $ObjTuple->SetNom($ValNom);
            $ObjTuple->SetPrenom($ValPrenom);
            $ObjTuple->SetMail($ValMail);
            $ObjTuple->SetTel($ValTel);
            $ObjTuple->SetFax($ValFax);
            if ($ValPrivilege == 'tuteur')
            $ObjTuple->SetFK_Entreprise($ValFK_Entreprise);
            
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
        if(($_SESSION['privilege'] == "tuteur")or
           ($_SESSION['privilege'] == "prof")or
           ($_SESSION['privilege'] == "etud"))
        {
                                                                       ?>
        <script>location.replace("?Trait=AFFICH&SlxTable=tabusers");</script>
        <?php }?>
        <script>location.replace("?Trait=LIST&SlxTable=tabusers");</script>
                                                                       <?php
    }
    else
    {
                                                                       ?>
<?php if ($IdentPK==0) {?>
<h1> Cr&eacute;ation d'un Nouvel Utilisateur </h1>
<?php } else {?>
<h1> Modification d'un Utilisateur </h1>
<?php }?>
<p style="text-align : center; font-size : 11px; font-style : italic;">Toutes les rubriques en <b>gras</b> doivent obligatoirement &ecirc;tre remplies</p>
<?php if ($CodErrVide || $CodErrInval) { ?>
<p style="text-align : center; font-size : 16px;">Les
<?=$Fleche?> indiquent qu'une rubrique est vide ou erron&eacute;e</p> <?php } ?>
<?php if ($CodErrTut) { ?>
<p style="text-align : center; font-size : 16px;">Si vous n'&ecirc;tes pas Tuteur, veuillez ne pas sp&eacute;cifier d'Entreprise</p>
<?php } ?>
<?php if ($CodErrLog) { ?>
<p style="text-align : center; font-size : 16px;">Ce Login est d&eacute;j&agrave;
pris, veuillez en choisir un autre</p>
<?php } ?>
<?php if ($CodErrFax) { ?>
<p style="text-align : center; font-size : 16px;">Le Champ Fax est
invalide, veuillez entrez un nombre.</p>
<?php } ?>
<?php if ($CodErrTel) { ?>
<p style="text-align : center; font-size : 16px;">Le Champ Tel est
invalide, veuillez entre un num&eacute;ro</p>
<?php } ?>
<form method="post">
<table align="center" border="1px" ><tr><td>
<table cellpadding="2">
    <?php if ($ValPK_User) { ?>
    <tr>
        <td valign="top"><tt><?=$ValidPK_User?></tt></td>
        <td style="text-align : right" valign="top"><b>Num&eacute;ro</b></td>
        <td>
            <?=$ValPK_User?>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td valign="top"><tt><?=$ValidLogin?></tt></td>
        <td style="text-align : right" valign="top"><b>Login</b></td>
        <td>
            <input type="text" name="Login" size="50" value="<?=$ValLogin?>">
        </td>
    </tr>
    <?php if ($IdentPK==0){?>
    <tr>
        <td valign="top"><tt><?=$ValidPass?></tt></td>
        <td style="text-align : right" valign="top"><b>Pass</b></td>
        <td>
            <input type="password" name="Pass" size="50" value="<?=$ValPass?>">
        </td>
    </tr>
    <?php}?>
    <?php  if(($_SESSION['privilege'] == "tuteur")or
           ($_SESSION['privilege'] == "prof")or
           ($_SESSION['privilege'] == "etud"))
        {?>

        <tr><td></td><td><b>Privil&egrave;ge</b></td><td><b>

        <?php
            switch($ValPrivilege)
            {
                case'resp':
                echo "Responsable des stages";
                break;
            
                case'etud':
                echo "Etudiant(e)";
                break;
            
                case'prof':
                echo "Professeur";
                break;
            
                case'secr':
                echo "Secretariat";
                break;
            
                case'tuteur':
                echo "Tuteur professionnel";
                break;
            
                case'admin':
                echo "Administrateur";
                break;
            }?>

          <input type="hidden" name="Privilege" value = <?=$ValPrivilege?>>
        </b></td></tr>
      <?php }else
      {?>
    <tr>
        <td valign="top"><tt><?=$ValidPrivilege?></tt></td>
      <td><span class="Style8"><b>Privilege</b></span></td>
      <td><select name="Privilege" id=Privilege">
        <option value="etud" <?php if($ValPrivilege=="etud") {?> selected <?php }?>>
        Etudiant</option>
        <option value="resp" <?php if($ValPrivilege=="resp") {?> selected <?php }?>>
        Responsable de Stage</option>
        <option value="admin" <?php if($ValPrivilege=="admin") {?> selected <?php }?>>
        Administrateur</option>
        <option value="secr" <?php if($ValPrivilege=="secr") {?> selected <?php }?>>
        Secretariat</option>
        <option value="prof" <?php if($ValPrivilege=="prof") {?> selected <?php }?>>
        Professeur</option>
        <option value="tuteur" <?php if($ValPrivilege=="tuteur") {?> selected <?php }?>>
        Tuteur Professionnel</option>
      </select></td>
        </td>
    </tr>
    <?php }?>
    <tr>
        <td valign="top"><tt><?=$ValidNom?></tt></td>
        <td style="text-align : right" valign="top"><b>Nom</b></td>
        <td>
            <input type="text" name="Nom" size="50" value="<?=$ValNom?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidPrenom?></tt></td>
        <td style="text-align : right" valign="top"><b>Prenom</b></td>
        <td>
            <input type="text" name="Prenom" size="50" value="<?=$ValPrenom?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMail?></tt></td>
        <td style="text-align : right" valign="top">Mail</td>
        <td>
            <input type="text" name="Mail" size="50" value="<?=$ValMail?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidTel?></tt></td>
        <td style="text-align : right" valign="top">Tel</td>
        <td>
            <input type="text" name="Tel" size="50" value="<?=$ValTel?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidFax?></tt></td>
        <td style="text-align : right" valign="top">Fax</td>
        <td>
            <input type="text" name="Fax" size="50" value="<?=$ValFax?>">
        </td>
    </tr>

    <?php $ResultListEntreprise = Query ("SELECT NomE, PK_Entreprise FROM
    tabentreprise",$Connexion);?>
    <tr>
    <td></td><td></td><td width="250">Si vous &ecirc;tes Tuteur Professionnel, pr&eacute;cisez l'entreprise </td>
    </tr>
    <?php if ($_SESSION['privilege']!="tuteur")
      { ?>
        <tr>
        <td valign="top"><tt><?=$ValidFK_Entreprise?></tt></td>
        <td></td>
        <td>
            <select name="FK_Entreprise" size="1" style="width :<?=$WidthSelect?>">;        
            <option value =''></option>
        <?php
        while ($row = mysql_fetch_row ($ResultListEntreprise))
                                        {
                                                                         ?>
                    <option value="<?=$row [1]?>"
                    <?php if($row[1]==$ValFK_Entreprise)
                    {?>selected <?php }?>>
                    <?=$row [0]?></option>
                                                                         <?php
                                        }
                                                                         ?>
            </select>
        </td>
        </tr>
        <?php }else
            //Si c'est une fiche cr&eacute;e par un tuteur, il ne doit pas
            //pouvoir modifier l'entreprise...
          {
               $login = $_SESSION['Login'];
               $req1 = Query("SELECT FK_Entreprise from tabusers where
                              Login='$login'",$Connexion);
               $row1 = mysql_fetch_row ($req1);
               $req2 = Query("SELECT NomE from tabentreprise where
                       PK_Entreprise = $row1[0]",$Connexion);
               $row2 = mysql_fetch_row ($req2);
          ?>
          <tr><td></td><td></td><td align="center"><b><?=$row2[0]?></b></td></tr>
          <input type="hidden" name="FK_Entreprise" value = <?=$row1[0]?>>
          <?php }?>
    <tr>
        <td colspan="3" style="text-align : center">
            <input type="button" value="Abandonner"
                    onClick="history.go (-1)">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="Reinitialiser">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" 
                   value="Valider" >
        </td>
    </tr>
</table>
</td></tr></table>
<input type="hidden" name="Step" value="Valid" >
<input type="hidden" name="PK_User" value="<?=$ValPK_User?>" >
</form>
                                                                       <?php
    }
                                                                       ?>

</body>
</html>
