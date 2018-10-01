<?php 
		require_once('../cx/cx.php');

	if ( (isset($_POST['codigoP']) && !empty($_POST['codigoP'])) &&
		(isset($_POST['nuevaP']) && !empty($_POST['nuevaP'])) &&
		(isset($_POST['confirmeP']) && !empty($_POST['confirmeP'])) ) {
		
		

		$msj="";
		$cedula = $_SESSION['CEDULA'];
		$codigo = $_SESSION['CODIGO'];
		$codigoP = $_POST['codigoP'];
		$nuevaP = $_POST['nuevaP'];
		$confirmeP = $_POST['confirmeP'];

		if ($codigo != $codigoP) {
			$msj .= "error1=1&";
			
		}
		if ($nuevaP != $confirmeP) {
			$msj .= "error2=2";
		}

		if (!empty($msj)) {
			
			header('Location: ../modules/login/nuevaPassword.php?'.$msj);

		}else{

			$pass = sha1("DAGqazxsw21"."$nuevaP");

			$sql = "UPDATE usuarios SET password = '$pass' WHERE nit = '$cedula'";

			$result = $mysqli->query($sql);

			if($result){
				session_unset();
				session_destroy();

				echo "<script>alert('Su Clave ha sido Guardada Exitosamente!!!...');
				window.location='../';
				</script>";
			}
		}
	}else{
		echo "<script>alert('Todos los campos son Obligatorios...!!!');
		window.location='../modules/login/nuevaPassword.php';
		</script>";
	}



 ?>

