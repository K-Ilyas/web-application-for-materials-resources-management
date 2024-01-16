<?php
ob_start();
session_start();
require __DIR__ . '/../db.php';

function date_ans($date1, $date2)
{
  $diff = abs($date1 - $date2);
  $rest = array();

  $tmp = $diff;
  $rest['second'] = $tmp % 60;

  $tmp = floor(($tmp - $rest['second']) / 60);
  $rest['minute'] = $tmp % 60;

  $tmp = floor(($tmp - $rest['minute']) / 60);
  $rest['hour'] = $tmp % 24;

  $tmp = floor(($tmp - $rest['hour'])  / 24);
  $rest['day'] = $tmp;


  $difference = floor($rest['day'] / 356);

  return $difference;
}

if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {

    if (isset($_POST['ppr']) and isset($_POST['materiel']) and isset($_POST['option'])) {
      $_POST['ppr'] = htmlspecialchars($_POST['ppr']);
      $_POST['materiel'] = htmlspecialchars($_POST['materiel']);
      $_POST['option'] = htmlspecialchars($_POST['option']);

      if ($_POST['option'] == 'PC') {
        $reponse = $bdd->prepare('INSERT INTO Employé_Matériel(EM_ppr,EM_Série,date_activation) VALUES (?,?,NOW())');
        $reponse->execute(array($_POST['ppr'], $_POST['materiel']));
        $reponse->closeCursor();
        $reponse = $bdd->prepare('UPDATE  Matériels SET etat=\'NON RéFORME\' WHERE N_Série=?');
        $reponse->execute(array($_POST['materiel']));
        $reponse->closeCursor();
        $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_Série=? AND EM_ppr!=?');
        $reponse->execute(array($_POST['materiel'], $_POST['ppr']));
        if ($reponse->rowCount() == 0) {
          $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte-1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 

       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
          $reponse2->execute(array($_POST['materiel']));
          $reponse2->closeCursor();
        }
        $reponse->closeCursor();
      } else  if ($_POST['option'] == 'Imprimante') {


        $reponse = $bdd->prepare('INSERT INTO Employé_Matériel(EM_ppr,EM_Série,date_activation) VALUES (?,?,NOW())');
        $reponse->execute(array($_POST['ppr'], $_POST['materiel']));
        $reponse->closeCursor();
        $reponse = $bdd->prepare('UPDATE  Matériels SET etat=\'NON RéFORME\' WHERE N_Série=?');
        $reponse->execute(array($_POST['materiel']));
        $reponse->closeCursor();


        $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_Série=? AND EM_ppr!=?');
        $reponse->execute(array($_POST['materiel'], $_POST['ppr']));
        if ($reponse->rowCount() == 0) {
          $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte-1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 

       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
          $reponse2->execute(array($_POST['materiel']));
          $reponse2->closeCursor();
        }
        $reponse->closeCursor();
      }
    }
  } else if ($_GET['numero'] == 2) {

    if (isset($_POST['change'])  and isset($_POST['N_Série']) and isset($_POST['marque']) and isset($_POST['ppr'])) {
      echo "bonjeur";

      $_POST['marque'] = strip_tags($_POST['marque']);
      $_POST['N_Série'] = strip_tags($_POST['N_Série']);
      $_POST['type'] = strip_tags($_POST['type']);
      $_POST['ppr'] = strip_tags($_POST['ppr']);
      $reponse = $bdd->prepare('SELECT date_stockage FROM Arrivage_Marché INNER JOIN Matériels ON Matériels.id_arrivage=Arrivage_Marché.id WHERE N_Série=?  ');
      $reponse->execute(array($_POST['N_Série']));
      if ($donnes = $reponse->fetch()) {
        $arrivage_date = $donnes['date_stockage'];
      }

      $reponse->closeCursor();
      $now = time();
      $date = strtotime($arrivage_date);

      $resultat = date_ans($now, $date);
      if ($resultat >= 5) {
        $reponse = $bdd->prepare('UPDATE Matériels SET etat=\'RéFORME\' WHERE N_Série=?');
        $reponse->execute(array($_POST['N_Série']));
        $reponse->closeCursor();
        $reponse = $bdd->prepare('DELETE FROM  Matériels WHERE N_Série=?');
        $reponse->execute(array($_POST['N_Série']));
        $reponse->closeCursor();
      } else {
        $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_Série=? AND EM_ppr!=?');
        $reponse->execute(array($_POST['N_Série'], $_POST['ppr']));
        if ($reponse->rowCount() == 0) {
          $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte+1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 

       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
          $reponse2->execute(array($_POST['N_Série']));
          $reponse2->closeCursor();
          $reponse2 = $bdd->prepare('UPDATE Matériels SET etat=\'EN STOCK\' WHERE N_Série=?');
          $reponse2->execute(array($_POST['N_Série']));
          $reponse2->closeCursor();
        }
        $reponse->closeCursor();
      }
      $reponse = $bdd->prepare('UPDATE Employé_Matériel SET EM_Série=?,date_activation=NOW() WHERE EM_ppr=? AND EM_Série=?');
      $reponse->execute(array($_POST['marque'], $_POST['ppr'], $_POST['N_Série']));
      $reponse->closeCursor();
      $reponse = $bdd->prepare('UPDATE Matériels SET etat=\'NON RéFORME\' WHERE N_Série=?');
      $reponse->execute(array($_POST['marque']));
      $reponse->closeCursor();
      $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_Série=? AND EM_ppr!=?');
      $reponse->execute(array($_POST['marque'], $_POST['ppr']));
      if ($reponse->rowCount() == 0) {
        $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte-1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 
       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
        $reponse2->execute(array($_POST['marque']));
        $reponse2->closeCursor();
      }
      $reponse->closeCursor();
      $reponse = $bdd->prepare('DELETE FROM Employé_Matériel WHERE EM_ppr=? AND EM_Série=?');
      $reponse->execute(array($_POST['ppr'], $_POST['N_Série']));
      $reponse->closeCursor();
    }
  } else if ($_GET['numero'] == 3) {
    if (isset($_POST['ppr']) and isset($_POST['serie'])) {

      $_POST['serie'] = strip_tags($_POST['serie']);
      $_POST['ppr'] = strip_tags($_POST['ppr']);
      $reponse = $bdd->prepare('SELECT date_stockage FROM Arrivage_Marché INNER JOIN Matériels ON Matériels.id_arrivage=Arrivage_Marché.id WHERE N_Série=?  ');
      $reponse->execute(array($_POST['serie']));
      if ($donnes = $reponse->fetch()) {
        $arrivage_date = $donnes['date_stockage'];
      }

      $reponse->closeCursor();
      $now = time();
      $date = strtotime($arrivage_date);

      $resultat = date_ans($now, $date);
      if ($resultat >= 5) {
        $reponse = $bdd->prepare('UPDATE Matériels SET etat=\'RéFORME\' WHERE N_Série=?');
        $reponse->execute(array($_POST['serie']));
        $reponse->closeCursor();
        $reponse = $bdd->prepare('DELETE FROM  Matériels WHERE N_Série=?');
        $reponse->execute(array($_POST['serie']));
        $reponse->closeCursor();
      } else {
        $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_Série=? AND EM_ppr!=?');
        $reponse->execute(array($_POST['serie'], $_POST['ppr']));
        if ($reponse->rowCount() == 0) {
          $reponse2 = $bdd->prepare('UPDATE Arrivage_Marché SET qte=qte+1 WHERE id=(SELECT Arrivage_Marché.id as id FROM Arrivage_Marché INNER JOIN Matériels ON 

       Arrivage_Marché.id=Matériels.id_arrivage WHERE N_Série=?)');
          $reponse2->execute(array($_POST['serie']));
          $reponse2->closeCursor();
          $reponse2 = $bdd->prepare('UPDATE Matériels SET etat=\'EN STOCK\' WHERE N_Série=?');
          $reponse2->execute(array($_POST['serie']));
          $reponse2->closeCursor();
        }
        $reponse->closeCursor();
      }

      $reponse = $bdd->prepare('DELETE FROM Employé_Matériel WHERE EM_ppr=? AND EM_Série=?');
      $reponse->execute(array($_POST['ppr'], $_POST['serie']));
      $reponse->closeCursor();
    }
  }
}
