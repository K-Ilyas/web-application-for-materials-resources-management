<?php
session_start();
require __DIR__ . './db.php';

if (isset($_SESSION['ppr_admin'])) {
  $reponse = $bdd->prepare('SELECT password FROM Employé WHERE ppr=?');
  $reponse->execute(array($_SESSION['ppr_admin']));

  if ($reponse->rowCount() == 1) {
    $donnes = $reponse->fetch();
    $password = $donnes['password'];

?>
    <style type="text/css">
      .input-group-addon {
        background-color: white;
      }
    </style>
    <div class="modal-dialog">
      <div class="modal-content" id="html">
        <form action="modifiction_admin.php?numero=2" method="POST" autocomplete="off">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title end"><img src="icons/icons8-password-20 (1).png"> Password :</h4>
          </div>
          <div class="modal-body">

            <div class="form-group">

              <label for="image">Mot de passe:</label>
              <div class="input-group">
                <span class="input-group-addon lock" style="color:grey"><i class="fa fa-eye-slash"></i></span>

                <input type="password" class="form-control password" placeholder="Entrer mot de passe" id="pwd" required>
                <span class="input-group-addon"><i class="fa fa-unlock  "></i></span>
              </div>
              <div style="text-align: center; margin-bottom: 15px;">
                <span id="pwd_error" style="display:none;color:red;font-style:italic;font-size:0.8em;">Mot de passe incoorect</span>
              </div>
            </div>
            <div class="form-group">
              <label for="">Nouveau mot de passe:</label>
              <div class="input-group">
                <span class="input-group-addon lock1" style="color: grey"><i class="fa fa-eye-slash"></i></span>
                <input type="password" class="form-control password2" id="nv_pwd" placeholder="Entrer nouveau mot de passe" required disabled>
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

              </div>
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
              <label for="image">Confirmé mot de passe:</label>
              <div class="input-group">
                <span class="input-group-addon lock2" style="color: grey"><i class="fa fa-eye-slash"></i></span>
                <input type="password" class="form-control password3" id="nv_pwdc" placeholder="Confirmé mot de passe" name="nouveau_pwd" required disabled>
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              </div>
            </div>
            <div style="text-align: center; margin-bottom: 15px;">
              <span id="error" style="display:none;color:red;font-style:italic;font-size:0.8em;">Mot de passe incoorect</span>
            </div>


          </div>
          <div class="modal-footer modal-fa">

            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              <div class="btn-group" role="group">
                <button type="button" id="modifier" class="btn btn-default end" style="color: green;" data-dismiss="modal"><img src="icons/icons8-close-window-20.png"> Annuler</button>
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
    $(":input[disabled]").css('background-color', 'white');
    $('.lock').on('mousedown', function() {
      $(this).find('i').attr('class', 'fa fa-eye');
      $(".password").attr('type', 'text');
    });
    $('.lock').on('mouseup mouseout', function() {
      $(this).find('i').attr('class', 'fa fa-eye-slash');
      $(".password").attr('type', 'password');
    });
    $('.lock1').on('mousedown', function() {
      $(this).find('i').attr('class', 'fa fa-eye');
      $(".password2").attr('type', 'text');
    });
    $('.lock1').on('mouseup mouseout', function() {
      $(this).find('i').attr('class', 'fa fa-eye-slash');
      $(".password2").attr('type', 'password');
    });
    $('.lock2').on('mousedown', function() {
      $(this).find('i').attr('class', 'fa fa-eye');
      $(".password3").attr('type', 'text');
    });
    $('.lock2').on('mouseup mouseout', function() {
      $(this).find('i').attr('class', 'fa fa-eye-slash');
      $(".password3").attr('type', 'password');
    });
    $("#pwd").on('blur', function() {
      if ($(this).val() !== "") {
        var scriptElement = document.createElement('script');
        $.getScript("password_admin_dynamic.php?password=" + $(this).val() + "");
      } else {
        $('.password2,.password3').attr('disabled', 'true');

      }


    });
    $('#nv_pwd').on('blur', function() {
      if ($(this).val() == "") {
        $('#nv_pwdc').val("");
      }

    });

    $('#nv_pwdc').on('blur', function() {
      if ($(this).val() !== $('#nv_pwd').val()) {
        $(this).val('');
        $('#error:hidden').show();
      } else {
        $('#error').css('display', 'none');
      }

    });
    $("form").submit(function(e) {

      e.preventDefault();
      if ($('#nv_pwdc').val() != "") {
        var $form = $(this);
        $.post($form.attr("action"), $form.serialize())
          .done(function(data) {
            $("#info_account").modal("hide");
            alert("ça marche ...");
          })
          .fail(function() {
            alert("ça marche pas...");
          });
      }
    });


  });
</script>