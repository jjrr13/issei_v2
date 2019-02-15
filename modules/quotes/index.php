<?php 
//$ruta="cx";
include ('../menu.php');
include_once ('../../functions/globales.js');
include_once('../../functions/ruta.php');
include_once ("../../cx/cx.php");

  $_SESSION['fechaactual'];
	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_tipo_usuario']; 
	$_SESSION['id_area'];

?>

<!DOCTYPE html>
<html>
<head>

  <title>ISSEI</title>
  <!-- librerias del socket -->
  <!-- pasar valor de la ruta statica a js -->
   <script type="text/javascript">
    var urlPort = '<?=SOCKET_FRONTEND;?>';
  </script>
  <script src='../../functions/jquery-1.7.2.min.js'></script>
  <script src="../../functions/fancywebsocket.js"></script>

  <style>

    table {
      border: 1px solid #000;
      border-collapse: collapse;
      text-align: center; height: 5px;
    }
    /*Soluciona Problema de barra inferior del div principal*/
    .card-footer {
      padding: .75rem .1rem !important;
    }
  </style> 

  <!-- <link rel='stylesheet' href='../../cx/demo/libs/bundled.css'> -->
  <link rel='stylesheet' href='../../cx/demo/demo.css'>
  <link rel='stylesheet' type='text/css' href='../../cx/jquery-confirm.css'>
  
  <!-- Este SCRIPT ejecuta todos los alerts -->
  <script src='../../cx/demo/libs/bundled.js'></script>
  <script src='../../cx/demo/demo.js'></script>
  <script type='text/javascript' src='../../cx/jquery-confirm.js'></script>

  <!-- funcion de mostrar un elemento emergente dependiendo del valor seleccionado -->
  <script type="text/javascript">
    $(document).ready(function() {
     //$('#LISTA').on('change', CambiarFormulario());
    });

    function CambiarFormulario(){
      var opcion = $('#LISTA').val();
      switch(opcion){
        case '0': 
          $('#Texto1').attr('style', 'display: none');
          $('#Texto2').attr('style', 'display: none');
          $('#LISTA').attr('style','color: red');
          break;
        case '2':
        case '5':
          $('#Texto1').attr('style', 'display: none');
          $('#Texto2').attr('style', 'display: none');
          $('#LISTA').attr('style','color: black');
          break;
        case '1':
        case '3':
        case '6':  
          $('#Texto1').attr('style', 'display: block');
          $('#Texto2').attr('style', 'display: none');
          $('#LISTA').attr('style','color: black');
          break;
        case '4': 
          $('#Texto1').attr('style', 'display: none');
          $('#Texto2').attr('style', 'display: block');
          $('#LISTA').attr('style','color: black');
          break;
        default:
          $('#LISTA').attr('style','color: red');
      }

    }

    function CambiarColor(){
      var opcion = $('#atendio').val();
      if (opcion != '0') {
          $('#atendio').attr('style','color: black');
      }
    }
  </script>
<script language="javascript">

    function abrirEnPestana(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
  }
  var destino = '../quotes';


   function buscarNit(){
     
           // alert(nit);
      $.ajax({
        type: "POST",
        url: "../../controller/quotes_controller.php",
        data: "buscanit="+ nit,
        dataType:"html",
        success: function(data) 
        {
           // alert(data);
          if (data==2) {
            window.location.replace(destino);
          }else if (data==3) {
            destino = '../client';
            alertas('EL CLIENTE NO EXISTE!', 'fa fa-window-close ', 'red', destino );
          }

        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log(textStatus);
            alert(textStatus);
        },

        
      });
   }
 
  // var url="../index.php";
 
    function controlar(boton)
    { 
      var datos;

      if (boton == 'nit') {
         var nit = $('#buscanit').val();
         datos = "buscanit="+ nit;
      }else if (boton == 'cita') {
        var fecha_cita = document.getElementById('fecha_cita').value;
        var atendio    = document.getElementById('atendio').value;
        var nombre     = document.getElementById('nombre').value;
        var apellido   = document.getElementById('apellido').value;
        var LISTA      = document.getElementById('LISTA').value;
        var nroradicado= document.getElementById('nroradicado').value;
        var nrosolicitud = document.getElementById('nrosolicitud').value;
        var respuesta ="";
        datos = "fecha_cita="+fecha_cita+"&atendio="+atendio+"&nombre="+nombre+"&apellido="+apellido+"&LISTA="+LISTA+"&nroradicado="+nroradicado+"&nrosolicitud="+nrosolicitud;
      }else if (boton == 'limpiar') {
         datos = "limpiar=limpiar";
      }
           // alert(datos);
      $.ajax({
        // async: false,
        type: "POST",
        url: "../../controller/quotes_controller.php",
        data: datos,
        dataType:"html",
        success: function(data) 
        {
           // alert(data);
           
          if (data==0) { 
            alertas('RECUERDE  QUE LOS DATOS CON (*) SON OBLIGATORIOS!', 'fa fa-window-close', 'red', destino );
          }else if (data==1) {
            alertas('ERROR NO SE HA GENERADO LA CITA  VERIFIQUE', 'fa fa-user-circle-o', 'red', destino );
          }else if (data==2 || data==4) {
            window.location.reload();
          }else if (data==3) {
            destino = '../client';
            alertas('EL CLIENTE NO EXISTE!', 'fa fa-window-close ', 'red', destino );
          }else {
            send(data);
            alertas('CITA AGENDADA EXISTOSAMENTE CONTINUEMOS', 'fa fa-check-square', 'green', destino );
          }
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log(textStatus);
            alertas('ALGO SALIO MAL, INTENTA DE NUEVO', 'fa fa-user-circle-o', 'RED', destino );
        },
        
      });
     
    }

    function alertas(msj, icono, color){
       $.confirm({
          title: '',
          content: msj,//'CITA AGENDADA EXISTOSAMENTE CONTINUEMOS',
          icon: icono, //'fa fa-window-close ',
          animation: 'scale',
          closeAnimation: 'scale',
          theme: 'supervan',
          type: color,//'green',
          opacity: 0.5,
          buttons: {
              'ok': {
                  text: 'OK',
                  btnClass: 'btn-blue',
                  action: function () {
                    //console.log('tambien por aqui2');
                    window.location.replace(destino);

                  }
              },
          }
      }); 
    }
</script>
</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container col-lg-10">
          <div class="card card-danger">
            <div class="card-header">
              <center>
                <h3 class="card-title">AGENDAR CITA</h3>
              </center>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form method="post" content="../quotes"> -->
            <div  class="card-body">
              <div class="row form-group">
                <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-10  input-group">
                    <label for="buscanit" class="col-form-label col-lg-2 ">Documento</label>
                    <input type="text"  class="form-control col-lg-3" id="buscanit" name="buscanit" placeholder="Numero Documento" onkeypress="return ValidNum(event)" autofocus min="0" maxlength="10"  <?php if(!empty($_SESSION['nit'])) echo "value='".$_SESSION['nit']."' "; ?>>
                    <button onclick="controlar('nit')" name="buscar" type="submit" class="btn btn-danger btn-sm" id="buscar" >Buscar&nbsp;</button>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-5  input-group">
                  	<label for="fecha_cita" class="col-form-label col-lg-4 ">Fecha Cita</label>
                    <input type="date" value="<?php echo date("Y-m-d");?>" class="form-control col-lg-8" id="fecha_cita" name="fecha_cita">
                  </div>
                  <div class="col-lg-6  input-group">
                    <label for="atendio" class="col-form-label col-lg-3 ">Funcionario</label>
                    <select class="form-control col-lg-9" style="color: red;" name="atendio" id="atendio" onchange="CambiarColor()" >
                      <option value="0">SELECCIONAR</option>

                       <?php 
                      $query = $mysqli -> query ("SELECT u.id_usuario, CONCAT(t.nombre, ' ', t.apellido) AS funcionario FROM usuarios u, terceros t, cargo c, area a WHERE u.estado = 1 AND u.nit = t.nit AND u.id_cargo = c.id_cargo AND u.id_area = a.id_area AND u.id_cargo in (1, 3, 4, 7) AND u.id_area in (2, 5, 6, 7, 9, 3) ORDER BY funcionario ASC");
                            while ($valores = mysqli_fetch_array($query)) {

                            echo '<option style="color: black;" value="'.$valores[id_usuario].'">'.$valores[funcionario].'</option>';
                      } ?>
                    </select>
                  </div>
                <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-5  input-group">
                    <label for="nombre" class="col-form-label col-lg-4">Nombre</label>
                    <input  type="text" class="form-control col-lg-8" <?php if(!empty($_SESSION['nombre'])) echo "value='".$_SESSION['nombre']."' readonly "; ?> name="nombre" id="nombre">
                  </div>
                  <div class="col-lg-6  input-group">
                    <label for="apellido" class="col-form-label col-lg-3">Apellido</label>
                    <input type="text" class="form-control col-lg-9" <?php if(!empty($_SESSION['apellido'])) echo "value='".$_SESSION['apellido']."' readonly "; ?> name="apellido" id="apellido">
                  </div>
                <div class="form-group col-lg-12 "></div>
                <div class="col-lg-5  input-group">
                  <label for="LISTA" class="col-form-label col-lg-4 ">Motivo</label>
                  <select class="form-control col-lg-8" style="color: red;"  id="LISTA" name="LISTA" onchange="CambiarFormulario()" >
                    <option value="0">MOTIVO CONSULTA</option>
                    <?php 
                    $query = $mysqli -> query ("SELECT * FROM consultas ORDER BY consulta ASC");
                          while ($valores = mysqli_fetch_array($query)) {
                         
                          echo '<option style="color: black;" value="'.$valores['id_consulta'].'">'.$valores['consulta'].'</option>';
                    } ?>  
                  </select>
                </div>
                <div id="Texto1" class="col-lg-6  input-group"  style="display:none;">
                  <div class="input-group">
                      <label for="nroradicado" class="col-form-label col-lg-3">Radicado</label>
                      <input name="nroradicado" id="nroradicado" type="text" class="form-control col-lg-9" placeholder="Numero Radicado" onkeyup="this.value=Numeros(this.value)" maxlength="6" >
                  </div>
                </div>
                <div id="Texto2" class="col-lg-6  input-group" style="display:none;">
                  <div  class="input-group" >
                      <label for="nrosolicitud" class="col-form-label col-lg-3 ">Solicitud</label>
                      <input type="text" class="form-control col-lg-9" placeholder="Numero Solicitud" id="nrosolicitud" name="nrosolicitud" onkeyup="this.value=Numeros(this.value)" maxlength="6">
                  </div>
                </div>
                <div class="form-group col-lg-12 "></div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer input-group">
              <div class="form-group col-lg-12 "></div>
              <div class="col-lg-12  input-group">
                <div class="col-lg-3"></div>  
                <button class="btn btn-danger col-lg-2" type="submit" value="enviar" onclick="controlar('cita');" >Asignar</button>
                <div class="col-lg-1"></div>              
                <button class="btn btn-default col-lg-2" type="submit" id="cancelar" name="cancelar" value="8" onclick="controlar('limpiar');" >Limpiar</button>
              </div>
              <div class="form-group col-lg-12 "></div>
            </div>
                <!-- /.card-footer -->
              <!-- </form> -->
          </div>
      </div>
      <!-- Panel de control -->
      <?php include_once ('paneles_radication.php'); ?>
      <!-- /Panel de control -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018 Computer Services.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.2.3
    </div>
  </footer>
  <!-- /.control-sidebar -->
</body>
</html>




 