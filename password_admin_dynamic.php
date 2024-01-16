<?php header("Content-type: text/javascript");
session_start();
require __DIR__ . '/db.php';

if (isset($_GET['password'])) {
  if (isset($_SESSION['ppr_admin'])) {
    $reponse = $bdd->prepare('SELECT password FROM Employé WHERE ppr=?');
    $reponse->execute(array($_SESSION['ppr_admin']));

    if ($reponse->rowCount() == 1) {
      $donnes = $reponse->fetch();
      $password = $donnes['password'];
    }
    $reponse->closeCursor();


?>
    <?php

    if (password_verify($_GET['password'], $password)) {
    ?>
      $('.password2,.password3').removeAttr('disabled');
      $('#pwd_error').css('display','none');

    <?php
    } else {
    ?>
      $('.password2,.password3').attr('disabled','true');
      $('#pwd_error').css('display','inline');

<?php
    }
  }
}

?>