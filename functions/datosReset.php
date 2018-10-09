<?php

	date_default_timezone_set('America/Bogota');
	$fecha_registro = date('H:i:s');//fecha actual.
	$hora =strtotime('+15 minutes');
	$hora2 = date('H:i:s', $hora);

	$mysqli = mysqli_init();
	if (!$mysqli) {
		die('Falló mysqli_init');
	}

	if (!$mysqli->real_connect("localhost", "issei", "DAGtgbnhy65", "issei")) {
		die('Error de conexión (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	function generearCodigoEnvio() {
	    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $caracteresLength = strlen($caracteres);

	    //$caracteresOpcion = split('', $caracteres);
	    
	    $codigoEnvio = '';
	    for ($j = 0; $j < 8; $j++) {

	        $codigoEnvio .= $caracteres[rand(0, $caracteresLength - 1)];
	    }
	    return $codigoEnvio;
	}
	
	if ( (!empty($_POST['cedula']) && isset($_POST['cedula']) ) && (!empty($_POST['email']) && isset($_POST['email'])) ) {
		
		$cedula = $_POST['cedula'];
		$email = $_POST['email'];


		$sql = "SELECT nit, email, nombre FROM terceros
							WHERE nit='$cedula' AND email='$email'";

			$result = $mysqli->query($sql);
			$fila = mysqli_fetch_assoc($result);

			if($fila>0){
				
				session_start();
				// if (session_status() == PHP_SESSION_ACTIVE) {
				//   echo "<script>alert('SESSION ACTIVA');</script>";
				// }

				echo($_SESSION['CODIGO'] . " aqui debio imprimier a sesions\n" );

				if (!isset($_SESSION['CODIGO']) && empty($_SESSION['CODIGO']) ) {
					
					$codigo = generearCodigoEnvio();

					$_SESSION['CEDULA']= $fila['nit'];
					$_SESSION['CODIGO']= $codigo;

					$to = $email; // note the comma

					// Subject
					$subject = 'Recuperacion de Contraseña';

					// Message
					$message = '
					Tu codigo de recuperacion es <span>'.$codigo.'</span> y caducara en 15 minutos '.$hora2;

					// To send HTML mail, the Content-type header must be set
					$headers = 'MIME-Version: 1.0';
					$headers .= 'Content-type: text/html; charset=iso-8859-1';

					 mail($to, $subject, $message,  $headers);

					 echo($_SESSION['CODIGO'] . " aqui debio imprimier a sesions2" );

					 echo "<script>alert('".$_SESSION['CODIGO']."');
					window.location='../modules/login/nuevaPassword.php';
					 </script>";
				}
				else{
					 ?>
				    	<script>
							alert('El codigo ya fue enviado a su correo, \nPorfavor Revisa<?php echo $_SESSION['CODIGO'] ; ?>');
							window.location='../modules/login/nuevaPassword.php';
						</script>
					<?php
				}
			}
			else{
				?>
			    	<script>
						alert('Los Datos ingresados no son Validos, \nPorfavor vuelve a Intentar');
						window.location='../modules/login/reset.php';
					</script>
				<?php
			}
	}
	else{

	session_unset();
	session_destroy();
?>
    	<script>
			alert("Todos los Campos son Necesarios, \nPorfavor vuelve a Intentar");
			window.location='../modules/login/reset.php';
		</script>

<?php
			 
	}
 ?>
