<?php

// Fichier : CWan.php

class CWan
{
    var $PK_Wan;
    var $Code;
    var $Libelle;
    var $CodeBin;

    // Constructeur
    //=============

    function CWan ($PK_Wan = 0)
    {
        global $Connexion;

        if (!isset ($PK_Wan) || $PK_Wan == 0)
        {
            $this->PK_Wan  = 0;

            $this->Code    = '';
            $this->Libelle = '';
            $this->CodeBin = 0;
        }
        else
        {
            $this->PK_Wan = $PK_Wan;

            $ReqTuple = Query ("SELECT * FROM  $NomTabReseauxPublics
                                    WHERE PK_Wan = '$PK_Wan'",
                               $Connexion);
            $LeTuple = mysql_fetch_object ($ReqTuple);

            $this->Code    = $LeTuple->Code    ;
            $this->Libelle = $LeTuple->Libelle ;
            $this->CodeBin = $LeTuple->CodeBin ;
       }

    } // CWan()

    // Accesseurs
    //===========

    function GetPK_Wan  () { return $this->PK_Wan  ; }
    function GetCode    () { return $this->Code    ; }
    function GetLibelle () { return $this->Libelle ; }
    function GetCodeBin () { return $this->CodeBin ; }

    // Modifieurs
    //=============


    function SetPK_Wan ($PK_Wan)
    {
        $this->PK_Wan = $PK_Wan;

    } // SetPK_Wan()

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

        $Req = Query ("SELECT * FROM $NomTabReseauxPublics  WHERE PK_Wan = $this->PK_Wan",
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
        
        return Query ("INSERT INTO $NomTabReseauxPublics VALUES (
                '',
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);",
                     $Connexion);

    } // Insert()

    function Delete()
    {
        global $Connexion;

        return Query ("DELETE FROM $NomTabReseauxPublics WHERE PK_Wan = $this->PK_Wan",
                     $Connexion);

    } // Delete()

    function Update ()
    {
        global $Connexion;
        
        $Req = Query ("UPDATE $NomTabReseauxPublics SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 Libelle =  $this->CodeBin,

                           WHERE PK_Wan = $this->PK_Wan",
                  $Connexion);

    } // Update()

} // CWan
?>
