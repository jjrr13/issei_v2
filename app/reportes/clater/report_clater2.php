
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

	
	$fecha_inis1 = $_POST['f_inis1'];
	$fecha_fins1 = $_POST['f_fins1'];
	$fecha_inis2 = $_POST['f_inis2'];
	$fecha_fins2 = $_POST['f_fins2'];
	$fecha_inis3 = $_POST['f_inis3'];
	$fecha_fins3 = $_POST['f_fins3'];
	$fecha_inis4 = $_POST['f_inis4'];
	$fecha_fins4 = $_POST['f_fins4'];
	
	$observaciones= $_POST['obs'];
	$usuario = $_SESSION['id_usuario'];

	//consulta que trae la informacion de la base de datos clater para el informe.
	$query_busqueda = sprintf("SELECT DISTINCT CONCAT(t.nombres, ' ', t.apellidos) AS profesional,40 AS visitas_asignadas , 
							   CASE WHEN c.fecha_visita BETWEEN '{$fecha_inis1}' AND '{$fecha_fins1}' THEN COUNT(c.nit) ELSE 0 END Semana1,  CASE WHEN c.fecha_visita BETWEEN '{$fecha_inis2}' AND '{$fecha_fins2}' THEN COUNT(c.nit) ELSE 0 END Semana2,  CASE WHEN c.fecha_visita BETWEEN '{$fecha_inis3}' AND '{$fecha_fins3}' THEN COUNT(c.nit) ELSE 0 END Semana3,  CASE WHEN c.fecha_visita BETWEEN '{$fecha_inis4}' AND '{$fecha_fins4}' THEN COUNT(c.nit) ELSE 0 END Semana4
							   FROM clater c 
							   	INNER JOIN usuarios u on u.id_usuario = c.visitador 
							   	INNER JOIN terceros t on t.nit = u.nit 
							   GROUP BY c.visitador
							   ORDER BY profesional ASC");
	$jg_busqueda =$mysqli->query($query_busqueda);
	$result_busqueda = mysqli_fetch_assoc($jg_busqueda);
	$totalrows_result_busqueda = mysqli_num_rows($jg_busqueda);
	
	$visitasasig = 40;
	$pendientes = $visitasasig-$result_busqueda['Semana1']-$result_busqueda['Semana2']-$result_busqueda['Semana3']-$result_busqueda['Semana4'];




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
				<div><strong>ASUNTO:</strong> Informe Semanal de Visitas</div>
				<div>&nbsp;</div>
				<div>'.$observaciones.'</div>
			  </div>
			</header>
			<main>
			  <table>
				<thead>
				  <tr>
					<th class="service">Arquitecto</th>
					<th class="desc">Visitas Asignadas</th>
					<th class="desc">Semana 1</th>
					<th class="desc">Semana 2</th>
					<th class="desc">Semana 3</th>
					<th class="desc">Semana 4</th>
					<th class="desc">Pendientes</th>
				  </tr>
				</thead>
				<tbody>';
				 do {
					
					$html .='<tr>
								<td class="service">'.$result_busqueda['profesional'].'</td>
								<td class="desc">'.$result_busqueda['visitas_asignadas'].'</td>
								<td class="desc">'.$result_busqueda['Semana1'].'</td>
								<td class="desc">'.$result_busqueda['Semana2'].'</td>
								<td class="desc">'.$result_busqueda['Semana3'].'</td>
								<td class="desc">'.$result_busqueda['Semana4'].'</td>
								<td class="desc">'.$pendientes.'</td>
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
	$mpdf->Output($location.$name_mpdf, 'F');
	$mpdf->Output($name_mpdf, 'I');
	

	

?>

