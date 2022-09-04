<?php
session_start();

require __DIR__ . './../db.php';

if (isset($_POST['ppr']) and isset($_POST['serie'])) {
  $_SESSION['ppr'] = $_POST['ppr'];
  $_SESSION['serie'] = $_POST['serie'];
?>



  <div class="modal-dialog">

    <div class="modal-content modal-c" id="html">
      <form action="materiel/modification_materiel.php?numero=2" method="POST" id="form" autocomplete="off" enctype="multipart/form-data">

        <div class="modal-header modal-h">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><img src="icons/icons8-workstation-35.png"> <span class="label label-warning">Matériels:</span></h4>

        </div>
        <div class="modal-body modal-b">



          <div class="form-group">
            <label for="prénom">Matricule:</label>
            <div class="input-group">
              <input type="text" class="form-control" value='<?php echo $_POST['ppr']; ?>' name="ppr" id="prénom" readonly>
              <input type="hidden" value='<?php echo $_POST['ppr']; ?>' name="ppr">
              <span class="input-group-addon"><img src="icons/icons8-identification-documents-20 (1).png"></span>
            </div>
          </div>
          <?php
          $reponse = $bdd->prepare('SELECT ppr,M.id as id,M.N_Série,M.marque,M.type as type ,
            M.etat as etat,M.id_arrivage,date_activation FROM Employé INNER JOIN Employé_Matériel ON 
            Employé.ppr=Employé_Matériel.EM_ppr INNER JOIN  Matériels as  M ON M.N_Série=Employé_Matériel.EM_Série WHERE M.N_Série=? AND ppr=?');
          $reponse->execute(array($_POST['serie'], $_POST['ppr']));
          if ($donnes = $reponse->fetch()) {
          ?>
            <div class="form-group">
              <label for="serie">N Série:</label>
              <div class="input-group">
                <input type="text" class="form-control" value='<?php echo $donnes['N_Série']; ?>' readonly>
                <input type="hidden" value='<?php echo $_POST['serie']; ?>' name="N_Série">
                <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="type">Type:</label>
              <div class="input-group">
                <input type="text" name="type" class="form-control" value='<?php echo $donnes['type']; ?>' readonly>
                <span class="input-group-addon"><img src="icons/icons8-type-20 (1).png"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="etat">Etat:</label>
              <div class="input-group">
                <input type="text" name="etat" class="form-control" value='<?php echo $donnes['etat']; ?>' readonly>
                <span class="input-group-addon"><img src="icons/icons8-states-20.png"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="marque">Marque:</label>
              <span style="color:red;font-size:0.8em;font-style:italic;">(modifiable)</span>
              <div class="input-group">
                <select id="select" name='marque' class="form-control" disabled>
                  <option value='<?php echo $_POST['serie'] ?>' selected> <?php echo $donnes['marque'] . ' (par defaut)'; ?></option>
                  <?php

                  if (strcmp($donnes['type'], "PC") == 0) {

                  ?>

                    <?php

                    $reponse3 = $bdd->query('SELECT marque,N_Série FROM Matériels WHERE etat=\'EN STOCK \' AND type=\'PC\'');


                    while ($donnes3 = $reponse3->fetch()) {

                    ?>
                      <option value='<?php echo $donnes3['N_Série']; ?>'><?php echo $donnes3['marque'] . '-' . $donnes3['N_Série'] . '(nouveau)'; ?></option>


                      <?php
                    }

                    $reponse3->closeCursor();


                    $reponse2 = $bdd->prepare('SELECT id_entite,abr FROM Entité  INNER JOIN Employé ON Entité.id=Employé.id_entite WHERE ppr=?');
                    $reponse2->execute(array($donnes['ppr']));

                    if ($donnes2 = $reponse2->fetch()) {
                      if ($donnes2['abr'] == "BAC") {
                        $reponse3 = $bdd->prepare('SELECT  marque,N_Série,ppr FROM Matériels INNER JOIN Employé_Matériel ON Matériels.N_Série=Employé_Matériel.EM_Série INNER JOIN Employé ON Employé.ppr=Employé_Matériel.EM_PPR WHERE id_entite=? AND type=\'PC\'
                     AND Matériels.etat=\'NON RéFORME\' AND ppr!=? AND N_Série!=?');
                        $reponse3->execute(array($donnes2['id_entite'], $donnes['ppr'], $donnes['N_Série']));
                        while ($donnes3 = $reponse3->fetch()) {
                      ?>

                          <option value='<?php echo $donnes3['N_Série']; ?>'><?php echo $donnes3['marque'] . '-' . $donnes3['ppr'] . '(NON RéFORME même entité)'; ?></option>

                      <?php


                        }


                        $reponse3->closeCursor();
                      }

                      $reponse2->closeCursor();
                    }
                  } else if (strcmp($donnes['type'], 'IMP') == 0) {

                    $reponse3 = $bdd->prepare('SELECT marque,N_Série FROM Matériels WHERE etat=\'EN STOCK \' AND type=\'IMP\' AND N_Série!=? ');
                    $reponse3->execute(array($donnes['N_Série']));
                    while ($donnes3 = $reponse3->fetch()) {
                      ?>
                      <option value='<?php echo $donnes3['N_Série']; ?>'><?php echo $donnes3['marque'] . '-' . $donnes3['N_Série'] . '(nouveau)'; ?></option>

                      <?php

                    }
                    $reponse3->closeCursor();


                    $reponse2 = $bdd->prepare('SELECT id_entite  FROM Employé  WHERE ppr=?');
                    $reponse2->execute(array($donnes['ppr']));

                    if ($donnes2 = $reponse2->fetch()) {
                      $reponse3 = $bdd->prepare('SELECT marque,N_Série,ppr FROM Matériels INNER JOIN Employé_Matériel ON Matériels.N_Série=Employé_Matériel.EM_Série INNER JOIN Employé ON Employé.ppr=Employé_Matériel.EM_ppr WHERE id_entite=? AND type=\'IMP\'
                   AND Matériels.etat=\'NON RéFORME\'   AND ppr!=? AND N_Série!=?');
                      $reponse3->execute(array($donnes2['id_entite'], $donnes['ppr'], $donnes['N_Série']));
                      while ($donnes3 = $reponse3->fetch()) {
                      ?>

                        <option value='<?php echo $donnes3['N_Série']; ?>'><?php echo $donnes3['marque'] . '-<strong>' . $donnes3['ppr'] . '</strong>' . '(NON RéFORME même entité)'; ?></option>

                  <?php


                      }


                      $reponse3->closeCursor();
                    }

                    $reponse2->closeCursor();
                  }
                  ?>

                </select>
                <span class="input-group-addon"><img src="icons/icons8-service-mark-20.png"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="date">Date Activation:</label>
              <div class="input-group">
                <input type="dattime" name="date" class="form-control" value='<?php echo $donnes['date_activation']; ?>' readonly>
                <span class="input-group-addon"><img src="icons/icons8-date-to-20.png"></span>
              </div>
            </div>
          <?php
          }

          ?>

        </div>
        <div class="modal-footer modal-f">
          <button type="button" id="modifier_mat" class="btn btn-default btn-sm end"><span class="label label-warning" style="font-size: 1em;">Modifier</span> <img src="icons/icons8-edit-file-25.png"></button>
          <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em;">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>


        </div>
      </form>







    <?php
  }

    ?>

    <script type="text/javascript">
      $(function() {
        var select = document.getElementById('select');
        var input = document.createElement('input');

        select.addEventListener('change', function(e) {
          if (e.currentTarget.selectedIndex != 0) {
            if (!document.getElementById('hidden')) {
              input.type = "hidden";
              input.id = "hidden";
              input.name = "change";
              e.currentTarget.parentNode.appendChild(input);
            }
          } else {

            e.currentTarget.parentNode.removeChild(e.currentTarget.parentNode.lastChild);
          }
        });



        $(':input[readonly]').css('backgroundColor', 'white');
        $(':input[disabled]').css('backgroundColor', 'white');
        $('#modifier_mat').click(function() {
          $('input,select').removeAttr('disabled');
        });

        $("#form").submit(function(e) {
          e.preventDefault();
          var $form = $(this);
          $.ajax({
            type: 'POST',
            url: $form.attr("action"),
            mimeType: "multipart/form-data",
            async: false,
            data: new FormData(this),
            processData: false,
            contentType: false,
            timeout: 3000,
            success: function() {
              $('#info_em').modal('hide');
              alert('ca marche ....');
              $('#info_mat').modal('hide');

              $
            },
            error: function() {
              alert('La requête n\'a pas abouti');
            }
          });

        });
      });
    </script>