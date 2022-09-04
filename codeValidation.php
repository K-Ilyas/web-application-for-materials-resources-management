<?php
if (isset($_POST['email'])) {
?>
  <div class="modal-dialog">
    <div class="modal-content modal-c">
      <form action="" method="POST" autocomplete="off">
        <div class="modal-header modal-h">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display: flex;align-items: center;"><img src="icons/icons8-email-30.png"><span class="label label-default" style="background-color:  #00bfff;">Code validation:</span></h4>
        </div>
        <div class="modal-body modal-b">



          <div class="form-group">
            <label for="" style="color:black;">Code: </label><span style="text-align: center;color:green;font-size:0.8em;margin-left:6px;">(un code est envoyé à votre adresse email)</span>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Entrer code" id="code" name="code" required>
              <span class="input-group-addon"><img src="icons/icons8-pin-code-20 (1).png"> </span>


            </div>
          </div>
          <input type="hidden" id="email" name="email" value="<?php echo $_POST['email']; ?>">
          <div class="form-group" id="error_co" style="display: none;text-align: center;color: red;">
            <span>le code comporte exactement 8 numéro.</span>
          </div>

          <div class="form-group" id="error_number" style="display: none;text-align: center;color: red;">
            <span>vous avez entré une code erroné.</span>
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
        $("#error_co").css("display", "none");
        $("#error_number").css("display", "none");

      });
      $("#code").on('focus', function(e) {
        $("#error_co").css("display", "none");
        $("#error_number").css("display", "none");

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

          if (/^([0-9]{8})$/.test($('#code').val())) {
            $('#chrge').html('<div class="modal-dialog"style="display:felx;justify-content:center;align-items:center;text-align:center;" ><img  src=\"image_page/load.gif\" style="margin-top:-70px;" width="500" height="400"></div>');
            $('#chrge').modal();
            var $form = $(this);
            $.post('change.php', {
              numero: 2,
              email: $("#email").val(),
              code: $("#code").val()
            }, function(data) {

              if (data == 'true') {
                $('#chrge').modal("hide");
                $("#info_forgot").load("resetPassword.php", {
                  email: $("#email").val()
                });

              } else {
                $('#chrge').modal("hide");

                $('#error_co').css("display", "none");
                $("#error_number").css("display", "block");

                $('#code').val('');

              }

            });

          } else {
            $('#code').val('');
            $("#error_number").css("display", "none");
            $("#error_co").css("display", "block");
          }
        }
      });


    });
  </script>
<?php
}
?>