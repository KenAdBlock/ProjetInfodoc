<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
//    $Sender          = "From: marc.laporte@univ-amu.fr";
    $Sender          = "From: darkweizer@infodoc.esy.es";

	$UtilBD = new UtilBD();
	$ConnectLaporte = $UtilBD->ConnectLaporte();

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

		$ReqMails = $ConnectStages->query("SELECT $NomTabUsers.*, $NomTabEntreprises.NomE
											FROM $NomTabEntreprises, $NomTabUsers 
											WHERE    Status = 'tuteur'
											   AND   Mail <> '' 
											   AND   Mail <> '$MailBidon'
											   AND   $NomTabUsers.FK_Entreprise = $NomTabEntreprises.PK_Entreprise
											   ORDER BY $NomTabEntreprises.NomE, 
														$NomTabUsers.Nom,
														$NomTabUsers.Prenom");
     	break;
    
	  /*======================*/
      case 'LstSocsWithMails' :
	  /*======================*/
        $TitreTraitement = "Liste des entreprises sans tuteur ou avec tuteur".
    	                   " sans mail, mais responsable ayant un mail";

		$ReqMails = $ConnectStages->query("SELECT * FROM $NomTabEntreprises
										   WHERE  MailR <> '' AND MailR <> '$MailBidon'
										   ORDER BY  NomE");
    	break;
    
	  /*===================*/
      case 'LstEtudiants1A' :
	  /*===================*/
        $TitreTraitement = "Liste des étudiants de 1<sup>ère</sup> année";

        define ('STATUS_ETUD1', 5);
		$ReqMails = $ConnectLaporte->query("SELECT * FROM $NomTabUsers
			  	               				WHERE FK_Statut = ".STATUS_ETUD1."
						       				ORDER BY Nom");
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
		$ReqMails = $ConnectLaporte->query("SELECT * FROM $NomTabUsers
			  	               WHERE (FK_Statut = ".STATUS_ETUD2." OR FK_Statut =".STATUS_ETUDLP.")".$ReqWhere."
						       ORDER BY Nom");
    	break;
    
	  /*===================*/
      case 'LstEnseignants' :
	  /*===================*/
        $TitreTraitement = "Liste des enseignants";

        define ('STATUS_PROF', 2);
		$ReqMails = $ConnectLaporte->query("SELECT * FROM $NomTabUsers
			  	               WHERE FK_Statut = ".STATUS_PROF."
						       ORDER BY Nom");
    	break;

	  /*=======================*/
      case 'LstAllWithoutMails' :
	  /*=======================*/
        $TitreTraitement = "Liste des entreprises sans aucun contact par mail";

		$ReqMails = $ConnectStages->query("SELECT DISTINCT $NomTabEntreprises.*, tabstages0506.FK_Entreprise FROM $NomTabEntreprises, tabstages0506
	                            WHERE (MailR = '' OR MailR = '$MailBidon')
								    AND $NomTabEntreprises.PK_Entreprise = tabstages0506.FK_Entreprise
								ORDER BY  NomE");
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
	$ConnectStages->query("UPDATE $NomTabUsers SET PassWord = '$NewPwd'
		    WHERE   Mail = '$MailI'");
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
<h4 class="center"><?=$TitreTraitement?></h4>
                                                                           <?php
										if ($SsStep == 'Init')
										{
                                                                           ?>

                                                                           <?php
                                            if (GetDroits ($Status, 'ListeNewInscripts'))
			                                {
                                                                           ?>

            <ul><li><span><a class="hover-bleu" href="<?=$URL_List.$NomTabMailsToSend?>">
                Liste des mails à envoyer aux nouveaux inscrits
			</a></span></li></ul>
        
                                                                           <?php
                                            }
                                                                           ?>
                                                                           <?php
                                            if (GetDroits ($Status, 'Mailing'))
			                                {
                                                                           ?>
    <hr width="100%">
    	<ul><li><span><a class="hover-bleu" href="?Trait=Mailing&SsStep=LstTuteursWithMails">
            Liste des tuteurs d'entreprise ayant un mail</a></span></li>
        <li><span><a class="hover-bleu" href="?Trait=Mailing&SsStep=LstSocsWithMails">
            Liste des entreprises sans tuteur ou avec tuteur sans mail, mais responsable ayant un mail</a></span></li>
        <li><span><a class="hover-bleu" href="?Trait=Mailing&SsStep=LstAllWithoutMails">
            Liste des entreprises sans aucun contact par mail</a></span></li></ul>

        <hr width="100%">
    	<ul><li><span><a class="hover-bleu" href="?Trait=Mailing&SsStep=LstEnseignants">
            Liste des enseignants</a></span></li>
        
        <li><span><a class="hover-bleu" href="?Trait=Mailing&SsStep=LstEtudiants1A">
            Liste des étudiants de 1<sup>ère</sup> année</a></span></li></ul>
        <div class="row">
        <div class="col s12 m6 l6">
            <ul><li><span><b>Liste des étudiants de 2<sup>ème</sup> année et de LP</b></span></li></ul>
            	</div>
            	<div class="col s12 m2 l5 center">
			<ul><li><a class="hover-bleu left" href="?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=Tous">tous</a>
			
			<a class="hover-bleu center" href="?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=AvecStage">avec stage</a>
			
			<a class="hover-bleu right" href="?Trait=Mailing&SsStep=LstEtudiants2A&Sel2A=SansStage">sans stage</a></li></ul>
			</div></div>
        
                                                                           <?php
                                            }
                                                                           ?>

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
<div class="row">
	     <div class="input-field col s12">
        <input id="sujet" type="text" name="SujetDuMail" value="" width="100">
        <label for="sujet"><b>Sujet</b></label></div>
                                                                           <?php
			                                 // if (1
                                                                           ?>
    
    	<div class="input-field col s12">
    		<div class="bleu1-text"><b>Texte</b></div><br>
          <textarea id="TexteDuMail" class="materialize-textarea" name="TexteDuMail" rows="10" cols="80"><?=$ValTexteDuMail?></textarea>
          
        </div>

</div>
	<div class="row">
	<div class="col s12 m6 l3"><p class="center">
<button class="min-btn waves-effect waves-light bleu1 white-text" type="button" onClick="this.value=check (this.form.elements['tabmail[]']); if(this.innerText == 'Tout décocher') {this.innerText = 'Tout cocher';} else {this.innerText = 'Tout décocher';} ">Tout décocher</button>
</p><br></div>

<div class="col s12 m6 l3"><p class="center">
<button class="min-btn waves-effect waves-light bleu1 white-text" type="submit">Envoyer</button>
</p><br></div>

       <div class="col s12 m6 l3"><p class="center">
<button class="min-btn waves-effect waves-light black white-text" type="button" onClick="document.location='?Trait=Mailing&SsStep=Init'">Retour aux listes</button>
</p><br></div>

       <div class="col s12 m6 l3"><p class="center">
<button class="min-btn waves-effect waves-light black white-text" type="button" onClick="document.location='?Trait='">Abandonner</button>
</p><br></div>

</div>

                                                                           <?php
                                        } // fin de la préparation du mail

										switch ($SsStep)
										{
										  case 'LstTuteursWithMails' :
                                                                           ?>
<div class="row"><div class="col s12">
<table class="table-list highlight bordered centered grey lighten-4 small-text">
 <thead class="grey white-text">
    <tr>
	    <th colspan="2" style="text-align : left">&nbsp;</th>
	    <th style="text-align : center">Nom</th>
	    <th style="text-align : center">Entreprise</th>
	    <th style="text-align : center">Mail</th>
	</tr>
   </thead>
   <tbody>                                                               <?php
										    $Cpt = 0;
										    while ($ObjMails = $ReqMails->fetch())
										    {
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <input class="filled-in" id="<?=$ObjMails['Nom']?>" type="checkbox" name="tabmail[]" checked="checked" value="<?=$ObjMails['Mail']?>">
			<label for="<?=$ObjMails['Nom']?>"></label>
		</td>
	    <td valign="top">
		    <?=$ObjMails['Nom']?> <?=$ObjMails['Prenom']?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['NomE']?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['Mail']?>
		</td>
    </tr>
                                                                           <?php
										    }
                                                                           ?>
</tbody></table></div></div>
                                                                           <?php
										    break;

										  case 'LstSocsWithMails' :
                                                                           ?>
<table class="table-list highlight bordered centered grey lighten-4 small-text">
 <thead class="grey white-text">
    <tr>
	    <th colspan="2" style="text-align : center">&nbsp;</th>
	    <th style="text-align : center">Nom</th>
	    <th style="text-align : center">Entreprise</th>
	    <th style="text-align : center">Mail</th>
	</tr>
  </thead>                                                                         <?php
										    $Cpt = 0;
										    while ($ObjMails = $ReqMails->fetch())
										    {
												$ReqMailsUser = $ConnectStages->prepare("SELECT * 
																						 FROM $NomTabUsers 
																						 WHERE  Status = 'tuteur'
																						    AND Mail <> '' 
																						    AND Mail <> '$MailBidon'
																						    AND FK_Entreprise = :PK_Entreprise");
												$ReqMailsUser->bindValue(':PK_Entreprise', $ObjMails['PK_Entreprise']);
												$ReqMailsUser->execute();
                                                 if ($ReqMailsUser->rowCount() > 0) continue;
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <input class="filled-in" id="<?=$ObjMails['NomR']?>" type="checkbox" name="tabmail[]" checked="checked" value="<?=$ObjMails['MailR']?>">
			<label for="<?=$ObjMails['NomR']?>"></label>
		</td>
	    <td valign="top">
		    <?=$ObjMails['NomR']?> <?=$ObjMails['PrenomR']?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['NomE']?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['MailR']?>
		</td>
    </tr>
                                                           <?php

											  } ?>
</table>
											  <?php 

										    break;

										  case 'LstEnseignants' :
										  case 'LstEtudiants1A' :
										  case 'LstEtudiants2A' :
										  case 'ListeEtud1A'    :
										  case 'ListeEtud2A'    :
                                                                           ?>
<table class="table-list highlight bordered centered grey lighten-4 small-text">
 <thead class="grey white-text">
    <tr>
	    <th colspan="2" style="text-align : center">&nbsp;</th>
	    <th style="text-align : center">Nom - Prénom</th>
	    <th style="text-align : center">Mail</th>
	</tr>
 </thead>                                                                          <?php
										    $Cpt = 0;
										    while ($ObjMails = $ReqMails->fetch())
										    {
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <input class="filled-in" id="<?=$ObjMails['Nom']?>" type="checkbox" name="tabmail[]" checked="checked" value="<?=$ObjMails['EMail']?>">
			<label for="<?=$ObjMails['Nom']?>"></label>
		</td>
	    <td valign="top">
		    <?=$ObjMails['Nom']?> <?=$ObjMails['Prenom']?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['EMail']?>
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
<table class="table-list highlight bordered centered grey lighten-4 small-text">
 
                                                                           <?php
										    $Cpt = 0;
										    while ($ObjMails = $ReqMails->fetch())
										    {
												$ReqMailsUser = $ConnectStages->prepare("SELECT * 
												                            FROM $NomTabUsers 
	                                                                        WHERE  Status = 'tuteur'
								                                               AND Mail <> '' 
								                                               AND Mail <> '$MailBidon'
								                                               AND FK_Entreprise = :PK_Entreprise");
												$ReqMailsUser->bindValue(':PK_Entreprise', $ObjMails['PK_Entreprise']);
												$ReqMailsUser->execute();
                                                 if ($ReqMailsUser->rowCount() > 0) continue;
                                                                           ?>
    <tr>
	    <td valign="top">
		    <?=++$Cpt?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['NomR']?> <?=$ObjMails['PrenomR']?>
		</td>
	    <td valign="top">
		    <?=$ObjMails['NomE']?>
		</td>
    </tr>
                                                                           <?php
										    }
                                                                           ?>
</table>
<br>
<p class="center">

<button type="button" class="waves-effect waves-light btn black white-text"
       onClick="document.location='?Trait=Mailing&SsStep=Init'">Retour aux listes</button>
<button type="button" class="waves-effect waves-light btn black white-text" 
       onClick="document.location=''">Abandonner</button>
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
<br>
<p class="center">

<button type="button" class="waves-effect waves-light btn black white-text"
       onClick="document.location='?Trait=Mailing&SsStep=Init'">Retour aux listes</button>
<button type="button" class="waves-effect waves-light btn black white-text" 
       onClick="document.location=''">Abandonner</button>
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

