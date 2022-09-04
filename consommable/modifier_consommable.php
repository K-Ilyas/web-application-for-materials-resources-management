<?php
session_start();

require __DIR__ . './../db.php';

if (isset($_POST['id'])) {
  $reponse = $bdd->prepare('SELECT * FROM Consommable WHERE id=?');
  $reponse->execute(array($_POST['id']));
  $donnes = $reponse->fetch();
?>



  <div class="modal-dialog" id="matr">
    <div class="modal-content modal-c">
      <form action="tonner/modification_tonner.php?numero=2" method="POST" autocomplete="off">
        <div class="modal-header modal-h">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-print-30 (1).png"><span class="label label-default" style="background-color:#e34;">Tonner:</span></h4>
        </div>
        <div class="modal-body modal-b">

          <div class="form-group">
            <div class="input-group">
              <input type="text" id="ref" name="ref" class="form-control" placeholder="référence" value='<?php echo $_donnes['ref']; ?>' readonly>
              <input type="hidden" name="ref" value='<?php echo $_donnes['ref']; ?>'>

              <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>

            </div>
            <div id="error_t" style="display:none;">
              <span style="color:red;font-size:12px;">Numéro de tonner existe déja...</span>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <input type="text" id="marque" name="marque" class="form-control" placeholder="Quantité minimale" value='<?php echo $_donnes['marque']; ?>' disabled>
              <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>

            </div>

            <div class="form-group">
              <div class="input-group">
                <input type="number" id="qte_min" name="qte_min" class="form-control" placeholder="Quantité maximale" value='<?php echo $_donnes['qte_min']; ?>' disabled>
                <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>

              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="number" id="qte_stock" name="qte_stock" class="form-control" placeholder="Quantité en stock" value='<?php echo $_donnes['qte_stock']; ?>' disabled>
                  <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>

                </div>

              </div>

              <div class="modal-footer modal-f" style="text-align:center;">
                <div class="pull-right">

                  <button type="button" style="color: #FFC107;" id="tonner_em" class="btn btn-default btn-sm  end"><span class="label label-warning" style="font-size:1em">Modifier</span> <img src="icons/icons8-edit-file-25.png"> </button>

                  <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em;">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>
                </div>
              </div>

      </form>
    </div>

  </div>

<?php
}
?>

<script type="text/javascript">
  $(function() {



    $(":input[disabled] ").css({
      'background-color': 'white'
    });
    $(":input[readonly] ").css({
      'background-color': 'white'
    });

    $('#tonner_em').on('click', function() {

      $(":input[disabled]").removeAttr('disabled');
    });

    $("form").submit(function(e) {
      e.preventDefault();

      var $form = $(this);
      $.post($form.attr("action"), $form.serialize())
        .done(function(data) {
          alert("ça marche ...");
          $("#info_marche").modal("hide");
        })
        .fail(function() {
          alert("ça marche pas...");
        });
    });


  });
</script>