<?php

// Fichier : CLan.php

class CLan
{
    var $PK_Lan;
    var $Code;
    var $Libelle;
    var $CodeBin;

    // Constructeur
    //=============

    function CLan ($PK_Lan = 0)
    {
        global $Connexion;

        if (!isset ($PK_Lan) || $PK_Lan == 0)
        {
            $this->PK_Lan   = 0;

            $this->Code    = '';
            $this->Libelle = '';
            $this->CodeBin = 0;
        }
        else
        {
            $this->PK_Lan = $PK_Lan;

            $ReqTuple = Query ("SELECT * FROM  $NomTabReseauxLocaux
                                    WHERE PK_Lan = '$PK_Lan'",
                               $Connexion);
            $LeTuple = mysql_fetch_object ($ReqTuple);

            $this->Code    = $LeTuple->Code    ;
            $this->Libelle = $LeTuple->Libelle ;
            $this->CodeBin = $LeTuple->CodeBin ;
        }

    } // CLan()

    // Accesseurs
    //===========

    function GetPK_Lan   () { return $this->PK_Lan  ; }
    function GetCode    () { return $this->Code    ; }
    function GetLibelle () { return $this->Libelle ; }
    function GetCodeBin () { return $this->CodeBin ; }

    // Modifieurs
    //=============


    function SetPK_Lan ($PK_Lan)
    {
        $this->PK_Lan = $PK_Lan;

    } // SetPK_Lan()

    function SetCode ($Code)
    {
        $this->Code = $Code;

    } // SetCode()

    function SetLibelle ($Libelle)
    {
        $this->Libelle = $Libelle;

    } // SetLibelle()

    function SetCodeBin ($CodeBin)
    {
        $this->CodeBin = $CodeBin;

    } // SetCodeBin()

    function Select()
    {
        global $Connexion;

        $Req = Query ("SELECT * FROM $NomTabReseauxLocaux  WHERE PK_Lan = $this->PK_Lan",
                  $Connexion);
        $Obj = mysql_fetch_object ($Req);

        if (! $Obj) return false;

        $this->SetCode    ($Obj->Code);
        $this->SetLibelle ($Obj->Libelle);
        $this->SetCodeBin ($Obj->CodeBin);

        return true;

    } // Select()

    function Insert()
    {
        global $Connexion;
        
        return Query ("INSERT INTO $NomTabReseauxLocaux VALUES (
                '',
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);",
                     $Connexion);

    } // Insert()

    function Delete()
    {
        global $Connexion;

        return Query ("DELETE FROM $NomTabReseauxLocaux WHERE PK_Lan = $this->PK_Lan",
                     $Connexion);

    } // Delete()

    function Update ()
    {
        global $Connexion;
        
        $Req = Query ("UPDATE $NomTabReseauxLocaux SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 CodeBin =  $this->CodeBin,

                           WHERE PK_Lan = $this->PK_Lan",
                  $Connexion);

    } // Update()

} // CLan
?>
