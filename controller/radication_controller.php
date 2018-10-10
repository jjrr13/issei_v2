<?php 


include_once "../cx/cx.php";

if (!empty($_POST['limpia'])) {
	unset($_SESSION['radicar']);
	header("Location: ../modules/radication");
}
else if (isset($_POST['btn_tipo'])) {
	$cantLicencias = array();
	$bandera= false;
	$respuesta;
	if (isset($_POST['LicUrba']) && !empty($_POST['LicUrba']) && 
		isset($_POST['urb']) && !empty($_POST['urb'])) {
		$id;
		switch ($_POST['urb']) {
			case 'Desarrollo':
				$id=0;
				break;
			case 'Reurbanización':
				$id=1;
				break;
			case 'Saneamiento':
				$id=2;
				break;
			case 'Urbanización':
				$id=3;
				break;
		}
		// $cantLicencias = array('id' => $id);
		$bandera=true;
		array_push($cantLicencias, $id);
	}
	if (isset($_POST['LicPar']) && !empty($_POST['LicPar']) ) {
		// $cantLicencias = array('id' => '4');
		$bandera=true;
		array_push($cantLicencias, '4');
	}
	if (isset($_POST['LicSub']) && !empty($_POST['LicSub']) && 
		isset($_POST['subd']) && !empty($_POST['subd'])) {
		$id;
		switch ($_POST['subd']) {
			case 'Reloteo':
				$id=5;
				break;
			case 'Subdivición Rural':
				$id=6;
				break;
			case 'Subdivición Urbana':
				$id=7;
				break;
		}
		// $cantLicencias = array('id' => $id);
		$bandera=true;
		array_push($cantLicencias, $id);
	}
	if (isset($_POST['LicCons']) && !empty($_POST['LicCons']) && 
		isset($_POST['LicConsC']) && !empty($_POST['LicConsC'])) {
		$bandera=true;
		foreach ($_POST['LicConsC'] as $key => $value) {
			array_push($cantLicencias, $value);
		}
	}
	if (isset($_POST['LicRec']) && !empty($_POST['LicRec']) ) {
		// $cantLicencias = array('id' => '4');
		$bandera=true;
		array_push($cantLicencias, '17');
	}
	if (isset($_POST['LicOtras']) && !empty($_POST['LicOtras']) && 
		isset($_POST['otrasact']) && !empty($_POST['otrasact'])) {
		$id;
		switch ($_POST['otrasact']) {
			case 'Ajuste de Cotas':
				$id=18;
				break;
			case 'Concepto de Norma':
				$id=19;
				break;
			case 'Concepto de Uso de Suelos':
				$id=20;
				break;
			case 'Copia Certificada de Planos':
				$id=21;
				break;
			case 'Modificacion de Planos':
				$id=22;
				break;
			case 'Propiedad Horizontal':
				$id=23;
				break;
			case 'Movimiento de Tierras':
				$id=24;
				break;
			case 'Aprobacion de Piscina':
				$id=25;
			
		}
		// $cantLicencias = array('id' => $id);
		$bandera=true;
		array_push($cantLicencias, $id);
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
		$respuesta=031;
	}

	echo $respuesta;
}
else if (!empty($_POST['btn_predio'])) {
	// unset($_SESSION['radicar']);
	$respuesta;
	if ( !empty($_POST['dirActual']) && !empty($_POST['BarrioActual']) &&
		 !empty($_POST['dirAnterior']) && !empty($_POST['BarrioAnterior']) &&
		 !empty($_POST['matricula']) && !empty($_POST['catastral']) &&
		 !empty($_POST['clasificacionsuelo']) && !empty($_POST['planimetria']) ) {

		$_SESSION['dirActual'] = $_POST['dirActual'];
		$_SESSION['BarrioActual'] = $_POST['BarrioActual'];
		$_SESSION['dirAnterior'] = $_POST['dirAnterior'];
		$_SESSION['BarrioAnterior'] = $_POST['BarrioAnterior'];
		$_SESSION['matricula'] = $_POST['matricula'];
		$_SESSION['catastral'] = $_POST['catastral'];
		$_SESSION['clasificacionsuelo'] = $_POST['clasificacionsuelo'];
		$_SESSION['planimetria'] = $_POST['planimetria'];

		$respuesta = 132;
		$_SESSION['radicar'] = 132;
			
		// $sql = sprintf("INSERT INTO predios 
		//        VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
		      
		//        GetSQLValueString($_POST['dirActual'], "text"),
		//        GetSQLValueString($_POST['BarrioActual'], "text"),
		//        GetSQLValueString($_POST['dirAnterior'], "text"),
		//        GetSQLValueString($_POST['BarrioAnterior'], "text"),
		//        GetSQLValueString($_POST['matricula'], "int"),
		//        GetSQLValueString($_POST['catastral'], "int"),
		//        GetSQLValueString($_POST['clasificacionsuelo'], "text"),
		//        GetSQLValueString($_POST['planimetria'], "int"));

		// $result = $mysqli->query($sql);

		// if ($result) {
		// 	scripts('../');
  //       	// $_SESSION['nit']= $_POST['nit'];
		// 	confirmar('OPERACION EXITOSA! <br> CONTINUEMOS', 'fa fa-check-square', 'green', '../modules/radication');
	        
		// 	$_SESSION['radicar'] = 132;
		// 	echo 132;
  //       }else{

  //       	// $_SESSION['nit']= $_POST['nit'];
  //       	/*scripts('../');
	 //        confirmar('ERROR 300! CONSULTE A SU DPTO DE SISTEMAS', 'fa fa-check-square', 'red', '../modules/radication');*/
  //       }
	}
	else{
		$respuesta=032;
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
			// $prueba.= ' / '. $_POST['nombre'][$key];
			// $prueba.= ' / '. $_POST['diractual'][$key];
			// $prueba.= ' / '. $_POST['dircorres'][$key];
			array_push($datosVecino, $_POST['nombre'][$key]);
			array_push($datosVecino, $_POST['diractual'][$key]);
			array_push($datosVecino, $_POST['dircorres'][$key]);

			array_push($cantVecinos, $datosVecino);

			$datosVecino=  array();

		// if ($cant != $key) {
		// 	$values.="( '$nombre', '$dirActual', '$dirCorrespondencia' ),";
		// 	}
		// 	else{
		// 		$values.="( '$nombre', '$dirActual', '$dirCorrespondencia' )";
		// 	}
		}

		// $sql="INSERT INTO vecinos VALUES ".$values;
		// echo "$sql";

		$_SESSION['vecinos'] = $cantVecinos;

		$_SESSION['radicar'] = 133;
		$respuesta = 133; //$prueba;
	}
	else{
		$respuesta = 033;
	}
	echo $respuesta;
}
else if (!empty($_POST['btn_titular'])) {
	$respuesta;
	if (!empty($_POST['nit'][0]) ) {

		// $cantVecinos=  array();
		// $datosVecino=  array();
		// $prueba='';
		// foreach ($_POST['nit'] as $key => $value) {
		// 	// $prueba.= ' / '. $_POST['nombre'][$key];
		// 	// $prueba.= ' / '. $_POST['diractual'][$key];
		// 	// $prueba.= ' / '. $_POST['dircorres'][$key];
		// 	array_push($datosVecino, $_POST['nombre'][$key]);
		// 	array_push($datosVecino, $_POST['diractual'][$key]);
		// 	array_push($datosVecino, $_POST['dircorres'][$key]);

		// 	array_push($cantVecinos, $datosVecino);

		// 	$datosVecino=  array();

		// // if ($cant != $key) {
		// // 	$values.="( '$nombre', '$dirActual', '$dirCorrespondencia' ),";
		// // 	}
		// // 	else{
		// // 		$values.="( '$nombre', '$dirActual', '$dirCorrespondencia' )";
		// // 	}
		// }

		// // $sql="INSERT INTO vecinos VALUES ".$values;
		// // echo "$sql";

		$_SESSION['titulares'] = $_POST['nit'];

		$_SESSION['radicar'] = 134;
		$respuesta = 134; //$prueba;
	}
	else{
		$respuesta = 134;
	}
	echo $respuesta;
}
else if (!empty($_POST['btn_Profesionales'])) {
	$responsables = array();
	$respuesta;

	if (!empty($_POST['nit1']) ) {
		array_push($responsables, $_POST['nit1']);

		if (!empty($_POST['nit2']) ) {
			array_push($responsables, $_POST['nit2']);
		}
		if (!empty($_POST['nit3']) ) {
			array_push($responsables, $_POST['nit3']);
		}
		if (!empty($_POST['nit4']) ) {
			array_push($responsables, $_POST['nit4']);
		}
		if (!empty($_POST['nit5']) ) {
			array_push($responsables, $_POST['nit5']);
		}
		if (!empty($_POST['nit6']) ) {
			array_push($responsables, $_POST['nit6']);
		}
		if (!empty($_POST['nit7']) ) {
			array_push($responsables, $_POST['nit7']);
		}
		if (!empty($_POST['nit8']) ) {
			array_push($responsables, $_POST['nit8']);
		}
		$_SESSION['responsables'] = $responsables;
		$_SESSION['radicar'] = 135;
		$respuesta = 135;
	}else{
		$respuesta = 035;
	}

	echo $respuesta;
}
else if (!empty($_POST['btn_docs'])) {
	$_SESSION['radicar'] = 136;
	echo 136;
}


else if (!empty($_POST['nit']) && isset($_POST['celular']) && isset($_POST['email']) && isset($_POST['direccion']) && isset($_POST['id_barrio']) ) {
	
	$resultado;
	$nit = $_POST['nit'];
	$celular = $_POST['celular'];
	$email = $_POST['email'];
	$direccion = $_POST['direccion'];
	$id_barrio = $_POST['id_barrio'];

	$sql=sprintf("UPDATE terceros SET celular = %s, email = %s, direccion = %s, id_barrio = %s  WHERE nit = %s ",
		GetSQLValueString($celular, "text"),
		GetSQLValueString($email, "text"),
		GetSQLValueString($direccion, "text"),
		GetSQLValueString($id_barrio, "int"),
		GetSQLValueString($nit, "int")
	);

		$result =$mysqli->query($sql);

		// echo ($sql)? $sql : 'error'; 
		echo ($result)? 1 : 1111;
}
else if (!empty($_POST['nit'])) {
	
	$nit = $_POST['nit'];
	$sql=sprintf("SELECT nombre, apellido, celular, email, direccion, id_barrio FROM terceros WHERE nit = %s ",
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
							'id_barrio'	=> $datos['id_barrio']
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
	$arrayjson = array();
	$arrayjson[] = array(
					'estado'	=> 0 );

	echo json_encode($arrayjson);
}


