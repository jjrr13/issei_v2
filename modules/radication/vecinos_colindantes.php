<script>
  var cantidadVecinos=1;

function addVecinos() {
  if (cantidadVecinos >= 1  && cantidadVecinos <= 7) {
    var nuevoVecino = "";
    nuevoVecino +="<div class='col-lg-12 input-group borde'>";
    nuevoVecino   +="<div class='col-lg-12 input-group'>";
    nuevoVecino    +="<label for='diractual' class='col-form-label col-lg-4'>Nombre</label>";
    nuevoVecino    +="<label for='diractual' class='col-form-label col-lg-4'>Dir. Predio</label>";
    nuevoVecino    +="<label for='diractual' class='col-form-label col-lg-4'>Dir. Correspondencia</label>";
    nuevoVecino   +="</div>";
    nuevoVecino +="<div class='col-lg-12 input-group'>";
    nuevoVecino   +="<div class='col-lg-4 input-group'>";
    nuevoVecino    +="<input type='text' name='nombre[]' class='form-control col-lg-12' placeholder='NOMBRE DE VECINO No. "+(cantidadVecinos+1)+"'>";
    nuevoVecino   +="</div>";
    nuevoVecino   +="<div class='col-lg-4 input-group'>";
    nuevoVecino    +="<input type='text' name='diractual[]' class='form-control col-lg-12' placeholder='DIRECCIÓN DEL PREDIO'>";
    nuevoVecino   +="</div>";
    nuevoVecino   +="<div class='col-lg-4 input-group'>";
    nuevoVecino    +="<input type='text' name='dircorres[]' class='form-control col-lg-12' placeholder='DIRECCIÓN DE CORRESPONDECIA'>";
    nuevoVecino   +="</div>";
    nuevoVecino  +="</div>";
    nuevoVecino +="</div>";

    $('#papito').append(nuevoVecino);
    cantidadVecinos++;
  }
  else{
    // alert('Ha superado la capacidad MAXIMA de Vecinos Permitidos');
    $.confirm({
          title: '',
          content: 'HA SUPERADO LOS VECINOS PERMITIDOS',
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


</script>
<form method="POST" id="frVecino" name="frVecino">
  <div class="col-lg-12 form-group" id="papito">
    <div class="col-lg-12 input-group borde">
      <div class="col-lg-12 input-group">
        <label for="diractual" class="col-form-label col-lg-4">Nombre</label>
        <label for="diractual" class="col-form-label col-lg-4">Dir. Predio</label>
        <label for="diractual" class="col-form-label col-lg-4">Dir. Correspondencia</label>
      </div>
      <div class="col-lg-12 input-group">
        <div class="col-lg-4 input-group">
          <input type="text" name="nombre[]" class="form-control col-lg-12" placeholder="NOMBRE DE VECINO No. 1">
        </div>
        <div class="col-lg-4 input-group">
          <input type="text" name="diractual[]" class="form-control col-lg-12" placeholder="DIRECCIÓN DEL PREDIO">
        </div>
        <div class="col-lg-4 input-group">
          <input type="text" name="dircorres[]" class="form-control col-lg-12" placeholder="DIRECCIÓN DE CORRESPONDECIA">
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-11"></div>
    <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" name="addve" onclick="addVecinos();">
      <span class="fa fa-plus-circle "></span> 
    </button>
  </div>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-6 offset-2">
      <form name="frPredio" id="skdj" method="post">

        <button type="submit" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp"> Cancelar</button>
      </form>
    </div>
    <div class="col-lg-4">
      <input type="text" hidden="" name="btn_vecino" value="Vecino">
      <button type="button" name="btn_vecino" value="Vecino" class=" btn btn-danger agregar col-lg-6" >
        <span class="fa fa-floppy-o"></span> Guardar 
      </button>
    </div>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>
