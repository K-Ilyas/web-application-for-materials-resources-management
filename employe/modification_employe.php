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


function password($numbre, $chaine = 'rezatyuiopqsdfhgjklwmxcvbn123456789')
{
  $nbombre_lettre = strlen($chaine) - 1;
  $password = '';
  for ($i = 0; $i < $numbre; $i++) {
    $j = mt_rand(0, $nbombre_lettre);
    $lettre = $chaine[$j];
    $password .= $lettre;
  }
  return ucwords($password);
}


function ppr($id)
{

  $ppr = 'DGIA' . date("Ym") . $id;
  return $ppr;
}
if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {



    echo $_POST['etat'];

    if (
      isset($_FILES['image']) and ($_FILES['image']['error'] == 0)  and isset($_POST['nom'])  and
      isset($_POST['prénom']) and isset($_POST['email']) and isset($_POST['sexe']) and isset($_POST['téléphone']) and
      isset($_POST['ville']) and isset($_POST['entite']) and isset($_POST['etat'])
    ) {



      if ($_FILES['image']['size'] <= 1000000) {
        $infosfichier = pathinfo($_FILES['image']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
        $time = time();
        if (in_array($extension_upload, $extensions_autorisees)) {
          move_uploaded_file($_FILES['image']['tmp_name'], '../Images/' . $time . '.' . $extension_upload . '');
        }
      }

      $_POST['image'] = strip_tags('Images/' .  $time  . '.' . $extension_upload);
      $_POST['nom'] = '' . strip_tags(strtoupper($_POST['nom'])) . '';
      $reponse = $bdd->query('SELECT MAX(id) as id FROM Employé');
      if ($donne = $reponse->fetch()) {
        $id = $donne['id'] + 1;
      }
      $reponse->closeCursor();
      $_ppr = ppr($id);
      $_SESSION['ppr_employe'] = $_ppr;
      if (isset($_POST['imp'])) {
        $_SESSION['imp'] = "on";
      }
      $_POST['prénom'] = '' . strip_tags(strtoupper($_POST['prénom'])) . '';
      $_POST['ville'] = '' . $_POST['ville'] . '';
      $_POST['entite'] = '' . $_POST['entite'] . '';
      $_POST['email'] = '' . strip_tags($_POST['email']) . '';
      $_POST['téléphone'] = '' . strip_tags($_POST['téléphone']) . '';
      $_POST['sexe'] = '' . strip_tags($_POST['sexe']) . '';
      $_POST['entite'] = '' . strip_tags($_POST['entite']) . '';
      $_POST['etat'] = '' . strip_tags($_POST['etat']) . '';
      $array = array();

      $reponse = $bdd->query('SELECT password FROM Employé');
      while ($donnes = $reponse->fetch()) {
        $array[] = $donnes['password'];
      }
      $reponse->closeCursor();
      $password = 0;
      $password_hash = 0;
      do {
        $password = password(8);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
      } while (in_array($password_hash, $array));





      $reponse = $bdd->prepare('INSERT INTO Employé (chemin_image, ppr, nom, prénom,  sexe,  email, téléphone, ville,date_inscription,password  ,id_entite,etat) VALUES(?,?,?,?,?,?,?,?,NOW(),?,?,?)');
      $reponse->execute(array($_POST['image'], $_ppr, $_POST['nom'], $_POST['prénom'], $_POST['sexe'], $_POST['email'], $_POST['téléphone'], $_POST['ville'], $password_hash, $_POST['entite'], $_POST['etat']));

      $reponse->closeCursor();
      $resultat = 0;
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $destination = "" . $_POST['email'] . "";
        $sujet = "Identification!!! - DGI";
        $contenu = "<html><head></head><body>";
        $contenu .= "<p><strong style='background-color:red;'>LOGIN:</strong>" . $_ppr . "</p>";
        $contenu .= "<p><strong style='background-color:red;'>password:</strong>" . $password . "</p>";
        $contenu .= "</body><html>";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers = 'From: @gmail.com' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";/**/
        $resultat = mail($destination, $sujet, $contenu, $headers);
      }
      if ($resultat) {
        $bdd = NULL;
        ob_end_clean();
      }
    }
  } else if ($_GET['numero'] == 2) {
    if (isset($_POST['id'])) {

      if (isset($_FILES['image']) and $_FILES['image']['error'] == 0) {


        if ($_FILES['image']['size'] <= 1000000) {
          $infosfichier = pathinfo($_FILES['image']['name']);
          $extension_upload = $infosfichier['extension'];
          $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
          $time = time();
          if (in_array($extension_upload, $extensions_autorisees)) {
            move_uploaded_file($_FILES['image']['tmp_name'], '../Images/' .  $time . '.' . $extension_upload . '');
            $reponse = $bdd->prepare('UPDATE Employé SET chemin_image=? WHERE id=?');
            $reponse->execute(array(strip_tags('Images/' .  $time . '.' . $extension_upload), $_POST['id']));
            $reponse->closeCursor();
          }
        }
      }
      if (
        isset($_POST['nom']) and isset($_POST['prénom']) and isset($_POST['entite']) and isset($_POST['sexe']) and isset($_POST['email']) and isset($_POST['téléphone']) and isset($_POST['ville'])  and isset($_POST['entite']) and isset($_POST['etat'])
      ) {


        $_POST['nom'] = strip_tags(strtoupper($_POST['nom']));
        $_POST['prénom'] = strip_tags(strtoupper($_POST['prénom']));
        $_POST['sexe'] = strip_tags($_POST['sexe']);
        $_POST['email'] = strip_tags($_POST['email']);
        $_POST['téléphone'] = strip_tags($_POST['téléphone']);
        $_POST['entite'] = strip_tags($_POST['entite']);
        $_POST['ville'] = strip_tags($_POST['ville']);
        $_POST['etat'] = strip_tags($_POST['etat']);

        $reponse = $bdd->prepare('UPDATE Employé SET  nom=?,prénom=?,sexe=?,email=?,téléphone=?,ville=?,id_entite=?,etat=? WHERE id=?');
        $reponse->execute(array($_POST['nom'], $_POST['prénom'], $_POST['sexe'], $_POST['email'], $_POST['téléphone'], $_POST['ville'], $_POST['entite'], $_POST['etat'], $_POST['id']));
        $reponse->closeCursor();
      }
    }
  } else if ($_GET['numero'] == 3) {
    if (isset($_POST['id'])) {


      $reponse = $bdd->prepare('SELECT ppr FROM Employé WHERE id=?');
      $reponse->execute(array($_POST['id']));
      if ($donnes = $reponse->fetch()) {
        $ppr = $donnes['ppr'];
      }
      $reponse->closeCursor();
      $reponse = $bdd->prepare('SELECT EM_Série FROM Employé INNER JOIN Employé_Matériel ON Employé.ppr=Employé_Matériel.EM_ppr
   WHERE ppr=?');

      $reponse->execute(array($ppr));
      while ($donnes = $reponse->fetch()) {
        echo $donnes['EM_Série'];
        $reponse2 = $bdd->prepare('SELECT date_stockage FROM Arrivage_Marché INNER JOIN Matériels ON Matériels.id_arrivage=Arrivage_Marché.id WHERE N_Série=?  ');

        $reponse2->execute(array($donnes['EM_Série']));
        if ($donnes2 = $reponse2->fetch()) {
          $arrivage_date = $donnes2['date_stockage'];
        }

        $reponse2->closeCursor();
        $now = time();
        $date = strtotime($arrivage_date);
        $resultat = date_ans($now, $date);
        if ($resultat >= 5) {
          $reponse2 = $bdd->prepare('UPDATE Matériels SET etat=\'RéFORME\' WHERE N_Série=?');
          $reponse2->execute(array($donnes['EM_Série']));
          $reponse2->closeCursor();
          $reponse2 = $bdd->prepare('DELETE FROM  Matériels WHERE N_Série=?');
          $reponse2->execute(array($donnes['EM_Série']));
          $reponse2->closeCursor();
        } else {
          $reponse2 = $bdd->prepare('UPDATE Matériels SET etat=\'EN STOCK\' WHERE N_Série=?');
          $reponse2->execute(array($donnes['EM_Série']));
          $reponse2->closeCursor();
        }
      }
      $reponse->closeCursor();
      $reponse2 = $bdd->prepare('DELETE FROM Employé WHERE id=?');
      $reponse2->execute(array($_POST['id']));
      $reponse2->closeCursor();
    }
  }
}
