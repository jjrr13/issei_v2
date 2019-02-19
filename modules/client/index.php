<?php 
if(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
include_once $dir."cx/cx.php";
 
$_SESSION['fechaactual'];
$_SESSION['id_usuario']; // id de usuario.
$_SESSION['id_tipo_usuario']; 
$_SESSION['id_area'];

include ('../menu.php');
?>
<!DOCTYPE html>
<html>
  <head>
 
  <title>CLIENTE</title>

  <style type="text/css">

    .requerido{
      color: #dc3545;
      display: inline;
    }
    /*Soluciona Problema de barra inferior del div principal*/
    .card-footer {
      padding: .75rem .1rem !important;
    }
  </style>

  <noscript>
    <meta http-equiv="Refresh" content="0;URL=http://localhost/issei/cx/destroy_session.php">
  </noscript>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
  </script>
  </head>
  <body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container col-lg-10">
          <div class="card card-danger">
            <div class="card-header">
              <center><h3 class="card-title">CREAR CLIENTE</h3></center>
            </div>
            <form class="form-horizontal" action="../../controller/client_controller.php" method="post" >
              <div class="card-body">
                <div class="row form-group">
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-6  input-group">
                      <label for="tdocumento" class="col-form-label col-lg-4 ">Tipo <p class="requerido">*</p></label>
                      <select class="form-control col-lg-8" id="tdocumento" name="tdocumento" >
                        <?php 
                        $query = $mysqli -> query ("SELECT * FROM tipo_doc ORDER BY tipo_documento ASC");
                              while ($valores = mysqli_fetch_array($query)) {

                              echo '<option value="'.$valores['id_tipo_doc'].'">'.$valores['tipo_documento'].'</option>';
                          } ?>
                      </select>
                    </div>
                    <div class="col-lg-6  input-group"></div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-6 input-group">
                      <label for="nit" class="col-form-label col-lg-4 ">Documento <p class="requerido">*</p></label>
                      <input type="text" id="nit" name="nit" class="form-control col-lg-8 " placeholder="Numero de Documento" min="0" onkeypress="return ValidNum(event)"  maxlength="10" minlength="5">
                    </div>
                    <div class="col-lg-5 input-group">
                      <label for="ciudad" class="col-form-label col-lg-6">Lugar Expedición <p class="requerido">*</p></label>
                      <input type="text" class="form-control col-lg-6"  id="ciudad" name="ciudad" placeholder="Ciudad" onChange="letras(this)" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                     <div class="col-lg-6  input-group">
                      <label for="nombre" class="col-form-label col-lg-4">Nombre <p class="requerido">*</p></label>
                      <input type="text" class="form-control col-lg-8" id="nombre" name="nombre" placeholder="Nombre" onChange="letras(this)" >
                    </div>
                    <div class="col-lg-5  input-group">
                      <label for="apellido" class="col-form-label col-lg-4 ">Apellido <p class="requerido">*</p></label>
                      <input type="text" class="form-control col-lg-8"  id="apellido" name="apellido" placeholder="Apellido" onChange="letras(this)" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-6  input-group">
                      <label for="telefono1" class="col-form-label col-lg-4 ">Telefono1</label>
                      <input type="text" class="form-control col-lg-8"  id="telefono1" name="telefono1" placeholder="Telefono Fijo 1" onkeypress="return ValidNum(event)">
                    </div>
                    <div class="col-lg-5  input-group">
                      <label for="telefono2" class="col-form-label col-lg-4 ">Telefono2</label>
                      <input type="text" class="form-control col-lg-8"  id="telefono2" name="telefono2" placeholder="Telefono Fijo 2" onkeypress="return ValidNum(event)">
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-6  input-group">
                      <label for="celular" class="col-form-label col-lg-4 ">Celular</label>
                      <input type="text" class="form-control col-lg-8"  id="celular" name="celular" placeholder="Celular" onkeypress="return ValidNum(event)" >
                    </div>
                    <div class="col-lg-5  input-group">
                      <label for="email" class="col-form-label col-lg-4 ">Email</label>
                      <input type="text" class="form-control col-lg-8"  id="email" name="email" placeholder="Email" onChange="letras(this)" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-6 input-group">
                      <label for="direccion" class="col-form-label col-lg-4 ">Direccion <p class="requerido">*</p></label>
                      <input type="text" class="form-control col-lg-8"  id="direccion" name="direccion" placeholder="Direccion" onChange="letras(this)" >
                    </div>
                    <div class="col-lg-5  input-group">
                      <label for="estrato" class="col-form-label col-lg-4 ">Estrato <p class="requerido">*</p></label>
                      <select class="form-control" id="estrato" name="estrato" >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-6  input-group">
                      <label for="barrio" class="col-form-label col-lg-4 ">Barrio <p class="requerido">*</p></label>
                      <select class="js-example-basic-single form-control col-lg-9" id="barrio" name="barrio" >
                        <option class="clasestado">SELECCIONAR</option>
                        <option class="clasestado" value="487">OTRO BARRIO</option>
                        <?php 
                
                        $query = $mysqli -> query ("SELECT * FROM barrio WHERE id_barrio NOT IN (1, 487) ORDER BY barrio ASC");
                        while ($valores = mysqli_fetch_array($query)) {

                        echo "<option class='clasestado' value='".$valores['id_barrio']."'>".$valores['barrio']."</option>";
                          } ?>
                      </select>
                    </div>
                    <div class="col-lg-5 input-group" hidden="hidden" id="selectestado">
                      <label for="otro" class="col-form-label col-lg-4">Otro <p class="requerido">*</p></label>
                      <input type="text" class="form-control col-lg-8"  id="otro" name="otro" placeholder="Otro Barrio">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12  input-group">
                <div class="col-lg-6  input-group">
                  <label class="col-form-label col-lg-12 requerido">&nbsp;&nbsp;&nbsp;&nbsp;Los campos con (*) son obligatorios</label>
                </div>
              </div>
                  <!-- /.card-body -->
              <div class="card-footer input-group">
                <div class="form-group col-lg-12 "></div>
                <div class="col-lg-4 offset-3">
                  <button class="btn btn-danger" type="submit" name="submit" id="submit" >Crear</button>
                </div>
                <div class="col-lg-2">
                  <input type="hidden" name="cancelar">
                  <button type="submit" class="btn btn-default" id="cancelar" name="cancelar" value="9" formaction="../../functions/routes.php">cancelar</button>
                </div>
                <div class="form-group col-lg-12 "></div>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2018 Computer Services.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.2.1
      </div>
    </footer>
  <!-- /.control-sidebar -->


  <script language="javascript">
    //var opciones = document.getElementsByName("barrio"),
    $("#barrio").on('change', function(){
      var estado = $("#barrio").val() == "487" ? true : false;
      if (estado) {
       $('#selectestado').removeAttr("hidden").focus();
      }
      else{
       $('#selectestado').attr("hidden", "hidden");
      }
    });
  </script>
  <script language="javascript">
    function CambiarFormulario(){
        switch(document.forms[0].LISTA.selectedIndex){
            case 0: 
                document.getElementById('Texto1').style.display='none';
                document.getElementById('Texto2').style.display='none';
                break;
            case 1: 
                document.getElementById('Texto1').style.display='block';
                document.getElementById('Texto2').style.display='none';
                break;
            case 2: 
                document.getElementById('Texto1').style.display='none';
                document.getElementById('Texto2').style.display='none';
                break;
            case 3: 
                document.getElementById('Texto1').style.display='block';
                document.getElementById('Texto2').style.display='none';
                break;
            case 4: 
                document.getElementById('Texto1').style.display='none';
                document.getElementById('Texto2').style.display='block';
                break;
        }
    }
    </script>

<link href="../../plugins/select2/select2.min.css" rel="stylesheet" />
<script src="../../plugins/select2/select2.min.js"></script>
</body>
</html>




 