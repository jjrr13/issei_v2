<?php 
include_once "../cx/cx.php";

if (!empty($_POST['nit'])) {
	
	$nit = $_POST['nit'];
	$sql=sprintf("SELECT nombre, apellido, celular, email FROM terceros WHERE nit = %s ",
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
							'email'		=> $datos['email']
			);

			echo json_encode($arrayjson);
		}
		else{
			$arrayjson = array();
			$arrayjson[] = array(
							'estado'	=> 2 );

			echo json_encode($arrayjson);
		}
}
else{
	$arrayjson = array();
	$arrayjson[] = array(
					'estado'	=> 0 );

	echo json_encode($arrayjson);
}


