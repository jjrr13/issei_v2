<script>
 
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej17').on('click',function(){
        $('#respuesta-ej17').toggle('slow');
      });
    });
  
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej18').on('click',function(){
        $('#respuesta-ej18').toggle('slow');
      });
    });
  
    $(document).ready(function(){ 
      $('#alternar-respuesta-ej19').on('click',function(){
        $('#respuesta-ej19').toggle('slow');
      });
    });

    $(document).ready(function(){ 
      $('#alternar-respuesta-ej20').on('click',function(){
        $('#respuesta-ej20').toggle('slow');
      });
    });
  

var cantidadObservaciones17=1;
var cantidadObservaciones17=1;

function addObservacion17() {
  if (cantidadObservaciones17 >= 1  && cantidadObservaciones17 <= 9) {
    var nuevaObservacion17 = "";
    nuevaObservacion17 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion17 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion17   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion17    +="<input type='text' name='obs17[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones17+1)+"'>";
    nuevaObservacion17   +="</div>";
    nuevaObservacion17  +="</div>";
    nuevaObservacion17 +="</div>";

    $('#obs17').append(nuevaObservacion17);
    cantidadObservaciones17++;
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

var cantidadObservaciones18=1;
var cantidadObservaciones18=1;

function addObservacion18() {
  if (cantidadObservaciones18 >= 1  && cantidadObservaciones18 <= 9) {
    var nuevaObservacion18 = "";
    nuevaObservacion18 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion18 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion18   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion18    +="<input type='text' name='obs18[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones18+1)+"'>";
    nuevaObservacion18   +="</div>";
    nuevaObservacion18  +="</div>";
    nuevaObservacion18 +="</div>";

    $('#obs18').append(nuevaObservacion18);
    cantidadObservaciones18++;
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

var cantidadObservaciones19=1;
var cantidadObservaciones19=1;

function addObservacion19() {
  if (cantidadObservaciones19 >= 1  && cantidadObservaciones19 <= 9) {
    var nuevaObservacion19 = "";
    nuevaObservacion19 +="<div class='col-lg-12 input-group borde'>";
    nuevaObservacion19 +="<div class='col-lg-12 input-group'>";
    nuevaObservacion19   +="<div class='col-lg-12 input-group'>";
    nuevaObservacion19    +="<input type='text' name='obs19[]' class='form-control col-lg-12' placeholder='OBSERVACION "+(cantidadObservaciones19+1)+"'>";
    nuevaObservacion19   +="</div>";
    nuevaObservacion19  +="</div>";
    nuevaObservacion19 +="</div>";

    $('#obs19').append(nuevaObservacion19);
    cantidadObservaciones19++;
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
    <button id="alternar-respuesta-ej17" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Acta de Observaciones</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej17" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <center>
        <strong>
          <h3>Observaciones</h3>
        </strong>
      </center>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 input-group borde">
        <div class="col-lg-12 input-group">
            <h4>Arquitectonicas</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <h4>Juridicas</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <h4>Estructurales</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <p>Texto legal que la abogada nos brinda</p>
        </div>
      </div>
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 input-group" >
        <button type="button" class=" btn btn-danger col-lg-3 " >
          Generar Acta
        </button>
      </div>
      <div class="col-lg-12 form-group"></div>
    </div>
  </div>
  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej18" type="button" class="btn bottons btn-lg col-lg-12" >
      <h5>Observaciones al Acta</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej18" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>
      <center>
        <strong>
          <h3>Observaciones</h3>
        </strong>
      </center>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 input-group borde">
        <div class="col-lg-12 input-group">
            <h4>Arquitectonicas</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <h4>Juridicas</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <h4>Estructurales</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <p>Texto legal que la abogada nos brinda</p>
        </div>
      </div>
      <div class="col-lg-12 input-group" >
        <button type="button" class=" btn btn-danger col-lg-3 " >
          Generar Documento
        </button>
      </div>
      <div class="col-lg-12 form-group"></div>
    </div>
  </div>
  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej19" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Observación Final</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej19" style="display:none">
      <div class="col-lg-12 form-group"></div>
      <div class="col-lg-12 form-group"></div>
      <center>
        <strong>
          <h3>Observaciones</h3>
        </strong>
      </center>
      <div class="col-lg-12 form-group"></div>      
      <div class="col-lg-12 input-group borde">
        <div class="col-lg-12 input-group">
            <h4>Arquitectonicas</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <h4>Juridicas</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <h4>Estructurales</h4>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_acs" class="form-check-label">
              <li>Acta de Calibración de Surtidores</li>
            </label>
          </div>
        </div>                     
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccb" class="form-check-label">
              <li>Certificado de Calibración de Balanza</li>
            </label>
          </div>
        </div>   
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccrv" class="form-check-label">
              <li>Certificado de Calibración de Recipiente Volumetrico</li>
            </label>
          </div>
        </div> 
        <div class="col-lg-12 input-group">
          <div class="col-lg-10 input-group">
            <label for="document_ccc" class="form-check-label">
              <li>Certificado de Camara y Comercio</li>
            </label>
          </div>
        </div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 form-group"></div>
        <div class="col-lg-12 input-group">
            <p>Texto legal que la abogada nos brinda</p>
        </div>
      </div>
      <!-- <div class="col-lg-12 input-group" >
        <button type="button" class=" btn btn-danger col-lg-3 " >
          Generar Documento
        </button>
      </div> -->
      <div class="col-lg-12 form-group"></div>
    </div>
  </div>
 <!--  <div class="col-lg-12 input-group">
    <button id="alternar-respuesta-ej20" type="button" class="btn bottons btn-lg col-lg-12">
      <h5>Revision Final</h5>
    </button>
  </div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group" id="respuesta-ej20" style="display:none">
      <div class="col-lg-12 form-group">
      <div class="col-lg-12 form-group"></div>  
        <p>Deben de aparecer las observaciones pendientes, si todavia hay observaciones no cumple</p>
      </div>       
    </div>
  </div> -->
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>      
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
      <button class="btn btn-danger btn-lg col-lg-12">Completa Acta Observaciones</button>
  </div>
</div>