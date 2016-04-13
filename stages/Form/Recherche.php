<?php
if ($CleOK == '069b9247591948b71d303ac66371bf0b')
{
	$ReqOS = $ConnectStages->query("SELECT * FROM $NomTabOS");
	$ReqLangages = $ConnectStages->query("SELECT * FROM $NomTabLangages");
	$ReqMateriels = $ConnectStages->query("SELECT * FROM $NomTabMateriels");
	$ReqLans = $ConnectStages->query("SELECT * FROM $NomTabReseauxLocaux");
	$ReqWans = $ConnectStages->query("SELECT * FROM $NomTabReseauxPublics");
	$ReqBDs = $ConnectStages->query("SELECT * FROM $NomTabBasesDonnees");

	$ValidMateriel =
	$ValidReseauxLocaux =
	$ValidAutresRL = 
	$ValidResPublics = 
	$ValidAutresRP = 
	$ValidLangages = 
	$ValidAutresL = 
	$ValidAutresSE = 
	$ValidBasesD = 
                           '&nbsp;';
?>
<form action="BackOffice.php?Trait=List&SlxTable=<?=$NomTabStages?>" method="post">

		    <?=$ValidMateriel?>
<div class="row">
		    <h6><b>Matériel utilisé</b></h6>

		                                                                   <?php
										while ($Obj = $ReqMateriels->fetch())
										{ 
		                                                                   ?>
<div class="input-field col s12 m6 l4">
                <input class="filled-in" type="checkbox" id="<?=$Obj['Libelle']?>" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>">
                <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
	    	</div>
		                                                                   <?php
										} 
		                                                                   ?>
		
		   <?=$ValidReseauxLocaux?>
</div>
<div class="row"> <br>
		    <h6><b>Réseaux locaux</b></h6>
		
 		                                                                   <?php
										while ($Obj = $ReqLans->fetch())
										{ 
		                                                                   ?>
            <div class="input-field col s12 m6 l4">
                <input class="filled-in" type="checkbox" id="<?=$Obj['Libelle']?>" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>">
                <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
	    	</div>
		                                                                   <?php
										} 
		                                                                   ?>
          
		    <?=$ValidAutresRL?>
		<br><br><div class="input-field col s12">
			<input id="Autres1"type="text" name="AutresRL" size="50" value="<?=$ValAutresRL?>">
        	<label for="Autres1">Autres</label>
        	</div>
        
		    <?=$ValidResPublics?>
		</div>
		<div class="row">
		    <h6><b>Réseaux publics</b></h6>
		
		                                                                   <?php
										while ($Obj = $ReqWans->fetch())
										{ 
		                                                                   ?>
            <div class="input-field col s12 m6 l4">
                <input class="filled-in" type="checkbox" id="<?=$Obj['Libelle']?>" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>">
                <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
	    	</div>
		                                                                   <?php
										} 
		                                                                   ?>
		
		    <?=$ValidAutresRP?>
		<br><br><div class="input-field col s12">
			<input id="Autres2"type="text" name="AutresRP" size="50" value="<?=$ValAutresRP?>">
        	<label for="Autres2">Autres</label>
        	</div>
		    <?=$ValidLangages?>
		</div>
		<div class="row">
		    <h6><b>Langages</b></h6>
		
		                                                                   <?php
($ReqLangages);
										while ($Obj = $ReqLangages->fetch())
										{ 
		                                                                   ?>
            <div class="input-field col s12 m6 l4">
                <input class="filled-in" type="checkbox" id="<?=$Obj['Libelle']?>" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>">
                <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
	    	</div>
		                                                                   <?php
										} 
		                                                                   ?>
		
		    <?=$ValidAutresL?>
		<br><br><div class="input-field col s12">
			<input id="Autres3"type="text" name="AutresL" size="50" value="<?=$ValAutresL?>">
        	<label for="Autres3">Autres</label>
        	</div>
		    <?=$ValidSystExpl?>
		</div>
		<div class="row">
		    <h6><b>Systèmes d'exploitation </b></h6>
		
		                                                                   <?php
										while ($Obj = $ReqOS->fetch())
										{ 
		                                                                   ?>
            <div class="input-field col s12 m6 l4">
                <input class="filled-in" type="checkbox" id="<?=$Obj['Libelle']?>" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>">
                <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
	    	</div>
		                                                                   <?php
										} 
		                                                                   ?>
		
		    <?=$ValidAutresSE?>
		<br><br><div class="input-field col s12">
		    <input id="Autres4"type="text" name="AutresSE" size="50" value="<?=$ValAutresSE?>">
        	<label for="Autres4">Autres</label>
        	</div>
		    <?=$ValidBasesD?>
		</div>
		<div class="row">
		    <h6><b>Bases de données</b></h6>
		
		                                                                   <?php
										while ($Obj = $ReqBDs->fetch())
										{ 
		                                                                   ?>
            <div class="input-field col s12 m6 l4">
                <input class="filled-in" type="checkbox" id="<?=$Obj['Libelle']?>" name="<?=$Obj['Code']?>" value="<?=$Obj['CodeBin']?>">
                <label for="<?=$Obj['Libelle']?>"><?=$Obj['Libelle']?></label>
	    	</div>
		                                                                   <?php
										} 
		                                                                   ?>
		
		    <?=$ValidAutresBD?>
		<br><br><div class="input-field col s12">
		    <input id="Autres5"type="text" name="AutresBD" size="50" value="<?=$ValAutresBD?>">
        	<label for="Autres5">Autres</label>
        	</div>
		    <?=$ValidAtGL?>
		
		<div class="input-field col s12">
            <input type="text" name="AtGL" id="AtGL" size="50" value="<?=$ValAtGL?>">
        <label for="AtGL">Ateliers de Génie Logiciel</label>
	    </div>
	    </div>
<div class="row">
		    <h6><b><u>METHODES OU STANDARDS </u></b></h6>
		
		    <?=$ValidMA?>
		
        
		    
        <div class="input-field col s12 m12 l6">
            <input id="Analyse" type="text" name="MA" size="50" value="<?=$ValMA?>">
        <label for="Analyse"><b>Analyse</b></label>
        </div>
		    <?=$ValidMCpt?>
		
		    
		<div class="input-field col s12 m12 l6">
            <input id="Conception" type="text" name="MCpt" size="50" value="<?=$ValMCpt?>">
        <label for="Conception"><b>Conception</b></label>
        </div>
		    <?=$ValidMP?>
		
		    
		<div class="input-field col s12 m12 l6">
            <input id="Programmation" type="text" name="MP" size="50" value="<?=$ValMP?>">
        <label for="Programmation"><b>Programmation</b></label>
        </div>
		    <?=$ValidMCtrl?>
        
		    
		<div class="input-field col s12 m12 l6">
            <input id="Controle qualité" type="text" name="MCtrl" size="50" value="<?=$ValMCtrl?>">
        <label for="Controle qualité"><b>Controle qualité logicielle</b></label>
        </div>
		    <?=$ValidMGP?>
		    
        <div class="input-field col s12 m12 l6">
            <input id="Gestion de projet" type="text" name="MGP" size="50" value="<?=$ValMGP?>">
        <label for="Gestion de projet"><b>Gestion de projet</b></label>
        </div>
</div>

<div class="row">
	        <h6><b><u>RENSEIGNEMENTS PRATIQUES</u></b></h6>
		
		    <?=$ValidIS?>
		
		
		<div class="input-field col s12 m6 l6">
			Indemnités de Stage :<br>
		    <input id="oui1" type="radio" name=IST value="1" checked>
		    <label for="oui1">Oui</label>
		    <input id="non1" type="radio" name=IST value="0">
		    <label for="non1">Non</label>
		    </div>
		
		<?=$ValidIR?>
		
		
		<div class="input-field col s12 m6 l6">
			Indemnités de Repas :<br>
		    <input id="oui2" type="radio" name=IR value="1" checked>
		    <label for="oui2">Oui</label>
		    <input id="non2" type="radio" name=IR value="0">
		    <label for="non2">Non</label>
		    </div>
        
		    <?=$ValidIT?>
		
		
		<div class="input-field col s12 m6 l6">
			Indemnités de Transport :<br>
		    <input id="oui3" type="radio" name=IT value="1" checked>
		    <label for="oui3">Oui</label>
		    <input id="non3" type="radio" name=IT value="0">
		    <label for="non3">Non</label>
		    </div>
        
		    <?=$ValidMT?>
		
		
		<div class="input-field col s12 m6 l6">
			Moyen de Transport :<br>
		    <input id="oui4" type="radio" name=MT value="1" checked>
		    <label for="oui4">Oui</label>
		    <input id="non4" type="radio" name=MT value="0">
		    <label for="non4">Non</label>
		    </div>
        
		    <?=$ValidEmb?>
		
		
		<div class="input-field col s12 m6 l6">
			Possibilité d'embauche après le stage :<br>
		    <input id="oui5" type="radio" name=Emb value="1" checked>
		    <label for="oui5">Oui</label>
		    <input id="non5" type="radio" name=Emb value="0">
		    <label for="non5">Non</label>
		    </div>
        </div>
            <p class="right-align">
            <button class="waves-effect waves-light btn black white-text" type="button"
                    onClick="history.go (-1)">Retour</button>
          
             <button class="waves-effect waves-light btn bleu1 white-text" type="submit" >Rechercher</button>
        </p>
<input type="hidden" name="Recherche"   value="1">
<input type="hidden" name="StepConsult" value="Valid" >
<input type="hidden" name="PK_Stage"    value="<?=$ValPK_Stage?>" >
</form>

<?php
}
else
{
?>
	<h4 class="center">Vous ne pouvez accéder directement à cette page</h4>
<?php
}
?>

