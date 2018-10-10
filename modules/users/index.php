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
    /*Soluciona Problema de barra inferior del div principal*/
    .card-footer {
      padding: .75rem .1rem !important;
    }
  </style>

 <!-- Closing session by inactivity function -->
 <script type="text/javascript">
  var time;
  function inicio() { 
    console.log("Paso por Inicio");
    time = setTimeout(function() { 
        $(document).ready(function(e) {
        alert("Sesion Caducada");
        document.location.href='../../cx/destroy_session.php';  
      });
    },5400000);//fin timeout 20 minutes
  }//fin inicio
   
  function reset() {
    console.log("Esta por Reset");
    clearTimeout(time);//limpia el timeout para resetear el tiempo desde cero 
    time = setTimeout(function() { 
      $(document).ready(function(e) {
        alert("Sesion Caducada");
        document.location.href='../../cx/destroy_session.php';  
      });
    },5400000);//fin timeout 20 minutes
  }//fin reset

  //Funcion que cambia todo lo ingresado a mayuscula
  function letras(campo){
    campo.value=campo.value.toUpperCase();
  }

  //Funcion que validad el ingreso de solo numeros
  function ValidNum(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
  }
  </script> 
</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container col-lg-10">
          <div class="card card-danger">
              <div class="card-header">
                <center><h3 class="card-title">CREAR USUARIO</h3></center>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="form1" name="form1" action="" method="post" >
                <div class="card-body">
                  <div class="row form-group">
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="cc" class="col-form-label col-lg-4 ">Documento <p class="requerido">*</p></label>
                        <input type="text" min="0"  class="form-control col-lg-7" id="cc" name="cc" placeholder="Numero Documento" onkeypress="return ValidNum(event)" maxlength="10" autofocus>
                        <button type="submit" class="btn btn-danger btn-sm" id="buscar" formaction="../../controller/user_controller.php">buscar&nbsp;</button>
                      </div>
                      <div class="col-lg-5  input-group">
                      	<label for="perfil" class="col-form-label col-lg-3 ">Perfil <p class="requerido">*</p></label>
                        <select class="form-control col-lg-9" id="perfil" name="perfil" >
                          <option value="">SELECCIONAR</option>
                           <?php 
              							$query = $mysqli -> query ("SELECT * FROM tipo_usuario");
              							  while ($valores = mysqli_fetch_array($query)) {

              							  echo '<option value="'.$valores[id_tipo_usuario].'">'.$valores[tipo_usuario].'</option>';
              								  
              							  } 
              						 ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="nombre" class="col-form-label col-lg-3">Nombre</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre" <?php if(!empty($_SESSION['nombre2'])) echo "value='".$_SESSION['nombre2']."' readonly "; ?>>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="apellido" class="col-form-label col-lg-3">Apellido</label>
                        <input type="text" class="form-control col-lg-9"  id="apellido" name="apellido" <?php if(!empty($_SESSION['apellido2'])) echo "value='".$_SESSION['apellido2']."' readonly"; ?> >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="usuario" class="col-form-label col-lg-3 ">Usuario <p class="requerido">*</p></label>
                        <input type="text" class="form-control col-lg-8"  id="usuario" name="usuario" placeholder="Usuario" >
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="password" class="col-form-label col-lg-3 ">Password <p class="requerido">*</p></label>
                        <input type="password" class="form-control col-lg-9"  id="password" name="password" placeholder="Password" >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-5  input-group">
                        <label for="cargo" class="col-form-label col-lg-3 ">Cargo <p class="requerido">*</p></label>
                        <select class="form-control col-lg-9" id="cargo" name="cargo" >
                          <option value="0">SELECCIONAR</option>
                           <?php 
                            $query = $mysqli -> query ("SELECT * FROM cargo");
                                  while ($valores = mysqli_fetch_array($query)) {
                                  echo '<option value="'.$valores[id_cargo].'">'.$valores[cargo].'</option>';
                              } ?>
                        </select>
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="area" class="col-form-label col-lg-3 ">Area <p class="requerido">*</p></label>
                        <select class="form-control col-lg-9" id="area" name="area" >
                          <option value="">SELECCIONAR</option>
                           <?php 
              							$query = $mysqli -> query ("SELECT * FROM area");
              									  while ($valores = mysqli_fetch_array($query)) {

              										echo '<option value="'.$valores[id_area].'">'.$valores[area].'</option>';
              							  } ?>
                        </select>
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




 