
<?php 
	require_once '../mpdf/vendor/autoload.php';
	// require_once('../lib/pdf/mpdf.php');
	require_once('../../cx/cx.php');
	include_once ('../../functions/globales.js');

	
	// session_start();
	// error_reporting(E_ERROR | E_WARNING | E_PARSE);
	

	date_default_timezone_set('America/Bogota');
	setlocale(LC_TIME, 'es_CO');
	$fecha_creator=date("Y-m-d");
	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_area'];

	$fecha_ini = "2018-01-01";
	$fecha_fin = "2018-12-31";
	$observaciones= "hola !";
	$usuario = $_SESSION['id_usuario'];


	$query_usuario = sprintf("SELECT CONCAT(t.nombre,' ',t.apellido) as nombre_usuario, u.usuario
				                FROM terceros t, usuarios u
				                WHERE t.nit = u.nit AND u.id_usuario = '%s'", $usuario);
	$jg_usuario =$mysqli->query($query_usuario);
	$result_usuario = mysqli_fetch_assoc($jg_usuario);
	$totalrows_result_usuario = mysqli_num_rows($jg_usuario);

	// echo "<script>console.log('".$nro_orden."')</script>";

	// $conver_hora = date("g:i a",strtotime($orden['hora']));
	// $hora = $orden['hora'];

	$mes=11;

	if ($mes=="1") $mes="Enero";
	if ($mes=="2") $mes="Febrero";
	if ($mes=="3") $mes="Marzo";
	if ($mes=="4") $mes="Abril";
	if ($mes=="5") $mes="Mayo";
	if ($mes=="6") $mes="Junio";
	if ($mes=="7") $mes="Julio";
	if ($mes=="8") $mes="Agosto";
	if ($mes=="9") $mes="Setiembre";
	if ($mes=="10") $mes="Octubre";
	if ($mes=="11") $mes="Noviembre";
	if ($mes=="12") $mes="Diciembre";

	$radicado = 760011180621;
	$proyecto = "VIVIENDA MULTIFAMILIAR";
	$direccion = "C 4B # 27 34 - SAN FERNANDO";
	$descripcion = "NO SE QUE SE VA A PONER AQUI";
	$descripcion2 = "AQUI SE VA A PONER LAS ORACIONES QUE YA EXISTEN EL EN MODULO DE LIQUIDACION DEPENDIENDO DE LA LICENCIA QUE HAYAN ESCOJIDO";
	?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Radicación</title>
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
			body {
				font-size: 16px;
			}
			body:after {
				content: "CU1"; 
				font-size: 15em;  
				color: rgba(195, 196, 196, 0.3);
				z-index: 9999;

				display: flex;
				align-items: center;
				justify-content: center;
				position: fixed;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;

				-webkit-pointer-events: none;
				-moz-pointer-events: none;
				-ms-pointer-events: none;
				-o-pointer-events: none;
				pointer-events: none;

				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				-o-user-select: none;
				user-select: none;
			}
			
		</style>
		<script></script>	
	</head>
	<body style="@page:left {
			  margin-left: 4cm !important;
			  margin-right: 3cm !important;
			}

			@page:right {
			  margin-left: 3cm !important;
			  margin-right: 4cm !important;
			}">
		<div class="container col-lg-12">
			<div class="col-lg-1"></div>
			<div class="col-lg-11">
				<br>
				<br>
				<br>
				<header class="clearfix" style="margin-bottom: 0px !important;">
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<table>
						<thead>
						  <tr>
							<th class="" style="border-bottom: 0px solid #C1CED9;">
								<div class="">
									
							  	</div>
							</th>
						  </tr>
						  <tr>
							<th class="" style="border-bottom: 0px solid #C1CED9;">
								<div class="">
									<div style="text-align: left;">
										<span style="font-size: 12px  !important; color: #000000;"><?php print_r($radicado); ?>, Santiago de Cali, 08 de Noviembre del 2018</span>
									</div>
									<br>
									<div>
										<strong>
											<span style="font-size: 12px !important; color: #000000;">CURADURIA URBANA UNO SANTIAGO DE CALI</span>
											<br>
											<span style="font-size: 12px !important; color: #000000;">CONSTANCIA DE RADICACIÓN</span>
										</strong>
									</div>
							  	</div>
							</th>
						  </tr>
						</thead>
					</table>
					<br>
				 	<br>
					<div style="text-align: left;">
						<div>
							<span style="font-size: 12px !important;">Señores:</span>
						</div>
						<div>
							<strong>
								<span style="font-size: 12px !important;"><?php print_r($result_usuario['nombre_usuario']); ?></span>
							</strong>
						</div>
						<div>
							<span style="font-size: 12px !important;">Atn. Arquitecto <?php print_r($result_usuario['nombre_usuario']); ?></span>
						</div>
						<div>
							<span style="font-size: 12px !important;">La Ciudad</span> 
						</div>
					</div>
				</header>
				<main>
					<br>
					<div style="text-align: left;">
						<div>
							<span style="font-size: 12px !important;">Ref: <?php print_r($radicado); ?> - <?php print_r($proyecto); ?> </span>
						</div>
						<div>
							<strong>
								<span style="font-size: 12px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print_r($direccion); ?></span>
							</strong>
						</div>
					</div>
					<br>
					<div style="text-align: left;">
						<div>
							<span style="font-size: 12px !important;">CONSTANCIA DE RADICACIÓN PARA <?php print_r($descripcion); ?></span> 
						</div>
					</div>
					<br>
					<div style="text-align: justify;">
						<div>
							<strong>
								<span style="font-size: 12px !important;">DE CONFORMIDAD CON EL ARTICULO 2.2.6.1.2.3.2 DEL DECRETO 1077 DE 2015 SU PROYECTO CORRESPONDE A LA <?php print_r($descripcion2); ?></span>
							</strong> 
						</div>
					</div>
					<br>
					<div style="text-align: justify;">
						<div>
							<span style="font-size: 12px !important;">Así que para que el proyecto quede radicado en legal y debida forma usted debe presentar los siguientes documentos:  </span>
						</div>
					</div>
					<br>
					<div style="text-align: justify;">
						<div>
							<strong>
								<span style="font-size: 12px !important;">DE ACUERDO CON EL ARTÍCULO 2.2.6.1.2.1.2 DEL DECRETO 1077 DE 2015, SE INFORMA QUE A PARTIR DE LA FECHA DE RADICACIÓN USTED CUENTA CON  TREINTA (30) DÍAS HÁBILES PARA COMPLETAR LA DOCUMENTACIÓN, DE LO CONTRARIO SU SOLICITUD SERÁ DESISTIDA POR MEDIO DE ACTO ADMINISTRATIVO.</span>
							</strong>
						</div>
					</div>
					<br>
					<div style="text-align: left;">
						<div>
							<span style="font-size: 12px !important;">Atentamente,</span>
						</div>
					</div>
					<br>
					<br>
					<br>
					<br>
					<div style="text-align: left;">
						<div>
							<strong>
								<span style="font-size: 12px !important;">DARIO LOPEZ MAYA</span>
							</strong>
							<br>
							<span style="font-size: 12px !important;">Curador Urbano Uno de Santiago de Cali</span>
						</div>
					</div>
				</main>
				<br>
				<br>
				<div style="font-size: 13px !important;">
					<h5>
						<span>
							Proyectó y Elaboró: <?php print_r($result_usuario['nombre_usuario']); ?> - Contratista
						</span>
					</h5>
				</div>
			</div>
		</div>
		<div style="text-align: center;" class="nomostrar">
			<button type="image" class="btn btn-info" name="Submit" onclick="javascript:window.print()">
				Imprimir
			</button>
		</div>
	</body>
</html>

