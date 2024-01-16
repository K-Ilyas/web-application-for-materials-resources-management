<?php
session_start();

require __DIR__ . '/../db.php';

?>
<style type="text/css">

</style>


<div class="modal-dialog" id="matr">
  <div class="modal-content modal-c">
    <form action="marche/modification_marche.php?numero=1" method="POST" autocomplete="off">
      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-buying-30 (1).png"><span class="label label-default">Marché:</span></h4>
      </div>
      <div class="modal-body modal-b">

        <div class="form-group">
          <label for="">choix:</label>

          <div class="input-group">
            <select type="type" id="type" class="type tout form-control" name='type' required placeholder="Type">
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
            <input type="text" id="marche_n" name="marche" class="form-control" placeholder="Numéro Marché">
            <span class="input-group-addon"><img src="icons/icons8-document-20.png"></span>

          </div>
          <div id="error_m" style="display:none;">
            <span style="color:red;font-size:12px;">Numéro de marché existe déja...</span>
          </div>
        </div>

        <div class="form-group">
          <label for="">description:</label>

          <textarea id="description" class="decription tout form-control" name='description' required placeholder="Description"></textarea>


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

    $('#marche_n').on('blur', function(e) {

      if ($(this).val() != "") {
        var scriptElement = document.createElement('script');
        document.getElementById('matr').appendChild(scriptElement);
        scriptElement.async = true;
        scriptElement.type = 'text/javascript';
        scriptElement.src = "marche/affectaion_marche.php?numero=1&code=" + e.currentTarget.value + "";


      } else {
        $(this).val("");
      }

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