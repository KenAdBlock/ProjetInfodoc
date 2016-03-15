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
            <big>Année Universitaire 2015/2016</big>
        </td>
    </tr>
    <tr>
        <td><big>Etudiants de 2<sup>ème</sup> année</big></td>
        <td><b>10 semaines</b> : du 11 avril au 17 juin 2016</td>
    </tr>
    <tr>
        <td><big>Etudiants de Licence Professionnelle SIL - DA2I </big><a href="#[1]"><sup>1</sup></a></td>
        <td><b>12 semaines</b> : du 18 avril au 08 juillet 2016</td>
    </tr>
</table>
</p>

<p style="text-align : justify">
Une des originalités de la formation dispensée dans les I.U.T. et dans les licences professionnelles se traduit par la nécessité pour les étudiants d'effectuer un stage obligatoire en entreprise. D'une durée de dix ou douze semaines selon le cas (D.U.T ou Licence Professionnelle), le stage poursuit les quatre objectifs suivants :

<br /><br />
a) - favoriser et développer les relations entre l'Université et les partenaires professionnels;

<br /><br />
b) - mettre l'étudiant en situation de production sur une tâche bien précise de manière à exploiter, sur le terrain de la vie professionnelle, les connaissances, les techniques et les méthodes acquises lors de leur formation;

<br /><br />
c) - permettre à l'étudiant de s'adapter au cas particulier de l'entreprise et du service informatique où il se trouve et d'améliorer sa connaissance du milieu professionnel;

<br /><br />
d) - à l'issue du stage, l'étudiant doit remettre un rapport de stage et faire un exposé oral devant un jury.

Ces étapes sont nécessaires pour obtenir le diplôme (Diplôme Universitaire de Technologie ou Licence Professionnelle).

<br /><br />
Pendant toute cette période, l'étudiant est suivi par un enseignant du département (son tuteur) qui travaille en collaboration avec le maître de stage du stagiaire dans l'entreprise.

<br /><br />
Au début du stage, l'étudiant a des connaissances et l'expérience nécessaires pour
s'intégrer à une équipe d'informaticiens (conception et développement); pour mieux situer les
connaissances et le savoir-faire des étudiants, vous pouvez consulter les descriptifs de nos enseignements du
<a href="<?=$URL_PROGR_DUT?>" target="_blank">DUT du département Informatique de l'IUT d'Aix-en-Provence</a> ou en
<a href="<?=$URL_PROGR_LP?>" target="_blank">licence professionnelle</a>.

<br /><br />
Sur le plan des modalités administratives, je dois préciser que l'étudiant stagiaire bénéficie de la sécurité sociale étudiante durant toute cette période; une convention de stage est établie entre l'entreprise d'accueil et l'I.U.T.

<br /><br />
</p>

<div style="background-color : Silver; border : thin solid Black;">
<blockquote><p>
Gratification :

<br /><br />
Pour l'instant, l'article 30 de la loi n&ordm; 2009-1437 du 24/11/09, modifiée par la loi du 10 juillet 2014, impose pour tous les stages de plus
de deux mois la gratification des stagiaires dans le privé comme dans le
public au taux de 15% du plafond de la Sécurité Sociale, soit 1109.60&euro; pour tout le stage de DUT et 1361,60&euro; pour celui de LP - taux au 01/09/2015
(https://www.service-public.fr/simulateur/calcul/gratification-stagiaire).
</p></blockquote>
</div>

<p style="text-align : right">
<br /><br />
Le responsable des stages : 
<u><a href="mailto:<?=$MailResponsableStages?>"><?=$NomResponsableStages?></a></u>
</p>

<p>
<a name="[1]"></a><sup>1</sup> : Systèmes Informatiques et Logiciels - Développement et Administration Internet et Intranet <i>(<a href="#Retour [1]">Retour au texte</a>)</i>
</p>

</body>
</html>
