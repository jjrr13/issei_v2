<script type="text/javascript">
  function bloqConstruc(op){
     // alert(op);
     if (op==1) {
      // se desahbilitan todas las demas cuando se marca obra nueva
        for (var j = 9; j <=14 ; j++) {
          $('#LicCons'+j).attr('disabled', 'disabled');
          $('#LicCons'+j).removeAttr('checked');
        }
      }
      else if (op==2){
        //se vuelven a habilitar si se desmarca
        for (var r = 9; r <=14 ; r++) {
          $('#LicCons'+r).removeAttr('disabled');
        }
      }
      else if (op==3){
        //se evaluan todas las casillas de la construccion a execcion de la primera y las 2 ultima 
        var bandera = false;
        for (var s = 9; s <=14 ; s++) {
          if ($('#LicCons'+s).is(':checked')) {
            bandera = true;
            break;
          }
        }
        if (bandera) {
          //si tiene alguna marcada se desabilita la primera
          $('#LicCons8').attr('disabled', 'disabled');
          $('#LicCons8').removeAttr('checked');
        }
        else{
        // alert('entro al else');
          $('#LicCons8').removeAttr('disabled');
        }
      }
      else if (op==4){
        //se dehabilitan todas las casillas para evitar enviar mas datos cuando se marcar en otras actuaciones
        //revisar deshabilitar radiobutton
        for (var jj = 8; jj <=14 ; jj++) {
          $('#LicCons'+jj).attr('disabled', 'disabled');
          $('#LicCons'+jj).removeAttr('checked');
        }
        $('#LicCons').attr('disabled', 'disabled');
        $('#LicCons').removeAttr('checked');
      }
      else if (op==5){
        //se vuelve y se habilitan si se desmarcan
        for (var rr = 8; rr <=14 ; rr++) {
          $('#LicCons'+rr).removeAttr('disabled');
        }
        $('#LicCons').removeAttr('disabled');
      }
  }
  var primera=0;
  var era;
  var previo=null;
  function uncheckRadio(rbutton){
    if(previo &&previo!=rbutton ){
      if ($(rbutton).val() <= 5) {
        $('#LicUrba').attr('disabled', 'disabled');
        $('#LicPar').attr('disabled', 'disabled');
        $('#LicSub').attr('disabled', 'disabled');
        $('#LicUrba').removeAttr('checked');
        $('#LicPar').removeAttr('checked');
        $('#LicSub').removeAttr('checked');
        bloqConstruc(4);
        
      }
      // alert('entro al primer if');
      previo.era=false;
    }
    if(rbutton.checked==true && rbutton.era==true){
      $('#LicUrba').removeAttr('disabled');
      $('#LicPar').removeAttr('disabled');
      $('#LicSub').removeAttr('disabled');
      bloqConstruc(5);
      rbutton.checked=false;
    }
    if (primera==0) {
      $('#LicUrba').attr('disabled', 'disabled');
      $('#LicPar').attr('disabled', 'disabled');
      $('#LicSub').attr('disabled', 'disabled');
      $('#LicUrba').removeAttr('checked');
      $('#LicPar').removeAttr('checked');
      $('#LicSub').removeAttr('checked');
      bloqConstruc(4);
      primera=1;
    }
    rbutton.era=rbutton.checked;
    previo=rbutton;
  }


  function permitir2(valor){
    if ($(valor).val()==0) {
      // alert(valor.checked);
      if (valor.checked) {
        $('#industrial').attr('disabled', 'disabled');
      }
      else{
        $('#industrial').removeAttr('disabled');
      }
    }
    else if ($(valor).val()==3) {
      if (valor.checked) {
        $('#vivienda').attr('disabled', 'disabled');
      }
      else{
        $('#vivienda').removeAttr('disabled');
      }
    }
  }
  
  function permitir(valor){
    //alert($(valor).val());
    var opcion = $(valor).val();
    if (opcion == 1) {
      if (valor.checked) {
        $('#LicPar').attr('disabled', 'disabled');
        $('#LicSub').attr('disabled', 'disabled');
        $('#LicPar').removeAttr('checked');
        $('#LicSub').removeAttr('checked');

        // $('#LicCons1').attr('disabled', 'disabled');
        // $('#LicCons1').removeAttr('checked');
        // bloqConstruc(2);
      }
      else{
        $('#LicPar').removeAttr('disabled');
        $('#LicSub').removeAttr('disabled');
        // $('#LicCons1').removeAttr('disabled');
      }
    }
    else if (opcion == 2) {
      if (valor.checked) {
        $('#LicUrba').attr('disabled', 'disabled');
        $('#LicSub').attr('disabled', 'disabled');
        $('#LicUrba').removeAttr('checked');
        $('#LicSub').removeAttr('checked');
        // $('#LicCons1').attr('disabled', 'disabled');
        // $('#LicCons1').removeAttr('checked');
        // bloqConstruc(2);
      }
      else{
        $('#LicUrba').removeAttr('disabled');
        $('#LicSub').removeAttr('disabled');
        // $('#LicCons1').removeAttr('disabled');
      }
    }
    else if (opcion == 3) {
      if (valor.checked) {
        $('#LicUrba').attr('disabled', 'disabled');
        $('#LicPar').attr('disabled', 'disabled');
        $('#LicUrba').removeAttr('checked');
        $('#LicPar').removeAttr('checked');
        // $('#LicCons1').attr('disabled', 'disabled');
        // $('#LicCons1').removeAttr('checked');
        // bloqConstruc(2);
      }
      else{
        $('#LicUrba').removeAttr('disabled');
        $('#LicPar').removeAttr('disabled');
        // $('#LicCons1').removeAttr('disabled');
      }
    }
    else if (opcion == 4) {
      // alert('entro al estrato');
      if (valor.checked) {
        $('#estrato').css('display', '');
      }
      else{
        $('#estrato').css('display', 'none');
      }
    }
    else if (opcion == 8) {
      if (valor.checked) {
        bloqConstruc(1);
      }
      else{
        bloqConstruc(2);
      }
    }
  }
</script>

<form name="frTipo" id="frTipo" method="post">
  <div class="container row">
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Tipo Tramite:</u></strong></h5>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6  offset-2 input-group">
        <input type="checkbox"  name="LicUrba" id="LicUrba" class="form-check-input fantasma" value="1" onclick="permitir(this);">
        <label for="LicUrba" class="form-check-label izq">Licencia de Urbanización</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="urb" id="urb" class="form-check-input" value="Desarrollo">
            <label for="urb" class="form-check-label izq">Desarrollo</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="urb" id="urb2" class="form-check-input" value="Reurbanización">
            <label for="urb2" class="form-check-label izq">Reurbanización</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="urb" id="urb3" class="form-check-input" value="Saneamiento">
            <label for="urb3" class="form-check-label izq">Saneamiento</label>
          </div>
        </div>
        </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-4 offset-2 input-group">
        <input type="checkbox" name="LicPar" id="LicPar" class="form-check-input" value="2" onclick="permitir(this);">
        <label for="LicPar" class="form-check-label izq">Licencia de Parcelación</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div> 
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 offset-2 input-group">
        <input type="checkbox" name="LicSub" id="LicSub" class="form-check-input fantasma1" value="3" onclick="permitir(this);">
        <label for="LicSub" class="form-check-label izq">Licencia de Subdivisión</label>
      </div> 
      <div class="col-lg-12"  id="dvOcultar1" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="subd" id="subd1" class="form-check-input" value="Reloteo">
            <label for="subd1" class="form-check-label izq">Reloteo</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="subd" id="subd2" class="form-check-input" value="Subdivición Rural">
            <label for="subd2" class="form-check-label izq">Subdivición Rural</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="subd" id="subd3" class="form-check-input" value="Subdivición Urbana">
            <label for="subd3" class="form-check-label izq">Subdivición Urbana</label>
          </div>
        </div>
      </div>
    </div> 
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="checkbox" name="LicCons" id="LicCons" class="form-check-input fantasma2" value="4" onclick="permitir(this);">
        <label for="LicCons" class="form-check-label izq">Licencia de Construcción</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar2" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons8" class="form-check-input" value="8" onclick="permitir(this);">
            <label for="LicCons8" class="form-check-label izq">Obra Nueva</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons9" class="form-check-input" value="9" onclick="bloqConstruc(3);">
            <label for="LicCons9" class="form-check-label izq">Ampliación</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons10" class="form-check-input" value="10" onclick="bloqConstruc(3);">
            <label for="LicCons10" class="form-check-label izq">Adecuación</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons11" class="form-check-input" value="11" onclick="bloqConstruc(3);">
            <label for="LicCons11" class="form-check-label izq">Modificación</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons12" class="form-check-input" value="12" onclick="bloqConstruc(3);">
            <label for="LicCons12" class="form-check-label izq">Restauración</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons13" class="form-check-input" value="13" onclick="bloqConstruc(3);">
            <label for="LicCons13" class="form-check-label izq" >Cerramiento</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons14" class="form-check-input" value="14" onclick="bloqConstruc(3);">
            <label for="LicCons14" class="form-check-label izq" >Reconstrucción</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons15" class="form-check-input" value="15" onclick="bloqConstruc(3);">
            <label for="LicCons15" class="form-check-label izq" >Demolición Parcial</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons16" class="form-check-input" value="16" onclick="bloqConstruc(3);">
            <label for="LicCons16" class="form-check-label izq">Demolición Total</label>
          </div>
        </div>
        <div id="estrato" class="col-lg-12 input-group" style="display: none; padding-bottom: 20px; padding-top: 15px;">
          <div class="col-lg-2 offset-2 input-group">
            <label for="categoria" class="form-check-label izq">Categoria: </label>
          </div>
          <div class="col-lg-3   input-group">
            <select style="width: 66%;" class="js-example-basic-single form-control col-md-4" id="estrato" name="estrato" >
              <option class="form-check-input clasestado" value="1">1</option>
              <option class="form-check-input clasestado" value="2">2</option>
              <option class="form-check-input clasestado" value="3">3</option>
              <option class="form-check-input clasestado" value="4">4</option>
            </select>
            <!-- <input type="checkbox" name="categoria" id="categoria" class="form-check-input" value="16" onclick="bloqConstruc(3);"> -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="checkbox" name="LicRec" id="LicRec" class="form-check-input" value="6" onclick="permitir(this);">
        <label for="LicRec" class="form-check-label izq">Reconocimiento de la Existencia de una Edificación</label>
      </div>
    </div>  
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="checkbox" name="LicOtras" id="LicOtras" class="form-check-input fantasma3" value="100" onclick="permitir3(this);">
        <label for="LicOtras" class="form-check-label izq">Otras Actuaciones</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar3" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact1" class="form-check-input" value="Ajuste de Cotas" onclick="uncheckRadio(this);">
            <label for="otrasact1" class="form-check-label izq">Ajuste de Cotas</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact2" class="form-check-input" value="Concepto de Norma" onclick="uncheckRadio(this);">
            <label for="otrasact2" class="form-check-label izq">Concepto de Norma</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact3" class="form-check-input" value="Concepto de Uso de Suelos" onclick="uncheckRadio(this);">
            <label for="otrasact3" class="form-check-label izq">Concepto de Uso de Suelos</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact4" class="form-check-input" value="Copia Certificada de Planos" onclick="uncheckRadio(this);">
            <label for="otrasact4" class="form-check-label izq">Copia Certificada de Planos</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact5" class="form-check-input" value="Modificacion de Planos" onclick="uncheckRadio(this);">
            <label for="otrasact5" class="form-check-label izq">Modificacion de Planos</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact6" class="form-check-input" value="Propiedad Horizontal" onclick="uncheckRadio(this);">
            <label for="otrasact6" class="form-check-label izq">Propiedad Horizontal</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact7" class="form-check-input" value="Movimiento de Tierras" onclick="uncheckRadio(this);">
            <label for="otrasact7" class="form-check-label izq">Movimiento de Tierras</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact8" class="form-check-input" value="Aprobacion de Piscina" onclick="uncheckRadio(this);">
            <label for="otrasact8" class="form-check-label izq">Aprobacion de Piscina</label>
          </div>
        </div>
        
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group"></div>  
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Objeto Tramite:</u></strong></h5>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite1" class="form-check-input" value="1">
        <label for="objetoTramite1" class="form-check-label izq">Inicial</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite2" class="form-check-input" value="2">
        <label for="objetoTramite2" class="form-check-label izq">Prórroga</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite3" class="form-check-input" value="3">
        <label for="objetoTramite3" class="form-check-label izq">Modificación de Licencia Vigente</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite4" class="form-check-input" value="4">
        <label for="objetoTramite4" class="form-check-label izq">Revalidación</label>
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Usos:</u></strong></h5>
      </div>
    </div>
<style type="text/css">
  .izq{
    padding-left: 15px;
  }
</style>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="vivienda" class="form-check-input" value="0" onclick="permitir2(this);">
        <label for="vivienda" class="form-check-label izq">Vivienda</label>
      </div> 
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-4 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="comercio" class="form-check-input" value="1">
        <label for="comercio" class="form-check-label izq">Comercio y/o Servicios</label>
      </div> 
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="institu" class="form-check-input" value="2">
        <label for="institu" class="form-check-label izq">Institucional</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="industrial" class="form-check-input" value="3" onclick="permitir2(this);">
        <label for="industrial" class="form-check-label izq">Industrial</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>

  </div>
  <br>
  <br>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-5"></div>
    <input type="text" hidden="" name="btn_tipo" value="Tipo">
    <button type="button" name="btn_tipo" id="btn_tipo" value="Tipo" class=" btn btn-danger agregar col-lg-2" >
      <span class="fa fa-floppy-o"></span> Guardar 
    </button>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>