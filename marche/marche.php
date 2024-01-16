<div class="panel panel-default panel_pr" id="marche_pr">
  <div class="panel-heading" style="display: flex; justify-content: space-between;">
    <h3 style="display:flex;align-items: center;" class="panel-title " style="font-weight: bold;"><img src="icons/icons8-buying-30.png"><span class="label label-default">Marché:</span></h3>
    <div>
      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit_mc" data-toggle="collapse" href="#div_mc"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_mc" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>
    </div>
  </div>
  <div id="div_mc" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_marche" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-default log">Insérer un nouveau record</span></a>
      </div>

      <div class="table-responsive" id="table_rmc">
        <table class="table  table-striped table-condensed  table-dark" id="table_mc">
          <?php
          require __DIR__ . '/../db.php';

          $reponse2 = $bdd->query('SELECT  * FROM Marché ');
          ?>
          <thead>
            <tr>
              <th>NUMERO</th>
              <th>TYPE</th>
              <th>DESCRIPTION</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>
                <td><?php echo $donnes2['numéro_marché']; ?></td>
                <td><?php echo $donnes2['type']; ?></td>
                <td><?php echo $donnes2['description']; ?></td>

                <td>
                  <button type="button" value='<?php echo $donnes2['numéro_marché']; ?>' style="color: #005ce6" class="btn btn-default btn-xs button_mc"><img src="icons/icons8-edit-row-25.png"></span><span class="label label-primary">Éditer</span></button>
                  <button type="button" value='<?php echo $donnes2['numéro_marché']; ?>' style="color:#e60000" class="btn btn-default btn-xs delete_mc"><img src="icons/icons8-delete-row-25.png"></span><span class="label label-danger">Supprimer</span></button>

                </td>
              </tr>

            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>NUMERO</th>
              <th>TYPE</th>
              <th>DESCRIPTION</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>


        </table>

      </div>




    </div>


  </div>
  <div class="modal fade" id="info_marche">


  </div>





  <script type="text/javascript" id="js_en">
    $(function() {
      $('#div_mc').on('hide.bs.collapse', function() {
        $('#reduit_mc').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div_mc').on('show.bs.collapse', function() {
        $('#reduit_mc').html("<img src=\"icons/icons8-minimize-window-30.png\">");
      });
      $('#close_mc').on('click', function() {
        $('#marche_pr').hide(1000);
      });

      var table = $('#table_mc').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

      var fun = (function() {
        $('#table_rmc').load('marche/marche.php #table_mc', function() {

          table = $('#table_mc').dataTable({
            "scrollCollapse": true,
            "stateSave": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true
          });
          $('.button_mc').fadeIn().on('click', function(e) {
            e.preventDefault();
            $('#marche_pr').css('opacity', '1');
            $.post('marche/modifier_marche.php', {
              marche: $(this).attr('value')
            }, function(data) {

              $('#info_marche').html(data);
              $('#info_marche').modal();

            });
          });;
          $('.delete_mc').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur de supprimer se ligne?')) {
              e.preventDefault();
              $.post('marche/modification_marche.php?numero=3', {
                  marche: $(this).attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_rmc').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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
      $('#inserer_marche').on('click', function(e) {
        e.preventDefault();
        $('#marche_pr').css('opacity', '1');
        $('#info_marche').load('marche/nouveau_marche.php');
        $('#info_marche').modal();

      });

      $("#marche_pr").on("hidden.bs.modal", ".modal", function() {
        $(this).removeData("bs.modal");

        table.fnClearTable();
        table.fnDestroy();
        $('#table_rmc').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
        setTimeout(function() {

          fun();

        }, 1000);

      });


      $('.button_mc').on('click', function(e) {
        e.preventDefault();
        $('#marche_pr').css('opacity', '1');
        $.post('marche/modifier_marche.php', {
          marche: $(this).attr('value')
        }, function(data) {

          $('#info_marche').html(data);
          $('#info_marche').modal();

        });
      });


      $('.delete_mc').on('click', function(e) {
        if (confirm('étes vous sur de supprimer se ligne?')) {
          e.preventDefault();
          $.post('marche/modification_marche.php?numero=3', {
              marche: $(this).attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();

              $('#table_rmc').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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