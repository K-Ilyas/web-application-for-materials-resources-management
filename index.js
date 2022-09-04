

$(function () {
  $("body").on("hidden.bs.modal", ".modal", function () {
    $(this).removeData("bs.modal");

  });

  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });



  $('#account').click(function () {
    $("#info_account").load("account.php");

    $("#info_account").modal("show");

  });

  $('#password').click(function () {
    $("#info_account").load("password_admin.php");

    $("#info_account").modal("show");

  });

  $('#entite').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('entite_pr')) {
      $.ajax({
        type: "GET",
        url: "entite/entite.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#entite_pr').hide().show(2000);

        }
      });

    }
    else if ($('#entite_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "entite/entite.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#entite_pr').hide().show(2000);
        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });


  $('#employe').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('employe_pr')) {
      $.ajax({
        type: "GET",
        url: "employe/employe.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#employe_pr').hide().show(2000);


        }
      });

    }
    else if ($('#employe_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "employe/employe.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#employe_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });

  $('#materiels').on('click', function (e) {

    e.preventDefault();
    if (!$('#materiel_pr').length) {
      $.ajax({
        type: "GET",
        url: "materiel/materiel.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#materiel_pr').hide().show(2000);


        }
      });

    }
    else if ($('#materiel_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "materiel/materiel.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#materiel_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });







  $('#marche').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('marche_pr')) {
      $.ajax({
        type: "GET",
        url: "marche/marche.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#marche_pr').hide().show(2000);


        }
      });

    }
    else if ($('#marche_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "marche/marche.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#marche_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }
  });



  $('#tonner').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('tonner_pr')) {
      $.ajax({
        type: "GET",
        url: "tonner/tonner.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#tonner_pr').hide().show(2000);


        }
      });

    }
    else if ($('#tonner_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "tonner/tonner.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#tonner_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });





  $('#consommable').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('consommable_pr')) {
      $.ajax({
        type: "GET",
        url: "consommable/consommable.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#consommable_pr').hide().show(2000);


        }
      });

    }
    else if ($('#consommable_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "consommable/consommable.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#consommable_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });





  $('#arrivage').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('arrivage_pr')) {
      $.ajax({
        type: "GET",
        url: "arrivage/arrivage.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#arrivage_pr').hide().show(2000);


        }
      });

    }
    else if ($('#arrivage_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "arrivage/arrivage.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#arrivage_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });

  $(document).on('click', function () {
    $('#hello').hide(2000);
  });

  /*----------------------------------------------------------*/
  /*---------------------------------------------------------*/

  $('#historique').on('click', function () {
    $('#contenu').html('');

    if (!document.getElementById('historique_pr')) {


      $.ajax({
        type: "GET",
        url: "historique/historique.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#historique_pr').hide().show(2000);


        }
      });

    }
    else if ($('#historique_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "historique/historique_pc.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#historique_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }


  });

  $('#stock').on('click', function () {/*
  $('#contenu2').html('<h1  style=\'font-size:2.3em;color:black;font-family:CenturyGothic;font-style:bold;\'>Stock</h1>');
  */$('#contenu').html('');

  });
  $('#base').on('click', function () {
  /*
  $('#contenu2').html('<h1 style=\'font-size:2.3em;color:black;font-family: CenturyGothic;font-style:bold;\'>Table</h1>');
   */$('#contenu').html('');

  });



  $('#ordinateur').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('ordinateur_pr')) {


      $.ajax({
        type: "GET",
        url: "stock/stock_pc.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#ordinateur_pr').hide().show(2000);


        }
      });

    }
    else if ($('#ordinateur_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "stock/stock_pc.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#ordinateur_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });


  $('#imprimante').on('click', function (e) {
    e.preventDefault();
    if (!document.getElementById('imprimante_pr')) {
      $.ajax({
        type: "GET",
        url: "stock/stock_imp.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#imprimante_pr').hide().show(2000);


        }
      });

    }
    else if ($('#imprimante_pr:hidden').length) {
      $.ajax({
        type: "GET",
        url: "stock/stock_imp.php",
        async: true,
        success: function (text) {
          $('#contenu').prepend(text);
          $('#imprimante_pr').hide().show(2000);

        }
      });
    }
    else {
      alert('existe déja ...');
    }

  });


});

$('#recherche').on('click', function (e) {
  e.preventDefault();
  alert("ca ne marche pas!!");
});