<?php
function Accueil ($LoginProv)
{
    global $PATH_GENERAL;
?>

<nav class="blue" role="navigation">

    <div class="nav-wrapper container">

      <ul class="left hide-on-med-and-down">
        <li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons left">account_circle</i>Se connecter</a></li>
      </ul>

      <ul class="right hide-on-med-and-down">
        <li><a href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxNewInscript.php')"><i class="material-icons left">create</i>Nouvelle inscription</a></li>  
      </ul> 

      

      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>  

    </div>
  </nav>

<div id="slide-out" class="side-nav grey lighten-4 z-depth-3 black-text">
        <div class="row">
          <div class="col s12">

            <p class="center">
              Si vous d&eacute;sirez nous verser de la
              <a class="waves-effect waves-light btn blue lighten-2 white-text" href="../Libres/LettreTA.php" target="_blanc">Taxe d'apprentissage</a>
              merci de cliquer ci-dessus
            </p>

<h5 class="center">Connexion</h5>

<form target="_self" action="" method="post" name="">
<div class="row">
                    <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>

                <input name="login" type="text" id="login" size="10"
                       value="<?=$LoginProv?>">
                               <label for="login">Login</label>

                    </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">https</i>

                  <input name="password" type="password" id="password" size="10">
<label for="password">Pass</label>
            </div><p class="center">
                        <button id="connecter" class="btn waves-effect waves-light white-text amber lighten-1" type="submit" name="Submit">Se connecter</button>
                        
</p>
<input name="Step" type="hidden" value="Cnx">
</div>
</form>

<p class="center">
            <a class="waves-effect waves-light btn white-text blue" href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxOubliPassWord.php')"
                >Mot de passe oubli&eacute;</a>
</p>         

          </div>
        </div>
      </div>

      <div id="nav-mobile" class="side-nav">
        <div class="row">
          <div class="col s12">

            <p class="center">
              Si vous d&eacute;sirez nous verser de la
              <a class="waves-effect waves-light btn blue lighten-2 white-text" href="../Libres/LettreTA.php" target="_blanc">Taxe d'apprentissage</a>
              merci de cliquer ci-dessus
            </p>

<h5 class="center">Connexion</h5>

<form target="_self" action="" method="post" name="">
<div class="row">
                    <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>

                <input name="login" type="text" id="login" size="10"
                       value="<?=$LoginProv?>">
                               <label for="login">Login</label>

                    </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">https</i>

                  <input name="password" type="password" id="password" size="10">
<label for="password">Pass</label>
            </div><p class="center">
                        <button id="connecter" class="btn waves-effect waves-light white-text amber lighten-1" type="submit" name="Submit">Se connecter</button>
                        
</p>
<input name="Step" type="hidden" value="Cnx">
</div>
</form>

<p class="center">
            <a class="waves-effect waves-light btn white-text blue" href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxNewInscript.php')"
                >Nouvelle inscription</a>
</p>
<p class="center">
            <a class="waves-effect waves-light btn white-text blue" href="javascript:popup ('<?=$PATH_GENERAL?>PopUpBoxOubliPassWord.php')"
                >Mot de passe oubli&eacute;</a>
</p>               

          </div>
        </div>
      </div>
                                                                           <?php
} // Accueil()
?>
