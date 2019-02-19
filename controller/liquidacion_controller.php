
<?php 
	$ruta="../";
	
	include_once $ruta."cx/cx.php";
	
// $_POST['buscaRad']=909090;
	$tipos_usos= array();
	$tipos_licencias = array();
	// $titulares = array();
	// var_dump($_SESSION['conceptos']);

// 	echo crearTabla($_SESSION['conceptos'])	;

// echo "<pre>";
// var_dump($_SESSION['pos']);
// echo "</pre>";

// echo "<hr>";

// echo "<pre>";
// var_dump($_SESSION['campos']);
// echo "</pre>";

// echo "<hr>";

// echo "<pre>";
// var_dump($_SESSION['entradas']);
// echo "</pre>";

// echo "<hr>";

// echo "<pre>";
// var_dump($_SESSION['conceptos']);
// echo "</pre>";

// echo "<hr>";
// echo "<pre>";
// var_dump($_SESSION['cont1']);
// echo "<hr>";
// var_dump($_SESSION['cont2']);
// echo "</pre>";
	
if($_POST){
	$_SESSION['pos'] = $_POST;
}
	function validarVacios($array1, $array2)
	{
		$retorno=111;
		for ($j=0; $j < sizeof($array1); $j++) {

			if ($array1[$j][1]==0 && $array2[$j][1]==0) {
				$retorno = $array1[$j][2];
				break;
			}
		}
		return $retorno;
	}

	if (!empty($_POST['usos']) && !empty($_POST['tipoModalidades']) ) {
		$_SESSION['campos'] = array();
		$_SESSION['entradas'] = array();
		$cont1 = array();
		$cont2 = array();
		$retorno=111;
		// La funcion explode convertira la cadena a arreglo
		$estrato = !empty($_POST['estrato']) ? $_POST['estrato'] : '' ;
		$_SESSION['conceptos'] = array();

		array_push($_SESSION['entradas'], 'Paso el primer if de llegada');

		$uso = explode(',', $_POST['usos']);
		$modalidad = explode(',', $_POST['tipoModalidades']);
		$verificaCAntidades = true;

		for ($j=0; $j < sizeof($uso); $j++) { 
			$cant=0;
			array_push($_SESSION['entradas'], 'Entro al primer Ciclo '.$j);
			// if ($uso[$j] == 'Vivienda' ) {
			// 	$estrato2 = $estrato;
			// }
			for ($jr=0; $jr < sizeof($modalidad); $jr++) {
				array_push($_SESSION['entradas'], 'Entro al segundo Ciclo '.$jr);
				
				$datoModalidad = $modalidad[$jr];
				$modalidad[$jr] = unir($modalidad[$jr]);

				if ($uso[$j]=='Comercio y/o Servicios') {
					$temp = explode(' ', $uso[$j]);
					$uso[$j] = $temp[0];
				}
				
				$datoModalidad = ($datoModalidad == 'N-A') ? 'Reconocimiento' : $datoModalidad ;

				$fQ = $uso[$j].'_'.$modalidad[$jr];
					array_push($_SESSION['campos'], $fQ);
					array_push($_SESSION['entradas'], 'Nombre del campo '.$fQ);
					array_push($_SESSION['entradas'], 'Valor del campo '.$_POST[$fQ]);
				if (!empty($_POST["$fQ"])) {
					$cant++;
					
					$estrato2 =  ($uso[$j] == 'Vivienda' ) ? 'Estrato '.$estrato : '' ;


					$concepto = $datoModalidad.' '.$uso[$j].' '.$estrato2 ;

					$variable = $uso[$j].'_'.$modalidad[$jr].'_2';

					$fQ =  $_POST[$fQ];
					$variable = $_POST[$variable];

					array_push($_SESSION['conceptos'], array(  "1"  => $concepto,  "2" => $fQ,  "3" => $variable ));

					if ($j==0) {
						array_push($cont1, array(  "1"  => 1,  "2" => $datoModalidad));
					}else if ($j==1){
						array_push($cont2, array(  "1"  => 1,  "2" => $datoModalidad));
					}

				}
				else{
					if ($j==0) {
						array_push($cont1, array(  "1"  => 0,  "2" => $datoModalidad));
					}else if ($j==1){
						array_push($cont2, array(  "1"  => 0,  "2" => $datoModalidad));
					}
				}
				
			}
			array_push($_SESSION['entradas'], 'Valor del de Buenos '.$cant);
		}
		$_SESSION['cargoBasico'] = $_POST['cargoBasico'];
		// $_SESSION['cont1']= $cont1;
		// $_SESSION['cont2']= $cont2;
		echo validarVacios($cont1, $cont2);
	}
	else if (isset($_POST['buscaRad']) && !empty($_POST['buscaRad']) ) {
		$radicado = $_POST['buscaRad'];

		$sql = "SELECT nombre, estrato, categoria, DATE_FORMAT(fecha,'%Y-%m-%d') fecha, objetivo_id FROM radicacion WHERE consecutivo = '$radicado' AND  estado_id < 7";
 

		$result =$mysqli->query($sql);
		$fila1 = mysqli_num_rows($result);

		if ($fila1 > 0) {
			$datos = mysqli_fetch_assoc($result);
			
			////////////// traer las direcciones del proyecto  ///////////////////////
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
			$_SESSION['nombreProyecto'] = $datos['nombre'];
			$_SESSION['estrato'] = $datos['estrato'];
			$_SESSION['fecha'] = $datos['fecha'];
			$_SESSION['objetivo_id'] = $datos['objetivo_id'];
			$_SESSION['categoria'] = $datos['categoria'];
			$_SESSION['direccion'] = $direccion;

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
			$sql4 = "SELECT concat(t.nombre, ' ', t.apellido) as nombre FROM rad_respo rr 
        INNER JOIN terceros t ON t.nit =  rr.id_terc
        WHERE rr.id_rad = '$radicado' AND rr.id_profesion = 5 ";

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
      $valores5 = mysqli_fetch_array($result5);
			// while ($valores5 = mysqli_fetch_array($result5)) {
			// 	$titulares.= $valores5['nombre'].', ';
			// }
      $fila5 = mysqli_num_rows($result5);

			if ($fila5 > 0) {
				$values="";
				$cant = count($valores5)-1;

				if ($cant <= 1) {
					$values = $valores5[0];
				}
				else{
					foreach ($valores5 as $key => $value) {

						$titular = $valores5[$key];

						if ($cant != $key) {
							$values.="$titular, ";
						}
						else{
							$values.="y $titular ";
						}
					}
				}
				$_SESSION['titulares'] = $values;
			}
			$arrayjson = array();
			$arrayjson[] = array(
							'radicado'     => $_SESSION['radicado'],
							'nombreProyecto'	   => $_SESSION['nombreProyecto'],
							'estrato'	   => $_SESSION['estrato'],
							'dir_act'    => $_SESSION['direccion'],
							'barrio_act'    => '',
							'fecha'			=> $_SESSION['fecha'],
							'objetivo_id'			=> $_SESSION['objetivo_id'],
							'tipos_licencias' => $tipos_licencias,
							'tipos_usos'	=> $tipos_usos,
							'construRespon'			=> $_SESSION['construRespon'],
							'titulares'			=> $_SESSION['titulares']
			);

			echo json_encode($arrayjson);

		}
		else{
			//181378		3434 	760011181378 	bloqueado 	2019-02-08 11:08:31
			echo 3; 
		}
	}
	else if (isset($_POST['cancelar']) && !empty($_POST['cancelar'])) {
		unset($_SESSION['radicado']);
		unset($_SESSION['titulares']);
		unset($_SESSION['construRespon']);
		unset($_SESSION['nombreProyecto']);
		unset($_SESSION['direccion']);
		unset($_SESSION['estrato']);
		unset($_SESSION['fecha']);
		unset($_SESSION['objetivo_id']);
		echo 4;
	}
	else{
		// unset($_SESSION['nit']);
		// unset($_SESSION['nombre']);
		// unset($_SESSION['apellido']);
		//no llegaron datos
		// unset($_SESSION['radicado']);
		// unset($_SESSION['titulares']);
		// unset($_SESSION['construRespon']);
		// unset($_SESSION['nombreProyecto']);
		// unset($_SESSION['direccion']);
		// unset($_SESSION['estrato']);
		// unset($_SESSION['fecha']);
		// unset($_SESSION['objetivo_id']);
		// echo 0;
	}
 
	function unir($modalidad1)
	{
		$tem = explode(' ', $modalidad1);
		if ( sizeof($tem)>1) {
			$union='';
			for ($js=0; $js < sizeof($tem); $js++) {
				$union.=$tem[$js];
			}
			return $union;
		}
		else{
			return $modalidad1;
		}

	}



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
		// $variable = $valores[$key];
		$elemento.='
				<tr>';
		foreach ($valores[$key] as $key2 => $value2) {
			$elemento.='
				<td>';
						$elemento.=$valores[$key][$key2];
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