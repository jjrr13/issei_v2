<?php
	use Mpdf\Mpdf;
	require_once '../mpdf/vendor/autoload.php';
	require_once('../../cx/cx.php');


	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_area'];

	$fecha_ini = "2018-01-01";
	$fecha_fin = "2018-12-31";
	$observaciones= "hola !";
	$barrio = $_SESSION['predio']['BarrioActual'];

	$sql = sprintf("SELECT barrio FROM barrio  WHERE id_barrio = '%s'", $barrio);
	$result =$mysqli->query($sql);
	$result_barrio = mysqli_fetch_assoc($result);
	$totalrows_result_barrio = mysqli_num_rows($result);

	// echo "<script>console.log('".$nro_orden."')</script>";

	// $conver_hora = date("g:i a",strtotime($orden['hora']));
	// $hora = $orden['hora'];
	setlocale(LC_ALL,"es_ES");
	$fecha_radicacion = strftime("%A %d de %B del %Y");


	$titulares = ponerTitulares($_SESSION['titulares_nombres']);
	$nombre_tramitador = $_SESSION['tramitador_nombre'];
	$radicado = $_SESSION['consecutivoNuevo'];
	$proyecto = $_SESSION['predio']['nombre'];
	$direccion = $_SESSION['predio']['dirActual'] . ' ' . $result_barrio['barrio'] ;
	$categoria = $_SESSION['categoria'];
	$nombre_usuario = $_SESSION['nombre_usuario'];

// unset($_SESSION['radicar']);
// unset( $_SESSION['objetoTramite']);
// unset( $_SESSION['usos']);
// unset( $_SESSION['licencias']);
// unset( $_SESSION['predio']);
// unset( $_SESSION['vecinos']);
// unset( $_SESSION['titulares']);
// $_SESSION['radicar']=130;
// unset( $_SESSION['responsables']);
// unset( $_SESSION['titulares_nombres']);
// unset( $_SESSION['tramitador_nombre']);
// unset( $_SESSION['categoria']);
// unset( $_SESSION['consecutivoNuevo']);

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
				<span style="font-size: 12px  !important; color: #000000;">'.$radicado.', Santiago de Cali, '.$fecha_radicacion.'</span>
			</div>
			<br>
			<table>
				<thead>
				  <tr>
					<th class="" style="border-bottom: 0px solid #C1CED9;">
						<div class="">
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
					<span style="font-size: 12px !important;">Atn. Arquitecto '.$nombre_tramitador.'</span>
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
			<div style="text-align: left;">
				<div>
					<span style="font-size: 12px !important;">CONSTANCIA DE RADICACIÓN PARA '.$descripcion.'</span> 
				</div>
			</div>
			<br>
			<div style="text-align: justify;">
				<div>
					<strong>
						<span style="font-size: 12px !important;">DE CONFORMIDAD CON EL ARTICULO 2.2.6.1.2.3.2 DEL DECRETO 1077 DE 2015 SU PROYECTO CORRESPONDE A LA '.$oracion.'</span>
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


					
// $mpdf = new \Mpdf\Mpdf(['debug' => true]);
// $mpdf = new \Mpdf\Mpdf([
//     'debug' => true,
//     'allow_output_buffering' => true
// ]);
$mpdf = new Mpdf(['format' => 'letter', 'margin_left' => 30, 'margin_right' => 30, 'margin_top' => 50,
'margin_bottom' => 30]);
//Marca de agua texto
// $mpdf->SetWatermarkText('CU1');
// $mpdf->showWatermarkText = true;
//Marca de agua imagen
$mpdf->SetWatermarkImage('img/logo.png',0.2,'F');
$mpdf->showWatermarkImage = true;

$mpdf->WriteHTML($ho);
$mpdf->Output();

function ponerTitulares($array)
{
	$values="";
	$cant = count($array)-1;

	foreach ($array as $key => $value) {

		$titular = $array[$key];

		if ($cant != $key) {
			$values.="$titular, ";
		}
		else{
			$values.="y $titular ";
		}
	}
	return $values;
}

function determinarDocumentos($value='')
{
	$values="";
	$cant = count($array)-1;

	foreach ($array as $key => $value) {

		$titular = $array[$key];

		if ($cant != $key) {
			$values.="$titular, ";
		}
		else{
			$values.="y $titular ";
		}
	}
	return $values;
}

var_dump($_SESSION['docGenerales']);
// $_SESSION['docEspecificos']

function console($variable)
{
	echo "<script>console.log($variable);</script>";
}

// <table>
// 				<thead>
// 				  <tr>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="220px">
// 						<strong>
// 							<span style="font-size: 12px !important; color: #000000;">Nombre de quien radica:</span>
// 						</strong>	
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="250px">
// 						<div class="">
// 							<div>
// 								<span style="font-size: 12px !important; color: #000000;">DAVID FERNANDO SANDOVAL GOMEZ</span>
// 							</div>
// 					  	</div>
// 					</th>
// 				  </tr>
// 				  <tr>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="220px">
// 						<strong>
// 							<span style="font-size: 12px !important; color: #000000;">Documento de Identificación:</span>
// 						</strong>	
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="250px">
// 						<div class="">
// 							<div>
// 								<span style="font-size: 12px !important; color: #000000;">1113524482 DE CANDELARIA</span>
// 							</div>
// 					  	</div>
// 					</th>
// 				  </tr>
// 				  <tr>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="220px">
// 						<strong>
// 							<span style="font-size: 12px !important; color: #000000;">Correo Electrónico:</span>
// 						</strong>	
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="250px">
// 						<div class="">
// 							<div>
// 								<span style="font-size: 12px !important; color: #000000;">DAVIDSANDOVAL062@GMAIL.COM</span>
// 							</div>
// 					  	</div>
// 					</th>
// 				  </tr>
// 				  <tr>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="220px">
// 						<strong>
// 							<span style="font-size: 12px !important; color: #000000;">Telefono:</span>
// 						</strong>	
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="250px">
// 						<div class="">
// 							<div>
// 								<span style="font-size: 12px !important; color: #000000;">3173107002</span>
// 							</div>
// 					  	</div>
// 					</th>
// 				  </tr>
// 				  <tr>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="border-bottom: 0px solid #C1CED9;"width="100px">
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="220px">
// 						<strong>
// 							<span style="font-size: 12px !important; color: #000000;">Dirección:</span>
// 						</strong>	
// 					</th>
// 					<th class="" style="text-align: justify; border-bottom: 0px solid #C1CED9;" width="250px">
// 						<div class="">
// 							<div>
// 								<span style="font-size: 12px !important; color: #000000;">C BUSCALA CON K ENCUENTRALA</span>
// 							</div>
// 					  	</div>
// 					</th>
// 				  </tr>
// 				</thead>
// 			</table>