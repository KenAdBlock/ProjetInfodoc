<?php
    // fichier UtilErr.php
    //
    // Utilitaires de traitement/affichage des (messages d') erreurs
    // 
    //   PrintMsgErr(), MsgErrNonInit()
	//
	// 	 ValidLogin(), ValidEMail(), ValidChampRempli(), ValidPassWord()

    function PrintMsgErr ($Message)
    {
        print ('<div style="color : #ff0000;">'.$Message.'</big>');
	
    } // PrintMsgErr()

    function MsgErrNonInit ($NomDuChamp)
    {
        return 'Champ <b>'.$NomDuChamp.'</b> non rempli';
	
    } // MsgErrNonInit()
	
	function ValidChampRempli ($Ident, $Champ, &$NomChampVide, &$Indic)
    {
	    global $CodErr, $ERRCHAMPNONREMPLI, $ArrayLibChamps;

	    if (trim ($Champ) != '') return true; 
		
		array_push ($CodErr, $ERRCHAMPNONREMPLI);
		array_push ($NomChampVide, $ArrayLibChamps [$Ident]);
		$Indic [$Ident] = 'x'; //FLECHE;
		return false;
		
	} // ValidChampRempli()

	function ValidEMail ($Ident, $EMail, &$Indic)
    {
	    global $CodErr, $ERREMAILINVALIDE;

        if (preg_match("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$", $EMail))
            return true;

        array_push ($CodErr, $ERREMAILINVALIDE);
		$Indic [$Ident] = FLECHE;
		return false;
		
	} // ValidEMail()

	function ValidLogin ($Ident, $Identifiant, &$Indic)
    {
	    global $CodErr, $ConnectStages, $NomTabUsers,
		       $ERRLOGINCARINVALIDE, $ERRLOGININVALIDE, $ERRLOGINDEJAUTILISE;

		$Lg = strlen ($Identifiant);
		if ($Lg < MINLGLOGIN || $Lg > MAXLGLOGIN)
		{
            array_push ($CodErr, $ERRLOGININVALIDE);
	    	$Indic [$Ident] = FLECHE;
		    return false;
		}
		for ($i = $Lg; $i--; )
		{
		    $C = $Identifiant {$i};
		    if (($C != '_') && ($C < '0' || $C > '9') &&  ($C < 'a' || $C > 'z') && ($C < 'A' || $C > 'Z'))
			{
                array_push ($CodErr, $ERRLOGINCARINVALIDE);
		        $Indic [$Ident] = FLECHE;
		        return false;
			}		
		}
		/*
        if (! eregi ("[0-9a-zA-Z](3)",  $Identifiant, $regs))
        {
		print_r ($regs);
		print (' faux !!<br>');
            array_push ($CodErr, $ERRLOGINCARINVALIDE);
		    $Indic [$Ident] = FLECHE;
		    return false;
        }
else 			print (' juste !!<br>');
        */
		$ReqLogin = Query ("SELECT Login FROM $NomTabUsers 
		                       WHERE Login = '$Identifiant'",
		                   $ConnectStages);
		if (mysql_num_rows ($ReqLogin) > 0)
		{
            array_push ($CodErr, $ERRLOGINDEJAUTILISE);
		    $Indic [$Ident] = FLECHE;
		    return false;
		}
        return true;
				
	} // ValidLogin()

    function ValidPassWord ($Ident, $PassWord, &$Indic)
    {
	    global $CodErr, $ConnectStages, $NomTabUsers,
		       $ERRPASSWDCARINVALIDE, $ERRLGPASSWDINVALIDE;

		$Lg = strlen ($PassWord);
		if ($Lg < MINLGPASSWD || $Lg > MAXLGPASSWD)
		{
            array_push ($CodErr, $ERRLGPASSWDINVALIDE);
	    	$Indic [$Ident] = FLECHE;
		    return false;
		}
		for ($i = $Lg; $i--; )
		{
		    $C = $PassWord {$i};
		    if (($C != '_') && ($C < '0' || $C > '9') &&  ($C < 'a' || $C > 'z') && ($C < 'A' || $C > 'Z'))
			{
                array_push ($CodErr, $ERRPASSWDCARINVALIDE);
		        $Indic [$Ident] = FLECHE;
		        return false;
			}		
		}
        return true;
				
	} // ValidPassWord()

?>
