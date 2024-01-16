<?php
session_start();
require __DIR__ . '/../db.php';
?>
<style type="text/css">

</style>



<div class="modal-dialog" id="matr">
  <div class="modal-content modal-c">
    <form action="arrivage/modification_arrivage.php?numero=1" method="POST" autocomplete="off">
      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-gg-30.png"><span class="label label-default" style="background-color:#F1C40F;">Arrivage:</span></h4>
      </div>
      <div class="modal-body modal-b">

        <div class="form-group">
          <label for="">choix:</label>

          <div class="input-group">
            <select id="type" class="type tout form-control" name='type' required placeholder="Type">
              <option disabled selected>Selectioner votre choix</option>
              <option value="PC">pc</option>
              <option value="IMP">imprimante</option>
            </select>
            <span class="input-group-addon"><img src="icons/icons8-options-20 (1).png"></span>
          </div>

        </div>
        <div class="form-group">
          <label for="">numéro marché:</label>

          <div class="input-group">
            <input type="text" list="" id="num_marche" name="marche" class="form-control" disabled required placeholder="Marché">

            <datalist id="pc">
              <?php
              $reponse = $bdd->query('SELECT numéro_marché FROM Marché WHERE  type=\'PC\'');
              while ($donnes = $reponse->fetch()) {
              ?>
                <option value='<?php echo $donnes['numéro_marché']; ?>'><?php echo $donnes['numéro_marché']; ?></option>

              <?php

              }
              $reponse->closeCursor();

              ?>

            </datalist>
            <datalist id="imp">
              <?php
              $reponse = $bdd->query('SELECT numéro_marché FROM Marché WHERE  type=\'IMP\'');
              while ($donnes = $reponse->fetch()) {
              ?>
                <option value='<?php echo $donnes['numéro_marché']; ?>'><?php echo $donnes['numéro_marché']; ?></option>
              <?php
              }
              $reponse->closeCursor();

              ?>


            </datalist>


            <span class="input-group-addon"><img src="icons/icons8-document-20.png"></span>

          </div>
          <div id="error_m" style="display:none;">
            <span style="color:red;font-size:12px;">Numéro de marché existe déja...</span>
          </div>
        </div>

        <div class="form-group">
          <label for="">quantité stock:</label>
          <div class="input-group">
            <input type="number" id="qte_stock" class="qte_stock tout form-control" name='qte_stock' min=0 disabled required placeholder="Quantite stock">

            <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>
          </div>
        </div>
      </div>

      <div class="modal-footer modal-f" style="text-align:center;">
        <div class="pull-right">
          <button type="reset" class="btn btn-default btn-sm ref end"><span class="label label-danger" id="rest" style="font-size:1em;"> Actualiser </span><img src="icons/icons8-synchronize-25.png"> </button>
          <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em;">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>
        </div>
      </div>

    </form>
  </div>

</div>


<script type="text/javascript">
  $(function() {

    $(':input[disabled]').css('backgroundColor', 'white');
    $('#rest').on('click', function() {
      $('#num_marche').attr('disabled', 'true');
      $('#qte_stock').attr('disabled', 'true');
    });

    $('#type').on('change', function() {

      $('#num_marche').removeAttr('disabled');
      $('#qte_stock').removeAttr('disabled');
      if ($('#type option:selected').val() == "PC") {
        $('#num_marche').attr('list', 'pc');
      } else if ($('#type option:selected').val() == "IMP") {
        $('#num_marche').attr('list', 'imp');
      }


    });

    $("form").submit(function(e) {
      e.preventDefault();

      var $form = $(this);
      $.post($form.attr("action"), $form.serialize())
        .done(function(data) {
          alert("ça marche ...");
          $("#info_arrivage").modal("hide");
        })
        .fail(function() {
          alert("ça marche pas...");
        });
    });


  });
</script>