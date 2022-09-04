<?php
session_start();
require __DIR__ . './../db.php';

?>

<style type="text/css">
  .input-group-addon,
  #send,
  #pc {
    background-color: white;
  }
</style>


<div class="modal-dialog">
  <div class="modal-content modal-c" id="html">
    <form action="employe/modification_employe.php?numero=1" method="POST" id="form" autocomplete="off" enctype="multipart/form-data">

      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="icons/icons8-resume-30 (1).png"><span class="label label-success">Infos :</span></h4>
      </div>
      <div class="modal-body modal-b" id="modal_b" style="overflow-x: auto; height: 500px;">

        <div class="form-group">
          <label for="image">Image:</label>
          <div class="input-group">
            <span class="input-group-addon"><i>upload</i></span>
            <button class="form-control btn-default" type="button" style="position: relative;">
              <span id="modifier_em"><i class="fa fa-cloud-upload"> upload</i></span>
              <input required id="image" type="file" name="image" accept="image/*" capture style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0;"></input>
            </button>
            <span class="input-group-addon"><i class="fa fa-image"></i></span>
          </div>
        </div>

        <div class="form-group">
          <label for="nom">nom:</label>
          <div class="input-group">
            <input type="text" class="form-control" name="nom" id="nom" placeholder="nom" required>
            <span class="input-group-addon"><i class="fa fa-address-card  "></i></span>
          </div>
        </div>
        <div class="form-group">

          <label for="prénom">prénom:</label>
          <div class="input-group">
            <input type="prénom" class="form-control" name="prénom" id="prénom" placeholder="prénom" required>
            <span class="input-group-addon"><i class="fa fa-address-card  "></i></span>
          </div>
        </div>
        <div class="form-group">
          <label for="prénom">sexe:</label>

          <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
            <div class="input-group">
              <span class="input-group-addon"><input type="radio" name='sexe' id="sexe" value="H"></span>
              <input type="text" name="" class="form-control" value="Male" style="width: 100px;" readonly style="background-color: white;">
              <span class="input-group-addon"><i class="fa fa-male"></i></span>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><input type="radio" name='sexe' id="sexe" value="F"></span>
              <input type="text" name="" class="form-control" value="Female" style="width: 100px;" readonly style="background-color: white;">
              <span class="input-group-addon"><i class="fa fa-female"></i></span>

            </div>
          </div>



        </div>
        <div class="form-group">
          <label for="email">E-mail:</label>
          <div class="input-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
            <span class="input-group-addon"><i class="fa fa-at"></i></span>
          </div>
        </div>

        <div class="form-group">
          <label for="téléphone">Téléphone:</label>
          <div class="input-group">
            <input type="tel" class="form-control" name="téléphone" id="téléphone" placeholder="Téléphone" required>
            <span class="input-group-addon"><i class="fa fa-phone-square  "></i></span>
          </div>
        </div>


        <div class="form-group">
          <label for="ville">Ville:</label>
          <div class="input-group">
            <select name='ville' required class="form-control" id="ville">
              <option selected disabled>Votre choix</option>
              <?php $reponse2 = $bdd->query('SELECT id,ville FROM ville');
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <option value='<?php echo $donnes2['id']; ?>'><?php echo $donnes2['ville']; ?></option>

              <?php
              }
              $reponse2->closeCursor();
              ?>
              <select>
                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
          </div>
        </div>



        <div class="form-group">
          <label for="date">Entité:</label>
          <div class="input-group">
            <?php
            $reponse2 = $bdd->query('SELECT id,libellé FROM Entité');
            ?>
            <td>
              <select class="form-control" name="entite" id="entite" required>
                <option selected disabled>votre choix:</option>
                <?php
                while ($donnes2 = $reponse2->fetch()) {

                  echo '<option value=' . $donnes2['id'] . '>' . $donnes2['id'] . '-' . $donnes2['libellé'] . '</option>';
                }
                $reponse2->closeCursor();
                ?>
              </select>
              <span class="input-group-addon"> <i class="fa fa-list"></i> </span>
          </div>
        </div>
        <div class="form-group">
          <label for="etat">Etat:</label>

          <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">
            <div class="input-group">
              <span class="input-group-addon"><input type="radio" name='etat' id="etat" value="simple"></span>
              <input type="text" name="" class="form-control" value="Simple" style="width: 100px;" readonly style="background-color: white;">
              <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><input type="radio" name='etat' id="etat" value="admin"></span>
              <input type="text" name="" class="form-control" value="Admin" style="width: 100px;" readonly style="background-color: white;">
              <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>

            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="téléphone">Affectation matérielle:</label>
          <div class="input-group ">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="imp" name="imp">
              <span class="custom-control-label" for="imp">Imprimante</span>
            </div>
          </div>
        </div>

        <!--<div class="progress"> <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;height:2px;"></div> </div>-->


      </div>
      <div class="modal-footer  modal-f " style="text-align:center;">
        <div class="pull-right">
          <button type="reset" class="btn btn-default btn-default btn-sm  end" id="ref_upload"><span class="label label-danger" style="font-size:1em;">Actualiser </span><img src="icons/icons8-synchronize-25.png"></button>
          <button type="submit" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>
        </div>







      </div>
    </form>
  </div>
</div>



<script type="text/javascript">
  $(function() {
    alert("ok");
    $(':input[readonly]').css({
      'background-color': 'white'
    });
    $('#image').change(function() {
      if ($(this).val() != "") {
        $('#modifier_em').html("<span style='font-weight:normal;font-size:1.1em;'>" + $(this).val() + "</span>");
      } else {
        $('#modifier_em').html("<i class='fa fa-cloud-upload' > upload</i>");
      }
    });
    $("#ref_upload").click(function() {
      $('#image').val("");
      $('#modifier_em').html("<i class='fa fa-cloud-upload' > upload</i>");

    });
    $("#form").submit(function(e) {
      $('#chrge').html('<div class="modal-dialog" id="modal_ch"><img src=\"image_page/loading.gif\"></div>');
      $('#chrge').modal();
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
          $('#chrge').modal('hide');
          alert('ca marche ....');
          $.ajax({
            type: "GET",
            url: "employe/affectation_materiel.php",
            async: true,
            success: function(text) {
              $('#info_em').html(text);

            }
          });
        },
        error: function() {
          alert('La requête n\'a pas abouti');
        }
      });

    });
  });
</script>