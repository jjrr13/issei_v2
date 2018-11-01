
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

	
	$query_busqueda = sprintf("SELECT CONCAT(t.nombres,' ',t.apellidos) as nombre, t.direccion, t.estrato, b.*, 
								case when c.curaduria in (1,2) then concat('76001',c.numero_licencia) else concat('CU',c.numero_licencia) end as nro_lic, c.curaduria, c.tipo_licencia, c.fecha_licencia, c.cantidad_lic, c.vigencia, c.fecha_visita
								FROM terceros t, barrio b, clater c
								WHERE b.id_barrio = t.id_barrio AND t.nit = c.nit AND c.fecha_visita BETWEEN '{$fecha_ini}' AND '{$fecha_fin}'
								GROUP by c.numero_licencia");
	$jg_busqueda =$mysqli->query($query_busqueda);
	$result_busqueda = mysqli_fetch_assoc($jg_busqueda);
	$totalrows_result_busqueda = mysqli_num_rows($jg_busqueda);
	
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
		<title>Document</title>
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
				<div><strong>ASUNTO:</strong> INFORME MENSUAL</div>
				<div>&nbsp;</div>
				<div>'.$observaciones.'</div>
			  </div>
			</header>
			<main>
			  <table>
				<thead>
				  <tr>
					<th class="service">Fecha Visita</th>
					<th class="desc">Licencia</th>
					<th class="desc">Titular Licencia</th>
					<th class="desc">Direcci&oacute;n</th>
					<th class="desc">Barrio</th>
					<th class="desc">Comuna</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda['fecha_visita'].'</td>
								<td class="desc">'.$result_busqueda['nro_lic'].'</td>
								<td class="desc">'.$result_busqueda['nombre'].'</td>
								<td class="desc">'.$result_busqueda['direccion'].'</td>
								<td class="desc">'.$result_busqueda['barrio'].'</td>
								<td class="desc">'.$result_busqueda['comuna'].'</td>
							  </tr>';
				}while($result_busqueda = mysqli_fetch_assoc($jg_busqueda)); 
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
	$mpdf->Output($location.$name_mpdf, 'I');
	$mpdf->Output($name_mpdf, 'I');
	

	

?>

