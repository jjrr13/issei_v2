<button href="#inline_content"  type="button" hidden="" name="modal" value="10" id="modal" class="inline btn btn-success">Abrir Modal</button>
<form name="frProfesionales" id="frProfesionales" method="POST">
  <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group "></div>
  <div class="col-lg-12 form-group borde">
  <h5>TRAMITADOR</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-5 input-group">
        <label for="nit0" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="1144041539" type="text" name="nit0" id="nit0" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button  type="button" name="burcar0" value="0" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion0" id="opcion" hidden="">
        <label for="nombre0" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre0" id="nombre0" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion0" id="opcion0" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular0" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular0" id="celular0" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email0" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email0" id="email0" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group "></div>
  <div class="col-lg-12 form-group borde">
  <h5>CONTRUCTOR</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-5 input-group">
        <label for="nit1" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit1" id="nit1" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button  type="button" name="burcar1" value="1" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion1" id="opcion" hidden="">
        <label for="nombre1" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre1" id="nombre1" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion1" id="opcion1" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular1" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular1" id="celular1" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email1" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email1" id="email1" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>ARQUITECTO PROYECTISTA</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">
        <label for="nit2" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit2" id="nit2" value="" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar2" value="2" onclick="//buscarNit(this)" class=" btn btn-danger left">Buscar</button>
      </div>
       <div class="col-lg-5 input-group opcion2" id="opcion2" hidden="">
        <label for="nombre2" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre2" id="nombre2" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>

    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion2" id="opcion2" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular2" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular2" id="celular2" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email2" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email2" id="email2" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>INGENIERO CIVIL</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">

        <label for="nit3" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit3" id="nit3" value="" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar3" value="3" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
       <div class="col-lg-5 input-group opcion3" id="opcion3" hidden="">
        <label for="nombre3" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre3" id="nombre3" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion3" id="opcion3" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular3" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular3" id="celular3" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email3" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email3" id="email3" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>DISEÑADOR DE ELEMENTOS NO ESTRUCTURALES</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">
        <label for="nit4" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit4" id="nit4" value="" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar4" value="4" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
       <div class="col-lg-5 input-group opcion4" id="opcion4" hidden="">
        <label for="nombre4" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre4" id="nombre4" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion4" id="opcion4" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular4" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular4" id="celular4" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email4" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email4" id="email4" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>INGENIERO CIVIL GEOTECNISTA</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">
        <label for="nit5" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit5" id="nit5" value="" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar5" value="5" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion5" id="opcion5" hidden="">
        <label for="nombre5" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre5" id="nombre5" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion5" id="opcion5" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular5" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular5" id="celular5" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email5" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email5" id="email5" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>INGENIERO TOPOGRAFO Y/O TOPÓGRAFO</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">
        <label for="nit6" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit6" id="nit6" value="" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar6" value="6" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
       <div class="col-lg-5 input-group opcion6" id="opcion6" hidden="">
        <label for="nombre6" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre6" id="nombre6" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion6" id="opcion6" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular6" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular6" id="celular6" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email6" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email6" id="email6" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>REVISOR INDEPENDIENTE DISEÑOS ESTRUCTURALES</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">
        <label for="nit7" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit7" id="nit7" value="" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar7" value="7" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
       <div class="col-lg-5 input-group opcion7" id="opcion7" hidden="">
        <label for="nombre7" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre7" id="nombre7" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion7" id="opcion7" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular7" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular7" id="celular7" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email7" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email7" id="email7" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>
  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group borde">
    <h5>OTROS PROFESIONALES ESPECIALISTAS</h5>
    <div class="col-lg-12 input-group">
      <div class="col-lg-5 input-group">
        <label for="nit8" class="col-form-label col-lg-3"><strong>NIT/CC:</strong></label>
        <input type="text" name="nit8" id="nit8" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-lg-8" placeholder="Digite el No.">
        <button type="button" name="burcar8" value="8" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
       <div class="col-lg-5 input-group opcion8" id="opcion8" hidden="">
        <label for="nombre8" class="col-form-label col-lg-3">NOMBRE</label>
        <input type="text" name="nombre8" id="nombre8" class="form-control col-lg-9" placeholder="NOMBRE">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion8" id="opcion8" hidden="">
      <div class="col-lg-5 input-group">
        <label for="celular8" class="col-form-label col-lg-3">CELULAR</label>
        <input type="text" name="celular8" id="celular8" class="form-control col-lg-9" placeholder="CELULAR">
      </div>
      <div class="col-lg-5 input-group">
        <label for="email8" class="col-form-label col-lg-3">EMAIL</label>
        <input type="email" name="email8" id="email8" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
  </div>

  <div class="col-lg-12 form-group"></div>
  <div class="col-lg-12 form-group"></div>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-6 offset-2">
      <form name="frPredio" id="skdj" method="post">

        <button type="submit" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp"> Cancelar</button>
      </form>
    </div>
    <div class="col-lg-4">
      <input type="text" hidden="" name="btn_Profesionales" value="Profesionales">
      <button type="button" name="btn_Profesionales" value="Profesionales" class=" btn btn-danger agregar col-lg-6" >
        <span class="fa fa-floppy-o"></span> Guardar 
      </button>
    </div>
  </div>
</form>
<!-- This contains the hidden content for inline calls -->
    <div style='display:none' id="otro">
      <div id='inline_content' style='padding:10px; background:#fff;'>
       <!-- <iframe src="commentary/index.php"></iframe> -->
       <?php include_once('create.php'); ?>
      </div>
    </div>
  <!-- /.content-wrapper -->
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>