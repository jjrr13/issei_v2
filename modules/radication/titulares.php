<script type="text/javascript">

  function validaCorreo(valor){
      var permitidos = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      // alert('aprimio');
      var valid = permitidos.test(valor);
      return valid;
  }
  var cantTitular= 9;

  function addTitulares1(){
    var nit = $('#nit'+cantTitular).val();
    var nombre = $('#nombre'+cantTitular).val();
    var celular = $('#celular'+cantTitular).val();
    var email = $('#email'+cantTitular).val();
    // alert('entro a la funcion');
    if (nit.length >5 && nombre.length > 2 && celular.length > 7 && validaCorreo(email) ) {
    
      cantTitular++;
      var otroTitular = "";
      otroTitular +="<div class='col-lg-12 input-group borde'>";
      otroTitular +="<div class='col-lg-12 input-group'>";
      otroTitular   +="<div class='col-lg-5 input-group'>";
      otroTitular     +="<label for='nit"+cantTitular+"' class='col-form-label col-lg-3'>NIT</label>";
      otroTitular     +="<input type='text' name='nit[]' id='nit"+cantTitular+"' class='form-control col-lg-8' placeholder='NIT'>";
      otroTitular     +="<button type='button' name='burcar"+cantTitular+"' value='"+cantTitular+"' onclick='buscarNit(this)' class='btn btn-danger left'>Buscar</button>";
      otroTitular   +="</div>";
      otroTitular   +="<div class='col-md-6 input-group opcion"+cantTitular+"' hidden id='opcion"+cantTitular+"' >";
      otroTitular     +="<label for='tarjeta"+cantTitular+"' class='col-form-label col-md-4'>TARJETA</label>";
      otroTitular      +="<input type='text' id='tarjeta"+cantTitular+"' name='tarjeta[]' class='form-control col-md-6' placeholder='Numeros y Letras' onChange='letras(this)'>";
      otroTitular   +="</div>";
      otroTitular +="</div>";
      otroTitular +="<div class='col-lg-12 form-group'></div>"
      otroTitular +="<div class='col-lg-12 input-group opcion"+cantTitular+"' hidden>"
      otroTitular   +="<div class='col-md-5 input-group' >"
      otroTitular     +="<label for='nombre"+cantTitular+"' class='col-form-label col-md-4'>NOMBRE</label>"
      otroTitular     +="<input type='text' id='nombre"+cantTitular+"' name='nombre[]' class='form-control col-md-9' placeholder='NOMBRE'>"
      otroTitular   +="</div>"
      otroTitular   +="<div class='col-md-6 input-group '>"
      otroTitular     +="<label for='apellido"+cantTitular+"' class='col-form-label col-md-4'>APELLIDO</label>"
      otroTitular     +="<input type='text' id='apellido"+cantTitular+"' name='apellido[]' class='form-control col-md-10' placeholder='APELLIDO'>"
      otroTitular   +="</div>"
      otroTitular +=" </div>"
      otroTitular +="<div class='col-lg-12 form-group'></div>";
      otroTitular +="<div class='col-lg-12 input-group opcion"+cantTitular+"' hidden>";
      otroTitular   +="<div class='col-lg-5 input-group'>";
      otroTitular     +="<label for='celular"+cantTitular+"' class='col-form-label col-lg-4'>CELULAR</label>";
      otroTitular     +="<input type='text' id='celular"+cantTitular+"' name='celular[]' class='form-control col-lg-8' placeholder='CELULAR'>";
      otroTitular   +="</div>";
      otroTitular   +="<div class='col-lg-6 input-group'>";
      otroTitular     +="<label for='email"+cantTitular+"' class='col-form-label col-lg-4'>EMAIL</label>";
      otroTitular     +="<input type='email' id='email"+cantTitular+"' name='email[]' class='form-control col-lg-9' placeholder='EMAIL'>";
      otroTitular   +="</div>";
      otroTitular +="</div>";
      otroTitular +="<div class='col-lg-12 form-group'></div>";
      otroTitular +="<div class='col-lg-12 input-group opcion"+cantTitular+"' hidden>";
      otroTitular   +="<div class='col-lg-5 input-group'>";
      otroTitular     +="<label for='dirTitular"+cantTitular+"' class='col-form-label col-lg-4'>Dirección </label>";
      otroTitular     +="<input type='text'  placeholder='DIRECCION' id='dirTitular"+cantTitular+"' name='dirTitular[]' class='form-control col-lg-8'>";
      otroTitular   +="</div>";
      otroTitular   +="<div class='col-lg-6 input-group'>";
      otroTitular     +="<label for='barrioTitular"+cantTitular+"' class='col-form-label col-lg-4'>Barrio </label>";
      otroTitular     +="<select style='width: 66%;' class='js-example-basic-single form-control col-md-12' id='barrioTitular"+cantTitular+"' name='barrioTitular"+cantTitular+"' >";
      otroTitular       +="<option class='clasestado'>SELECCIONAR</option>";
      otroTitular       +="<option class='clasestado' value='487'>OTRO BARRIO</option>";

        <?php 
        $query = $mysqli-> query ('SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC');
        while ($valores = mysqli_fetch_array($query)) { ?>
      otroTitular       +="<option class='clasestado' value='<?=$valores['id_barrio']; ?>'><?=$valores['barrio']; ?> </option>";
                  <?php   } ?>
      otroTitular     +="</select>";
      otroTitular   +="</div>";
      otroTitular +="</div>";
      otroTitular +="<div class='col-lg-12 form-group'></div>";
      otroTitular +="<div class='col-lg-12 input-group opcion"+cantTitular+"' hidden>";
      otroTitular   +="<div class='col-lg-11'></div>";
      otroTitular     +="<button type='button' class='col-lg-2  btn btn-primary ' id='actualiza' value='"+cantTitular+"' onclick='actualizarDatos(this)'>Actualiza";
      otroTitular       +="<span class='fa fa-exchange '></span>";
      otroTitular     +="</button>";
      otroTitular +="</div>";

      otroTitular +="</div>";
      $('#titulares').append(otroTitular);
  
    }
    else{
      // alert('Corrobore los Datos');
      $.confirm({
          title: '',
          content: 'VERIFIQUE LOS CAMPOS...',
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

                  }
              },
          }
      }); 
    }
  }

  function actualizarDatos(btn){
    var valor = $(btn).val();
    var nit = $('#nit'+valor).val();
    if (nit.length > 5 && nit.length <= 11) {
      var apellido = $('#apellido'+valor).val();
      var nombre = $('#nombre'+valor).val();
      var celular = $('#celular'+valor).val();
      var email = $('#email'+valor).val();
      var dir = $('#dirTitular'+valor).val();
      var tarjeta = $('#tarjeta'+valor).val();
      // alert(dir);
      var id_barrio = $('#barrioTitular'+valor).val(); 
      $.ajax({
        type: "POST",
        url: "../../controller/radication_controller.php",
        data: "nit="+ nit+'&celular='+ celular +'&email='+email+'&direccion='+ dir + '&id_barrio='+ id_barrio+ '&nombre='+ nombre+ '&apellido='+ apellido+ '&tarjeta='+ tarjeta,
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
      confirmar('LA CANTIDAD DE NUEMEROS ESTA ERRADA', 'fa fa-window-close', 'red', 'ejecutar');
    }
  }
</script>
<form method="POST" id="frTitular" name="frTitular" >
  
  <div  class="col-lg-12 form-group" id="titulares">
    <div class="col-lg-12 form-group borde">
      <div class="col-lg-12 input-group ">
        <div class="col-lg-5 input-group">
          <label for="nit9" class="col-form-label col-lg-3">NIT</label>
          <input type="text" value="1113524482" name="nit[]" id="nit9" class="form-control col-lg-8" placeholder="NIT">
          <button type="button" name="burcar9" value="9" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
        </div>
        <div class="col-lg-5 input-group opcion9" hidden id="opcion9">
          <label for="tarjeta9" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
          <input type="text" class="form-control col-lg-8"  id="tarjeta9" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
        </div>
      </div>
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 input-group opcion9" hidden>
        <div class="col-md-5 input-group" >
          <label for="nombre9" class="col-form-label col-md-4">NOMBRE</label>
          <input type="text" id="nombre9" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
        </div>
        <div class="col-md-6 input-group ">
          <label for="apellido9" class="col-form-label col-md-4">APELLIDO</label>
          <input type="text" id="apellido9" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
        </div>
      </div>
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 input-group opcion9" hidden id="option19">
        <div class="col-lg-5 input-group">
          <label for="celular9" class="col-form-label col-lg-4">CELULAR</label>
          <input type="text" id="celular9" name="celular[]" class="form-control col-lg-8" placeholder="CELULAR">
        </div>
        <div class="col-lg-6 input-group">
          <label for="email9" class="col-form-label col-lg-4">EMAIL</label>
          <input type="email" id="email9" name="email[]" class="form-control col-lg-9" placeholder="EMAIL">
        </div>
      </div>
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 input-group opcion9" hidden>
        <div class="col-lg-5 input-group">
          <label for="dirTitular9" class="col-form-label col-lg-4">Dirección </label>
          <input type="text"  placeholder="DIRECCION" id="dirTitular9" name="dirTitular[]" class="form-control col-lg-8">
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
          <select class="form-control" id="profesion9" name="profesion[]" >
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
      <div class="col-lg-12 input-group opcion9" hidden>
        <div class="col-lg-11"></div>
        <button type="button" class="col-lg-2  btn btn-primary " id="actualiza" value="9" onclick="actualizarDatos(this)">Actualiza
          <span class="fa fa-exchange "></span>
        </button>
      </div>
    </div>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-11"></div>
    <button type="button" class="col-lg-1  btn btn-success agregar" id="addTitular" onclick="addTitulares1()">
      <span class="fa fa-plus-circle "></span>
    </button>
  </div>

  <div class="col-lg-12 input-group" >
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
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>