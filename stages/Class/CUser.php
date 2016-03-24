<?php

// Fichier : CUser.php

class CUser
{
    var $PK_User;
    var $Login;
    var $PassWord;
    var $Status;
    var $Civilite;
    var $Nom;
    var $Prenom;
    var $Mail;
    var $Tel;
    var $Fax;
    var $FK_Entreprise;

    // Constructeur
    //=============

    function CUser ($PK_User = 0)
    {
        global $ConnectStages, $NomTabUsers;

        if (!isset ($PK_User) || $PK_User == 0)
        {
            $this->PK_User = 0;

            $this->Login              = '';
            $this->PassWord           = '';
            $this->Status             = TUTEUR;
            $this->Civilite           = 'M';
            $this->Nom                = '';
            $this->Prenom             = '';
            $this->Mail               = '';
            $this->Tel                = '00 00 00 00 00';
            $this->Fax                = '';
            $this->FK_Entreprise      = 0;
        }
        else
        {
            $this->PK_User = $PK_User;

            $ReqTuple = $ConnectStages->query("SELECT * FROM  $NomTabUsers
                                    WHERE PK_User = '$PK_User'");
            $LeTuple = $ReqTuple->fetch();

            $this->Login         = $LeTuple['Login']    ;
            $this->PassWord      = $LeTuple['PassWord'] ;
            $this->Status        = $LeTuple['Status']   ;
            $this->Civilite      = $LeTuple['Civilite'] ;
            $this->Nom           = stripslashes ($LeTuple['Nom']);
            $this->Prenom        = stripslashes ($LeTuple['Prenom']);
            $this->Mail          = $LeTuple['Mail']     ;
            $this->Tel           = $LeTuple['Tel']      ;
            $this->Fax           = $LeTuple['Fax']      ;
            $this->FK_Entreprise = $LeTuple['FK_Entreprise']      ;
        }

    } // CUser()

    // Accesseurs
    //===========

    function GetPK_User            () { return $this->PK_User  ; }
    function GetLogin              () { return $this->Login    ; }
    function GetPassWord           () { return $this->PassWord ; }
    function GetStatus             () { return $this->Status   ; }
    function GetCivilite           () { return $this->Civilite ; }
    function GetNom                () { return $this->Nom      ; }
    function GetPrenom             () { return $this->Prenom   ; }
    function GetMail               () { return $this->Mail     ; }
    function GetTel                () { return $this->Tel      ; }
    function GetFax                () { return $this->Fax      ; }
    function GetFK_Entreprise      () { return $this->FK_Entreprise      ; }

    // Modifieurs
    //=============


    function SetPK_User ($PK_User)
    {
        $this->PK_User = $PK_User;

    } // SetPK_User()

    function SetLogin ($Login)
    {
        $this->Login = $Login;

    } // SetLogin()

    function SetPassWord ($PassWord)
    {
        $this->PassWord = $PassWord;

    } // SetPassWord()

    function SetStatus ($Status)
    {
        $this->Status = $Status;

    } // SetStatus()

    function SetCivilite ($Civilite)
    {
        $this->Civilite = $Civilite;

    } // SetCivilite()

    function SetNom ($Nom)
    {
        $this->Nom = $Nom;

    } // SetNom()

    function SetPrenom ($Prenom)
    {
        $this->Prenom = $Prenom;

    } // SetPrenom()

    function SetMail ($Mail)
    {
        $this->Mail = $Mail;

    } // SetMail()

    function SetTel ($Tel)
    {
        $this->Tel = $Tel;

    } // SetTel()

    function SetFax ($Fax)
    {
        $this->Fax = $Fax;

    } // SetFax()
    
    function SetFK_Entreprise ($FK_Entreprise)
    {
        $this->FK_Entreprise = $FK_Entreprise;

    } // SetFK_Entreprise()


    function Select()
    {
        global $ConnectStages, $NomTabUsers;

        $Req = $ConnectStages->query("SELECT * FROM $NomTabUsers  WHERE PK_User = $this->PK_User");
        $Obj = $Req->fetch();

        if (! $Obj) return false;

        $this->SetLogin             ($Obj['Login']);
        $this->SetPassWord          ($Obj['PassWord']);
        $this->SetStatus            ($Obj['Status']);
        $this->SetCivilite          ($Obj['Civilite']);
        $this->SetNom               (stripslashes ($Obj['Nom']));
        $this->SetPrenom            (stripslashes ($Obj['Prenom']));
        $this->SetMail              ($Obj['Mail']);
        $this->SetTel               ($Obj['Tel']);
        $this->SetFax               ($Obj['Fax']);
        $this->SetFK_Entreprise     ($Obj['FK_Entreprise']);

        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabUsers;

        return $ConnectStages->query("INSERT INTO $NomTabUsers VALUES (
                NULL,
                '$this->Login',
                '$this->PassWord',
                '$this->Status',
                '$this->Civilite',
                '".addslashes ($this->Nom)."',
                '".addslashes ($this->Prenom)."',
                '$this->Mail',
                '$this->Tel' ,
                '$this->Fax',
                 $this->FK_Entreprise);");

    } // Insert()

    function Delete()
    {
        global $ConnectStages, $NomTabUsers;

        return $ConnectStages->query("DELETE FROM $NomTabUsers WHERE PK_User = $this->PK_User");

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabUsers;

        $Req = $ConnectStages->query("UPDATE $NomTabUsers SET 
                                 Login         = '$this->Login',
                                 PassWord      = '$this->PassWord',
                                 Status        = '$this->Status',
                                 Civilite      = '$this->Civilite',
                                 Nom           = '".addslashes ($this->Nom)."',
                                 Prenom        = '".addslashes ($this->Prenom)."',
                                 Mail          = '$this->Mail',
                                 Tel           = '$this->Tel',
                                 Fax           = '$this->Fax',
                                 FK_Entreprise =  $this->FK_Entreprise

                           WHERE PK_User = $this->PK_User");

    } // Update()

} // CUsers
?>
