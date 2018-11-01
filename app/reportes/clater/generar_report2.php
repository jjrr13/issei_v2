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
	<form action="../clater/report_clater2.php" target="_blank" method="post">
	<div class="container">
		<div class="row">
		<div class="col-sm-12 alto-bajo"></div>
			<div class="col-sm-12">
				<h3>Informe Semanal</h3>
			</div>
			<div class="col-sm-12 alto-sm"></div>
			<div class="col-sm-5">
				<div class="col-sm-12 alto-sm"></div>
				<div class="col-sm-12 alto-sm">
					<center><label for="">Semana 1</label></center>
				</div>
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_inis1">Fecha Inicio&nbsp;&nbsp;</label>
				<input class="form-control" name="f_inis1" type="date" id="f_inis1">
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_fins1">Fecha Final &nbsp;&nbsp;</label>
				<input class="form-control" name="f_fins1" type="date" id="f_fins1">
				<div class="col-sm-12 alto-bajo"></div>
				<div class="col-sm-12 alto-sm">
					<center><label for="">Semana 3</label></center>
				</div>
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_inis3">Fecha Inicio&nbsp;&nbsp;</label>
				<input class="form-control" name="f_inis3" type="date" id="f_inis3">
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_fins3">Fecha Final &nbsp;&nbsp;</label>
				<input class="form-control" name="f_fins3" type="date" id="f_fins3">
				<div class="col-sm-12 alto-sm"></div>
			</div>	
			<div class="col-sm-5">
				<div class="col-sm-12 alto-sm"></div>
				<div class="col-sm-12 alto-sm">
					<center><label for="">Semana 2</label></center>
				</div>
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_inis2">Fecha Inicio&nbsp;&nbsp;</label>
				<input class="form-control" name="f_inis2" type="date" id="f_inis2">
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_fins2">Fecha Final &nbsp;&nbsp;</label>
				<input class="form-control" name="f_fins2" type="date" id="f_fins2">
				<div class="col-sm-12 alto-bajo"></div>
				<div class="col-sm-12 alto-sm">
					<center><label for="">Semana 4</label></center>
				</div>
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_inis4">Fecha Inicio&nbsp;&nbsp;</label>
				<input class="form-control" name="f_inis4" type="date" id="f_inis4">
				<div class="col-sm-12 alto-sm"></div>
				<label for="f_fins4">Fecha Final &nbsp;&nbsp;</label>
				<input class="form-control" name="f_fins4" type="date" id="f_fins4">
				<div class="col-sm-12 alto-sm"></div>
			</div>
			<div class="col-sm-12 alto-bajo"></div>
			<div class="col-sm-12">
				<label for="obs">Observaciones</label>
			</div>
			<div class="col-sm-12">
				<textarea name="obs" id="obs" cols="50" rows="2"></textarea>
			</div>
			<div class="col-sm-12 alto-bajo"></div>
			<div class="col-sm-4">
				<button name="Submit" type="submit" value="subtmi" class="btn btn-primary col-sm-12">Generar Informe</button>
			</div>
		</div>
	</div>
	</form>
	<script src="../../js/jquery.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
</body>
	

</html>
