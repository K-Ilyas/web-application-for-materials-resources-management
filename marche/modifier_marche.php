<?php
session_start();

require __DIR__ . '/../db.php';

if (isset($_POST['marche'])) {
  $reponse = $bdd->prepare('SELECT * FROM Marché WHERE numéro_marché=?');
  $reponse->execute(array($_POST['marche']));
  $donnes = $reponse->fetch();
?>



  <div class="modal-dialog" id="matr">
    <div class="modal-content modal-c">
      <form action="marche/modification_marche.php?numero=2" method="POST" autocomplete="off">
        <div class="modal-header modal-h">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-buying-30 (1).png"><span class="label label-default">Marché:</span></h4>
        </div>
        <div class="modal-body modal-b">

          <div class="form-group">
            <label for="">choix:</label>

            <div class="input-group">
              <select type="type" id="type" class="type tout form-control" name='type' required placeholder="Type" disabled>
                <option disabled selected>Selectioner votre choix</option>
                <?php
                if ($donnes['type'] == "PC") {
                ?>
                  <option value="PC" selected>pc</option>
                  <option value="IMP">imprimante</option>
                <?php
                } else {
                ?>
                  <option value="PC">pc</option>
                  <option value="IMP" selected>imprimante</option>
                <?php
                }

                ?>
              </select>
              <span class="input-group-addon"><img src="icons/icons8-options-20 (1).png"></span>
            </div>

          </div>
          <div class="form-group">
            <label for="">numéro marché:</label>

            <div class="input-group">
              <input type="text" id="marche_n" value='<?php echo $donnes['numéro_marché'] ?>' ; name="marche" class="form-control" placeholder="Numéro Marché" readonly>
              <input type="hidden" name="marche" value='<?php echo $donnes['numéro_marché'] ?>' ;>
              <span class="input-group-addon"><img src="icons/icons8-document-20.png"></span>

            </div>

          </div>

          <div class="form-group">
            <label for="">description:</label>

            <textarea id="description" class="decription tout form-control" name='description' required disabled placeholder="Description"><?php echo $donnes['description'] ?></textarea>


          </div>
        </div>

        <div class="modal-footer modal-f" style="text-align:center;">
          <div class="pull-right">

            <button type="button" style="color: #FFC107;" id="marche_em" class="btn btn-default btn-sm  end"><span class="label label-warning" style="font-size:1em">Modifier</span> <img src="icons/icons8-edit-file-25.png"> </button>

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

    $('#marche_em').on('click', function() {

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