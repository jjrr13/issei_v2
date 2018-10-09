<?php 

 

  include("menu.php"); 
  include_once ('../functions/globales.js');

  $_SESSION['fechaactual'];
  $_SESSION['id_usuario']; // id de usuario.
  $_SESSION['id_tipo_usuario']; 
  $_SESSION['id_area'];

  //If the variable does not exist, destroy the session
  if (empty($_SESSION['id_usuario'])) {
      header("location: ../cx/destroy_session.php");
    }


  ?>
<!DOCTYPE html>
<html>
<head>
	<title>ISSEI</title>
<!-- intento de implementar una sola vez el confirm -->
  <link rel='stylesheet' href='../cx/demo/demo.css'>
  <link rel='stylesheet' type='text/css' href='../cx/jquery-confirm.css'>
  <script src='../cx/demo/demo.js'></script>
  <script type='text/javascript' src='../cx/jquery-confirm.js'></script>
</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>BIENVENIDOS</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h5 class="mb-2">ISSEI es una aplicación que le permitirá crear, hacer seguimiento, expedir licencias urbanisticas, generar informes estadisticos y mucho mas.</h5>
      </div>
    </section>
 </div>
 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018 Computer Services.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside> 
</body>
</html>