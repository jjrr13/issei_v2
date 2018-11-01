
<?php 
	require_once('../../lib/pdf/mpdf.php');
	require_once('../../../cx/cx.php');
	
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	

	date_default_timezone_set('America/Bogota');
	setlocale(LC_TIME, 'es_CO');
	$fecha_creator=date("Y-m-d");
	$fecha_creator_h=date("H-i-s");
	$fecha_registro = date('Y-m-d H:i:s');//fecha actual.
	$fecha_dia = strftime('%d');
	$fecha_mes = strftime('%m');
	$fecha_year = strftime('%Y');
	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_tipousuario']; 
	$_SESSION['id_area'];
	
	$mes=date("F");

	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Setiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";

	
	$fecha_ini = $_POST['f_ini'];
	$fecha_fin = $_POST['f_fin'];
	$observaciones= $_POST['obs'];
	$usuario = $_SESSION['id_usuario'];

	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda1 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}'  AND c.visitador = 9
								GROUP BY c.numero_licencia");
	$jg_busqueda1 =$mysqli->query($query_busqueda1);
	$result_busqueda1 = mysqli_fetch_assoc($jg_busqueda1);
	$totalrows_result_busqueda1 = mysqli_num_rows($jg_busqueda1);

	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda2 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}' AND c.visitador = 12
								GROUP BY c.numero_licencia");
	$jg_busqueda2 =$mysqli->query($query_busqueda2);
	$result_busqueda2 = mysqli_fetch_assoc($jg_busqueda2);
	$totalrows_result_busqueda2 = mysqli_num_rows($jg_busqueda2);
	
	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda3 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}'  AND c.visitador = 5
								GROUP BY c.numero_licencia");
	$jg_busqueda3 =$mysqli->query($query_busqueda3);
	$result_busqueda3 = mysqli_fetch_assoc($jg_busqueda3);
	$totalrows_result_busqueda3 = mysqli_num_rows($jg_busqueda3);

	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda4 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}' AND c.visitador = 10
								GROUP BY c.numero_licencia");
	$jg_busqueda4 =$mysqli->query($query_busqueda4);
	$result_busqueda4 = mysqli_fetch_assoc($jg_busqueda4);
	$totalrows_result_busqueda4 = mysqli_num_rows($jg_busqueda4);
	
	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda5 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}'  AND c.visitador = 6
								GROUP BY c.numero_licencia");
	$jg_busqueda5 =$mysqli->query($query_busqueda5);
	$result_busqueda5 = mysqli_fetch_assoc($jg_busqueda5);
	$totalrows_result_busqueda5 = mysqli_num_rows($jg_busqueda5);

	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda6 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}' AND c.visitador = 8
								GROUP BY c.numero_licencia");
	$jg_busqueda6 =$mysqli->query($query_busqueda6);
	$result_busqueda6 = mysqli_fetch_assoc($jg_busqueda6);
	$totalrows_result_busqueda6 = mysqli_num_rows($jg_busqueda6);
	
	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda7 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}'  AND c.visitador = 11
								GROUP BY c.numero_licencia");
	$jg_busqueda7 =$mysqli->query($query_busqueda7);
	$result_busqueda7 = mysqli_fetch_assoc($jg_busqueda7);
	$totalrows_result_busqueda7 = mysqli_num_rows($jg_busqueda7);

	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda8 = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita, c.visitador, CONCAT(t1.nombres,' ',t1.apellidos) as arquitecto
								FROM terceros t 
                                	INNER JOIN barrio b ON b.id_barrio = t.id_barrio
                                    INNER JOIN clater c ON t.nit = c.nit
                                    INNER JOIN usuarios u ON u.id_usuario = c.visitador
                                    INNER JOIN terceros t1 ON t1.nit = u.nit
								WHERE c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}' AND c.visitador = 7
								GROUP BY c.numero_licencia");
	$jg_busqueda8 =$mysqli->query($query_busqueda8);
	$result_busqueda8 = mysqli_fetch_assoc($jg_busqueda8);
	$totalrows_result_busqueda8 = mysqli_num_rows($jg_busqueda8);
	
	


	$query_consulta = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre
								FROM terceros t, usuarios u
								WHERE t.nit = u.nit AND u.id_usuario ='{$usuario}'
								");
	$jg_consulta =$mysqli->query($query_consulta);
	$result_consulta = mysqli_fetch_assoc($jg_consulta);
	$totalrows_result_consulta = mysqli_num_rows($jg_consulta);

	$nro_orden = "0001";


	echo '
		  ';


	$html = '
	<<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Informe 1</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="clearfix" style="margin-bottom: 0px !important;">
		  <table>
			<thead>
			  <tr>
				<th class="">
					<div>
						<img src="img/logo.png">
				  	</div>
				</th>
				<th class="">
					<div class="recuadro">
						<div>
							<span style="font-size: 1.7em;">ORDEN DE SERVICIO</span>
						</div>
						<div>
							<span style="font-size: 0.5em;">EVENTOS Y/O AGLOMERACIONES</span>
						</div>
				  	</div>
				</th>
			  </tr>
			</thead>
		  </table>
		  <div  style="text-align: right;">
   			<div>
   				<strong><span style="font-size: 1.26em;">'; $html .='<div>Fecha: '.$fecha_dia.'/'.$fecha_mes.'/'.$fecha_year.'</span></strong>
   			</div>
			<div>
				<strong><span style="font-size: 1.26em;">O.S. No. '.$nro_orden.'</span></strong>
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
					<th class="" style="text-align: left;">
						<div>
							<strong>
								<label for="" style="font-size: 1.2em;">Descripción</label>
							</strong>
						</div>
					</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td class="" style="text-align: justify; height: 85px;">
						<div>
							<span>
								Programación del personal para los eventos y/o aglomeraciones establecidas entre el '.$fecha_dia.' de '.$mes.' al '.$fecha_dia.' de '.$mes.' del '.$fecha_year.', se adjunta cuadro de eventos con especificaciones emitido por la oficina de eventos y aglomeraciones. 
								<br>
								<br>
								<br>
								<br>
							</span>
						</div>
					</td>
				  </tr>
				</tbody>
			  </table>
			  <br>
			  <br>
			  <br>
			  <br>
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
					<th class="" style="text-align: left;" colspan="3">
						<div>
							<strong>
								<label for="" style="font-size: 1.05em; text-align: justify;">REQUERIDO POR: Maria Luisa Gonzalez Grueso - Profesional Universitario</label>
							</strong>
						</div>
					</th>
				  </tr>
				  <tr>
					<th class="" style="text-align: center;" colspan="3">
						<div>
							<strong>
								<label for="" style="font-size: 1.05em;">CONSTANCIA DE RECIBIDO</label>
							</strong>
						</div>
					</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td class="" style="text-align: center; height: 25px; width: 550px;">
						<div>
							<span>
								<strong>Personal</strong>
							</span>
						</div>
					</td>
					<td class="" style="text-align: center; height: 25px; border-left: 1px solid #C1CED9;">
						<div>
							<span>
								<strong>Firma</strong>
							</span>
						</div>
					</td>
				  </tr>
				  <tr>
					<td class="" style="text-align: justify; height: 25px; width: 550px;">
						<div>
							<span>
								Personal 
							</span>
						</div>
					</td>
					<td class="" style="text-align: justify; height: 25px; border-left: 1px solid #C1CED9;">
						<div>
							<span>
								Firma 
							</span>
						</div>
					</td>
				  </tr>
				  <tr>
					<td class="" style="text-align: justify; height: 25px; width: 550px;">
						<div>
							<span>
								Personal 
							</span>
						</div>
					</td>
					<td class="" style="text-align: justify; height: 25px; border-left: 1px solid #C1CED9;">
						<div>
							<span>
								Firma 
							</span>
						</div>
					</td>
				  </tr>
				  <tr>
					<td class="" style="text-align: justify; height: 25px; width: 550px;">
						<div>
							<span>
								Personal 
							</span>
						</div>
					</td>
					<td class="" style="text-align: justify; height: 25px; border-left: 1px solid #C1CED9;">
						<div>
							<span>
								Firma 
							</span>
						</div>
					</td>
				  </tr>
				</tbody>
			  </table>
			</main>
			<footer>
				<div class="notice">Se advierte que cualquier divulgación, distribución, copia o acción relacionada al contenido de esta comunicación, sin la previa autorización del Supervisor del área, está totalmente prohibida.</div></footer>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div></div>
			<div><h5>Proyectó y Elaboró: USUARIO</h5></div>
			<div></div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
	</body>
	</html>';
			// 	 do {
					
			// 		$html .='<tr>
			// 					<td class="service">'.$result_busqueda6['fecha_visita'].'</td>
			// 					<td class="desc">'.$result_busqueda6['nro_lic'].'</td>
			// 					<td class="desc">'.$result_busqueda6['fecha_licencia'].'</td>
			// 					<td class="desc">'.$result_busqueda6['nombre'].'</td>
			// 					<td class="desc">'.$result_busqueda6['direccion'].'</td>
			// 					<td class="desc">'.$result_busqueda6['barrio'].'</td>
			// 					<td class="desc">'.$result_busqueda6['comuna'].'</td>
			// 				  </tr>';
			// 	}while($result_busqueda6 = mysqli_fetch_assoc($jg_busqueda6)); 
			// 	$html .='
			// 	</tbody>
			//   </table>
			//   <table>
			//   	<tr >
			// 		<th colspan="5" class="desc">ARQUITECTO JULIO ANDRES FERNANDEZ ROBLES </th>
			// 	</tr>
			// 	<thead>
			// 	  <tr>
			// 		<th class="service">Fecha Visita</th>
			// 		<th class="desc">Licencia</th>
			// 		<th class="desc">Fecha Licencia</th>
			// 		<th class="desc">Titular Licencia</th>
			// 		<th class="desc">Direcci&oacute;n</th>
			// 		<th class="desc">Barrio</th>
			// 		<th class="desc">Comuna</th>
			// 	  </tr>
			// 	</thead>
			// 	<tbody>';
			// 	 do {
					
			// 		$html .='<tr>
			// 					<td class="service">'.$result_busqueda7['fecha_visita'].'</td>
			// 					<td class="desc">'.$result_busqueda7['nro_lic'].'</td>
			// 					<td class="desc">'.$result_busqueda7['fecha_licencia'].'</td>
			// 					<td class="desc">'.$result_busqueda7['nombre'].'</td>
			// 					<td class="desc">'.$result_busqueda7['direccion'].'</td>
			// 					<td class="desc">'.$result_busqueda7['barrio'].'</td>
			// 					<td class="desc">'.$result_busqueda7['comuna'].'</td>
			// 				  </tr>';
			// 	}while($result_busqueda7 = mysqli_fetch_assoc($jg_busqueda7)); 
			// 	$html .='
			// 	</tbody>
			//   </table>
			//   <table>
			//   	<tr >
			// 		<th colspan="7" class="desc">ARQUITECTO ROSALBINA AVILA LORA </th>
			// 	</tr>
			// 	<thead>
			// 	  <tr>
			// 		<th class="service">Fecha Visita</th>
			// 		<th class="desc">Licencia</th>
			// 		<th class="desc">Fecha Licencia</th>
			// 		<th class="desc">Titular Licencia</th>
			// 		<th class="desc">Direcci&oacute;n</th>
			// 		<th class="desc">Barrio</th>
			// 		<th class="desc">Comuna</th>
			// 	  </tr>
			// 	</thead>
			// 	<tbody>';
			// 	 do {
					
			// 		$html .='<tr>
			// 					<td class="service">'.$result_busqueda8['fecha_visita'].'</td>
			// 					<td class="desc">'.$result_busqueda8['nro_lic'].'</td>
			// 					<td class="desc">'.$result_busqueda8['fecha_licencia'].'</td>
			// 					<td class="desc">'.$result_busqueda8['nombre'].'</td>
			// 					<td class="desc">'.$result_busqueda8['direccion'].'</td>
			// 					<td class="desc">'.$result_busqueda8['barrio'].'</td>
			// 					<td class="desc">'.$result_busqueda8['comuna'].'</td>
			// 				  </tr>';
			// 	}while($result_busqueda8 = mysqli_fetch_assoc($jg_busqueda8)); 
			// 	$html .='
			// 	</tbody>
			//   </table>
			// </main>
			// <footer>
			// 	<div class="notice">Se advierte que cualquier divulgación, distribución, copia o acción relacionada al contenido de esta comunicación, sin la previa autorización del Supervisor del área, está totalmente prohibida.</div></footer>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			// <div><h3>JORGE HECTOR MANOSALVA MALAVER <br>
			// Profesional Universitario - SIVC</h3></div>
			// <div></div>
			// <div><h5>Proyectó y Elaboró: AMPARO RAMIREZ MORENO</h5></div>
			// <div></div>
			// <div>&nbsp;</div>
			// <div>&nbsp;</div>
			
			// </body>
			// </html>';

	$name_mpdf = 'clater '.$fecha_creator.' '.$fecha_creator_h.'.pdf';
	$location = 'report/';
	$mpdf = new mPDF('c','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($location.$name_mpdf, 'F');
	$mpdf->Output($name_mpdf, 'I');
	

	

?>

