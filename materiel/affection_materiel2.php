<?php
ob_start();
session_start();
require __DIR__ . './../db.php';



echo $_SESSION['ppr_employe'];
if (isset($_POST['ppr'])) {

  if (isset($_POST['pc'])) {
    $_POST['pc'] = htmlspecialchars($_POST['pc']);

    $reponse = $bdd->prepare('INSERT INTO Employé_Matériel(EM_ppr,EM_Série,date_activation) VALUES(?,?,NOW())');
    $reponse->execute(array($_POST['ppr'], $_POST['pc']));
    $reponse->closeCursor();
    $reponse = $bdd->prepare('UPDATE Matériels SET etat=\'NON RéFORME\' WHERE N_Série=?');
    $reponse->execute(array($_POST['pc']));
    $reponse->closeCursor();
    $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_série=? AND EM_ppr!=?');
    $reponse->execute(array($_POST['pc'], $_POST['ppr']));
    if ($reponse->rowCount() == 0) {
      $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte-1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 

       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
      $reponse2->execute(array($_POST['pc']));
      $reponse2->closeCursor();
    }
    $reponse->closeCursor();
  }
  if (isset($_POST['imprimante'])) {
    $_POST['imprimante'] = htmlspecialchars($_POST['imprimante']);

    $_SESSION['N_Série_imp'] = $_POST['imprimante'];
    $reponse = $bdd->prepare('INSERT INTO Employé_Matériel(EM_ppr,EM_Série,date_activation) VALUES(?,?,NOW())');
    $reponse->execute(array($_POST['ppr'], $_POST['imprimante']));
    $reponse->closeCursor();
    $reponse = $bdd->prepare('UPDATE Matériels SET etat=\'NON RéFORME\' WHERE N_Série=?');
    $reponse->execute(array($_POST['imprimante']));
    $reponse->closeCursor();
    $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_série=? AND EM_ppr!=?');
    $reponse->execute(array($_POST['imprimante'], $_POST['ppr']));
    if ($reponse->rowCount() == 0) {
      $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte-1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 

       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
      $reponse2->execute(array($_POST['imprimante']));
      $reponse2->closeCursor();
    }
    $reponse->closeCursor();
  }
  $bdd = NULL;
  ob_end_clean();
}
