
<?php
	require_once("cx.php");
	session_start();

	if($_SESSION['id_usuario']){
	  //Esta funcion destruye todas las sesiones asociativas
		session_unset();
		session_destroy();
		header("location: ../");
	}
	else{
		header("location: ../");
	}
?>
