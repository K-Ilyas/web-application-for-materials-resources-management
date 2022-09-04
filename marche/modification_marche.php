<?php
session_start();

require __DIR__ . './../db.php';

if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {

    if (isset($_POST['type']) and isset($_POST['marche']) and isset($_POST['description'])) {

      $_POST['type'] = htmlspecialchars(strtoupper($_POST['type']));
      $_POST['marche'] = htmlspecialchars(strtoupper($_POST['marche']));
      $_POST['description'] = htmlspecialchars($_POST['description']);

      $reponse = $bdd->prepare('SELECT numéro_marché FROM Marché WHERE numéro_marché=?');
      $reponse->execute(array($_POST['marche']));
      if ($reponse->rowCount() == 0) {

        $reponse2 = $bdd->prepare('INSERT INTO Marché(numéro_marché,type,description) VALUES (?,?,?)');
        $reponse2->execute(array($_POST['marche'], $_POST['type'], $_POST['description']));
        $reponse2->closeCursor();
      }
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 2) {


    if (isset($_POST['type']) and isset($_POST['marche']) and isset($_POST['description'])) {

      $_POST['type'] = htmlspecialchars(strtoupper($_POST['type']));
      $_POST['marche'] = htmlspecialchars(strtoupper($_POST['marche']));
      $_POST['description'] = htmlspecialchars($_POST['description']);

      $reponse = $bdd->prepare('UPDATE Marché SET type=?,description=? WHERE numéro_marché=?');
      $reponse->execute(array($_POST['type'], $_POST['description'], $_POST['marche']));
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 3) {
    if (isset($_POST['marche'])) {

      $_POST['marche'] = htmlspecialchars($_POST['marche']);
      $reponse = $bdd->prepare('DELETE FROM Marché WHERE numéro_marché=?');
      $reponse->execute(array($_POST['marche']));
      $reponse->closeCursor();
    }
  }
}
