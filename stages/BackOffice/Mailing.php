<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
    $NomBaseMathieu  = "laporte"; 
    $NomBaseStages   = "stages"; 
    $UserMathieu     = "root";
    $PasswdMathieu   = "";
    $HoteMathieu     = "localhost";
    $Sender          = "From: marc.laporte@univ-amu.fr";
	
	$ConnectMathieu = ConnectSelect ($HoteMathieu, $UserMathieu, 
	                                 $PasswdMathieu, $NomBaseMathieu);

	$URL_List    = $PATH_BACKOFFICE.'BackOffice.php?Trait=List&SlxTable=';
    $WidthButton = 130;
	if (! isset ($SsStep)) $SsStep = 'Init';
    switch ($SsStep)
    {
	  /*=========*/
      case 'Init' :
	  /*=========*/
        $TitreTraitement = "Mailings";
    	break;
    
	  /*========================*/
      case 'LstTuteursWithMails' :
	  /*=========================*/
        $TitreTraitement = "Liste des tuteurs d'entreprise ayant un mail";

		$ReqMails = Query ("SELECT $NomTabUsers.*, $NomTabEntreprises.NomE
		                        FROM $NomTabEntreprises, $NomTabUsers 
	                            WHERE    Status = 'tuteur'
								   AND   Mail <> '' 
								   AND   Mail <> '$MailBidon'
								   AND   $NomTabUsers.FK_Entreprise = $NomTabEntreprises.PK_Entreprise
								   ORDER BY $NomTabEntreprises.NomE, 
								            $NomTabUsers.Nom,
											$NomTabUsers.Prenom",
	                        $Connexion);
     	break;
    
	  /*======================*/
      case 'LstSocsWithMails' :
	  /*======================*/
        $TitreTraitement = "Liste des entreprises sans tuteur ou avec tuteur".
    	                   " sans mail, mais responsable ayant un mail";

		$ReqMails = Query ("SELECT * FROM $NomTabEntreprises
	                            WHERE  MailR <> '' AND MailR <> '$MailBidon'
								ORDER BY  NomE",
	                        $Connexion);
    	break;
    
	  /*===================*/
      case 'LstEtudiants1A' :
	  /*===================*/
        $TitreTraitement = "Liste des étudiants de 1<sup>ère</sup> année";

        define ('STATUS_ETUD1', 5);
		$ReqMails = Query ("SELECT * FROM $NomTabUsers
			  	               WHERE FK_Statut = ".STATUS_ETUD1."
						       ORDER BY Nom",
	                        $ConnectMathieu);
    	break;
    
	  /*===================*/
      case 'LstEtudiants2A' :
	  /*===================*/
        $TitreTraitement = "Liste des étudiants de 2<sup>ème</sup> année et de LP";
		if ($Sel2A == 'AvecStage') $TitreTraitement .= " avec stage";
		if ($Sel2A == 'SansStage') $TitreTraitement .= " sans stage"; 

		if ($Sel2A == 'AvecStage')
		    $ReqWhere = " AND FK_Stage <> ''"; 
		else if ($Sel2A == 'SansStage')
		    $ReqWhere = " AND FK_Stage =  ''"; 
		else 
		    $ReqWhere = ''; 
		 
        define ('STATUS_ETUD2', 6);
        define ('STATUS_ETUDLP', 10);
		$ReqMails = Query ("SELECT * FROM $NomTabUsers
			  	               WHERE (FK_Statut = ".STATUS_ETUD2." OR FK_Statut =".STATUS_ETUDLP.")".$ReqWhere."
						       ORDER BY Nom",
	                        $ConnectMathieu);
    	break;
    
	  /*===================*/
      case 'LstEnseignants' :
	  /*===================*/
        $TitreTraitement = "Liste des enseignants";

        define ('STATUS_PROF', 2);
		$ReqMails = Query ("SELECT * FROM $NomTabUsers
			  	               WHERE FK_Statut = ".STATUS_PROF."
						       ORDER BY Nom",
	                        $ConnectMathieu);
    	break;

	  /*=======================*/
      case 'LstAllWithoutMails' :
	  /*=======================*/
        $TitreTraitement = "Liste des entreprises sans aucun contact par mail";

		$ReqMails = Query ("SELECT DISTINCT $NomTabEntreprises.*, tabstages0506.FK_Entreprise FROM $NomTabEntreprises, tabstages0506
	                            WHERE (MailR = '' OR MailR = '$MailBidon')
								    AND $NomTabEntreprises.PK_Entreprise = tabstages0506.FK_Entreprise
								ORDER BY  NomE",
	                        $Connexion);
    	break;
    
	  /*===============*/
      case 'SendMails' :
	  /*===============*/
        $TitreTraitement = "Mail envoyé";
/*    */
// ===================================================================
// ============ Fonctionnement normal ================================
// ===================================================================
/*    */
        if ($Status != ADMIN)
		    mail  ($MailResponsableStages, $SujetDuMail, stripslashes ($TexteDuMail), $Sender);
		for ($i = count ($tabmail); $i--; )
		    mail  ($tabmail [$i], $SujetDuMail, stripslashes ($TexteDuMail), $Sender);
		mail  ($MailAdministrateur, $SujetDuMail, stripslashes ($TexteDuMail), $Sender);
/*    */
// ===================================================================
// ============ Remise à jour de tous les mots de passe ==============
// ===================================================================
/*   * /
require_once ($PATH_UTIL.'UtilLogin.php');
$SujetDuMail = 'Nouveau mot de passe';

for ($i = count ($tabmail); $i--; )
{
    $NewPwd = RandomPassWord();
    $TexteDuMail =
"\t\tMadame, Monsieur\n\n

\tJe vous prie de trouver dans ce mail un nouveau mot de passe que je vous demande d'utiliser pour toute connexion au site\n\n infodoc.iut.univ-aix.fr/stages\n
Nouveau mot de passe : $NewPwd\n
\tJe demande à celles et ceux qui ont déjà un mot de passe et qui ne l'ont pas oublié de ne pas m'en vouloir et d'en changer pour celui qui vous est aujourd'hui attribué.\n
Vous pourrez bien sûr le modifier à votre convenance dès votre prochaine connexion.\n
\tCordialement\n\n
\t\t\t\t\t<?=$NomResponsableStages?>,
\t\t\tresponsable des stages au département informatique de l'IUT d'aix en Provence";

	$MailI = $tabmail [$i];
    mail  ($MailI, $SujetDuMail, stripslashes ($TexteDuMail), $Sender);
    $NewPwd = md5 ($NewPwd);
    Query ("UPDATE $NomTabUsers SET PassWord = '$NewPwd'
		    WHERE   Mail = '$MailI'", $Connexion);
}
/*   */
// ===================================================================
// ===================================================================
// ===================================================================

    	break;

      default :
    }
										if (! isset ($SsStep)) $SsStep = 'Init';

                                                                           ?>
<h1><?=$TitreTraitement?></h1>
                                                                           <?php
										if ($SsStep == 'Init')
										{
                                                                           ?>
<table cellpadding="3">
                                                                           <?php
                                            if (GetDroits ($Status, 'ListeNewInscripts'))
			                                {
                                                                           ?>
    <tr>
	    <td>
            <a href="<?=$URL_List.$NomTabMailsToSend?>" target="principal">
                Liste des mails à envoyer aux nouveaux inscrits
			</a>
        </td>
	</tr>
                                                                           <?php
                                            }
                                                                           ?>
                                                                           <?php
                                            if (GetDroits ($Status, 'Mailing'))
			                                {
                                                                           ?>
    <tr><td style="text-align : left"><hr width="50%")</td></tr>
    <tr>
        <td><a href="?Trait=Mailing&SsStep=LstTuteursWithMails">
            Liste des tuteurs d'entreprise ayant un mail</a>
        </td>
    </tr>
    <tr>
        <td><a href="?Trait=Mailing&SsStep=LstSocsWithMails">
            Liste des entreprises sans tuteur ou avec tuteur sans mail, mais responsable ayant un mail</a>
        </td>
    </tr>
    <tr>
        <td><a href="?Trait=Mailing&SsStep=LstAllWithoutMails">
            Liste des entreprises sans aucun contact par mail</a>
        </td>
    </tr>
    <tr><td style="text-align : left"><hr width="50%")</td></tr>
    <tr>
        <td><a href="?Trait=Mailing&SsStep=LstEnseignants">
            Liste des enseignants</a>
        </td>
    </tr>
    <tr>
        <td><a href="?Trait=Mailing&SsStep=LstEtudiants1A">
            Liste des étudiants de 1<sup>ère</sup> année</a>
        </td>
    </tr>
    <tr>
        <td>
            Liste des étudiants de 2<sup>ème</sup> année et de LP
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=Tous">tous</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=AvecStage">avec stage</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=SansStage">sans stage</a>
        </td>
    </tr>
                                                                           <?php
                                            }
                                                                           ?>
</table>
                                                                           <?php
                                        } // fin du cas 'Init'

										switch ($SsStep)
										{
										  case 'LstTuteursWithMails' :
										  case 'LstSocsWithMails' :
										  case 'LstEnseignants' :
										  case 'LstEtudiants1A' :
										  case 'LstEtudiants2A' :
										  case 'ListeEtud1A' :
										  case 'ListeEtud2A' :
                                                                           ?>
<form action="?Trait=Mailing&SsStep=SendMails" method="post">
<table cellpadding="3">
<tr>
    <td style="text-align : left">
	    <b>Sujet</b> : 
        <input type="text" name="SujetDuMail" value="" width="100">
                                                                           <?php
			                                 // if (1
                                                                           ?>
    </td>
</tr>
<tr>
    <td style="text-align : left">
	<b>Texte</b><br />
        <textarea name="TexteDuMail" rows="10" cols="80"><?=$ValTexteDuMail?></textarea>
    </td>
</tr>
<tr>
<td style="text-align : center"><br />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" style="width : <?=$WidthButton?> px; background-color : #ffd7d7" 
       value="Tout decocher" 
       onClick="this.value=check (this.form.elements['tabmail[]'])">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" style="width : <?=$WidthButton?> px;" 
       value="Envoyer">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" style="width : <?=$WidthButton?> px;" 
       value="Retour aux listes" 
       onClick="document.location='?Trait=Mailing&SsStep=Init'">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" style="width : <?=$WidthButton?> px;" 
       value="Abandonner" 
       onClick="document.location='?Trait='">
</td></tr>
</table>
                                                                           <?php
                                        } // fin de la préparation du mail

										switch ($SsStep)
										{
										  case 'LstTuteursWithMails' :
                                                                           ?>
<table cellpadding="3">
    <tr>
	    <th colspan="2" style="text-align : left">&nbsp;</th>
	    <th style="text-align : left">Nom</th>
	    <th style="text-align : left">Entreprise</th>
	    <th style="text-align : left">mail</th>
	</tr>
                                                                           <?php
										    $Cpt = 0;
										    while ($ObjMails = mysql_fetch_object ($ReqMails))
										    {
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <input type="checkbox" name="tabmail[]" checked="checked" value="<?=$ObjMails->Mail?>">
		</td>
	    <td valign="top">
		    <?=$ObjMails->Nom?> <?=$ObjMails->Prenom?> 
		</td>
	    <td valign="top">
		    <?=$ObjMails->NomE?>
		</td>
	    <td valign="top">
		    <?=$ObjMails->Mail?>
		</td>
    </tr>
                                                                           <?php
										    }
                                                                           ?>
</table>
                                                                           <?php
										    break;

										  case 'LstSocsWithMails' :
                                                                           ?>
<table cellpadding="3">
    <tr>
	    <th colspan="2" style="text-align : left">&nbsp;</th>
	    <th style="text-align : left">Nom</th>
	    <th style="text-align : left">Entreprise</th>
	    <th style="text-align : left">mail</th>
	</tr>
                                                                           <?php
										    $Cpt = 0;
										    while ($ObjMails = mysql_fetch_object ($ReqMails))
										    {
		                                        $ReqMailsUser = Query ("SELECT * 
												                            FROM $NomTabUsers 
	                                                                        WHERE  Status = 'tuteur'
								                                               AND Mail <> '' 
								                                               AND Mail <> '$MailBidon'
								                                               AND FK_Entreprise = '$ObjMails->PK_Entreprise'",
	                                                                    $Connexion);
                                                 if (mysql_num_rows ($ReqMailsUser) > 0) continue;
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <input type="checkbox" name="tabmail[]" checked="checked" value="<?=$ObjMails->MailR?>">
		</td>
	    <td valign="top">
		    <?=$ObjMails->NomR?> <?=$ObjMails->PrenomR?> 
		</td>
	    <td valign="top">
		    <?=$ObjMails->NomE?>
		</td>
	    <td valign="top">
		    <?=$ObjMails->MailR?>
		</td>
    </tr>
                                                                           <?php

											  }
										    break;

										  case 'LstEnseignants' :
										  case 'LstEtudiants1A' :
										  case 'LstEtudiants2A' :
										  case 'ListeEtud1A'    :
										  case 'ListeEtud2A'    :
                                                                           ?>
<table cellpadding="3">
    <tr>
	    <th colspan="2" style="text-align : left">&nbsp;</th>
	    <th style="text-align : left">Nom - Prénom</th>
	    <th style="text-align : left">mail</th>
	</tr>
                                                                           <?php
										    $Cpt = 0;
										    while ($ObjMails = mysql_fetch_object ($ReqMails))
										    {
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <input type="checkbox" name="tabmail[]" checked="checked" value="<?=$ObjMails->EMail?>">
		</td>
	    <td valign="top">
		    <?=$ObjMails->Nom?> <?=$ObjMails->Prenom?> 
		</td>
	    <td valign="top">
		    <?=$ObjMails->EMail?>
		</td>
    </tr>
                                                                           <?php
										    }
                                                                           ?>
</table>
</form>
                                                                           <?php
										    break;

										  case 'LstAllWithoutMails' :
                                                                           ?>
<table cellpadding="3">
                                                                           <?php
										    $Cpt = 0;
										    while ($ObjMails = mysql_fetch_object ($ReqMails))
										    {
		                                        $ReqMailsUser = Query ("SELECT * 
												                            FROM $NomTabUsers 
	                                                                        WHERE  Status = 'tuteur'
								                                               AND Mail <> '' 
								                                               AND Mail <> '$MailBidon'
								                                               AND FK_Entreprise = '$ObjMails->PK_Entreprise'",
	                                                                    $Connexion);
                                                 if (mysql_num_rows ($ReqMailsUser) > 0) continue;
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <?=$ObjMails->NomR?> <?=$ObjMails->PrenomR?> 
		</td>
	    <td valign="top">
		    <?=$ObjMails->NomE?>
		</td>
    </tr>
                                                                           <?php
										    }
                                                                           ?>
</table>
<p>
<br />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="Retour aux listes" 
       onClick="document.location='?Trait=Mailing&SsStep=Init'">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="Abandonner" 
       onClick="document.location=''">
</p>
                                                                           <?php

										    break;
										
										  case 'SendMails' :
/*
à <?=$MailResponsableStages?> et en copie à:
<br />
<?=$Headers?>
*/
                                                                           ?>
<p>
<br />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="Retour aux listes" 
       onClick="document.location='?Trait=Mailing&SsStep=Init'">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="Abandonner" 
       onClick="document.location=''">
</p>
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

