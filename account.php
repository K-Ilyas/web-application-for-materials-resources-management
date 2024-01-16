<?php
session_start();
require __DIR__ . '/db.php';

if (isset($_SESSION['ppr_admin'])) {
  $reponse = $bdd->prepare('SELECT * FROM Employé WHERE ppr=?');
  $reponse->execute(array($_SESSION['ppr_admin']));
  if ($reponse->rowCount() == 1) {
    $donnes = $reponse->fetch();
?>
    <style type="text/css">
      .input-group-addon {
        background-color: white;
      }
    </style>

    <div class="modal-dialog">
      <div class="modal-content" id="html">
        <form action="modifiction_admin.php?numero=1&v=<?php echo time(); ?>" method="POST" id="form" enctype="multipart/form-data">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title end"><img src="icons/icons8-admin-settings-male-30.png"> Vos infos :</h4>
          </div>
          <div class="modal-body" style="overflow-x: auto; height: 500px;">
            <div class="form-group">
              <div class="row" style="text-align: center;">
                <img src='<?php echo  $donnes['chemin_image']; ?>' class="img-circle img-thumbnail" style='width: 100px; height: 100px;display: inline; border:1px solid lightgrey;'>
              </div>
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <div class="input-group">
                <span class="input-group-addon"><i>upload</i></span>

                <button class="form-control btn-default" type="button" style="position: relative;">
                  <span id="modifier_a"><i class="fa fa-cloud-upload"> upload</i></span>
                  <input disabled type="file" name="image" id="image_a" accept="image/*" capture style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0;"></input>
                </button>
                <span class="input-group-addon"><i class="fa fa-image"></i></span>
              </div>
            </div>
            <div class="form-group">
              <label for="ppr">ppr:</label>
              <div class="input-group">
                <input readonly type="text" class="form-control" value='<?php echo $donnes['ppr']; ?>' name="ppr" id="ppr">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
              </div>
            </div>
            <div class="form-group">
              <label for="nom">nom:</label>
              <div class="input-group">
                <input disabled type="text" class="form-control" value='<?php echo $donnes['nom']; ?>' name="nom" id="nom" required>
                <span class="input-group-addon"><i class="fa fa-address-card  "></i></span>
              </div>
            </div>
            <div class="form-group">

              <label for="prénom">prénom:</label>
              <div class="input-group">
                <input disabled type="prénom" class="form-control" value='<?php echo $donnes['prénom']; ?>' name="prénom" id="prénom" placeholder="Votre prénom" required>
                <span class="input-group-addon"><i class="fa fa-address-card  "></i></span>
              </div>
            </div>
            <div class="form-group">
              <label for="prénom">sexe:</label>
              <?php if ($donnes['sexe'] == 'H') {
              ?>
                <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='sexe' id="sexe" value="H" checked></span>
                    <input disabled type="text" name="" class="form-control" value="Male" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='sexe' id="sexe" value="F"></span>
                    <input disabled type="text" name="" class="form-control" value="Female" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-female"></i></span>

                  </div>
                </div>
              <?php
              } else {
              ?>
                <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='sexe' value="H"></span>
                    <input disabled type="text" name="" class="form-control" value="Male" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='sexe' value="F" checked></span>
                    <input disabled type="text" name="" class="form-control" value="Female" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-female"></i></span>


                  </div>
                </div>
              <?php
              }
              ?>
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <div class="input-group">
                <input disabled type="email" class="form-control" value='<?php echo $donnes['email']; ?>' name="email" id="email" required>
                <span class="input-group-addon"><i class="fa fa-at"></i></span>
              </div>
            </div>

            <div class="form-group">
              <label for="téléphone">Téléphone:</label>
              <div class="input-group">
                <input disabled type="tel" class="form-control" value='<?php echo $donnes['téléphone']; ?>' name="téléphone" id="téléphone" required>
                <span class="input-group-addon"><i class="fa fa-phone-square  "></i></span>
              </div>
            </div>


            <div class="form-group">
              <label for="ville">Ville:</label>
              <div class="input-group">
                <select disabled name='ville' required class="form-control" id="ville">
                  <option disabled>Votre choix</option>
                  <?php $reponse2 = $bdd->query('SELECT id,ville FROM ville');
                  while ($donnes2 = $reponse2->fetch()) {
                    if ($donnes2['id'] == $donnes['ville']) {
                  ?>
                      <option value='<?php echo $donnes2['ville']; ?>' selected><?php echo $donnes2['ville']; ?></option>
                    <?php

                    } else {
                    ?>
                      <option value='<?php echo $donnes2['ville']; ?>'><?php echo $donnes2['ville']; ?></option>
                  <?php
                    }
                  }
                  ?>
                  <select>
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
              </div>
            </div>
            <div class="form-group">
              <label for="date">Date Inscription:</label>
              <div class="input-group">
                <input readonly type="datetime" class="form-control" value='<?php echo $donnes['date_inscription']; ?>' name="date" id="date">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
              </div>
            </div>


            <div class="form-group">
              <label for="date">Entité:</label>
              <div class="input-group">
                <?php
                $reponse2 = $bdd->query('SELECT id,libellé FROM Entité');
                ?>
                <td>
                  <select disabled class="form-control" name="id_entite" required>
                    <option disabled>votre choix:</option>
                    <?php
                    while ($donnes2 = $reponse2->fetch()) {
                      if ($donnes2['id'] == $donnes['id_entite']) {
                        echo '<option selected>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                      } else {
                        echo '<option>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                  <span class="input-group-addon"> <i class="fa fa-list"></i> </span>
              </div>
            </div>


            <?php $reponse->closeCursor(); ?>



          </div>
          <div class="modal-footer modal-fa">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              <div class="btn-group" role="group">
                <button type="button" id="modifier" class="btn btn-default end" style="color: green;"><img src="icons/icons8-edit-file-20.png">Modifier</button>
              </div>
              <div class="btn-group" role="group">
                <button type="submit" class="btn btn-default end" style="color:blue;" id="envoyer_acount"><img src="icons/icons8-send-20.png">Envoyer</button>

              </div>
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
    $(':input[disabled]').css({
      'background-color': 'white'
    });
    $(':input[readonly]').css({
      'background-color': 'white'
    });
    $('#image_a').change(function() {
      if ($(this).val() != "") {
        $('#modifier_a').html("<span style='font-weight:normal;font-size:1.1em;'>" + $(this).val() + "</span>");
      } else {
        $('#modifier_a').html("<i class='fa fa-cloud-upload' > upload</i>");
      }
    });
    $('#modifier').click(function() {
      $('input,select').removeAttr('disabled');
    });

    $("#form").submit(function(e) {
      e.preventDefault();
      var $form = $(this);
      $.ajax({
        type: 'POST',
        url: $form.attr("action"),
        mimeType: "multipart/form-data",
        data: new FormData(this),
        processData: false,
        contentType: false,
        timeout: 3000,
        success: function(data) {
          $('#info_account').modal('hide');
          alert("Ca marche !!!");
          window.location = window.location;
        },
        error: function() {
          alert('La requête n\'a pas abouti');
        }
      });

    });
  });
</script>