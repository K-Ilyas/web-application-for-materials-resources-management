<?php
session_start();
header('type-content:text/html');
require __DIR__ . './db.php';

if (isset($_SESSION['ppr_admin'])) {

?>
  <!DOCTYPE html>

  <html>

  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="plugin/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="index.css?v=<?php echo time(); ?>" />

  </head>

  <body>
    <?php include('navBar.php'); ?>
    <div class="container-fluid">
      <div class="row" id="row_right">
        <div class="col-lg-12">

          <?php include('navSide.php'); ?>

          <section class="col-lg-10 col-md-8 col-sm-8 " id="cont_change">

            <div id="contenu">

              <div class=" alert alert-success" id="hello">
                <?php
                $reponse = $bdd->prepare('SELECT nom,prénom FROM Employé WHERE ppr=?');
                $reponse->execute(array($_SESSION['ppr_admin']));
                if ($donnes = $reponse->fetch()) {
                  if (date("H") <= 18) {
                ?>
                    <h3>Bonjeur!!</h3>

                  <?php
                    echo $donnes['nom'] . ' ' . $donnes['prénom'];
                  } else {
                  ?>
                    <h3>Bonsoir!!</h3>

                <?php
                    echo $donnes['nom'] . ' ' . $donnes['prénom'];
                  }
                }
                $reponse->closeCursor();
                ?>




              </div>


            </div>
        </div>

        </section>


      </div>
    </div>
    </div>
    <div class="modal fade" id="infos">


    </div>
  </body>
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
  <script src="js/sb-admin.js"></script>
  <script type="text/javascript" src="plugin/datatables.min.js"></script>
  <script src="index.js?v=<?php echo time(); ?>"></script>

  </html>

<?php
} else
  header('Location:admin.php');
?>