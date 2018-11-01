
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

	

	$html = '
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Informe 1</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
	<header class="clearfix">
			  <div id="logo">
				<img src="img/logo.png">
			  </div>
			  <h1>INFORME CONTROL POSTERIOR</h1>
			  <div id="project">';
				 
					
					$html .='<div>Santiago de Cali, '.$fecha_dia.' de '.$mes.' del '.$fecha_year.'</div>';
					
					$html .='
				<div>&nbsp;</div>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
				<div class="sm-text"><strong>SAMIR JALIL PAZ</strong></div>
				<div>Subsecretario de Inspecci&oacute;n Vigilacia y Control </div>
				<div>La Ciudad</div>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
				<div><strong>ASUNTO:</strong> Informe Mensual</div>
				<div>&nbsp;</div>
				<div>'.$observaciones.'</div>
			  </div>
			</header>
			<main>
			  <table>
			  	<tr >
					<th colspan="5" class="desc">ARQUITECTO DIEGO ESCOBAR BERRIO</th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda1['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda1['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda1['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda1['nombre'].'</td>
								<td class="desc">'.$result_busqueda1['direccion'].'</td>
								<td class="desc">'.$result_busqueda1['barrio'].'</td>
								<td class="desc">'.$result_busqueda1['comuna'].'</td>
							  </tr>';
				}while($result_busqueda1 = mysqli_fetch_assoc($jg_busqueda1)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="7" class="desc">ARQUITECTO EDUARDO SILVA </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda2['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda2['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda2['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda2['nombre'].'</td>
								<td class="desc">'.$result_busqueda2['direccion'].'</td>
								<td class="desc">'.$result_busqueda2['barrio'].'</td>
								<td class="desc">'.$result_busqueda2['comuna'].'</td>
							  </tr>';
				}while($result_busqueda2 = mysqli_fetch_assoc($jg_busqueda2)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="5" class="desc">ARQUITECTO EDWIN OBONADA PALAU </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda3['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda3['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda3['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda3['nombre'].'</td>
								<td class="desc">'.$result_busqueda3['direccion'].'</td>
								<td class="desc">'.$result_busqueda3['barrio'].'</td>
								<td class="desc">'.$result_busqueda3['comuna'].'</td>
							  </tr>';
				}while($result_busqueda3 = mysqli_fetch_assoc($jg_busqueda3)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="7" class="desc">ARQUITECTO FRANCISCO JOSE MARTINEZ BALCAZAR </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda4['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda4['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda4['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda4['nombre'].'</td>
								<td class="desc">'.$result_busqueda4['direccion'].'</td>
								<td class="desc">'.$result_busqueda4['barrio'].'</td>
								<td class="desc">'.$result_busqueda4['comuna'].'</td>
							  </tr>';
				}while($result_busqueda4 = mysqli_fetch_assoc($jg_busqueda4)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="5" class="desc">ARQUITECTO GERMAN ARDILA PALOMINO </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda5['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda5['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda5['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda5['nombre'].'</td>
								<td class="desc">'.$result_busqueda5['direccion'].'</td>
								<td class="desc">'.$result_busqueda5['barrio'].'</td>
								<td class="desc">'.$result_busqueda5['comuna'].'</td>
							  </tr>';
				}while($result_busqueda5 = mysqli_fetch_assoc($jg_busqueda5)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="7" class="desc">ARQUITECTO JAIME LEON PEREA FIGUEROA </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda6['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda6['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda6['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda6['nombre'].'</td>
								<td class="desc">'.$result_busqueda6['direccion'].'</td>
								<td class="desc">'.$result_busqueda6['barrio'].'</td>
								<td class="desc">'.$result_busqueda6['comuna'].'</td>
							  </tr>';
				}while($result_busqueda6 = mysqli_fetch_assoc($jg_busqueda6)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="5" class="desc">ARQUITECTO JULIO ANDRES FERNANDEZ ROBLES </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda7['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda7['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda7['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda7['nombre'].'</td>
								<td class="desc">'.$result_busqueda7['direccion'].'</td>
								<td class="desc">'.$result_busqueda7['barrio'].'</td>
								<td class="desc">'.$result_busqueda7['comuna'].'</td>
							  </tr>';
				}while($result_busqueda7 = mysqli_fetch_assoc($jg_busqueda7)); 
				$html .='
				</tbody>
			  </table>
			  <table>
			  	<tr >
					<th colspan="7" class="desc">ARQUITECTO ROSALBINA AVILA LORA </th>
				</tr>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Fecha Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda8['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda8['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda8['fecha_licencia'].'</td>
								<td class="desc">'.$result_busqueda8['nombre'].'</td>
								<td class="desc">'.$result_busqueda8['direccion'].'</td>
								<td class="desc">'.$result_busqueda8['barrio'].'</td>
								<td class="desc">'.$result_busqueda8['comuna'].'</td>
							  </tr>';
				}while($result_busqueda8 = mysqli_fetch_assoc($jg_busqueda8)); 
				$html .='
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
			<div><h3>JORGE HECTOR MANOSALVA MALAVER <br>
			Profesional Universitario - SIVC</h3></div>
			<div></div>
			<div><h5>Proyectó y Elaboró: AMPARO RAMIREZ MORENO</h5></div>
			<div></div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			
			</body>
			</html>';

	$name_mpdf = 'clater '.$fecha_creator.' '.$fecha_creator_h.'.pdf';
	$location = 'report/';
	$mpdf = new mPDF('c','A4');
	$mpdf->WriteHTML($html);
	$mpdf->Output($location.$name_mpdf, 'F');
	$mpdf->Output($name_mpdf, 'I');
	

	

?>

