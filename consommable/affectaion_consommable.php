<?php header("Content-type: text/javascript");
require __DIR__ . '/../db.php';
?>
var variable=document.getElementById('ref');
var bool=0;
var error_t=document.getElementById('error_t');
<?php



if (isset($_GET['numero'])) {


  if ($_GET['numero'] == 1 and isset($_GET['code'])) {
    $reponse = $bdd->query('SELECT réf FROM Consommable ');
    while ($donnes = $reponse->fetch()) {
      if (strcmp($donnes['réf'], $_GET['code']) == 0) {
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
    error_t.style.display="block";
    variable.value="";
    }
    else
    {
    error_t.style.display="none";

    }
<?php


  }
}


?>