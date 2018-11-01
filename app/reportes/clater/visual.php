
<?php 
	// require_once('../../lib/pdf/mpdf.php');
	require_once('../../../cx/cx.php');
	
	session_start();
	// error_reporting(E_ERROR | E_WARNING | E_PARSE);
	

	date_default_timezone_set('America/Bogota');
	setlocale(LC_TIME, 'es_CO');
	$fecha_creator=date("Y-m-d");
	$fecha_registro = date('d/m/Y');//fecha actual.
	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_tipousuario']; 
	$_SESSION['id_area'];

	$fecha_ini = $_POST['f_ini'];
	$fecha_fin = $_POST['f_fin'];
	$observaciones= $_POST['obs'];
	$usuario = $_SESSION['id_usuario'];
	$sinspeccion = $_SESSION['ivcsinspeccion'];


	$query_usuario = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre_usuario, u.usuario
				                FROM terceros t, usuarios u
				                WHERE t.nit = u.nit AND u.id_usuario = '%s'", $usuario);
	$jg_usuario =$mysqli->query($query_usuario);
	$result_usuario = mysqli_fetch_assoc($jg_usuario);
	$totalrows_result_usuario = mysqli_num_rows($jg_usuario);



	$query_orden = sprintf("SELECT io.id_orden, io.nro_orden, io.descripcion, isi.descripcion as sujeto_inspeccion, LENGTH(io.nro_orden) AS cantidad, 
								   DAY(io.fecha_ini) AS dia_ini, MONTH(io.fecha_ini) AS mes_ini, YEAR(io.fecha_ini) AS ano_ini, DAY(io.fecha_fin) AS dia_fin,
								   MONTH(io.fecha_fin) AS mes_fin, YEAR(io.fecha_fin) AS ano_fin, io.user_creator
	                        FROM ivc_orden io
	                        	INNER JOIN ivc_sinspeccion isi on isi.id_sinspeccion = io.id_sinspeccion
	                      	WHERE io.id_sinspeccion = isi.id_sinspeccion AND io.id_sinspeccion = '%s' 
	                     	ORDER BY io.nro_orden DESC 
	                      	LIMIT 0, 1", $sinspeccion);
	$result = $mysqli->query($query_orden);
	$orden = mysqli_fetch_assoc($result);
	$totalrows_orden = mysqli_num_rows($result);


    $orden_nueva = $orden['nro_orden'];

    $cantidad = $orden['cantidad'];


    if (!empty($cantidad)) {

	    $nro_adicional = '';

	    switch ($cantidad) {
	    	case '1':
	    		$nro_adicional = '000';
	    		break;
	    	case '2':
	    		$nro_adicional = '00';
	    		break;
	    	case '3':
	    		$nro_adicional = '0';
	    		break;
	    	default:
	    		$nro_adicional = '';
	    		break;
	    }
    }

	$nro_orden = $nro_adicional.$orden_nueva;


	echo "<script>console.log('".$nro_orden."')</script>";


	$fecha_dia_ini = $orden['dia_ini'];
	$fecha_dia_fin = $orden['dia_fin'];
	$fecha_mes_ini = $orden['mes_ini'];
	$fecha_mes_fin = $orden['mes_fin'];
	$fecha_year_ini = $orden['ano_ini'];
	$fecha_year_fin = $orden['ano_fin'];



	echo "<script>console.log('".$fecha_dia_ini."')</script>";
	echo "<script>console.log('".$fecha_dia_fin."')</script>";
	echo "<script>console.log('".$fecha_mes_ini."')</script>";
	echo "<script>console.log('".$fecha_mes_fin."')</script>";
	echo "<script>console.log('".$fecha_year_ini."')</script>";
	echo "<script>console.log('".$fecha_year_fin."')</script>";


	$mes_ini=$fecha_mes_ini;

	if ($mes_ini=="1") $mes_ini="Enero";
	if ($mes_ini=="2") $mes_ini="Febrero";
	if ($mes_ini=="3") $mes_ini="Marzo";
	if ($mes_ini=="4") $mes_ini="Abril";
	if ($mes_ini=="5") $mes_ini="Mayo";
	if ($mes_ini=="6") $mes_ini="Junio";
	if ($mes_ini=="7") $mes_ini="Julio";
	if ($mes_ini=="8") $mes_ini="Agosto";
	if ($mes_ini=="9") $mes_ini="Setiembre";
	if ($mes_ini=="10") $mes_ini="Octubre";
	if ($mes_ini=="11") $mes_ini="Noviembre";
	if ($mes_ini=="12") $mes_ini="Diciembre";


	$j = date("F", $fecha_mes_ini);
	echo "<script>console.log('".$j."');</script>";

	$mes_fin=$fecha_mes_fin;

	if ($mes_fin=="1") $mes_fin="Enero";
	if ($mes_fin=="2") $mes_fin="Febrero";
	if ($mes_fin=="3") $mes_fin="Marzo";
	if ($mes_fin=="4") $mes_fin="Abril";
	if ($mes_fin=="5") $mes_fin="Mayo";
	if ($mes_fin=="6") $mes_fin="Junio";
	if ($mes_fin=="7") $mes_fin="Julio";
	if ($mes_fin=="8") $mes_fin="Agosto";
	if ($mes_fin=="9") $mes_fin="Setiembre";
	if ($mes_fin=="10") $mes_fin="Octubre";
	if ($mes_fin=="11") $mes_fin="Noviembre";
	if ($mes_fin=="12") $mes_fin="Diciembre";

	$id_orden =$orden['id_orden'];
	$query_jg_personal = sprintf("SELECT iop.id_inspecciones, iop.id_orden, iop.nit, CONCAT(t.nombres,' ',t.apellidos) as Personal 
								  FROM ivc_orden_personal iop
									INNER JOIN terceros t on t.nit = iop.nit
								  WHERE iop.id_orden = '%s'", $id_orden);
  
    $jg_personal = $mysqli->query($query_jg_personal);
    $result_personal = mysqli_fetch_assoc($jg_personal);
    $totalrows_result_personal = $jg_personal->num_rows;

    $query_jg_organismos = sprintf("SELECT ioo.id_inspecciones, ioo.id_orden, ior.organismos
									FROM ivc_orden as io
									  INNER JOIN ivc_orden_organismos ioo on ioo.id_orden = io.id_orden
                                      INNER JOIN ivc_organismos ior on ior.id_organismos = ioo.id_organismos
									WHERE ioo.id_orden = '%s' AND io.id_sinspeccion = 2", $id_orden);
  
    $jg_organismos = $mysqli->query($query_jg_organismos);
    $result_organismos = mysqli_fetch_assoc($jg_organismos);
    $totalrows_result_organismos = $jg_personal->num_rows;


							// $mes=date("F");

							// if ($mes=="January") $mes="Enero";
							// if ($mes=="February") $mes="Febrero";
							// if ($mes=="March") $mes="Marzo";
							// if ($mes=="April") $mes="Abril";
							// if ($mes=="May") $mes="Mayo";
							// if ($mes=="June") $mes="Junio";
							// if ($mes=="July") $mes="Julio";
							// if ($mes=="August") $mes="Agosto";
							// if ($mes=="September") $mes="Setiembre";
							// if ($mes=="October") $mes="Octubre";
							// if ($mes=="November") $mes="Noviembre";
							// if ($mes=="December") $mes="Diciembre";

	$descripcion_BD = $orden['descripcion'];
	$conver_descripcion_min = strtolower($descripcion_BD);
	$conver_descripcion_or = ucfirst($conver_descripcion_min);

	?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Informe 1</title>
		<link rel="stylesheet" href="css/style.css">
		<style type="text/css" media="print">
			.nomostrar {
				display:none
			}
		</style>
		<style>
			.btn {
			    display: inline-block;
			    font-weight: 400;
			    text-align: center;
			    white-space: nowrap;
			    vertical-align: middle;
			    user-select: none;
			    border: 1px solid transparent;
			    padding: .375rem .75rem;
			    font-size: 1rem;
			    line-height: 1.5;
			    border-radius: .25rem;
			    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			}
			.btn-info {
			    color: #fff;
			    background-color: #17a2b8;
			    border-color: #17a2b8;
			    box-shadow: 0 1px 1px rgba(0,0,0,.075);
			}
		</style>		
	</head>
	<body>
		<br>
		<br>
		<br>
		<br>
		<header class="clearfix" style="margin-bottom: 0px !important;">
			<table>
				<thead>
				  <tr>
					<th class=""  style="border-bottom: 0px solid #C1CED9;">
						<div>
							<img src="img/logo.png">
					  	</div>
					</th>
					<th class="" style="border-bottom: 0px solid #C1CED9;">
						<div class="recuadro">
							<div>
								<span style="font-size: 1.7em;">ORDEN DE SERVICIO</span>
							</div>
							<?php if ($sinspeccion == 1) { ?>
							<div>
								<span style="font-size: 0.5em;">EVENTOS Y/O AGLOMERACIONES</span>
							</div>
							<?php }else{ ?>
							<div>
								<span style="font-size: 0.5em;">ESTABLECIMIENTOS</span>
							</div>
							<?php } ?>
					  	</div>
					</th>
				  </tr>
				</thead>
			</table>
			<br>
		 	<br>
			<div  style="text-align: right;">
				<div>
					<strong><span style="font-size: 1.26em;">Fecha: <?php echo $fecha_registro; ?></span></strong>
				</div>
				<div>
					<strong><span style="font-size: 1.26em;">O.S. No. <?php echo $nro_orden ?></span></strong>
				</div>
				<div>
					<strong><span style="font-size: 1.26em;">Subsecretario de Inspecci&oacute;n,</span></strong>
				</div>
				<div>
					<strong><span style="font-size: 1.26em;">Vigilacia y Control</span></strong> 
				</div>
			</div>
		</header>
		<main>
			<table>
				<thead>
					<tr>
						<th class="" style="text-align: left; border: 1px solid #C1CED9;">
							<div>
								<strong>
									<label for="" style="font-size: 1.2em;">Descripción</label>
								</strong>
							</div>
						</th>
					</tr>
				</thead>
				<br>
				<br>
				<?php if ($sinspeccion == 1) { ?>
				<tbody>
					<tr>
						<td class="" style="text-align: justify; height: 85px; border: 1px solid #C1CED9;">
							<div>
								<span>
									Programación del personal para los eventos y/o aglomeraciones establecidas entre el <?php echo $fecha_dia_ini.' de '.$mes_ini.' del '.$fecha_year_ini.' al '.$fecha_dia_fin.' de '.$mes_fin.' del '.$fecha_year_fin; ?>, se adjunta cuadro de eventos con especificaciones emitido por la oficina de eventos y aglomeraciones. 
									<br>
									<br>
									<br>
									<br>
								</span>
							</div>
						</td>
					</tr>
				</tbody>
				<?php }else{ ?>
				<tbody>
					<tr>
						<td class="" style="text-align: justify; height: 85px; border: 1px solid #C1CED9;">
							<div>
								<span>
									<?php print_r($conver_descripcion_or); ?> 
									establecido entre el <?php echo $fecha_dia_ini.' de '.$mes_ini.' del '.$fecha_year_ini.' al '.$fecha_dia_fin.' de '.$mes_fin.' del '.$fecha_year_fin; ?>, y se convocan los siguientes organismos: 
									<ul>
               						 <?php if($totalrows_result_organismos>0){ ?>
	           						 	<?php do { ?>
											<li><?php print_r($result_organismos['organismos']); ?></li>
					                	<?php } while ($result_organismos = mysqli_fetch_assoc($jg_organismos)); ?>
									<?php } ?>
	           						</ul>
									<br>
								</span>
							</div>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
			<table>
				<thead>
					<tr>
						<th class="" style="text-align: left;" colspan="3">
							<div>
								<strong>
									<label for="" style="font-size: 1.05em;"></label>
								</strong>
							</div>
						</th>
					</tr>
					<tr>
						<th class="" style="text-align: left; border: 1px solid #C1CED9;" colspan="3">
							<div>
								<strong>
									<label for="" style="font-size: 1.05em; text-align: justify;">REQUERIDO POR: Maria Luisa Gonzalez Grueso - Profesional Universitario</label>
								</strong>
							</div>
						</th>
					</tr>
					<tr>
						<th class="" style="text-align: center; border: 1px solid #C1CED9;" colspan="3">
							<div>
								<strong>
									<label for="" style="font-size: 1.05em; ">CONSTANCIA DE RECIBIDO</label>
								</strong>
							</div>
						</th>
					</tr>
				</thead>
                <?php if($totalrows_result_personal>0){ ?>
				<tbody>
					<tr>
						<td class="" style="text-align: center; height: 25px; width: 550px; border: 1px solid #C1CED9;">
							<div>
								<span>
									<strong>Personal</strong>
								</span>
							</div>
						</td>
						<td class="" style="text-align: center; height: 25px; border: 1px solid #C1CED9;">
							<div>
								<span>
									<strong>Firma</strong>
								</span>
							</div>
						</td>
					</tr>
	            <?php do { ?>
					<tr>
						<td class="" style="text-align: justify; height: 25px; width: 550px; border: 1px solid #C1CED9;">
							<div>
								<span>
									<?php print_r($result_personal['Personal']); ?> 
								</span>
							</div>
						</td>
						<td class="" style="text-align: justify; height: 25px; border: 1px solid #C1CED9;">
							<div>
								<span>
								</span>
							</div>
						</td>
					</tr>
                <?php } while ($result_personal = mysqli_fetch_assoc($jg_personal)); ?>
				</tbody>
                <?php } ?>
			</table>
		</main>
		<footer>
			<div class="notice" style="border: none;">
				Se advierte que cualquier divulgación, distribución, copia o acción relacionada al contenido de esta comunicación, sin la previa autorización del Supervisor del área, está totalmente prohibida.
			</div>
		</footer>
		<br>
		<br>
		<div>
			<h5>
				<span>
					Proyectó y Elaboró: <?php print_r($result_usuario['nombre_usuario']); ?> - Contratista
				</span>
			</h5>
		</div>
		<div style="text-align: center;" class="nomostrar">
			<button type="image" class="btn btn-info" name="Submit" onclick="javascript:window.print()">
				Imprimir
			</button>
		</div>
	</body>
</html>