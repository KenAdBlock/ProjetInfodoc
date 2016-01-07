<form method="post">
<a href="mailto:<?=$ValMailTuteur?>">Envoyer</a> � <?=$ValMailTuteur?> :
<pre>
Sujet : <b>Nouveaux login et mot de passe</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?=$ValNomTuteur?> <?=$ValPrenomTuteur?>,

J'ai le plaisir de vous informer que vous pourrez dor�navant 
vous connecter et enregistrer vos propositions de stage sur le site

http://infodoc.iut.univ-aix.fr/stages

en utilisant l'identifiant et le mot de passe suivants :

Identifiant  : <?=$ValLoginTuteur?>&nbsp;
Mot de passe : <?=$NewPassWord?>&nbsp;

<?=$NomResponsableStages?>
</pre>
<input type="hidden" name="StepNewInscript" size="50" value="MAJTabOK">
<input type="submit" value="Valider">

</form>

	         /*
										   
	        $ListeBCC    = '';
            $URL         = 'mailto:'.$PremierDest.
                           '?subject='.$Sujet.
					       '&bcc='.$ListeBCC.
					       '&body='.$Message;
            $PremierDest = $MailResponsableStages;
	        $ListeBCC = '';
            $URL         = 'mailto:'.$PremierDest.
	                   '?subject='.FromBd2Html ($Sujet).
					   '&bcc='.$ListeBCC.
					   '&body='.FromBd2Html ($Message);

    $ListeBCCTest = 'enviedesortir@wanadoo.fr, mathieu@romarin.univ-aix.fr';
				   
    $URLTest     = 'mailto:'.$PremierDest.
	                   '?subject='.FromBd2Html ($Sujet).
					   '&bcc='.$ListeBCCTest.
					   '&body='.FromBd2Html ($Message);
                                           print ('	
</table>');
                                           print ('
<p>Le message suivant sera envoy� � la liste ci-dessus :
<br><br><b>Sujet</b> : '.FromBd2Html ($Sujet).'
<br><b>Texte</b> : '.FromBd2Html ($Message).'
<br><br><a href="'.$URL.'"><i>Envoyer</i></a>');
                                           print ('
<p>Le message suivant sera envoy� � la liste-test : MT & DM
<br><br><b>Sujet</b> : '.FromBd2Html ($Sujet).'
<br><b>Texte</b> : '.FromBd2Html ($Message).'

			// ================
		*/	
