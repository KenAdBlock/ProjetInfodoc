<?php
   $PATH_RACINE     = '../';
   $PATH_CONSTANTES = $PATH_RACINE.'Constantes/';

   include_once ($PATH_CONSTANTES.'CstGales.php');
?>
<html>
<head>
    <title> le d&eacute;partement informatique</title>
    <base target="sommaire">
    <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?=$PATH_CSS?>materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?=$PATH_CSS?>style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>

  <header>

    <div class="row container">
      <div class="col s6">
        <a href="<?=$URL_IUT?>" target="_top"><img class="left-align responsive-img" src="<?=$PATH_GIFS?>logo_iut.png"></a>
      </div>
      <div class="col s6">
        <a href="<?=$URL_DEPTINFO?>" target="_top"><img  class="right responsive-img" src="<?=$PATH_GIFS?>Logo_IUT.jpg"></a>
      </div>
    </div>

  </header>





<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?=$PATH_JS?>materialize.js"></script>
  <script src="<?=$PATH_JS?>init.js"></script>

</body>
</html>
