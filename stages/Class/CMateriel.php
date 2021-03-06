<?php

// Fichier : CMateriel.php

class CMateriel
{
    var $PK_Materiel;
    var $Code;
    var $Libelle;
    var $CodeBin;

    // Constructeur
    //=============

    function CMateriel ($PK_Materiel = 0)
    {
        global $ConnectStages, $NomTabMateriels;

        if (!isset ($PK_Materiel) || $PK_Materiel == 0)
        {
            $this->PK_Materiel   = 0;

            $this->Code    = '';
            $this->Libelle = '';
            $this->CodeBin = 0;
        }
        else
        {
            $this->PK_Materiel = $PK_Materiel;

            $ReqTuple = $ConnectStages->query("SELECT * FROM  $NomTabMateriels
                                    WHERE PK_Materiel = '$PK_Materiel'");
            $LeTuple = $ReqTuple->fetch();

            $this->Code    = $LeTuple['Code']   ;
            $this->Libelle = $LeTuple['Libelle'] ;
            $this->CodeBin = $LeTuple['CodeBin'] ;
        }

    } // CMateriel()

    // Accesseurs
    //===========

    function GetPK_Materiel   () { return $this->PK_Materiel  ; }
    function GetCode    () { return $this->Code    ; }
    function GetLibelle () { return $this->Libelle ; }
    function GetCodeBin () { return $this->CodeBin ; }

    // Modifieurs
    //=============

    function SetPK_Materiel ($PK_Materiel)
    {
        $this->PK_Materiel = $PK_Materiel;

    } // SetPK_Materiel()

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
        global $ConnectStages, $NomTabMateriels;

        $Req = $ConnectStages->query("SELECT * FROM $NomTabMateriels  WHERE PK_Materiel = $this->PK_Materiel");
        $Obj = $Req->fetch();

        if (! $Obj) return false;

        $this->SetCode    ($Obj['Code']);
        $this->SetLibelle ($Obj['Libelle']);
        $this->SetCodeBin ($Obj['CodeBin']);

        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabMateriels;
        
        return $ConnectStages->query("INSERT INTO $NomTabMateriels VALUES (
                NULL,
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);");

    } // Insert()

    function Delete()
    {
        global $ConnectStages, $NomTabMateriels;

        return $ConnectStages->query("DELETE FROM $NomTabMateriels WHERE PK_Materiel = $this->PK_Materiel");

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabMateriels;
        
        $Req = $ConnectStages->query("UPDATE $NomTabMateriels SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 CodeBin =  $this->CodeBin,
                           WHERE PK_Materiel = $this->PK_Materiel");

    } // Update()

} // CMateriel
?>
