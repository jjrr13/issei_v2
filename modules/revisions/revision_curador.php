<script>
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej13').on('click',function(){
        $('#respuesta-ej13').toggle('slow');
      });
    });
  
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej14').on('click',function(){
        $('#respuesta-ej14').toggle('slow');
      });
    });
  
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej15').on('click',function(){
        $('#respuesta-ej15').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej16').on('click',function(){
        $('#respuesta-ej16').toggle('slow');
      });
    });
  
var cantidadObservaciones10=1;
var cantidadObservaciones10=1;

function addObservacion10() {
  if (cantidadObservaciones10 >= 1  && cantidadObservaciones10 <= 9) {
    var nuevaObservacion10 = "";
    nuevaObservacion10 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion10 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion10   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion10    +="<input type='text' name='obs10[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones10+1)+"'>";
    nuevaObservacion10   +="</div>";
    nuevaObservacion10  +="</div>";
    nuevaObservacion10 +="</div>";

    $('#obs10').append(nuevaObservacion10);
    cantidadObservaciones10++;
  }
  else{
    $.confirm({
          title: '',
          content: 'HA SUPERADO EL MAXIMO DE OBSERVACIONES',
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
                    //window.location.replace(destino);
                  }
              },
          }
      }); 
  }
}

var cantidadObservaciones11=1;
var cantidadObservaciones11=1;

function addObservacion11() {
  if (cantidadObservaciones11 >= 1  && cantidadObservaciones11 <= 9) {
    var nuevaObservacion11 = "";
    nuevaObservacion11 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion11 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion11   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion11    +="<input type='text' name='obs11[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones11+1)+"'>";
    nuevaObservacion11   +="</div>";
    nuevaObservacion11  +="</div>";
    nuevaObservacion11 +="</div>";

    $('#obs11').append(nuevaObservacion11);
    cantidadObservaciones11++;
  }
  else{
    // alert('Ha superado la capacidad MAXIMA de Vecinos Permitidos');
    $.confirm({
          title: '',
          content: 'HA SUPERADO EL MAXIMO DE OBSERVACIONES',
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

var cantidadObservaciones12=1;
var cantidadObservaciones12=1;

function addObservacion12() {
  if (cantidadObservaciones12 >= 1  && cantidadObservaciones12 <= 12) {
    var nuevaObservacion12 = "";
    nuevaObservacion12 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion12 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion12   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion12    +="<input type='text' name='obs12[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones12+1)+"'>";
    nuevaObservacion12   +="</div>";
    nuevaObservacion12  +="</div>";
    nuevaObservacion12 +="</div>";

    $('#obs12').append(nuevaObservacion12);
    cantidadObservaciones12++;
  }
  else{
    // alert('Ha superado la capacidad MAXIMA de Vecinos Permitidos');
    $.confirm({
          title: '',
          content: 'HA SUPERADO EL MAXIMO DE OBSERVACIONES',
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
<style>
  .bottons{
    background-color: #4f5962;
    color: #fff;
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
</style>

<div class="col-lg-12 form-group"></div>      
<div class="container row">
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>   
  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej13" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Primera Revision Curador</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej13" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <center>
        <strong>
          <h3>Pedientes</h3>
        </strong>
      </center>
      <div class="col-lg-12 input-group">
        <div class="col-lg-1 offset-1 input-group">
          <input type="checkbox" name="document_acs" class="form-check-input" value="1">
        </div> 
        <div class="col-lg-10 input-group">
          <label for="document_acs" class="form-check-label">Acta de Calibración de Surtidores</label>
        </div>
      </div>                     
      <div class="col-lg-12 input-group">
        <div class="col-lg-1 offset-1 input-group">
          <input type="checkbox" name="document_ccb" class="form-check-input" value="1">
        </div> 
        <div class="col-lg-10 input-group">
          <label for="document_ccb" class="form-check-label">Certificado de Calibración de Balanza</label>
        </div>
      </div>   
      <div class="col-lg-12 input-group">
        <div class="col-lg-1 offset-1 input-group">
          <input type="checkbox" name="document_ccrv" class="form-check-input" value="1">
        </div> 
        <div class="col-lg-10 input-group">
          <label for="document_ccrv" class="form-check-label">Certificado de Calibración de Recipiente Volumetrico</label>
        </div>
      </div> 
      <div class="col-lg-12 input-group">
        <div class="col-lg-1 offset-1 input-group">
          <input type="checkbox" name="document_ccc" class="form-check-input" value="1">
        </div> 
        <div class="col-lg-10 input-group">
          <label for="document_ccc" class="form-check-label">Certificado de Camara y Comercio</label>
        </div>
      </div>
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs10">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs10[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion10();">
          <span class="fa fa-plus-circle "></span> 
        </button>
      </div>
      <div class="col-lg-12 input-group" >
        <button type="button" class=" btn btn-danger col-lg-2 " >
          Guardar
        </button>
      </div>
      <div class="col-lg-12 form-group"></div>
    </div>
  </div>
  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej14" type="button" class="btn bottons btn-lg col-lg-12" >
      <h5>Segunda Revision Curador</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej14" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs11">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs11[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion11();">
          <span class="fa fa-plus-circle "></span> 
        </button>
      </div>
      <div class="col-lg-12 input-group" >
        <button type="button" class=" btn btn-danger col-lg-2 " >
          Guardar
        </button>
      </div>
      <div class="col-lg-12 form-group"></div>
    </div>
  </div>
  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej15" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Tercera Revision Curador</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej15" style="display:none">
      
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs12">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs12[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion12();">
          <span class="fa fa-plus-circle "></span> 
        </button>
      </div>
      <div class="col-lg-12 input-group" >
        <button type="button" class=" btn btn-danger col-lg-2 " >
          Guardar
        </button>
      </div>
      <div class="col-lg-12 form-group"></div>
    </div>
  </div>
  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej16" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Revision Final</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej16" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <p>Deben de aparecer las observaciones pendientes, si todavia hay observaciones no cumple</p>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 input-group">
      <button class="btn btn-danger btn-lg col-lg-12">Completa Revision Curador</button>
  </div>
</div>