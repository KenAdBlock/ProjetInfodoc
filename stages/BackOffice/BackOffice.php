<?php
    require_once ('Fonctions.php');
    require_once ($PATH_GENERAL.'Entete.php');
    require_once ($PATH_GENERAL.'Consult.php');
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

      <title></title>
      <link rel="icon" type="image/x-icon" href="<?=$PATH_IMG?>favicon.ico">
      <!-- CSS  -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="<?=$PATH_CSS?>style.css" type="text/css" rel="stylesheet" media="screen,projection"/>


      <script language="javascript">
          function popup(page)
          {
              window.open (page, "titre", "width=600, height=400, scrollbars=yes");
          }
      </script>


    <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var checkflag = true;

function check (field) 
{
    checkflag = !checkflag;
    for (i = field.length; i--; ) field[i].checked = checkflag;

    return checkflag ? "Tout décocher" : "Tout cocher";
}
//  End -->
    </script>
    <script language="javascript">
        function popup(page)
        {
            window.open (page, "titre", "width=600, height=400, scrollbars=yes");
        }
    </script>

</head>

<body>
<?php
    Entete();
    Consult($login, $_SESSION ['LibStatus'], $Status);
?>
    <div class="container">
          <div class="row">
            <div class="col s12">
              <div class="card grey lighten-5 z-depth-1" >
                <div class="card-content">
<?php
    // Récupérations des variables envoyées par POST ou GET
	
    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;

    // Traitements
    switch ($Trait)
    {
      // Listes 
      
      case 'List' :
        switch ($SlxTable)
        {
          case "$NomTabUsers" :
            if (! GetDroits ($Status, 'ListeUsers')) redirect ($URL_SITE);
            break;
			
          case "$NomTabNewInscripts" :
            if (! GetDroits ($Status, 'ListeNewInscripts')) redirect ($URL_SITE);
            break;
			
          case "$NomTabStages" :
            if (! GetDroits ($Status, 'ListeFichesStages') &&
			    ! GetDroits ($Status, 'ListeFichesStagesEntreprise')) redirect ($URL_SITE);
            break;
			
          case "$NomTabEntreprises" :
            if (! GetDroits ($Status, 'ListeEntreprises')) redirect ($URL_SITE);
            break;

          case "$NomTabMailsToSend" :
            if (! GetDroits ($Status, 'ListeMailsToSend')) redirect ($URL_SITE);
            break;

          default :
		    redirect ($URL_SITE);
		}
        include ($PATH_LIST.'List_'.$SlxTable.'.php');
	    break;

      case 'Del' :
        switch ($SlxTable)
        {
          case "$NomTabUsers" :
            if (! GetDroits ($Status, 'DelUser')) redirect ($URL_SITE);
            $Req = $ConnectStages->prepare("DELETE FROM $SlxTable WHERE PK_User = :IdentPK;");
            $Req->bindValue(':IdentPK', $IdentPK);
            $Req->execute();
            break;
                
          case "$NomTabNewInscripts" :
            if (! GetDroits ($Status, 'DelNewInscript')) redirect ($URL_SITE);
            $Req = $ConnectStages->prepare("DELETE FROM $SlxTable WHERE PK_NewInscript = :IdentPK;");
            $Req->bindValue(':IdentPK', $IdentPK);
            $Req->execute();
            break;
                
          case "$NomTabStages" :
            if (! GetDroits ($Status, 'DelStage')) redirect ($URL_SITE);
            $Req = $ConnectStages->prepare("DELETE FROM $SlxTable WHERE PK_Stage = :IdentPK;");
            $Req->bindValue(':IdentPK', $IdentPK);
            $Req->execute();
            break;
                
          case "$NomTabMailsToSend" :
            if (! GetDroits ($Status, 'DelMailsToSend')) redirect ($URL_SITE);
            $Req = $ConnectStages->prepare("DELETE FROM $SlxTable WHERE PK_Login = :IdentPK;");
            $Req->bindValue(':IdentPK', $IdentPK);
            $Req->execute();
            break;
                
          case "$NomTabEntreprises" :
            if (! GetDroits ($Status, 'DelEntreprise')) redirect ($URL_SITE);
            $Req = $ConnectStages->prepare("DELETE FROM $SlxTable WHERE PK_Entreprise = :IdentPK;");
            $Req->bindValue(':IdentPK', $IdentPK);
            $Req->execute();
            break;  
  
		  default :
		    redirect ($URL_SITE);
        }
	    include ($PATH_LIST.'List_'.$SlxTable.'.php');
        break;
        
      case 'Form' :   
        switch ($SlxTable)
        {
          case "$NomTabUsers" :
            if (! GetDroits ($Status, 'ModifUser')) redirect ($URL_SITE);
            break;

          case "$NomTabEntreprises" :
            if (! GetDroits ($Status, 'ModifEntreprise')) redirect ($URL_SITE);
            break;
            
          case "$NomTabNewInscripts" :
            if (! GetDroits ($Status, 'EnregNewInscript')) redirect ($URL_SITE);
            break;
            
          case "$NomTabStages" :
            if (! GetDroits ($Status, 'ModifStage')) redirect ($URL_SITE);
            break;
			
		  default :
		    redirect ($URL_SITE);
        }
	    include ($PATH_FORM.'Form_'.$SlxTable.'.php');
	    break;
		
      case 'ModifInfosUserConnecte' :
        if (! GetDroits ($Status, 'ModifInfosUserConnecte')) redirect ($URL_SITE);
	    include ($PATH_FORM.'Form_tabusers.php');
	    break;	 
		 
	  /* =========================   Taxe d'apprentissage  ================*/
	  
      case 'List_TA' :
        if (! GetDroits ($Status, 'List_TA')) redirect ($URL_SITE);
	    include ($PATH_BACKOFFICE.'List_TA.php');
	    break;	  

	  /* ==================================================================*/
	  
	  /* =========================   Etiquettes   =========================*/
	  
      case 'Etiquettes' :
        if (! GetDroits ($Status, 'Etiquettes')) redirect ($URL_SITE);
	    include ($PATH_BACKOFFICE.'Etiquettes.php');
	    break;	  

      case 'EtiqEntreprises' :
        if (! GetDroits ($Status, 'Etiquettes')) redirect ($URL_SITE);
	    include ($PATH_BACKOFFICE.'EtiqEntreprises.php');
	    break;	  

	  /* ==================================================================*/
	  
      case 'CoordonneesEntreprise' :
        if (! GetDroits ($Status, 'CoordonneesEntreprise')) redirect ($URL_SITE);
	    include ($PATH_FORM.'Form_tabentreprises.php');
	    break;	  
	  
      case 'SendMail' :
        if (! GetDroits ($Status, 'SendMail')) redirect ($URL_SITE);
	    include ($PATH_FORM.'Form_'.$SlxTable.'.php');
	    break;	  
	  
      case 'Mailing' :
        // if (! GetDroits ($Status, 'Mailing')) redirect ($URL_SITE);
		include ($PATH_BACKOFFICE.'Mailing.php');
	    break;	  
	  
      case 'ListesEtud12A' :
        if (! GetDroits ($Status, 'ListesEtud12A')) redirect ($URL_SITE);
		include ($PATH_BACKOFFICE.'Mailing.php');
	    break;	  
	  
      case 'Affich' :
        switch ($SlxTable)
        {
          case "$NomTabUsers" :
            if (! GetDroits ($Status, 'AffichUser')) redirect ($URL_SITE);
            include ($PATH_AFFICH.'AffichUser.php');
            break;

          case "$NomTabEntreprises" :
            if (! GetDroits ($Status, 'AffichEntreprise')) redirect ($URL_SITE);
            include ($PATH_AFFICH.'AffichEntreprise.php');
            break;
            
          case "$NomTabStages" :
            if (! GetDroits ($Status, 'AffichStage')) redirect ($URL_SITE);
            include ($PATH_AFFICH.'AffichStage.php');
            break;
			
		  default :
		    redirect ($URL_SITE);
        }
	    break;
        
      case 'search' :
        include ($PATH_FORM.'Recherche.php');
        break;

      case 'BackOffice' :
	    if ($Status != ADMIN) break;
		include ($PATH_BACKOFFICE.'TraitSpeciaux.php');
        break;

      case 'RecupFichEntreprises' :
	    if ($Status == ADMIN) RecupFichEntreprises();
        break;

      case 'RecupOldEntreprises' :
	    if ($Status == ADMIN) RecupOldEntreprises();
        break;

      case 'AccesRapideSoc' :
        if (GetDroits ($Status, 'ModifEntreprise'))
		    include ($PATH_BACKOFFICE.'AccesRapideSoc.php');
		break;

      case 'Essais' :
        if (GetDroits ($Status, 'Essais'))
		    include ($PATH_BACKOFFICE.'Essais.php');
		break;

      case 'ListeEtud1A' :
      case 'ListeEtud2A' :
        if ($Status == ADMIN)
		    include ($PATH_BACKOFFICE.'ListeEtud.php');
		break;

	  case 'ListeDetailsEntreprises' :
        if (GetDroits ($Status, 'ListeDetailsEntreprises'))
		    include ($PATH_BACKOFFICE.'ListeDetailsEntreprises.php');
		break;

      case 'AffectStageEtud' :
        if (GetDroits ($Status, 'AffectStageEtud'))
		    include ($PATH_BACKOFFICE.'AffectStageEtud.php');
		break;
		
	  case 'ListeEtudAvecStage' :
        if (GetDroits ($Status, 'ListeEtudAvecStage'))
		    include ($PATH_BACKOFFICE.'ListeEtudAvecStage.php');
		break;
		
	  case 'ListeEtudSansStage' :
        if (GetDroits ($Status, 'ListeEtudSansStage'))
		    include ($PATH_BACKOFFICE.'ListeEtudSansStage.php');
		break;

//      case 'EtiqEntreprises0708AvecStagiaire' :
//        if (GetDroits ($Status, 'EtiqEntreprises0708AvecStagiaire'))
//            include ($PATH_BACKOFFICE.'EtiqEntreprises0708AvecStagiaire.php');
//        break;

      default :
          redirect ($URL_SITE);
	    break;

    }
    // Fermeture de la base
    $ConnectStages = null;
?>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php
    Footer();
?>
        <script src="<?=$URL_SITE.$PATH_JQUERY?>jquery-2.2.1.min.js"></script>
        <script src="<?=$URL_SITE.$PATH_MATERIALIZE?>materialize.min.js"></script>
        <script src="<?=$PATH_JS?>init.js"></script>
        <script src=<?=$PATH_JS?>confirm.js type=text/javascript></script>
        <script src="<?=$PATH_JS?>titre.js"></script>
        <script>titre();</script>
    </body>
</html>
