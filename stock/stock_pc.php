<style type="text/css">



</style>
<div class="panel panel-default" id="ordinateur_pr">
  <div class="panel-heading" id="materiel_panels" style="display: flex; justify-content: space-between;">
    <h3 class="panel-title" style="display:flex;align-items:center;"><img src="icons/icons8-monitor-30.png"> <span class="label label-warning" style="background-color:#B0C1D4;">Ordinateur:</span></h3>
    <div>
      <!--<button  style="display:inline;margin-top:0px; margin-left:2px;" class="btn btn-default btn-xs" id="reduit_ord" data-toggle="collapse" href="#div_ord"><i class="fa fa-window-minimize" style="color: grey;"></i></button>
							<button id="close_ord" style="display:inline;margin-top:0px; " class=" btn btn-default btn-xs btn-circle"><i class="fa fa-close" style="color:red;"></i></button>-->




      <button style="display:inline;padding: 0px;" class="btn btn-default  btn-xs" id="reduit_ord" data-toggle="collapse" href="#div_ord"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_ord" style="display:inline;margin-top:0px;background-color: none;padding: 0px; " class=" btn  btn-xs btn-default ">
        <img src="icons/icons8-close-window-30.png">
      </button>



    </div>
  </div>
  <div id="div_ord" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">


      <div class="table-responsive" id="tabler_mat">
        <table class="display" id="table_ord">
          <?php
          require __DIR__ . './../db.php';

          $reponse2 = $bdd->query('SELECT * FROM Matériels INNER JOIN arrivage_marché ON Matériels.id_arrivage=arrivage_marché.id WHERE etat=\'EN STOCK\' AND Matériels.type=\'PC\' ');;
          ?>
          <thead>
            <tr>
              <th>Numéro Série</th>
              <th>Marque</th>
              <th>Etat</th>
              <th>Marché</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>


                <td><?php echo $donnes2['N_Série']; ?></td>
                <td><?php echo $donnes2['marque']; ?></td>
                <td><?php echo $donnes2['etat']; ?></td>
                <td><?php echo $donnes2['AM_marché'] ?></td>



              </tr>

            <?php
            }
            $reponse2->closeCursor();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Numéro Série</th>
              <th>Marque</th>
              <th>Etat</th>
              <th>Marché</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>






  <script type="text/javascript">
    $(function() {
      $('#div_ord').on('hide.bs.collapse', function() {
        $('#reduit_ord').html("<img src=\"icons/icons8-maximize-window-30.png\">")
      });
      $('#div_ord').on('show.bs.collapse', function() {
        $('#reduit_ord').html("<img src=\"icons/icons8-minimize-window-30.png\">")
      });
      /*
      	$('#close_ord').on('click',function()
      	{
      		$('#ordinateur_pr').hide(1000);
      	});

            var table=$('#table_ord').dataTable({
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
            $('#ordinateur_pr').css('opacity','1');   
            });
        
          $("body").on("hidden.bs.modal", ".modal", function () {
           $(this).removeData("bs.modal");
           table.fnClearTable();
           table.fnDestroy();
           $('#ordinateur_pr').html('Chargemento<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>').fadeOut('slow');	
           $.ajax({
      		 type: "GET",   
           url: "materiel/materiel.php",   
           async: true,
           success : function(text)
           {
            $('#ordinateur_pr').replaceWith(text);

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
              $('#ordinateur_pr').css('opacity','1');

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
              $('#ordinateur_pr').html('Chargemento<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>').fadeOut('slow');
              $.ajax({
           type: "GET",   
           url: "materiel/materiel.php",   
           async: true,
           success : function(text)
           {
            $('#ordinateur_pr').replaceWith(text);

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
      $('#close_ord').on('click', function() {
        $('#ordinateur_pr').hide(1000);
      });

      var table = $('#table_ord').dataTable({
        "scrollCollapse": true,
        "stateSave": true,
        "bSort": true,
        "paging": true,
        'ordering': true,
        'retrieve': true

      });

    });
  </script>