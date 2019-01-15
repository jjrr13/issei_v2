<script>
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej9').on('click',function(){
        $('#respuesta-ej9').toggle('slow');
      });
    });
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej10').on('click',function(){
        $('#respuesta-ej10').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej11').on('click',function(){
        $('#respuesta-ej11').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej12').on('click',function(){
        $('#respuesta-ej12').toggle('slow');
      });
    });
  
// var cantidadObservaciones7=1;
var cantidadObservaciones7=1;

function addObservacion7() {
  if (cantidadObservaciones7 >= 1  && cantidadObservaciones7 <= 9) {
    var nuevaObservacion7 = "";
    nuevaObservacion7 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion7 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion7   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion7    +="<input type='text' name='obs7[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones7+1)+"'>";
    nuevaObservacion7   +="</div>";
    nuevaObservacion7  +="</div>";
    nuevaObservacion7 +="</div>";

    $('#obs7').append(nuevaObservacion7);
    cantidadObservaciones7++;
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

var cantidadObservaciones8=1;
var cantidadObservaciones8=1;

function addObservacion8() {
  if (cantidadObservaciones8 >= 1  && cantidadObservaciones8 <= 9) {
    var nuevaObservacion8 = "";
    nuevaObservacion8 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion8 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion8   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion8    +="<input type='text' name='obs8[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones8+1)+"'>";
    nuevaObservacion8   +="</div>";
    nuevaObservacion8  +="</div>";
    nuevaObservacion8 +="</div>";

    $('#obs8').append(nuevaObservacion8);
    cantidadObservaciones8++;
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

var cantidadObservaciones9=1;
var cantidadObservaciones9=1;

function addObservacion9() {
  if (cantidadObservaciones9 >= 1  && cantidadObservaciones9 <= 9) {
    var nuevaObservacion9 = "";
    nuevaObservacion9 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion9 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion9   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion9    +="<input type='text' name='obs9[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones9+1)+"'>";
    nuevaObservacion9   +="</div>";
    nuevaObservacion9  +="</div>";
    nuevaObservacion9 +="</div>";

    $('#obs9').append(nuevaObservacion9);
    cantidadObservaciones9++;
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
    <button id="alternar-respuesta-ej9" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Primera Revision Estructural</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej9" style="display:none">
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
      <div class="col-lg-12 form-group" id="obs7">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs7[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion7();">
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
    <button id="alternar-respuesta-ej10" type="button" class="btn bottons btn-lg col-lg-12" >
      <h5>Segunda Revision Estructural</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group"  id="respuesta-ej10" style="display:none">
      
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs8">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs8[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion8();">
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
    <button id="alternar-respuesta-ej11" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Tercera Revision Estructural</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group"  id="respuesta-ej11" style="display:none">
      
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 form-group" id="obs9">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs9[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="addVecino" onclick="addObservacion9();">
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
    <button id="alternar-respuesta-ej12" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Revision Final</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group"  id="respuesta-ej12" style="display:none">
    <div class="col-lg-12 form-group"></div>      
      <p>Deben de aparecer las observaciones pendientes, si todavia hay observaciones no cumple</p>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 input-group">
      <button class="btn btn-danger btn-lg col-lg-12">Completa Revision Estructural</button>
  </div>
</div>