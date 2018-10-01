<?php 

	session_start();
	
if ($_POST['cancelar']==8) {
	unset($_SESSION['nit']);
	unset($_SESSION['nombre']);
	unset($_SESSION['apellido']);
	 header("location: ../modules/quotes");
}elseif ($_POST['cancelar']==9) {
	 header("location: ../modules/quotes");
}elseif ($_POST['cancelar']==10) {
	unset($_SESSION['nit2']);
	unset($_SESSION['nombre2']);
	unset($_SESSION['apellido2']);
	 header("location: ../modules/users");
}elseif (isset($_POST['cancelar'])) {
	header('Location: ../modules/quotes');
	
}


 ?>