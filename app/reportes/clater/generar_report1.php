<?php

	require_once('../../../cx/cx.php');
	
	session_set_cookie_params('0');
	//Iniciar sesion
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	date_default_timezone_set('America/Bogota');
	$fecha_registro = date('Y-m-d H:i:s');//fecha actual.
	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_tipousuario']; 
	$_SESSION['id_area'];

?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Generacion de Reportes</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../css/styles.css">
<title>Documento sin título</title>
</head>

<body>
	<form action="../clater/report_clater1.php" target="_blank" method="post">
	<div class="container">
		<div class="row">
		<div class="col-sm-12 alto-bajo"></div>
			<div class="col-sm-12 alto-bajo">
				<h3>Informe Mensual</h3>
			</div>
			<div class="col-sm-12 alto-medio"></div>
			<div class="col-sm-4 form-inline">
				<label for="f_ini">Fecha Inicio&nbsp;&nbsp;</label>
				<input class="form-control" name="f_ini" type="date" id="f_ini">
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_fin">Fecha Final &nbsp;&nbsp;</label>
				<input class="form-control" name="f_fin" type="date" id="f_fin">
			</div>
			<div class="col-sm-12 alto-bajo"></div>
			<div class="col-sm-12 alto-bajo">
				<label for="obs">Observaciones</label>
			</div>
			<div class="col-sm-12">
				<textarea name="obs" id="obs" cols="33" rows="8"></textarea>
			</div>
			<div class="col-sm-12 alto-bajo"></div>
			<div class="col-sm-2">
				<button name="Submit" type="submit" value="subtmi" class="btn btn-primary">Generar Informe</button>
			</div>
		</div>
	</div>
	</form>
	<script src="../../../js/jquery.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>
</body>
	

</html>
