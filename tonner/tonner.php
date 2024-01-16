<div class="panel panel-default panel_pr" id="tonner_pr">
  <div class="panel-heading" style="display: flex; justify-content: space-between;">
    <h3 style="display:flex;align-items: center;" class="panel-title " style="font-weight: bold;"><img src="icons/icons8-t-30.png"><span style="background-color:#e34;" class="label label-default">Tonner:</span></h3>
    <div>
      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit_to" data-toggle="collapse" href="#div_to"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_to" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>
    </div>
  </div>
  <div id="div_to" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_tonner" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-default log" style="background-color:#e34;">Insérer un nouveau record</span></a>
      </div>

      <div class="table-responsive" id="table_rto">
        <table class="display" id="table_to">
          <?php
          require __DIR__ . '/../db.php';

          $reponse2 = $bdd->query('SELECT  * FROM Consommable ');
          ?>
          <thead>
            <tr>
              <th>Réference</th>
              <th>Marque</th>
              <th>Quantite minimale</th>
              <th>Quantite en stock</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>
                <td><?php echo $donnes2['réf']; ?></td>
                <td><?php echo $donnes2['marque']; ?></td>
                <td><?php echo $donnes2['qte_min']; ?></td>
                <td><?php echo $donnes2['qte_stock']; ?></t>

                <td>
                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color: #005ce6" class="btn btn-default btn-xs button_to"><img src="icons/icons8-edit-row-25.png"></span><span class="label label-primary">Éditer</span></button>
                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color:#e60000" class="btn btn-default btn-xs delete_to"><img src="icons/icons8-delete-row-25.png"></span><span class="label label-danger">Supprimer</span></button>

                </td>
              </tr>

            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Réference</th>
              <th>Marque</th>
              <th>Quantite minimale</th>
              <th>Quantite en stock</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>


        </table>

      </div>




    </div>


  </div>
  <div class="modal fade" id="info_tonner">


  </div>





  <script type="text/javascript" id="js_en">
    $(function() {
      $('#div_to').on('hide.bs.collapse', function() {
        $('#reduit_to').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div_to').on('show.bs.collapse', function() {
        $('#reduit_to').html("<img src=\"icons/icons8-minimize-window-30.png\">");
      });
      $('#close_to').on('click', function() {
        $('#tonner_pr').hide(1000);
      });

      var table = $('#table_to').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

      var fun = (function() {
        $('#table_rto').load('tonner/tonner.php #table_to', function() {

          table = $('#table_to').dataTable({
            "scrollCollapse": true,
            "stateSave": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true
          });
          $('.button_to').fadeIn().on('click', function(e) {
            e.preventDefault();
            $('#tonner_pr').css('opacity', '1');
            $.post('tonner/modifier_tonner.php', {
              id: $(this).attr('value')
            }, function(data) {

              $('#info_tonner').html(data);
              $('#info_tonner').modal();

            });
          });;
          $('.delete_to').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur de supprimer se ligne?')) {
              e.preventDefault();
              $.post('tonner/modification_tonner.php?numero=3', {
                  id: $(this).attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_rto').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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
      $('#inserer_tonner').on('click', function(e) {
        e.preventDefault();
        $('#tonner_pr').css('opacity', '1');
        $('#info_tonner').load('tonner/nouveau_tonner.php');
        $('#info_tonner').modal();

      });

      $("#tonner_pr").on("hidden.bs.modal", ".modal", function() {
        $(this).removeData("bs.modal");

        table.fnClearTable();
        table.fnDestroy();
        $('#table_rto').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
        setTimeout(function() {

          fun();

        }, 1000);

      });


      $('.button_to').on('click', function(e) {
        e.preventDefault();
        $('#tonner_pr').css('opacity', '1');
        $.post('tonner/modifier_tonner.php', {
          id: $(this).attr('value')
        }, function(data) {

          $('#info_tonner').html(data);
          $('#info_tonner').modal();

        });
      });


      $('.delete_to').on('click', function(e) {
        if (confirm('étes vous sur de supprimer se ligne?')) {
          e.preventDefault();
          $.post('tonner/modification_tonner.php?numero=3', {
              id: $(this).attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();

              $('#table_rto').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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