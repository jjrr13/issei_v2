<?php 

$ruta="../";
	
include_once $ruta."cx/cx.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

if ((isset($_POST['docAportados']) && !empty($_POST['docAportados'][0]>0)) && 
	(isset($_POST['radicado']) && !empty($_POST['radicado'])) ) {
	$radicado = $_POST['radicado'];
	$datos="";
	$cant = count($_POST['docAportados'])-1;


	foreach ($_POST['docAportados'] as $key => $value) {
		$datos.="UPDATE `rad_docs` SET estado = 2 WHERE id_rad_docs = $value AND id_rad = $radicado";
		$datos.="<br>";
	}

	echo "$datos";
	// return $result = $mysqli->query($sql);

}

if ((isset($_POST['observacion']) && !empty($_POST['observacion'])) && 
	(isset($_POST['ubicaciones']) && !empty($_POST['ubicaciones'])) && 
	(isset($_POST['radicado']) && !empty($_POST['radicado'])) ) {
	
	scripts($ruta);
	$radicado = $_POST['radicado'];	

	$sql= sprintf("INSERT INTO hoja_ruta (id_rad, id_usuario, comentario, id_ubicacion) VALUES (%s, %s, %s, %s )", 
				GetSQLValueString($radicado, "text"),
			  GetSQLValueString($_SESSION['id_usuario'], "int"),
			  GetSQLValueString($_POST['observacion'], "text"),
			  GetSQLValueString($_POST['ubicaciones'], "int"));

	$result = $mysqli->query($sql);

	if ($result) {
		confirmar('SE ACTUALIZADO CORRECTAMENTE', 'fa fa-user-circle-o', 'green', '../modules/tracing');
	}
	else{
		confirmar('HUBO UN ERROR AL GUARDAR', 'fa fa-window-close', 'red', '../modules/tracing');
	}
	// echo "$sql";
}