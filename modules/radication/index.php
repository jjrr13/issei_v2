<?php 
if(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
  include_once ("../../cx/cx.php");

include_once('../menu.php');
// unset($_SESSION['radicar']);
 ?>

  <title>Radicación</title>
  <meta charset="utf-8">

<style>
  .izq{
    padding-left: 15px;
  }
  .left{
    margin-left: 5px;
  }
   .agregar{
    text-align: left;
    margin-top: 2%;
    margin-bottom: 5%;
    /*border: 1px solid #000;*/
  }
  .borde{
    margin-bottom: 2%;
    border: 1px solid #dad8d8;
    padding-top: 10px;
    padding-bottom: 15px;
  }
  
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  color: #fff;
  background-color: #dc3545!important;
  }

  a {
  color: black!important;
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

</style>

<script type="text/javascript">
  $(document).ready(() => {

    //pone a la escucha a todos los botnes
    $(".btn-danger").each(function(){
        $(this).on("click", (e) =>  {
          var dato = $(this).val();
          if (dato <= 8) {
            buscarNit(this);
          }
          else{
            enviar(dato);      
          }
        });
    });

  console.log(<?php echo (isset($_SESSION['radicar']))? $_SESSION['radicar'] :'130'; ?>);
  verificar(<?php echo (isset($_SESSION['radicar']))? $_SESSION['radicar'] :'130'; ?>);

  //activas los select2
  inciarSelectes2();
  
});
 
function inciarSelectes2() {
  $('.js-example-basic-single').each(function (i, obj) { 
    if (!$(obj).data("select2")) { 
      // console.log($(obj).attr('id'));
      if ($(obj).attr('id')== 'barrio') {
        // alert('entro al parent');
        $(obj).select2({ dropdownParent: $('.js-example-basic-single').parent()}); 
      }
      else{
        // alert('entro al otro');
        $(obj).select2(); 
      }
    }
  });
}

const enviar = (form) => {

    // alert(form);
  const datos = $("#fr"+form).serialize();
// alert(datos);
  $.ajax({   
    cache: false,                     
    type: "POST",                 
    url: "../../controller/radication_controller.php",                    
    data: datos,
    error: function(request, status, error)
    {
      console.log(error);
      alert("ocurrio un error "+request.responseText);
    },
    success: function(data)            
    {
      if (form=='Tipo') {
        window.location.reload();
      }else{
        verificar(data);
      }
      // confirmar('Haciendo pruebas', 'fa fa-check-square', 'blue', 'window');
    }
  });

};


function verificar(valor){
  var pes=130;
      valor = parseInt(valor);
          // alert('Esta es la respuesta del controlador '+valor);
      //CAPTURA DE POSBLES ERRORES

  if (valor == 31) {
       confirmar('EL FORMULARIO DE LICENCIAS INCOMPLETO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 32) {
       confirmar('EL FORMULARIO PREDIO INCOMPLETO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 33) {
       confirmar('EL FORMULARIO VECINOS INCOMPLETO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 34) {
       confirmar('EL FORMULARIO TITULARES INCOMPLETO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 35) {
       confirmar('EL FORMULARIO PROFESIONALES INCOMPLyETO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 36) {
       confirmar('EL FORMULARIO DOCUMENTOS INCOMPLETO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 37) {
       confirmar('ALGO SALIO MAL! <br> INTENTA DE NUEVO', 'fa fa-window-close', 'red', 'S');
  }else if (valor == 112) {
       confirmar('ALGO SALIIO MAL PERO FUE CREADO! <br> INTENTA DE NUEVO', 'fa fa-window-close', 'yellow', 'S');
  }else if (valor == 111) {
       confirmar('CREADO EXITOSAMENTE', 'fa fa-window-close', 'green', '../radication');

  }
  //FINALIZA ERRORES Y COMIENZA EVALUCION DE SEGMENTO
  if (valor >= 130 || valor == 111){
    for (var j = 0; j < 6; j++) {
    // alert(pes+''+ j);
      if (valor==pes) {
        // alert('entro al if');
        $('#'+pes).addClass('nav-link active show');
        $('#'+pes).attr('data-toggle', 'pill');
        $('#'+pes+''+ j).addClass('in active show');
      }
      else if (valor>pes) {
        // alert('entro al else if');
        $('#'+pes).removeAttr('data-toggle', 'pill');
        $('#'+pes).removeClass('active show');
        $('#'+pes).addClass('nav-link');
        $('#'+pes+''+ j).removeClass('in active show');
        $('#'+pes+''+ j).addClass('fade');
      }
      else{
        // alert('entro al else ');
        $('#'+pes).addClass('nav-link');
        $('#'+pes).removeClass('active show');
        $('#'+pes).attr('data-toggle', 'pill');
        $('#'+pes).removeClass('in active show');
        $('#'+pes+''+ j).addClass('fade');
      }
      pes++;
    }
  }
  else{
    // alert(valor);
  }
}

</script>


<script>
  //mostrar y ocultar submenus
    $(function(){
      $('.fantasma').change(function(){
        var valor = $(this).val();
        // alert(valor);
        if(!$(this).prop('checked')){
          $('#dvOcultar'+valor).hide();
        }else{
          $('#dvOcultar'+valor).show();
        }
      
      });
    });
    // $(function(){
    //   $('.fantasma1').change(function(){
    //     if(!$(this).prop('checked')){
    //       $('#dvOcultar1').hide();
    //     }else{
    //       $('#dvOcultar1').show();
    //     }
      
    //   });
    // });
    // $(function(){
    //   $('.fantasma2').change(function(){
    //     if(!$(this).prop('checked')){
    //       $('#dvOcultar2').hide();
    //     }else{
    //       $('#dvOcultar2').show();
    //     }
      
    //   });
    // });
    // $(function(){
    //   $('.fantasma3').change(function(){
    //     if(!$(this).prop('checked')){
    //       $('#dvOcultar3').hide();
    //     }else{
    //       $('#dvOcultar3').show();
    //     }
      
    //   });
    // });
  </script>

<script>

function buscarNit(boton) {
  var opcion = $(boton).val();
   // alert(opcion);
  var nit = $('#nit'+opcion).val();
   // alert(nit);
  if (nit.length > 5 && nit.length <= 11) {
    $.ajax({
      type: "POST",
      url: "../../controller/radication_controller.php",
      data: "nit="+ nit,
      dataType:"html",
      success: function(data) 
      {
           //alert(data);
        var JSONdata    = JSON.parse(data); //parseo la informacion
        var estado = JSONdata[0].estado;
        if (estado==1) {
          var nombre = JSONdata[0].nombre;
          var apellido = JSONdata[0].apellido;
          var celular = JSONdata[0].celular;
          var email = JSONdata[0].email;
          var direccion = JSONdata[0].direccion;
          var id_barrio = JSONdata[0].id_barrio;

          $('#nombre'+opcion).val(nombre+" "+apellido);
          $('#celular'+opcion).val(celular);
          $('#email'+opcion).val(email);
          $('#dirTitular'+opcion).val(direccion);
          $('#barrioTitular'+opcion).val(id_barrio).change();

          $('.opcion'+opcion).each(function() {
            // alert($(this).val());
            $(this).removeAttr('hidden');
          });

          // inciarSelectes2();

        }
        else if (estado == 2) {

          $.confirm({
              title: '',
              content: 'EL CLIENTE NO EXISTE!',
              icon: 'fa fa-window-close ',
              animation: 'scale',
              closeAnimation: 'scale',
              theme: 'supervan',
              type: 'red',
              opacity: 0.5,
              buttons: {
                  'ok': {
                      text: 'OK',
                      btnClass: 'btn-blue',
                      action: function () {
                        //console.log('tambien por aqui2');
                        //window.location.replace(destino);

                        $("#modal").trigger("click");
                      }
                  },
              }
          }); 
        }
        else{
          confirmar('ALGO FALLÓ, INTENTA DE NUEVO!', 'fa fa-window-close', 'red', 'ejecutar');

        }
      },
      error: function( jqXHR, textStatus, errorThrown ){
          console.log(textStatus);
          alert(textStatus);
      }
    });
  }
  else{
    confirmar('LA CANTIDAD DE NUEMEROS ESTA ERRADA', 'fa fa-window-close', 'red', 'ejecutar');

  }
}
</script>
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<div class="content-wrapper">
  <div class="content-header">  
    <div class="container col-lg-10">
      <!-- Nav pills -->
      <ul class="nav nav-pills" role="tablist">
        <li class="nav-item">
          <a   id="130" href="#1300">TIPO LICENCIA</a>
        </li>
        <li class="nav-item">
          <a  id="131" href="#1311">PREDIO</a>
        </li>
        <li class="nav-item">
          <a  id="132" href="#1322">VECINOS</a>
        </li>
        <li class="nav-item">
          <a  id="133" href="#1333">TITULARES</a>
        </li>
        <li class="nav-item">
          <a  id="134" href="#1344">PROFESIONALES</a>
        </li>
        <li class="nav-item">
          <a  id="135" href="#1355">DOCUMENTOS</a>
        </li>
      </ul>

<hr>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Panel de Tipo de Licencia -->
        <div id="1300" class="container tab-pane "><br>
          <?php include_once('type_licence.php'); ?>
        </div>
        <!-- // Panel de Tipo de Licencia -->
        <!-- Panel de Informacion del Predio -->
        <div id="1311" class="container tab-pane "><br>
          <?php include_once('info_predio.php'); ?>
        </div>
        <!-- // Panel de Informacion del Predio -->
        <!-- Panel de Vecinos -->
        <div id="1322" class="container tab-pane "><br>
          <?php include_once('vecinos_colindantes.php'); ?>
        </div>
        <!-- // Panel de Vecinos -->
        <!-- Panel de Titulares -->
        <div id="1333" class="container tab-pane "><br>
          <?php include_once('titulares.php'); ?>
        </div>
        <!-- // Panel de Titulares -->
        <!-- Panel de Responsables -->
        <div id="1344" class="container tab-pane "><br>
          <?php include_once('responsables.php'); ?>
        </div>
        <!-- // Panel de Responsables -->
        <!-- Panel de Documentos Entregados -->
        <div id="1355" class="container tab-pane "><br>
          <?php include_once('documentos_entregados.php'); ?>
        </div>
        <!-- // Panel de Documentos Entregados -->
      </div>
    </div>
  </div>
</div>

<footer class="main-footer">
  <strong>Copyright &copy; 2018 Computer Services.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.2.2
  </div>
</footer>
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
