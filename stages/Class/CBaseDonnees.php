<?php

// Fichier : CBaseDonnees.php

class CBaseDonnees
{
    var $PK_BD;
    var $Code;
    var $Libelle;
    var $CodeBin;

    // Constructeur
    //=============

    function CBaseDonnees ($PK_BD = 0)
    {
        global $Connexion, $NomTabBasesDonnees;

        if (!isset ($PK_BD) || $PK_BD == 0)
        {
            $this->PK_BD   = 0;

            $this->Code    = '';
            $this->Libelle = '';
            $this->CodeBin = 0;
        }
        else
        {
            $this->PK_BD = $PK_BD;

            $ReqTuple = Query ("SELECT * FROM  $NomTabBasesDonnees
                                    WHERE PK_BD = '$PK_BD'",
                               $Connexion);
            $LeTuple = mysql_fetch_object ($ReqTuple);

            $this->Code    = $LeTuple->Code    ;
            $this->Libelle = $LeTuple->Libelle ;
            $this->CodeBin = $LeTuple->CodeBin ;
        }

    } // CBaseDonnees()

    // Accesseurs
    //===========

    function GetPK_BD   () { return $this->PK_BD   ; }
    function GetCode    () { return $this->Code    ; }
    function GetLibelle () { return $this->Libelle ; }
    function GetCodeBin () { return $this->CodeBin ; }

    // Modifieurs
    //=============


    function SetPK_BD ($PK_BD)
    {
        $this->PK_BD = $PK_BD;

    } // SetPK_BD()

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
        global $Connexion, $NomTabBasesDonnees;

        $Req = Query ("SELECT * FROM $NomTabBasesDonnees  WHERE PK_BD = $this->PK_BD",
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
        global $Connexion, $NomTabBasesDonnees;
        
        return Query ("INSERT INTO $NomTabBasesDonnees VALUES (
                NULL,
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);",
                     $Connexion);

    } // Insert()

    function Delete()
    {
        global $Connexion, $NomTabBasesDonnees;

        return Query ("DELETE FROM $NomTabBasesDonnees WHERE PK_BD = $this->PK_BD",
                     $Connexion);

    } // Delete()

    function Update ()
    {
        global $Connexion, $NomTabBasesDonnees;
        
        $Req = Query ("UPDATE $NomTabBasesDonnees SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 Libelle =  $this->CodeBin,

                           WHERE PK_BD = $this->PK_BD",
                  $Connexion);

    } // Update()

} // CBaseDonnees
?>
