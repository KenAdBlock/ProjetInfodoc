<?php

// Fichier : CLangage.php

class CLangage
{
    var $PK_Langage;
    var $Code;
    var $Libelle;
    var $CodeBin;
	
    // Constructeur
    //=============

    function CLangage ($PK_Langage = 0)
    {
        global $ConnectStages, $NomTabLangage;

        if (!isset ($PK_Langage) || $PK_Langage == 0)
        {
            $this->PK_Langage   = 0;

            $this->Code    = '';
            $this->Libelle = '';
            $this->CodeBin = 0;
        }
        else
        {
            $this->PK_Langage = $PK_Langage;

            $ReqTuple = $ConnectStages->query("SELECT * FROM  $NomTabLangage
                                    WHERE PK_Langage = '$PK_Langage'");
            $LeTuple = $ReqTuple->fetch();

            $this->Code    = $LeTuple['Code']    ;
            $this->Libelle = $LeTuple['Libelle'] ;
            $this->CodeBin = $LeTuple['CodeBin'] ;
        }

    } // CLangage()

    // Accesseurs
    //===========

    function GetPK_Langage   () { return $this->PK_Langage  ; }
    function GetCode    () { return $this->Code    ; }
    function GetLibelle () { return $this->Libelle ; }
    function GetCodeBin () { return $this->CodeBin ; }

    // Modifieurs
    //=============


    function SetPK_Langage ($PK_Langage)
    {
        $this->PK_Langage = $PK_Langage;

    } // SetPK_Langage()

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
        global $ConnectStages, $NomTabLangage;

        $Req = $ConnectStages->query("SELECT * FROM $NomTabLangage  WHERE PK_Langage = $this->PK_Langage");
        $Obj = $Req->fetch();

        if (! $Obj) return false;

        $this->SetCode    ($Obj['Code']);
        $this->SetLibelle ($Obj['Libelle']);
        $this->SetCodeBin ($Obj['CodeBin']);

        return true;

    } // Select()

    function Insert()
    {
        global $ConnectStages, $NomTabLangage;
        
        return $ConnectStages->query("INSERT INTO $NomTabLangage VALUES (
                NULL,
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);");

    } // Insert()

    function Delete()
    {
        global $ConnectStages, $NomTabLangage;

        return $ConnectStages->query("DELETE FROM $NomTabLangage WHERE PK_Langage = $this->PK_Langage");

    } // Delete()

    function Update ()
    {
        global $ConnectStages, $NomTabLangage;
        
        $Req = $ConnectStages->query("UPDATE $NomTabLangage SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 Libelle =  $this->CodeBin,
                           WHERE PK_Langage = $this->PK_Langage");

    } // Update()

} // CLangage
?>
