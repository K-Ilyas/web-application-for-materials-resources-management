<div class="panel panel-default panel_pr" id="arrivage_pr">
  <div class="panel-heading" style="display: flex; justify-content: space-between;">
    <h3 style="display:flex;align-items: center;" class="panel-title " style="font-weight: bold;"><img src="icons/icons8-gg-30.png"><span class="label label-default" style="background-color:#F1C40F;">Arrivage:</span></h3>
    <div>
      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit_ar" data-toggle="collapse" href="#div_ar"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_ar" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>
    </div>
  </div>
  <div id="div_ar" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_arrivage" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-default log" style="background-color:#F1C40F;">Insérer un nouveau record</span></a>
      </div>
      <div class="table-responsive" id="table_rar">
        <table class="table  table-striped table-condensed  table-dark" id="table_ar">
          <?php
          require __DIR__ . '/../db.php';

          $reponse2 = $bdd->query('SELECT  * FROM Arrivage_Marché INNER JOIN Marché WHERE Marché.numéro_marché=Arrivage_Marché.AM_marché ');
          ?>
          <thead>
            <tr>
              <th>Arrivage </th>
              <th>Marché</th>
              <th>Quantite </th>
              <th>Type</th>
              <th>Date de stockage</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>
                <td><?php echo $donnes2['AM_arrivage']; ?></td>
                <td><?php echo $donnes2['AM_marché']; ?></td>
                <td><?php echo $donnes2['qte']; ?></td>
                <td><?php echo $donnes2['type']; ?></td>

                <td><?php echo $donnes2['date_stockage']; ?></t>
                <td>

                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color:#e60000" class="btn btn-default btn-xs delete_ar"><img src="icons/icons8-delete-row-25.png"></span><span class="label label-danger">Supprimer</span></button>
                </td>
              </tr>
            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Arrivage </th>
              <th>Marché</th>
              <th>Quantite </th>
              <th>Type</th>
              <th>Date de stockage</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="info_arrivage">
  </div>
  <script type="text/javascript" id="js_en">
    $(function() {
      $('#div_ar').on('hide.bs.collapse', function() {
        $('#reduit_ar').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div_ar').on('show.bs.collapse', function() {
        $('#reduit_ar').html("<img src=\"icons/icons8-minimize-window-30.png\">");
      });
      $('#close_ar').on('click', function() {
        $('#arrivage_pr').hide(1000);
      });

      var table = $('#table_ar').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

      var fun = (function() {
        $('#table_rar').load('arrivage/arrivage.php #table_ar', function() {

          table = $('#table_ar').dataTable({
            "scrollCollapse": true,
            "stateSave": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true
          });
          $('.button_ar').fadeIn().on('click', function(e) {
            e.preventDefault();
            $('#arrivage_pr').css('opacity', '1');
            $.post('arrivage/modifier_arrivage.php', {
              id: $(this).attr('value')
            }, function(data) {

              $('#info_arrivage').html(data);
              $('#info_arrivage').modal();

            });
          });;
          $('.delete_ar').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur de supprimer se ligne?')) {
              e.preventDefault();
              $.post('arrivage/modification_arrivage.php?numero=3', {
                  id: $(this).attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_rar').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
                  setTimeout(function() {

                    fun();

                  }, 1000);
                })
                .fail(function() {
                  alert("ça marche pas...");
                });

            }

          });

        });
      });
      $('#inserer_arrivage').on('click', function(e) {
        e.preventDefault();
        $('#arrivage_pr').css('opacity', '1');
        $('#info_arrivage').load('arrivage/nouveau_arrivage.php');
        $('#info_arrivage').modal();

      });

      $("#arrivage_pr").on("hidden.bs.modal", ".modal", function() {
        $(this).removeData("bs.modal");

        table.fnClearTable();
        table.fnDestroy();
        $('#table_rar').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
        setTimeout(function() {

          fun();

        }, 1000);

      });


      $('.button_ar').on('click', function(e) {
        e.preventDefault();
        $('#arrivage_pr').css('opacity', '1');
        $.post('arrivage/modifier_arrivage.php', {
          id: $(this).attr('value')
        }, function(data) {

          $('#info_arrivage').html(data);
          $('#info_arrivage').modal();

        });
      });


      $('.delete_ar').on('click', function(e) {
        if (confirm('étes vous sur de supprimer se ligne?')) {
          e.preventDefault();
          $.post('arrivage/modification_arrivage.php?numero=3', {
              id: $(this).attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();

              $('#table_rar').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
              setTimeout(function() {

                fun();

              }, 1000);
            })
            .fail(function() {
              alert("ça marche pas...");
            });

        }
      });

    });
  </script>