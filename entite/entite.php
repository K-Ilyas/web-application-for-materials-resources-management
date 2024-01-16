<div class="panel panel-default panel_pr" id="entite_pr">
  <div class="panel-heading" style="display: flex; justify-content: space-between;">
    <h3 style="display:flex;align-items: center;" class="panel-title " style="font-weight: bold;"><img src="icons/icons8-list-30.png"><span class="label label-info">Entité:</span></h3>
    <div>
      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit" data-toggle="collapse" href="#div"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>
    </div>
  </div>
  <div id="div" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_entite" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-info log">Insérer un nouveau record</span></a>
      </div>

      <div class="table-responsive" id="table_en">
        <table class="table  table-striped table-condensed  table-dark" id="table">
          <?php
          require __DIR__ . '/../db.php';
          $reponse2 = $bdd->query('SELECT * FROM Entité');
          ?>
          <thead>
            <tr>
              <th>ID</th>
              <th>ABR</th>
              <th>LIBELLE</th>
              <th>VILLE</th>
              <th>ENITE RACINE</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>
                <td><?php echo $donnes2['id']; ?></td>
                <td><?php echo $donnes2['abr']; ?></td>
                <td><?php echo $donnes2['libellé']; ?></td>
                <td><?php
                    $reponse3 = $bdd->prepare('SELECT ville FROM ville WHERE id=?');
                    $reponse3->execute(array($donnes2['ville']));
                    $donnes3 = $reponse3->fetch();
                    echo $donnes3['ville'];
                    $reponse3->closeCursor();

                    ?></td>
                <td>
                  <?php
                  if (empty($donnes2['entité_racine']))
                    echo 'NULL';
                  else
                    echo $donnes2['entité_racine'];
                  ?>
                </td>
                <td>
                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color: #005ce6" class="btn btn-default btn-xs button_pr"><img src="icons/icons8-edit-row-25.png"></span><span class="label label-primary">Éditer</span></button>
                  <button type="button" value='<?php echo $donnes2['id']; ?>' style="color:#e60000" class="btn btn-default btn-xs delete_pr"><img src="icons/icons8-delete-row-25.png"></span><span class="label label-danger">Supprimer</span></button>

                </td>
              </tr>

            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>ABR</th>
              <th>LIBELLE</th>
              <th>VILLE</th>
              <th>ENITE RACINE</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>


        </table>

      </div>




    </div>


  </div>
  <div class="modal fade" id="info_entite">


  </div>





  <script type="text/javascript" id="js_en">
    $(function() {
      $('#div').on('hide.bs.collapse', function() {
        $('#reduit').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div').on('show.bs.collapse', function() {
        $('#reduit').html("<img src=\"icons/icons8-minimize-window-30.png\">");
      });
      $('#close').on('click', function() {
        $('#entite_pr').hide(1000);
      });

      var table = $('#table').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

      var fun = (function() {
        $('#table_en').load('entite/entite.php #table', function() {
          table = $('#table').dataTable({
            "scrollCollapse": true,
            "stateSave": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true
          });
          $('.button_pr').fadeIn().on('click', function(e) {
            e.preventDefault();
            $('#entite_pr').css('opacity', '1');
            $.post('entite/modifier_entite.php', {
              id: $(this).attr('value')
            }, function(data) {

              $('#info_entite').html(data);
              $('#info_entite').modal();

            });
          });;
          $('.delete_pr').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur de supprimer se ligne?')) {
              e.preventDefault();
              $.post('entite/modification_entite.php?numero=3', {
                  id: $(this).attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_en').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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
      $('#inserer_entite').on('click', function(e) {
        e.preventDefault();
        $('#entite_pr').css('opacity', '1');
        $('#info_entite').load('entite/nouveau_entite.php');
        $('#info_entite').modal();

      });

      $("#entite_pr").on("hidden.bs.modal", ".modal", function() {
        $(this).removeData("bs.modal");

        table.fnClearTable();
        table.fnDestroy();
        $('#table_en').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
        setTimeout(function() {

          fun();

        }, 1000);

      });


      $('.button_pr').on('click', function(e) {
        e.preventDefault();
        $('#entite_pr').css('opacity', '1');
        $.post('entite/modifier_entite.php', {
          id: $(this).attr('value')
        }, function(data) {

          $('#info_entite').html(data);
          $('#info_entite').modal();




        });
      });


      $('.delete_pr').on('click', function(e) {
        if (confirm('étes vous sur de supprimer se ligne?')) {
          e.preventDefault();
          $.post('entite/modification_entite.php?numero=3', {
              id: $(this).attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();
              $('#table_en').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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