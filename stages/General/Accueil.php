<?php
function Accueil ($LoginProv)
{
    global $PATH_GENERAL;
?>
<p style="text-align : center">
Si vous d&eacute;sirez nous verser de la
</p>
<h1 style="background-color : #efefef; text-align : center">
<a href="http://infodoc.iut.univ-aix.fr/~laporte/Libres/LettreTA.php" target="_blanc">
Taxe d'apprentissage</a>
</h1>

<p style="text-align : center">
merci de cliquer ci-dessus
</p>
<hr width="100%">

<form target="_self" action="" method="post" name="">
<table width="100" border="0" cellpadding="0" cellspacing="0" 
	   bordercolor="#CCCCCC">
    <tr>
        <td>
		    <table width="100"  border="0" cellpadding="5" cellspacing="0" 
		           bgcolor="#eeeeee">
                <tr>
                    <td width="50%"><span>login</span></td>
                    <td width="50%">
			 	        <input name="login" type="text" id="login" size="10"
				               value="<?=$LoginProv?>">
					</td>
                </tr>
                <tr>
                    <td width="50%"><span>pass</span></td>
                    <td width="50%">
			            <input name="password" type="password" id="password" size="10">
				    </td>
                </tr>
                <tr>
                    <td height="34" colspan="2" style="text-align : center">
                        <input type="submit" name="Submit" value="Se connecter">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<input name="Step" type="hidden" value="Cnx">
</form>

<table width="100%">
    <tr>
        <td style="text-align : center">
            <a href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxNewInscript.php')"
			    >Nouvelle inscription</a>
        </td>
    </tr>
    <tr>
        <td style="text-align : center">
            <a href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxOubliPassWord.php')"
			    >Mot de passe oubli&eacute;</a>
        </td>
    </tr>
</table>
                                                                           <?php
} // Accueil()
?>
