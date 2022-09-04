<?php header("Content-type: text/javascript");
require __DIR__ . './../db.php';
?>
var variable=document.getElementById('marche_n');
var bool=0;
var error_m=document.getElementById('error_m');
<?php



if (isset($_GET['numero'])) {


  if ($_GET['numero'] == 1 and isset($_GET['code'])) {
    $reponse = $bdd->query('SELECT numéro_marché FROM Marché');
    while ($donnes = $reponse->fetch()) {
      if (strcmp($donnes['numéro_marché'], $_GET['code']) == 0) {
?>

        bool=1;

    <?php
        break;
      }
    }

    $reponse->closeCursor();
    ?>
    if(bool==1)
    {
    error_m.style.display="block";
    variable.value="";
    }
    else
    {
    error_m.style.display="none";

    }
<?php


  }
}


?>