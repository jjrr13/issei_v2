
<?php 
	$ruta="../";
	
	include_once $ruta."cx/cx.php";
	
// $_POST['buscaRad']=909090;
	$tipos_usos= array();
	$tipos_licencias = array();
	// $titulares = array();
	
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
	else if (isset($_POST['buscaRad']) && !empty($_POST['buscaRad']) ) {
		$radicado = $_POST['buscaRad'];

		$sql = "SELECT estrato, DATE_FORMAT(fecha,'%Y-%m-%d') fecha FROM radicacion WHERE consecutivo = '$radicado' AND  estado_id < 7";
 

		$result =$mysqli->query($sql);
		$fila1 = mysqli_num_rows($result);

		if ($fila1 > 0) {
			$datos = mysqli_fetch_assoc($result);
			
			$sql1 = "SELECT direccion, barrio FROM radicado_direcciones as rd 
						INNER JOIN barrio as b ON rd.id_barrio = b.id_barrio 
						WHERE rd.id_rad = '$radicado'";
			$result1 =$mysqli->query($sql1);
			$filas = mysqli_num_rows($result1);
			$j=0;
			$direccion='';
			while ($datos1 = mysqli_fetch_array($result1)) {
				if ($j == $filas-1) {
					$direccion .= $datos1['direccion'].' '.$datos1['barrio'].'.';
					// $direccion['barrio'] .= $datos1['barrio'].'.';
				}
				else{
					$direccion .= $datos1['direccion'].' '.$datos1['barrio'].', ';
					// $direccion['barrio'] .= $datos2['barrio'].', ';
				}
				$j++;
			}

			$_SESSION['radicado'] = $radicado;
			$_SESSION['estrato'] = $datos['estrato'];
			$_SESSION['fecha'] = $datos['fecha'];

////////////// traer las licencias del proyecto  ///////////////////////
			$sql2 = "SELECT id_lic, tipo_licencias.nombre, modalidad FROM rad_lic 
		        INNER JOIN tipo_licencias ON tipo_licencias.id =  rad_lic.id_lic
		        WHERE id_rad = '$radicado'";

			$result2 =$mysqli->query($sql2);
			// $result2 = mysqli_num_rows($result2);
      while ($valores2 = mysqli_fetch_array($result2)) {

        array_push($tipos_licencias, array('ID'=> $valores2['id_lic'], 'NOMBRE'=> $valores2['nombre'], 'MODALI'=> $valores2['modalidad']));

      }

////////////// traer los usos del proyecto  ///////////////////////
			$sql3 = "SELECT rad_usos.id_usos, nombre FROM rad_usos 
        INNER JOIN radicado_usos ON radicado_usos.id_usos =  rad_usos.id_usos
        WHERE id_rad = '$radicado'";

			$result3 =$mysqli->query($sql3);
			// $result3 = mysqli_num_rows($result3);

			while ($valores3 = mysqli_fetch_array($result3)) {
				array_push($tipos_usos, [$valores3['id_usos'] => $valores3['nombre']] );
			}

////////////// traer el constructor responsable ///////////////////////
			$sql4 = "SELECT t.nombre FROM rad_respo rr 
        INNER JOIN terceros t ON t.nit =  rr.id_terc
        WHERE rr.id_rad = '$radicado' AND rr.id_profesion = 3 ";

			$result4 =$mysqli->query($sql4);
			$datos2 = mysqli_fetch_assoc($result4);
			$result4 = mysqli_num_rows($result4);

			if ($result4 > 0) {
				$_SESSION['construRespon'] = $datos2['nombre'];
			}else{$_SESSION['construRespon']=''; }

//////////////// traer los titulares //////////////////////////////////
			$sql5 = "SELECT t.nombre FROM rad_titulares rt 
        INNER JOIN terceros t ON t.nit =  rt.id_terc
        WHERE rt.id_rad = '$radicado'";

      $result5 =$mysqli->query($sql5);
      $titulares='';
			while ($valores5 = mysqli_fetch_array($result5)) {
				$titulares.= $valores5['nombre'].', ';
			}

			$arrayjson = array();
			$arrayjson[] = array(
							'radicado'     => $_SESSION['radicado'],
							'estrato'	   => $_SESSION['estrato'],
							'dir_act'    => $direccion,
							'barrio_act'    => $_SESSION['barrio'],
							'fecha'			=> $_SESSION['fecha'],
							'tipos_licencias' => $tipos_licencias,
							'tipos_usos'	=> $tipos_usos,
							'construRespon'			=> $_SESSION['construRespon'],
							'titulares'			=> $titulares
			);

			echo json_encode($arrayjson);
			// var_dump($arrayjson);
			// header('Location: ../quotes');
			// echo 2;

		}
		else{
			
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