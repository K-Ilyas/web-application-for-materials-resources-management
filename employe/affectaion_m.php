<?php header("Content-type: text/javascript");
require __DIR__ . './../db.php';

if (isset($_GET['numero'])) {


  if ($_GET['numero'] == 1) {
?>
    var option=document.getElementById('option');
    var ppr=document.getElementById('ppr');
    if(option.selectedIndex!=0)
    {
    if(option.selectedIndex==1)
    {

    ppr.inneHTML="";
    ppr.innerHTML="<?php echo '<option selected disabled >votre choix</option>' ?>";

    <?php
    $reponse = $bdd->query('SELECT ppr  FROM Employé WHERE ppr NOT IN(SElECT ppr FROM Employé INNER JOIN Employé_Matériel ON 


          Employé_Matériel.EM_ppr=Employé.ppr INNER JOIN Matériels ON Employé_Matériel.EM_Série=Matériels.N_Série WHERE type=\'PC\')');

    while ($donnes = $reponse->fetch()) {

    ?>
      ppr.innerHTML+="<?php echo '<option>' . $donnes['ppr'] . '</option>' ?>";

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

    $reponse = $bdd->query('SELECT ppr  FROM Employé WHERE ppr NOT IN(SElECT ppr FROM Employé INNER JOIN Employé_Matériel ON 


          Employé_Matériel.EM_ppr=Employé.ppr INNER JOIN Matériels ON Employé_Matériel.EM_Série=Matériels.N_Série WHERE type=\'IMP\')');

    while ($donnes = $reponse->fetch()) {

    ?>
      ppr.innerHTML+="<?php echo '<option>' . $donnes['ppr'] . '</option>' ?>";

    <?php


    }
    $reponse->closeCursor();
    ?>

    }
    }
  <?php
  } else if ($_GET['numero'] == 2 and isset($_GET['ppr'])) {

  ?>
    var materiel=document.getElementById('materiel');
    var ppr=document.getElementById('ppr');


    var option=document.getElementById('option');

    if(option.selectedIndex!=0)
    {
    if(option.options[option.selectedIndex].textContent=="PC")
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
                     AND etat=\'NON RéFORME\'');
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
    materiel.innerHTML="<?php echo '<option selected disabled >votre choix</option>' ?>";
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
                   AND etat=\'NON RéFORME\'  ');
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