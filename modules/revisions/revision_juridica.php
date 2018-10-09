<script>
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej5').on('click',function(){
        $('#respuesta-ej5').toggle('slow');
      });
    });
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej6').on('click',function(){
        $('#respuesta-ej6').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej7').on('click',function(){
        $('#respuesta-ej7').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej8').on('click',function(){
        $('#respuesta-ej8').toggle('slow');
      });
    });
  

var cantidadObservaciones4=1;
var cantidadObservaciones4=1;

function addObservacion4() {
  if (cantidadObservaciones4 >= 1  && cantidadObservaciones4 <= 9) {
    var nuevaObservacion4 = "";
    nuevaObservacion4 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion4 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion4   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion4    +="<input type='text' name='obs4[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones4+1)+"'>";
    nuevaObservacion4   +="</div>";
    nuevaObservacion4  +="</div>";
    nuevaObservacion4 +="</div>";

    $('#obs4').append(nuevaObservacion4);
    cantidadObservaciones4++;
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

var cantidadObservaciones5=1;
var cantidadObservaciones5=1;

function addObservacion5() {
  if (cantidadObservaciones5 >= 1  && cantidadObservaciones5 <= 9) {
    var nuevaObservacion5 = "";
    nuevaObservacion5 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion5 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion5   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion5    +="<input type='text' name='obs5[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones5+1)+"'>";
    nuevaObservacion5   +="</div>";
    nuevaObservacion5  +="</div>";
    nuevaObservacion5 +="</div>";

    $('#obs5').append(nuevaObservacion5);
    cantidadObservaciones5++;
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

var cantidadObservaciones6=1;
var cantidadObservaciones6=1;

function addObservacion6() {
  if (cantidadObservaciones6 >= 1  && cantidadObservaciones6 <= 9) {
    var nuevaObservacion6 = "";
    nuevaObservacion6 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion6 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion6   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion6    +="<input type='text' name='obs6[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones6+1)+"'>";
    nuevaObservacion6   +="</div>";
    nuevaObservacion6  +="</div>";
    nuevaObservacion6 +="</div>";

    $('#obs6').append(nuevaObservacion6);
    cantidadObservaciones6++;
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
    <button id="alternar-respuesta-ej5" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Primera Revision Juridica</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej5" style="display:none">
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
      <div class="col-lg-12 form-group" id="obs4">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs4[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion4();">
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
    <button id="alternar-respuesta-ej6" type="button" class="btn bottons btn-lg col-lg-12" >
      <h5>Segunda Revision Juridica</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej6" style="display:none">
      
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs5">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs5[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion5();">
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
    <button id="alternar-respuesta-ej7" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Tercera Revision Juridica</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej7" style="display:none">
      
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs6">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs6[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion6();">
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
    <button id="alternar-respuesta-ej8" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Revision Final</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej8" style="display:none">
      <div class="col-lg-12 form-group"></div>      
      <p>Deben de aparecer las observaciones pendientes, si todavia hay observaciones no cumple</p>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 input-group">
      <button class="btn btn-danger btn-lg col-lg-12">Completa Revision Juridica</button>
  </div>
</div>