<?php
session_start();
require __DIR__ . '/../db.php';

if (isset($_COOKIE['ppr_admin'])) {
  $reponse = $bdd->prepare('SELECT * FROM Employé WHERE id=?');
  $reponse->execute(array($_POST['id']));

  if ($reponse->rowCount() == 1) {
    $donnes = $reponse->fetch();
?>
    <style type="text/css">
      /*  .input-group-addon
          {
            background-color: white;
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
          }*/
    </style>

    <div class="modal-dialog">
      <div class="modal-content modal-c" id="html">
        <form action="employe/modification_employe.php?numero=2" method="POST" id="form" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-header modal-h">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><img src="icons/icons8-resume-30 (1).png"><span class="label label-success">Infos :</span></h4>
          </div>
          <div class="modal-body modal-b" style="overflow-x: auto;height: 500px;">
            <div class="form-group">
              <div class="row" style="text-align: center;">
                <img src='<?php echo $donnes['chemin_image']; ?>' class="img-circle" style='width: 100px; height: 100px;display: inline; border:1px solid lightgrey;'>
              </div>
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <div class="input-group">
                <span class="input-group-addon"><i>upload</i></span>
                <button class="form-control btn-default" type="button" style="position: relative;">
                  <span id="modifier_em2"><i class="fa fa-cloud-upload"> upload</i></span>
                  <input disabled id="image2" type="file" name="image" accept="image/*" capture style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0;"></input>
                </button>
                <span class="input-group-addon"><i class="fa fa-image"></i></span>
              </div>
            </div>

            <div class="form-group">
              <label for="nom">nom:</label>
              <div class="input-group">
                <input disabled type="text" class="form-control" value='<?php echo $donnes['nom']; ?>' name="nom" id="nom" required>
                <span class="input-group-addon"><i class="fa fa-address-card  "></i></span>
              </div>
            </div>
            <input type="hidden" name="id" value='<?php echo $donnes['id']; ?>'>
            <div class="form-group">

              <label for="prénom">prénom:</label>
              <div class="input-group">
                <input disabled type="text" class="form-control" value='<?php echo $donnes['prénom']; ?>' name="prénom" id="prénom" placeholder="Votre prénom" required>
                <span class="input-group-addon"><i class="fa fa-address-card  "></i></span>
              </div>
            </div>
            <div class="form-group">
              <label for="sexe">sexe:</label>
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
                      <option value='<?php echo $donnes2['id']; ?>' selected><?php echo $donnes2['ville']; ?></option>
                    <?php

                    } else {
                    ?>
                      <option value='<?php echo $donnes2['id']; ?>'><?php echo $donnes2['ville']; ?></option>
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
                <input disabled type="datetime" class="form-control" value='<?php echo $donnes['date_inscription']; ?>' name="date" id="date">
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
                  <select disabled class="form-control" name="entite" id="entite" required>
                    <option disabled>votre choix:</option>
                    <?php
                    while ($donnes2 = $reponse2->fetch()) {
                      if ($donnes2['id'] == $donnes['id_entite']) {
                        echo '<option value=' . $donnes2['id'] . 'selected>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                      } else {
                        echo '<option value=' . $donnes2['id'] . '>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                  <span class="input-group-addon"> <i class="fa fa-list"></i> </span>
              </div>
            </div>
            <div class="form-group">
              <label for="etat">Etat:</label>
              <?php if ($donnes['etat'] == 'simple') {
              ?>
                <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='etat' id="etat" value="simple" checked></span>
                    <input disabled type="text" name="" class="form-control" value="Simple" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='etat' id="etat" value="admin"></span>
                    <input disabled type="text" name="" class="form-control" value="Admin" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>

                  </div>
                </div>
              <?php
              } else {
              ?>
                <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='etat' value="simple"></span>
                    <input disabled type="text" name="" class="form-control" value="Simple" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><input disabled type="radio" name='etat' value="admin" checked></span>
                    <input disabled type="text" name="" class="form-control" value="Admin" style="width: 100px;">
                    <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>


                  </div>
                </div>
              <?php
              }
              ?>
            </div>


            <?php $reponse->closeCursor(); ?>


          </div>
          <div class="modal-footer modal-f" style="text-align:center;">
            <div class="pull-right">
              <button type="button" id="modifier_ep" class="btn btn-default btn-sm end"><span class="label label-warning" style="font-size: 1em;">Modifier</span> <img src="icons/icons8-edit-file-25.png"></button>
              <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"></button>
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
    $(':input[disabled]').css('backgroundColor', 'white');
    $('.input-group-addon').css('backgroundColor', 'white');

    $('#modifier_ep').click(function() {
      $('input,select').removeAttr('disabled');
    });
    $('#image2').change(function() {
      if ($(this).val() != "") {
        $('#modifier_em2').html("<span style='font-weight:normal;font-size:1.1em;'>" + $(this).val() + "</span>");
      } else {
        $('#modifier_em2').html("<i class='fa fa-cloud-upload' > upload</i>");
      }
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
        success: function() {
          $('#info_em').modal('hide');
          alert('ca marche ....');
        },
        error: function() {
          alert('La requête n\'a pas abouti');
        }
      });

    });
  });
</script>