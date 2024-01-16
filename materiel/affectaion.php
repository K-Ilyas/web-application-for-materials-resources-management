<?php header("Content-type: text/javascript");
require __DIR__ . '/../db.php';

if (isset($_GET['numero'])) {


  if ($_GET['numero'] == 1) {
?>
    var option=document.getElementById('option');
    var ppr=document.getElementById('mtr');
    if(option.selectedIndex!=0)
    {
    if(option.selectedIndex==1)
    {

    ppr.inneHTML="";
    ppr.innerHTML="<?php echo '<option selected disabled >votre choix</option>' ?>";

    <?php
    $reponse = $bdd->query('SELECT ppr,nom,prénom  FROM Employé WHERE ppr NOT IN(SElECT ppr FROM Employé INNER JOIN Employé_Matériel ON 


          Employé_Matériel.EM_ppr=Employé.ppr INNER JOIN Matériels ON Employé_Matériel.EM_Série=Matériels.N_Série WHERE type=\'PC\'  AND Employé.etat=\'simple\') AND Employé.etat=\'simple\'');

    while ($donnes = $reponse->fetch()) {

    ?>
      ppr.innerHTML+="<?php echo '<option value=' . $donnes['ppr'] . '>' . $donnes['ppr'] . '-->[' . $donnes['nom'] . $donnes['prénom'] . ']</option>' ?>";

    <?php


    }
    $reponse->closeCursor();
    ?>


    }
    else
    {
    ppr.innerHTML="";
    ppr.innerHTML="<?php echo '<option selected disabled >votre choix</option>' ?>";


    <?php

    $reponse = $bdd->query('SELECT ppr,nom,prénom  FROM Employé WHERE ppr NOT IN(SElECT ppr FROM Employé INNER JOIN Employé_Matériel ON 


          Employé_Matériel.EM_ppr=Employé.ppr INNER JOIN Matériels ON Employé_Matériel.EM_Série=Matériels.N_Série WHERE type=\'IMP\'  AND Employé.etat=\'simple\') AND Employé.etat=\'simple\'');

    while ($donnes = $reponse->fetch()) {

    ?>
      ppr.innerHTML+="<?php echo '<option value=' . $donnes['ppr'] . '>' . $donnes['ppr'] . '-->[' . $donnes['nom'] . $donnes['prénom'] . ']</option>' ?>";

    <?php


    }
    $reponse->closeCursor();
    ?>

    }
    }
  <?php
  } else if ($_GET['numero'] == 2 and isset($_GET['ppr'])) {

  ?>
    var materiel=document.getElementById('mat');
    var ppr=document.getElementById('mtr');


    var option=document.getElementById('option');

    if(option.selectedIndex!=0)
    {
    if(option.selectedIndex==1)
    {
    materiel.innerHTML="";
    materiel.innerHTML="<?php echo '<option selected disabled >votre choix</option>' ?>";

    <?php
    $reponse = $bdd->query('SELECT marque,N_Série FROM Matériels WHERE etat=\'EN STOCK \' AND type=\'PC\'');


    while ($donnes = $reponse->fetch()) {

    ?>
      materiel.innerHTML+="<?php echo '<option value=' . $donnes['N_Série'] . '>' . $donnes['marque'] . '-' . $donnes['N_Série'] . '(nouveau)</option>' ?>";


      <?php
    }

    $reponse->closeCursor();


    $reponse = $bdd->prepare('SELECT id_entite,abr FROM Entité  INNER JOIN Employé ON Entité.id=Employé.id_entite WHERE ppr=?');
    $reponse->execute(array($_GET['ppr']));

    if ($donnes = $reponse->fetch()) {
      if ($donnes['abr'] == "BAC") {
        $reponse2 = $bdd->prepare('SELECT  marque,N_Série,ppr FROM Matériels INNER JOIN Employé_Matériel ON Matériels.N_Série=Employé_Matériel.EM_Série INNER JOIN Employé ON Employé.ppr=Employé_Matériel.EM_PPR WHERE id_entite=? AND type=\'PC\'
                     AND Matériels.etat=\'NON RéFORME\'');
        $reponse2->execute(array($donnes['id_entite']));
        while ($donnes2 = $reponse2->fetch()) {
      ?>
          materiel.innerHTML+="<?php echo  '<option value=' . $donnes2['N_Série'] . '>' . $donnes2['marque'] . '-' . $donnes2['ppr'] . '(NON RéFORME même entité)</option>' ?>";

    <?php


        }


        $reponse2->closeCursor();
      }

      $reponse->closeCursor();
    }



    ?>
    }
    else if(option.selectedIndex==2)
    {
    materiel.innerHTML="";
    <?php


    $reponse = $bdd->query('SELECT marque,N_Série FROM Matériels WHERE etat=\'EN STOCK \' AND type=\'IMP\' ');

    while ($donnes = $reponse->fetch()) {
    ?>


      materiel.innerHTML+="<?php echo '<option value=' . $donnes['N_Série'] . '>' . $donnes['marque'] . '-' . $donnes['N_Série'] . '(nouveau)</option>' ?>";

      <?php

    }
    $reponse->closeCursor();


    $reponse = $bdd->prepare('SELECT id_entite  FROM Employé  WHERE ppr=?');
    $reponse->execute(array($_GET['ppr']));

    if ($donnes = $reponse->fetch()) {
      $reponse2 = $bdd->prepare('SELECT marque,N_Série,ppr FROM Matériels INNER JOIN Employé_Matériel ON Matériels.N_Série=Employé_Matériel.EM_Série INNER JOIN Employé ON Employé.ppr=Employé_Matériel.EM_PPR WHERE id_entite=? AND type=\'IMP\'
                   AND Matériels.etat=\'NON RéFORME\'  ');
      $reponse2->execute(array($donnes['id_entite']));
      while ($donnes2 = $reponse2->fetch()) {
      ?>
        materiel.innerHTML+="<?php echo  '<option value=' . $donnes2['N_Série'] . '>' . $donnes2['marque'] . '-' . $donnes2['ppr'] . '(NON RéFORME même entité)</option>' ?>";

    <?php


      }

      $reponse2->closeCursor();
    }

    $reponse->closeCursor();



    ?>

    }
    }

<?php

  }
}

?>