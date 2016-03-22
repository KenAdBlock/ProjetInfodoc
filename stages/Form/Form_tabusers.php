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
    require_once ($PATH_CLASS.'CUser.php');
    require_once ($PATH_UTIL.'UtilLogin.php');
    require_once ($PATH_COMMUNS.'FctDiverses.php');

	$ReqStatus      = Query ("SELECT * FROM $NomTabStatus",     
	                         $Connexion);
	$ReqEntreprises = Query ("SELECT NomE, PK_Entreprise 
	                              FROM $NomTabEntreprises
								  ORDER BY NomE",
	                         $Connexion);
    if (! GetDroits ($Status, 'ModifUser')) $IdentPK = $_SESSION ['PK_User'];
	
    if (!isset ($StepConsult))
        $StepConsult = (isset ($IdentPK) && $IdentPK != 0) ? 'InitModif' : 'InitNew';

    $ValidPK_User       =
    $ValidLogin         =

    $ValidCivilite      =
    $ValidNom           =
    $ValidPrenom        =
    $ValidMail          =
    $ValidTel           =
    $ValidFax           =
    $ValidFK_Entreprise = ESPACE;

    switch ($StepConsult)
    {
      case 'InitModif' :
      case 'InitNew'   :
	  
        // Préparation du nouvel enreg. ou récupération de l'enreg. à modifier

	    $ObjTuple = new CUser ($StepConsult == 'InitModif'? $IdentPK : 0);

        $ValPK_User       = $ObjTuple->GetPK_User();
        $ValLogin         = $ObjTuple->GetLogin();
        $ValPassWord      = $ObjTuple->GetPassWord();
        $ValStatus        = $ObjTuple->GetStatus();
        $ValCivilite      = $ObjTuple->GetCivilite();
        $ValNom           = $ObjTuple->GetNom();
        $ValPrenom        = $ObjTuple->GetPrenom();
        $ValMail          = $ObjTuple->GetMail();
        $ValTel           = $ObjTuple->GetTel();
        $ValFax           = $ObjTuple->GetFax();
        $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
        $ValPK_User  = $PK_User;
        $ValCivilite = $Civilite;

        if (($ValNom = trim ($Nom)) == '')
        {
            array_push ($CodErrVide, 'Nom');
            $ValidNom = FLECHE;
        }
		if (($ValPrenom = trim ($Prenom)) == '')
        {
            array_push ($CodErrVide, 'Prenom');
            $ValidPrenom = FLECHE;
        }
        if (($ValTel = trim ($Tel)) == '')
        {
            array_push ($CodErrVide, 'Tel');
            $ValidTel = FLECHE;
        }
		else if ($Err = NormaliserTel ($ValTel))
		{
		    array_push ($CodErrInval, $Err);
            $ValidTel = FLECHE;
		}
        if (($ValMail = trim ($Mail)) == '')
        {
            array_push ($CodErrVide, 'Mail');
            $ValidMail = FLECHE;
        }
        if (($ValFax = trim ($Fax)) != '' && ($Err = NormaliserTel ($ValFax)))
		{
		    array_push ($CodErrInval, $Err);
            $ValidFax = FLECHE;
		}

        // Validation du Login
		
		$ValLogin    = trim ($Login);
		$ValPassWord = trim ($PassWord);
        if ($IdentPK == 0)
		{
		    if (($ValLogin = trim ($Login)) == '')
            {
                array_push ($CodErrVide, 'Login');
                $ValidLogin = FLECHE;
            }
            else if ($Err = ErrorLogin ($ValLogin))
            {
		        array_push ($CodErrInval, $Err);
                $ValidLogin = FLECHE;
			}
        }
		$ValFK_Entreprise = $FK_Entreprise;
		if (($ValStatus = $StatusUser) == TUTEUR && 
		     $ValFK_Entreprise == 0)
        {
		    array_push ($CodErrInval, STATUS_SOC_IMPOSS);
            $ValidStatus        =
            $ValidFK_Entreprise = FLECHE;
        }
		if (($ValStatus = $StatusUser) != TUTEUR && 
		     $ValFK_Entreprise != 0)
        {
		    array_push ($CodErrInval, STATUS_SANS_SOC);
            $ValidStatus        =
            $ValidFK_Entreprise = FLECHE;
        }
        if (! ($CodErrVide || $CodErrInval))
        {
            // Préparation de l'enregistrement

            $ObjTuple = new CUser ();
			
            $ObjTuple->SetPK_User       ($ValPK_User);
            $ObjTuple->SetLogin         ($ValLogin);
            $ObjTuple->SetStatus        ($ValStatus);
            $ObjTuple->SetCivilite      ($ValCivilite);
            $ObjTuple->SetNom           (ProtectApos ($ValNom));
            $ObjTuple->SetPrenom        (ProtectApos ($ValPrenom));
            $ObjTuple->SetMail          ($ValMail);
            $ObjTuple->SetTel           ($ValTel);
            $ObjTuple->SetFax           ($ValFax);
            $ObjTuple->SetFK_Entreprise ($ValFK_Entreprise);
            
            if ($IdentPK == 0)
			{
                $NewPassWord = RandomPassWord();
                $ObjTuple->SetPassWord (md5 ($NewPassWord));
                $ObjTuple->Insert();
				
				// Enregistrement du mail à envoyer
				
				Query ("INSERT INTO $NomTabMailsToSend VALUES (
			    	  	   '$ValLogin',
				 	       '$NewPassWord',
				 	       '$ValCivilite',
				 	       '$ValNom',
				 	       '$ValPrenom',
                  	       '$ValMail');",
			            $Connexion);
			}
            else
            {
			    $ObjTuple->SetPassWord ($ValPassWord);
                $ObjTuple->Update();
			}
            if (GetDroits ($Status, 'ListeUsers'))
			{
                                                                           ?>
<script>location.replace("?Trait=List&SlxTable=<?=$NomTabUsers?>");</script>
                                                                           <?php
			}
			else
			{
                                                                           ?>
<script>location.replace("?Trait=Affich&SlxTable=<?=$NomTabUsers?>");</script>
                                                                           <?php
			}
        }
        break;
    }
                                        if ($IdentPK)
									    {
										                                   ?>
<span class="card-title"><h4 class="center">Modification de l'utilisateur <?=$ValPK_User?></h4></span>
                                                                           <?php
                                        }
                                        else
                                        {
                                                                           ?>

<span class="card-title"><h4 class="center">Création d'un nouvel utilisateur :</h4></span>
                                                                           <?php
                                        }
										                                   ?>
<p style="text-align : center; font-size : 11px; font-style : italic;">
Toutes les rubriques en <b>gras</b> doivent obligatoirement être remplies
</p>

										                                   <?php
                                        if ($CodErrVide || $CodErrInval)
                                        {
										                                   ?>
<p style="text-align : center; font-size : 16px;">
Les <?=FLECHE?>indiquent qu'une rubrique est vide ou erronée
</p>
										                                   <?php
                                        }
										                                   ?>
<?php /*
<form method="post" action="<?=$PATH_GENERAL?>Generalites.php" target="principal"> 
*/ ?>

                    <div class="row">
                        <form method="post" role="form" class="col s12">
                            <div class="row">
                                <div class="input-field col l1 m1 s">
                                    <label for="Nom"><b>Civilité</b></label>
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
                                    <?=$ValidNom?>
                                    <input id="Nom" type="text" class="validate" name="Nom" size="50" value="<?=$ValNom?>">
                                    <label for="Nom"><b>Nom</b></label>
                                </div>
                                <div class="input-field col l6 m6 s12">
                                    <?=$ValidPrenom?>
                                    <input id="Prenom" type="text" class="validate" name="Prenom" size="50" value="<?=$ValPrenom?>">
                                    <label for="Prenom"><b>Prénom</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col l6 m6 s12">
                                    <?=$ValidTel?>
                                    <input id="Tel" type="text" class="validate" name="Tel" size="50" value="<?=$ValTel?>">
                                    <label for="Tel"><b>Tel</b></label>
                                </div>
                                <div class="input-field col l6 m6 s12">
                                    <?=$ValidMail?>
                                    <input id="Mail" type="text" class="validate" name="Mail" size="50" value="<?=$ValMail?>">
                                    <label for="Mail"><b>Mail</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col l6 m6 s12">
                                    <input id="Fax" type="text" class="validate" name="Fax" size="50" value="<?=$ValFax?>">
                                    <label for="Fax">Fax</label>
                                </div>
                               <?php
                                if ($IdentPK == 0)
                                {
                                ?>
                                <div class="input-field col l6 m6 s12">
                                    <?=$ValidLogin?>
                                    <input id="Login" type="text" class="validate" name="Login" size="50" value="<?=$ValLogin?>">
                                    <label for="Login"><b>Nouveau login</b></label>
                                </div>
                            </div>
                            <?php
                            }
                            else
                            {
                                ?>
                                <input type="hidden" name="Login" value="<?=$ValLogin?>">
                                <?php
                            }
                            if ($StepConsult == 'InitNew' ||
                            GetDroits ($Status, 'ModifUser'))
                            {
                            ?>
                            <div class="row">
                                <div class="input-field col l6 m6 s12">
                                    <?=$ValidStatus?>
                                    <select name="StatusUser">
                                        <?php
                                        while ($ObjStatus = mysql_fetch_object ($ReqStatus))
                                        {
                                            ?>
                                            <option value="<?=$ObjStatus->Code?>"
                                                <?=$ObjStatus->Code == $ValStatus ? 'selected' : ''?>>
                                                <?=$ObjStatus->Libelle?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label><b>Statut</b></label>
                                </div>
                                <div class="input-field col l6 m6 s12">
                                    <?=$ValidFK_Entreprise?>
                                    <select name="FK_Entreprise">
                                        <option value="0"
                                            <?=$ValFK_Entreprise == 0 ? 'selected' : ''?>
                                        >----------------
                                        </option>
                                        <?php
                                        while ($ObjSoc = mysql_fetch_object ($ReqEntreprises))
                                        {
                                            ?>
                                            <option value="<?=$ObjSoc->PK_Entreprise?>"
                                                <?=$ObjSoc->PK_Entreprise == $ValFK_Entreprise ? 'selected' : ''?>>
                                                <?=$ObjSoc->NomE?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Pour un tuteur, préciser l'<b>entreprise</b></label>
                                </div>
                                <?php
                                }
                                else
                                {
                                    ?>

                                    <input type="hidden" name="StatusUser"    value="<?=$ValStatus?>">
                                    <input type="hidden" name="FK_Entreprise" value="<?=$ValFK_Entreprise?>">
                                    <?php
                                }
                                if (count ($CodErrInval))
                                {
                                ?>
                                <hr>
                                <p class="center"><?php
                                for ($i = 0; $i < count ($CodErrInval); ++$i)
                                {
                                ?>
                                <?=$MsgErr [$CodErrInval [$i]]?><br />
                                <hr><br>
                                    <?php
                                }
                                }
                                ?></p>
                            </div>

                            <p class="center">
                                <button type="reset" class="waves-effect waves-light btn black white-text"  onClick="history.go (-1)">Abandonner</button>
                                <button type="reset" class="waves-effect waves-light btn black white-text">Reinitialiser</button>
                                <button type="submit" class="waves-effect waves-light btn blue white-text">Valider</button></p>

    <input type="hidden" name="StepConsult" value="Valid" >
    <input type="hidden" name="PK_User" value="<?=$ValPK_User?>" >
    <input type="hidden" name="PassWord" value="<?=$ValPassWord?>" >
    </form>
                    </div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="<?=$PATH_JS?>materialize.js"></script>
<script src="<?=$PATH_JS?>init.js"></script>
    <?php
}
else
{
?>
<h2 style="text-align : center">Vous ne pouvez accéder directement à cette page</h2>
<?php
}
?>
