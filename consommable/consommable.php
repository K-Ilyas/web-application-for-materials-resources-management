<div class="panel panel-default panel_pr" id="consommable_pr">
  <div class="panel-heading" style="display: flex; justify-content: space-between;">
    <h3 style="display:flex;align-items: center;" class="panel-title " style="font-weight: bold;"><img src="icons/icons8-print-file-30.png"><span class="label label-info" style="background-color:#1ABC9C;">Consommable:</span></h3>
    <div>
      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit_co" data-toggle="collapse" href="#div_co"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_co" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>
    </div>
  </div>
  <div id="div_co" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_consommable" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-default log" style="background-color:#1ABC9C;">Insérer un nouveau record</span></a>
      </div>

      <div class="table-responsive" id="table_rco">
        <table class="table  table-striped table-condensed  table-dark" id="table_co">
          <?php
          require __DIR__ . './../db.php';

          $reponse2 = $bdd->query('SELECT * FROM BL_Consommable');
          ?>
          <thead>
            <tr>
              <!-- <th >Numéro</th> -->
              <th>Réference</th>
              <th>Matricule</th>
              <th>N_Série</th>
              <th>Date</th>
              <th>Qauntite</th>
              <th>Compteur</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>
                <!--      <td><?php echo $donnes2['N_BL']; ?></td> -->

                <td><?php echo $donnes2['BL_réf'] ?></td>
                <td><?php echo $donnes2['BL_ppr']; ?></td>
                <td><?php echo $donnes2['BL_série'] ?></td>
                <td><?php echo $donnes2['BL_date']; ?></td>
                <td><?php echo $donnes2['qte_livre']; ?></td>
                <td><?php echo $donnes2['compteur']; ?></td>

                <td>
                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color:#e60000" class="btn btn-default btn-xs delete_co"><img src="icons/icons8-delete-row-25.png"></span><span class="label label-danger">Supprimer</span></button>
                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color:#e60000" class="btn btn-default btn-xs annuler"><img src="icons/icons8-cancel-last-digit-25.png"></span><span class="label label-default" style="background-color: #F1C40F;">Annuler</span></button>
                  <form style="display:inline;" action="consommable/consommable_pdf.php" target="print_popup" method="POST" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
                    <input type="hidden" name="id" value='<?php echo $donnes2['id']; ?>'>
                    <button type="submit" value='<?php echo $donnes2['id']; ?>' style="color:#e60000" class="btn btn-default btn-xs 
                          imprimer"><img src="icons/icons8-send-to-printer-25.png"></span><span class="label label-default" style="background-color: #B0C1D4;">Imprimer</span></button>
                  </form>



                </td>
              </tr>

            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <!--    <th >Numéro</th> -->

              <th>Réference</th>
              <th>Matricule</th>
              <th>N_Série</th>
              <th>Date</th>
              <th>Qauntite</th>
              <th>Compteur</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>


        </table>

      </div>




    </div>


  </div>
  <div class="modal fade" id="info_consmmable">


  </div>





  <script type="text/javascript" id="js_en">
    $(function() {


      $('#div_co').on('hide.bs.collapse', function() {
        $('#reduit_co').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div_co').on('show.bs.collapse', function() {
        $('#reduit_co').html("<img src=\"icons/icons8-minimize-window-30.png\">");
      });
      $('#close_co').on('click', function() {
        $('#consommable_pr').hide(1000);
      });

      var table = $('#table_co').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

      var fun = (function() {
        $('#table_rco').load('consommable/consommable.php #table_co', function() {

          table = $('#table_co').dataTable({
            "scrollCollapse": true,
            "stateSave": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true
          });
          $('.button_co').fadeIn().on('click', function(e) {
            e.preventDefault();
            $('#consommable_pr').css('opacity', '1');
            $.post('consommable/modifier_consommable.php', {
              id: $(this).attr('value')
            }, function(data) {

              $('#info_consmmable').html(data);
              $('#info_consmmable').modal();

            });
          });;

          $('.delete_co').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur de supprimer se ligne?')) {
              e.preventDefault();
              $.post('consommable/modification_consommable.php?numero=3', {
                  id: $(this).attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_rco').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
                  setTimeout(function() {

                    fun();

                  }, 1000);
                })
                .fail(function() {
                  alert("ça marche pas...");
                });

            }

          });

          $('.annuler').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur d\'annuler se ligne?')) {
              e.preventDefault();
              $.post('consommable/modification_consommable.php?numero=2', {
                  id: $(this).attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_rco').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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
      $('#inserer_consommable').on('click', function(e) {
        e.preventDefault();
        $('#consommable_pr').css('opacity', '1');
        $('#info_consmmable').load('consommable/nouveau_consommable.php');
        $('#info_consmmable').modal();

      });

      $("#consommable_pr").on("hidden.bs.modal", ".modal", function() {
        $(this).removeData("bs.modal");

        table.fnClearTable();
        table.fnDestroy();
        $('#table_rco').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
        setTimeout(function() {

          fun();

        }, 1000);

      });


      $('.button_co').on('click', function(e) {
        e.preventDefault();
        $('#consommable_pr').css('opacity', '1');
        $.post('consommable/modifier_consommable.php', {
          id: $(this).attr('value')
        }, function(data) {

          $('#info_consmmable').html(data);
          $('#info_consmmable').modal();

        });
      });


      $('.delete_co').on('click', function(e) {
        if (confirm('étes vous sur de supprimer se ligne?')) {
          e.preventDefault();
          $.post('consommable/modification_consommable.php?numero=3', {
              id: $(this).attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();

              $('#table_rco').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
              setTimeout(function() {

                fun();

              }, 1000);
            })
            .fail(function() {
              alert("ça marche pas...");
            });

        }
      });
      $('.annuler').on('click', function(e) {
        if (confirm('étes vous sur d\'annuler se ligne?')) {
          e.preventDefault();
          $.post('consommable/modification_consommable.php?numero=2', {
              id: $(this).attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();

              $('#table_rco').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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