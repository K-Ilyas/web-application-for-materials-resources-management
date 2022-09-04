<?php
if (isset($_POST['id'])) {

  header('Content-Type: text/pdf; charset=utf-8');
  $_POST['id'] = htmlspecialchars($_POST['id']);
  require __DIR__ . './../db.php';

  $array = array();
  $reponse = $bdd->prepare("SELECT * FROM BL_Consommable WHERE id=?");
  $reponse->execute(array($_POST['id']));
  if ($donnes = $reponse->fetch()) {
    $serie = $donnes['BL_série'];
    $array[] = $donnes['BL_série'];
    $array[] = $donnes['BL_réf'];
    $date = $donnes['BL_date'];
    $array[] = $donnes['qte_livre'];
    $array[] = $donnes['compteur'];
    $N_BL = $donnes['N_BL'];
  }

  $reponse->closeCursor();

  $reponse = $bdd->prepare('SELECT marque,libellé,nom,prénom FROM Employé INNER JOIN Employé_Matériel ON Employé.ppr=Employé_Matériel.EM_ppr 
    INNER JOIN Matériels ON Matériels.N_Série=Employé_Matériel.EM_Série  INNER JOIN Entité ON Entité.id=Employé.id_entite WHERE EM_Série=?');
  $reponse->execute(array($serie));
  if ($donnes = $reponse->fetch()) {
    $entite = $donnes['libellé'];
    $nom = $donnes['nom'] . ' ' . $donnes['prénom'];
    $marque = $donnes['marque'];
  }
  $reponse->closeCursor();


  require('fpdf/fpdf.php');

  class PDF extends FPDF
  {
    // En-tête
    function Header()
    {
      // Logo
      $this->Image('logo_mef_vd.jpg', 10, 10, 40);

      $this->SetFont('Arial', 'B', 15);
      $this->Cell(80);
      $this->Image('royaume-maroc.jpg', 85, 7, 40);

      $this->cell(80);
      $this->Image('logo_D_G_i.jpg', 160, 7, 45, 35);

      $this->Ln(40);
      $this->SetFont('Arial', '', 8);
      $this->Cell(30);
      $w = $this->getStringWidth('DIRECTION REGIONALE DES IMPOTS D\'AGADIR');
      $this->Cell(10, 4, 'DIRECTION REGIONALE DES IMPOTS D\'AGADIR', 0, 1, 'C');
      $this->Cell($w, 4, '----', 0, 1, 'C');
      $this->Cell($w, 4, 'SERVICE REGIONAL DES RESSOURCES', 0, 1, 'C');
      $this->Cell($w, 4, 'ET DU SYSTEME D\'INFORMATION ', 0, 1, 'C');
      $this->Cell($w, 4, '----', 0, 1, 'C');
      $this->SetFont('Arial', 'B', 8);
      $this->Cell($w, 4, 'Centre Regional Informatique', 0, 1, 'C');
      $this->Ln(5);
      $this->SetFont('Times', 'B', 16);

      $this->SetX(70);

      $this->SetDrawColor(0, 80, 180);
      $this->SetFillColor(230, 230, 0);
      $this->SetTextColor(220, 50, 50);
      $this->SetLineWidth(2);
      $this->Cell(70, 10, 'Bon de livraison', 1, 0, 'C');
    }
    function milieu($date, $entite, $nom, $N_BL)
    {
      $this->Ln(30);
      $this->SetFont('Arial', 'B', 10);
      $w = $this->getStringWidth('DATE:' . date("d/m/Y") . '');
      $this->Cell(2);
      $this->Cell($w, 4, 'DATE:' . $date . '', 0, 1, 'L');
      $this->Cell(2);
      $this->Cell($w, 4, 'N_BL :' . $N_BL . date('/Y') . '', 0, 1, 'L');
      $this->Ln(10);
      $this->Cell(20);
      $w = $this->getStringWidth(chr(127) . ' Entité:');
      $this->Cell($w, 5, chr(127) . utf8_decode(' Entité     :' . $entite), 0, 1, 'L');
      $this->Cell(20);
      $this->Cell($w, 5, chr(127) . ' Demandeur  :' . $nom, 0, 1, 'L');
    }
    function BasicTable($marque, $that, $nom)
    {
      $this->SetFont('Arial', 'B', 10);
      $this->Ln(15);
      $this->SetX(18);


      $this->Cell(30, 8, 'Imprimante', 1, 0, 'C');
      $this->Cell(30, 8, 'S/N', 1, 0, 'C');
      $this->Cell(45, 8, utf8_decode('Réf. consommable'), 1, 0, 'C');
      $this->Cell(25, 8, 'Qte', 1, 0, 'C');
      $this->Cell(45, 8, 'Compteur d\'impression', 1, 0, 'C');


      $this->Ln();
      $this->SetX(18);
      $this->SetFont('Arial', '', 8);

      $this->Cell(30, 8, $marque, 1, 0, 'C');
      $this->Cell(30, 8, $that[0], 1, 0, 'C');
      $this->Cell(45, 8, $that[1], 1, 0, 'C');
      $this->Cell(25, 8, $that[2], 1, 0, 'C');
      $this->Cell(45, 8, $that[3], 1, 0, 'C');

      $this->Ln(20);
      $this->Cell(100);
      $this->SetFont('Arial', 'UB', 10);
      $this->Cell(45, 8, utf8_decode('Emargement du récepteur'), 0, 1, 'L');
      $this->SetFont('Arial', '', 10);
      $this->Ln(5);
      $this->Cell(80);
      $this->Cell(45, 8, utf8_decode('Nom et prénom :' . $nom), 0, 1, 'L');
      $this->Ln(20);
      $this->SetFont('Arial', 'B', 10);
      $this->line(10, 217, 200, 217);
      $this->Cell(10, 0, utf8_decode('Cadre réservé au resposable du centre régional informatique'), 0, 1, 'L');
      $this->Ln(10);
      $this->cell(73);
      $this->SetFont('Arial', 'UB', 10);
      $this->Cell(80, 30, 'Visa Responsable de CRI', 0, 1, 'L');
      $this->SetFont('Arial', 'I', 10);
      $this->cell(55);
      $this->Cell(8, 5, utf8_decode('Nom et prénom :'), 0, 1, 'L');
      $this->Rect(60, 240, 94, 40);
    }


    function Footer()
    {
      // Positionnement à 1,5 cm du bas
      $this->SetY(-15);
      // Police Arial italique 8
      $this->SetFont('Arial', 'I', 8);
      // Numéro de page
      $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
  }

  $pdf = new PDF();


  $pdf->AliasNbPages();
  $pdf->AddPage('P', 'A4', 0);
  $pdf->SetFont('Times', '', 10);
  $pdf->milieu($date, $entite, $nom, $N_BL);

  $pdf->BasicTable($marque, $array, $nom);
  $reponse->closeCursor();
  $pdf->output();


  unset($_POST['id']);
}
