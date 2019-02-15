<script>
    var cantDirecciones= 0;

  function add_Direcciones(){

    var dirActual = $('#dirActual_'+cantDirecciones).val();
    var barrioActual = $('#BarrioActual_'+cantDirecciones).val();

    if (dirActual.length >5 && barrioActual != 'SELECCIONAR' ) {

      cantDirecciones++;
      var otraDireccion="";

      otraDireccion+=" <div class='col-lg-12 input-group borde'>";
      otraDireccion+="  <div class='col-md-6 input-group'>"
      otraDireccion+="    <label for='catastral_"+cantDirecciones+"' class='col-form-label col-lg-5'>Nro. Catastral</label>"
      otraDireccion+="    <input type='text' id='catastral_"+cantDirecciones+"' value='' name='catastral[]' class='form-control col-lg-7'>"
      otraDireccion+="  </div>"
      otraDireccion+="  <div class='col-md-6 input-group'>"
      otraDireccion+="    <label for='matricula_"+cantDirecciones+"' class='col-form-label col-lg-5'>Nro. Matricula</label>"
      otraDireccion+="    <input type='text' id='matricula_"+cantDirecciones+"' value='370-' name='matricula[]' class='form-control col-lg-7'>"
      otraDireccion+="  </div>"
      otraDireccion+="  <div class='col-lg-12 form-group'></div>"
      otraDireccion+="  <div class='col-md-6 input-group'>";
      otraDireccion+="    <label for='dirActual_"+cantDirecciones+"' class='col-form-label col-lg-5'>Dirección(Adicional)</label>";
      otraDireccion+="    <input type='text' id='dirActual_"+cantDirecciones+"' name='dirActual[]' class='form-control col-lg-7'>";
      otraDireccion+="  </div>";
      otraDireccion+="  <div class='col-md-6 input-group'>";
      otraDireccion+="    <label for='BarrioActual_"+cantDirecciones+"' class='col-form-label col-lg-4' style='margin-right: 22px; ma'>Barrio/Vereda</label>";
      otraDireccion+="    <select style='width: 60%;' class='js-example-basic-single form-control col-lg-2' id='BarrioActual_"+cantDirecciones+"' name='BarrioActual[]' >";
      otraDireccion+="    <option class='clasestado'>SELECCIONAR</option>";
      <?php 
        $query = $mysqli-> query ('SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC');
        while ($valores = mysqli_fetch_array($query)) { ?>
          otraDireccion +="<option class='clasestado' value='<?=$valores['id_barrio']; ?>'><?=$valores['barrio']; ?> </option>";
        <?php   } ?>
      otraDireccion+=" </select>";
      otraDireccion+=" </div>";
      otraDireccion+=" </div>";
      
      $('#padreDirecciones').append(otraDireccion);
      inciarSelectes2();
    }
    else{
      confirmar('UNO DE LAS DIRECCIONES ESTA HERRADA! <br> INTENTA DE NUEVO', 'fa fa-window-close', 'yellow', 'S');
    }
  }
</script>

<form name="frPredio" id="frPredio" method="post">
  <div class="col-lg-12 form-group"></div>

  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group">
      <label for="nombrePredio" class="col-form-label col-lg-3">Nombre del Proyecto</label>
      <input type="text" value="Proyecto JJ"  id="nombrePredio" name="nombrePredio" class="form-control col-lg-10">
    </div>
  </div>

  <div class="col-lg-12 form-group"></div>

  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group">
      <label for="descripcion" class="col-form-label col-md-3">Descripción Proyecto</label>
      <input type="text" value="MODALIDAD"  id="descripcion" name="descripcion" class="form-control col-md-10">
    </div>
  </div>
  
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-md-7 input-group">
      <label for="dirAnterior" class="col-form-label col-lg-5">Dirección (Anterior)</label>
      <input type="text"  value="" name="dirAnterior" class="form-control col-lg-7">
    </div>
    <div class="col-md-5  input-group">
        <label for="estrato" class="col-form-label col-lg-4">Estrato</label>
        <select style="width: 66%;" class=" form-control col-md-2" id="estrato" name="estrato" >
        <option class="clasestado" value="1">1</option>
        <option class="clasestado" value="2">2</option>
        <option class="clasestado" value="3">3</option>
        <option class="clasestado" value="4">4</option>
        <option class="clasestado" value="5">5</option>
        <option class="clasestado" value="6">6</option>
      </select>
    </div>
  </div>
  <!-- <div class="col-lg-12 input-group">
  </div> -->
  <div class="col-lg-12 form-group"></div>
  <!-- comienza parte dinamica con js -->
  <div  id="padreDirecciones" style="width: 100%;">
    <div class="col-lg-12 form-group"></div>
    <div class="col-md-12">
      <label class="col-md-12 " style="color: red;">A = Avenida, C = Calle, K = Carrera, P = Pasaje, T = Transversal, D = Diagonal, N = Norte, O = Oeste</label>
    </div>
     <div class="col-md-9 borde">
      <label class="col-md-6 offset-3"><strong><u>Guia de Direcciones</u></label></strong>
      <label class="col-md-6">A 2 BIS # 24A N - 25</label><label class="col-md-6">A 4 O # 6 O - 170</label>
      <label class="col-md-6">C 56A # 42C2 - 35</label><label class="col-md-6">K 2 N # 22 - 103</label>
      <label class="col-md-6">P 7F # 66 - 24</label><label class="col-md-6">T 2A # 1C - 14</label>
      <label class="col-md-6">D 28C # 43A - 41</label><label class="col-md-6">A 2A con C 12 N (Cruces ejes viales)</label>
    </div>
    <div class="col-lg-12 input-group borde">
      <div class="col-md-6 input-group">
          <label for="catastral_0" class="col-form-label col-lg-5">Nro. Catastral</label>
          <input type="text" id="catastral_0" value="" name="catastral[]" class="form-control col-lg-7">
      </div>
      <div class="col-md-6 input-group">
          <label for="matricula_0" class="col-form-label col-lg-5">Nro. Matricula</label>
          <input type="text" id="matricula_0" value="370-" name="matricula[]" class="form-control col-lg-7">
      </div>
      <div class="col-lg-12 form-group"></div>
      <div class="col-md-6 input-group">
        <label for="dirActual_0" class="col-form-label col-lg-5">Dirección (Actual)</label>
        <input type="text"  value="" id="dirActual_0" name="dirActual[]" class="form-control col-lg-7">
      </div>
      <div class="col-md-6 input-group">
        <label for="BarrioActual_0" class="col-form-label col-lg-4" style="margin-right: 22px; ma">Barrio/Vereda</label>
        <!-- <input type="text"  value="algo aqui" name="BarrioActual_0" class="form-control col-lg-7"> -->
        <select style="width: 60%;" class="js-example-basic-single form-control col-lg-2" id="BarrioActual_0" name="BarrioActual[]" >
          <option class="clasestado">SELECCIONAR</option>
          <!-- <option class="clasestado" value="487">OTRO BARRIO</option> -->
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (1, 487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
    </div>
  </div>
  <!-- termina parte dinamica con js -->
  <div class="col-md-12 input-group ">
   
    <div class="col-md-1 offset-11">
      <button type="button" class=" btn btn-success agregar col-lg-12" id="addDirecciones" name="adddir" onclick="add_Direcciones();">
        <span class="fa fa-plus-circle "></span> 
      </button>
    </div>
  </div>

  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-7 offset-2  input-group">
      <h5>CLASIFICACIÓN DEL SUELO</h5>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12">
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input id="clasificacionsuelo1" type="radio" name="clasificacionsuelo" class="form-check-input" value="1" >
      </div> 
      <div class="col-lg-10 input-group">
        <label for="clasificacionsuelo1" class="form-check-label">Urbano</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input id="clasificacionsuelo2" type="radio" name="clasificacionsuelo" class="form-check-input" value="2">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="clasificacionsuelo2" class="form-check-label">Rural</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input id="clasificacionsuelo3" type="radio" name="clasificacionsuelo" class="form-check-input" value="3">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="clasificacionsuelo3" class="form-check-label">De Expansión</label>
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-7 offset-2  input-group">
      <h5>PLANIMETRÍA DEL LOTE</h5>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12">
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" id="planimetria1" name="planimetria" class="form-check-input" value="1" >
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria1" class="form-check-label">Plano del Loteo</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" id="planimetria2" name="planimetria" class="form-check-input" value="2">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria2" class="form-check-label">Plano Topografico</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" id="planimetria3" name="planimetria" class="form-check-input" value="3">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria3" class="form-check-label">Levantamiento Arquitectonico</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" id="planimetria4" name="planimetria" class="form-check-input" value="4">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria4" class="form-check-label">Otro</label>
      </div>
    </div>
  </div>
  <!-- reemplazar por hr con stilos -->
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-6 offset-2">
      <form name="frPredio" id="skdj" method="post">

        <button type="button" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp" onclick="limpiar();"> Cancelar</button>
      </form>
    </div>
    <div class="col-lg-4">
      <input type="input" hidden="" name="btn_predio" value="Predio">
      <button type="button" name="btn_predio" value="Predio" class=" btn btn-danger agregar col-lg-6" >
        <span class="fa fa-floppy-o"></span> Guardar 
      </button>
    </div>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>