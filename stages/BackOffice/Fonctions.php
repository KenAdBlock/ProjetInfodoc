<?php
function RecupFichEntreprises()
//       ====================
{
    global $ConnectStages, $PATH_STAGES;

    $Fic = fopen ($PATH_STAGES."stages.txt", "r");
	    $Buff = fgets ($Fic);
	while (!feof ($Fic))
	{
	    $Champs = array();
	    $Buff = fgets ($Fic);
		$Champs = explode ("\t", $Buff); 
		$Champs [1] = addslashes ($Champs [1]);
		$Champs [2] = addslashes ($Champs [2]);
		$Champs [3] = addslashes ($Champs [3]);
		$Champs [5] = addslashes ($Champs [5]);
		$Champs [6] = addslashes ($Champs [6]);
		$Champs [8] = addslashes ($Champs [8]);
        $ConnectStages->query("INSERT INTO oldtabentreprises VALUES (
		NULL,  '$Champs[0]', '$Champs[1]', '$Champs[2]', '$Champs[3]',
		'$Champs[4]', '$Champs[5]', '$Champs[6]', '$Champs[7]', '$Champs[8]', '$Champs[9]', 
		'$Champs[10]', '$Champs[11]', '$Champs[12]', '$Champs[13]' )");
	}
    fclose ($Fic);

} // RecupFichEntreprises()

function RecupOldEntreprises()
//       ===================
{
    global $ConnectStages;
/*     * /
    $ReqOldSocs = $ConnectStages->query("SELECT oldtabentreprises.*, oldtabstages.NomEtudiant, oldtabstages.Annee 
	                         FROM oldtabentreprises, oldtabstages 
						     WHERE oldtabentreprises.NomEntreprise = oldtabstages.NomEntreprise
							 AND   oldtabstages.Annee > 1999
							 ORDER BY oldtabstages.Annee DESC, oldtabentreprises.NomEntreprise");
/*    */
/*    */
//    $ReqOldSocs = $ConnectStages->query("SELECT DISTINCT oldtabentreprises.*
//	                         FROM oldtabentreprises, oldtabstages
//						     WHERE oldtabentreprises.NomEntreprise = oldtabstages.NomEntreprise
//							 AND   oldtabstages.Annee > 1999
//							 ORDER BY oldtabentreprises.NomEntreprise");

    $ReqOldSocs = $ConnectStages->query("SELECT DISTINCT oldtabentreprises.*
	                                       FROM oldtabentreprises, oldtabstages 
						                   WHERE oldtabentreprises.NomEntreprise = oldtabstages.NomEntreprise
							               AND   oldtabstages.Annee > 1999
							               ORDER BY oldtabentreprises.NomEntreprise");
/*    */
?>
<table>
<tr>
<th>Is_Valide</th>
<th>NomEntreprise</th>
<th>NomRespAdmin</th>
<th>NomEtudiant</th>
<th>Annee</th>
</tr>
<?php						 
	while ($ObjReq = $ReqOldSocs->fetch())
	{
        $ObjSoc = new CEntreprise ();
		
        $ObjSoc->SetPK_Entreprise (0);
		
        $ObjSoc->SetNomE          ($ObjReq['NomEntreprise']);
        $ObjSoc->SetNomR          ($ObjReq['NomRespAdmin']);
        $ObjSoc->SetPrenomR       ($ObjReq['PrenomRespAdmin']);
        $ObjSoc->SetAdr1          ($ObjReq['Adr1']);
        $ObjSoc->SetAdr2          ($ObjReq['Adr2']);
        $ObjSoc->SetCP            ($ObjReq['CP']);
        $ObjSoc->SetVille         ($ObjReq['Ville']);
        $ObjSoc->SetTelR          ($ObjReq['TelRespAdmin']);
        $ObjSoc->SetMailR         ($ObjReq['emailRespAdmin']);
		
        $ObjSoc->Insert();
?>
<tr>
    <td><?=$ObjReq['Is_Valide']?></td>
	<td><?=$ObjReq['NomEntreprise']?></td>
    <td><?=$ObjReq['NomRespAdmin']?></td>
    <td><?=$ObjReq['NomEtudiant']?></td>
    <td><?=$ObjReq['Annee']?></td>
</tr>
<?php
    }
?>
</table>

<?php

} // RecupOldEntreprises()

    $CleOK = '069b9247591948b71d303ac66371bf0b';

    $PATH_RACINE     = '../';
    $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

    require_once ($PATH_CONSTANTES.'DEFINE.php');
    require_once ($PATH_CONSTANTES.'CstGales.php');

    // Ouverture de la session
	// =======================
	
    require_once ($PATH_UTIL.'UtilSession.php');
    OpenSession  ($NomSession);

    // Vérification qu'il existe bien une session ouverte
	//   et qu'il existe bien un login dans la session ouverte
	
	OpenedSessionAndLoginNonVideIsOK ($JS_HistoryBack);

	// Récupérations des variables envoyées par POST ou GET

    function SupprSlash($tab) {
        foreach ($tab as $k => $v) {
            if(is_array($v)) {
                SupprSlash($v);
            } else {
                $$v = stripslashes($v);
            }
        }
    }

    if(isset($_GET)){
        SupprSlash($_GET);
    }


    if(isset($_POST)){
        SupprSlash($_POST);
    }

    if (isset ($_SESSION)){
	    foreach ($_SESSION as $clef => $valeur) $$clef = $valeur;
    }

    // Connexion a mySQL
	// =================

    require_once ($PATH_UTIL.'UtilBD.php');

    $UtilBD = new UtilBD();
    $ConnectStages = $UtilBD->ConnectStages();

	//
    include_once ($PATH_UTIL.'UtilBackOffice.php');

	require_once ($PATH_CONSTANTES.'CstErr.php');
    require_once ($PATH_CONSTANTES.'CstMsg.php');
	require_once ($PATH_UTIL.      'UtilErr.php');
	require_once ($PATH_UTIL.      'UtilForm.php');
	require_once ($PATH_GENERAL.   'GetDroits.php');
	
    require_once ($PATH_CLASS.     'CEntreprise.php');

// ========================

	//
    //Fonction sécurisant les strings dans les Formulaires
  
function SecureStr (&$_str)  
{
    $_str = stripslashes ($_str);
    $_str = str_replace  ("'", "''", $_str);
    $_str = strip_tags   ($_str);
}

function NormaliserNomPrenomLogin ($Ligne, 
                                   &$Nom, &$Prenoms, &$NumGroupe, &$LoginAuto)
{
    // Séparation du nom_prenom et du groupe
	
   $TabStr = explode ("\t", $Ligne);

   $NomPrenom = $TabStr [0];
   $NumGroupe = $TabStr [1];
      
   // Séparation du nom et des prénoms

   $TabStr = explode (" ", $NomPrenom);
   
   $Nom = $TabStr [0];
   
   // Remplacement des ''' par '_' dans le nom
   
   $NomCompacte = str_replace ("'", "_", $Nom);
   $Nom         = str_replace ("_", " ", $Nom);
	
   // Recomposition et mise en minuscules de tous les prénoms
 
   $Prenoms = $TabStr [1];
   for ($i = 2; $i < count ($TabStr); ++$i) $Prenoms .= ' '.$TabStr [$i];
   $Prenoms = strtolower ($Prenoms);
   
   // Compactage de tous les prénoms
   
   $PrenomsCompactes = str_replace ('-', '', $Prenoms);
   
   // Mise en majuscule de l'initiale de chaque prénom
  
   $Prenoms [0] = chr (ord ($Prenoms [0]) - 32);
   for ($i = 1; $i < strlen ($Prenoms); ++$i) 
       if ($Prenoms [$i - 1] == ' ' || $Prenoms [$i - 1] == '-' )
	       $Prenoms [$i] = chr (ord ($Prenoms [$i]) - 32);
 
   // Compactage de tous les prénoms
   
   $PrenomsCompactes = '';
   for ($i = 0; $i < strlen ($Prenoms); ++$i)
       if ($Prenoms [$i] != '-' && $Prenoms [$i] != ' ')
           $PrenomsCompactes .= $Prenoms[$i];

   // Construction du login
   
   $LoginAuto = strtolower (
                   substr ($NomCompacte, 0, 3).substr ($PrenomsCompactes, 0, 3));

} // NormaliserNomPrenomLogin

function NormaliserNomPrenomLogin1A2A ($Annee)
{
    global $ConnectLaporte;
    $handle = fopen ($Annee.'.txt', 'r');
    for (; $Ligne = fgets($handle); )
    {
        NormaliserNomPrenomLogin ($Ligne, $Nom, $Prenoms, $NumGroupe, $LoginAuto);
//        $ReqEtud = $ConnectLaporte->prepare("SELECT * FROM $NomTabUsers
//			  	                WHERE Identifiant = :LoginAuto");
        $ReqEtud = $ConnectLaporte->prepare("SELECT * FROM $NomTabUsers
			  	                             WHERE Identifiant = '$LoginAuto'");
        $ReqEtud->bindValue(':LoginAuto', $LoginAuto);
        $ReqEtud->execute();
        if ($ReqEtud->rowCount() == 0)
	        print ($LoginAuto." : non trouve <br />");
	    else  if (mysql_num_rows ($ReqEtud) > 1)
	       print ($LoginAuto." : plus d'une occurrence <br />");
	    else
	    {
	        $Obj = $ReqEtud->fetch();
	        print ($Nom.' '.$Prenoms.' '.$NumGroupe.';'.$LoginAuto.
	               ' Ancien nom =  '.$Obj['Nom'].' Ancien prénom =  '.$Obj['Prenom'].'<br />');
        }
        /*
        $ReqEtud = $ConnectLaporte->query("UPDATE $NomTabUsers SET 
                                     Nom    = \"$Nom\",
                                     Prenom = \"$Prenoms\",
                                     Groupe =  $NumGroupe
                               WHERE Identifiant = '$LoginAuto'");
        */
    }
    fclose ($handle);

} // NormaliserNomPrenomLogin1A2A()

function Footer () {
?>
    <footer class="page-footer">
      <div class="jaune">
        <div class="container">
          <div class="row no-margin-bottom">
            <div class="col s12">
              <p class="right white-text">
        Le responsable des stages : <b><a class="white-text" href="mailto:marc.laporte@univ-amu.fr">  Marc Laporte</a></b>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
<?php
}
?>