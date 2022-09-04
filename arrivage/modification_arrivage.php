<?php
session_start();
function N_Série($numbre, $chaine = 'rezatyuiopqsdfhgjklwmxcvbn123456789')
{
  $nbombre_lettre = strlen($chaine) - 1;
  $N_Série = '';
  for ($i = 0; $i < $numbre; $i++) {
    $j = mt_rand(0, $nbombre_lettre);
    $lettre = $chaine[$j];
    $N_Série .= $lettre;
  }
  return strtoupper($N_Série);
}
require __DIR__ . './../db.php';

if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {

    if (isset($_POST['marche']) and isset($_POST['qte_stock']) and isset($_POST['type'])) {

      $_POST['marche'] = htmlspecialchars($_POST['marche']);
      $_POST['type'] = htmlspecialchars($_POST['type']);
      $_POST['qte_stock'] = htmlspecialchars($_POST['qte_stock']);
      $reponse = $bdd->query('SELECT MAX(id) as id FROM Arrivage_Marché');
      if ($donnes = $reponse->fetch()) {
        $id = $donnes['id'];
      }
      $reponse->closeCursor();
      $id++;
      $AM_arrivage = '0' . $id . '/' . date("Y");
      $reponse = $bdd->prepare('INSERT INTO Arrivage_Marché(AM_arrivage,AM_marché,qte,date_stockage) VALUES (?,?,?,NOW())');
      $reponse->execute(array($AM_arrivage, $_POST['marche'], $_POST['qte_stock']));
      $reponse->closeCursor();

      $reponse = $bdd->query('SELECT MAX(id) as id FROM Arrivage_Marché');
      $donnes = $reponse->fetch();
      $id_arrivage = $donnes['id'];
      $reponse->closeCursor();

      $reponse = $bdd->prepare('SELECT description FROM Marché WHERE numéro_marché=?');
      $reponse->execute(array($_POST['marche']));
      if ($donnes = $reponse->fetch()) {
        $description = $donnes['description'];
      }
      $reponse->closeCursor();
      if ($_POST['type'] == "PC") {
        for ($i = 0; $i < $_POST['qte_stock']; $i++) {
          $array = array();
          $reponse = $bdd->prepare('SELECT N_Série FROM Matériels WHERE type=\'PC\'');
          while ($donnes = $reponse->fetch()) {
            $array[] = $donnes['N_Série'];
          }
          $reponse->closeCursor();
          do {
            $N_Série = N_Série(10);
          } while (in_array($N_Série, $array));


          $reponse = $bdd->prepare('INSERT INTO Matériels (N_Série,marque,type,etat,id_arrivage) VALUES(?,?,\'PC\',\'EN STOCK\',?)');
          $reponse->execute(array($N_Série, $description, $id_arrivage));
          $reponse->closeCursor();
        }
      } else if ($_POST['type'] == "IMP") {
        for ($i = 0; $i < $_POST['qte_stock']; $i++) {
          $array = array();
          $reponse = $bdd->prepare('SELECT N_Série FROM Matériels WHERE type=\'IMP\'');
          while ($donnes = $reponse->fetch()) {
            $array[] = $donnes['N_Série'];
          }
          $reponse->closeCursor();
          do {
            $N_Série = N_Série(10);
          } while (in_array($N_Série, $array));


          $reponse = $bdd->prepare('INSERT INTO Matériels (N_Série,marque,type,etat,id_arrivage) VALUES(?,?,\'IMP\',\'EN STOCK\',?)');
          $reponse->execute(array($N_Série, $description, $id_arrivage));
          $reponse->closeCursor();
        }
      }
    }
  } else if ($_GET['numero'] == 2) {
  } else if ($_GET['numero'] == 3) {
    if (isset($_POST['id'])) {

      $_POST['id'] = htmlspecialchars($_POST['id']);
      $reponse = $bdd->prepare('DELETE FROM Arrivage_Marché WHERE id=?');
      $reponse->execute(array($_POST['id']));
      $reponse->closeCursor();
    }
  }
}
