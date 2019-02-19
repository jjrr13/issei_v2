<?php 
$dir="../..";
$ruta="../";
if(file_exists("../cx/cx.php")){
  $dir="../";
  $ruta="";
}elseif(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
  include_once $dir."cx/cx.php";

  $_SESSION['fechaactual'];
  $_SESSION['id_usuario']; // id de usuario.
  //Definimos
  $_SESSION['id_tipo_usuario']; 
  $_SESSION['id_area'];

  //If the variable does not exist, destroy the session
  if (empty($_SESSION['id_usuario'])) {
      header("location: ".$dir."cx/destroy_session.php");
    }


  $user_sesion = $_SESSION['id_usuario'];

  if(isset($user_sesion)){


    $query_busqueda = sprintf("SELECT CONCAT(t.nombre,' ',t.apellido) as nombre_usuario, u.usuario
            FROM terceros t, usuarios u
            WHERE t.nit = u.nit AND u.id_usuario = '%s'", $user_sesion);
    $jg_busqueda =$mysqli->query($query_busqueda);
    $result_busqueda_usuario = mysqli_fetch_assoc($jg_busqueda);
    $totalrows_result_busqueda_usuario = mysqli_num_rows($jg_busqueda);
  
  }
//VARIABLES GLOBALES DEL INICIO DE SESSION, PARA OBTENER PERMISOS
$tipo_usuario = $_SESSION['id_tipo_usuario'];
$tipo_area = $_SESSION['id_area'];

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!-- <meta charset="ISO-8859-1"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ISSEI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $dir; ?>css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $dir; ?>dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/morris/morris.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="<?php echo $dir; ?>css/css.css" rel="stylesheet">


  
</head>
<body  class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $ruta; ?>" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav" style="margin-left:35%;">
 
  <!-- <img src="" width="15%" height="15%"> -->
  <img src="<?php echo $dir; ?>curaduria.jpg" width="70%" height="40%">
  
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $ruta; ?>" class="brand-link">
      <center><h2 class="brand-text font-weight-light text-danger">ISSEI</h2></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         
          <img src="<?php echo $dir; ?>logo16x16x.png" class="img-circle elevation-2" alt="User Image">
          
        </div>
        <div class="info">
          <h5 class="brand-text font-weight-light text-danger"><?php printf($result_busqueda_usuario['usuario']); ?></h5>
         
          <a id="cerrar" class="btn" href="#">Cerrar sesion</a>
          
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
          $acceso_actividades1 = array(1);//cada id del tipo de usuario futuro aqui
          $acceso_actividades2 = array(10);//cada id a futuro aqui

          if(in_array($tipo_usuario, $acceso_actividades1) && in_array($tipo_area, $acceso_actividades2)){?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-plus-square-o"></i>
              <p>
                Actividades Economicas
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-circle-o text-danger"></i>
                  <p>Consulta Expediente AE</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } 
          $acceso_citas1 = array(1, 3);//cada id del tipo de usuario futuro aqui
          $acceso_citas2 = array(10, 8);//cada id del area del usuario futuro aqui

          if(in_array($tipo_usuario, $acceso_citas1) && in_array($tipo_area, $acceso_citas2)){ ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>quotes/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Agendar Cita
              </p>
            </a>
          </li>
          <?php }

          $acceso_panel_citas1 = array(1, 3);//cada id del tipo de usuario futuro aqui
          $acceso_panel_citas2 = array(10, 8);//cada id del area del usuario futuro aqui

          if(in_array($tipo_usuario, $acceso_panel_citas1) && in_array($tipo_area, $acceso_panel_citas2)){
          ?>

          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>agendas/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Citas Agendadas
              </p>
            </a>
          </li>
          <?php }
          $acceso_agenda1 = array(1, 3);//cada id del tipo de usuario futuro aqui
          $acceso_agenda2 = array(10, 5, 2, 7, 3, 9, 6);//cada id del area del usuario futuro aqui

          if(in_array($tipo_usuario, $acceso_agenda1) && in_array($tipo_area, $acceso_agenda2)){
          ?>

          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>scheduled/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Agenda
              </p>
            </a>
          </li>           
          <?php  }
          $acceso_sistemas1 = array(1);//cada id del tipo de usuario futuro aqui
          $acceso_sistemas2 = array(10);//cada id del area del usuario futuro aqui

          if(in_array($tipo_usuario, $acceso_sistemas1) && in_array($tipo_area, $acceso_sistemas2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>users/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Crear Usuario
              </p>
            </a>
          </li>
          
          <?php }
          $acceso_crear_cliente1 = array(1, 3);//cada id del tipo de usuario futuro aqui
          $acceso_crear_cliente2 = array(10, 8);//cada id del area del usuario futuro aqui

          if(in_array($tipo_usuario, $acceso_crear_cliente1) && in_array($tipo_area, $acceso_crear_cliente2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>client/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Crear Cliente
              </p>
            </a>
          </li>

         <?php }

         if(in_array($tipo_usuario, $acceso_sistemas1) && in_array($tipo_area, $acceso_sistemas2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>radication/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Radicacion
              </p>
            </a>

          </li>  

          <?php } 

          if(in_array($tipo_usuario, $acceso_sistemas1) && in_array($tipo_area, $acceso_sistemas2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>settlement/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Pre-Liquidacion
              </p>
            </a>

          </li>   
          <?php } 

          if(in_array($tipo_usuario, $acceso_sistemas1) && in_array($tipo_area, $acceso_sistemas2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>tracing/" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Hola de Ruta
              </p>
            </a>

          </li>   
          <?php }
          $acceso_update1 = array(1, 3);//cada id del tipo de usuario futuro aqui
           $acceso_update2 = array(10, 3, 9);//cada id del area del usuario futuro aqui
          if(in_array($tipo_usuario, $acceso_update1) && in_array($tipo_area, $acceso_update2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>users/update.php" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Verificar Clientes
              </p>
            </a>
          </li>   
          <?php }
          $acceso_update1 = array(1, 3);//cada id del tipo de usuario futuro aqui
           $acceso_update2 = array(10, 3, 9);//cada id del area del usuario futuro aqui
          if(in_array($tipo_usuario, $acceso_update1) && in_array($tipo_area, $acceso_update2)){
          ?>
          <li class="nav-item">
            <a href="<?php echo "$ruta"; ?>users/update.php" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>
                Verificar Clientes
              </p>
            </a>
          </li>   
          <?php } ?>       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="<?php echo $dir; ?>plugins/jquery/jquery.min.js"></script>
<!-- funciones de tiempo y de cierre de session -->
  <?php include_once ($dir.'functions/globales.js'); ?>
<!-- jQuery UI 1.11.4 -->

<!-- <script src="<?php echo $dir; ?>plugins/jquery/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="<?php echo $dir; ?>dist/js/adminlte.js"></script>

  
</body>
</html>