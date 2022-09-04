<style type="text/css">


</style>

<div class="modal-dialog">
  <div class="modal-content modal-c">
    <form action="" method="POST" autocomplete="off">
      <div class="modal-header modal-h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-forgot-password-30.png"><span class="label label-info" style="background-color:#ffa366;">Forgot password ?</span></h4>
      </div>
      <div class="modal-body modal-b">

        <div class="form-group">
          <label style="color:black;" for="">E-mail:</label>
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Entrer E-mail" name="email" id="email" required>
            <span class="input-group-addon"><img src="icons/icons8-email-20.png"> </span>


          </div>

        </div>
        <div class="form-group" id="error_code" style="display: none;text-align: center;color: red;">
          <span>vous avez entré une adresse e-mail non valide</span>
        </div>


        <div class="form-group" id="error_existe" style="display: none;text-align: center;color: red;">
          <span>vous avez entré une adresse e-mail non existe</span>
        </div>


      </div>

      <div class="modal-footer modal-f" style="text-align:center;">
        <div class="pull-right">
          <button type="reset" id="reset" class="btn btn-default btn-sm ref end"><span class="label label-danger" style="font-size:1em;"> Actualiser </span><img src="icons/icons8-synchronize-25.png"> </button>
          <button type="submit" class="btn btn-default btn-sm ref end"><span class="label label-info" style="font-size:1em;">Envoyer </span><img src="icons/icons8-paper-plane-25.png"> </button>

        </div>
      </div>

    </form>
  </div>

</div>



<script type="text/javascript">
  $(function() {

    $('#reset').on('click', function(e) {
      $("#error_code").css("display", "none");
      $("#error_existe").css("display", "none");

    });
    $("#email").on("focus", function(e) {
      $("#error_code").css("display", "none");
      $("#error_existe").css("display", "none");

    });

    $("form").submit(function(e) {
      e.preventDefault();
      var has_empty = true;
      var select_empty = true;
      $(this).find('input[type="email"]').each(function() {

        if ($(this).val() === "") {
          has_empty = false;
        }
      });

      if (has_empty) {

        if (/^([a-zA-Z0-9._-]+)@([a-z0-9._-]+)\.([a-z]{2,6})$/.test($('#email').val())) {
          $('#chrge').html('<div class="modal-dialog"style="display:felx;justify-content:center;align-items:center;text-align:center;" ><img  src=\"image_page/load.gif\" style="margin-top:-70px;" width="500" height="400"></div>');
          $('#chrge').modal();
          var $form = $(this);
          $.post('change.php', {
            numero: 1,
            email: $("#email").val()
          }, function(data) {

            if (data == "true") {
              $('#chrge').modal("hide");
              $("#info_forgot").load("codeValidation.php", {
                email: $("#email").val()
              });
              /* $.post('codeValidation.php',{email:$("#email").val()},function(data)
               {
               $('#info_forgot').html(data);
               });*/
            } else {
              $('#chrge').modal("hide");

              $('#error_code').css("display", "none");

              $('#error_existe').css("display", "block");
              $('#email').val('');

            }

          });

        } else {
          $('#email').val('');
          $('#error_existe').css("display", "none");
          $("#error_code").css("display", "block");
        }
      } else {
        alert('remplissage de tout les champs obligatoire ...');
      }

    });


  });
</script>