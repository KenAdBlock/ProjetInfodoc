<?php
   $PATH_RACINE     = '../';
   $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

   include_once ($PATH_CONSTANTES.'CstGales.php');

    function Entete() {
?>
    <header>
        <div class="container">
            <div class="row col s6">
                <a href="<?=$GLOBALS['URL_DEPTINFO']?>"><img class="responsive-img" src="<?=$GLOBALS['PATH_GIFS']?>Logo_IUT.jpg"></a>
            </div>
        </div>
    </header>

<?php
    }
?>