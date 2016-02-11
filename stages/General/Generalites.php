<?php
   $PATH_RACINE     = '../';
   $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

   include_once ($PATH_CONSTANTES.'CstGales.php');
 
	$URL_PROGR_DUT = $PATH_CONSTANTES.'dut_info_aix.pdf';
	$URL_PROGR_LP  = $PATH_CONSTANTES.'_lp_da2i.pdf';

?>
<html>
<head>
<LINK REL=STYLESHEET TYPE=text/css HREF="<?=$PATH_CSS?>stages.css">
</head>

<body>
<h1>OBJECTIFS DES STAGES</h1>

<p style="text-align : center">
<a name="Retour [1]"></a><table align="center">
    <tr>
        <td colspan="2" style="text-align : center">
            <big>Ann&eacute;e Universitaire 2015/2016</big>
        </td>
    </tr>
    <tr>
        <td><big>Etudiants de 2<sup>&egrave;me</sup> ann&eacute;e</big></td>
        <td><b>10 semaines</b> : du 11 avril au 17 juin 2016</td>
    </tr>
    <tr>
        <td><big>Etudiants de Licence Professionnelle SIL - DA2I </big><a href="#[1]"><sup>1</sup></a></td>
        <td><b>12 semaines</b> : du 18 avril au 08 juillet 2016</td>
    </tr>
</table>
</p>

<p style="text-align : justify">
Une des originalit&eacute;s de la formation dispens&eacute;e dans les I.U.T. et dans les licences professionnelles se traduit par la n&eacute;cessit&eacute; pour les &eacute;tudiants d'effectuer un stage obligatoire en entreprise. D'une dur&eacute;e de dix ou douze semaines selon le cas (D.U.T ou Licence Professionnelle), le stage poursuit les quatre objectifs suivants :

<br /><br />
a) - favoriser et d&eacute;velopper les relations entre l'Universit&eacute; et les partenaires professionnels;

<br /><br />
b) - mettre l'&eacute;tudiant en situation de production sur une t&acirc;che bien pr&eacute;cise de mani&egrave;re &agrave; exploiter, sur le terrain de la vie professionnelle, les connaissances, les techniques et les m&eacute;thodes acquises lors de leur formation;

<br /><br />
c) - permettre &agrave; l'&eacute;tudiant de s'adapter au cas particulier de l'entreprise et du service informatique o&ugrave; il se trouve et d'am&eacute;liorer sa connaissance du milieu professionnel;

<br /><br />
d) - &agrave; l'issue du stage, l'&eacute;tudiant doit remettre un rapport de stage et faire un expos&eacute; oral devant un jury.

Ces &eacute;tapes sont n&eacute;cessaires pour obtenir le dipl&ocirc;me (Dipl&ocirc;me Universitaire de Technologie ou Licence Professionnelle).

<br /><br />
Pendant toute cette p&eacute;riode, l'&eacute;tudiant est suivi par un enseignant du d&eacute;partement (son tuteur) qui travaille en collaboration avec le ma&icirc;tre de stage du stagiaire dans l'entreprise.

<br /><br />
Au d&eacute;but du stage, l'&eacute;tudiant a des connaissances et l'exp&eacute;rience n&eacute;cessaires pour 
s'int&eacute;grer &agrave; une &eacute;quipe d'informaticiens (conception et d&eacute;veloppement); pour mieux situer les 
connaissances et le savoir-faire des &eacute;tudiants, vous pouvez consulter les descriptifs de nos enseignements du 
<a href="<?=$URL_PROGR_DUT?>" target="_blank">DUT du d&eacute;partement Informatique de l'IUT d'Aix-en-Provence</a> ou en 
<a href="<?=$URL_PROGR_LP?>" target="_blank">licence professionnelle</a>.

<br /><br />
Sur le plan des modalit&eacute;s administratives, je dois pr&eacute;ciser que l'&eacute;tudiant stagiaire b&eacute;n&eacute;ficie de la s&eacute;curit&eacute; sociale &eacute;tudiante durant toute cette p&eacute;riode; une convention de stage est &eacute;tablie entre l'entreprise d'accueil et l'I.U.T.

<br /><br />
</p>

<div style="background-color : Silver; border : thin solid Black;">
<blockquote><p>
Gratification :

<br /><br />
Pour l'instant, l'article 30 de la loi n&ordm; 2009-1437 du 24/11/09, modifi&eacute;e par la loi du 10 juillet 2014, impose pour tous les stages de plus 
de deux mois la gratification des stagiaires dans le priv&eacute; comme dans le 
public au taux de 15% du plafond de la S&eacute;curit&eacute; Sociale, soit 1109.60&euro; pour tout le stage de DUT et 1361,60&euro; pour celui de LP - taux au 01/09/2015
(https://www.service-public.fr/simulateur/calcul/gratification-stagiaire).
</p></blockquote>
</div>

<p style="text-align : right">
<br /><br />
Le responsable des stages : 
<u><a href="mailto:<?=$MailResponsableStages?>"><?=$NomResponsableStages?></u></a>
</p>

<p>
<a name="[1]"></a><sup>1</sup> : Syst&egrave;mes Informatiques et Logiciels - D&eacute;veloppement et Administration Internet et Intranet <i>(<a href="#Retour [1]">Retour au texte</a>)</i>
</p>

</body>
</html>
