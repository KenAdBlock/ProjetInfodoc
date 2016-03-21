<?php

// Fichier : CNewInscript.php

class CNewInscript
{
    var $PK_NewInscript;

    var $CiviliteTuteur;
    var $NomTuteur;
    var $PrenomTuteur;
    var $TelTuteur;
    var $MailTuteur;
    var $FaxTuteur;

    var $Is_IdemTuteur;
    var $CiviliteRespAdmin;
    var $NomRespAdmin;
    var $PrenomRespAdmin;
    var $TelRespAdmin;
    var $MailRespAdmin;
    var $FaxRespAdmin;

    var $NomE;
    var $Adr1;
    var $Adr2;
    var $CP;
    var $Ville;

    var $FK_Entreprise;

    // Constructeur
    //=============

    function CNewInscript ($PK_NewInscript = 0)
    {
        global $ConnectStages, $NomTabNewInscripts;

        if (!isset ($PK_NewInscript) || $PK_NewInscript == 0)
        {
            $this->PK_NewInscript  = 0;

            $this->CiviliteTuteur  = 'M';
            $this->NomTuteur       = '';
            $this->PrenomTuteur    = '';
            $this->TelTuteur       = '';
            $this->MailTuteur      = '';
            $this->FaxTuteur       = '';

            $this->Is_IdemTuteur   =  0;
            $this->NomRespAdmin    = '';
            $this->PrenomRespAdmin = '';
            $this->TelRespAdmin    = '';
            $this->MailRespAdmin   = '';
            $this->FaxRespAdmin    = '';

            $this->NomE            = '';
            $this->Adr1            = '';
            $this->Adr2            = '';
            $this->CP              = '';
            $this->Ville           = '';

            $this->FK_Entreprise   = 0;
        }
        else
        {
            $this->PK_NewInscript = $PK_NewInscript;

            $ReqTuple = Query ("SELECT * FROM  $NomTabNewInscripts
                                    WHERE PK_NewInscript = '$PK_NewInscript'",
                               $ConnectStages);
            $LeTuple = mysql_fetch_object ($ReqTuple);

            $this->CiviliteTuteur    = $LeTuple->CiviliteTuteur;
            $this->NomTuteur         = stripslashes ($LeTuple->NomTuteur);
            $this->PrenomTuteur      = stripslashes ($LeTuple->PrenomTuteur);
            $this->TelTuteur         = $LeTuple->TelTuteur       ;
            $this->MailTuteur        = $LeTuple->MailTuteur      ;
            $this->FaxTuteur         = $LeTuple->FaxTuteur       ;

            $this->Is_IdemTuteur     = $LeTuple->Is_IdemTuteur   ;
            $this->CiviliteRespAdmin = $LeTuple->CiviliteRespAdmin;
            $this->NomRespAdmin      = stripslashes ($LeTuple->NomRespAdmin);
            $this->PrenomRespAdmin   = stripslashes ($LeTuple->PrenomRespAdmin);
            $this->TelRespAdmin      = $LeTuple->TelRespAdmin    ;
            $this->MailRespAdmin     = $LeTuple->MailRespAdmin   ;
            $this->FaxRespAdmin      = $LeTuple->FaxRespAdmin    ;

            $this->NomE              = stripslashes ($LeTuple->NomE);
            $this->Adr1              = stripslashes ($LeTuple->Adr1);
            $this->Adr2              = stripslashes ($LeTuple->Adr2);
            $this->CP                = $LeTuple->CP;
            $this->Ville             = stripslashes ($LeTuple->Ville);

            $this->FK_Entreprise     = $LeTuple->FK_Entreprise   ;
        }

    } // CNewInscript()

    // Accesseurs
    //===========

    function GetPK_NewInscript    () { return $this->PK_NewInscript    ; }

    function GetCiviliteTuteur    () { return $this->CiviliteTuteur    ; }
    function GetNomTuteur         () { return $this->NomTuteur         ; }
    function GetPrenomTuteur      () { return $this->PrenomTuteur      ; }
    function GetTelTuteur         () { return $this->TelTuteur         ; }
    function GetMailTuteur        () { return $this->MailTuteur        ; }
    function GetFaxTuteur         () { return $this->FaxTuteur         ; }

    function GetIs_IdemTuteur     () { return $this->Is_IdemTuteur     ; }
    function GetCiviliteRespAdmin () { return $this->CiviliteRespAdmin ; }
    function GetNomRespAdmin      () { return $this->NomRespAdmin      ; }
    function GetPrenomRespAdmin   () { return $this->PrenomRespAdmin   ; }
    function GetTelRespAdmin      () { return $this->TelRespAdmin      ; }
    function GetMailRespAdmin     () { return $this->MailRespAdmin     ; }
    function GetFaxRespAdmin      () { return $this->FaxRespAdmin      ; }

    function GetNomE              () { return $this->NomE              ; }
    function GetAdr1              () { return $this->Adr1              ; }
    function GetAdr2              () { return $this->Adr2              ; }
    function GetCP                () { return $this->CP                ; }
    function GetVille             () { return $this->Ville             ; }

    function GetFK_Entreprise     () { return $this->FK_Entreprise     ; }

    // Modifieurs
    //=============


    function SetPK_NewInscript ($PK_NewInscript)
    {
        $this->PK_NewInscript = $PK_NewInscript;

    } // SetPK_NewInscript()

    function SetCiviliteTuteur ($CiviliteTuteur)
    {
        $this->CiviliteTuteur = $CiviliteTuteur;

    } // SetCiviliteTuteur()

    function SetNomTuteur ($NomTuteur)
    {
        $this->NomTuteur = $NomTuteur;

    } // SetNomTuteur()

    function SetPrenomTuteur ($PrenomTuteur)
    {
        $this->PrenomTuteur = $PrenomTuteur;

    } // SetPrenomTuteur()

    function SetTelTuteur ($TelTuteur)
    {
        $this->TelTuteur = $TelTuteur;

    } // SetTelTuteur()

    function SetMailTuteur ($MailTuteur)
    {
        $this->MailTuteur = $MailTuteur;

    } // SetMailTuteur()

    function SetFaxTuteur ($FaxTuteur)
    {
        $this->FaxTuteur = $FaxTuteur;

    } // SetFaxTuteur()
    
    function SetIs_IdemTuteur ($Is_IdemTuteur)
    {
        $this->Is_IdemTuteur = $Is_IdemTuteur;

    } // SetIs_IdemTuteur()

    function SetCiviliteRespAdmin ($CiviliteRespAdmin)
    {
        $this->CiviliteRespAdmin = $CiviliteRespAdmin;

    } // SetCiviliteRespAdmin()

    function SetNomRespAdmin ($NomRespAdmin)
    {
        $this->NomRespAdmin = $NomRespAdmin;

    } // SetNomRespAdmin()

    function SetPrenomRespAdmin ($PrenomRespAdmin)
    {
        $this->PrenomRespAdmin = $PrenomRespAdmin;

    } // SetPrenomRespAdmin()

    function SetTelRespAdmin ($TelRespAdmin)
    {
        $this->TelRespAdmin = $TelRespAdmin;

    } // SetTelRespAdmin()

    function SetMailRespAdmin ($MailRespAdmin)
    {
        $this->MailRespAdmin = $MailRespAdmin;

    } // SetMailRespAdmin()

    function SetFaxRespAdmin ($FaxRespAdmin)
    {
        $this->FaxRespAdmin = $FaxRespAdmin;

    } // SetFaxRespAdmin()

    function SetNomE ($NomE)
    {
        $this->NomE = $NomE;

    } // SetNomE()

    function SetAdr1 ($Adr1)
    {
        $this->Adr1 = $Adr1;

    } // SetAdr1()

    function SetAdr2 ($Adr2)
    {
        $this->Adr2 = $Adr2;

    } // SetAdr2()

    function SetCP ($CP)
    {
        $this->CP = $CP;

    } // SetCP()

    function SetVille ($Ville)
    {
        $this->Ville = $Ville;

    } // SetVille()

    function SetFK_Entreprise ($FK_Entreprise)
    {
        $this->FK_Entreprise = $FK_Entreprise;

    } // SetFK_Entreprise()


    function Select()
    {
        global $ConnectStages, $NomTabNewInscripts;

        $Req = Query ("SELECT * FROM $NomTabNewInscripts  
		                   WHERE PK_NewInscript = $this->PK_NewInscript",
                      $ConnectStages);
        $Obj = mysql_fetch_object ($Req);

        if (! $Obj) return false;

        $this->SetCiviliteTuteur          ($Obj->CiviliteTuteur);
        $this->SetNomTuteur               ($Obj->NomTuteur);
        $this->SetPrenomTuteur            ($Obj->PrenomTuteur);
        $this->SetTelTuteur               ($Obj->TelTuteur);
        $this->SetMailTuteur              ($Obj->MailTuteur);
        $this->SetFaxTuteur               ($Obj->FaxTuteur);

        $this->SetIs_IdemTuteur           ($Obj->Is_IdemTuteur);
        $this->SetCiviliteRespAdmin       ($Obj->CiviliteRespAdmin);
        $this->SetNomRespAdmin            ($Obj->NomRespAdmin);
        $this->SetPrenomRespAdmin         ($Obj->PrenomRespAdmin);
        $this->SetTelRespAdmin            ($Obj->TelRespAdmin);
        $this->SetMailRespAdmin           ($Obj->MailRespAdmin);
        $this->SetFaxRespAdmin            ($Obj->FaxRespAdmin);

        $this->SetNomE                    ($Obj->NomE);
        $this->SetAdr1                    ($Obj->Adr1);
        $this->SetAdr2                    ($Obj->Adr2);
        $this->SetCP                      ($Obj->CP);
        $this->SetVille                   ($Obj->Ville);

        $this->SetFK_Entreprise           ($Obj->FK_Entreprise);

        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabNewInscripts;
        
        return Query ("INSERT INTO $NomTabNewInscripts VALUES (
                NULL,
                '$this->CiviliteTuteur',
                '$this->NomTuteur',
                '$this->PrenomTuteur',
                '$this->TelTuteur' ,
                '$this->MailTuteur',
                '$this->FaxTuteur',

                 $this->Is_IdemTuteur ,
                '$this->CiviliteRespAdmin',
                '$this->NomRespAdmin',
                '$this->PrenomRespAdmin',
                '$this->TelRespAdmin' ,
                '$this->MailRespAdmin',
                '$this->FaxRespAdmin',

                '$this->NomE',
                '$this->Adr1',
                '$this->Adr2',
                '$this->CP',
                '$this->Ville' ,

                '$this->FK_Entreprise');",
                     $ConnectStages);

    } // Insert()

    function Delete()
    {
        global $ConnectStages, $NomTabNewInscripts;

        return Query ("DELETE FROM $NomTabNewInscripts 
		                   WHERE PK_NewInscript = $this->PK_NewInscript",
                     $ConnectStages);

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabNewInscripts;
        
        $Req = Query ("UPDATE $NomTabNewInscripts SET 
                                 CiviliteTuteur      = '$this->CiviliteTuteur',
                                 NomTuteur           = '$this->NomTuteur',
                                 PrenomTuteur        = '$this->PrenomTuteur',
                                 TelTuteur           = '$this->TelTuteur',
                                 MailTuteur          = '$this->MailTuteur',
                                 FaxTuteur           = '$this->FaxTuteur',

                                 Is_IdemTuteur       =  $this->Is_IdemTuteur,
                                 CiviliteRespAdmin   = '$this->CiviliteRespAdmin',
                                 NomRespAdmin        = '$this->NomRespAdmin',
                                 PrenomRespAdmin     = '$this->PrenomRespAdmin',
                                 TelRespAdmin        = '$this->TelRespAdmin',
                                 MailRespAdmin       = '$this->MailRespAdmin',
                                 FaxRespAdmin        = '$this->FaxRespAdmin',

                                 NomE                = '$this->NomE',
                                 Adr1                = '$this->Adr1',
                                 Adr2                = '$this->Adr2',
                                 CP                  = '$this->CP',
                                 Ville               = '$this->Ville',

                                 FK_Entreprise = '$this->FK_Entreprise'

                           WHERE PK_NewInscript = $this->PK_NewInscript",
                  $ConnectStages);

    } // Update()

} // CNewInscripts
?>
