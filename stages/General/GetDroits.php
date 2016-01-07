<?php
//
// Fichier GetDroits.php
//

function GetDroits ($Status, $Traitement)
{
    switch ($Traitement)
	{
      case 'ListeNewInscripts' :
      case 'EnregNewInscript'  :
      case 'DelNewInscript'    :
      case 'DelMailsToSend'    :
      case 'ListeMailsToSend'  :
      case 'SendMail'  :
	    return $Status == ADMIN || $Status == RESP;

      case 'Mailing'         :
      case 'DelEntreprise'   :
      case 'ModifEntreprise' :
      case 'ModifUser'       :
      case 'DelStage'        :
      case 'DelUser'         :
	  case 'NewUser'         :
	  case 'ListeUsers'      : 
	  case 'NewEntreprise'   :
	  case 'AffectStageEtud' :
	  case 'ListeEtudAvecStage' :
	  case 'ListeEtudSansStage' :
	  case 'AffichUser' :
	  case 'ListeDetailsEntreprises' :
	    return $Status == ADMIN || $Status == RESP   || $Status == SECR;

      case 'Etiquettes' :
      case 'List_TA'    :
	    return $Status == ADMIN || $Status == SECR;

      case 'ListeEtud1A' :
	  case 'ListeEtud2A' :
          return $Status == PROF;

      case 'ModifStage'      :
	  case 'NewStage'   :
	    return $Status == ADMIN || $Status == RESP  || $Status == SECR  || 
			   $Status == TUTEUR;

	  case 'ListeFichesStages' :
	    return $Status == ADMIN || $Status == RESP  || $Status == SECR  ||
			   $Status == PROF  || 
                        //$Status == ETUD1 || 
                        $Status == ETUD2 || $Status == ETUDLP;

	  case 'ListeFichesStagesNonPourvus' :
	    return $Status == PROF  || $Status == ETUD1 || $Status == ETUD2 || $Status == ETUDLP;

	  case 'ListeForum' :
	    return $Status == ADMIN || $Status == RESP  || $Status == SECR  || 
  			   $Status == ETUD2 || $Status == ETUDLP;

	  case 'Essais'            :
	  case 'RechercheStage'    :
	    return $Status == ADMIN;

	  case 'ListeEntreprises' :
	    return $Status == ADMIN || $Status == RESP  || $Status == SECR  ||
			   $Status == ETUD1 || $Status == ETUD2 || $Status == ETUDLP;

	  case 'AffichEntreprise' :
	    return $Status == ADMIN || $Status == RESP  || $Status == SECR  ||
			   $Status == ETUD2 || $Status == ETUDLP || $Status == ETUD2;

	  case 'AffichStage' :
	    return $Status == ADMIN || $Status == RESP   || $Status == SECR  ||
			   $Status == PROF  || $Status == TUTEUR || $Status == ETUD2 || $Status == ETUDLP;
	  
      case 'ModifUserUnique' :
		return $Status == PROF  || $Status == TUTEUR ||
			   $Status == ETUD1 || $Status == ETUD2  || $Status == ETUDLP;

	  case 'CoordonneesEntreprise'       :
	  case 'ListeFichesStagesEntreprise' :
      case 'ModifStageUnique'            :
	  case 'ModifInfosUserConnecte'      :
	    return $Status == TUTEUR;

      case 'ChangerPassWord' :
	    return $Status == ADMIN || $Status == RESP  || $Status == SECR  ||
			   $Status == PROF  || $Status == TUTEUR;

      default :
	    return 0;
	}
	
} // GetDroits()
?>

