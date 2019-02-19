
<?php 
	$ruta="../";
	
	include_once $ruta."cx/cx.php";
	


	
	if ( (isset($_POST['nombre']) && !empty($_POST['nombre']) ) &&
		 (isset($_POST['apellido']) && !empty($_POST['apellido']) ) &&
		 (isset($_POST['atendio']) && !empty($_POST['atendio']) ) &&
		 (isset($_POST['fecha_cita']) && !empty($_POST['fecha_cita']) ) ) {
// echo "<script>alert('entro al if ?');</script>";
			if( isset($_POST['nroradicado']) && !empty($_POST['nroradicado']) ) $nro_radicado = '760011'.$_POST['nroradicado'];
			else $nro_radicado="";

			$hora = date('H:i:s');
			$estado_inicial = '1';
			$atendio = $_POST['atendio'];
			$nrosolicitud = $_POST['nrosolicitud'];
			$nit = $_SESSION['nit'];
			$nombres = $_POST['nombre'] ." ". $_POST['apellido'];

			$sql = sprintf("INSERT INTO agendamiento (nit,
			        nro_radicado, nro_solicitud, fecha, hora, id_consulta, id_asignado, id_estado, id_creacion, fecha_registro)
			       VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			      
			       GetSQLValueString($_SESSION['nit'], "int"),
			       GetSQLValueString($nro_radicado, "text"),
			       GetSQLValueString($_POST['nrosolicitud'], "text"),
			       GetSQLValueString($_POST['fecha_cita'], "date"),
			       GetSQLValueString($hora, "time"),
			       GetSQLValueString($_POST['LISTA'], "int"),
			       GetSQLValueString($_POST['atendio'], "int"),
			       GetSQLValueString($estado_inicial, "int"),
			       GetSQLValueString($_SESSION['id_usuario'], "int"),
			       GetSQLValueString($fecha_registro, "datetime"));

			$result = $mysqli->query($sql);

			if($result){
				
				$arrayjson = array();
				$arrayjson[] = array(
								'nit'          =>  $nit,//nit del solicitante
								'nombre'	   => $nombres,// nombres concatenados 
								'funcionario'  => $atendio,//quien atiende
								'nro_radicado' => $nro_radicado,//numero de radicado
								'nrosolicitud' => $nrosolicitud,// numero de solicitud
								'consulta'	   => 'APORTAR plnitos',//tipo de consulta que se realiza
								'hora'		   => $hora//hora de agendamiento
				);
				$_SESSION['nit'];
				unset($_SESSION['nombre']);
				unset($_SESSION['apellido']);

				echo json_encode($arrayjson);
					
				
			}else{
				//scripts($ruta);

				$_SESSION['nit'];

				unset($_SESSION['nombre']);
				unset($_SESSION['apellido']);
				//no se inserto en en la BD
				echo 0;
			}


	}
	else if (isset($_POST['buscanit']) && !empty($_POST['buscanit']) ) {

		$nit = $_POST['buscanit'];

		$sql = "SELECT nit, nombre, apellido FROM terceros WHERE nit = '$nit'";

		$result =$mysqli->query($sql);
		$datos = mysqli_fetch_assoc($result);
		$result = mysqli_num_rows($result);

		if ($result > 0) {
			$_SESSION['nit'] = $datos['nit'];
			$_SESSION['nombre'] = $datos['nombre'];
			$_SESSION['apellido'] = $datos['apellido'];


			// header('Location: ../quotes');
			echo 2;

		}
		else{
			unset($_SESSION['nit']);
			unset($_SESSION['nombre']);
			unset($_SESSION['apellido']);
			//el usuario no existe
			echo 3; 
		}
	}
	else if (isset($_POST['limpiar']) && !empty($_POST['limpiar'])) {
		unset($_SESSION['nit']);
		unset($_SESSION['nombre']);
		unset($_SESSION['apellido']);
		//no llegaron datos
		echo 4;
	}
	else{
		unset($_SESSION['nit']);
		unset($_SESSION['nombre']);
		unset($_SESSION['apellido']);
		//no llegaron datos
		echo 0;
	}
 ?>