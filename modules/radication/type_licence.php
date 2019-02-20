<script type="text/javascript">
  function bloqConstruc(op){
     // alert(op);
     if (op==1) {
      // se desahbilitan todas las demas cuando se marca obra nueva
        for (var j = 11; j <=16 ; j++) {
          $('#LicCons'+j).attr('disabled', 'disabled');
          $('#LicCons'+j).removeAttr('checked');
        }
        $('#LicRec').attr('disabled', 'disabled');
        $('#LicRec').removeAttr('checked');
      }
      else if (op==2){
        //se vuelven a habilitar si se desmarca
        for (var r = 11; r <=16 ; r++) {
          $('#LicCons'+r).removeAttr('disabled');
        }
        $('#LicRec').removeAttr('disabled');
      }
      else if (op==3){
        //se evaluan todas las casillas de la construccion a execcion de la primera y las 2 ultima 
        var bandera = false;
        for (var s = 11; s <=16 ; s++) {
          if ($('#LicCons'+s).is(':checked')) {
            bandera = true;
            break;
          }
        }
        if (bandera) {
          //si tiene alguna marcada se desabilita la primera
          $('#LicCons10').attr('disabled', 'disabled');
          $('#LicCons10').removeAttr('checked');
        }
        else{
        // alert('entro al else');
          $('#LicCons10').removeAttr('disabled');
        }
      }
      else if (op==4){
        //se dehabilitan todas las casillas para evitar enviar mas datos cuando se marcar en otras actuaciones
        //revisar deshabilitar radiobutton
        for (var jj = 10; jj <=16 ; jj++) {
          $('#LicCons'+jj).attr('disabled', 'disabled');
          $('#LicCons'+jj).removeAttr('checked');
        }
        $('#LicCons').attr('disabled', 'disabled');
        $('#LicCons').removeAttr('checked');
      }
      else if (op==5){
        //se vuelve y se habilitan si se desmarcan
        for (var rr = 10; rr <=16 ; rr++) {
          $('#LicCons'+rr).removeAttr('disabled');
        }
        $('#LicCons').removeAttr('disabled');
      }
  }
  var primera=0;
  var era;
  var previo=null;
  function uncheckRadio(rbutton){
    var opcion = $(rbutton).val();
    if(previo && previo!=rbutton ){
      if (opcion <= 5) {
        $('#LicUrba').attr('disabled', 'disabled');
        $('#LicPar').attr('disabled', 'disabled');
        $('#LicSub').attr('disabled', 'disabled');
        $('#LicUrba').removeAttr('checked');
        $('#LicPar').removeAttr('checked');
        $('#LicSub').removeAttr('checked');
        bloqConstruc(4);
        
       alert('entro al primer if');
      }
      previo.era=false;
    }
    if (primera==0 && opcion == 21) {
      $('#LicUrba').attr('disabled', 'disabled');
      $('#LicPar').attr('disabled', 'disabled');
      $('#LicSub').attr('disabled', 'disabled');
      $('#LicUrba').removeAttr('checked');
      $('#LicPar').removeAttr('checked');
      $('#LicSub').removeAttr('checked');
       alert('entro al tercer if');
      bloqConstruc(4);
      primera=1;
    }
    if(rbutton.checked==true && rbutton.era==true){
      $('#LicUrba').removeAttr('disabled');
      $('#LicPar').removeAttr('disabled');
      $('#LicSub').removeAttr('disabled');
      bloqConstruc(5);
       alert('entro al segundoi if');
      rbutton.checked=false;
      if (opcion == 21 ) {
        primera = 0;
      }
    }
    rbutton.era=rbutton.checked;
    previo=rbutton;
  }


  function permitir2(valor){
    var option = $(valor).val();
    if (option ==1) {
      // alert(valor.checked);
      if (valor.checked) {
        $('#industrial').attr('disabled', 'disabled');
        $('#institu').attr('disabled', 'disabled');
      }
      else{
        $('#industrial').removeAttr('disabled');
        $('#institu').removeAttr('disabled');
      }
    }
    else if (option == 3) {
      if (valor.checked) {
        $('#vivienda').attr('disabled', 'disabled');
        $('#industrial').attr('disabled', 'disabled');
      }
      else{
        $('#industrial').removeAttr('disabled');
        $('#vivienda').removeAttr('disabled');
      }
    }
    else if (option ==4 ) {
      if (valor.checked) {
        $('#vivienda').attr('disabled', 'disabled');
        $('#institu').attr('disabled', 'disabled');
      }
      else{
        $('#institu').removeAttr('disabled');
        $('#vivienda').removeAttr('disabled');
      }
    }
  }
  
  function permitir(valor){
    // alert($(valor).val());
    var opcion = $(valor).val();
    if (opcion == 1) {
      if (valor.checked) {

        $('#LicPar').attr('disabled', 'disabled');
        $('#LicSub').attr('disabled', 'disabled');
        $('#LicPar').removeAttr('checked');
        $('#LicSub').removeAttr('checked');

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
      }
      else{
        $('#LicUrba').removeAttr('disabled');
        $('#LicSub').removeAttr('disabled');
      }
    }
    else if (opcion == 3) {
      if (valor.checked) {
        if(!$('#urb5').prop('checked')){
          $('#LicUrba').attr('disabled', 'disabled');
          $('#LicUrba').removeAttr('checked');
        }
        $('#LicPar').attr('disabled', 'disabled');
        $('#LicPar').removeAttr('checked');
      }
      else{
        $('#LicUrba').removeAttr('disabled');
        $('#LicPar').removeAttr('disabled');
      }
    }
    else if (opcion == 4) {
      //muestra el select de la categoria
      // alert('entro al categoria');
      if (valor.checked) {
        $('#categoria').css('display', '');
      }
      else{
        $('#categoria').css('display', 'none');
      }
    }
    //evalua obra nueva
    else if (opcion == 10) {
      if (valor.checked) {
        bloqConstruc(1);
      }
      else{
        bloqConstruc(2);
      }
    }
    else if (opcion == 20) {
      if (valor.checked) {
        $('#LicCons10').attr('disabled', 'disabled');
        $('#LicCons10').removeAttr('checked');
      }
      else{
        $('#LicCons10').removeAttr('disabled');
      }
    }
    else if (opcion == 30) {
      // alert('entro al 30');
      $('#LicSub').prop('disabled', false);
      $('#dvOcultar3').show();
    }
  }

  function mostrar(valor){
    var option = $(valor).val();
    if (option ==1) {
      $('#rad_vigente').attr('hidden', 'hidden');
      $('#contRadVigente').attr('hidden', 'hidden');
    }
    else if (option == 3) {
      $('#rad_vigente').removeAttr('hidden');
      $('#contRadVigente').removeAttr('hidden');
    }
  }
</script>

<form name="frTipo" id="frTipo" method="post">
  <div  class="col-lg-12 input-group" id="revisor">
    <h5><label for="revisorProyecto" class="col-form-label offset-2 col-lg-12">Arquitecto Revisor </label></h5>

    <select  class="form-control offset-1 col-md-4" id="revisorProyecto" name="revisorProyecto" >
      <option class="clasestado">ASIGNE EL ARQUITECTO</option>
      <?php 

      $query = $mysqli-> query ("SELECT id_usuario, CONCAT(t.nombre, ' ', t.apellido) AS arquitecto FROM usuarios AS u 
        INNER JOIN terceros t ON t.nit = u.nit
        WHERE u.id_cargo = 3");
      while ($valores = mysqli_fetch_array($query)) {

      echo "<option class='clasestado' value='".$valores['id_usuario']."'>".$valores['arquitecto']."</option>";
        } ?>
    </select>
  </div>
  <div  class="col-lg-12 form-group" ></div>
  <div  class="col-lg-12 form-group" ></div>
  <div class="container row">
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Tipo Tramite:</u></strong></h5>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-6  offset-2 input-group">
        <input type="checkbox"  name="LicCons" id="LicUrba" class="form-check-input fantasma" value="1" onclick="permitir(this);">
        <label for="LicUrba" class="form-check-label izq">Licencia de Urbanización</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar1" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="urb" id="urb" class="form-check-input" value="2">
            <label for="urb" class="form-check-label izq">Desarrollo</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="urb" id="urb2" class="form-check-input" value="3">
            <label for="urb2" class="form-check-label izq">Reurbanización</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="urb" id="urb3" class="form-check-input" value="4">
            <label for="urb3" class="form-check-label izq">Saneamiento</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-4 offset-2 input-group">
            <input type="radio" name="urb" id="urb4" class="form-check-input" value="29" >
            <label for="urb4" class="form-check-label izq">Modificacion Planos Urbano</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-4 offset-2 input-group">
            <input type="radio" name="urb" id="urb5" class="form-check-input" value="30" onclick="permitir(this);">
            <label for="urb5" class="form-check-label izq">Apobacion Proyecto Urbano</label>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-4 offset-2 input-group">
        <input type="checkbox" name="LicPar" id="LicPar" class="form-check-input fantasma" value="2" onclick="permitir(this);">
        <label for="LicPar" class="form-check-label izq">Licencia de Parcelación</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar2" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="parc" id="parc" class="form-check-input" value="5">
            <label for="parc" class="form-check-label izq">Desarrollo</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-1 offset-2 input-group">
            <input type="radio" name="parc" id="parc2" class="form-check-input" value="6">
            <label for="parc2" class="form-check-label izq">Saneamiento</label>
          </div>
        </div>
      </div>
      <div class="col-lg-10 input-group">
      </div>
    </div> 
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 offset-2 input-group">
        <input type="checkbox" name="LicSub" id="LicSub" class="form-check-input fantasma" value="3" onclick="permitir(this);">
        <label for="LicSub" class="form-check-label izq">Licencia de Subdivisión</label>
      </div> 
      <div class="col-lg-12"  id="dvOcultar3" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="subd" id="subd1" class="form-check-input" value="7">
            <label for="subd1" class="form-check-label izq">Reloteo</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="subd" id="subd2" class="form-check-input" value="8">
            <label for="subd2" class="form-check-label izq">Subdivición Rural</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="subd" id="subd3" class="form-check-input" value="9">
            <label for="subd3" class="form-check-label izq">Subdivición Urbana</label>
          </div>
        </div>
      </div>
    </div> 
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="checkbox" name="LicCons" id="LicCons" class="form-check-input fantasma" value="4" onclick="permitir(this);">
        <label for="LicCons" class="form-check-label izq">Licencia de Construcción</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar4" style="display: none;">
        <div id="categoria" class="col-lg-12 input-group" style="display: none; padding-bottom: 7px; padding-top: 7px;">
          <div class="col-lg-2 offset-2 input-group">
            <label for="categoria" class="form-check-label izq">Categoria: </label>
          </div>
          <div class="col-lg-3   input-group">
            <select style="width: 66%;" class="form-control col-md-4" id="categoria" name="categoria" >
              <option class="form-check-input clasestado" value="1">1</option>
              <option class="form-check-input clasestado" value="2">2</option>
              <option class="form-check-input clasestado" value="3">3</option>
              <option class="form-check-input clasestado" value="4">4</option>
            </select>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons10" class="form-check-input" value="10" onclick="permitir(this);">
            <label for="LicCons10" class="form-check-label izq">Obra Nueva</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons11" class="form-check-input" value="11" onclick="bloqConstruc(3);">
            <label for="LicCons11" class="form-check-label izq">Ampliación</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons12" class="form-check-input" value="12" onclick="bloqConstruc(3);">
            <label for="LicCons12" class="form-check-label izq">Adecuación</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons13" class="form-check-input" value="13" onclick="bloqConstruc(3);">
            <label for="LicCons13" class="form-check-label izq">Modificación</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons14" class="form-check-input" value="14" onclick="bloqConstruc(3);">
            <label for="LicCons14" class="form-check-label izq">Restauración</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons15" class="form-check-input" value="15" onclick="bloqConstruc(3);">
            <label for="LicCons15" class="form-check-label izq" >Reforzamiento Estructural</label>
          </div>
        </div>
        
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons16" class="form-check-input" value="16" onclick="bloqConstruc(3);">
            <label for="LicCons16" class="form-check-label izq" >Reconstrucción</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons17" class="form-check-input" value="17" onclick="bloqConstruc(3);">
            <label for="LicCons17" class="form-check-label izq" >Cerramiento</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons18" class="form-check-input" value="18" onclick="bloqConstruc(3);">
            <label for="LicCons18" class="form-check-label izq" >Demolición Parcial</label>
          </div>
        </div>
        <div class="col-lg-12 input-group" style="padding-bottom: 15px">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="LicConsC[]" id="LicCons19" class="form-check-input" value="19" onclick="bloqConstruc(3);">
            <label for="LicCons19" class="form-check-label izq">Demolición Total</label>
          </div>
        </div>
        
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-2 input-group">
        <input type="checkbox" name="LicRec" id="LicRec" class="form-check-input" value="20" onclick="permitir(this);">
        <label for="LicRec" class="form-check-label izq">Reconocimiento de la Existencia de una Edificación</label>
      </div>
    </div>  
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="checkbox" name="LicOtras" id="LicOtras" class="form-check-input fantasma" value="5" onclick="permitir3(this);">
        <label for="LicOtras" class="form-check-label izq">Otras Actuaciones</label>
      </div>
      <div class="col-lg-12"  id="dvOcultar5" style="display: none;">
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact21" class="form-check-input" value="21" onclick="uncheckRadio(this);">
            <label for="otrasact21" class="form-check-label izq">Ajuste de Cotas</label>
          </div>
        </div>
        <!-- <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact22" class="form-check-input" value="22" onclick="uncheckRadio(this);">
            <label for="otrasact22" class="form-check-label izq">Concepto de Norma</label>
          </div>
        </div> -->
        <!-- <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact23" class="form-check-input" value="23" onclick="uncheckRadio(this);">
            <label for="otrasact23" class="form-check-label izq">Concepto de Uso de Suelos</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact24" class="form-check-input" value="24" onclick="uncheckRadio(this);">
            <label for="otrasact24" class="form-check-label izq">Copia Certificada de Planos</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact25" class="form-check-input" value="25" onclick="uncheckRadio(this);">
            <label for="otrasact25" class="form-check-label izq">Modificacion de Planos</label>
          </div>
        </div> -->
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact26" class="form-check-input" value="26" onclick="uncheckRadio(this);">
            <label for="otrasact26" class="form-check-label izq">Propiedad Horizontal</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact27" class="form-check-input" value="27" onclick="uncheckRadio(this);">
            <label for="otrasact27" class="form-check-label izq">Movimiento de Tierras</label>
          </div>
        </div>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="radio" name="otrasact" id="otrasact28" class="form-check-input" value="28" onclick="uncheckRadio(this);">
            <label for="otrasact28" class="form-check-label izq">Aprobacion de Piscina</label>
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
        <input type="radio" name="objetoTramite" id="objetoTramite1" class="form-check-input" value="1" onclick="mostrar(this);">
        <label for="objetoTramite1" class="form-check-label izq">Inicial</label>
      </div>
    </div>
    <!-- <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite2" class="form-check-input" value="2" onclick="desabilitaLicencias(this)">
        <label for="objetoTramite2" class="form-check-label izq">Prórroga</label>
      </div>
    </div> -->
    <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite3" class="form-check-input" value="3" onclick="mostrar(this);">
        <label for="objetoTramite3" class="form-check-label izq">Modificación de Licencia Vigente</label>
      </div>
    </div>
    <div class="col-lg-12 offset-2 input-group" hidden="" id="contRadVigente">
      <div class="col-lg-8 offset-1 input-group">
        <label for="objetoTramite3" class="col-lg-5 form-check-label izq "><strong>No. Radicado Vigente: </strong></label>
        <input type="text" placeholder="Radicado" class="col-lg-5" hidden="" name="rad_vigente" id="rad_vigente">

      </div>
    </div>
    <!-- <div class="col-lg-12 input-group">
      <div class="col-lg-6 offset-2 input-group">
        <input type="radio" name="objetoTramite" id="objetoTramite4" class="form-check-input" value="4" onclick="desabilitaLicencias(this)">
        <label for="objetoTramite4" class="form-check-label izq">Revalidación</label>
      </div>
    </div> -->
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Usos:</u></strong></h5>
      </div>
    </div>

    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="vivienda" class="form-check-input" value="1" onclick="permitir2(this);">
        <label for="vivienda" class="form-check-label izq">Vivienda</label>
      </div> 
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-4 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="comercio" class="form-check-input" value="2">
        <label for="comercio" class="form-check-label izq">Comercio y/o Servicios</label>
      </div> 
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="institu" class="form-check-input" value="3" onclick="permitir2(this);">
        <label for="institu" class="form-check-label izq">Institucional</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input type="checkbox" name="usos[]" id="industrial" class="form-check-input" value="4" onclick="permitir2(this);">
        <label for="industrial" class="form-check-label izq">Industrial</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-2 input-group">
        <input title="Marque este boton solamente en caso que el proyecto sea en Unidades" type="checkbox" name="usos[]" id="unidades" class="form-check-input" value="5" onclick="permitir2(this);">
        <label title="Marque este boton solamente en caso que el proyecto sea en Unidades" for="unidades" class="form-check-label izq">Unidades Residenciales</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>

  </div>
  <br>
  <br>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-6 offset-2">
      <form name="frPredio" id="skdj" method="post">

        <button type="button" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp" onclick="limpiar();"> Cancelar</button>
      </form>
    </div>
    <div class="col-lg-4">
      <input type="text" hidden="" name="btn_tipo" value="Tipo">
      <button type="button" name="btn_tipo" id="btn_tipo" value="Tipo" class="offset-1 btn btn-danger agregar col-lg-6" >
        <span class="fa fa-floppy-o"></span> Guardar 
      </button>
    </div>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>