<?php
session_start();
require __DIR__ . '/../db.php';


if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {

    if (isset($_POST['N_Série']) and isset($_POST['qte_livre']) and isset($_POST['compteur']) and isset($_POST['ppr'])) {
      $_POST['N_Série'] = (string) strip_tags($_POST['N_Série']);
      $reponse = $bdd->prepare('SELECT marque FROM Matériels WHERE N_Série=?');
      $reponse->execute(array($_POST['N_Série']));
      if ($donnes = $reponse->fetch()) {
        $recherche = $donnes['marque'];
      }
      $reponse->closeCursor();

      $_POST['qte_livre'] = (int) strip_tags($_POST['qte_livre']);
      $_POST['ppr'] = strip_tags($_POST['ppr']);
      $_POST['compteur'] = (int) strip_tags($_POST['compteur']);

      $reponse = $bdd->query('SELECT MAX(N_BL) as N_BL FROM BL_consommable');
      $donnes = $reponse->fetch();
      $N_BL = $donnes['N_BL'] + 1;
      $reponse->closeCursor();
      $reponse = $bdd->query('SELECT réf,marque,qte_min,qte_stock FROM Consommable');
      while ($donnes = $reponse->fetch()) {
        if (stristr($recherche, $donnes['marque'])) {
          $ref = $donnes['réf'];
          $qte_min = $donnes['qte_min'];
          $qte_stock = $donnes['qte_stock'];
          $reponse->closeCursor();
        }
      }
    }

    if ($qte_stock > $qte_min) {

      $reponse = $bdd->prepare('INSERT INTO BL_consommable(BL_réf,BL_ppr,BL_série,BL_date,qte_livre,N_BL,compteur) VALUES (?,?,?,NOW(),?,?,?)');
      $reponse->execute(array($ref, $_POST['ppr'], $_POST['N_Série'], $_POST['qte_livre'], $N_BL, $_POST['compteur']));
      $reponse->closeCursor();
      $reponse = $bdd->prepare('UPDATE Consommable SET qte_stock=qte_stock-? WHERE réf=?');
      $reponse->execute(array($_POST['qte_livre'], $ref));
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 2) {


    if (isset($_POST['id'])) {
      $ref = "";
      $qte = "";
      $reponse = $bdd->prepare('SELECT BL_réf,qte_livre FROM BL_Consommable WHERE id=?');
      $reponse->execute(array($_POST['id']));
      if ($donnes = $reponse->fetch()) {
        $ref = $donnes['BL_réf'];
        $qte = $donnes['qte_livre'];
      }
      $reponse->closeCursor();


      $reponse = $bdd->prepare('UPDATE Consommable SET qte_stock=qte_stock+? WHERE réf=?');
      $reponse->execute(array($qte, $ref));
      $reponse->closeCursor();


      $reponse = $bdd->prepare('DELETE FROM BL_Consommable WHERE id=?');
      $reponse->execute(array($_POST['id']));
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 3) {
    if (isset($_POST['id'])) {

      $_POST['id'] = htmlspecialchars($_POST['id']);
      $reponse = $bdd->prepare('DELETE FROM BL_Consommable WHERE id=?');
      $reponse->execute(array($_POST['id']));
      $reponse->closeCursor();
    }
  }
}
