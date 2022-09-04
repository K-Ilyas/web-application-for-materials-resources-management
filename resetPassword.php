<?php
if (isset($_POST['email'])) {
?>
  <div class="modal-dialog">
    <div class="modal-content modal-c">
      <form action="" method="POST" autocomplete="off">
        <div class="modal-header modal-h">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-password-reset-30.png"><span class="label label-default" style="background-color:  #00ACC1;">Reset password:</span></h4>
        </div>
        <div class="modal-body modal-b">
          <div class="form-group">
            <label for="" style="color:black;">Nouveau password: </label>
            <div class="input-group">
              <span class="input-group-addon lock1" style="color: grey;background-color:white;"><i class="fa fa-eye-slash"></i></span>
              <input type="password" class="form-control" placeholder="Entrer password" id="pass" name="pass" required>
              <span class="input-group-addon"><img src="icons/icons8-password-reset-20 (1).png"> </span>
            </div>
          </div>
          <div class="form-group">
            <label for="" style="color:black;">Confirm password: </label>
            <div class="input-group">
              <span class="input-group-addon lock2" style="color: grey;background-color:white;"><i class="fa fa-eye-slash"></i></span>
              <input type="password" class="form-control" placeholder="Confirm password" id="cpass" name="cpass" required>
              <span class="input-group-addon"><img src="icons/icons8-good-pincode-20 (1).png"> </span>


            </div>
          </div>
          <input type="hidden" id="email" name="email" value="<?php echo $_POST['email']; ?>">
          <div class="form-group" id="error_co" style="display: none;text-align: center;color: red;">
            <span>Error au niveau des serveur veuillez réssayer.</span>
          </div>
          <div class="form-group" id="error_cpass" style="display: none;text-align: left;color: red;">
            <p style="color: black;">Un mot de passe valide aura : </p>
            <p id="nombre_carctere">- <img src=""> de 8 à 15 caractères.</p>
            <p id="majuscule">- <img src=""> au moins une lettre majuscule au debut. </p>
            <p id="minuscule">- <img src=""> au moins une lettre minuscule.</p>
            <p id="chiffre">- <img src=""> au moins un chiffre. </p>
            <p id="cactrere">- <img src=""> 0 au moins un de ces caractères spéciaux: $ @ % * + - _ ! . </p>
            <p id="autre">- <img src=""> aucun autre caractère possible: pas de & ni de { par exemple.</p>
          </div>

          <div class="form-group" id="error_confirme" style="display: none;text-align: center;color: red;">
            <span>il faut confirmer le mot de passe coorectement.</span>
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
      $('.lock1').on('mousedown', function() {
        $(this).find('i').attr('class', 'fa fa-eye');
        $("#pass").attr('type', 'text');
      });
      $('.lock1').on('mouseup mouseout', function() {
        $(this).find('i').attr('class', 'fa fa-eye-slash');
        $("#pass").attr('type', 'password');
      });
      $('.lock2').on('mousedown', function() {
        $(this).find('i').attr('class', 'fa fa-eye');
        $("#cpass").attr('type', 'text');
      });
      $('.lock2').on('mouseup mouseout', function() {
        $(this).find('i').attr('class', 'fa fa-eye-slash');
        $("#cpass").attr('type', 'password');
      });
      $('#reset').on('click', function(e) {
        $("#error_co").css("display", "none");
        $("#error_cpass").css("display", "none");
        $("#error_confirme").css("display", "none");

      });

      $("#pass").on("blur", function(e) {
        if ($(this).val() === "") {
          $("#cpass").val("");
          $("#error_co").css("display", "none");
          $("#error_cpass").css("display", "none");
        }
      });



      $("form").submit(function(e) {
        e.preventDefault();
        var has_empty = true;
        $(this).find('input[type="text"]').each(function() {

          if ($(this).val() === "") {
            has_empty = false;

          }
        });

        if (has_empty) {

          if (/^(?=[A-Z]{1,})(?=.*[a-z])(?=.*\d)(?=.*[\.]{0,1})(?=.*[-+!*$@%_]*)([-+!*$@%_\w\.]{8,15})$/.test($('#pass').val())) {
            if ($("#cpass").val() == $('#pass').val()) {
              $('#chrge').html('<div class="modal-dialog"style="display:felx;justify-content:center;align-items:center;text-align:center;" ><img  src=\"image_page/load.gif\" style="margin-top:-70px;" width="500" height="400"></div>');

              $('#chrge').modal();
              var $form = $(this);
              $.post('change.php', {
                numero: 3,
                email: $("#email").val(),
                password: $("#pass").val()
              }, function(data) {

                if (data == 'true') {
                  $('#chrge').modal("hide");
                  $("#info_forgot").load("validation.php");
                  /*$.post('change.php',{email:$("#email").val()},function(data)
                      {
                      $('#info_forgot').html(data);
                      });
                      */



                } else {
                  $('#chrge').modal("hide");

                  $('#error_co').css("display", "none");
                  $("#error_cpass").css("display", "none");
                  $("#error_co").css("display", "block");


                  $('#cpass').val('');
                  $('#pass').val('');

                }

              });
            }


          } else {
            $('#cpass').val('');
            if (/^([-+!*$@%_\w\.]{8,15})$/.test($('#pass').val())) {
              $("#nombre_carctere").find('img').attr('src', 'icons/icons8-checkmark-20.png');
              $("#nombre_carctere").css("color", "#5E9C76");
            } else {
              $("#nombre_carctere").find('img').attr('src', 'icons/icons8-delete-20.png');
              $("#nombre_carctere").css("color", "#C74343");
            }
            if (/^(?=[A-Z]{1,})([-+!*$@%_\w\.]+)$/.test($('#pass').val())) {
              $("#majuscule").find('img').attr('src', 'icons/icons8-checkmark-20.png');
              $("#majuscule").css("color", "#5E9C76");
            } else {
              $("#majuscule").find('img').attr('src', 'icons/icons8-delete-20.png');
              $("#majuscule").css("color", "#C74343");
            }
            if (/^(?=.*[a-z])([-+!*$@%_\w\.]+)$/.test($('#pass').val())) {
              $("#minuscule").find('img').attr('src', 'icons/icons8-checkmark-20.png');
              $("#minuscule").css("color", "#5E9C76");
            } else {
              $("#minuscule").find('img').attr('src', 'icons/icons8-delete-20.png');
              $("#minuscule").css("color", "#C74343");
            }
            if (/^(?=.*\d)([-+!*$@%_\w\.]+)$/.test($('#pass').val())) {
              $("#chiffre").find('img').attr('src', 'icons/icons8-checkmark-20.png');
              $("#chiffre").css("color", "#5E9C76");
            } else {
              $("#chiffre").find('img').attr('src', 'icons/icons8-delete-20.png');
              $("#chiffre").css("color", "#C74343");
            }

            $("#cactrere").find('img').attr('src', 'icons/icons8-checkmark-20.png');
            $("#cactrere").css("color", "#5E9C76");
            if (/^([^-+!*$@%_\w\.]+)$/.test($('#pass').val())) {
              $("#autre").find('img').attr('src', 'icons/icons8-delete-20.png');
              $("#autre").css("color", "#C74343");
            } else {
              $("#autre").find('img').attr('src', 'icons/icons8-checkmark-20.png');
              $("#autre").css("color", "#5E9C76");

            }



            $("#error_co").css("display", "none");
            $("#error_confirme").css("display", "none");

            $("#error_cpass").css("display", "block");
          }
        }
      });


    });
  </script>


<?php
}
?>