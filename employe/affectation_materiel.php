<?php
ob_start();
session_start(); ?>

<?php
require __DIR__ . '/../db.php';

if (isset($_SESSION['ppr_employe'])) {
?>
  <style type="text/css">
    /*.input-group-addon,#send,#pc
     {                             
      background-color:white;
     }
    .modal-header
          {
            background-color:  rgb(243,243,243);
            border-bottom:1px solid lightgrey;
          }
          .modal-footer
          {
            border-top:1px solid lightgrey;
            background-color:  rgb(243,243,243);
          }
          #entite_pr
          {
            border-radius:20px 20px;
          }
          datalist 
          {
            width:600px;
          }
          */
  </style>
  <div class="modal-dialog">
    <div class="modal-content modal-c">
      <form action="employe/affection_materiel2.php" method="POST" id="form" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-header modal-h">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-workstation-35.png"> <span class="label label-warning">Matériels:</span></h4>
        </div>
        <div class="modal-body modal-b">
          <?php

          $reponse = $bdd->prepare('SELECT ppr FROM Employé WHERE ppr=?');
          $reponse->execute(array($_SESSION['ppr_employe']));
          if ($donnes = $reponse->fetch()) {
            $ppr = $donnes['ppr'];
          }
          $reponse->closeCursor();
          ?>
          <div class="form-group">
            <label for="nom">Matricule:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="ppr" id="ppr" placeholder="ppr" readonly value='<?php echo $ppr; ?>'>
              <span class="input-group-addon"><img src="icons/icons8-identification-documents-20 (1).png"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="nom">Ordinateur:</label>
            <div class="input-group">
              <input type="text" list="pc" name='pc' class="ppr tout form-control" placeholder="Ordinateur" required>
              <datalist id="pc" class="contenu">
                <?php
                $reponse = $bdd->query('SELECT marque,N_Série FROM Matériels WHERE etat=\'EN STOCK \' AND type=\'PC\'');


                while ($donnes = $reponse->fetch()) {


                  echo '<option value=' . $donnes['N_Série'] . '>' . $donnes['marque'] . '-' . $donnes['N_Série'] . '(nouveau)</option>';
                }
                $reponse->closeCursor();
                $reponse = $bdd->prepare('SELECT id_entite,abr FROM Entité  INNER JOIN Employé ON Entité.id=Employé.id_entite WHERE ppr=?');
                $reponse->execute(array($_SESSION['ppr_employe']));

                if ($donnes = $reponse->fetch()) {
                  if ($donnes['abr'] == "BAC") {
                    $reponse2 = $bdd->prepare('SELECT  marque,N_Série,ppr FROM Matériels INNER JOIN Employé_Matériel ON Matériels.N_Série=Employé_Matériel.EM_Série INNER JOIN Employé ON Employé.ppr=Employé_Matériel.EM_PPR WHERE id_entite=? AND type=\'PC\'
                     AND Matériels.etat=\'NON RéFORME\'');
                    $reponse2->execute(array($donnes['id_entite']));
                    while ($donnes2 = $reponse2->fetch()) {

                      echo  '<option value=' . $donnes2['N_Série'] . '>' . $donnes2['marque'] . '-' . $donnes2['ppr'] . '(NON RéFORME même entité)</option>';
                    }
                    $reponse2->closeCursor();
                  }
                }

                $reponse->closeCursor();



                ?>
              </datalist>
              <span class="input-group-addon"><img src="icons/icons8-monitor-20.png"> </span>
            </div>
          </div>

          <?php
          if (isset($_SESSION['imp'])) {
          ?>
            <div class="form-group">
              <label for="nom">Imprimante:</label>
              <div class="input-group">
                <input type="text" list="imp" name='imprimante' id="imprimante" class="ppr tout form-control" placeholder="Imprimante" required>

                <datalist id="imp" class="contenu">
                  <?php
                  $reponse = $bdd->query('SELECT marque,N_Série FROM Matériels WHERE etat=\'EN STOCK \' AND type=\'IMP\'');


                  while ($donnes = $reponse->fetch()) {


                    echo '<option value=' . $donnes['N_Série'] . '>' . $donnes['marque'] . '-' . $donnes['N_Série'] . '(nouveau)</option>';
                  }
                  $reponse->closeCursor();


                  $reponse2 = $bdd->prepare('SELECT  marque,N_Série,ppr FROM Matériels INNER JOIN Employé_Matériel ON Matériels.N_Série=Employé_Matériel.EM_Série INNER JOIN Employé ON Employé.ppr=Employé_Matériel.EM_PPR WHERE id_entite=? AND type=\'IMP\'
                  AND Matériels.etat=\'NON RéFORME\'');
                  $reponse2->execute(array($donnes['id_entite']));
                  while ($donnes2 = $reponse2->fetch()) {
                    echo  '<option value=' . $donnes2['N_Série'] . '>' . $donnes2['marque'] . '-' . $donnes2['ppr'] . '(NON RéFORME même entité)</option>';
                  }
                  $reponse2->closeCursor();
                  $reponse->closeCursor();
                  ?>

                </datalist>
                <span class="input-group-addon"><img src="icons/icons8-print-20.png"></span>

              </div>
            </div>
          <?php
          }
          ?>




        </div>
        <div class="modal-footer modal-f">
          <div class="pull-right">
            <button type="reset" class="btn btn-default btn-default btn-sm  end"><span class="label label-danger" style="font-size:1em;">Actualiser</span> <img src="icons/icons8-synchronize-25.png"></button>
            <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em;">Envoyer </span><img src="icons/icons8-paper-plane-25.png"></button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php
}
unset($_SESSION['imp']);
?>


<script type="text/javascript">
  $(function() {



    $(':input[readonly]').css({
      'background-color': 'white'
    });
    $("#form").submit(function(e) {
      $('#send').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
      e.preventDefault();
      var $form = $(this);
      $.ajax({
        type: 'POST',
        url: $form.attr("action"),
        mimeType: "multipart/form-data",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(donnes) {
          alert('ca marche ....');
          $('#info_em').modal('hide');

        },
        error: function() {
          alert('La requête n\'a pas abouti');
          $('#send').html('Envoyer');
        }
      });

    });
  });
</script>