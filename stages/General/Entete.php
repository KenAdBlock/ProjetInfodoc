<?php
   $PATH_RACINE     = '../';
   $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

   include_once ($PATH_CONSTANTES.'CstGales.php');

    function ShowEntete() {
?>
    <header>
        <div class="row container">
            <div class="col s6">
                <a href="<?=$GLOBALS['URL_IUT']?>"><img class="left-align responsive-img" src="<?=$GLOBALS['PATH_GIFS']?>logo_iut.png"></a>
            </div>
            <div class="col s6">
                <a href="<?=$GLOBALS['URL_DEPTINFO']?>"><img class="right responsive-img" src="<?=$GLOBALS['PATH_GIFS']?>Logo_IUT.jpg"></a>
            </div>
        </div>
    </header>

<?php
    }
?>