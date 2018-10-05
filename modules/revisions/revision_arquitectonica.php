<script>
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej1').on('click',function(){
        $('#respuesta-ej1').toggle('slow');
      });
    });
  
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej2').on('click',function(){
        $('#respuesta-ej2').toggle('slow');
      });
    });
  
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej3').on('click',function(){
        $('#respuesta-ej3').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej4').on('click',function(){
        $('#respuesta-ej4').toggle('slow');
      });
    });
  

var cantidadObservaciones=1;
var cantidadObservaciones=1;

function addObservacion() {
  if (cantidadObservaciones >= 1  && cantidadObservaciones <= 9) {
    var nuevaObservacion = "";
    nuevaObservacion +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion +="<div class='col-lg-12 input-group'>";
    nuevaObservacion   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion    +="<input type='text' name='obs1[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones+1)+"'>";
    nuevaObservacion   +="</div>";
    nuevaObservacion  +="</div>";
    nuevaObservacion +="</div>";

    $('#obs').append(nuevaObservacion);
    cantidadObservaciones++;
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

var cantidadObservaciones2=1;
var cantidadObservaciones2=1;

function addObservacion2() {
  if (cantidadObservaciones2 >= 1  && cantidadObservaciones2 <= 9) {
    var nuevaObservacion2 = "";
    nuevaObservacion2 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion2 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion2   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion2    +="<input type='text' name='obs2[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones2+1)+"'>";
    nuevaObservacion2   +="</div>";
    nuevaObservacion2  +="</div>";
    nuevaObservacion2 +="</div>";

    $('#obs2').append(nuevaObservacion2);
    cantidadObservaciones2++;
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

var cantidadObservaciones3=1;
var cantidadObservaciones3=1;

function addObservacion3() {
  if (cantidadObservaciones3 >= 1  && cantidadObservaciones3 <= 9) {
    var nuevaObservacion3 = "";
    nuevaObservacion3 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion3 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion3   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion3    +="<input type='text' name='obs3[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones3+1)+"'>";
    nuevaObservacion3   +="</div>";
    nuevaObservacion3  +="</div>";
    nuevaObservacion3 +="</div>";

    $('#obs3').append(nuevaObservacion3);
    cantidadObservaciones3++;
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
    <button id="alternar-respuesta-ej1" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Primera Revision Arquitectonica</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej1" style="display:none">
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
      <div class="col-lg-12 form-group" id="obs">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs1[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1"  onclick="addObservacion();">
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
    <button id="alternar-respuesta-ej2" type="button" class="btn bottons btn-lg col-lg-12" >
      <h5>Segunda Revision Arquitectonica</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej2" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs2">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs2[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1"  onclick="addObservacion2();">
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
    <button id="alternar-respuesta-ej3" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Tercera Revision Arquitectonica</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej3" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs3">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs3[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1"  onclick="addObservacion3();">
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
    <button id="alternar-respuesta-ej4" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Revision Final</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej4" style="display:none">
      <div class="col-lg-12 form-group">
      <div class="col-lg-12 form-group"></div>  
        <p>Deben de aparecer las observaciones pendientes, si todavia hay observaciones no cumple</p>
      </div>       
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
      <button class="btn btn-danger btn-lg col-lg-12">Completa Revision Arquitectonica</button>
  </div>
</div>