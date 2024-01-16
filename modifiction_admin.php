<?php
session_start();
require __DIR__ . '/db.php';
if (isset($_GET['numero'])) {

  if ($_GET['numero'] == 1) {


    if (isset($_SESSION['ppr_admin'])) {
      if (isset($_FILES['image']) and $_FILES['image']['error'] == 0) {

        if ($_FILES['image']['size'] <= 1000000) {
          $infosfichier = pathinfo($_FILES['image']['name']);
          $extension_upload = $infosfichier['extension'];
          $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
          if (in_array($extension_upload, $extensions_autorisees)) {
            $reponse = $bdd->query('SELECT MAX(id) AS id FROM Employé');
            $donnes = $reponse->fetch();
            $valeur = $donnes['id'] + 1;
            $reponse->closeCursor();
            $file = 'Images/' . time() . '.' . $extension_upload;
            move_uploaded_file($_FILES['image']['tmp_name'], $file . '');
            $reponse = $bdd->prepare('UPDATE Employé SET chemin_image=? WHERE ppr=?');
            $reponse->execute(array(strip_tags($file), $_SESSION['ppr_admin']));
            $reponse->closeCursor();
            setcookie('image_admin', strip_tags($file), time() + 365 * 24 * 3600, null, null, false, true);
          }
        }
      }
      if (
        isset($_POST['ppr']) and isset($_POST['nom']) and isset($_POST['prénom']) and isset($_POST['id_entite']) and isset($_POST['sexe']) and isset($_POST['email']) and isset($_POST['téléphone']) and isset($_POST['ville'])  and isset($_POST['id_entite'])
      ) {
        $_POST['nom'] = strip_tags(strtoupper($_POST['nom']));
        $_POST['ppr'] = strip_tags(strtoupper($_POST['ppr']));
        $_POST['prénom'] = strip_tags(strtoupper($_POST['prénom']));
        $_POST['sexe'] = strip_tags($_POST['sexe']);
        $_POST['email'] = strip_tags($_POST['email']);
        $_POST['téléphone'] = strip_tags($_POST['téléphone']);
        $_POST['id_entite'] = strip_tags($_POST['id_entite']);
        $reponse = $bdd->query('SELECT id,ville FROM ville');
        while ($donnes = $reponse->fetch()) {
          if ($donnes['ville'] == $_POST['ville']) {
            $id_ville = $donnes['id'];
            $reponse->closeCursor();
            break;
          }
        }
        $reponse = $bdd->query('SELECT id FROM Entité');
        while ($donnes = $reponse->fetch()) {
          if (stristr($_POST['id_entite'], $donnes['id'])) {
            $id_entite = $donnes['id'];
            $reponse->closeCursor();
          }
        }

        if ($_POST['ppr'] != $_SESSION['ppr_admin']) {
          $reponse = $bdd->prepare('UPDATE Employé SET  ppr=?,nom=?,prénom=?,sexe=?,email=?,téléphone=?,ville=?,id_entite=? WHERE ppr=?');
          $reponse->execute(array($_POST['ppr'], $_POST['nom'], $_POST['prénom'], $_POST['sexe'], $_POST['email'], $_POST['téléphone'], $id_ville, $id_entite, $_SESSION['ppr_admin']));
          $reponse->closeCursor();
          setcookie('ppr_admin', $_POST['ppr'], time() + 365 * 24 * 3600, null, null, false, true);
        } else {
          $reponse = $bdd->prepare('UPDATE Employé SET nom=?,prénom=?,sexe=?,email=?,téléphone=?,ville=?,id_entite=? WHERE ppr=?');
          $reponse->execute(array($_POST['nom'], $_POST['prénom'], $_POST['sexe'], $_POST['email'], $_POST['téléphone'], $id_ville, $id_entite, $_SESSION['ppr_admin']));
          $reponse->closeCursor();
        }
      }
    }
  } else if ($_GET['numero'] == 2) {
    if (isset($_POST['nouveau_pwd']) and isset($_SESSION['ppr_admin'])) {
      $pass = password_hash($_POST['nouveau_pwd'], PASSWORD_DEFAULT);
      $reponse = $bdd->prepare('UPDATE Employé SET  password=? WHERE ppr=?');
      $reponse->execute(array($pass, $_SESSION['ppr_admin']));
    }
  }
}
