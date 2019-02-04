<?php 

include_once "../cx/cx.php";
// echo "<pre>";
// var_dump($_SESSION['objetoTramite']);
// echo "<HR>";
// var_dump($_SESSION['usos']);
// echo "<HR>";
// var_dump($_SESSION['licencias']);
// echo "<HR>";
// var_dump($_SESSION['predio']);
// echo "<HR>";
// var_dump($_SESSION['vecinos']);
// echo "<HR>";
// var_dump($_SESSION['titulares']);
// echo "<HR>";
// var_dump($_SESSION['responsables']);
// echo "<HR>";
// var_dump($_SESSION['documentos_generales']);
// echo "<HR>";
// var_dump($_SESSION['documentos_especificos']);
// echo "<HR>";
// var_dump($_SESSION['consecutivoNuevo']);
// echo "<HR>";
// var_dump($_SESSION['licencias']);
// echo "<HR>";
// var_dump($_SESSION['usos']);
// echo "<HR>";
// var_dump($_SESSION['vecinos']);
// echo "<HR>";
// var_dump($_SESSION['titulares']);
// echo "<HR>";
// var_dump($_SESSION['responsables']);
// echo "</pre>";

// echo insertarDirecciones($_SESSION['predio']['dirActual'], 'radicado_direcciones', 760011180011);




if($_POST){
	$_SESSION['pos'] = $_POST;
}

// var_dump($_SESSION['docEspecificos']);

 // limpiar();

if (!empty($_POST['limpia'])) {
	limpiar();
	header("Location: ../modules/radication");
}
else if (isset($_POST['btn_tipo']) ){
	$respuesta;
	
	if (isset($_POST['revisorProyecto']) && !empty($_POST['revisorProyecto']) && $_POST['revisorProyecto'] != 'ASIGNE EL ARQUITECTO' ){

		$_SESSION['revisorProyecto'] = $_POST['revisorProyecto'];

		$cantLicencias = array();
		$bandera= false;
		if (isset($_POST['LicUrba']) && !empty($_POST['LicUrba']) && 
			isset($_POST['urb']) && !empty($_POST['urb'])) {
			
			$bandera=true;
			array_push($cantLicencias, $_POST['urb']);
		}
		if (isset($_POST['LicPar']) && !empty($_POST['LicPar']) && 
			isset($_POST['parc']) && !empty($_POST['parc']) ) {
			// $cantLicencias = array('id' => '4');
			$bandera=true;
			array_push($cantLicencias, $_POST['parc']);
		}
		if (isset($_POST['LicSub']) && !empty($_POST['LicSub']) && 
			isset($_POST['subd']) && !empty($_POST['subd'])) {
			
			$bandera=true;
			array_push($cantLicencias, $_POST['subd']);
		}
		if (isset($_POST['LicCons']) && !empty($_POST['LicCons']) && 
			isset($_POST['LicConsC']) && !empty($_POST['LicConsC'])) {

			$bandera=true;
			if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
				$_SESSION['categoria']= $_POST['categoria'];
			}
			foreach ($_POST['LicConsC'] as $key => $value) {
				array_push($cantLicencias, $value);
			}
		}
		if (isset($_POST['LicRec']) && !empty($_POST['LicRec']) ) {
			$bandera=true;
			array_push($cantLicencias, $_POST['LicRec']);
		}
		if (isset($_POST['LicOtras']) && !empty($_POST['LicOtras']) && 
			isset($_POST['otrasact']) && !empty($_POST['otrasact'])) {
			
			$bandera=true;
		
			array_push($cantLicencias, $_POST['otrasact']);
		}
		if ($_POST['objetoTramite'] == 2 || $_POST['objetoTramite'] == 4) {
			$bandera=true;
		}

		if ($bandera && (isset($_POST['objetoTramite']) && !empty($_POST['objetoTramite'])) && (isset($_POST['usos']) && !empty($_POST['usos'])) ) {
			//asigna varaible de se session de objeto de trabajo
			$_SESSION['objetoTramite']= $_POST['objetoTramite'];
			//ararry que almacenara todos los tipo de usos
			$cantUsos = array();
			// $valores='';
			foreach ($_POST['usos'] as $key => $value) {
				array_push($cantUsos, $value);
				// $valores.= ' / '. $value;
			}
			//asigna todos los tipos de susos a session
			$_SESSION['usos']= $cantUsos;
			//se agregan las licencias que se generaron
			$_SESSION['licencias']= $cantLicencias;
			//se envia el valor que indica que pase al proximo
			$respuesta= 131;
			$_SESSION['radicar'] = 131;
			// var_dump($_SESSION['licencias']);
			
		}
		else {
			//valor que indicara que no llego algun dato necesario
			$respuesta=31;
		}
	}else{
		$respuesta=31;
	}
	echo $respuesta;
}
else if (!empty($_POST['btn_predio'])) {
	// unset($_SESSION['radicar']);
	$respuesta;
	// console();
	if ( !empty($_POST['dirActual'][0]) && $_POST['BarrioActual'][0] != 'SELECCIONAR' &&
		 !empty($_POST['dirAnterior']) && 
		 !empty($_POST['matricula'][0]) && !empty($_POST['catastral'][0]) &&
		 !empty($_POST['clasificacionsuelo']) && !empty($_POST['planimetria']) &&
		 !empty($_POST['nombrePredio']) ) {

			$_SESSION['predio']['dirActual'] = $_POST['dirActual'];
			$_SESSION['predio']['BarrioActual'] = $_POST['BarrioActual'];
			$_SESSION['predio']['matricula'] = $_POST['matricula'];
			$_SESSION['predio']['catastral'] = $_POST['catastral'];
			// $_SESSION['predio']['BarrioAnterior'] = $_POST['BarrioAnterior'];
			$_SESSION['predio']['nombre'] = $_POST['nombrePredio'];
			$_SESSION['predio']['dirAnterior'] = $_POST['dirAnterior'];
			$_SESSION['predio']['clasificacionsuelo'] = $_POST['clasificacionsuelo'];
			$_SESSION['predio']['planimetria'] = $_POST['planimetria'];
			$_SESSION['predio']['estrato'] = $_POST['estrato'];

			$respuesta = 132;
			$_SESSION['radicar'] = 132;
	}
	else{
		$respuesta=  32;
	}
	echo $respuesta;
}
else if (!empty($_POST['btn_vecino'])) {
	$respuesta;
	if (!empty($_POST['diractual'][0]) ) {

		// $values="";
		// $cant = count($_POST['diractual'])-1;
		$cantVecinos=  array();
		$datosVecino=  array();
		$prueba='';
		foreach ($_POST['diractual'] as $key => $value) {
			array_push($datosVecino, $_POST['nombre'][$key]);
			array_push($datosVecino, $_POST['diractual'][$key]);
			array_push($datosVecino, $_POST['dircorres'][$key]);

			array_push($cantVecinos, $datosVecino);

			$datosVecino=  array();
		}

		$_SESSION['vecinos'] = $cantVecinos;

		$_SESSION['radicar'] = 133;
		$respuesta = 133; 
	}
	else{
		$respuesta = 33;
	}
	echo $respuesta;
}
else if (!empty($_POST['btn_titular'])) {
	$respuesta;
	if (!empty($_POST['nit'][0]) ) {
		// var_dump($_POST['nit'][0]);
		$_SESSION['titulares'] = $_POST['nit'];
		$_SESSION['titulares_nombres'] = $_POST['nombre'];

		$_SESSION['radicar'] = 134;
		$respuesta = 134; //$prueba;
	}
	else{
		$respuesta = 34;
	}
	echo $respuesta;
}
else if (!empty($_POST['btn_Profesionales'])) {
	$responsables = array();
	$respuesta;

	if (!empty($_POST['nit0'])  && !empty($_POST['nit1']) && !empty($_POST['nit2'])) {

		$_SESSION['tramitador_nombre'] = $_POST['nombre0'];

		array_push($responsables, array(  "1"  => $_POST['nit0'],  "2" => "24" ));
		array_push($responsables, array(  "1"  => $_POST['nit1'],  "2" => "5" ));
		array_push($responsables, array(  "1"  => $_POST['nit2'],  "2" => "6" ));

		if (!empty($_POST['nit3']) ) {
			array_push($responsables, array(  "1"  => $_POST['nit3'],  "2" => "3" ) );
		}
		if (!empty($_POST['nit4']) ) {
			array_push($responsables, array(  "1"  => $_POST['nit4'],  "2" => "2" ) );
		}
		if (!empty($_POST['nit5']) ) {
			array_push($responsables, array(  "1"  => $_POST['nit5'],  "2" => "4" ) );
		}
		if (!empty($_POST['nit6']) ) {
			array_push($responsables, array(  "1"  => $_POST['nit6'],  "2" => "10" ) );
		}
		if (!empty($_POST['nit7']) ) {
			array_push($responsables, array(  "1"  => $_POST['nit7'],  "2" => "8" ) );
		}
		if (!empty($_POST['nit8']) ) {
			array_push($responsables, array(  "1"  => $_POST['nit8'],  "2" => "1" ) );
		}
		$_SESSION['responsables'] = $responsables;
		$_SESSION['radicar'] = 135;
		$respuesta = 135;
	}else{
		$respuesta = 35;
	}

	echo $respuesta;
}
else if (!empty($_POST['btn_docs'])   ) {
	$respuesta=0;

	if (!empty($_SESSION['objetoTramite']) && !empty($_SESSION['usos']) || !empty($_SESSION['licencias']) ) {
		if (!empty($_SESSION['predio'])) {
			if (!empty($_SESSION['vecinos'])) {
				if (!empty($_SESSION['titulares'])) {
					if (!empty($_SESSION['responsables'])) {
						if ( (!empty($_POST['documentos_generales']) || !empty($_POST['documentos_especificos'])) || !empty($_POST['docCompletos']) ) {
						
								// $_SESSION['documentos_generales'] = $_POST['documentos_generales'];
								$_SESSION['docCompletos'] = (!empty($_POST['docCompletos'])) ? $_POST['docCompletos'] : '';
								$_SESSION['documentos_generales'] = (!empty($_POST['documentos_generales'])) ? $_POST['documentos_generales'] : '';
								$_SESSION['documentos_especificos'] = (!empty($_POST['documentos_especificos'])) ? $_POST['documentos_especificos'] : '';
								$_SESSION['documentos_adicionales'] = (!empty($_POST['documentos_adicionales'])) ? $_POST['documentos_adicionales'] : '';

								$_SESSION['categoria'] = (!empty($_SESSION['categoria']))? $_SESSION['categoria'] : '';

								$_SESSION['consecutivoNuevo'] = NuevoRadicado();
									
								$sql = sprintf(" INSERT INTO radicacion (consecutivo, nombre, dir_ant, estrato, categoria, id_suelos, id_planimetria, estado_id, dias, objetivo_id, id_revisor) 
							       VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							      
							       GetSQLValueString($_SESSION['consecutivoNuevo'], "text"),
							       GetSQLValueString($_SESSION['predio']['nombre'], "text"),
							       // GetSQLValueString($_SESSION['predio']['dirActual'], "text"),
							       // GetSQLValueString($_SESSION['predio']['BarrioActual'], "text"),
							       GetSQLValueString($_SESSION['predio']['dirAnterior'], "text"),
							       GetSQLValueString($_SESSION['predio']['estrato'], "text"),
							       GetSQLValueString($_SESSION['categoria'], "text"),
							       // GetSQLValueString($_SESSION['predio']['matricula'], "int"),
							       // GetSQLValueString($_SESSION['predio']['catastral'], "int"),
							       GetSQLValueString($_SESSION['predio']['clasificacionsuelo'], "text"),
							       GetSQLValueString($_SESSION['predio']['planimetria'], "int"),
							       GetSQLValueString(1, "int"),
							       GetSQLValueString(30, "int"),
							       GetSQLValueString($_SESSION['objetoTramite'], "int"),
							       GetSQLValueString($_SESSION['revisorProyecto'], "text"));

							$result = $mysqli->query($sql);
							// $result=false;
							if ($result) {
								$resultado=false;

								$resultado= insertarDirecciones($_SESSION['predio']['dirActual'], 'radicado_direcciones', $_SESSION['consecutivoNuevo']);

								$resultado= insertMuchos($_SESSION['licencias'], 'rad_lic', $_SESSION['consecutivoNuevo']);
								$resultado= insertMuchos($_SESSION['usos'], 'rad_usos', $_SESSION['consecutivoNuevo']);
								$resultado= insertVecinos($_SESSION['vecinos'], 'radicado_vecinos', $_SESSION['consecutivoNuevo']);
								$resultado= insertMuchos($_SESSION['titulares'], 'rad_titulares', $_SESSION['consecutivoNuevo']);
								$resultado= insertResponsables($_SESSION['responsables'], 'rad_respo', $_SESSION['consecutivoNuevo']);
								if (!empty($_POST['documentos_generales'])) {
									$resultado= insertDocsPendientes($_POST['documentos_generales'], 'rad_docs', $_SESSION['consecutivoNuevo']);
								}
								if (!empty($_POST['documentos_especificos'])) {
									$resultado= insertDocsPendientes($_POST['documentos_especificos'], 'rad_docs', $_SESSION['consecutivoNuevo']);
								}
								if (!empty($_POST['documentos_adicionales'])) {
									$resultado= insertDocsPendientes($_POST['documentos_adicionales'], 'rad_docs', $_SESSION['consecutivoNuevo']);
								}

								if ($resultado) {

									$respuesta= 111;
									// limpiar();
									
								}else{
									$respuesta= 112;
					        	}
					        }else{
					        	// $respuesta = 111;
					        	$respuesta = 37;
					        	
					        	$_SESSION['radicar'] = '1'.($respuesta-2);
					        }
						}else{
							$respuesta= 36;
							$_SESSION['radicar'] = '1'.$respuesta-1;
						}
					}else{
						$respuesta= 35;
					}
				}else{
					$respuesta= 34;
				}
			}else{
				$respuesta= 33;
			}
		}else{
			$respuesta= 32;
		}
	}else{
		$respuesta= 31;
	}
	if ($respuesta >= 31 && $respuesta <= 35 ) {
		$_SESSION['radicar'] = '1'.$respuesta-1;
		// $respuesta = '0'.$respuesta;
	}else if($respuesta == 36 || $respuesta == 37){
		 // $respuesta = '0'.$respuesta;
	}else if($respuesta == 111){
		// limpiar();
	}else{
		 $_SESSION['radicar'] = $respuesta;

	}
	echo $respuesta;
	// header('Location: ../modules/radication');
}
else if (!empty($_POST['nit']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['celular']) && isset($_POST['email']) && isset($_POST['direccion']) && isset($_POST['id_barrio']) ) {
	
	$resultado;
	$nit = $_POST['nit'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$celular = $_POST['celular'];
	$email = $_POST['email'];
	$direccion = $_POST['direccion'];
	$id_barrio = $_POST['id_barrio'];

	$sql='';
	if (!empty($_POST['tarjeta'])) {
		$tarjeta = $_POST['tarjeta'];

		$sql=sprintf("UPDATE terceros SET celular = %s, email = %s, direccion = %s, id_barrio = %s, nombre = %s, apellido = %s, tarjeta_profesional = %s   WHERE nit = %s ",
			GetSQLValueString($celular, "text"),
			GetSQLValueString($email, "text"),
			GetSQLValueString($direccion, "text"),
			GetSQLValueString($id_barrio, "int"),
			GetSQLValueString($nombre, "text"),
			GetSQLValueString($apellido, "text"),
			GetSQLValueString($tarjeta, "text"),
			GetSQLValueString($nit, "int")
		);
	}
	else{
		$sql=sprintf("UPDATE terceros SET celular = %s, email = %s, direccion = %s, id_barrio = %s, nombre = %s, apellido = %s WHERE nit = %s ",
			GetSQLValueString($celular, "text"),
			GetSQLValueString($email, "text"),
			GetSQLValueString($direccion, "text"),
			GetSQLValueString($id_barrio, "int"),
			GetSQLValueString($nombre, "text"),
			GetSQLValueString($apellido, "text"),
			GetSQLValueString($nit, "int")
		);
	}





		$result =$mysqli->query($sql);

		// echo ($sql)? $sql : 'error'; 
		echo ($result)? 1 : 1111;
}
else if (!empty($_POST['nit'])) {
	
	$nit = $_POST['nit'];
	$sql=sprintf("SELECT nombre, apellido, celular, email, direccion, id_barrio, tarjeta_profesional FROM terceros WHERE nit = %s ",
		GetSQLValueString($nit, "int"));

		$result =$mysqli->query($sql);
		$datos = mysqli_fetch_assoc($result);
		$result = mysqli_num_rows($result);

		if ($result > 0) {
			$arrayjson = array();
			$arrayjson[] = array(
							'estado'	=> 1,
							'nit'		=> $nit,//nit del solicitante
							'nombre'	=> $datos['nombre'],
							'apellido'  => $datos['apellido'],
							'celular'   => $datos['celular'],
							'email'		=> $datos['email'],
							'direccion'	=> $datos['direccion'],
							'id_barrio'	=> $datos['id_barrio'],
							'tarjeta_profesional'	=> $datos['tarjeta_profesional']
			);

			echo json_encode($arrayjson);
		}
		else{
			$arrayjson = array();
			$arrayjson[] = array('estado'	=> 2 );

			echo json_encode($arrayjson);
		}
}
else{
	// $_SESSION['radicar'] = 133;
	// $arrayjson = array();
	// $arrayjson[] = array(
	// 				'estado'	=> 0 );

	// echo json_encode($arrayjson);
	echo 1;
}

function NuevoRadicado(){
global $mysqli;

	$sql= "SELECT MAX(consecutivo) consecutivo FROM radicacion" ;

	$result = $mysqli->query($sql);
	$ultimoConsecutivo = mysqli_fetch_assoc($result);
	$ultimoConsecutivo = $ultimoConsecutivo['consecutivo'];

	return crearConsecutivo($ultimoConsecutivo);
}

function crearConsecutivo($consecutivo)
{
	global $mysqli;
		 // $valor= '760011180001';
      $anoConsecutivo = substr($consecutivo, 6, 2);
      $anoActual = date('y');

      if ($anoConsecutivo == $anoActual) {
      	$nuevoConsecutivo = $consecutivo + 1;
      }else{
      	$nuevoConsecutivo = '760011'.date('y').'0001';
      }

      return $nuevoConsecutivo;
}

function insertMuchos($array, $tabla, $consec)
{
	global $mysqli;
	$values="";
	$cant = count($array)-1;
	// for ($j=0; $j < sizeof($_SESSION['licencias']); $j++) {
	foreach ($array as $key => $value) {
		if ($cant != $key) {
			$values.="(NULL, '$consec', '$value' ),";
		}
		else{
			$values.="(NULL, '$consec', '$value' )";
		}
	}

	$sql="INSERT INTO $tabla VALUES ".$values;
	return $result = $mysqli->query($sql);
	// return $sql.'<hr>';
}
function insertarDirecciones($array, $tabla, $consec='13')
{
	global $mysqli;
	$values="";
	$cant = count($array)-1;
	// for ($j=0; $j < sizeof($_SESSION['licencias']); $j++) {
	foreach ($array as $key => $value) {
		$direccion = $_SESSION['predio']['dirActual'][$key];
		$id_barrio = $_SESSION['predio']['BarrioActual'][$key];
		$catastro = $_SESSION['predio']['matricula'][$key];
		$matricula = $_SESSION['predio']['catastral'][$key];

		if ($cant != $key) {
			$values.="( NULL, $consec, '$direccion', '$id_barrio', '$catastro', '$matricula' ),";
		}
		else{
			$values.="( NULL, $consec, '$direccion', '$id_barrio', '$catastro', '$matricula' )";
		}
	}

	$sql="INSERT INTO $tabla VALUES ".$values;
	return $result = $mysqli->query($sql);
	// return $sql.'<hr>';
}

function insertVecinos($array, $tabla, $consec)
{
	global $mysqli;
	$values="";
	$cant = count($array)-1;
	// for ($j=0; $j < sizeof($_SESSION['licencias']); $j++) {
	foreach ($array as $key => $value) {
		$nombre = $array[$key][0];
		$dirActual = $array[$key][1];
		$dirCorrespondencia = $array[$key][2];

		if ($cant != $key) {
			$values.="( NULL, $consec, '$nombre', '$dirActual', '$dirCorrespondencia' ),";
		}
		else{
			$values.="( NULL, $consec, '$nombre', '$dirActual', '$dirCorrespondencia' )";
		}
	}

	$sql="INSERT INTO $tabla VALUES ".$values;
	return $result = $mysqli->query($sql);
	// return $sql.'<hr>';
}

function insertResponsables($array, $tabla, $consec)
{
	global $mysqli;
	$values="";
	$cant = count($array)-1;
	// for ($j=0; $j < sizeof($_SESSION['licencias']); $j++) {
	foreach ($array as $key => $value) {
		$persona = $array[$key][1];
		$idprofesion = $array[$key][2];
		// $dirCorrespondencia = $array[$key][2];

		if ($cant != $key) {
			$values.="( NULL, $consec, '$persona', '$idprofesion' ),";
		}
		else{
			$values.="( NULL, $consec, '$persona', '$idprofesion' )";
		}
	}

	$sql="INSERT INTO $tabla VALUES ".$values;
	return $result = $mysqli->query($sql);
	// return $sql.'<hr>';
}

function insertDocsPendientes($array, $tabla, $consec)
{
	global $mysqli;
	$values="";
	$cant = count($array)-1;
	// for ($j=0; $j < sizeof($_SESSION['licencias']); $j++) {
	foreach ($array as $key => $value) {
		$idDocumento = $array[$key];
		$estado = 1;
		// $dirCorrespondencia = $array[$key][2];

		if ($cant != $key) {
			$values.="( NULL, $consec, '$idDocumento', '$estado' ),";
		}
		else{
			$values.="( NULL, $consec, '$idDocumento', '$estado' )";
		}
	}

	$sql="INSERT INTO $tabla VALUES ".$values;
	return $result = $mysqli->query($sql);
	// return $sql.'<hr>';
}
function limpiar()
{
	unset($_SESSION['radicar']);
	unset( $_SESSION['objetoTramite']);
	unset( $_SESSION['usos']);
	unset( $_SESSION['licencias']);
	unset( $_SESSION['predio']);
	unset( $_SESSION['vecinos']);
	unset( $_SESSION['titulares']);
	$_SESSION['radicar']=130;
	unset( $_SESSION['responsables']);
}
