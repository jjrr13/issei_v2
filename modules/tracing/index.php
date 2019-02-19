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

  //If the variable does not exist, destroy the session
  if (empty($_SESSION['id_usuario']) || $_SESSION['id_tipo_usuario'] != 1) {
      header("location: ../../cx/destroy_session.php");
    }


include ('../menu.php');

?>

<!DOCTYPE html>
<html>
<head>
  <title>ISSEI</title>
  <!-- Requeridos -->
  <style type="text/css">
  
  .requerido{
    color: #dc3545;
    display: inline;
  }

  </style>

</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container col-lg-10">
          <div class="card card-danger">
              <div class="card-header">
                <center><h3 class="card-title">HOJA RUTA</h3></center>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="form1" name="form1" action="" method="post" >
                <div class="card-body">
                  <div class="row form-group">
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                      </div>
                      <div class="col-lg-5  input-group">
                      	<label for="" class="col-form-label col-lg-4 ">Radicado</label>
                        <input type="text" min="0"  class="form-control col-lg-7" id="" name="" placeholder="Numero Radicado" onkeypress="return ValidNum(event)" maxlength="6" autofocus>
                        <button type="submit" class="btn btn-danger btn-sm" id="buscar" formaction="../../controller/user_controller.php">buscar&nbsp;</button>
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Nro Radicado</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Direccion</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Tipo Licencia</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Barrio</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Objeto Tramite</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Estrato</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Tipo Uso</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Matricula</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div> 
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Suelo</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Planimetria</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Titulares</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div> 
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Titulares</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div> 
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Titulares</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div> 
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Constructor</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div> 
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Arquitecto</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div> 
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Ingeniero Civil</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Diseñador NO Estructural</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Ingeniero Civil Geotecnista</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Ingeniero Topografico</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Revisor Independiente Diseño Estructural</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-4">Otro Profesional</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-4">Nro Documento</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
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
                    <button class="btn btn-danger" type="submit" id="submit1" formaction="../../controller/user_controller.php" >Crear</button>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-default" id="cancelar" name="cancelar" value="10" formaction="../../functions/routes.php">cancelar</button>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </section>
      </div>
  <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2018 Computer Services.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.2.0
      </div>
    </footer>

    
  <!-- /.control-sidebar -->


  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


</body>
</html>




 