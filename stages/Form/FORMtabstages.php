<?php

    session_start();
    include ('Class/CStage.php');

    // Récupération des variables envoyées par POST ou GET

    foreach ($_GET  as $clef => $valeur) $$clef = $valeur;
    foreach ($_POST as $clef => $valeur) $$clef = $valeur;
    if (!isset ($Step))
        $Step = isset ($IdentPK) && $IdentPK != 0 ? 'InitModif' : 'InitNew';
    switch ($Step)
    {
      case 'InitModif' :
        // Récupération de l'enreg. à modifier

        $ObjTuple = new CStage ($IdentPK);
        $ValPK_Stage = $ObjTuple->GetPK_Stage();
        $ValidPK_Stage = ESPACE;
        $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
        $ValidFK_Entreprise = ESPACE;
        $ValMateriel = $ObjTuple->GetMateriel();
        $ValidMateriel = ESPACE;
        $ValResLocaux = $ObjTuple->GetResLocaux();
        $ValidResLocaux = ESPACE;
        $ValAutresRL = $ObjTuple->GetAutresRL();
        $ValidAutresRL = ESPACE;
        $ValResPublics = $ObjTuple->GetResPublics();
        $ValidResPublics = ESPACE;
        $ValAutresRP = $ObjTuple->GetAutresRP();
        $ValidAutresRP = ESPACE;
        $ValLangages = $ObjTuple->GetLangages();
        $ValidLangages = ESPACE;
        $ValAutresL = $ObjTuple->GetAutresL();
        $ValidAutresL = ESPACE;
        $ValSystExpl = $ObjTuple->GetSystExpl();
        $ValidSystExpl = ESPACE;
        $ValVersionSE = $ObjTuple->GetVersionSE();
        $ValidVersionSE = ESPACE;
        $ValAutresSE = $ObjTuple->GetAutresSE();
        $ValidAutresSE = ESPACE;
        $ValBasesD = $ObjTuple->GetBasesD();
        $ValidBasesD = ESPACE;
        $ValAutresBD = $ObjTuple->GetAutresBD();
        $ValidAutresBD = ESPACE;
        $ValAtGL = $ObjTuple->GetAtGL();
        $ValidAtGL = ESPACE;
        $ValMA = $ObjTuple->GetMA();
        $ValidMA = ESPACE;
        $ValMCpt = $ObjTuple->GetMCpt();
        $ValidMCpt = ESPACE;
        $ValMP = $ObjTuple->GetMP();
        $ValidMP = ESPACE;
        $ValMCtrl = $ObjTuple->GetMCtrl();
        $ValidMCtrl = ESPACE;
        $ValMGP = $ObjTuple->GetMGP();
        $ValidMGP = ESPACE;
        $ValSujet = $ObjTuple->GetSujet();
        $ValidSujet = ESPACE;
        $ValProg = $ObjTuple->GetProg();
        $ValidProg = ESPACE;
        $ValAnalyse = $ObjTuple->GetAnalyse();
        $ValidAnalyse = ESPACE;
        $ValPG = $ObjTuple->GetPG();
        $ValidPG = ESPACE;
        $ValEI = $ObjTuple->GetEI();
        $ValidEI = ESPACE;
        $ValRqs = $ObjTuple->GetRqs();
        $ValidRqs = ESPACE;
        $ValNPCI = $ObjTuple->GetNPCI();
        $ValidNPCI = ESPACE;
        $ValSTAG = $ObjTuple->GetSTAG();
        $ValidSTAG = ESPACE;
        $ValNbStag = $ObjTuple->GetNbStag();
        $ValidNbStag = ESPACE;
        $ValNbPS = $ObjTuple->GetNbPS();
        $ValidNbPS = ESPACE;
        $ValSEUL = $ObjTuple->GetSEUL();
        $ValidSEUL = ESPACE;
        $ValCOLLAB = $ObjTuple->GetCOLLAB();
        $ValidCOLLAB = ESPACE;
        $ValIST = $ObjTuple->GetIST();
        $ValidIST = ESPACE;
        $ValMIS = $ObjTuple->GetMIS();
        $ValidMIS = ESPACE;
        $ValIR = $ObjTuple->GetIR();
        $ValidIR = ESPACE;
        $ValMIR = $ObjTuple->GetMIR();
        $ValidMIR = ESPACE;
        $ValIT = $ObjTuple->GetIT();
        $ValidIT = ESPACE;
        $ValMIT = $ObjTuple->GetMIT();
        $ValidMIT = ESPACE;
        $ValMT = $ObjTuple->GetMT();
        $ValidMT = ESPACE;
        $ValMMT = $ObjTuple->GetMMT();
        $ValidMMT = ESPACE;
        $ValEmb = $ObjTuple->GetEmb();
        $ValidEmb = ESPACE;
        $ValTut = $ObjTuple->GetFK_User();
        break;

      case 'InitNew' :
        // Préparation du nouvel enreg.

        $ObjTuple = new CStage ();
        $ValPK_Stage = $ObjTuple->GetPK_Stage();
        $ValidPK_Stage = ESPACE;
        $ValFK_Entreprise = $ObjTuple->GetFK_Entreprise();
        $ValidFK_Entreprise = ESPACE;
        $ValMateriel = $ObjTuple->GetMateriel();
        $ValidMateriel = ESPACE;
        $ValResLocaux = $ObjTuple->GetResLocaux();
        $ValidResLocaux = ESPACE;
        $ValAutresRL = $ObjTuple->GetAutresRL();
        $ValidAutresRL = ESPACE;
        $ValResPublics = $ObjTuple->GetResPublics();
        $ValidResPublics = ESPACE;
        $ValAutresRP = $ObjTuple->GetAutresRP();
        $ValidAutresRP = ESPACE;
        $ValLangages = $ObjTuple->GetLangages();
        $ValidLangages = ESPACE;
        $ValAutresL = $ObjTuple->GetAutresL();
        $ValidAutresL = ESPACE;
        $ValSystExpl = $ObjTuple->GetSystExpl();
        $ValidSystExpl = ESPACE;
        $ValVersionSE = $ObjTuple->GetVersionSE();
        $ValidVersionSE = ESPACE;
        $ValAutresSE = $ObjTuple->GetAutresSE();
        $ValidAutresSE = ESPACE;
        $ValBasesD = $ObjTuple->GetBasesD();
        $ValidBasesD = ESPACE;
        $ValAutresBD = $ObjTuple->GetAutresBD();
        $ValidAutresBD = ESPACE;
        $ValAtGL = $ObjTuple->GetAtGL();
        $ValidAtGL = ESPACE;
        $ValMA = $ObjTuple->GetMA();
        $ValidMA = ESPACE;
        $ValMCpt = $ObjTuple->GetMCpt();
        $ValidMCpt = ESPACE;
        $ValMP = $ObjTuple->GetMP();
        $ValidMP = ESPACE;
        $ValMCtrl = $ObjTuple->GetMCtrl();
        $ValidMCtrl = ESPACE;
        $ValMGP = $ObjTuple->GetMGP();
        $ValidMGP = ESPACE;
        $ValSujet = $ObjTuple->GetSujet();
        $ValidSujet = ESPACE;
        $ValProg = $ObjTuple->GetProg();
        $ValidProg = ESPACE;
        $ValAnalyse = $ObjTuple->GetAnalyse();
        $ValidAnalyse = ESPACE;
        $ValPG = $ObjTuple->GetPG();
        $ValidPG = ESPACE;
        $ValEI = $ObjTuple->GetEI();
        $ValidEI = ESPACE;
        $ValRqs = $ObjTuple->GetRqs();
        $ValidRqs = ESPACE;
        $ValNPCI = $ObjTuple->GetNPCI();
        $ValidNPCI = ESPACE;
        $ValSTAG = $ObjTuple->GetSTAG();
        $ValidSTAG = ESPACE;
        $ValNbStag = $ObjTuple->GetNbStag();
        $ValidNbStag = ESPACE;
        $ValNbPS = $ObjTuple->GetNbPS();
        $ValidNbPS = ESPACE;
        $ValSEUL = $ObjTuple->GetSEUL();
        $ValidSEUL = ESPACE;
        $ValCOLLAB = $ObjTuple->GetCOLLAB();
        $ValidCOLLAB = ESPACE;
        $ValIST = $ObjTuple->GetIST();
        $ValidIS = ESPACE;
        $ValMIS = $ObjTuple->GetMIS();
        $ValidMIS = ESPACE;
        $ValIR = $ObjTuple->GetIR();
        $ValidIR = ESPACE;
        $ValMIR = $ObjTuple->GetMIR();
        $ValidMIR = ESPACE;
        $ValIT = $ObjTuple->GetIT();
        $ValidIT = ESPACE;
        $ValMIT = $ObjTuple->GetMIT();
        $ValidMIT = ESPACE;
        $ValMT = $ObjTuple->GetMT();
        $ValidMT = ESPACE;
        $ValMMT = $ObjTuple->GetMMT();
        $ValidMMT = ESPACE;
        $ValEmb = $ObjTuple->GetEmb();
        $ValidEmb = ESPACE;
        
        $ValTut= $_SESSION['Login'];
        break;

      case 'Valid' :
        $CodErrVide  = array();
        $CodErrInval = array();
        $ValPK_Stage = $PK_Stage;
        if (trim ($ValPK_Stage) == '')
        {
            array_push ($CodErrVide, 'PK_Stage');
            $ValidPK_Stage = FLECHE;
        }
        else
        $ValidPK_Stage = ESPACE;
        
        $ValFK_Entreprise = $FK_Entreprise;
        if (trim ($ValFK_Entreprise) == '')
        {
            array_push ($CodErrVide, 'FK_Entreprise');
            $ValidFK_Entreprise = FLECHE;
        }
        else
            $ValidFK_Entreprise = ESPACE;
            
        //ici, un exemple de récupération des valeurs des checkboxs,
        //chaque checkbox vaut une puissance de 2 (1,2,4,8,...) et est
        //donc ajoutée pour ne faire qu'une valeur.
        $ValMateriel = $_REQUEST[GMS]+$_REQUEST[ST]+$_REQUEST[Micro];
        if (trim ($ValMateriel) == '0')
        {
            array_push ($CodErrVide, 'Materiel');
            $ValidMateriel = FLECHE;
        }
        else
            $ValidMateriel = ESPACE;
        $ValResLocaux = $_REQUEST[Eth]+$_REQUEST[Nov]+$_REQUEST[NT]+$_REQUEST[LM];
        $ValAutresRL = $AutresRL;
        if ((trim ($ValResLocaux) == '0')&&(trim ($ValAutresRL)==''))
        {
            array_push ($CodErrVide, 'ResLocaux');
            $ValidResLocaux = FLECHE;
        }
        else
            $ValidResLocaux = ESPACE;
        $ValResPublics = $_REQUEST[It]+$_REQUEST[Tp];
        if (trim ($ValResPublics) == '0')
        {
            array_push ($CodErrVide, 'ResPublics');
            $ValidResPublics = FLECHE;
        }
        else
            $ValidResPublics = ESPACE;
        $ValAutresRP = $AutresRP;
        $ValLangages =
        $_REQUEST[Cpp]+$_REQUEST[Ada]+$_REQUEST[Java]+$_REQUEST[Perl]+$_REQUEST[Delphi]+$_REQUEST[Php];
        if (trim ($ValLangages) == '0')
        {
            array_push ($CodErrVide, 'Langages');
            $ValidLangages = FLECHE;
        }
        else
            $ValidLangages = ESPACE;
        $ValAutresL = $AutresL;
        $ValSystExpl = $_REQUEST[unix]+$_REQUEST[VM]+$_REQUEST[VMS]+$_REQUEST[OS]+$_REQUEST[win];
        if (trim ($ValSystExpl) == '0')
        {
            array_push ($CodErrVide, 'SystExpl');
            $ValidSystExpl = FLECHE;
        }
        else
            $ValidSystExpl = ESPACE;
        $ValVersionSE = $VersionSE;
        $ValAutresSE = $AutresSE;
        $ValBasesD =
        $_REQUEST[Syb]+$_REQUEST[Ing]+$_REQUEST[Mysql]+$_REQUEST[Oracle];
        if (trim ($ValBasesD) == '0')
        {
            array_push ($CodErrVide, 'BasesD');
            $ValidBasesD = FLECHE;
        }
        else
            $ValidBasesD = ESPACE;
        $ValAutresBD = $AutresBD;
        $ValAtGL = $AtGL;
        $ValMA = $MA;
        $ValMCpt = $MCpt;
        $ValMP = $MP;
        $ValMCtrl = $MCtrl;
        $ValMGP = $MGP;
        $ValSujet = $Sujet;
        if (trim ($ValSujet) == '')
        {
            array_push ($CodErrVide, 'Sujet');
            $ValidSujet = FLECHE;
        }
        else
            $ValidSujet = ESPACE;
        $ValProg = $_REQUEST[Prog];
        if (!$ValProg) $ValProg=0;
        $ValAnalyse = $_REQUEST[Anal];;
        if (!$ValAnalyse) $ValAnalyse=0;
        $ValPG = $_REQUEST[PG];
        if (!$ValPG) $ValPG=0;
        $ValEI = $_REQUEST[EI];
        if (!$ValEI) $ValEI=0;
        $ValRqs = $Rqs;
        $ValNPCI = $NPCI;
        if (trim ($ValNPCI) == '')
        {
            array_push ($CodErrVide, 'NPCI');
            $ValidNPCI = FLECHE;
        }
        else
            $ValidNPCI = ESPACE;
        $ValSTAG = $_REQUEST[STAG];
        if (!$ValSTAG) $ValSTAG = 0;
        $ValNbStag = $NbStag;
        if (trim ($ValNbStag) == '')
        {
            array_push ($CodErrVide, 'NbStag');
            $ValidNbStag = FLECHE;
        }
        else
            $ValidNbStag = ESPACE;
        $ValNbPS = $NbPS;
        if (trim ($ValNbPS) == '')
        {
            array_push ($CodErrVide, 'NbPS');
            $ValidNbPS = FLECHE;
        }
        else
            $ValidNbPS = ESPACE;
        $ValSEUL = $_REQUEST[SEUL];
        if (!$ValSEUL) $ValSEUL=0;
        $ValCOLLAB = $_REQUEST[Coll];
        if (!$ValCOLLAB) $ValCOLLAB=0;
        $ValIST = $_REQUEST[IST];
        if (!$ValIST) $ValIST=0;
        $ValMIS = $MIS;
        $ValIR = $_REQUEST[IR];
        if (!$ValIR) $ValIR=0;
        $ValMIR = $MIR;
        $ValIT = $_REQUEST[IT];
        if (!$ValIT) $ValIT=0;
        $ValMIT = $MIT;
        $ValMT = $_REQUEST[MT];
        if (!$ValMT) $ValMT=0;
        $ValMMT = $MMT;
        $ValEmb = $_REQUEST[Emb];
        if (!$ValEmb) $ValEmb=0;
        $Fleche=FLECHE;

        $ValTut = $_SESSION['Login'];
        
        if (!$CodErrVide && !$CodErrInval)
        {
            print ('<h1>Enregistrer</h1>');
            // Préparation de l'enreg. à enregistrer
            $ObjTuple = new CStage ();
            $ObjTuple->SetPK_Stage($ValPK_Stage);
            $ObjTuple->SetFK_Entreprise($ValFK_Entreprise);
            $ObjTuple->SetMateriel($ValMateriel);
            $ObjTuple->SetResLocaux($ValResLocaux);
            $ObjTuple->SetAutresRL($ValAutresRL);
            $ObjTuple->SetResPublics($ValResPublics);
            $ObjTuple->SetAutresRP($ValAutresRP);
            $ObjTuple->SetLangages($ValLangages);
            $ObjTuple->SetAutresL($ValAutresL);
            $ObjTuple->SetSystExpl($ValSystExpl);
            $ObjTuple->SetVersionSE($ValVersionSE);
            $ObjTuple->SetAutresSE($ValAutresSE);
            $ObjTuple->SetBasesD($ValBasesD);
            $ObjTuple->SetAutresBD($ValAutresBD);
            $ObjTuple->SetAtGL($ValAtGL);
            $ObjTuple->SetMA($ValMA);
            $ObjTuple->SetMCpt($ValMCpt);
            $ObjTuple->SetMP($ValMP);
            $ObjTuple->SetMCtrl($ValMCtrl);
            $ObjTuple->SetMGP($ValMGP);
            $ObjTuple->SetSujet($ValSujet);
            $ObjTuple->SetProg($ValProg);
            $ObjTuple->SetAnalyse($ValAnalyse);
            $ObjTuple->SetPG($ValPG);
            $ObjTuple->SetEI($ValEI);
            $ObjTuple->SetRqs($ValRqs);
            $ObjTuple->SetNPCI($ValNPCI);
            $ObjTuple->SetSTAG($ValSTAG);
            $ObjTuple->SetNbStag($ValNbStag);
            $ObjTuple->SetNbPS($ValNbPS);
            $ObjTuple->SetSEUL($ValSEUL);
            $ObjTuple->SetCOLLAB($ValCOLLAB);
            $ObjTuple->SetIST($ValIST);
            $ObjTuple->SetMIS($ValMIS);
            $ObjTuple->SetIR($ValIR);
            $ObjTuple->SetMIR($ValMIR);
            $ObjTuple->SetIT($ValIT);
            $ObjTuple->SetMIT($ValMIT);
            $ObjTuple->SetMT($ValMT);
            $ObjTuple->SetMMT($ValMMT);
            $ObjTuple->SetEmb($ValEmb);
            $ObjTuple->SetFK_User($ValTut);
            if ($IdentPK == 0)
                $ObjTuple->Insert();
            else
            {
                if ($SaveAsNew)
                    $ObjTuple->Insert();
                else
                    $ObjTuple->Update();
            }

            $Step = 'MAJTabOK';
        }
        break;
    }
    if ($Step == 'MAJTabOK')
    {
        if ($Reafficher)
        {
                                                                       ?>
             <script>location.replace("?Trait=FORM&SlxTable=tabstages&IdentPK=<?=$IdentPK?>");</script>
                                                                       <?php
        }
        else
        {
                                                                       ?>
             <script>location.replace("?Trait=LIST&SlxTable=tabstages");</script>
                                                                       <?php
        }
                                                                       ?>
<script>location.replace("?Trait=LIST&SlxTable=tabstages");</script>
                                                                       <?php
    }
    else
    {
                                                                       ?>
        <?php if ($IdentPK==0) {?>
        <h1> Insertion d'une nouvelle Fiche de Stage </h1>
        <?php } else {?>
        <h1> Modification d'une Fiche de Stage </h1>
        <?php }?>
<p style="text-align : center; font-size : 11px; font-style :
italic;">Toutes les rubriques en <b>gras</b> doivent obligatoirement être remplies</p>
<?php if ($CodErrVide || $CodErrInval) { ?>
<p style="text-align : center; font-size : 16px;">Les
<?=$Fleche?>indiquent qu'une rubrique est vide ou erronée</p> <?php } ?>

<form method="post">
<table align="center" border="1"><tr><td>
<table cellpadding="2">
    <?php if ($ValPK_Stage) { ?>
    <tr>
        <td valign="top"><tt><?=$ValidPK_Stage?></tt></td>
        <td style="text-align : right" valign="top"><b>Numéro</b></td>
        <td>
            <?=$ValPK_Stage?>
        </td>
    </tr>
    <?php } ?>
    <?php if($_SESSION ['privilege'] != "tuteur")
       {
            $ResultListEntreprise = Query ("SELECT NomE, PK_Entreprise FROM
            tabentreprise",$ConnectStages);?>
        <tr>
        <td valign="top"><tt><?=$ValidFK_Entreprise?></tt></td>
        <td style="text-align : right" valign="top"><b>Nom de
        l'entreprise</b></td>
        <td>
            <select name="FK_Entreprise" size="1" style="width :<?=$WidthSelect?>">;
        <?php
        while ($row = mysql_fetch_row ($ResultListEntreprise))
                                        {
                                                                         ?>
                    <option value="<?=$row [1]?>"
                    <?php if($row[1]==$ValFK_Entreprise)
                    {?>selected <?php }?>>
                    <?=$row [0]?></option>
                                                                         <?php
                                        }
                                                                         ?>
            </select>
        </td>
        </tr>
        <?php }else
            //Si c'est une fiche crée par un tuteur, il ne doit pas
            //pouvoir modifier l'entreprise...
          {
               $login = $_SESSION['Login'];
               $req1 = Query("SELECT FK_Entreprise from tabusers where
                              Login='$login'",$ConnectStages);
               $row1 = mysql_fetch_row ($req1);
               $req2 = Query("SELECT NomE from tabentreprise where
                       PK_Entreprise = $row1[0]",$ConnectStages);
               $row2 = mysql_fetch_row ($req2);
          ?>
          <tr><td></td><td align ="right"><b>Entreprise</b></td><td><?=$row2[0]?></td></tr>
          <input type="hidden" name="FK_Entreprise" value =
          <?=$row1[0]?>>
          <?php }?>
        
    <tr>
        <td valign="top"><tt><?=$ValidMateriel?></tt></td>
        <td style="text-align : right" valign="top"><b>Matériel utilisé
        </b></td>
        <td>
            <input type="checkbox" name=GMS value="1"
            
            <?php // pour savoir si une checkbox était cochée, on fait des
              //divisions par 2 successives de la valeur initiale...
              if (($ValMateriel%2)==1) {?>checked<?}?>>
            Grands et moyens systèmes
            <input type="checkbox" name=ST value="2"
            <?php if ((($ValMateriel/2)%2)==1) {?>checked<?php }?>>
            Stations de travail
        <tr><td></td><td></td>
        <td>
            <input type="checkbox" name=Micro value="4"
            <?php if ((($ValMateriel/4)%2)==1) {?>checked<?php }?>>
            Micro (PC,Mac,Pocket PC,...)
        </td>
        </tr>
        </td>
        </tr>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidResLocaux?></tt></td>
        <td style="text-align : right" valign="top"><b>Réseaux locaux</b></td>
        <td>
            <input type="checkbox" name=Eth value="1"
            <?php if (($ValResLocaux %2)==1) {?>checked<?php }?>>
            Ethernet
            <input type="checkbox" name=Nov value="2"
            <?php if ((($ValResLocaux/2)%2)==1) {?>checked<?php }?>>
            Novell
        <tr><td></td><td></td>
        <td>
            <input type="checkbox" name=NT value="4"
            <?php if ((($ValResLocaux/4)%2)==1) {?>checked<?php }?>>
            WindowsNTServeur  
            <input type="checkbox" name=LM value="8"
            <?php if ((($ValResLocaux/8)%2)==1) {?>checked<?php }?>>
            Lan Manager        </td>
        </tr>
        </td>
        </tr>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAutresRL?></tt></td>
        <td style="text-align : right" valign="top">Autres</td>
        <td>
            <input type="text" name="AutresRL" size="50" value="<?=$ValAutresRL?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidResPublics?></tt></td>
        <td style="text-align : right" valign="top"><b>Réseaux publics</b></td>
        <td>
            <input type="checkbox" name=It value="1"
            <?php if (($ValResPublics%2) ==1) {?>checked<?php }?>>
            Internet
            <input type="checkbox" name=Tp value="2"
            <?php if ((($ValResPublics/2)%2)==1) {?>checked<?php }?>>
            Transpac        </td>
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAutresRP?></tt></td>
        <td style="text-align : right" valign="top">Autres</td>
        <td>
            <input type="text" name="AutresRP" size="50" value="<?=$ValAutresRP?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidLangages?></tt></td>
        <td style="text-align : right" valign="top"><b>Langages</b></td>
        <td>
            <input type="checkbox" name=Cpp value="1"
            <?php if (($ValLangages%2) ==1) {?>checked<?php }?>>
            C/C++
            <input type="checkbox" name=Ada value="2"
            <?php if ((($ValLangages/2)%2)==1) {?>checked<?php }?>>
            Ada
            <input type="checkbox" name=Java value="4"
            <?php if ((($ValLangages/4)%2)==1) {?>checked<?php }?>>
            Java
        <tr><td></td><td></td>
        <td>
            <input type="checkbox" name=Perl value="8"
            <?php if ((($ValLangages/8)%2)==1) {?>checked<?php }?>>
            PERL  
            <input type="checkbox" name=Delphi value="16"
            <?php if ((($ValLangages/16)%2)==1) {?>checked<?php }?>>
            DELPHI  
            <input type="checkbox" name=Php value="32"
            <?php if ((($ValLangages/32)%2)==1) {?>checked<?php }?>>
            PHP ASP</td>
        </tr>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAutresL?></tt></td>
        <td style="text-align : right" valign="top">Autres</td>
        <td>
            <input type="text" name="AutresL" size="50" value="<?=$ValAutresL?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidSystExpl?></tt></td>
        <td style="text-align : right" valign="top"><b>Systèmes
        d'exploitation </b></td>
        <td>
            <input type="checkbox" name=unix value="1"
            <?php if (($ValSystExpl%2) ==1) {?>checked<?php }?>>
            Unix/Linux
            <input type="checkbox" name=VM value="2"
            <?php if ((($ValSystExpl/2)%2)==1) {?>checked<?php }?>>
            VM
            <input type="checkbox" name=VMS value="4"
            <?php if ((($ValSystExpl/4)%2)==1) {?>checked<?php }?>>
            VMS
            <input type="checkbox" name=OS value="8"
            <?php if ((($ValSystExpl/8)%2)==1) {?>checked<?php }?>>
            OS/2  
        <tr><td></td><td></td>
        <td>
            <input type="checkbox" name=win value="16"
            <?php if ((($ValSystExpl/16)%2)==1) {?>checked<?php }?>>
            Windows
            Version
            <input type="text" name="VersionSE" size="20" value="<?=$ValVersionSE?>">
        </td>
        </tr>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAutresSE?></tt></td>
        <td style="text-align : right" valign="top">Autres</td>
        <td>
            <input type="text" name="AutresSE" size="50" value="<?=$ValAutresSE?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidBasesD?></tt></td>
        <td style="text-align : right" valign="top"><b>Bases de données</b></td>
        <td>
            <input type="checkbox" name=Syb value="1"
            <?php if (($ValBasesD%2) ==1) {?>checked<?php }?>>
            Sybase
            <input type="checkbox" name=Ing value="2"
            <?php if ((($ValBasesD/2)%2)==1) {?>checked<?php }?>>
            INGRES
        <tr><td></td><td>
        <td>
            <input type="checkbox" name=Mysql value="4"
            <?php if ((($ValBasesD/4)%2)==1) {?>checked<?php }?>>
            MYSQL  
            <input type="checkbox" name=Oracle value="8"
            <?php if ((($ValBasesD/8)%2)==1) {?>checked<?php }?>>
            ORACLE        </td>
        </tr>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAutresBD?></tt></td>
        <td style="text-align : right" valign="top">Autres</td>
        <td>
            <input type="text" name="AutresBD" size="50" value="<?=$ValAutresBD?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidAtGL?></tt></td>
        <td style="text-align : right" valign="top"><b>Ateliers de Génie
        Logiciel</b></td>
        <td>
            <input type="text" name="AtGL" size="50" value="<?=$ValAtGL?>">
        </td>
    </tr>
    <tr><td></td><td><b>Méthodes ou Standards : </b></td></tr>
    <tr>
        <td valign="top"><tt><?=$ValidMA?></tt></td>
        <td style="text-align : right" valign="top"><b>d'Analyse</b></td>
        <td>
            <input type="text" name="MA" size="50" value="<?=$ValMA?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMCpt?></tt></td>
        <td style="text-align : right" valign="top"><b>de Conception</b></td>
        <td>
            <input type="text" name="MCpt" size="50" value="<?=$ValMCpt?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMP?></tt></td>
        <td style="text-align : right" valign="top"><b>de Programmation</b></td>
        <td>
            <input type="text" name="MP" size="50" value="<?=$ValMP?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMCtrl?></tt></td>
        <td style="text-align : right" valign="top"><b>de Controle
        qualité logicielle</b></td>
        <td>
            <input type="text" name="MCtrl" size="50" value="<?=$ValMCtrl?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMGP?></tt></td>
        <td style="text-align : right" valign="top"><b>de Gestion de
        projet</b></td>
        <td>
            <input type="text" name="MGP" size="50" value="<?=$ValMGP?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidSujet?></tt></td>
        <td style="text-align : right" valign="top"><b>Sujet</b></td>
        <td>
            <textarea name="Sujet" cols="40" rows="6"><?=$ValSujet?></textarea>
        </td>
    </tr>
    <tr><td></td><td><b>Nature de la tâche : </b></td></tr>
    <tr>
        <td></td><td></td><td>
            <input type="checkbox" name=Prog value="1"
            <?php if ($ValProg ==1) {?>checked<?php }?>>
            Programmation
            </td>
        <tr><td></td><td></td><td>
            <input type="checkbox" name=Anal value="1"
            <?php if ($ValAnalyse ==1) {?>checked<?php }?>>
            Analyse
            </td></tr>
    </tr>
    <tr>
    <tr><td></td><td><b>Le travail de l'étudiant : </b></td></tr>
    <tr>
        <td></td><td></td><td>
            <input type="checkbox" name=PG value="1"
            <?php if ($ValPG ==1) {?>checked<?php }?>>
            S'integre dans un
            projet global</td>
            <tr><td></td><td></td><td>
            <input type="checkbox" name=EI value="1"
            <?php if ($ValEI ==1) {?>checked<?php }?>>
            Constitue une
            entité indépendante        </td></tr>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidRqs?></tt></td>
        <td style="text-align : right" valign="top"><b>Remarques
        générales </b></td>
        <td>
            <textarea name="Rqs" cols="40" rows="4"><?=$ValRqs?></textarea>
        </td>
    </tr>
    <tr><td></td><td><b><u>SERVICE</u></b></td></tr>
    </table>
<table align="center"><tr><td>
<table cellpadding="2">
<colgroup>
    <col width = "10">
    <col width = "250">
    <col width = "170">
   <tr>
        <td valign="top"><tt><?=$ValidNPCI?></tt></td>
        <td style="text-align : right" valign="top"><b>Nombre de
        personnes du Centre Informatique : </b></td>
        <td>
            <input type="text" name="NPCI" size="6" value="<?=$ValNPCI?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidSTAG?></tt></td>
        <td style ="text-align : right" valign="top">
            <b>L'entreprise à déjà accueilli des stagiaires de notre
            département</b>
            <td><input type="checkbox" name=STAG value="1"
            <?php if ($ValSTAG ==1) {?>checked<?php }?>>
            </td>
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidNbStag?></tt></td>
        <td style="text-align : right" valign="top"><b>Nombre de
        stagiaires prévus</b></td>
        <td>
            <input type="text" name="NbStag" size="6" value="<?=$ValNbStag?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidNbPS?></tt></td>
        <td style="text-align : right" valign="top"><b>Nombre de
        personnes du service où sera affecté le stagiaire</b></td>
        <td>
            <input type="text" name="NbPS" size="6" value="<?=$ValNbPS?>">
        </td>
    </tr>
    <tr><td></td><td><b>Le stagiaire travaillera :</b></td></tr>
    <tr>
        <td valign="top"><tt><?=$ValidSEUL?></tt></td><td></td>
        <td>
            <input type="checkbox" name=SEUL value="1"
            <?php if ($ValSEUL ==1) {?>checked<?php }?>>
            Seul
        </td>
    </tr>
    <tr><td></td><td></td><td>
            <input type="checkbox" name=Coll value="1"
            <?php if ($ValCOLLAB ==1) {?>checked<?php }?>>
            En collaboration
            avec 1 analyste ou 1 ingénieur
    </tr>
    <tr><td></td><td><b><u>RENSEIGNEMENTS PRATIQUES</u></b></td></tr>
    <tr>
        <td valign="top"><tt><?=$ValidIST?></tt></td>
        <td style="text-align : right" valign="top"><b>Indemnités de Stage</b></td>
        <td>
            <input type="checkbox" name=IST value="1"
            <?php if ($ValIST ==1) {?>checked<?php }?>>
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMIS?></tt></td>
        <td style="text-align : right" valign="top"><b>Détails</b></td>
        <td>
            <input type="text" name="MIS" size="25" value="<?=$ValMIS?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidIR?></tt></td>
        <td style="text-align : right" valign="top"><b>Indemnités de Repas</b></td>
        <td>
            <input type="checkbox" name=IR value="1"
            <?php if ($ValIR ==1) {?>checked<?php }?>>
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMIR?></tt></td>
        <td style="text-align : right" valign="top"><b>Détails</b></td>
        <td>
            <input type="text" name="MIR" size="25" value="<?=$ValMIR?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidIT?></tt></td>
        <td style="text-align : right" valign="top"><b>Indemnités de Transport</b></td>
        <td>
            <input type="checkbox" name=IT value="1"
            <?php if ($ValIT ==1) {?>checked<?php }?>>
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMIT?></tt></td>
        <td style="text-align : right" valign="top"><b>Détails</b></td>
        <td>
            <input type="text" name="MIT" size="25" value="<?=$ValMIT?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMT?></tt></td>
        <td style="text-align : right" valign="top"><b>Moyen de Transport</b></td>
        <td>
            <input type="checkbox" name=MT value="1"
            <?php if ($ValMT ==1) {?>checked<?php }?>>
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidMMT?></tt></td>
        <td style="text-align : right" valign="top"><b>Détails</b></td>
        <td>
            <input type="text" name="MMT" size="25" value="<?=$ValMMT?>">
        </td>
    </tr>
    <tr>
        <td valign="top"><tt><?=$ValidEmb?></tt></td>
        <td style="text-align : right" valign="top"><b>Possibilité d'embauche après le stage</b></td>
        <td>
            <input type="checkbox" name=Emb value="1"
            <?php if ($ValEmb ==1) {?>checked<?php }?>>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align : center">
            <input type="button" value="Abandonner"
                    onClick="history.go (-1)">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="Reinitialiser">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" 
                   value="Valider" >
        </td>
    </tr>
</table>
</td></tr></table>
<input type="hidden" name="Step" value="Valid" >
<input type="hidden" name="PK_Stage" value="<?=$ValPK_Stage?>" >
</form>
                                                                       <?php
    }
                                                                       ?>

</body>
</html>
