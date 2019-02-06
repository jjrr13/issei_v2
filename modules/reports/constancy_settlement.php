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

	


	// $conver_hora = date("g:i a",strtotime($orden['hora']));
	// $hora = $orden['hora'];
	setlocale(LC_ALL,"es_ES");
	$fecha_radicacion = strftime("%A %d de %B del %Y");

	// $pendientes.=' '. docFaltantesEspecificos($_SESSION['docEspecificos'], $_SESSION['documentos_especificos']);
	// $pendientes.=' y en Generales: '. docFaltantesGenerales($_SESSION['docGenerales'], $_SESSION['documentos_generales']);

	// $faltantes='<strong>Se entregaron los siguientes documentos: </strong>';
	// $pendientes='Los Pendientes son:';
	$pendientes='';
	$necesitaDocumentos='';
	$tiempo = '';

	if (empty($_SESSION['docCompletos'])) {
		$y='';
		$v1= count($_SESSION['documentos_generales']);
		$v2= count($_SESSION['documentos_especificos']);
		$v3= count($_SESSION['documentos_adicionales']);

		if ($v1>0) {
			$pendientes.=' '. docFaltantes($_SESSION['documentos_especificos']);
			$y= ' y ';
		}
		if ($v2>0) {
			$pendientes.= '<strong> En Generales:</strong> '. docFaltantes($_SESSION['documentos_generales']);
		}

		if ($v3>0) {
			$pendientes.=' <strong>Adicionales le faltan:</strong> '. docFaltantes($_SESSION['documentos_adicionales']);
			// $pendientes.= $v2;
		}

		if ($v1 > 0 || $v2 >0 || $v3 > 0) {
			$necesitaDocumentos = '<strong>Así que para que el proyecto quede radicado en legal y debida forma usted debe presentar los siguientes documentos: </strong>';
			$tiempo = 'DE ACUERDO CON EL ARTÍCULO 2.2.6.1.2.1.2 DEL DECRETO 1077 DE 2015, SE INFORMA QUE A PARTIR DE LA FECHA DE RADICACIÓN USTED CUENTA CON  TREINTA (30) DÍAS HÁBILES PARA COMPLETAR LA DOCUMENTACIÓN, DE LO CONTRARIO SU SOLICITUD SERÁ DESISTIDA POR MEDIO DE ACTO ADMINISTRATIVO.';
		}
	}
	else{
			$necesitaDocumentos = '<strong>Usted ha aportado todos los ducumentos necesarios para el continuo proceso. </strong>';
	}

	$titulares = ponerTitulares($_SESSION['titulares_nombres']);
	$nombre_tramitador = $_SESSION['tramitador_nombre'];
	// 76001-1-19-XXXX
	$rd = str_split($_SESSION['consecutivoNuevo']);
	$radicado = $rd[0].$rd[1].$rd[2].$rd[3].$rd[4]."-".$rd[5]."-".$rd[6].$rd[7]."-".$rd[8].$rd[9].$rd[10].$rd[11];


	$proyecto = $_SESSION['predio']['nombre'];

	$direccion= direcciones($_SESSION['predio']['dirActual'] , $_SESSION['predio']['BarrioActual']);



	// $direccion = $_SESSION['predio']['dirActual'] . ' ' . $result_barrio['barrio'];
	$categoria = $_SESSION['categoria'];
	$nombre_usuario = $_SESSION['nombre_usuario'];



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

// if (!empty($_SESSION['consecutivoNuevo'])) {
// 	// $algo=' Deberia de mostrar el valor';
// }
// else{
// 	$algo=' llego vacia la session';
// }

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
			<table border="1">
				<thead>
				  <tr>
					<th class="" style="border-bottom: 1px solid #C1CED9;">
						<div class="">
							<div>
								<strong>
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
					<strong>
						<span style="font-size: 12px !important;">DE CONFORMIDAD CON EL ARTICULO 2.2.6.1.2.3.2 DEL DECRETO 1077 DE 2015 SU PROYECTO CORRESPONDE A LA '.$oracion.'</span>
					</strong>
					<br>
					<span style="font-size: 12px !important;"><br></span>
				</div>
			</div>
			<br>
			<div style="text-align: justify;">
				<div>
					<span style="font-size: 12px !important;">'.$necesitaDocumentos.'
					</span>
					<span style="font-size: 12px !important;"><br>'.$pendientes.'<br></span>
				</div>
			</div>
			<br>
			<div style="text-align: justify;">
				<div>
					<strong>
						<span style="font-size: 12px !important;">'.$tiempo.'</span>
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
// $mpdf->SetWatermarkImage('img/logo.png',0.2,'F');
// $mpdf->showWatermarkImage = true;

$mpdf->WriteHTML($ho);
$mpdf->Output();

function ponerTitulares($array)
{
	$values="";
	$cant = count($array)-1;

	if ($cant <= 1) {
		$values = $array[0];
	}
	else{
		foreach ($array as $key => $value) {

			$titular = $array[$key];

			if ($cant != $key) {
				$values.="$titular, ";
			}
			else{
				$values.="y $titular ";
			}
		}
	}
	return $values;
}

function direcciones($dir,$barrio){
	global $mysqli;
	$diresciones="";
	$cant = count($dir)-1;

	$result =$mysqli->query($sql);
	$result_barrio = mysqli_fetch_assoc($result);
	$totalrows_result_barrio = mysqli_num_rows($result);

	foreach ($dir as $key => $value) {
		// $dato = $array[$key];
		$barrio = $barrio[$key];
		$sql = sprintf("SELECT barrio as nombre FROM barrio  WHERE id_barrio = '%s'", $barrio);

    $result = $mysqli->query($sql);

    while($datos1 = mysqli_fetch_assoc($result)  ) {  
    	if ($cant != $key) {
      	$doc.= $dir[$key]. " ". $datos1['nombre']."; ";
    	}
    	else{
      	$doc.= $dir[$key]. " ". $datos1['nombre'].". ";
    	}
    }

	}
	return $doc;
}

function docFaltantes($array)
{
	global $mysqli;
	$doc="";
	$cant = count($array)-1;

	foreach ($array as $key => $value) {
		// $dato = $array[$key];
		$idDoc = $array[$key];
		$sql="SELECT DISTINCT rd.nombre as nombre FROM radicado_documentos AS rd
              WHERE rd.id_documento ='$idDoc'";

      $result = $mysqli->query($sql);
      while($datos = mysqli_fetch_assoc($result)  ) {  
      	if ($cant != $key) {
        	$doc.= utf8_encode($datos['nombre']) ."; ";
      	}
      	else{
        	$doc.= utf8_encode($datos['nombre']) .". ";
      	}
      }

	}
	return $doc;
}

unset($_SESSION['radicar']);
	unset( $_SESSION['objetoTramite']);
	unset( $_SESSION['usos']);
	unset( $_SESSION['licencias']);
	unset( $_SESSION['predio']);
	unset( $_SESSION['vecinos']);
	unset( $_SESSION['titulares']);
	$_SESSION['radicar']=130;
	unset( $_SESSION['responsables']);
// var_dump($_SESSION['docGenerales']);



// var_dump($_SESSION['docGenerales']);
// echo "<hr>";
// var_dump($_SESSION['docEspecificos']);

function docFaltantesEspecificos($array, $array2)
{
	// console('entro a la funcion');
	$values="";
	$cant = count($array)-1;
	global $faltantes;

	// console(var_dump($array2));
	foreach ($array as $key => $value) {

	  $documento = $array[$key];
	  // console(var_dump($documento));
	  // console($documento['id_documento']);
	  if(array_search($documento['id_documento'], $array2) !== false){
	    if ($cant != $key) {
	       $values.= utf8_encode($documento['nombre']).'; ';
	    }
	    else{
	       $values.= utf8_encode($documento['nombre']).'.';
	    }
	  }else{
	    $faltantes.= ' '. utf8_encode($documento['nombre']).'; ';
	  }

	}
	return $values;
}
function docFaltantesGenerales($array, $array2)
{
	console('entro a la funcion');
	$values="";
	$cant = count($array)-1;
	global $faltantes;

	  // console(var_dump($array));
	foreach ($array as $key => $value) {

	  $documento = $array[$key];
	  // console(var_dump($documento));
	  console($documento[1]);
	  if(array_search($documento[1], $array2) !== false){
	    if ($cant != $key) {
	       $values.= $documento[2].'; ';
	    }
	    else{
	       $values.= $documento[2].'.';
	    }
	  }
	  else{
	    $faltantes.= ' '. $documento[2].';';
	  }

	}
	return $values;
}

