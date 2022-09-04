<?php
if (!isset($_SESSION['ppr_admin'])) {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css?v=<?php echo time(); ?>">
  </head>

  <body>
    <div class="container-fluid center">
      <div class="row col-sm-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading">
          </div>
          <div class="panel-body" id="img_admin">
            <form action="index.php" method="POST" autocomplete="off" id="myForm">
              <div class="form-group">
                <label for="email">Matricule:</label>
                <div class="input-group op">
                  <input type="email" class="form-control op" value="<?php echo isset($_COOKIE['ppr']) ? $_COOKIE['ppr'] : ''  ?>" id="ppr" placeholder="Entrer matricule" name="email" required>
                  <span class="input-group-addon op"><img src="icons/icons8-admin-settings-male-20 (2).png"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="pwd">Mot de passe:</label>
                <div class="input-group op">
                  <input type="password" class="form-control op" id="pwd" placeholder="Entrer mot de passe" name="pwd" required>
                  <span class="input-group-addon op"><img src="icons/icons8-lock-20.png"></span>
                </div>
                <div id="error">
                  <span>Error!! Mot de passe ou Matricule incoorect!!</span>
                </div>

              </div>
              <div class="form-group" style="margin-bottom:20px;">
                <div class="checkbox " style="margin-left:3px">
                  <label for="retenir"><input type="checkbox" name="retenir" id="retenir" value="ppr" <?php if (isset($_COOKIE['ppr'])) echo "checked"; ?> />Retenir le pseudo</label>
                </div>
              </div>
              <div class="form-group">
                <button type="button" id="envoyer" class="btn btn-default form-control  btn-sm op end"><span style="font-weight: bold;">Submit</span><img src="icons/icons8-forward-arrow-25.png"></button>
              </div>
            </form>
          </div>
          <div class="panel-footer">
            <div class="form-group" style="display:flex;align-items: flex-end;justify-content:space-between;">
              <button type="reset" id="act" class="btn btn-default btn-sm pull-left op end"><span style="font-weight: bold;">Actualiser</span><img src="icons/icons8-synchronize-25.png"></button>
              <div style=""> Forgot <a id="forgotPassword" href="#" style="text-decoration: underline;"> password?</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="row col-sm-12" id="icon">
    </div>
    <footer class="row col-sm-12 footer  navbar-fixed-bottom">
      <p>&copy; Copyright <?php echo date('Y'); ?> <abbr title="Direction Régionale des Impots Agadir">DGIA</abbr></p>
      </div>
    </footer>
    </div>
    <div class="modal fade" id="info_forgot">
    </div>
    <div class="modal fade" id="chrge" data-toggle="modal" data-backdrop="false">
    </div>

  </body>
  <script src="bootstrap-3.3.7/dist/js/jquery-3.4.1.min.js"></script>
  <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="admin.js?v<?php echo time(); ?>"></script>

  </html>
<?php
} else
  require __DIR__ . './index.php'
?>