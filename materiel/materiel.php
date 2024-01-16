<style type="text/css">



</style>
<div class="panel panel-default" id="materiel_pr">
  <div class="panel-heading" id="materiel_panels" style="display: flex; justify-content: space-between;">
    <h3 class="panel-title" style="display:flex;align-items:center;"><img src="icons/icons8-workstation-30 (1).png"> <span class="label label-warning">Matériels:</span></h3>
    <div>
      <!--<button  style="display:inline;margin-top:0px; margin-left:2px;" class="btn btn-default btn-xs" id="reduit_mat" data-toggle="collapse" href="#div_mat"><i class="fa fa-window-minimize" style="color: grey;"></i></button>
							<button id="close_mat" style="display:inline;margin-top:0px; " class=" btn btn-default btn-xs btn-circle"><i class="fa fa-close" style="color:red;"></i></button>-->




      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit_mat" data-toggle="collapse" href="#div_mat"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_mat" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>



    </div>
  </div>
  <div id="div_mat" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_materiel" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-warning log">Insérer un nouveau record</span></a>
      </div>

      <div class="table-responsive" id="tabler_mat">
        <table class="table  table-striped table-condensed" id="table_mat">
          <?php
          require __DIR__ . '/../db.php';

          $reponse2 = $bdd->query('SELECT ppr,M.id as id ,M.N_Série as N_Série,M.marque ,M.type as type,
            M.etat,date_activation FROM Employé INNER JOIN Employé_Matériel ON 
            Employé.ppr=Employé_Matériel.EM_ppr INNER JOIN  Matériels as  M ON M.N_Série=Employé_Matériel.EM_Série WHERE Employé.etat=\'simple\'');;
          ?>
          <thead>
            <tr>
              <th>MATRICULE</th>
              <th>N SÉRIE</th>
              <th>MARQUE</th>
              <th>TYPE</th>
              <th>ETAT</th>
              <th>DATE ACTIVATION</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>

                <td><?php echo $donnes2['ppr']; ?></td>

                <td><?php echo $donnes2['N_Série']; ?></td>
                <td><?php echo $donnes2['marque']; ?></td>
                <td><?php echo $donnes2['type']; ?></td>
                <td><?php echo $donnes2['etat']; ?></td>
                <td><?php echo $donnes2['date_activation'] ?></td>


                <td>
                  <button type="button" value='<?php echo $donnes2['ppr']; ?>' class="btn btn-default btn-xs button"><img src="icons/icons8-edit-row-25.png"><span><span class="label label-primary">Éditer</span><input type="hidden" disabled name="serie" value='<?php echo $donnes2['N_Série'] ?>' disabled></button>
                  <button type="button" value='<?php echo $donnes2['ppr']; ?>' class="btn btn-default btn-xs delete"><img src="icons/icons8-delete-row-25.png"><span class="label label-danger">Supprimer</span><input type="hidden" disabled name="serie" value='<?php echo $donnes2['N_Série'] ?>' disabled></button>
                </td>
              </tr>

            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>MATRICULE</th>
              <th>N SÉRIE</th>
              <th>MARQUE</th>
              <th>TYPE</th>
              <th>ETAT</th>
              <th>DATE ACTIVATION</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>


        </table>

      </div>




    </div>


  </div>
  <div class="modal fade" id="info_mat" style="opacity:1;">
  </div>





  <script type="text/javascript">
    $(function() {
      $('#div_mat').on('hide.bs.collapse', function() {
        $('#reduit_mat').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div_mat').on('show.bs.collapse', function() {
        $('#reduit_mat').html("<img src=\"icons/icons8-minimize-window-30.png\">")
      });
      /*
      	$('#close_mat').on('click',function()
      	{
      		$('#materiel_pr').hide(1000);
      	});

            var table=$('#table_mat').dataTable({
                  "scrollCollapse": true,            
                  "bSort": true,
                  "paging": true,
                  'ordering': true,
                  'retrieve': true
              });


            $('#inserer_materiel').on('click',function(e)
            {
            e.preventDefault();
            $('#info_mat').load('materiel/nouveau_materiel.php');
            $('#info_mat').modal();
            $('#materiel_pr').css('opacity','1');   
            });
        
          $("body").on("hidden.bs.modal", ".modal", function () {
           $(this).removeData("bs.modal");
           table.fnClearTable();
           table.fnDestroy();
           $('#materiel_pr').html('Chargemento<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>').fadeOut('slow');	
           $.ajax({
      		 type: "GET",   
           url: "materiel/materiel.php",   
           async: true,
           success : function(text)
           {
            $('#materiel_pr').replaceWith(text);

           }
       });
             
            });


          $('.button').on('click',function(e)
          {
          	e.preventDefault();

           $.post('materiel/modifier_materiel.php',{ppr:$(this).attr('value'),serie:$(this).find('input').attr('value')},function(data)
           {
        	
           		$('#info_mat').html(data);
           		$('#info_mat').modal();
              $('#materiel_pr').css('opacity','1');

           });
          });
       

        $('.delete').on('click',function(e)
        {
        	e.preventDefault();
          if(confirm('étes vous sur de supprimer se ligne?'))
          {
              $.post('materiel/modification_materiel.php?numero=3',{ppr:$(this).attr('value'),serie:$(this).find('input').attr('value')})
              .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();
              $('#materiel_pr').html('Chargemento<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>').fadeOut('slow');
              $.ajax({
           type: "GET",   
           url: "materiel/materiel.php",   
           async: true,
           success : function(text)
           {
            $('#materiel_pr').replaceWith(text);

           }
       });
                })
                .fail(function() {
                  alert("ça marche pas...");
                });

        }

        });

          });
          */
      $('#close_mat').on('click', function() {
        $('#materiel_pr').hide(1000);
      });

      var table = $('#table_mat').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

      var fun = (function() {
        $('#tabler_mat').load('materiel/materiel.php #table_mat', function() {

          table = $('#table_mat').dataTable({
            "scrollCollapse": true,
            "stateSave": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true
          });
          $('.button').fadeIn().on('click', function(e) {
            e.preventDefault();
            $.post('materiel/modifier_materiel.php', {
              ppr: $(this).attr('value'),
              serie: $(this).find('input').attr('value')
            }, function(data) {

              $('#info_mat').html(data);
              $('#info_mat').modal();

            });
          });;
          $('.delete').fadeIn().on('click', function(e) {
            if (confirm('étes vous sur de supprimer se ligne?')) {
              e.preventDefault();
              $.post('materiel/modification_materiel.php?numero=3', {
                  ppr: $(this).attr('value'),
                  serie: $(this).find('input').attr('value')
                })
                .done(function(data) {
                  table.fnClearTable();
                  table.fnDestroy();

                  $('#table_mat').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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
      $('#inserer_materiel').on('click', function(e) {
        e.preventDefault();
        $('#materiel_pr').css('opacity', '1');
        $('#info_mat').load('materiel/nouveau_materiel.php');
        $('#info_mat').modal();

      });

      $("#materiel_pr").on("hidden.bs.modal", ".modal", function() {
        $(this).removeData("bs.modal");

        table.fnClearTable();
        table.fnDestroy();
        $('#tabler_mat').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
        setTimeout(function() {

          fun();

        }, 1000);

      });


      $('.button').on('click', function(e) {
        e.preventDefault();
        $('#entite').css('opacity', '1');
        $.post('materiel/modifier_materiel.php', {
          ppr: $(this).attr('value'),
          serie: $(this).find('input').attr('value')
        }, function(data) {

          $('#info_mat').html(data);
          $('#info_mat').modal();

        });
      });


      $('.delete').on('click', function(e) {
        if (confirm('étes vous sur de supprimer se ligne?')) {
          e.preventDefault();
          $.post('materiel/modification_materiel.php?numero=3', {
              ppr: $(this).attr('value'),
              serie: $(this).find('input').attr('value')
            })
            .done(function(data) {
              table.fnClearTable();
              table.fnDestroy();

              $('#table_mat').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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