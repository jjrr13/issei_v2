<?php
	use Mpdf\Mpdf;
	// require_once '../mpdf/vendor/autoload.php';
	require_once '../../plugins/mpdf/vendor/autoload.php';

	require_once('../../cx/cx.php');



	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_area'];

	$fecha_ini = "2018-01-01";
	$fecha_fin = "2018-12-31";
	$observaciones= "hola !";
	$barrio = $_SESSION['predio']['BarrioActual'];



$_SESSION['estrato'];





	// $conver_hora = date("g:i a",strtotime($orden['hora']));
	// $hora = $orden['hora'];
	setlocale(LC_ALL,"es_ES");
	$fecha_liquidacion = strftime("%A %d de %B del %Y");


	$titulares = $_SESSION['titulares'];
	$nombre_tramitador = $_SESSION['construRespon'];
	// 76001-1-19-XXXX
	$rd = str_split($_SESSION['radicado']);
	$radicado = $rd[0].$rd[1].$rd[2].$rd[3].$rd[4]."-".$rd[5]."-".$rd[6].$rd[7]."-".$rd[8].$rd[9].$rd[10].$rd[11];


	$proyecto = $_SESSION['nombreProyecto'];

	$direccion= $_SESSION['direccion'];

	$nombre_usuario = $_SESSION['nombre_usuario'];

	$categoria = $_SESSION['categoria'];

	$oracion = '';
	switch ($categoria) {
		case '1':
			$oracion = "CATEGORIA 1. TIEMPO DE TRAMITE VEINTE (20) DIAS HABILES CONTADOS A PARTIR DE LA FECHA DE RADICACION DE LA SOLICITUD EN LEGAL Y DEBIDA FORMA.";
			break;
		case '2':
			$oracion = "CATEGORIA 2. TIEMPO DE TRAMITE VEINTICINCO (25) DIAS HABILES CONTADOS A PARTIR DE LA FECHA DE RADICACION DE LA SOLICITUD EN LEGAL Y DEBIDA FORMA.";
			break;
		case '3':
			$oracion = "CATEGORIA 3. TIEMPO DE TRÁMITE TREINTA Y CINCO (35) DIAS HABILES CONTADOS A PARTIR DE LA FECHA DE RADICACION DE LA SOLICITUD EN LEGAL Y DEBIDA FORMA.";
			break;
		case '4':
			$oracion = "CATEGORIA 4. TIEMPO DE TRAMITE CUARENTA Y CINCO (45) DIAS HABILES CONTADOS A PARTIR DE LA FECHA DE RADICACION DE LA SOLICITUD EN LEGAL Y DEBIDA FORMA.";
			break;
		default:
			$oracion = '';
			break;
	}

	$tablaConceptos = crearTabla($_SESSION['conceptos']);



	$descripcion = "LICENCIA DE CONSTRUCCIÓN MODALIDAD AMPLIACION 2 PISOS Y LICENCIA DE RECONOCIMIENTO DE LA EXISTENCIA DE UNA EDIFICACIÓN 2 PISOS";

$ho = '
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Radicación</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body >
		<header class="clearfix" style="margin-bottom: 0px !important;">
			<div style="text-align: justify;">
				<span style="font-size: 12px  !important; color: #000000;">'.$radicado.', Santiago de Cali, '.$fecha_liquidacion.'</span>
			</div>
			<br>
			<table border="1">
				<thead>
				  <tr>
					<th class="" style="border-bottom: 1px solid #C1CED9;">
						<div class="">
							<div>
								<strong>
									<span style="font-size: 12px !important; color: #000000;">CONSTANCIA DE LIQUIDACIÓN</span>
								</strong>
							</div>
					  	</div>
					</th>
				  </tr>
				</thead>
			</table>
			<br>
			<div style="text-align: left;">
				<div>
					<span style="font-size: 12px !important;">Señor (es):</span>
				</div>
				<div>
					<strong>
						<span style="font-size: 12px !important;">'.$titulares.'</span>
					</strong>
				</div>
				<div>
					<span style="font-size: 12px !important;">Atn. Tramitador '.$nombre_tramitador.'</span>
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
					<span style="font-size: 12px !important;">Ref: '.$radicado. ' - ' .$proyecto.'</span>
				</div>
				<div>
					<strong>
						<span style="font-size: 12px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$direccion.'</span>
					</strong>
				</div>
			</div>
			<br>
			
			<div style="text-align: justify;">
				<div>
						<span style="font-size: 12px !important;">'.$tablaConceptos.'</span>
					<br>
					<span style="font-size: 12px !important;"><br></span>
				</div>
			</div>
			<br>
			
			<div style="text-align: justify;">
				<div>
					<strong>
						<span style="font-size: 12px !important;">DE CONFORMIDAD CON EL ARTICULO 2.2.6.1.2.3.2 DEL DECRETO 1077 DE 2015 SU PROYECTO CORRESPONDE A LA '.$oracion.'</span>
					</strong>
					<br>
					<span style="font-size: 12px !important;"><br></span>
				</div>
			</div>
			<div style="text-align: justify;">
				<div>
					<span style="font-size: 12px !important;">NOTA: Esta liquidación no es un comprobante de pago. Para la entrega de la respectiva Licencia, el propietario deberá notificarse personalmente en la Curaduría Urbana Uno o quien haga sus veces como Representante legal, mediante poder escrito y firmado por el propietario, presentando una fotocopia de la cedula de ciudadanía del mismo.</span>
						<br>
					<span style="font-size: 12px !important;">Para consignaciones o transferencias por conceptos de EXPENSAS, realizar el pago a nombre DARÍO LÓPEZ MAYA NIT. 16.603.516-5 en banco DAVIVIENDA convenio: Curaduría Uno No. 1179092 Referencia 1: Cedula Cliente.</span>
					<br>
					<span style="font-size: 12px !important;"><br></span>
				</div>
			</div>
			<br>
			<div>
				<div  style="text-align: left;">
					<span style="font-size: 12px !important;">Atentamente,</span>
				</div>
			</div>
			
			<div style="text-align: left;">
				<div>
					<strong>
						<span style="font-size: 12px !important;">DARIO LOPEZ MAYA</span>
					</strong>
					<br>
					<span style="font-size: 12px !important;">Curador Urbano Uno de Santiago de Cali</span>
					<br>
					<br>
					<span style="font-size: 12px !important;">Nombre Radicador: </span>
					<strong>
						<span style="font-size: 12px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma de quien radica__________________________.</span>
					</strong>
					<br>
					<span style="font-size: 12px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$nombre_usuario.'</span>
				</div>
			</div>
		</main>
	</body>
</html>';

					
$mpdf = new Mpdf(['format' => 'letter', 'margin_left' => 30, 'margin_right' => 30, 'margin_top' => 50,
'margin_bottom' => 30]);

$mpdf->WriteHTML($ho);
$mpdf->Output();


// unset($_SESSION['radicado']);
// unset($_SESSION['titulares']);
// unset($_SESSION['construRespon']);
// unset($_SESSION['nombreProyecto']);
// unset($_SESSION['direccion']);
// unset($_SESSION['estrato']);
// unset($_SESSION['fecha']);
// unset($_SESSION['objetivo_id']);

function crearTabla($valores){
	$elemento='
	<table class="egt">
	  <thead>
	    <tr>
	      <th>Conceptos</th>
	      <th>Cantidad Q</th>
	      <th>Valor $</th>
	    </tr>
	  </thead>
	  <tbody>';
	    
	$cant = sizeof($valores);

	foreach ($valores as $key => $value) {
		$elemento.='
				<tr>';
		foreach ($variable[$key] as $key2 => $value2) {
			$elemento.='
				<td>';
						$elemento.=$variable[$key][$key2];
			$elemento.='
				</td>';
		}
		$elemento.='
				</tr>';
	}


	$elemento.='
	  </tbody>
	</table>';
	return $elemento;
}

