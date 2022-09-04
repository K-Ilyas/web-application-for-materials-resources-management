<?php header("Content-type: text/javascript");
require __DIR__ . './../db.php';
?>
var contenu=document.getElementById('contenu_ppr');
contenu.innerHTML="";
<?php
if (isset($_GET['serie'])) {
?>

  contenu.innerHTML="";
  <?php

  $reponse = $bdd->prepare('SELECT EM_ppr FROM Employé_Matériel WHERE EM_série=?');
  $reponse->execute(array($_GET['serie']));
  while ($donnes = $reponse->fetch()) {
  ?>
    contenu.innerHTML+="<?php echo '<option value=' . $donnes['EM_ppr'] . '>' . $donnes['EM_ppr'] . '</option>' ?>";

<?php
  }
  $reponse->closeCursor();
}

?>