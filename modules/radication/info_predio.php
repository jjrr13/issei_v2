<form name="frPredio" id="frPredio" method="post">
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-12 input-group">
      <label for="nombrePredio" class="col-form-label col-lg-5">Nombre del Proyecto</label>
      <input type="text"   id="nombrePredio" name="nombrePredio" class="form-control col-lg-7">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-6 input-group">
      <label for="dirActual" class="col-form-label col-lg-5">Dirección (Actual)</label>
      <input type="text"  value="algo aqui" id="1" name="dirActual" class="form-control col-lg-7">
    </div>
    <div class="col-lg-6 input-group">
      <label for="BarrioActual" class="col-form-label col-lg-4">Barrio Actual</label>
      <!-- <input type="text"  value="algo aqui" name="BarrioActual" class="form-control col-lg-7"> -->
      <select style="width: 66%;" class="js-example-basic-single form-control col-md-2" id="BarrioActual" name="BarrioActual" >
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
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-6 input-group">
      <label for="dirAnterior" class="col-form-label col-lg-5">Dirección (Anterior)</label>
      <input type="text"  value="algo aqui" name="dirAnterior" class="form-control col-lg-7">
    </div>
    <div class="col-lg-6 input-group">
      <label for="BarrioAnterior" class="col-form-label col-lg-4">Barrio Anterior</label>
      <!-- <input type="text"  value="algo aqui" name="BarrioAnterior" class="form-control col-lg-7"> -->
      <select style="width: 66%;" class="js-example-basic-single form-control col-md-2" id="BarrioAnterior" name="BarrioAnterior" >
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
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-6 input-group">
        <label for="matricula" class="col-form-label col-lg-5">Nro. Matricula</label>
        <input type="text"  value="1234" name="matricula" class="form-control col-lg-7">
    </div>
    <div class="col-lg-6 input-group">
        <label for="catastral" class="col-form-label col-lg-4">Nro. Catastral</label>
        <input type="text"  value="987654" name="catastral" class="form-control col-lg-8">
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 input-group">
    <div class="col-lg-6 offset-6 input-group">
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
        <input type="radio" name="clasificacionsuelo" class="form-check-input" value="1" checked="">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="clasificacionsuelo" class="form-check-label">Urbano</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" name="clasificacionsuelo" class="form-check-input" value="2">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="clasificacionsuelo" class="form-check-label">Rural</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" name="clasificacionsuelo" class="form-check-input" value="3">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="clasificacionsuelo" class="form-check-label">De Expansión</label>
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
        <input type="radio" name="planimetria" class="form-check-input" value="1" checked="">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria" class="form-check-label">Plano del Loteo</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" name="planimetria" class="form-check-input" value="2">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria" class="form-check-label">Plano Topografico</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" name="planimetria" class="form-check-input" value="3">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria" class="form-check-label">Levantamiento Arquitectonico</label>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-1 offset-1 input-group">
        <input type="radio" name="planimetria" class="form-check-input" value="4">
      </div> 
      <div class="col-lg-10 input-group">
        <label for="planimetria" class="form-check-label">Otro</label>
      </div>
    </div>
  </div>
  <!-- reemplazar por hr con stilos -->
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-6">
      <input type="input" hidden="" name="btn_predio" value="Predio">
      <button type="button" name="btn_predio" value="Predio" class=" btn btn-danger agregar col-lg-4" >
        <span class="fa fa-floppy-o"></span> Guardar 
      </button>
    </div>
    <div class="col-lg-6">
      <form name="frPredio" id="skdj" method="post">

        <button type="submit" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp"> Cancelar</button>
      </form>
    </div>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>