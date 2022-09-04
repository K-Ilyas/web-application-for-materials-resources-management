<!--
 <div class="navbar navbar-default navbar navbar-custom" role="navigation" id="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="btn-group btn-rounded" >
        <a class="navbar-brand" class="dropdown-toggle"  data-toggle="dropdown" href="#about" style="display: flex;direction: row;justify-content: space-around;"  ><span id="admin"><?php echo $_SESSION['ppr_admin']; ?></span></a>
        <ul class="dropdown-menu ">
                   <li class="disabled" style="display: flex; justify-content: center;"><a  href="#"><img src='<?php echo $_COOKIE['image_admin']; ?>'  class="img-rounded"></a></li>
                    <li class="divider"></li>
                    <li><a id="account"  style="text-align: center;"><i class="fa fa-cog"></i> Account</a></li>
                    <li class="divider"></li>
                   <li><a id="password"  style="text-align: center;"><i class="fa fa-lock"></i> Changer mot de passe</a></li>
                    <li class="divider"></li>
                    <li><a href="Deconnexion.php" style="text-align: center;"><i class="fa fa-sign-in"></i> Sign-out</a></li>
        </ul>
         </div>
          <div class="modal fade" id="info_account">
                            
 
          </div>
    



      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          
            <li class="dropdown">
            <a  class="dropdown-toggle" data-toggle="dropdown" ><span class="fa fa-address-book "></span> Menu 3</a>
             <ul class="dropdown-menu ">
                    <li><a href="Aceuil.php" style=""><i class="fa fa-sign-in"></i> Aceuil</a></li>
                    <li><a href="" style=""><i class="fa fa-sign-in"></i> Aceuil</a></li>
                    <li><a href="" style=""><i class="fa fa-sign-in"></i> Aceuil</a></li>
                                        <li class="divider"></li>

             </ul>
          </li>
      
        </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-left:5px;">
            <form class="navbar-form  navbar-right inline-form" action="recherche.php" role="form" autocomplete="off">
            <div class="form-group">
            <input type="text"  class="input-sm form-control" name="recherche" placeholder="Recherche">
             <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> Chercher</button> 
            </div>
          </form>
         
        </ul>
      
      </div>
    </div>
  </div>
  <div class="navbar navbar-default navbar navbar-fixed-bottom" role="navigation" id="footer_pr" >
    <div class="container container-bottom" id="flex_bottom">
            <div class="navbar-header" >
              <div class="navbar-brand" id="brand" >
             <p> &copy;2019 DGIA<p>
              </div>
      </div>
    </div>
  </div>
-->

<!--<div class="row" id="index" >
<div class="navbar navbar-inverse" id="nav">
  <div class="container-fluid">
<div class="navbar-header">
 <a class="navbar-brand" href="#" id="admistrateur"><span class="glyphicon glyphicon-user" id="icon-administrateur"></span> <?php $_SESSION; ?></a> 
</div>  
 <ul class="nav navbar-nav">   
  <li  class="active"><a href="Acceuil.php">Accueil</a> </li> 
      <li class="> <a href="#">Stocks</a> </li> 

         <li  class=">
         
          <a data-toggle="dropdown" href="#">Employé<b class="caret"></b></a>
            <ul class="dropdown-menu" id="dropdown">
              <li class="divider"></li>
              <li><a href="directeur.php">Ajouter</a></li>
              <li><a href="remove.php">Remove</a></li>
              <li><a href="affichage.php">Base</a></li>
              <li class="divider"></li>
            </ul>
            </li> 

            <li class="> <a href="#">Liens</a> </li> 
           </ul>
           <form class="navbar-form navbar-right inline-forme" action="recherche.php" method="POST" autocomplete="off"> 
            <input type="text" style="width:150px" class="input-sm form-control" name="recherche" placeholder="Recherche">
             <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> Chercher</button> 
           </form>
            </div>
          </div>
      </div>  
    -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="" style="width: 100px;"><img src="icons/icons8-admin-settings-male-50 (6).png" style="display: inline;">
        <div class="btn-group btn btn-info btn-md ">
          <a class="" class="dropdown-toggle" data-toggle="dropdown" href="#about" style="text-decoration: none;color: white;width:100%;"><span style="display: flex;align-items:center;"><img src="icons/icons8-admin-settings-male-20.png" style="margin-right:3px;"> <span style="font-size: 1em;"><?php echo $_SESSION['ppr_admin']; ?> </span><span class="caret"></span></span></a>
          <ul class="dropdown-menu end2">
            <li class="disabled " style="display: flex; justify-content: center;"><a href="#"><img width="100" height="100" src='<?php echo $_COOKIE['image_admin']  ?>' class="img-rounded"></a></li>
            <li class="divider"></li>
            <li><a id="account" style=""><img src="icons/icons8-account-20.png"></i> Account</a></li>
            <li class="divider"></li>
            <li><a id="password" style=""><img src="icons/icons8-password-20.png"> Changer mot de passe</a></li>
            <li class="divider"></li>
            <li><a href="Deconnexion.php" style=""><img src="icons/icons8-sign-out-20.png"> Sign-out</a></li>
          </ul>
        </div>



      </span>

      <!--<div class="btn-group btn-rounded" >
        <a class="navbar-brand" class="dropdown-toggle btn-default"  data-toggle="dropdown" href="#about" style="display: flex;direction: row;justify-content: space-around;border-right: 1px solid lightgrey;"  ><span id="admin"><?php echo $_SESSION['ppr_admin']; ?> <span class="caret"></span></span></a>
        <ul class="dropdown-menu ">
                   <li class="disabled " style="display: flex; justify-content: center;"><a  href="#"><img src='<?php echo $_COOKIE['image_admin']; ?>'  class="img-rounded"></a></li>
                    <li class="divider"></li>
                    <li><a id="account"  style="text-align: center;"><i class="fa fa-cog"></i> Account</a></li>
                    <li class="divider"></li>
                   <li><a id="password"  style="text-align: center;"><i class="fa fa-lock"></i> Changer mot de passe</a></li>
                    <li class="divider"></li>
                    <li><a href="Deconnexion.php"  style="text-align: center;"><i class="fa fa-sign-in"></i> Sign-out</a></li>
        </ul>
         </div>

-->

      <div class="modal fade" id="info_account">


      </div>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!--
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    -->
      <form class="navbar-form  navbar-right inline-form" action="" role="form" autocomplete="off">
        <div class="form-group">
          <input type="text" class="input-sm form-control" style="height:32px;" name="recherche" placeholder="Recherche">
          <button type="submit" id="recherche" class="btn btn-info btn-sm"><img src="icons/icons8-search-20 (3).png"> Chercher</button>
        </div>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>