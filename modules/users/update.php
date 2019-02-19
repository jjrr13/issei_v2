<?php 
if(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
  include_once ("../../cx/cx.php");

  include_once('../menu.php');
// unset($_SESSION['radicar']);
 ?>

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
            var tarjeta_profesional = JSONdata[0].tarjeta_profesional;
            var id_profesion = JSONdata[0].id_profesion;
            
            // $('#nombre'+opcion).val(nombre+" "+apellido);
            $('#nombre'+opcion).val(nombre);
            $('#apellido'+opcion).val(apellido);
            $('#celular'+opcion).val(celular);
            $('#email'+opcion).val(email);
            $('#dirTitular'+opcion).val(direccion);
            $('#barrioTitular'+opcion).val(id_barrio).change();
            $('#tarjeta'+opcion).val(tarjeta_profesional);
            $("#profesion"+opcion+" option[value='"+(id_profesion)+"']").attr("selected", true);

            $('.opcion'+opcion).each(function() {
              // alert($(this).val());
              $(this).removeAttr('hidden');
            });

            // 65097   760011181182  50  2019-02-15  licencia entregada
            // 457317  16218   LICENCIA ENTREGADA A ELIZABETH PARRA EL 15/02/2019... 2019-02-15 13:43:08   50  1   ninguna   archivo central

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

                        $("#modalupdate").trigger("click");
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
  function actualizarDatos(btn){
    var valor = $(btn).val();
    var nit = $('#nit'+valor).val();
    if (nit.length > 5 && nit.length <= 11) {
      var nombre = $('#nombre'+valor).val();
      var apellido = $('#apellido'+valor).val();
      var celular = $('#celular'+valor).val();
      var email = $('#email'+valor).val();
      if (validaCorreo(email)) {
        if (nombre.length > 2 && apellido.length > 2 ) {
          if (celular.length > 7  ) {
            var dir = $('#dirTitular'+valor).val();
            var tarjeta = $('#tarjeta'+valor).val();
            var id_barrio = $('#barrioTitular'+valor).val();
            var profesion  = $('#profesion'+valor).val();
            var datos = "nit="+ nit+'&celular='+ celular +'&email='+email+'&direccion='+ dir + '&id_barrio='+ id_barrio+ '&nombre='+ nombre+ '&apellido='+ apellido+ '&tarjeta='+ tarjeta+ '&profesion='+ profesion;
            console.log(datos);
            $.ajax({
              type: "POST",
              url: "../../controller/radication_controller.php",
              data:  datos,
              dataType:"html",
              success: function(data) 
              {
                if(data==1){
                  confirmar('SE ACTUALIZO CORRECTAMENTE', 'fa fa-check-square', 'green', 'ejecutar');
                  $(btn).attr('disabled', 'disabled');
                }
                else{
                  confirmar('ERROR 300 INTENTE DE NUEVO', 'fa fa-window-close', 'red', 'ejecutar');
                  // alert(data);
                }
              },
              error: function( jqXHR, textStatus, errorThrown ){
                  console.log(textStatus);
                  alert(textStatus);
              }
            });
          }
          else{
            confirmar('UN NUMERO TELEFONICO DEBE TENER NIMIMO 7 DIGITOS', 'fa fa-window-close', 'red', 'ejecutar');
          }
        }
        else{
          confirmar('EL NOMBRE Y EL APELLIDO NO PUEDEN ESTAR VACIOS', 'fa fa-window-close', 'red', 'ejecutar');
        }
      }
      else{
        confirmar('EL CORREO ES INVALIDO', 'fa fa-window-close', 'red', 'ejecutar');
      }
    }
    else{
      confirmar('LA CANTIDAD DE NUEMEROS ESTA ERRADA', 'fa fa-window-close', 'red', 'ejecutar');
    }
  }
  function validaCorreo(valor){
      var permitidos = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      // alert('aprimio');
      var valid = permitidos.test(valor);
      return valid;
  }
</script>
<button href="#inline_content"  type="button" hidden="" name="modalupdate" value="10" id="modalupdate" class="inline btn btn-success">Abrir Modal</button>
<div class="content-wrapper">
  <div class="content-header">  
    <div class="container col-lg-10">

      <form method="POST" id="frTitular" name="frTitular" >
        
        <div  class="col-lg-12 form-group" id="titulares">
          <div class="col-lg-12 form-group borde">
            <div class="col-lg-12 input-group ">
              <div class="col-lg-5 input-group">
                <label for="nit9" class="col-form-label col-lg-3">NIT</label>
                <input type="text" value="1113524482" name="nit" id="nit9" class="form-control col-lg-8" placeholder="NIT">
                <button type="button" name="burcar9" value="9" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
              </div>
              <div class="col-lg-5 input-group opcion9" hidden id="opcion9">
                <label for="tarjeta9" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
                <input type="text" class="form-control col-lg-8"  id="tarjeta9" name="tarjeta" placeholder="Numeros y Letras" onChange="letras(this)" >
              </div>
            </div>
            <div class="col-lg-12 form-group"></div>
            <div class="col-lg-12 input-group opcion9" hidden>
              <div class="col-md-5 input-group" >
                <label for="nombre9" class="col-form-label col-md-4">NOMBRE</label>
                <input type="text" id="nombre9" name="nombre" class="form-control col-md-9" placeholder="NOMBRE">
              </div>
              <div class="col-md-6 input-group ">
                <label for="apellido9" class="col-form-label col-md-4">APELLIDO</label>
                <input type="text" id="apellido9" name="apellido" class="form-control col-md-10" placeholder="APELLIDO">
              </div>
            </div>
            <div class="col-lg-12 form-group"></div>
            <div class="col-lg-12 input-group opcion9" hidden id="option19">
              <div class="col-lg-5 input-group">
                <label for="celular9" class="col-form-label col-lg-4">CELULAR</label>
                <input type="text" id="celular9" name="celular" class="form-control col-lg-8" placeholder="CELULAR">
              </div>
              <div class="col-lg-6 input-group">
                <label for="email9" class="col-form-label col-lg-4">EMAIL</label>
                <input type="email" id="email9" name="email" class="form-control col-lg-9" placeholder="EMAIL">
              </div>
            </div>
            <div class="col-lg-12 form-group"></div>
            <div class="col-lg-12 input-group opcion9" hidden >
              <div class="col-lg-5 input-group">
                <label for="dirTitular9" class="col-form-label col-lg-4">Dirección </label>
                <input type="text"  placeholder="DIRECCION" id="dirTitular9" name="dirTitular" class="form-control col-lg-8">
              </div>
              <div class="col-lg-6 input-group">
                <label for="barrioTitular9" class="col-form-label col-lg-4">Barrio </label>
                <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular9" name="barrioTitular9" >
                  <option class="clasestado">SELECCIONAR</option>
                  <option class="clasestado" value="487">OTRO BARRIO</option>
                  <?php 

                  $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
                  while ($valores = mysqli_fetch_array($query)) {

                  echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
                    } ?>
                </select>
              </div>
              <div class="form-group col-lg-12 "></div>
              
              <div class="col-lg-5  input-group">
                <label for="profesion9" class="col-form-label col-lg-4 ">PROFESION</label>
                <select class="form-control" id="profesion9" name="profesion" >
                  <option value="1">Otros Profesionales</option>
                  <option value="2">Diseñador</option>
                  <option value="3">Ingeniero Civil</option>
                  <option value="4">Ingeniero Geotécnico</option>
                  <option value="5">Ingeniero Constructor</option>
                  <option value="6">Ingeniero Proyectista</option>
                  <option value="7">Arquitecto</option>
                  <option value="8">Revisor Independiente</option>
                  <option value="10">Topógrafo</option>
                  <option value="11">Abogado</option>
                  <option value="12">Contador</option>
                  <option value="13">Administración de Empresas</option>
                  <option value="14">Técnico en Sistemas</option>
                  <option value="15">Técnico en Administración de Empresas</option>
                  <option value="16">Bachiller</option>
                  <option value="17">Trabajador Social</option>
                  <option value="18">Técnico en Gestión Documental</option>
                  <option value="19">Administración Pública</option>
                  <option value="20">Técnico Analista Financiero y Contable</option>
                  <option value="21">Técnico Asistente Administrativo</option>
                  <option value="22">Técnico Auxiliar Contable</option>
                  <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
                  <option value="24">Tramitador</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12 form-group"></div>
            <div class="col-lg-12 input-group opcion9" >
              <div class="col-lg-11"></div>
              <button type="button" class="col-lg-2 offset-4  btn btn-primary " id="actualiza" value="9" onclick="actualizarDatos(this)">Actualiza
                <span class="fa fa-exchange "></span>
              </button>
            </div>
          </div>
        </div>

<!--         <div class="col-lg-12 input-group" >
          <div class="col-lg-6 offset-2">
            <form name="frPredio" id="skdj" method="post">

              <button type="button" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp" onclick="limpiar();"> Cancelar</button>
            </form>
          </div>
          <div class="col-lg-4">
            <input type="text" hidden="" name="btn_titular" value="Titular">
            <button type="button" name="btn_titular" id="btn_titular" value="Titular" class=" btn btn-danger agregar col-lg-6" >
              <span class="fa fa-floppy-o"></span> Guardar 
            </button>
          </div>
        </div> -->
      </form>
    </div>
  </div>
</div>

<!-- This contains the hidden content for inline calls -->

  <div style='display:none' id="otro">
    <div id='inline_content' style='padding:10px; background:#fff;'>
     <!-- <iframe src="commentary/index.php"></iframe> -->
     <?php include_once('../radication/create.php'); ?>
    </div>
  </div>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>
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