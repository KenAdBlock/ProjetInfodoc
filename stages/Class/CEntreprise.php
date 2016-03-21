<?php

// Fichier : CEntreprise.php

class CEntreprise
{
    var $PK_Entreprise;
	var $Is_Valide;
    var $NomE;
    var $Civilite;
    var $NomR;
    var $PrenomR;
    var $Adr1;
    var $Adr2;
    var $CP;
    var $Ville;
    var $TelR;
    var $MailR;
    var $FaxR;
    var $PresentEntreprise;
    var $SiteEntreprise;
	
    // Constructeur
    //=============

    function CEntreprise ($PK_Entreprise = 0)
    {
        global $NomTabEntreprises, $ConnectStages;

        if (!isset ($PK_Entreprise) || $PK_Entreprise == 0)
        {
            $this->PK_Entreprise = 0;

            $this->Is_Valide         = 1;
            $this->NomE              = '';
            $this->Civilite          = 'M';
            $this->NomR              = '';
            $this->PrenomR           = '';
            $this->Adr1              = '';
            $this->Adr2              = '';
            $this->CP                = '';
            $this->Ville             = '';
            $this->TelR              = '00 00 00 00 00';
            $this->MailR             = '';
            $this->FaxR              = '';
            $this->PresentEntreprise = '';
            $this->SiteEntreprise    = 'http://';
        }
        else
        {
            $this->PK_Entreprise = $PK_Entreprise;
            $ReqTuple = Query ("SELECT * FROM  $NomTabEntreprises
                                    WHERE PK_Entreprise = '$PK_Entreprise'",
                               $ConnectStages);
            $LeTuple = mysql_fetch_object ($ReqTuple);

            $this->Is_Valide         = 1                          ;
            $this->NomE              = stripslashes ($LeTuple->NomE);
            $this->Civilite         = $LeTuple->Civilite          ;
            $this->NomR              = stripslashes ($LeTuple->NomR);
            $this->PrenomR           = stripslashes ($LeTuple->PrenomR);
            $this->Adr1              = stripslashes ($LeTuple->Adr1);
            $this->Adr2              = stripslashes ($LeTuple->Adr2);
            $this->CP                = $LeTuple->CP               ;
            $this->Ville             = stripslashes ($LeTuple->Ville);
            $this->TelR              = $LeTuple->TelR             ;
            $this->MailR             = $LeTuple->MailR            ;
            $this->FaxR              = $LeTuple->FaxR             ;
            $this->PresentEntreprise = stripslashes ($LeTuple->PresentEntreprise);
            $this->SiteEntreprise    = stripslashes ($LeTuple->SiteEntreprise);
        }

    } // CEntreprise()

    // Accesseurs
    //===========

    function GetPK_Entreprise     () { return $this->PK_Entreprise     ; }
    function GetIs_Valide         () { return $this->Is_Valide         ; }
    function GetNomE              () { return $this->NomE              ; }
    function GetCivilite          () { return $this->Civilite          ; }
    function GetNomR              () { return $this->NomR              ; }
    function GetPrenomR           () { return $this->PrenomR           ; }
    function GetAdr1              () { return $this->Adr1              ; }
    function GetAdr2              () { return $this->Adr2              ; }
    function GetCP                () { return $this->CP                ; }
    function GetVille             () { return $this->Ville             ; }
    function GetTelR              () { return $this->TelR              ; }
    function GetMailR             () { return $this->MailR             ; }
    function GetFaxR              () { return $this->FaxR              ; }
    function GetPresentEntreprise () { return $this->PresentEntreprise ; }
    function GetSiteEntreprise    () { return $this->SiteEntreprise    ; }

    // Modifieurs
    //=============

    function SetPK_Entreprise ($PK_Entreprise)
    {
        $this->PK_Entreprise = $PK_Entreprise;

    } // SetPK_Entreprise()

    function SetNomE ($NomE)
    {
        $this->NomE = $NomE;

    } // SetNomE()

    function SetCivilite ($Civilite)
    {
        $this->Civilite = $Civilite;

    } // SetCivilite()

    function SetIs_Valide ($Is_Valide)
    {
        $this->Is_Valide = $Is_Valide;

    } // SetIs_Valide()

    function SetNomR ($NomR)
    {
        $this->NomR = $NomR;

    } // SetNomR()

    function SetPrenomR ($PrenomR)
    {
        $this->PrenomR = $PrenomR;

    } // SetPrenomR()

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

    function SetTelR ($TelR)
    {
        $this->TelR = $TelR;

    } // SetTelR()

    function SetMailR ($MailR)
    {
        $this->MailR = $MailR;

    } // SetMailR()

    function SetFaxR ($FaxR)
    {
        $this->FaxR = $FaxR;

    } // SetFaxR()

    function SetPresentEntreprise ($PresentEntreprise)
    {
        $this->PresentEntreprise = $PresentEntreprise;

    } // SetPresentEntreprise()

    function SetSiteEntreprise ($SiteEntreprise)
    {
        $this->SiteEntreprise = $SiteEntreprise;

    } // SetSiteEntreprise()

    function Select()
    {
        global $NomTabEntreprises, $ConnectStages;

        $Req = Query ("SELECT * FROM $NomTabEntreprises  
		                   WHERE PK_Entreprise = $this->PK_Entreprise",
                  $ConnectStages);
        $Obj = mysql_fetch_object ($Req);

        if (! $Obj) return false;

        $this->SetIs_Valide         ($Obj->Is_Valide);
        $this->SetNomE              (stripslashes ($Obj->NomE));
        $this->SetCivilite          ($Obj->Civilite);
        $this->SetNomR              (stripslashes ($Obj->NomR));
        $this->SetPrenomR           (stripslashes ($Obj->PrenomR));
        $this->SetAdr1              (stripslashes ($Obj->Adr1));
        $this->SetAdr2              (stripslashes ($Obj->Adr2));
        $this->SetCP                ($Obj->CP);
        $this->SetVille             (stripslashes ($Obj->Ville));
        $this->SetTelR              ($Obj->TelR);
        $this->SetMailR             ($Obj->MailR);
        $this->SetFaxR              ($Obj->FaxR);
        $this->SetPresentEntreprise ($Obj->PresentEntreprise);
        $this->SetSiteEntreprise    ($Obj->SiteEntreprise);

        return true;

    } // Select()

    function Insert()
    {
        global $NomTabEntreprises, $ConnectStages;

        return Query ("INSERT INTO $NomTabEntreprises VALUES (
                NULL,
                 $this->Is_Valide,
                '".addslashes ($this->NomE)."',
                '$this->Civilite',
                '".addslashes ($this->NomR)."',
                '".addslashes ($this->PrenomR)."',
                '".addslashes ($this->Adr1)."',
                '".addslashes ($this->Adr2)."',
                '$this->CP',
                '".addslashes ($this->Ville)."',
                '$this->TelR',
                '$this->MailR',
                '$this->FaxR',
                '".addslashes ($this->PresentEntreprise)."',
                '".addslashes ($this->SiteEntreprise)."')",
                     $ConnectStages);

    } // Insert()

    function Delete()
    {
        global $NomTabEntreprises, $ConnectStages;

        return Query ("DELETE FROM $NomTabEntreprises 
		                   WHERE PK_Entreprise = $this->PK_Entreprise",
                     $ConnectStages);

    } // Delete()

    function Update ()
    {
        global $NomTabEntreprises, $ConnectStages;

        $Req = Query ("UPDATE $NomTabEntreprises 
		               SET 
                           Is_Valide         =  $this->Is_Valide,
                           NomE              = '".addslashes ($this->NomE)."',
                           Civilite          = '$this->Civilite',
                           NomR              = '".addslashes ($this->NomR)."',
                           PrenomR           = '".addslashes ($this->PrenomR)."',
                           Adr1              = '".addslashes ($this->Adr1)."',
                           Adr2              = '".addslashes ($this->Adr2)."',
                           CP                = '$this->CP',
                           Ville             = '".addslashes ($this->Ville)."',
                           TelR              = '$this->TelR',
                           MailR             = '$this->MailR',
                           FaxR              = '$this->FaxR',
                           PresentEntreprise = '".addslashes ($this->PresentEntreprise)."',
                           SiteEntreprise    = '".addslashes ($this->SiteEntreprise)."'

                           WHERE PK_Entreprise = $this->PK_Entreprise",
                  $ConnectStages);
    } // Update()

} // CEntreprise
?>
