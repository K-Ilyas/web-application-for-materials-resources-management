<?php
session_start();
require __DIR__ . './../db.php';

if (isset($_POST['id'])) {
  $reponse = $bdd->prepare('SELECT * FROM Entité WHERE id=?');
  $reponse->execute(array($_POST['id']));
  if ($donnes = $reponse->fetch()) {

?>

    <div class="modal-dialog">
      <div class="modal-content modal-c">
        <form action="entite/modification_entite.php?numero=2" method="POST" autocomplete="off">
          <div class="modal-header modal-h">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-list-view-30.png"><span class="label label-info">Entité:</span></h4>
          </div>
          <div class="modal-body modal-b" style="">
            <input type="hidden" name="id" value='<?php echo $donnes['id'] ?>'>
            <div class="form-group">
              <label for="">ABR:</label>
              <div class="input-group">
                <input disabled type="text" class="form-control" placeholder="Entrer abréviation" value='<?php echo $donnes['abr']; ?>' name="abr" required>
                <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"> </span>

              </div>
            </div>

            <div class="form-group">
              <label for="">Libellé:</label>
              <div class="input-group">

                <input disabled type="text" class="form-control password2" placeholder="Entrer Libellé" value='<?php echo $donnes['libellé']; ?>' name="libellé" required>
                <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"> </span>


              </div>
            </div>

            <div class="form-group">
              <label for="">Ville:</label>
              <div class="input-group">
                <select disabled name="ville" required class="form-control">
                  <?php $reponse2 = $bdd->query('SELECT id,ville FROM ville');
                  while ($donnes2 = $reponse2->fetch()) {
                    if ($donnes2['id'] == $donnes['ville']) {
                  ?>
                      <option value='<?php echo $donnes2['id']; ?>' selected><?php echo $donnes2['ville']; ?></option>
                    <?php

                    } else {
                    ?>
                      <option value='<?php echo $donnes2['id']; ?>'><?php echo $donnes2['ville']; ?></option>
                  <?php
                    }
                  }
                  $reponse2->closeCursor();
                  ?>
                </select>
                <span class="input-group-addon"><img src="icons/icons8-list-20 (5).png"> </span>
              </div>
            </div>

            <div class="form-group">
              <label for="entite_racine">Entité racine:</label>
              <div class="input-group">
                <select disabled name="entite_racine" class="form-control" id="entite_racine" required>
                  <option value="0">Null</option>

                  <?php

                  $reponse2 = $bdd->query('SELECT id,libellé FROM Entité');

                  while ($donnes2 = $reponse2->fetch()) {
                    if ($donnes2['id'] == $donnes['entité_racine']) {

                      echo '<option selected  value=' . $donnes2['id'] . '>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                    } else {
                      echo '<option value=' . $donnes2['id'] . '>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                    }
                  }
                  $reponse2->closeCursor();
                  ?>

                </select>
                <span class="input-group-addon"><img src="icons/icons8-list-20 (5).png"> </span>
              </div>
            </div>
          </div>
          <div class="modal-footer modal-f">
            <div class="pull-right">
              <button type="button" style="color: #FFC107;" id="md_e" class="btn btn-default btn-sm  end"><span class="label label-warning" style="font-size:1em">Modifier</span> <img src="icons/icons8-edit-file-25.png"> </button>
              <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>


            </div>
          </div>
        </form>
      </div>
    </div>



<?php
  }
}
?>


<script type="text/javascript">
  $(function() {
    $(":input[disabled] ").css({
      'background-color': 'white'
    });
    $('#md_e').on('click', function() {

      $(":input[disabled]").removeAttr('disabled');
    });


    $("form").submit(function(e) {
      e.preventDefault();

      var $form = $(this);
      $.post($form.attr("action"), $form.serialize())
        .done(function(data) {
          alert("ça marche ...");
          $("#info_entite").modal("hide");
        })
        .fail(function() {
          alert("ça marche pas...");
        });

    });


  });
</script>