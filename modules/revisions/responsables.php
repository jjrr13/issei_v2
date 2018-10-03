
<script>

function buscarNit(boton) {
  var opcion = $(boton).val();
  // alert(opcion);
  var nit = $('#nit'+opcion).val();
   // alert(nit.length);
  if (nit.length > 5 && nit.length <= 11) {
    $.ajax({
      type: "POST",
      url: "../../controller/radication_controller.php",
      data: "nit="+ nit,
      dataType:"html",
      success: function(data) 
      {
         // alert(data);
        var JSONdata    = JSON.parse(data); //parseo la informacion
        var estado = JSONdata[0].estado;
        if (estado==1) {
          var nombre = JSONdata[0].nombre;
          var apellido = JSONdata[0].apellido;
          var celular = JSONdata[0].celular;
          var email = JSONdata[0].email;


          $('#nombre'+opcion).val(nombre+" "+apellido);
          $('#celular'+opcion).val(celular);
          $('#email'+opcion).val(email);

          $('#opcion'+opcion).removeAttr('hidden');
          $('#opcion1'+opcion).removeAttr('hidden');

           // $('#nit1'+opcion).addClass('borde');
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
          $.confirm({
              title: '',
              content: 'ALGO FALLÓ, INTENTA DE NUEVO!',
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
                      }
                  },
              }
          });
        }
      },
      error: function( jqXHR, textStatus, errorThrown ){
          console.log(textStatus);
          alert(textStatus);
      }
    });
  }
  else{
          $.confirm({
              title: '',
              content: 'LA CANTIDAD DE NUEMEROS ESTA ERRADA',
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
                      }
                  },
              }
          });
  }
}


</script>

<style>
  .borde{
    border: 1px solid #dad8d8;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .left{
    margin-left: 5px;
  }
</style>


<h3>PROFESIONALES RESPONSABLES</h3>
<button href="#inline_content"  type="button" hidden="" name="modal" value="10" id="modal" class="inline btn btn-success">Abrir Modal</button>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group "></div>
<div class="col-lg-12 form-group borde">
<h5>CONTRUCTOR</h5>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-5 input-group">
      <label for="nit1" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input autofocus="autofocus" type="text" name="nit1" id="nit1" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button  type="button" name="burcar1" value="1" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
    <div class="col-lg-5 input-group" id="opcion1" hidden="">
      <label for="nombre1" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre1" id="nombre1" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion11" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular1" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular1" id="celular1" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email1" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email1" id="email1" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>ARQUITECTO PROYECTISTA</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit2" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit2" id="nit2" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar2" value="2" onclick="buscarNit(this)" class=" btn btn-danger left">Buscar</button>
    </div>
     <div class="col-lg-5 input-group" id="opcion2" hidden="">
      <label for="nombre2" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre2" id="nombre2" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>

  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion12" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular2" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular2" id="celular2" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email2" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email2" id="email2" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>INGENIERO CIVIL</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit3" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit3" id="nit3" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar3" value="3" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
     <div class="col-lg-5 input-group" id="opcion3" hidden="">
      <label for="nombre3" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre3" id="nombre3" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion13" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular3" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular3" id="celular3" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email3" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email3" id="email3" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>DISEÑADOR DE ELEMENTOS NO ESTRUCTURALES</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit4" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit4" id="nit4" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar4" value="4" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
     <div class="col-lg-5 input-group" id="opcion4" hidden="">
      <label for="nombre4" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre4" id="nombre4" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion14" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular4" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular4" id="celular4" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email4" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email4" id="email4" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>INGENIERO CIVIL GEOTECNISTA</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit5" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit5" id="nit5" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar5" value="5" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
    <div class="col-lg-5 input-group" id="opcion5" hidden="">
      <label for="nombre5" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre5" id="nombre5" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion15" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular5" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular5" id="celular5" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email5" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email5" id="email5" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>INGENIERO TOPOGRAFO Y/O TOPÓGRAFO</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit6" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit6" id="nit6" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar6" value="6" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
     <div class="col-lg-5 input-group" id="opcion6" hidden="">
      <label for="nombre6" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre6" id="nombre6" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion16" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular6" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular6" id="celular6" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email6" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email6" id="email6" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>REVISOR INDEPENDIENTE DISEÑOS ESTRUCTURALES</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit7" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit7" id="nit7" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar7" value="7" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
     <div class="col-lg-5 input-group" id="opcion7" hidden="">
      <label for="nombre7" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre7" id="nombre7" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion17" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular7" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular7" id="celular7" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email7" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email7" id="email7" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>
<div class="col-lg-12 form-group"></div>
<div class="col-lg-12 form-group borde">
  <h5>OTROS PROFESIONALES ESPECIALISTAS</h5>
  <div class="col-lg-12 input-group">
    <div class="col-lg-5 input-group">
      <label for="nit8" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
      <input type="text" name="nit8" id="nit8" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
      <button type="button" name="burcar8" value="8" onclick="buscarNit(this)" class="btn btn-danger left">Buscar</button>
    </div>
     <div class="col-lg-5 input-group" id="opcion8" hidden="">
      <label for="nombre8" class="col-form-label col-lg-3">NOMBRE</label>
      <input type="text" name="nombre8" id="nombre8" class="form-control col-lg-9" placeholder="NOMBRE">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group" id="opcion18" hidden="">
    <div class="col-lg-5 input-group">
      <label for="celular8" class="col-form-label col-lg-3">CELULAR</label>
      <input type="text" name="celular8" id="celular8" class="form-control col-lg-9" placeholder="CELULAR">
    </div>
    <div class="col-lg-5 input-group">
      <label for="email8" class="col-form-label col-lg-3">EMAIL</label>
      <input type="email" name="email8" id="email8" class="form-control col-lg-9" placeholder="EMAIL">
    </div>
  </div>
</div>

<!-- This contains the hidden content for inline calls -->
    <div style='display:none' id="otro">
      <div id='inline_content' style='padding:10px; background:#fff;'>
       <!-- <iframe src="commentary/index.php"></iframe> -->
       <?php include_once('create.php'); ?>
      </div>
    </div>
  <!-- /.content-wrapper -->
<div class="col-lg-12 input-group" >
  <div class="col-lg-5"></div>
  <button type="button" class=" btn btn-danger agregar col-lg-2" id="addVecino" onclick="addVecino();">
    <span class="fa fa-floppy-o"></span> Guardar 
  </button>
</div>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>
