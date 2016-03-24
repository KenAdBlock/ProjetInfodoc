<?php

// Fichier : COperatingSystem.php

class COperatingSystem
{
    var $PK_OS;
    var $Code;
    var $Libelle;
	var $CodeBin;

    // Constructeur
    //=============

    function COperatingSystem ($PK_OS = 0)
    {
        global $ConnectStages, $NomTabOS;

        if (!isset ($PK_OS) || $PK_OS == 0)
        {
            $this->PK_OS   = 0;

            $this->Code    = '';
            $this->Libelle = '';
			$this->CodeBin = 0;
        }
        else
        {
            $this->PK_OS = $PK_OS;

            $ReqTuple = $ConnectStages->query("SELECT * FROM  $NomTabOS
                                    WHERE PK_OS = '$PK_OS'");
            $LeTuple = $ReqTuple->fetch();

            $this->Code    = $LeTuple['Code']    ;
            $this->Libelle = $LeTuple['Libelle']     ;
            $this->CodeBin = $LeTuple['CodeBin']     ;
        }

    } // COperatingSystem()

    // Accesseurs
    //===========

    function GetPK_OS   () { return $this->PK_OS   ; }
    function GetCode    () { return $this->Code    ; }
    function GetLibelle () { return $this->Libelle ; }
    function GetCodeBin () { return $this->CodeBin ; }

    // Modifieurs
    //=============


    function SetPK_OS ($PK_OS)
    {
        $this->PK_OS = $PK_OS;

    } // SetPK_OS()

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
        global $ConnectStages, $NomTabOS;

        $Req = $ConnectStages->query("SELECT * FROM $NomTabOS  WHERE PK_OS = $this->PK_OS");
        $Obj = $Req->fetch();

        if (! $Obj) return false;

        $this->SetCode    ($Obj['Code']);
        $this->SetLibelle ($Obj['Libelle']);
        $this->SetCodeBin ($Obj['CodeBin']);

        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabOS;
        
        return $ConnectStages->query("INSERT INTO $NomTabOS VALUES (
                NULL,
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);");

    } // Insert()

    function Delete()
    {
        global $ConnectStages, $NomTabOS;

        return $ConnectStages->query("DELETE FROM $NomTabOS WHERE PK_OS = $this->PK_OS");

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabOS;
        
        $Req = $ConnectStages->query("UPDATE $NomTabOS SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 CodeBin =  $this->CodeBin,

                           WHERE PK_OS = $this->PK_OS");

    } // Update()

} // COperatingSystem
?>
