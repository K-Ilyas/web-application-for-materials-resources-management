<?php
session_start();
require __DIR__ . '/../db.php';
?>

<style type="text/css">

</style>


<div class="modal-dialog " style="opacity: 1;" id="matr">
  <div class="modal-content modal-c" id="html">
    <form action="materiel/modification_materiel.php?numero=1" method="POST" id="form" autocomplete="off" enctype="multipart/form-data">

      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-workstation-35.png"> <span class="label label-warning">Matériels:</span></h4>
      </div>
      <div class="modal-body modal-b">

        <div class="form-group">
          <label for="image">option:</label>
          <div class="input-group">
            <select id="option" name="option" class="form-control" required>
              <option disabled selected>sélectionner votre choix</option>
              <option value="PC" style="font-style:italic;">PC</option>
              <option value="Imprimante" style="font-style:italic;">Imprimante</option>
            </select>
            <span class="input-group-addon"><img src="icons/icons8-options-20 (1).png"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="image">Matricule:</label>
          <div class="input-group">
            <input type="text" list="mtr" id="ppr" name="ppr" class="form-control" placeholder="votre choix" required disabled>
            <datalist id="mtr" class="contenu">

            </datalist>

            <span class="input-group-addon"><img src="icons/icons8-registration-20.png"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="image">Matériel:</label>
          <div class="input-group">
            <input type="text" list="mat" id="materiel" name="materiel" class="form-control" placeholder="votre choix" required disabled>
            <datalist id="mat" class="contenu">
            </datalist>

            <span class="input-group-addon"><img src="icons/icons8-pc-on-desk-20 (1).png"></span>
          </div>
        </div>

      </div>
      <div class="modal-footer mod-footer modal-f">

        <button type="reset" id="ref" class="btn btn-default btn-sm  end"><span class="label label-danger" style="font-size:1em;"> Actualiser </span><img src="icons/icons8-synchronize-25.png"> </button>
        <button type="submit" id="send" class="btn  btn-default btn-sm  end"><span class="label label-info" style="font-size:1em;">Envoyer</span> <img src="icons/icons8-paper-plane-25.png"> </button>
      </div>


    </form>
  </div>
</div>


<script type="text/javascript">
  $(function() {
    var option = document.getElementById('option');
    var ppr = document.getElementById('ppr');
    var materiel = document.getElementById('materiel');
    $('#ref').on('click', function(e) {
      ppr.disabled = true;
      materiel.disabled = true;
    });
    $('#option').on('change', function(e) {
      ppr.value = "";
      materiel.value = "";
      if (e.currentTarget.options[e.currentTarget.selectedIndex] != 0) {
        var scriptElement = document.createElement('script');
        ppr.disabled = false;
        scriptElement.async = true;
        scriptElement.type = 'text/javascript';
        scriptElement.src = 'materiel/affectaion.php?numero=1';
        document.getElementById('mat').appendChild(scriptElement);

      } else {
        ppr.disabled = true;
      }


    });
    $('#ppr').on('blur', function(e) {
      if (e.currentTarget.value != '') {
        var scriptElement = document.createElement('script');
        materiel.disabled = false;
        document.getElementById('mat').appendChild(scriptElement);
        scriptElement.async = true;
        scriptElement.type = 'text/javascript';
        scriptElement.src = "materiel/affectaion.php?numero=2&ppr=" + e.currentTarget.value + "";

      } else {
        materiel.value = "";
        materiel.disabled = true;
      }

    });
    $(':input[disabled]').css({
      'background-color': 'white'
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
        success: function(donnes) {
          alert('ca marche ....');
          $('#info_mat').modal('hide');

        },
        error: function() {
          alert('La requête n\'a pas abouti');
          $('#send').html('Envoyer');
        }
      });

    });
  });
</script>