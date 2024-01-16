$(function () {
  function aleatoire(number) {

  }
  $('#envoyer').click(function () {

    if ($('#ppr').val() != "" && $('#pwd').val() != "") {
      $.post('traitement.php', { ppr: $('#ppr').val(), pwd: $('#pwd').val(), retenir: ($('#retenir').is(':checked') ? 'true' : 'false') }, function (data) {
        if (data == 'true') {
          $('#myForm').submit();
        }
        else {
          alert(data)
          $('#error:hidden').show();
          $('#ppr').val('');
          $('#pwd').val('');
        }
      });
    }
    else {
      alert('Remplissage des champs obligatoire');
    }

  });
  $("#act").on("click", function (e) {
    $('#error').css("display", "none");
    $('#ppr').val('');
    $('#pwd').val('');

  });
  $('#forgotPassword').on('click', function (e) {
    $('#info_forgot').load("forgotPassword.php");
    $('#info_forgot').modal({ backdrop: 'static', keyboard: false });
  });

  function sendMail(email, subject, body) {
    var link = "mailto:" + email
      + "?cc=myCCaddress@example.com"
      + "&subject=" + subject
      + "&body=" + body

    window.open(link);
  }
});