<?php
session_start();

require __DIR__ . '/../db.php';


if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {


    if (isset($_POST['abr']) and isset($_POST['libellé']) and isset($_POST['ville']) and isset($_POST['entite_racine'])) {
      $_POST['abr'] = htmlspecialchars(strtoupper($_POST['abr']));
      $_POST['libellé'] = htmlspecialchars($_POST['libellé']);
      $_POST['ville'] = htmlspecialchars($_POST['ville']);
      $_POST['entite_racine'] = htmlspecialchars($_POST['entite_racine']);
      $reponse = $bdd->prepare('INSERT INTO Entité (abr,libellé,ville,entité_racine) VALUES(?,?,?,?)');
      $reponse->execute(array($_POST['abr'], $_POST['libellé'], $_POST['ville'], $_POST['entite_racine']));
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 2) {

    if (isset($_POST['abr']) and isset($_POST['libellé']) and isset($_POST['ville']) and isset($_POST['entite_racine']) and isset($_POST['id'])) {
      $_POST['abr'] = htmlspecialchars(strtoupper($_POST['abr']));
      $_POST['libellé'] = htmlspecialchars($_POST['libellé']);
      $_POST['ville'] = htmlspecialchars($_POST['ville']);
      $_POST['entite_racine'] = htmlspecialchars($_POST['entite_racine']);
      $reponse = $bdd->prepare('UPDATE  Entité SET abr=?,libellé=?,ville=?,entité_racine=? where id=?');
      $reponse->execute(array($_POST['abr'], $_POST['libellé'], $_POST['ville'], $_POST['entite_racine'], $_POST['id']));
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 3) {
    if (isset($_POST['id'])) {
      $_POST['id'] = htmlspecialchars($_POST['id']);
      $reponse = $bdd->prepare('DELETE FROM Entité WHERE id=?');
      $reponse->execute(array($_POST['id']));
      $reponse->closeCursor();
    }
  }
}
