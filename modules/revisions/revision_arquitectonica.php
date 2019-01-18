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
var cantidadObservaciones2=1;
var cantidadObservaciones3=1;
var cantidadObservaciones4=1;
var cantidadObservaciones5=1;
var cantidadObservaciones6=1;
var cantidadObservaciones7=1;
var cantidadObservaciones8=1;
var cantidadObservaciones9=1;
var cantidadObservaciones10=1;
var cantidadObservaciones11=1;
var cantidadObservaciones12=1;




function addObservacion(boton) {
  var option = $(boton).attr('id');
  alert(option);
  var limite;
  if (option == '_1'){
      limite = cantidadObservaciones;
      cantidadObservaciones++;
  }else if (option == '_2'){
      limite = cantidadObservaciones2;
      cantidadObservaciones2++;
  }else if (option == '_3'){
      limite = cantidadObservaciones3;
      cantidadObservaciones3++;
  }else if (option == '_4'){
      limite = cantidadObservaciones4;
      cantidadObservaciones4++;
  }else if (option == '_5'){
      limite = cantidadObservaciones5;
      cantidadObservaciones5++;
  }else if (option == '_6'){
      limite = cantidadObservaciones6;
      cantidadObservaciones6++;
  }else if (option == '_7'){
      limite = cantidadObservaciones7;
      cantidadObservaciones7++;
  }else if (option == '_8'){
      limite = cantidadObservaciones8;
      cantidadObservaciones8++;
  }else if (option == '_9'){
      limite = cantidadObservaciones9;
      cantidadObservaciones9++;
  }else if (option == '_10'){
      limite = cantidadObservaciones10;
      cantidadObservaciones10++;
  }else if (option == '_11'){
      limite = cantidadObservaciones11;
      cantidadObservaciones11++;
  }else if (option == '_12'){
      limite = cantidadObservaciones12;
      cantidadObservaciones12++;
  }
  if (limite >= 1  && limite <= 9) {
    alert('entro al if');
    var nuevaObservacion = "";
    nuevaObservacion +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion +="<div class='col-lg-12 input-group'>";
    nuevaObservacion   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion    +="<input type='text' name='obs"+option+"[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(limite+1)+"'>";
    nuevaObservacion   +="</div>";
    nuevaObservacion  +="</div>";
    nuevaObservacion +="</div>";

    $('#obs'+option).append(nuevaObservacion);
    // cantidadObservaciones++;
  }
  else{
    confirmar('HA SUPERADO EL MAXIMO DE OBSERVACIONES', 'fa fa-window-close', 'red', 'S')
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
      <div class="col-lg-12 form-group" id="obs_1">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs_1[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="_1" onclick="addObservacion(this);">
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
      <div class="col-lg-12 form-group" id="obs_2">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs_2[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="_2" onclick="addObservacion(this);">
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
      <div class="col-lg-12 form-group" id="obs_3">
        <label for="diractual" class="col-form-label col-lg-4">Observaciones</label>
        <div class="col-lg-12 input-group borde">
          <div class="col-lg-12 input-group">
            <div class="col-lg-12 input-group">
              <input type="text" name="obs_3[]" class="form-control col-lg-12" placeholder="OBSERVACION 1">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <div class="col-lg-11"></div>
        <button type="button" class=" btn btn-success agregar col-lg-1" id="_3" onclick="addObservacion(this);">
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