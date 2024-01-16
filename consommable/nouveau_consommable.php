<?php
session_start();

require __DIR__ . '/../db.php';

?>
<style type="text/css">
  /*
          .modal-hentite
          {
            background-color:  rgb(243,243,243);
            border-bottom:1px solid lightgrey;
          }
          .modal-fentite
          {
            border-top:1px solid lightgrey;
            background-color:  rgb(243,243,243);
          }
          */
</style>



<div class="modal-dialog" id="matr">
  <div class="modal-content modal-c">
    <form action="consommable/modification_consommable.php?numero=1" method="POST" autocomplete="off">
      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-print-file-30.png"><span class="label label-default" style="background-color:#1ABC9C;">Tonner:</span></h4>



      </div>
      <div class="modal-body modal-b">


        <div class="form-group">
          <label for="">numéro série:</label>
          <div class="input-group">
            <input type="text" list="browsers" required name='<?php echo 'N_Série'; ?>' required class=" form-control" id="serie" placeholder="numéro série">
            <datalist id="browsers">
              <?php
              $reponse = $bdd->query('SELECT N_Série FROM Matériels WHERE etat=\'NON RéFORME\' AND type=\'IMP\'');
              while ($donnes = $reponse->fetch()) {
              ?>
                <option value='<?php echo $donnes['N_Série']; ?>'><?php echo $donnes['N_Série']; ?></option>

              <?php

              }
              $reponse->closeCursor();

              ?>

            </datalist>
            <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>


          </div>

        </div>

        <div class="form-group">
          <label for="">matricule:</label>
          <div class="input-group">
            <input type="text" list="contenu_ppr" name='<?php echo 'ppr'; ?>' class="ppr tout form-control" placeholder="matricule">
            <datalist id="contenu_ppr">

            </datalist>
            <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>

          </div>
        </div>
        <div class="form-group">
          <label for="">quantité livre:</label>

          <div class="input-group">
            <input type="number" class="quantite tout form-control" name='<?php echo 'qte_livre'; ?>' required min=1 max=3 placeholder="Quantité Livre">
            <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>

          </div>
        </div>
        <div class="form-group">
          <label for="">Compteur:</label>
          <div class="input-group">
            <input type="number" class="compteur tout form-control" name='<?php echo 'compteur' ?>' required min=200 max=900 required placeholder="compteur">

            <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>

          </div>

        </div>
      </div>

      <div class="modal-footer modal-f" style="text-align:center;">
        <div class="pull-right">
          <button type="reset" class="btn btn-default btn-sm ref end"><span class="label label-danger" style="font-size:1em;"> Actualiser </span><img src="icons/icons8-synchronize-25.png"> </button>
          <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em;">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>
        </div>
      </div>

    </form>
  </div>

</div>


<script type="text/javascript">
  $(function() {



    var serie = document.getElementById('serie');


    serie.addEventListener('blur', function(e) {
      if (e.currentTarget.value != "") {
        var scriptElement = document.createElement('script');
        document.getElementById('contenu_ppr').disabled = false;
        document.body.appendChild(scriptElement);
        scriptElement.async = true;
        scriptElement.type = 'text/javascript';
        scriptElement.src = 'consommable/toner_server.php?serie=' + e.currentTarget.value + '';
      }

    });


    $("form").submit(function(e) {
      e.preventDefault();

      var $form = $(this);
      $.post($form.attr("action"), $form.serialize())
        .done(function(data) {
          alert("ça marche ...");
          $("#info_consmmable").modal("hide");
        })
        .fail(function() {
          alert("ça marche pas...");
        });
    });




  });
</script>