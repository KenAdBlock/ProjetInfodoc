<?Php

// Fichier : CStage.php

class CStage
{
    var $PK_Stage;
    var $FK_Entreprise;
    var $FK_Tuteur;

    var $NiveauStage;
    var $Materiel;
    var $Langages;
    var $AutresLangages;
    var $BD;
    var $AutresBD;
	
    var $LogicielsSpecifiques;
    var $MethodesAnalyse;
    var $MethodesConception;
    var $MethodesProgrammation;
    var $MethodesControleQL;
    var $MethodesGestionProjet;
	
    var $Sujet;
	
    var $IsNatureTacheProgr;
    var $IsNatureStageAnalyse;
    var $IsIntegrationProjetGlobal;
    var $IsIntegrationEntiteIndependante;

    var $RemarquesGenerales;
    var $NbPersCentreInfo;
    var $AreOldStagiaires;
    var $NbStagesProposes;
    var $NbStagesRestant;
    var $NbPersonnesService;
    var $IsStagiaireSeul;
	
    var $IndemnitesMensuellesStage;
    var $IndemnitesRepas;
    var $IndemnitesTransport;
    var $IsEmbauchePossible;

    var $Adr1Stage;
    var $Adr2Stage;
    var $CPStage;
    var $VilleStage;
	
    function ProtectApos ($String)
    {
        $NewString = "";
        $String = str_split ($String);
        
        for ($i = 0; $i < count ($String); ++$i)
            if ($String [$i] == "'")
                $NewString .= "&apos;";
            else
                $NewString .= $String [$i];
        return $NewString;
        
    } // ProtectApos()
    
    // Constructeur
    //=============

    function CStage ($PK_Stage = 0)
    {
        global $ConnectStages, $NomTabStages;

        if (!isset ($PK_Stage) || $PK_Stage == 0)
        {
            $this->PK_Stage                        = 0;
			
            $this->FK_Entreprise                   = 0;
            $this->FK_Tuteur                       = 0;
 			
            $this->NiveauStage                     = 1;
            $this->Materiel                        = 0;
            $this->Langages                        = 0;
            $this->AutresLangages                  = '';
            $this->BD                              = 0;
            $this->AutresBD                        = '';

            $this->LogicielsSpecifiques            = '';
            $this->MethodesAnalyse                 = '';
            $this->MethodesConception              = '';
            $this->MethodesProgrammation           = '';
            $this->MethodesControleQL              = '';
            $this->MethodesGestionProjet           = '';
			
            $this->Sujet                           = '';
			
            $this->IsNatureTacheProgr              = 1;
            $this->IsNatureStageAnalyse            = 1;
            $this->IsIntegrationProjetGlobal       = 1;
            $this->IsIntegrationEntiteIndependante = 1;

            $this->RemarquesGenerales              = '';
			
            $this->NbPersCentreInfo                = '1';
            $this->AreOldStagiaires                = 0;
            $this->NbStagesProposes                = 1;
            $this->NbStagesRestant                 = 1;
            $this->NbPersonnesService              = '1';
            $this->IsStagiaireSeul                 = 0;
            $this->IndemnitesMensuellesStage       = MINIMUM_LEGAL_INDEMNITES;
            $this->IndemnitesRepas                 = '';
            $this->IndemnitesTransport             = '';
            $this->IsEmbauchePossible              = 0;
            $this->Adr1Stage                       = '';
            $this->Adr2Stage                       = '';
            $this->CPStage                         = '';
            $this->VilleStage                      = '';
		}
        else
        {
            $this->PK_Stage = $PK_Stage;
            $ReqTuple = $ConnectStages->query("SELECT * FROM  $NomTabStages
                                    WHERE PK_Stage = '$PK_Stage'");
            $LeTuple = $ReqTuple->fetch();

            $this->FK_Entreprise                   = $LeTuple['FK_Entreprise'];
            $this->FK_Tuteur                       = $LeTuple['FK_Tuteur'];

            $this->NiveauStage                     = $LeTuple['NiveauStage'];
            $this->Materiel                        = $LeTuple['Materiel'];
            $this->Langages                        = $LeTuple['Langages'];
            $this->AutresLangages                  = $LeTuple['AutresLangages'];
	        $this->BD                              = $LeTuple['BD'];
            $this->AutresBD                        = $LeTuple['AutresBD'];

            $this->LogicielsSpecifiques            = $LeTuple['LogicielsSpecifiques'];
            $this->MethodesAnalyse                 = $LeTuple['MethodesAnalyse'];
            $this->MethodesConception              = $LeTuple['MethodesConception'];
            $this->MethodesProgrammation           = $LeTuple['MethodesProgrammation'];
            $this->MethodesControleQL              = $LeTuple['MethodesControleQL'];
            $this->MethodesGestionProjet           = $LeTuple['MethodesGestionProjet'];

            $this->Sujet                           = $LeTuple['Sujet'];

            $this->IsNatureTacheProgr              = $LeTuple['IsNatureTacheProgr'];
            $this->IsNatureStageAnalyse            = $LeTuple['IsNatureStageAnalyse'];
            $this->IsIntegrationProjetGlobal       = $LeTuple['IsIntegrationProjetGlobal'];
            $this->IsIntegrationEntiteIndependante = $LeTuple['IsIntegrationEntiteIndependante'];

            $this->RemarquesGenerales              = $LeTuple['RemarquesGenerales'];
            $this->NbPersCentreInfo                = $LeTuple['NbPersCentreInfo'];
            $this->AreOldStagiaires                = $LeTuple['AreOldStagiaires'];
            $this->NbStagesProposes                = $LeTuple['NbStagesProposes'];
            $this->NbStagesRestant                 = $LeTuple['NbStagesRestant'];
            $this->NbPersonnesService              = $LeTuple['NbPersonnesService'];
            $this->IsStagiaireSeul                 = $LeTuple['IsStagiaireSeul'];
			
            $this->IndemnitesMensuellesStage       = $LeTuple['IndemnitesMensuellesStage'];
            $this->IndemnitesRepas                 = $LeTuple['IndemnitesRepas'];
            $this->IndemnitesTransport             = $LeTuple['IndemnitesTransport'];
            $this->IsEmbauchePossible              = $LeTuple['IsEmbauchePossible'];
			
            $this->Adr1Stage                       = $LeTuple['Adr1Stage'];
            $this->Adr2Stage                       = $LeTuple['Adr2Stage'];
            $this->CPStage                         = $LeTuple['CPStage'];
            $this->VilleStage                      = $LeTuple['VilleStage'];
		}

    } // CStage()

    // Accesseurs
    //===========

    function GetPK_Stage                    () { return $this->PK_Stage                       ; }
	
    function GetFK_Entreprise               () { return $this->FK_Entreprise                  ; }
    function GetFK_Tuteur                   () { return $this->FK_Tuteur                      ; }

    function GetNiveauStage                 () { return $this->NiveauStage                    ; }
    function GetMateriel                    () { return $this->Materiel                       ; }
    function GetLangages                    () { return $this->Langages                       ; }
    function GetAutresLangages              () { return $this->AutresLangages                 ; }
    function GetBD                          () { return $this->BD                             ; }
    function GetAutresBD                    () { return $this->AutresBD                       ; }

    function GetLogicielsSpecifiques        () { return $this->LogicielsSpecifiques           ; }
    function GetMethodesAnalyse             () { return $this->MethodesAnalyse                ; }
    function GetMethodesConception          () { return $this->MethodesConception             ; }
    function GetMethodesProgrammation       () { return $this->MethodesProgrammation          ; }
    function GetMethodesControleQL          () { return $this->MethodesControleQL             ; }
    function GetMethodesGestionProjet       () { return $this->MethodesGestionProjet          ; }

    function GetSujet                       () { return $this->Sujet                          ; }

    function GetIsNatureTacheProgr          () { return $this->IsNatureTacheProgr             ; }
    function GetIsNatureStageAnalyse        () { return $this->IsNatureStageAnalyse           ; }
    function GetIsIntegrationProjetGlobal   () { return $this->IsIntegrationProjetGlobal      ; }
    function GetIsIntegrationEntiteIndependante() { return $this->IsIntegrationEntiteIndependante; }

    function GetRemarquesGenerales          () { return $this->RemarquesGenerales             ; }

    function GetNbPersCentreInfo            () { return $this->NbPersCentreInfo               ; }
    function GetAreOldStagiaires            () { return $this->AreOldStagiaires               ; }
    function GetNbStagesProposes            () { return $this->NbStagesProposes               ; }
    function GetNbStagesRestant             () { return $this->NbStagesRestant                ; }
    function GetNbPersonnesService          () { return $this->NbPersonnesService             ; }
    function GetIsStagiaireSeul             () { return $this->IsStagiaireSeul                ; }

    function GetIndemnitesMensuellesStage   () { return $this->IndemnitesMensuellesStage      ; }
    function GetIndemnitesRepas             () { return $this->IndemnitesRepas                ; }
    function GetIndemnitesTransport         () { return $this->IndemnitesTransport            ; }
    function GetIsEmbauchePossible          () { return $this->IsEmbauchePossible             ; }

    function GetAdr1Stage                   () { return $this->Adr1Stage                      ; }
    function GetAdr2Stage                   () { return $this->Adr2Stage                      ; }
    function GetCPStage                     () { return $this->CPStage                        ; }
    function GetVilleStage                  () { return $this->VilleStage                     ; }
    // Modifieurs
    //=============

    function SetPK_Stage ($PK_Stage)
    {
        $this->PK_Stage = $PK_Stage;

    } // SetPK_Stage()

    function SetFK_Entreprise ($FK_Entreprise)
    {
        $this->FK_Entreprise = $FK_Entreprise;

    } // SetFK_Entreprise()
	
    function SetFK_Tuteur ($FK_Tuteur)
    {
        $this->FK_Tuteur = $FK_Tuteur;

    } // SetFK_Tuteur()

    function SetNiveauStage ($NiveauStage)
    {
        $this->NiveauStage = $NiveauStage;

    } // SetNiveauStage()

    function SetMateriel ($Materiel)
    {
        $this->Materiel = $Materiel;

    } // SetMateriel()

    function SetLangages ($Langages)
    {
        $this->Langages = $Langages;

    } // SetLangages()

    function SetAutresLangages ($AutresLangages)
    {
        $this->AutresLangages = $AutresLangages;

    } // SetAutresL()

    function SetBD ($BD)
    {
        $this->BD = $BD;

    } // SetBD()

    function SetAutresBD ($AutresBD)
    {
        $this->AutresBD = $AutresBD;

    } // SetAutresBD()

    function SetLogicielsSpecifiques ($LogicielsSpecifiques)
    {
        $this->LogicielsSpecifiques = $LogicielsSpecifiques;

    } // SetLogicielsSpecifiques()

    function SetMethodesAnalyse ($MethodesAnalyse)
    {
        $this->MethodesAnalyse = $MethodesAnalyse;

    } // SetMethodesAnalyse()

    function SetMethodesConception ($MethodesConception)
    {
        $this->MethodesConception = $MethodesConception;

    } // SetMethodesConception()

    function SetMethodesProgrammation ($MethodesProgrammation)
    {
        $this->MethodesProgrammation = $MethodesProgrammation;

    } // SetMethodesProgrammation()

    function SetMethodesControleQL ($MethodesControleQL)
    {
        $this->MethodesControleQL = $MethodesControleQL;

    } // SetMethodesControleQL()

    function SetMethodesGestionProjet ($MethodesGestionProjet)
    {
        $this->MethodesGestionProjet = $MethodesGestionProjet;

    } // SetMethodesGestionProjet()

    function SetSujet ($Sujet)
    {
        $this->Sujet = $Sujet;

    } // SetSujet()

    function SetIsNatureTacheProgr ($IsNatureTacheProgr)
    {
        $this->IsNatureTacheProgr = $IsNatureTacheProgr;

    } // SetIsNatureTacheProgr()

    function SetIsNatureStageAnalyse ($IsNatureStageAnalyse)
    {
        $this->IsNatureStageAnalyse = $IsNatureStageAnalyse;

    } // SetIsNatureStageAnalyse()

    function SetIsIntegrationProjetGlobal ($IsIntegrationProjetGlobal)
    {
        $this->IsIntegrationProjetGlobal = $IsIntegrationProjetGlobal;

    } // SetIsIntegrationProjetGlobal()

    function SetIsIntegrationEntiteIndependante ($IsIntegrationEntiteIndependante)
    {
        $this->IsIntegrationEntiteIndependante = $IsIntegrationEntiteIndependante;

    } // SetIsIntegrationEntiteIndependante()

    function SetRemarquesGenerales ($RemarquesGenerales)
    {
        $this->RemarquesGenerales = $RemarquesGenerales;

    } // SetRemarquesGenerales()

    function SetNbPersCentreInfo ($NbPersCentreInfo)
    {
        $this->NbPersCentreInfo = $NbPersCentreInfo;

    } // SetNbPersCentreInfo()

    function SetAreOldStagiaires ($AreOldStagiaires)
    {
        $this->AreOldStagiaires = $AreOldStagiaires;

    } // SetAreOldStagiaires()

    function SetNbStagesProposes ($NbStagesProposes)
    {
        $this->NbStagesProposes = $NbStagesProposes;

    } // SetNbStagesProposes()

    function SetNbStagesRestant ($NbStagesRestant)
    {
        $this->NbStagesRestant = $NbStagesRestant;

    } // SetNbStagesRestant()

    function SetNbPersonnesService ($NbPersonnesService)
    {
        $this->NbPersonnesService = $NbPersonnesService;

    } // SetNbPersonnesService()

    function SetIsStagiaireSeul ($IsStagiaireSeul)
    {
        $this->IsStagiaireSeul = $IsStagiaireSeul;

    } // SetIsStagiaireSeul()

    function SetIndemnitesMensuellesStage ($IndemnitesMensuellesStage)
    {
        $this->IndemnitesMensuellesStage = $IndemnitesMensuellesStage;

    } // SetIndemnitesMensuellesStage()

    function SetIndemnitesRepas ($IndemnitesRepas)
    {
        $this->IndemnitesRepas = $IndemnitesRepas;

    } // SetIndemnitesRepas()

    function SetIndemnitesTransport ($IndemnitesTransport)
    {
        $this->IndemnitesTransport = $IndemnitesTransport;

    } // SetIndemnitesTransport()

    function SetIsEmbauchePossible ($IsEmbauchePossible)
    {
        $this->IsEmbauchePossible = $IsEmbauchePossible;

    } // SetIsEmbauchePossible()

	function SetAdr1Stage ($Adr1Stage)
    {
        $this->Adr1Stage = $Adr1Stage;

    } // SetAdr1Stage()

    function SetAdr2Stage ($Adr2Stage)
    {
        $this->Adr2Stage = $Adr2Stage;

    } // SetAdr2Stage()

	function SetCPStage ($CPStage)
    {
        $this->CPStage = $CPStage;

    } // SetCPStage()

	function SetVilleStage ($VilleStage)
    {
        $this->VilleStage = $VilleStage;

    } // SetVilleStage()

    function Select()
    {
        global $ConnectStages, $NomTabStages;

        $Req = $ConnectStages->query("SELECT * FROM $NomTabStages  WHERE PK_Stage = $this->PK_Stage");
        $Obj = $Req->fetch();

        if (! $Obj) return false;

        $this->SetFK_Entreprise                    ($Obj['FK_Entreprise']);
        $this->SetFK_Tuteur                        ($Obj['FK_Tuteur']);

        $this->SetNiveauStage                      ($Obj['NiveauStage']);
        $this->SetMateriel                         ($Obj['Materiel']);
        $this->SetLangages                         ($Obj['Langages']);
        $this->SetAutresLangages                   ($Obj['AutresLangages']);
        $this->SetBD                               ($Obj['BD']);
        $this->SetAutresBD                         ($Obj['AutresBD']);
        $this->SetLogicielsSpecifiques             ($Obj['LogicielsSpecifiques']);
        $this->SetMethodesAnalyse                  ($Obj['MethodesAnalyse']);
        $this->SetMethodesConception               ($Obj['MethodesConception']);
        $this->SetMethodesProgrammation            ($Obj['MethodesProgrammation']);
        $this->SetMethodesControleQL               ($Obj['MethodesControleQL']);
        $this->SetMethodesGestionProjet            ($Obj['MethodesGestionProjet']);
		
        $this->SetSujet                            ($Obj['Sujet']);
		
        $this->SetIsNatureTacheProgr               ($Obj['IsNatureTacheProgr']);
        $this->SetIsNatureStageAnalyse             ($Obj['IsNatureStageAnalyse']);
        $this->SetIsIntegrationProjetGlobal        ($Obj['IsIntegrationProjetGlobal']);
        $this->SetIsIntegrationEntiteIndependante  ($Obj['IsIntegrationEntiteIndependante']);
		
        $this->SetRemarquesGenerales               ($Obj['RemarquesGenerales']);
		
        $this->SetAreOldStagiaires                 ($Obj['AreOldStagiaires']);
        $this->SetNbPersCentreInfo                 ($Obj['NbPersCentreInfo']);
        $this->SetNbStagesProposes                 ($Obj['NbStagesProposes']);
        $this->SetNbStagesRestant                  ($Obj['NbStagesRestant']);
        $this->SetNbPersonnesService               ($Obj['NbPersonnesService']);
        $this->SetIsStagiaireSeul                  ($Obj['IsStagiaireSeul']);
        $this->SetIndemnitesMensuellesStage        ($Obj['IndemnitesMensuellesStage']);
        $this->SetIndemnitesRepas                  ($Obj['IndemnitesRepas']);
        $this->SetIndemnitesTransport              ($Obj['IndemnitesTransport']);
        $this->SetIsEmbauchePossible               ($Obj['IsEmbauchePossible']);

        $this->SetAdr1Stage                        ($Obj['Adr1Stage']);
        $this->SetAdr2Stage                        ($Obj['Adr2Stage']);
        $this->SetCPStage                          ($Obj['CPStage']);
        $this->SetVilleStage                       ($Obj['VilleStage']);
		
        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabStages;

        return $ConnectStages->query("INSERT INTO $NomTabStages VALUES (
                           NULL,
                           $this->FK_Entreprise,
                           $this->FK_Tuteur,

                           $this->NiveauStage,
                           $this->Materiel,
                           $this->Langages,
                          '$this->AutresLangages',
                           $this->BD,
                          '$this->AutresBD',

                          '$this->LogicielsSpecifiques',
                          '$this->MethodesAnalyse',
                          '$this->MethodesConception',
                          '$this->MethodesProgrammation',
                          '$this->MethodesControleQL',
                          '$this->MethodesGestionProjet',

                          '$this->Sujet',

                           $this->IsNatureTacheProgr,
                           $this->IsNatureStageAnalyse,
                           $this->IsIntegrationProjetGlobal,
                           $this->IsIntegrationEntiteIndependante,

                          '$this->RemarquesGenerales',

                          '$this->NbPersCentreInfo',
                           $this->AreOldStagiaires,
                           $this->NbStagesProposes,
                           $this->NbStagesRestant ,
                          '$this->NbPersonnesService',
                           $this->IsStagiaireSeul,

                          '$this->IndemnitesMensuellesStage',
                          '$this->IndemnitesRepas',
                          '$this->IndemnitesTransport',
                           $this->IsEmbauchePossible,

                          '$this->Adr1Stage',
                          '$this->Adr2Stage',
                          '$this->CPStage',
                          '$this->VilleStage')");
//        return Query ("INSERT INTO $NomTabStages VALUES (NULL,$this->FK_Entreprise,$this->FK_Tuteur,$this->NiveauStage,$this->Materiel,$this->Langages,'$this->AutresLangages',$this->BD,'$this->AutresBD','$this->LogicielsSpecifiques','$this->MethodesAnalyse','$this->MethodesConception','$this->MethodesProgrammation','$this->MethodesControleQL','$this->MethodesGestionProjet','$this->Sujet',$this->IsNatureTacheProgr,$this->IsNatureStageAnalyse,$this->IsIntegrationProjetGlobal,$this->IsIntegrationEntiteIndependante,'$this->RemarquesGenerales','$this->NbPersCentreInfo',$this->NbStagesProposes,$this->AreOldStagiaires,$this->NbStagesRestant ,'$this->NbPersonnesService',$this->IsStagiaireSeul,'$this->IndemnitesMensuellesStage','$this->IndemnitesRepas','$this->IndemnitesTransport',$this->IsEmbauchePossible,'$this->Adr1Stage','$this->Adr2Stage','$this->CPStage','$this->VilleStage')",$ConnectStages);

    } // Insert()
    
    function Delete()
    {
        global $ConnectStages, $NomTabStages;

        return $ConnectStages->query("DELETE FROM $NomTabStages WHERE PK_Stage = $this->PK_Stage");

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabStages;

        $Req = $ConnectStages->query("UPDATE $NomTabStages 
		               SET 
                           FK_Entreprise                    =  $this->FK_Entreprise,
						   FK_Tuteur                        =  $this->FK_Tuteur,
							 
                           NiveauStage                      =  $this->NiveauStage,								 
                           Materiel                         =  $this->Materiel,
                           Langages                         =  $this->Langages,
                           AutresLangages                   = '$this->AutresLangages',
                           BD                               =  $this->BD,
                           AutresBD                         = '$this->AutresBD',
						   
                           LogicielsSpecifiques             = '$this->LogicielsSpecifiques',
                           MethodesAnalyse                  = '$this->MethodesAnalyse',
                           MethodesConception               = '$this->MethodesConception',
                           MethodesProgrammation            = '$this->MethodesProgrammation',
                           MethodesControleQL               = '$this->MethodesControleQL',
                           MethodesGestionProjet            = '$this->MethodesGestionProjet',

                           Sujet                            = '$this->Sujet',
						   
                           IsNatureTacheProgr               =  $this->IsNatureTacheProgr,
                           IsNatureStageAnalyse             =  $this->IsNatureStageAnalyse,
                           IsIntegrationProjetGlobal        =  $this->IsIntegrationProjetGlobal,
                           IsIntegrationEntiteIndependante  =  $this->IsIntegrationEntiteIndependante,

                           RemarquesGenerales               = '$this->RemarquesGenerales',

                           NbPersCentreInfo                 = '$this->NbPersCentreInfo',
                           AreOldStagiaires                 =  $this->AreOldStagiaires,
                           NbStagesProposes                 =  $this->NbStagesProposes,
                           NbStagesRestant                  =  $this->NbStagesRestant,
                           NbPersonnesService               = '$this->NbPersonnesService',
                           IsStagiaireSeul                  =  $this->IsStagiaireSeul,

                           IndemnitesMensuellesStage        = '$this->IndemnitesMensuellesStage',
                           IndemnitesRepas                  = '$this->IndemnitesRepas',
                           IndemnitesTransport              = '$this->IndemnitesTransport',
                           IsEmbauchePossible               =  $this->IsEmbauchePossible,

						   Adr1Stage                        = '$this->Adr1Stage',
                           Adr2Stage                        = '$this->Adr2Stage',
                           CPStage                          = '$this->CPStage',
                           VilleStage                       = '$this->VilleStage'
						   
                           WHERE PK_Stage = $this->PK_Stage");

    } // Update()

} // CStages
?>
