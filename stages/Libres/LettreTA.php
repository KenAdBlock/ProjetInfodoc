<?php
	$PATH_RACINE      = '../';
	$PATH_CONSTANTES  = $PATH_RACINE.'Constantes/';

	require_once ($PATH_CONSTANTES.'DEFINE.php');
	require_once ($PATH_CONSTANTES.'CstGales.php');
    require_once ($PATH_CONSTANTES.'CstErr.php');
    require_once ($PATH_CONSTANTES.'CstErrBD.php');
	
	// Connexion a mySQL
	// =================
	
    require_once ($PATH_RACINE.     'Communs/IdentRoot.php');
	require_once ($PATH_CONSTANTES. 'CstErrBD.php');
    require_once ($PATH_UTIL.       'UtilBD.php');  // ConnectSelect(), Query()

	$Connexion = ConnectSelect ($Hote, $User, $Passwd, $NomBase);

	// R&eacute;cup&eacute;rations des variables envoy&eacute;es par POST ou GET
	// ====================================================
	
    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;

?>
   <style type="text/css">
    <!--
H1 {
   font-family: Helvetica, Arial;
	font-size: 20px;
	color: #003984;
	text-align: left;
}
H2 {
   font-family: Helvetica, Arial;
	font-size: 16px;
	color: #003984;
	text-align: left;
}
body {
    font-family: Helvetica, Arial;
     font-size: 13px;
	 color: #323769;
}
p {
    font-family: Helvetica, Arial;
     font-size: 14px;
} 
td {
    font-family: Helvetica, Arial;
     font-size: 14px;
} 
b {
	color: #a03232;
}

    -->
    </style>
	
<script language="JavaScript">
<!-- Begin
 function putFocus(formInst, elementInst) {
  if (document.forms.length > 0) {
   document.forms[formInst].elements[elementInst].focus();
  }
 }
// The second number in the "onLoad" command in the body
// tag determines the form's focus. Counting starts with '0'
//  End -->
</script>

<body  onLoad="putFocus(0, 0);">
<img border="0" src="<?=$PATH_GIFS?>Logo_IUT.jpg" align="middle" 
              alt="IUT Aix en Provence">
<h1 style="text-align : center">Formulaire de versement de la Taxe d'apprentissage
<br />
sur les salaires 2010</h1>
                                                                          <?php
                             if (isset ($StepValid))
                             {
/* ==========================  Remerciements    ==========================*/
                                                                          ?>
<p>
Vous avez fait le choix de soutenir notre formation, en nous versant la taxe d'apprentissage.

Ce formulaire nous permettra d'en effectuer le suivi.

<br /><br />
Nous vous remercions de l'int&eacute;r&ecirc;t que vous avez port&eacute; &agrave; notre d&eacute;marche.

<br /><br />
Nous vous aviserons du versement d&egrave;s sa transmission par l'organisme collecteur.

<br /><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Cordialement
</p>

<blockquote><blockquote><blockquote><blockquote>
<p style="text-align : center">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Patricia Gaitan
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Responsable du d&eacute;partement
</p>
</blockquote></blockquote></blockquote></blockquote>

<p style="text-align : center">
<input type="submit"  
       value="Fermer la fenetre" 
	   onClick="window.close()">
</p>
                                                                  <?php
/* ==========================  Enregistrement   ==========================*/

        Query ("INSERT INTO $NomTabTaxe VALUES (
                      '',
                      '".addslashes ($RaisonSocialeSoc)."',
                      '".addslashes ($AdresseSoc)."',
                      '$CodePostalSoc',
                      '".addslashes ($VilleSoc)."',
                      '$Contact',
                      '$Tel',
                      '$Mail',
                      '$CatA',
                      '$CatAPlusB',
                      '$CatBPlusC',
                      '".addslashes ($NomCollecteur)."',
                      '".addslashes ($AdresseCollect)."',
                      '$CodePostalCollect',
                      '".addslashes ($VilleCollect)."');",
                     $Connexion);

/* ==========================  mail d'information  ======================*/

$SujetDuMail = 'Taxe d\'apprentissage';
$TexteDuMail = "La soci&eacute;t&eacute; \n\n".$RaisonSocialeSoc.
               "\n\nversera \n".
			   "\nCat&eacute;gorie A : " .$CatA.
			   "\nCat&eacute;gorie A + B : ".$CatAPlusB.
			   "\nCat&eacute;gorie B + C : ".$CatBPlusC.
               "\n\npar l'interm&eacute;diaire de l'organisme \n\n".$NomCollecteur;
$TexteDuMail = wordwrap ($TexteDuMail, 70);		
mail  ($MailAdministrateur, $SujetDuMail, stripslashes ($TexteDuMail));
mail  ($MailSecretariatTA,  $SujetDuMail, stripslashes ($TexteDuMail));
                             }
							 else
							 {
                                                                          ?>
<p style="background : #D4D8D4">
<big>Votre Entreprise</big>
</p>
<form method="post"> 
<table align="center" border="0"><tr><td>
<table cellpadding="2">
    <tr>
        <td style="text-align : right" valign="top">Raison Sociale :</td>
        <td>
            <input type="text" name="RaisonSocialeSoc" size="66">
	    </td>
	</tr>
    <tr>
        <td style="text-align : right" valign="top">Adresse :</td>
        <td>
            <textarea name="AdresseSoc" rows="5" cols="50"></textarea>
	    </td>
	</tr>
	<tr>
        <td style="text-align : right" valign="top">Code postal :</td>
        <td>
	        <table>
			   <tr>
				 <td> 
                   <input type="text" name="CodePostalSoc" size="15">
	             </td>
	             <td style="text-align : right" valign="top">Ville :</td>
                 <td>
                   <input type="text" name="VilleSoc" size="40">
	             </td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
	    <td colspn="2">&nbsp;</td>
	</tr>
	<tr>
	    <td style="text-align : right" valign="top">Personne ou <br />service &agrave; contacter :</td>
        <td>
            <input type="text" name="Contact" size="66">
	    </td>
	</tr>
	<tr>
        <td style="text-align : right" valign="top">T&eacute;l. :</td>
        <td>
	        <table>
			   <tr>
				 <td> 
                   <input type="text" name="Tel" size="15">
	             </td>
	             <td style="text-align : right" valign="top">e-mel :</td>
                 <td>
                   <input type="text" name="Mail" size="38">
	             </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</td></tr></table>

<p>
Le d&eacute;partement Informatique de l'I.U.T. d'Aix-en-Provence est habilit&eacute; &agrave; percevoir <u><b>un versement Hors-quota ou bar&egrave;me au titre de la cat&eacute;gorie B</b></u>.

(Il est toutefois possible de cumuler des cat&eacute;gories voisines, par exemple A+B ou B+C.
</p>

<table align="center" border="0"><tr><td>
<table cellpadding="2">
    <tr>
        <td style="text-align : right" valign="top">Cat&eacute;gorie B - Montant : </td>
        <td>
            <input type="text" name="CatA" size="50"">
	    </td>
	</tr>
    <tr>
        <td style="text-align : right" valign="top">Par cumul, cat&eacute;gories A+B - Montant : </td>
        <td>
            <input type="text" name="CatAPlusB" size="50"">
	    </td>
	</tr>
    <tr>
        <td style="text-align : right" valign="top">Par cumul, cat&eacute;gories B+C - Montant : </td>
        <td>
            <input type="text" name="CatBPlusC" size="50"">
	    </td>
	</tr>
</table>
</td></tr></table>

<p>
Lors de votre versement aupr&egrave;s d'un organisme collecteur, veuillez bien pr&eacute;ciser l'&eacute;tablissement b&eacute;n&eacute;ficiaire :
</p>

<p  style="text-align : center">
<u><b>D&eacute;partement INFORMATIQUE de l'IUT d'Aix-en-Provence</b></u>
</p>

<p style="background : #D4D8D4">
<big>L'organisme collecteur</big>
</p>

<table align="center" border="0"><tr><td>
<table cellpadding="2">
    <tr>
        <td style="text-align : right" valign="top">Nom de l'organisme :</td>
        <td>
            <input type="text" name="NomCollecteur" size="66">
	    </td>
	</tr>
    <tr>
        <td style="text-align : right" valign="top">Adresse :</td>
        <td>
            <textarea name="AdresseCollect" rows="5" cols="50"></textarea>
	    </td>
	</tr>
	<tr>
        <td style="text-align : right" valign="top">Code postal :</td>
        <td>
	        <table>
			   <tr>
				 <td> 
                   <input type="text" name="CodePostalCollect" size="15">
	             </td>
	             <td style="text-align : right" valign="top">Ville :</td>
                 <td>
                   <input type="text" name="VilleCollect" size="40">
	             </td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
	    <td colspn="2">&nbsp;</td>
	</tr>
	<tr>
	    <td colspn="2">&nbsp;</td>
	</tr>
    <tr>
        <td colspan="2" style="text-align : center">
            <input type="reset" value="Reinitialiser">
            <input type="hidden" name="StepValid" value="1">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Valider" >
        </td>
    </tr>

</table>
<input type="hidden" name="StepValid">
</form>
<?php /*
<p  style="text-align : right">
<small>Institut Universaire de Technologie d'Aix-en-Provence
<br />
D&eacute;partement Informatique - Avenue Gaston Berger - 13625 Aix-en-Provence cedex 1
<br />
T&eacute;l&eacute;phone : 04 42 93 90 43 - T&eacute;l&eacute;copie : 04 42 93 90 74 - mel : informatique@iut.univmed.fr
</small>
</p>
*/?>
                                                                          <?php
                             }
                                                                          ?>
