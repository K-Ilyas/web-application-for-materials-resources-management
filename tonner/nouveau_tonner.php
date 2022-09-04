<?php
session_start();
require __DIR__ . './../db.php';

?>
<style type="text/css">
  /*
          .modal-hentite
          {
            background-color:  rgb(243,243,243);
            border-bottom:1px solid lightgrey;
          }
          .modal-fentite
          {
            border-top:1px solid lightgrey;
            background-color:  rgb(243,243,243);
          }
          */
</style>



<div class="modal-dialog" id="matr">
  <div class="modal-content modal-c">
    <form action="tonner/modification_tonner.php?numero=1" method="POST" autocomplete="off">
      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-t-30.png"><span class="label label-default" style="background-color:#e34;">Tonner:</span></h4>
      </div>
      <div class="modal-body modal-b">


        <div class="form-group">
          <label for="">réference:</label>

          <div class="input-group">
            <input required type="text" id="ref" name="ref" class="form-control" placeholder="référence">
            <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>

          </div>
          <div id="error_t" style="display:none;">
            <span style="color:red;font-size:12px;">Numéro de tonner existe déja...</span>
          </div>
        </div>

        <div class="form-group">
          <label for="">marque:</label>

          <div class="input-group">
            <input required type="text" id="marque" name="marque" class="form-control" placeholder="marque">
            <span class="input-group-addon"><img src="icons/icons8-ball-point-pen-20.png"></span>

          </div>
        </div>
        <div class="form-group">
          <label for="">quantité minimale:</label>

          <div class="input-group">
            <input required type="number" id="qte_min" name="qte_min" class="form-control" min=1 placeholder="Quantité minimale">
            <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="">quantité stock:</label>

          <div class="input-group">
            <input required type="number" id="qte_stock" name="qte_stock" class="form-control" min=1 placeholder="Quantité en stock">
            <span class="input-group-addon"><img src="icons/icons8-numbers-input-form-20 (1).png"></span>

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

    $('#ref').on('blur', function(e) {

      if ($(this).val() != "") {
        var scriptElement = document.createElement('script');
        document.getElementById('matr').appendChild(scriptElement);
        scriptElement.async = true;
        scriptElement.type = 'text/javascript';
        scriptElement.src = "tonner/affectaion_tonner.php?numero=1&code=" + e.currentTarget.value + "";


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
          $("#info_tonner").modal("hide");
        })
        .fail(function() {
          alert("ça marche pas...");
        });
    });




  });
</script>