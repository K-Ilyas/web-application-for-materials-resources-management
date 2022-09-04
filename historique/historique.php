<link rel="stylesheet" type="text/css" href="plugin/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />

<style type="text/css">
  .panel.with-nav-tabs .panel-heading {
    padding: 5px 5px 0 5px;
  }

  .panel.with-nav-tabs .nav-tabs {
    border-bottom: none;
  }

  .panel.with-nav-tabs .nav-justified {
    margin-bottom: -1px;
  }

  .href {
    border-radius: 0px !important;
  }

  with-nav-tabs.panel-default .nav-tabs>li>a,
  .with-nav-tabs.panel-default .nav-tabs>li>a:hover,
  .with-nav-tabs.panel-default .nav-tabs>li>a:focus {
    color: #777;
  }

  .with-nav-tabs.panel-default .nav-tabs>.open>a,
  .with-nav-tabs.panel-default .nav-tabs>.open>a:hover,
  .with-nav-tabs.panel-default .nav-tabs>.open>a:focus,
  .with-nav-tabs.panel-default .nav-tabs>li>a:hover,
  .with-nav-tabs.panel-default .nav-tabs>li>a:focus {
    color: #777;
    background-color: #ddd;
    border-color: transparent;
  }

  .with-nav-tabs.panel-default .nav-tabs>li.active>a,
  .with-nav-tabs.panel-default .nav-tabs>li.active>a:hover,
  .with-nav-tabs.panel-default .nav-tabs>li.active>a:focus {
    color: #555;
    background-color: #fff;
    border-color: #ddd;
    border-bottom-color: transparent;
  }

  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu {
    background-color: #f5f5f5;
    border-color: #ddd;
  }

  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>li>a {
    color: #777;
  }

  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>li>a:hover,
  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>li>a:focus {
    background-color: #ddd;
  }

  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>.active>a,
  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>.active>a:hover,
  .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>.active>a:focus {
    color: #fff;
    background-color: #555;
  }
</style>




<?php
require __DIR__ . './../db.php';

$reponse2 = $bdd->query('SELECT * FROM employé_histo');
?>
<div class="panel with-nav-tabs panel-default">
  <div class="panel-heading">
    <ul class="nav nav-tabs">
      <ul class="nav nav-tabs" style="border:none;" role="tablist">
        <li class="active href"><a data-toggle="tab" href="#employ" class="href">Employés</a></li>
        <li><a data-toggle="tab" href="#materiel">Matériels</a></li>
        <li><a data-toggle="tab" href="#Emp_mat">mployés Matériels</a></li>
        <li><a data-toggle="tab" href="#march">Marché</a></li>
        <li><a data-toggle="tab" href="#consommabl">Consommable</a></li>
        <li><a data-toggle="tab" href="#tonn">Tonner</a></li>
        <li><a data-toggle="tab" href="#arrivg">Arivage Marché</a></li>
        <li><a data-toggle="tab" href="#arrivg">Entité</a></li>
      </ul>
      </li>
    </ul>
  </div>
  <div class="panel-body" style="">
    <div class="tab-content">
      <div id="employ" class="tab-pane fade in active" style="padding-top:10px;">

        <div class="table-responsive">
          <table class="table display" id="employe_tr">
            <?php
            require __DIR__ . './../db.php';
            $reponse2 = $bdd->query('SELECT * FROM Employé_histo');
            ?>
            <thead>
              <tr>
                <th>ID</th>
                <th>PPR</th>
                <th>NOM</th>
                <th>PRÉNOM</th>
                <th>SEXE</th>
                <th>ENTITÉ</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
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
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>

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
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>
      </div>
      <div id="materiel" class="tab-pane fade" style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table display" id="materiel_tr">
            <?php
            $reponse2 = $bdd->query('SELECT * FROM Matériels_histo');
            ?>
            <thead>
              <tr>
                <th>ID</th>
                <th>NUMÉRO SÉRIE</th>
                <th>MARQUE</th>
                <th>TYPE</th>
                <th>ETAT</th>
                <th>ID IRRIVAGE</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <tr>
                  <td><?php echo $donnes2['id_histo']; ?></td>
                  <td><?php echo $donnes2['N_Série']; ?></td>
                  <td><?php echo $donnes2['marque']; ?></td>
                  <td><?php echo $donnes2['type']; ?></td>
                  <td><?php echo $donnes2['etat']; ?></td>
                  <td><?php echo $donnes2['id_arrivage']; ?></td>
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>

                </tr>

              <?php
              }
              $reponse2->closeCursor();
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>NUMÉRO SÉRIE</th>
                <th>MARQUE</th>
                <th>TYPE</th>
                <th>ETAT</th>
                <th>ID IRRIVAGE</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>

      </div>
      <!-- --------------------------------------------------------- -->
      <div id="Emp_mat" class="tab-pane fade" style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table display" id="Emp_mat_tr">
            <?php
            $reponse2 = $bdd->query('SELECT * FROM employé_matériel_histo');
            ?>
            <thead>
              <tr>
                <th>ID</th>
                <th>MATRICULE</th>
                <th>NUMÉRO SÉRIE</th>
                <th>DATE ACTIVATION</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <tr>
                  <td><?php echo $donnes2['id_histo']; ?></td>
                  <td><?php echo $donnes2['EM_ppr']; ?></td>
                  <td><?php echo $donnes2['EM_Série']; ?></td>
                  <td><?php echo $donnes2['date_activation']; ?></td>
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>


                </tr>

              <?php
              }
              $reponse2->closeCursor();
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>MATRICULE</th>
                <th>NUMÉRO SÉRIE</th>
                <th>DATE ACTIVATION</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>

      </div>
      <!------------ -------------------------------------------- -->
      <div id="march" class="tab-pane fade" style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table display" id="marche_tr">
            <?php
            $reponse2 = $bdd->query('SELECT * FROM marché_histo');
            ?>
            <thead>
              <tr>
                <th>ID</th>
                <th>NUMÉRO MARCHÉ</th>
                <th>TYPE</th>
                <th>DESCRIPTION</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <tr>
                  <td><?php echo $donnes2['id_histo']; ?></td>
                  <td><?php echo $donnes2['numéro_marché']; ?></td>
                  <td><?php echo $donnes2['type']; ?></td>
                  <td><?php echo $donnes2['description']; ?></td>
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>


                </tr>

              <?php
              }
              $reponse2->closeCursor();
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>NUMÉRO MARCHÉ</th>
                <th>TYPE</th>
                <th>DESCRIPTION</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>

      </div>
      <!------------ -------------------------------------------- -->
      <div id="consommabl" class="tab-pane fade" style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table display" id="consommabl_tr">
            <?php
            $reponse2 = $bdd->query('SELECT * FROM consommable_histo');
            ?>
            <thead>
              <tr>
                <th>ID</th>
                <th>RÉFERENCE</th>
                <th>MARQUE</th>
                <th>QUANTITE MINIMALE</th>
                <th>QUANTITE STOCK</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <tr>
                  <td><?php echo $donnes2['id_histo']; ?></td>
                  <td><?php echo $donnes2['réf']; ?></td>
                  <td><?php echo $donnes2['marque']; ?></td>
                  <td><?php echo $donnes2['qte_min']; ?></td>
                  <td><?php echo $donnes2['qte_stock']; ?></td>
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>


                </tr>

              <?php
              }
              $reponse2->closeCursor();
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>RÉFERENCE</th>
                <th>MARQUE</th>
                <th>QUANTITE MINIMALE</th>
                <th>QUANTITE STOCK</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>

      </div>
      <!-- -------------------------------------------------------------------- -->
      <div id="tonn" class="tab-pane fade" style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table display" id="tonner_tr">
            <?php
            $reponse2 = $bdd->query('SELECT * FROM bl_consommable_histo');
            ?>
            <thead>
              <tr>

                <th>ID</th>
                <th>RÉFERENCE</th>
                <th>MATRIQULE</th>
                <th>NUMÉRO SÉRIE</th>
                <th>DATE</th>
                <th>QUANTITE LIVRE</th>
                <th>NUMÉRO BL</th>
                <th>COMPTEUR</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <tr>
                  <td><?php echo $donnes2['id_histo']; ?></td>
                  <td><?php echo $donnes2['BL_réf']; ?></td>
                  <td><?php echo $donnes2['BL_ppr']; ?></td>
                  <td><?php echo $donnes2['BL_série']; ?></td>
                  <td><?php echo $donnes2['BL_date']; ?></td>
                  <td><?php echo $donnes2['qte_livre']; ?></td>
                  <td><?php echo $donnes2['N_BL']; ?></td>
                  <td><?php echo $donnes2['compteur']; ?></td>
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>
                </tr>

              <?php
              }
              $reponse2->closeCursor();
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>RÉFERENCE</th>
                <th>MATRIQULE</th>
                <th>NUMÉRO SÉRIE</th>
                <th>DATE</th>
                <th>QUANTITE LIVRE</th>
                <th>NUMÉRO BL</th>
                <th>COMPTEUR</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>
              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>

      </div>
      <!-- ---------------------------------------------------------------- -->

      <div id="arrivg" class="tab-pane fade" style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table display" id="arrivage_tr">
            <?php
            $reponse2 = $bdd->query('SELECT * FROM arrivage_marché_histo');
            ?>
            <thead>
              <tr>

                <th>ID</th>
                <th>AM ARRIVAGE</th>
                <th>AM MARCHÉ</th>
                <th>QUANTITE </th>
                <th>DATE STOCKAGE</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($donnes2 = $reponse2->fetch()) {
              ?>
                <tr>
                  <td><?php echo $donnes2['id_histo']; ?></td>
                  <td><?php echo $donnes2['AM_arrivage']; ?></td>
                  <td><?php echo $donnes2['AM_marché']; ?></td>
                  <td><?php echo $donnes2['qte']; ?></td>
                  <td><?php echo $donnes2['date_stockage']; ?></td>
                  <td><?php echo $donnes2['event']; ?></td>
                  <td><?php echo $donnes2['date_event']; ?></td>
                </tr>

              <?php
              }
              $reponse2->closeCursor();
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>AM ARRIVAGE</th>
                <th>AM MARCHÉ</th>
                <th>QUANTITE </th>
                <th>DATE STOCKAGE</th>
                <th>EVENT</th>
                <th>DATE EVENT</th>

              </tr>
            </tfoot>


          </table>

        </div>

        <?php $reponse2->closeCursor(); ?>

      </div>

      <div id="menu2" class="tab-pane fade">

      </div>





    </div>
  </div>
</div>


</div>








<script type="text/javascript">
  $(function() {


    var table = $('#employe_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });
    var table = $('#materiel_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });
    var table = $('#Emp_mat_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });
    var table = $('#marche_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });
    var table = $('#consommabl_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });
    var table = $('#tonner_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });
    var table = $('#arrivage_tr').DataTable({
      "scrollCollapse": true,
      "stateSave": true,
      "bSort": true,
      "paging": true,
      'ordering': true,
      'retrieve': true,
      'responsive': true

    });


  });
</script>
