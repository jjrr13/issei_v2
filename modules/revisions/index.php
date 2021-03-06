<?php 

include_once('../menu.php');
include_once ('../../functions/globales.js');

 ?>

  <title>Revisión Proyecto</title>
  <meta charset="utf-8">

<style>
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  color: #fff;
  background-color: #dc3545!important;
  }

  a {
  text-decoration: none;
  background-color: transparent;
  background: #f4f6f9;
  -webkit-text-decoration-skip: objects;
  }
  a:hover.active{
    color: #f4f6f9!important;
  }
    
  input[id^="spoiler"] + label {
    margin: 10px auto 0;
    color: #000;
    text-align: center;
    font-size: 18px;
    border-radius: 3px;
    cursor: pointer;
    transition: all .4s;
   
  }
  input[id^="spoiler"]:checked + label {

    color: #333;
    background: #ccc;
  }
  input[id^="spoiler"] ~ .spoiler {
    height: 0;
    overflow: hidden;
    opacity: 0;
    margin: 5px auto 0; 
    padding: 10px; 
    background: #eee;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: all .4s;
  }
  input[id^="spoiler"]:checked + label + .spoiler{
    height: auto;
    opacity: 1;
    padding: 10px;
  }

  /*Solución a los colores pricipales del menu*/
  .sidebar-dark-primary .nav-sidebar > .nav-item:hover > .nav-link {
    color: #C2C7D0 !important;
  }
  .sidebar-dark-primary .sidebar a{
    color: #C2C7D0 !important;
  }
</style>

<script>
  $(function(){
    $('.fantasma').change(function(){
      if(!$(this).prop('checked')){
        $('#dvOcultar').hide();
      }else{
        $('#dvOcultar').show();
      }
    
    })
  })
  $(function(){
    $('.fantasma1').change(function(){
      if(!$(this).prop('checked')){
        $('#dvOcultar1').hide();
      }else{
        $('#dvOcultar1').show();
      }
    
    })
  })
  $(function(){
    $('.fantasma2').change(function(){
      if(!$(this).prop('checked')){
        $('#dvOcultar2').hide();
      }else{
        $('#dvOcultar2').show();
      }
    
    })
  })
  $(function(){
    $('.fantasma3').change(function(){
      if(!$(this).prop('checked')){
        $('#dvOcultar3').hide();
      }else{
        $('#dvOcultar3').show();
      }
    
    })
  })
</script>
<div class="content-wrapper">
  <div class="content-header">  
    <div class="container col-lg-11">
      <!-- Nav pills -->
      <ul class="nav nav-pills" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#home">REVISIÓN ARQUITECTONICA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#menu1">REVISIÓN JURIDICA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#menu2">REVISIÓN CURADOR</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#menu3">REVISIÓN ESTRUCTURAL</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#menu4">ACTA OBSERVACIONES</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Panel de Revisión Arquitectonica -->
        <div id="home" class="container tab-pane active"><br>
          <?php include_once('revision_arquitectonica.php'); ?>
        </div>
        <!-- // Panel de Revisión Arquitectonica -->
        <!-- Panel de Revisión Juridica -->
        <div id="menu1" class="container tab-pane fade"><br>
          <?php include_once('revision_juridica.php'); ?>
        </div>
        <!-- // Panel de Revisión Juridica -->
        <!-- Panel de Revisión Curador -->
        <div id="menu2" class="container tab-pane fade"><br>
          <?php include_once('revision_curador.php'); ?>
        </div>
        <!-- // Panel de Revisión Curador -->
        <!-- Panel de Revisión Estructural -->
        <div id="menu3" class="container tab-pane fade"><br>
          <?php include_once('revision_estructural.php'); ?>
        </div>
        <!-- // Panel de Revisión Estructural -->
        <!-- Panel de Acta de Observaciones -->
        <div id="menu4" class="container tab-pane fade"><br>
          <?php include_once('acta_observaciones.php'); ?>
        </div>
        <!-- // Panel de Acta de Observaciones -->
      </div>
    </div>
  </div>
</div>
<footer class="main-footer">
  <strong>Copyright &copy; 2018 Computer Services.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.2.1
  </div>
</footer>
<!-- <script src="../../functions/globales.js"></script> -->
<script src="../../plugins/popper/popper.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
<script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Este SCRIPT ejecuta todos los alerts -->
<link rel='stylesheet' href='../../cx/demo/demo.css'>
<link rel='stylesheet' type='text/css' href='../../cx/jquery-confirm.css'>
<script src='../../cx/demo/libs/bundled.js'></script>
<script src='../../cx/demo/demo.js'></script>
<script type='text/javascript' src='../../cx/jquery-confirm.js'></script>

<!-- script de la ventana emergente -->
<link rel='stylesheet' href='../../plugins/colorbox/colorbox.css'>
<script src="../../plugins/colorbox/jquery.colorbox.js"></script>

<!-- select con funcion de buscar -->
<link href="../../plugins/select2/select2.min.css" rel="stylesheet" />
<script src="../../plugins/select2/select2.min.js"></script>
