<button href="#inline_content"  type="button" hidden="" name="modal" value="10" id="modal" class="inline btn btn-success">Abrir Modal</button>
<form name="frProfesionales" id="frProfesionales" method="POST">
  <div class="col-md-12 form-group"></div>
    <div class="col-md-12 form-group "></div>
  <div class="col-lg-12 form-group borde">
    <h5>TRAMITADOR</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit0" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="1144041539" type="text" name="nit0" id="nit0" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar0" value="0" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion0" hidden id="opcion">
        <label for="tarjeta0" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta0" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion0" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre0" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre0" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido0" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido0" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion0" id="opcion0" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular0" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular0" id="celular0" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email0" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email0" id="email0" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion0" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular0" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular0" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular0" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular0" name="barrioTitular0" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
      <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion1" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion1" name="profesion1" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion0" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza0" value="0" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  
  <div class="col-md-12 form-group "></div>

  <div class="col-md-12 form-group borde">
    <h5>CONTRUCTOR</h5>
    
    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit1" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit1" id="nit1" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar1" value="1" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion1" hidden id="opcion">
        <label for="tarjeta1" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta1" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion1" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre1" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre1" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido1" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido1" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion1" id="opcion1" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular1" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular1" id="celular1" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email1" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email1" id="email1" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion1" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular1" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular1" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular1" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular1" name="barrioTitular1" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion1" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion1" name="profesion1" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion1" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza1" value="1" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>ARQUITECTO PROYECTISTA</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit2" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit2" id="nit2" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar2" value="2" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion2" hidden id="opcion">
        <label for="tarjeta2" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta2" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion2" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre2" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre2" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido2" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido2" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion2" id="opcion2" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular2" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular2" id="celular2" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email2" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email2" id="email2" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion2" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular2" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular2" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular2" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular2" name="barrioTitular2" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion2" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion2" name="profesion2" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion2" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza2" value="2" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>INGENIERO CIVIL</h5>
    
    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit3" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit3" id="nit3" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar3" value="3" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion3" hidden id="opcion">
        <label for="tarjeta3" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta3" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion3" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre3" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre3" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido3" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido3" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion3" id="opcion3" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular3" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular3" id="celular3" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email3" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email3" id="email3" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion3" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular3" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular3" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular3" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular3" name="barrioTitular3" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion3" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion3" name="profesion3" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion3" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza3" value="3" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>DISEÑADOR DE ELEMENTOS NO ESTRUCTURALES</h5>
    
    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit4" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit4" id="nit4" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar4" value="4" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion4" hidden id="opcion">
        <label for="tarjeta4" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta4" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion4" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre4" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre4" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido4" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido4" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion4" id="opcion4" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular4" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular4" id="celular4" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email4" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email4" id="email4" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion4" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular4" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular4" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular4" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular4" name="barrioTitular4" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion4" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion4" name="profesion4" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion4" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza4" value="4" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>INGENIERO CIVIL GEOTECNISTA</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit5" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit5" id="nit5" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar5" value="5" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion5" hidden id="opcion">
        <label for="tarjeta5" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta5" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion5" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre5" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre5" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido5" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido5" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion5" id="opcion5" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular5" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular5" id="celular5" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email5" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email5" id="email5" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion5" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular5" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular5" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular5" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular5" name="barrioTitular5" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion5" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion5" name="profesion5" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion5" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza5" value="5" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>INGENIERO TOPOGRAFO Y/O TOPÓGRAFO</h5>
   
    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit6" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit6" id="nit6" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar6" value="6" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion6" hidden id="opcion">
        <label for="tarjeta6" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta6" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion6" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre6" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre6" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido6" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido6" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion6" id="opcion6" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular6" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular6" id="celular6" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email6" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email6" id="email6" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion6" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular6" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular6" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular6" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular6" name="barrioTitular6" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion6" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion6" name="profesion6" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion6" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza6" value="6" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>REVISOR INDEPENDIENTE DISEÑOS ESTRUCTURALES</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit7" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit7" id="nit7" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar7" value="7" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion7" hidden id="opcion">
        <label for="tarjeta7" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta7" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion7" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre7" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre7" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido7" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido7" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion7" id="opcion7" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular7" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular7" id="celular7" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email7" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email7" id="email7" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion7" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular7" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular7" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular7" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular7" name="barrioTitular7" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion7" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion7" name="profesion7" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion7" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza7" value="7" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>
  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group borde">
    <h5>OTROS PROFESIONALES ESPECIALISTAS</h5>

    <div class="col-lg-12 input-group" >
      <div class="col-lg-6 input-group">
        <label for="nit8" class="col-form-label col-md-4"><strong>NIT/CC:</strong></label>
        <input autofocus="autofocus" value="16603516" type="text" name="nit8" id="nit8" required title="Minimo 5 Numeros" pattern=".{5,10}" minlength="5" maxlength="10" class="form-control col-md-7" placeholder="Digite el No.">
        <button  type="button" name="burcar8" value="8" onclick="//buscarNit(this)" class="btn btn-danger left">Buscar</button>
      </div>
      <div class="col-lg-5 input-group opcion8" hidden id="opcion">
        <label for="tarjeta8" class="col-form-label col-lg-5 " style="padding-right: 0px;">TARJETA</label>
        <input type="text" class="form-control col-lg-8"  id="tarjeta8" name="tarjeta[]" placeholder="Numeros y Letras" onChange="letras(this)" >
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion8" hidden>
      <div class="col-md-6 input-group" >
        <label for="nombre8" class="col-form-label col-md-4">NOMBRE</label>
        <input type="text" id="nombre8" name="nombre[]" class="form-control col-md-9" placeholder="NOMBRE">
      </div>
      <div class="col-md-6 input-group ">
        <label for="apellido8" class="col-form-label col-md-4">APELLIDO</label>
        <input type="text" id="apellido8" name="apellido[]" class="form-control col-md-10" placeholder="APELLIDO">
      </div>
    </div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group opcion8" id="opcion8" hidden="">
      <div class="col-lg-6 input-group">
        <label for="celular8" class="col-form-label col-lg-4">CELULAR</label>
        <input type="text" name="celular8" id="celular8" class="form-control col-lg-8" placeholder="CELULAR">
      </div>
      <div class="col-lg-6 input-group">
        <label for="email8" class="col-form-label col-lg-4">EMAIL</label>
        <input type="email" name="email8" id="email8" class="form-control col-lg-9" placeholder="EMAIL">
      </div>
    </div>
    <div class="form-group col-lg-12 "></div>
    <div class="col-lg-12 input-group opcion8" hidden>
      <div class="col-lg-6 input-group">
        <label for="dirTitular8" class="col-form-label col-lg-4">Dirección </label>
        <input type="text"  placeholder="DIRECCION" id="dirTitular8" name="dirTitular[]" class="form-control col-lg-8">
      </div>
      <div class="col-md-6 input-group">
        <label for="barrioTitular8" class="col-form-label col-md-4">Barrio </label>
        <select style="width: 66%;" class="js-example-basic-single form-control col-md-12" id="barrioTitular8" name="barrioTitular8" >
          <option class="clasestado">SELECCIONAR</option>
          <option class="clasestado" value="487">OTRO BARRIO</option>
          <?php 

          $query = $mysqli-> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (487) ORDER BY barrio ASC");
          while ($valores = mysqli_fetch_array($query)) {

          echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
            } ?>
        </select>
      </div>
        <div class="form-group col-md-12 "></div>

      <div class="col-md-6  input-group">
        <label for="profesion8" class="col-form-label col-md-4 ">PROFESION</label>
        <select class="form-control" id="profesion8" name="profesion8" >
          <option value="1">Otros Profesionales</option>
          <option value="2">Diseñador</option>
          <option value="3">Ingeniero Civil</option>
          <option value="4">Ingeniero Geotécnico</option>
          <option value="5">Ingeniero Constructor</option>
          <option value="6">Ingeniero Proyectista</option>
          <option value="7">Arquitecto</option>
          <option value="8">Revisor Independiente</option>
          <option value="10">Topógrafo</option>
          <option value="11">Abogado</option>
          <option value="12">Contador</option>
          <option value="13">Administración de Empresas</option>
          <option value="14">Técnico en Sistemas</option>
          <option value="15">Técnico en Administración de Empresas</option>
          <option value="16">Bachiller</option>
          <option value="17">Trabajador Social</option>
          <option value="18">Técnico en Gestión Documental</option>
          <option value="19">Administración Pública</option>
          <option value="20">Técnico Analista Financiero y Contable</option>
          <option value="21">Técnico Asistente Administrativo</option>
          <option value="22">Técnico Auxiliar Contable</option>
          <option value="23">Tecnólogo en Análisis y Desarrollo de Sistemas de ...</option>
          <option value="24">Tramitador</option>
        </select>
      </div>
    </div>
    <div class="col-lg-12 input-group opcion8" hidden>
      <div class="col-lg-11"></div>
      <button type="button" class="col-lg-2  btn btn-primary " id="actualiza8" value="8" onclick="actualizarDatos(this)">Actualiza
        <span class="fa fa-exchange "></span>
      </button>
    </div>
  </div>

  <div class="col-md-12 form-group"></div>
  <div class="col-md-12 form-group"></div>
  <hr>
  <div class="col-md-12 input-group" >
    <div class="col-md-6 offset-2">
      <form name="frPredio" id="skdj" method="post">

        <button type="button" class="btn btn-primary agregar col-md-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp" onclick="limpiar();"> Cancelar</button>
      </form>
    </div>
    <div class="col-md-4">
      <input type="text" hidden="" name="btn_Profesionales" value="Profesionales">
      <button type="button" name="btn_Profesionales" value="Profesionales" class=" btn btn-danger agregar col-md-6" >
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
<div class="col-md-12"></div>
<div class="col-md-12"></div>