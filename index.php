<?php

  include_once('config.php');
  include_once('mensajes.php');
  include_once('modulos/functions.php');


  require_once(APP_DIR_COMPONENTES . '/xajax/xajax.inc.php');
  $xajax = new xajax("");
  $xajax->decodeUTF8InputOn();
  $xajax->setCharEncoding('utf-8');

  include_once('modulos/configuracion/interfazPeliculas.php');
  $xajax->processRequests();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo GL_APP ?>
  </title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/estilos.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_COMPONENTES ?>/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_CSS ?>/css/skin-blue.css">
  <link rel="stylesheet" href="<?php echo APP_DIR_COMPONENTES ?>/datatables.net-bs/css/dataTables.bootstrap.css">  
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <?php $xajax->printJavascript(APP_DIR_COMPONENTES . '/xajax/'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      
      <a href="<?php echo APP_INDEX ?>" class="logo">
        
        <span class="logo-mini">
            <b>
                <?php echo APP_LOGO_MINI ?>
            </b>
        </span>
        <span class="logo-lg">
          <b>
            <?php echo APP_LOGO ?>
          </b>
        </span>
      
      </a>
      
      <nav class="navbar navbar-static-top">
        
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

      </nav>
    </header>
    

    <aside class="main-sidebar">
      <section class="sidebar">

        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <a href="#">
              <i class="fa fa-circle text-success"></i> 
              Bienvenido :
              <br>
              Edson Panta Garcia
            </a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
         
          <li class="header">
            Menu
          </li>
          
          <li class="treeview">
            
            <a href="#">
              <i class="fa fa-dashboard"></i> 
              <span>
                  Mantenimiento
              </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
              <li>
                <a href="javascript: xajax__InterfazPeliculaPrincipal()">
                  <i class="fa fa-caret-right"></i>  
                  Peliculas
                </a>
              </li>
            </ul>

          </li>
        </ul>
      </section>
    </aside>

    <div class="content-wrapper">
      <section class="content">
          <div id="container-fluid">

          </div> 
      </section>
    </div>
    
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>
        Copyright &copy; 2022-2022 
        <a href="<?php echo GL_COMPANY_PORTAL ?>" target="_blank">
          <?php echo GL_COMPANY ?></a>.
      </strong> 
      ssTodos los derechos reservados.
    </footer>

  </div>


  <script src="<?php echo APP_DIR_CSS ?>/js/jquery.min.js"></script>
  <script src="<?php echo APP_DIR_CSS ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo APP_DIR_CSS ?>/js/adminlte.min.js"></script>
  <script src="<?php echo APP_DIR_COMPONENTES ?>/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo APP_DIR_COMPONENTES ?>/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

</body>
</html>
