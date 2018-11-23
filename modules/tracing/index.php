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
    $nro_rad = '760011180011' ;
    // $nro_rad = '1806' ;

    $query_busqueda = sprintf("SELECT r.*, re.nombre as nombre_estado, ro.nombre as nombre_objetivo, b.barrio, 
    								  rc.nombre as clasificacion_suelo, rp.nombre as planimetria_lote
								FROM radicacion r 
									INNER JOIN radicado_estados re on re.id_estados = r.estado_id
								    INNER JOIN radicado_objetivo ro on ro.id_tramite = r.objetivo_id
								    INNER JOIN barrio b on b.id_barrio = r.barrio_act
                                    INNER JOIN radicado_suelos rc on rc.id_suelos = r.id_suelos
                                    INNER JOIN radicado_planimetria rp on rp.id_planimetria = r.id_planimetria
								WHERE r.consecutivo = '%s'", $nro_rad);
    $jg_busqueda =$mysqli->query($query_busqueda);
    $result_busqueda = mysqli_fetch_assoc($jg_busqueda);
    $totalrows_result_busqueda = mysqli_num_rows($jg_busqueda);

    $query_busqueda2 = sprintf("SELECT r.consecutivo, rus.nombre
								FROM radicacion r 
								    INNER JOIN rad_usos ru on ru.id_rad = r.consecutivo
								    INNER JOIN radicado_usos rus on rus.id_usos = ru.id_usos
								WHERE r.consecutivo = '%s'", $nro_rad);
    $jg_busqueda2 =$mysqli->query($query_busqueda2);
    $result_busqueda2 = mysqli_fetch_assoc($jg_busqueda2);
    $totalrows_result_busqueda2 = mysqli_num_rows($jg_busqueda2);

    $query_busqueda3 = sprintf("SELECT r.consecutivo, ri.id_terc, CONCAT(t.nombre, ' ', t.apellido) as titular
								FROM radicacion r 
								    INNER JOIN rad_titulares ri on ri.id_rad = r.consecutivo
								    INNER JOIN terceros t on t.nit = ri.id_terc
								WHERE r.consecutivo = '%s'", $nro_rad);
    $jg_busqueda3 =$mysqli->query($query_busqueda3);
    $result_busqueda3 = mysqli_fetch_assoc($jg_busqueda3);
    $totalrows_result_busqueda3 = mysqli_num_rows($jg_busqueda3);

    $query_busqueda4 = sprintf("SELECT r.consecutivo, tl.nombre, tl.modalidad
								FROM radicacion r 
								    INNER JOIN rad_lic rl on rl.id_rad = r.consecutivo
								    INNER JOIN tipo_licencias tl on tl.id = rl.id_lic
								WHERE r.consecutivo = '%s'", $nro_rad);
    $jg_busqueda4 =$mysqli->query($query_busqueda4);
    $result_busqueda4 = mysqli_fetch_assoc($jg_busqueda4);
    $totalrows_result_busqueda4 = mysqli_num_rows($jg_busqueda4);

    $query_busqueda5 = sprintf("SELECT r.consecutivo, ri.id_terc, CONCAT(t.nombre, ' ', t.apellido) as profesional, 
    								   p.profesion
								FROM radicacion r 
								    INNER JOIN rad_respo ri on ri.id_rad = r.consecutivo
								    INNER JOIN terceros t on t.nit = ri.id_terc
								    INNER JOIN profesion p on p.id_profesion = ri.id_profesion
								WHERE  r.consecutivo = '%s'", $nro_rad);
    $jg_busqueda5 =$mysqli->query($query_busqueda5);
    $result_busqueda5 = mysqli_fetch_assoc($jg_busqueda5);
    $totalrows_result_busqueda5 = mysqli_num_rows($jg_busqueda5);

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
  .sinborde{
  	border: 0px solid #ced4da;
  }
  </style>

</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container col-lg-11">
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
	                    <div class="col-lg-12 input-group">
		                    <div class="col-lg-6 input-group">
								<div class="col-lg-12 input-group">
								</div>
		                    </div>
		                    <div class="col-lg-5  input-group">
								<div class="col-lg-12 input-group">
									<label for="" class="col-form-label col-lg-3">&nbsp;&nbsp;Radicado </label>
									<input type="text" value="76001-1-" class="form-control col-lg-2" readonly>
									<input type="text" min="0"  class="form-control col-lg-2" id="" name="" onkeypress="return ValidNum(event)" maxlength="6" autofocus>
									<button type="submit" class="btn btn-danger btn-sm col-lg-2" id="buscar" formaction="../../controller/user_controller.php">buscar&nbsp;</button>
								</div>
							</div>
	                    </div>
	                    <div class="form-group col-lg-12 "></div>
	                    <div class="form-group col-lg-12 "></div>
	                    <div class="col-lg-12 input-group">
	                      	<div class="col-lg-6 input-group">
		                    	<div class="col-lg-12 input-group">
			                        <label for="nombre" class="col-form-label col-4">Número Radicado</label>
			                        <input type="text" class="form-control sinborde"  id="nombre" name="nombre" <?php echo "value='".$nro_rad."' readonly "; ?>>
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-lg-4">Objecto Tramite</label>
		                        	<input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['nombre_objetivo']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4">Usos</label>
			                       <?php if($totalrows_result_busqueda2 > 0){ 
			                       		 do { ?>
								    <input type="text" class="form-control sinborde"  id="nombre" name="nombre" <?php echo "value='".$result_busqueda2['nombre']."' readonly "; ?>>
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
			                        <?php } while ($result_busqueda2 = mysqli_fetch_assoc($jg_busqueda2));
								    } else { ?>
								   <input type="text" class="form-control sinborde"  id="nombre" name="nombre" readonly>
		                    	</div>
		                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
								   <?php } ?>
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4">Licencia / Modalidad</label>
			                       <?php if($totalrows_result_busqueda4 > 0){ ?>
							       	<?php do { ?>
								    <input type="text" class="form-control sinborde"  id="nombre" name="nombre" <?php echo "value='".$result_busqueda4['modalidad']."' readonly "; ?>>
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
			                        <?php } while ($result_busqueda4 = mysqli_fetch_assoc($jg_busqueda4)); ?>
								   <?php } else { ?>
								   <input type="text" class="form-control sinborde"  id="nombre" name="nombre" readonly>
		                    	</div>
		                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
								   <?php } ?>
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-4">Direccion Actual</label>
			                        <input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['dir_act']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-lg-4">Barrio Actual</label>
		                        	<input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['barrio']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-lg-4">Número Matricula</label>
		                        	<input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['nor_matricula']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-lg-4">Número Catrasto</label>
		                        	<input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['nor_car']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-lg-4">Clasificación Suelo</label>
		                        	<input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['clasificacion_suelo']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                		<label for="apellido" class="col-form-label col-lg-4">Planimetria del Lote</label>
		                        	<input type="text" class="form-control sinborde"  id="apellido" name="apellido" <?php echo "value='".$result_busqueda['planimetria_lote']."' readonly"; ?> >
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4">Titular (es)</label>
			                       <?php if($totalrows_result_busqueda3 > 0){ ?>
							       	<?php do { ?>
								    <input type="text" class="form-control sinborde"  id="nombre" name="nombre" <?php echo "value='".$result_busqueda3['titular']."' readonly "; ?>>
		                    	</div>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
			                        <?php } while ($result_busqueda3 = mysqli_fetch_assoc($jg_busqueda3)); ?>
								   <?php } else { ?>
								   <input type="text" class="form-control sinborde"  id="nombre" name="nombre" readonly>
		                    	</div>
		                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
								   <?php } ?>
		                    	</div>
		                       	<?php if($totalrows_result_busqueda5 > 0){ 
		                       	 do { ?>
		                    	<div class="col-lg-12 input-group">
			                       <label for="nombre" class="col-form-label col-lg-4"><?php echo $result_busqueda5['profesion']; ?></label>
								   					 <input type="text" class="form-control sinborde"  id="nombre" name="nombre" <?php echo "value='".$result_busqueda5['profesional']."' readonly "; ?>>
		                    	</div>
		                        <?php } while ($result_busqueda5 = mysqli_fetch_assoc($jg_busqueda5)); ?>
		                    	<div class="col-lg-12 input-group">
							   					<?php } else { ?>
			                       <label for="nombre" class="col-form-label col-lg-4">Profesional (es)</label>
								   <input type="text" class="form-control sinborde"  id="nombre" name="nombre" readonly>
		                    	</div>
		                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
			                       <label for="nombre" class="col-form-label col-lg-4"></label>
								 <?php } ?>
		                    	</div>
	                      	</div>
	                      	<div class="col-lg-5 input-group">
		                    	<div class="col-lg-12 input-group">
			                    	<div class="col-lg-12 input-group">
<?php 
							  $qsl13 = sprintf("SELECT doc.nombre 
																	FROM rad_docs rd 
																	    INNER JOIN lic_doc ld on ld.id_lic_doc = rd.id_lic_doc
																	    INNER JOIN radicado_documentos doc on doc.id_documento = ld.id_lic_doc
																	WHERE rd.id_rad = '%s'", $nro_rad);
						    $result_docs1 =$mysqli->query($qsl13);
						    // $filas = mysqli_num_rows($result_docs); ?>

				                        <label for="nombre" class="col-form-label col-3">Documentos Faltantes</label>
				                        <input type="text" class="form-control"  id="nombre" name="nombre" >

				                        <?php 
				                        	while ( $result_docs = mysqli_fetch_array($result_docs1)) {
				                        		?>

																<label for="nombre" class="col-form-label col-lg-4"><?php echo $result_docs['nombre']; ?></label>
				                        		<?php } ?>
			                    	</div>
		                    	</div>
	                      	</div>
	                    </div>
	                    <div class="col-lg-12 input-group">
							<div class="col-lg-12 input-group">
		                    	<div class="col-lg-12 form-group"></div>
		                    	<div class="col-lg-12 form-group"></div>
		                    	<div class="col-lg-12 form-group"></div>
		                    	<div class="col-lg-12 input-group">
	                    			<label for="" class="col-form-label col-4">Observaciones</label>
								</div>
		                    	<div class="col-lg-11 input-group">
		                    		<textarea type="text" class="form-control"></textarea>
		                    	</div>

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
                  <div class="col-lg-12  input-group">
	                <div class="col-lg-3"></div>  
	                <button class="btn btn-danger col-lg-2" type="submit" name="submit" id="submit" >Comentar</button>
	                <div class="col-lg-1"></div>              
	                <button class="btn btn-default col-lg-2" type="submit" id="cancelar" name="cancelar" value="9" formaction="../../functions/routes.php">Cancelar</button>
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




 