<div class="panel panel-default panel_pr" id="employe_pr">
  <div class="panel-heading" style="display: flex; justify-content: space-between;">
    <h3 class="panel-title" style="display: flex;align-items:center;"><img src="icons/icons8-employee-30.png"><span class="label label-success">Employé:</span></h3>
    <div>
      <button style="display:inline;padding: 0px;" class="btn btn-default btn-xs" id="reduit_em" data-toggle="collapse" href="#div_em"><img src="icons/icons8-minimize-window-30.png"></button>
      <button id="close_em" style="display:inline;margin-top:0px;padding: 0px; " class=" btn btn-default btn-xs btn-circle"><img src="icons/icons8-close-window-30.png"></button>
    </div>
  </div>
  <div id="div_em" class="list-group collapse in">

    <div class="panel-body" style="width: 100%;">
      <div style="margin-bottom: 8px;">
        <a href="" id="inserer_employe" style="width:200px;display: flex;align-items:center;text-decoration: none;"><img src="icons/icons8-add-row-25.png"><span class="label label-success log">Insérer un nouveau record</span></a>
      </div>

      <div class="table-responsive" id="table_re">
        <table class="table  table-striped table-condensed" id="table_em">
          <?php
          require __DIR__ . '/../db.php';
          $reponse2 = $bdd->query('SELECT * FROM Employé WHERE etat=\'simple\'');
          ?>
          <thead>
            <tr>
              <th>ID</th>
              <th>PPR</th>
              <th>NOM</th>
              <th>PRÉNOM</th>
              <th>SEXE</th>
              <th>ENTITÉ</th>
              <th>OPTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($donnes2 = $reponse2->fetch()) {
            ?>
              <tr>
                <td><?php echo $donnes2['id']; ?></td>
                <td><?php echo $donnes2['ppr']; ?></td>
                <td><?php echo $donnes2['nom']; ?></td>
                <td><?php echo $donnes2['prénom']; ?></td>
                <td><?php echo $donnes2['sexe']; ?></td>

                <td><?php
                    $reponse3 = $bdd->query('SELECT id,libellé FROM Entité');
                    while ($donnes3 = $reponse3->fetch()) {
                      if ($donnes2['id_entite'] == $donnes3['id']) {
                        echo $donnes3['libellé'];
                        break;
                        $reponse3->closeCursor();
                      }
                    }
                    ?>
                </td>
                <td>
                  <button type="button" style="color: #005ce6" value='<?php echo $donnes2['id']; ?>' class="btn btn-default btn-xs button_em"><img src="icons/icons8-edit-row-25.png"></span><span class="label label-primary">Éditer</span></button>
                  <button type="button" style="color:#e60000" value='<?php echo $donnes2['id']; ?>' class="btn btn-default btn-xs delete_em ">
                    <img src="icons/icons8-delete-row-25.png"></span><span class="label label-danger">Supprimer</span></button>
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
              <th>PPR</th>
              <th>NOM</th>
              <th>PRÉNOM</th>
              <th>SEXE</th>
              <th>ENTITÉ</th>
              <th>OPTIONS</th>
            </tr>
          </tfoot>


        </table>

      </div>




    </div>


  </div>



  <div class="modal fade" id="info_em">
  </div>

  <div class="modal fade" id="chrge" data-toggle="modal" data-backdrop="false">
  </div>

</div>



<script type="text/javascript">
  /*$(function()
	{
		$('#div_em').on('hide.bs.collapse',function()
		{
         $('#reduit_em').html("<i class=\" fa fa-window-maximize\"  style=\"color: grey;\"></i>")
		});
		$('#div_em').on('show.bs.collapse',function()
		{
         $('#reduit_em').html("<i class=\"fa fa-window-minimize\"  style=\"color: grey;\"></i>")
		});
	$('#close_em').on('click',function()
	{
		$('#employe_pr').hide(1000);
	});

      var table=$('#table_em').dataTable({
            "scrollCollapse": true,
            "bSort": true,
            "paging": true,
              'ordering': true,
                  'retrieve': true

        });


      $('#inserer_employe').on('click',function(e)
      {
      	e.preventDefault();
        $('#employe_pr').css('opacity','1');

      	$('#info_em').load('employe/nouveau_employe.php');
      $('#info_em').modal();
      

      });
  
    $("#employe_pr").on("hidden.bs.modal", ".modal", function () {
          $(this).removeData("bs.modal");
 table.fnClearTable();
     table.fnDestroy();
     $('#table_em').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');

            $('#table_re').load('employe/employe.php #table_re',function()
            {
              table=$('#table_em').dataTable({
            "scrollCollapse": true,
            "bSort": true,
            "paging": true,
              'ordering': true,
                  'retrieve': true

        });



$('.button_em').fadeIn().on('click',function(e)
    {
      e.preventDefault();
     $.post('employe/modifier_employe.php',{id:$(this).attr('value')},function(data)
     {
    
        $('#info_em').html(data);
        $('#info_em').modal();
        $('#employe_pr').css('opacity','1');

     });
    });
 

  $('.delete_em').fadeIn().on('click',function(e)
  {
    e.preventDefault();
    if(confirm('étes vous sur de supprimer se ligne?'))
    {
        $.post('employe/modification_employe.php?numero=3',{id:$(this).attr('value')})
          .done(function(data) {
       table.fnClearTable();
     table.fnDestroy();
     $('#table_em').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');

            $('#table_re').load('employe/employe.php #table_re',function()
            {
              table=$('#table_em').dataTable({
            "scrollCollapse": true,
            "bSort": true,
            "paging": true,
              'ordering': true,
                  'retrieve': true

        });
            });
          })
          .fail(function() {
            alert("ça marche pas...");
          });

  }

  });



            });

       
      });


    $('.button_em').on('click',function(e)
    {
    	e.preventDefault();
     $.post('employe/modifier_employe.php',{id:$(this).attr('value')},function(data)
     {
  	
     		$('#info_em').html(data);
     		$('#info_em').modal();
        $('#employe_pr').css('opacity','1');

     });
    });
 

  $('.delete_em').on('click',function(e)
  {
  	e.preventDefault();
    if(confirm('étes vous sur de supprimer se ligne?'))
    {
        $.post('employe/modification_employe.php?numero=3',{id:$(this).attr('value')})
          .done(function(data) {
       table.fnClearTable();
     table.fnDestroy();
     $('#table_em').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');

            $('#table_re').load('employe/employe.php #table_re',function()
            {
              table=$('#table_em').dataTable({
            "scrollCollapse": true,
            "bSort": true,
            "paging": true,
            'ordering': true,
            'retrieve': true

        });
            });
          })
          .fail(function() {
            alert("ça marche pas...");
          });

  }

  });

    });
    */

  /*------------------------------------------------------------*/
  $(function() {
    $('#div_em').on('hide.bs.collapse', function() {
      $('#reduit_em').html("<img src=\"icons/icons8-maximize-window-30.png\">")
    });
    $('#div_em').on('show.bs.collapse', function() {
      $('#reduit_em').html("<img src=\"icons/icons8-minimize-window-30.png\">")
    });
    $('#close_em').on('click', function() {
      $('#employe_pr').hide(1000);
    });

    var table = $('#table_em').dataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true

    });

    var fun = (function() {
      $('#table_re').load('employe/employe.php #table_em', function() {

        table = $('#table_em').dataTable({
          "scrollCollapse": true,
          "stateSave": true,
          "bSort": true,
          "paging": true,
          'ordering': true,
          'retrieve': true
        });
        $('.button_em').fadeIn().on('click', function(e) {
          e.preventDefault();
          $('#employe_pr').css('opacity', '1');
          $.post('employe/modifier_employe.php', {
            id: $(this).attr('value')
          }, function(data) {

            $('#info_em').html(data);
            $('#info_em').modal();

          });
        });;
        $('.delete_em').fadeIn().on('click', function(e) {
          if (confirm('étes vous sur de supprimer se ligne?')) {
            e.preventDefault();
            $.post('employe/modification_employe.php?numero=3', {
                id: $(this).attr('value')
              })
              .done(function(data) {
                table.fnClearTable();
                table.fnDestroy();

                $('#table_re').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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
    $('#inserer_employe').on('click', function(e) {
      e.preventDefault();
      $('#employe_pr').css('opacity', '1');
      $('#info_em').load('employe/nouveau_employe.php');
      $('#info_em').modal();
    });

    $("#employe_pr").on("hidden.bs.modal", ".modal", function() {
      $(this).removeData("bs.modal");

      table.fnClearTable();
      table.fnDestroy();
      $('#table_re').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
      setTimeout(function() {

        fun();

      }, 1000);

    });


    $('.button_em').on('click', function(e) {
      e.preventDefault();
      $('#employe_pr').css('opacity', '1');
      $.post('employe/modifier_employe.php', {
        id: $(this).attr('value')
      }, function(data) {

        $('#info_em').html(data);
        $('#info_em').modal();

      });
    });


    $('.delete_em').on('click', function(e) {
      if (confirm('étes vous sur de supprimer se ligne?')) {
        e.preventDefault();
        $.post('employe/modification_employe.php?numero=3', {
            id: $(this).attr('value')
          })
          .done(function(data) {
            table.fnClearTable();
            table.fnDestroy();

            $('#table_em').html('<p style="text-align:center;"><img src="image_page/ajax-loader.gif"><br><span>Chargement...</span></p>');
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