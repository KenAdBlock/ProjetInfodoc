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
        global $Connexion, $NomTabLangage;

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

            $ReqTuple = Query ("SELECT * FROM  $NomTabLangage
                                    WHERE PK_Langage = '$PK_Langage'",
                               $Connexion);
            $LeTuple = mysql_fetch_object ($ReqTuple);

            $this->Code    = $LeTuple->Code    ;
            $this->Libelle = $LeTuple->Libelle ;
            $this->CodeBin = $LeTuple->CodeBin ;
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
        global $Connexion, $NomTabLangage;

        $Req = Query ("SELECT * FROM $NomTabLangage  WHERE PK_Langage = $this->PK_Langage",
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
        global $Connexion, $NomTabLangage;
        
        return Query ("INSERT INTO $NomTabLangage VALUES (
                NULL,
                '$this->Code',
                '$this->Libelle',
                 $this->CodeBin);",
                     $Connexion);

    } // Insert()

    function Delete()
    {
        global $Connexion, $NomTabLangage;

        return Query ("DELETE FROM $NomTabLangage WHERE PK_Langage = $this->PK_Langage",
                     $Connexion);

    } // Delete()

    function Update ()
    {
        global $Connexion, $NomTabLangage;
        
        $Req = Query ("UPDATE $NomTabLangage SET 
                                 Code    = '$this->Code',
                                 Libelle = '$this->Libelle',
                                 Libelle =  $this->CodeBin,

                           WHERE PK_Langage = $this->PK_Langage",
                  $Connexion);

    } // Update()

} // CLangage
?>
