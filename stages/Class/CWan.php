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
        global $ConnectStages, $NomTabReseauxPublics;

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

            $ReqTuple = $ConnectStages->query("SELECT * FROM  $NomTabReseauxPublics
                                    WHERE PK_Wan = '$PK_Wan'");
            $LeTuple = $ReqTuple->fetch();

            $this->Code    = $LeTuple['Code']    ;
            $this->Libelle = $LeTuple['Libelle'] ;
            $this->CodeBin = $LeTuple['CodeBin'] ;
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
        global $ConnectStages;

        $Req = $ConnectStages->query("SELECT * FROM $NomTabReseauxPublics  WHERE PK_Wan = $this->PK_Wan");
        $Obj = $Req->fetch();

        if (! $Obj) return false;

        $this->SetCode    ($Obj['Code']);
        $this->SetLibelle ($Obj['Libelle']);
        $this->SetCodeBin ($Obj['CodeBin']);

        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabReseauxPublics;
        
        return $ConnectStages->query("INSERT INTO $NomTabReseauxPublics VALUES (
                NULL,
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);");

    } // Insert()

    function Delete()
    {
        global $ConnectStages, $NomTabReseauxPublics;

        return $ConnectStages->query("DELETE FROM $NomTabReseauxPublics WHERE PK_Wan = $this->PK_Wan");

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabReseauxPublics;

        $ConnectStages->query("UPDATE $NomTabReseauxPublics SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 Libelle =  $this->CodeBin,

                           WHERE PK_Wan = $this->PK_Wan");

    } // Update()

} // CWan
?>
