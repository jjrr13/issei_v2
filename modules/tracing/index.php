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

	console($_SESSION['id_area']);
	console($_SESSION['id_usuario']);

$usuarioArea = $_SESSION['id_area'];	
$usuarioId = $_SESSION['id_usuario'];

$mueveTodo= false;

if ($usuarioArea == 10 || $usuarioArea == 4 || $usuarioArea == 7 || $usuarioArea == 9 ) {
	$mueveTodo = true;
}
//|| $_SESSION['id_tipo_usuario'] != 1
  //If the variable does not exist, destroy the session
  if (empty($_SESSION['id_usuario']) ) {
      header("location: ../../cx/destroy_session.php");
    }
    $nro_rad = '760011190045' ;
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
										<div class="col-lg-12 input-group"></div>
	                </div>
                  <div class="col-lg-5  input-group">
										<div class="col-lg-12 input-group">
											<label for="" class="col-form-label col-lg-3">&nbsp;&nbsp;Radicado </label>
											<input type="text" value="76001-1-" class="form-control col-lg-2" readonly>
											<input type="text" min="0"  class="form-control col-lg-2" id="" name="" onkeypress="return ValidNum(event)" maxlength="6" autofocus>
											<button type="submit" class="btn btn-danger btn-sm col-lg-2" id="buscar" formaction="../../controller/user_controller.php">Buscar&nbsp;</button>
										</div>
									</div>
                </div>
                <div class="form-group col-lg-12 "></div>
                <div class="form-group col-lg-12 "></div>
                <div class="col-lg-12 input-group">
                	<div class="col-lg-6 input-group">
                  	<div class="col-lg-12 input-group">
                        <label for="nombre" class="col-form-label col-4">Número Radicado</label>
                        <input type="text" class="form-control sinborde"  id="nombre" <?php echo "value='".$nro_rad."' readonly "; ?>>
                        <input type="text" hidden="" id="nombre2" name="radicado" <?php echo "value='".$nro_rad."' "; ?>>
                  	</div>
                  	<div class="col-lg-12 input-group">
                			<label for="apellido" class="col-form-label col-lg-4">Objecto Tramite</label>
                      <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".$result_busqueda['nombre_objetivo']."' readonly"; ?> >
                  	</div>
                  	<div class="col-lg-12 input-group">
                       <label for="nombre" class="col-form-label col-lg-4">Usos</label>
                       <?php 
                       if($totalrows_result_busqueda2 > 0){ 
                       		do { ?>
					    							<input type="text" class="form-control sinborde"  id="nombre" <?php echo "value='".$result_busqueda2['nombre']."' readonly "; ?>>
                  	</div>
                    	<div class="col-lg-12 input-group">
	                      <label for="nombre" class="col-form-label col-lg-4"></label>
		                    <?php 
		                   		} while ($result_busqueda2 = mysqli_fetch_assoc($jg_busqueda2));
										    } else { ?>
										   			<input type="text" class="form-control sinborde"  id="nombre" readonly>
				              </div>
                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
	                      <label for="nombre" class="col-form-label col-lg-4"></label>
										   <?php } ?>
	                    </div>
                    	<div class="col-lg-12 input-group">
	                       <label for="nombre" class="col-form-label col-lg-4">Licencia / Modalidad</label>
		                  	<?php 
		                  	if($totalrows_result_busqueda4 > 0){  
                  				do { ?>
					    							<input type="text" class="form-control sinborde"  id="nombre" <?php echo "value='".$result_busqueda4['modalidad']."' readonly "; ?>>
	                    </div>
	                    <div class="col-lg-12 input-group">
		                    <label for="nombre" class="col-form-label col-lg-4"></label>
		                        <?php 
		                      		} while ($result_busqueda4 = mysqli_fetch_assoc($jg_busqueda4)); 
		                      	} else { ?>
							   							<input type="text" class="form-control sinborde"  id="nombre" readonly>
	                    </div>
                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
	                       <label for="nombre" class="col-form-label col-lg-4"></label>
							   						<?php } ?>
	                    </div>
                    	<div class="col-lg-12 input-group">
		                		<label for="apellido" class="col-form-label col-4">Direccion Actual</label>
		                    <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".$result_busqueda['dir_act']."' readonly"; ?> >
                    	</div>
                    	<div class="col-lg-12 input-group">
	                			<label for="apellido" class="col-form-label col-lg-4">Barrio Actual</label>
                        <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".$result_busqueda['barrio']."' readonly"; ?> >
                    	</div>
                    	<div class="col-lg-12 input-group">
	                			<label for="apellido" class="col-form-label col-lg-4">Número Matricula</label>
                        <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".$result_busqueda['nor_matricula']."' readonly"; ?> >
                    	</div>
                    	<div class="col-lg-12 input-group">
	                			<label for="apellido" class="col-form-label col-lg-4">Número Catrasto</label>
                        <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".$result_busqueda['nor_car']."' readonly"; ?> >
                    	</div>
                    	<div class="col-lg-12 input-group">
	                			<label for="apellido" class="col-form-label col-lg-4">Clasificación Suelo</label>
                        <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".$result_busqueda['clasificacion_suelo']."' readonly"; ?> >
                    	</div>
                    	<div class="col-lg-12 input-group">
	                			<label for="apellido" class="col-form-label col-lg-4">Planimetria del Lote</label>
                        <input type="text" class="form-control sinborde"  id="apellido" <?php echo "value='".utf8_decode($result_busqueda['planimetria_lote'])."' readonly"; ?> >
                    	</div>
                    	<div class="col-lg-12 input-group">
	                      <label for="nombre" class="col-form-label col-lg-4">Titular (es)</label>
		                    <?php 
	                      if($totalrows_result_busqueda3 > 0){ 
                       		do { ?>
						   							<input type="text" class="form-control sinborde"  id="nombre" <?php echo "value='".$result_busqueda3['titular']."' readonly "; ?>>
	                    </div>
	                    <div class="col-lg-12 input-group">
		                    <label for="nombre" class="col-form-label col-lg-4"></label>
	                      <?php 
	                    		} while ($result_busqueda3 = mysqli_fetch_assoc($jg_busqueda3));
	                    	} else { ?>
						   						<input type="text" class="form-control sinborde"  id="nombre" readonly>
                    	</div>
                    	<div class="col-lg-12 input-group" style="height: 2px !important;">
	                       <label for="nombre" class="col-form-label col-lg-4"></label>
							   					<?php } ?>
	                    </div>
	                       	<?php 
	                       	if($totalrows_result_busqueda5 > 0){ 
	                       		do { ?>
				                    	<div class="col-lg-12 input-group">
					                      <label for="nombre" class="col-form-label col-lg-4"><?php echo $result_busqueda5['profesion']; ?></label>
										   					<input type="text" class="form-control sinborde"  id="nombre" <?php echo "value='".$result_busqueda5['profesional']."' readonly "; ?>>
				                    	</div>
	                        <?php 
	                      		} while ($result_busqueda5 = mysqli_fetch_assoc($jg_busqueda5)); ?>
	                    <div class="col-lg-12 input-group">
						   						<?php 
						   						} else { ?>
		                       	<label for="nombre" class="col-form-label col-lg-4">Profesional (es)</label>
							   						<input type="text" class="form-control sinborde"  id="nombre" readonly>
	                    </div>
	                    <div class="col-lg-12 input-group" style="height: 2px !important;">
		                    <label for="nombre" class="col-form-label col-lg-4"></label>
							 						<?php 
							 						} ?>
	                    </div>
                    </div>
                  	<div class="col-lg-5 input-group">
                    	<div class="col-lg-12 input-group">
												<?php 
											  $qsl13 = sprintf("SELECT doc.nombre, rd.id_rad_docs FROM rad_docs rd 
																					    INNER JOIN lic_doc ld on ld.id_lic_doc = rd.id_lic_doc
																					    INNER JOIN radicado_documentos doc on doc.id_documento = ld.id_lic_doc
																					WHERE estado = 1 AND rd.id_rad = '%s'", $nro_rad);
										    $result_docs1 =$mysqli->query($qsl13);
										    // $filas = mysqli_num_rows($result_docs); ?>

	                      <label for="nombre" class="col-form-label col-3">Documentos Faltantes</label>
	                      <!-- <input type="text" class="form-control"  id="nombre" > -->
												<div class="col-md-8">
		                      <?php 
		                      while ( $result_docs = mysqli_fetch_array($result_docs1)) {
		                      ?>	
		                    		<label class="checkbox-inline col-form-label col-lg-12" for="<?php  echo $result_docs['id_rad_docs']; ?>">
														<input type="checkbox" id="<?php  echo $result_docs['id_rad_docs']; ?>" name="docAportados[]" value="<?php  echo $result_docs['id_rad_docs']; ?>"> -<?php echo utf8_encode($result_docs['nombre']); ?>
														</label>
		                      <?php 
		                    	} ?>
	                      </div> <!-- Finaliza Documentos Faltantes -->
	                  		<div class="col-lg-12 input-group">
	                      	<label for="nombre" class="col-form-label col-3">Ubicacion del Proyecto</label>
	                      	<?php 
	                      	$qsl14 = sprintf("SELECT hr.id_usuario, hr.id_ubicacion
																				FROM hoja_ruta hr WHERE hr.id_rad = '%s'", $nro_rad);
									    		$resul_mover =$mysqli->query($qsl14);
									    		$resultadoUsuario = mysqli_fetch_assoc($resul_mover);
									    		$asignadoUsuarios = $resultadoUsuario['id_usuario'];
									    		$noUbicacion = $resultadoUsuario['id_ubicacion'];

									    		if ($asignadoUsuarios == $usuarioId || $mueveTodo==true) {

									    			$qsl15 = sprintf("SELECT nombre, id FROM hr_ubicaciones");
										    		$resul_mover1 =$mysqli->query($qsl15);

	                      		echo "<select name='ubicaciones' id='ubicaciones'  class='form-control col-md-9'>";
	                      			echo '<option value="">Seleccione</option>';
										    		while ( $datos = mysqli_fetch_array($resul_mover1) ) {
										    			$selected = ($noUbicacion == $datos['id'])? 'selected' : '';
	                      			echo '<option '.$selected.' value="'.$datos['id'].'">'.$datos['nombre'].'</option>';

										    		}
									    		}
									    		else{
	                        	$qsl15 = sprintf("SELECT hr.id_usuario, u.nombre, u.id FROM hoja_ruta hr 
																					    INNER JOIN hr_ubicaciones u on u.id = hr.id_ubicacion
																							WHERE hr.id_rad = '%s' ORDER BY hr.fecha_registro DESC
																							LIMIT 1", $nro_rad);
										    		$resul_mover1 =$mysqli->query($qsl15);
										    		$datos2 = mysqli_fetch_assoc($resul_mover1);

	                      		echo "<select id='ubicaciones' disabled='' class='form-control col-md-9'>";
										    			echo '<option value="'.$datos2['id_usuario'].'">'.$datos2['nombre'].'</option>';

									    		} ?>		
	                      	</select>
			                  </div><!--  Finaliza Ubicacion -->
			                </div> <!-- Finaliza div 1 -->
		                </div> <!-- Finaliza div 2 -->
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
	                  		<textarea type="text" name="observacion" class="form-control"></textarea>
	                  	</div>
										</div>
									</div>
	              </div> <!-- Finaliza div 3 -->
	            </div>  <!-- Finaliza div 4 -->
	            <div class="col-lg-12  input-group">
	              <div class="col-lg-6  input-group">
	                <label class="col-form-label col-lg-12 requerido">&nbsp;&nbsp;&nbsp;&nbsp;Los campos con (*) son obligatorios</label>
	              </div>
	            </div>
	          <!-- pendiente un div ??? revisar si falta un div de cierre en el card body -->
            <!-- /.card-body -->
            <div class="card-footer input-group">
              <div class="form-group col-lg-12 "></div>
              <div class="col-lg-12  input-group">
              	<div class="col-lg-3"></div>  
              	<button class="btn btn-danger col-lg-2" type="submit" name="submit" id="submit" formaction="../../controller/hruta_controller.php">Comentar</button>
              	<div class="col-lg-1"></div>              
              	<button class="btn btn-default col-lg-2" type="submit" id="cancelar" name="cancelar" value="9" formaction="../../controller/hruta_controller.php">Cancelar</button>
            	</div>
            	<div class="form-group col-lg-12 "></div>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- Comienzan los comentarios de la Hoja de Ruta -->
		    <div class="card card-primary">
		      <div class="card-header">
		        <center><h3 class="card-title">Comentarios</h3></center>
		      </div>
		      <!-- /.card-header -->
		      <!-- form start -->
		        <div class="card-body p-0">
		          <?php  ?>
		          <table  id="example1" class="table table-bordered table-striped">
		            <thead>
		              <tr>
		                <th style="display: none; ">Nit Agendado</th>
		                <th>Fecha</th>
		                <th>Emisor</th>
		                <th>Comentario</th>
		                <th>Ubicacion</th>
		              </tr>
		            </thead>
		            <tbody>
		              <?php 
							 		$fecha_hoy = date('Y-m-d');
							    $asignado = $_SESSION['id_usuario'];
							    // $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

							    $sql = "SELECT DATE_FORMAT(hr.fecha_registro,'%d - %M - %Y %H:%i:%s') AS fecha, CONCAT(t.nombre, ' ', t.apellido) AS nombre, hr.comentario, uh.nombre as ubicacion
														FROM hoja_ruta AS hr
																	INNER JOIN hr_ubicaciones uh on uh.id = hr.id_ubicacion
													        INNER JOIN radicacion AS r ON r.consecutivo = hr.id_rad
													        INNER JOIN usuarios AS u ON u.id_usuario = hr.id_usuario
													        INNER JOIN terceros AS t ON u.nit = t.nit
													    WHERE r.consecutivo = $nro_rad
													    ORDER BY hr.fecha_registro DESC";
							  
							    $result = $mysqli->query($sql);
							    $result2 = mysqli_fetch_assoc($result);
							    $rows = $result->num_rows;

		              if($rows>0){
		                do { ?>
		                  <tr>
		                    <td style="display: none;"><?php print_r($result2['nit']); ?></td>

		                    <td width="15%"><?php print_r($result2['fecha']); ?></td>
		                    <td width="20%"><?php print_r($result2['nombre']); ?></td>
		                    <td width="35%"><?php print_r($result2['comentario']); ?></td>
		                    <td width="35%"><?php print_r($result2['ubicacion']); ?></td>
		                  </tr>
		                <?php  } while ($result2 = mysqli_fetch_assoc($result)); 
		              }else{
		              echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY COMENTARIOS PARA ESTE PROYECTO<br></strong></center></td></tr>";
		              }
		              ?>
		            </tbody>
		          <?php  ?>
		          </table>
		        </div>
		    </div>
        <!-- Finaliza los comentario de la Hoja de Ruta -->
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




 