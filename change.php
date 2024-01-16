<?php header('type-content:text/html');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require __DIR__ . '/db.php';
function code($numbre, $chaine = '0123456789')
{
  $nbombre_numero = strlen($chaine) - 1;
  $code = '';
  for ($i = 0; $i < $numbre; $i++) {
    if ($i == 0) {
      $j = mt_rand(0, $nbombre_numero);
      $numero = $chaine[$j];
      if ($numero == '0') {
        $i--;
      } else {
        $code .= $numero;
      }
    } else {

      $j = mt_rand(0, $nbombre_numero);
      $numero = $chaine[$j];
      $code .= $numero;
    }
  }
  return $code;
}

if (isset($_POST['numero'])) {



  if ($_POST['numero'] == 1 and isset($_POST['email'])) {
    $reponse = $bdd->prepare('SELECT email FROM Employé WHERE email=?');
    $reponse->execute(array($_POST['email']));
    if ($reponse->rowCount() > 0) {
      $code = code(8);

      $resultat = 0;
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $contenu = "<html><head></head><body>";
        $contenu .= "<p><strong style='background-color:red;'>CODE:</strong>" . $code . "</p>";
        $contenu .= "</body><html>";
        $body = $contenu;
        $subject = "Code Validation!!! - DGI";
        $email_to = $_POST['email'];
        $fromserver = "contact@gmail.com";
        $mail = new PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // // Enter your host here
        $mail->Username = "<Email>"; // Enter your email here
        $mail->Password = "<password>"; //Enter your password here
        $mail->IsHTML(true);
        $mail->From = "contact@gmail.com";
        $mail->FromName = "Your Team";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        $resultat = $mail->Send();
      }
      if ($resultat) {
        $reponse->closeCursor();
        $reponse = $bdd->prepare('SELECT Email FROM forget_password WHERE Email=?');
        $reponse->execute(array($_POST['email']));
        if ($reponse->rowCount() > 0) {
          $reponse->closeCursor();
          $reponse = $bdd->prepare('UPDATE forget_password SET code=? WHERE Email=?');
          $reponse->execute(array(password_hash($code, PASSWORD_DEFAULT), $_POST["email"]));
        } else {
          $reponse->closeCursor();
          $reponse = $bdd->prepare('INSERT INTO  forget_password(Email,code) VALUES(?,?)');
          $reponse->execute(array($_POST["email"], password_hash($code, PASSWORD_DEFAULT)));
        }
        echo "true";
      }
    } else {
      echo "false";
    }
  } else if ($_POST['numero'] == 2 and isset($_POST['email']) and isset($_POST['code'])) {
    $reponse = $bdd->prepare('SELECT code FROM forget_password WHERE Email=?');
    $reponse->execute(array($_POST['email']));
    if ($reponse->rowCount() > 0) {
      $donnes = $reponse->fetch();
      $isCodeCorrect = password_verify($_POST['code'], $donnes['code']);
      if ($isCodeCorrect) {
        echo 'true';
        $reponse->closeCursor();
      }
    } else {
      echo 'false';
    }
  } else if ($_POST['numero'] == 3 and isset($_POST['email']) and isset($_POST['password'])) {
    $reponse = $bdd->prepare('SELECT email FROM Employé WHERE email=?');
    $reponse->execute(array($_POST['email']));
    if ($reponse->rowCount() > 0) {
      $reponse->closeCursor();
      try {
        $reponse = $bdd->prepare('UPDATE Employé SET password=? WHERE email=?');
        $reponse->execute(array(password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST["email"]));
        $reponse->closeCursor();
      } catch (Exception $e) {
        die('Erreur:' . $e->getMessage());
      }
      echo 'true';
    } else {
      $reponse->closeCursor();
      echo 'false';
    }
  } else {
    echo 'false';
  }
}
