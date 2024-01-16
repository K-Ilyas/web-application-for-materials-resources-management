<?php
session_start();
require __DIR__ . '/../db.php';

?>
<style type="text/css">

</style>



<div class="modal-dialog">
  <div class="modal-content modal-c">
    <form action="entite/modification_entite.php?numero=1" method="POST" autocomplete="off">
      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-list-view-30.png"><span class="label label-info">Entité:</span></h4>
      </div>
      <div class="modal-body modal-b">



        <div class="form-group">
          <label for="">ABR:</label>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Entrer abréviation" name="abr" required>
            <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"> </span>

          </div>
        </div>

        <div class="form-group">
          <label for="">Libellé:</label>
          <div class="input-group">

            <input type="text" class="form-control password2" placeholder="Entrer Libellé" name="libellé" required>
            <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>


          </div>
        </div>

        <div class="form-group">
          <label for="">Ville:</label>
          <div class="input-group">
            <select name="ville" required class="form-control">
              <option disabled selected>Votre choix</option>

              <?php
              $reponse2 = $bdd->query('SELECT id,ville FROM ville');
              while ($donnes2 = $reponse2->fetch()) {

              ?>
                <option value='<?php echo $donnes2['id']; ?>'><?php echo $donnes2['ville']; ?></option>

              <?php

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
            <select name="entite_racine" class="form-control" id="entite_racine" required>
              <option disabled selected>Votre choix</option>
              <option value="0">Null</option>
              <?php
              $reponse2 = $bdd->query('SELECT id,libellé FROM Entité');
              while ($donnes2 = $reponse2->fetch()) {


                echo '<option value=' . $donnes2['id'] . '>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
              }
              $reponse2->closeCursor();

              ?>
            </select>
            <span class="input-group-addon"><img src="icons/icons8-list-20 (5).png"> </span>

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



    $("form").submit(function(e) {
      e.preventDefault();
      var has_empty = true;
      var select_empty = true;
      $(this).find('input[type="text"]').each(function() {

        if ($(this).val() === "") {
          has_empty = false;
        }
      });
      $(this).find('select').each(function() {

        if (this.selectedIndex == 0) {
          select_empty = false;
        }
      });
      if (has_empty && select_empty) {
        var $form = $(this);
        $.post($form.attr("action"), $form.serialize())
          .done(function(data) {
            alert("ça marche ...");
            $("#info_entite").modal("hide");
          })
          .fail(function() {
            alert("ça marche pas...");
          });
      } else {
        alert('remplissage de tout les champs obligatoire ...');
      }

    });


  });
</script>