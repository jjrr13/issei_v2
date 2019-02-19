<?php 
	$ruta="../";
	
	include_once $ruta."cx/cx.php";
	scripts($ruta);
	
	if ( (isset($_POST['password']) && !empty($_POST['password']) ) &&
		 (isset($_POST['usuario']) && !empty($_POST['usuario']) ) &&
		 (isset($_POST['area']) && !empty($_POST['area']) ) &&
		 (isset($_POST['cargo']) && !empty($_POST['cargo']) ) &&
		 (isset($_POST['perfil']) && !empty($_POST['perfil']) ) ) {

	
			$estado = 1;
			$password = $_POST['password'];
			$pass = sha1("DAGqazxsw21"."$password");

			$sql = sprintf("INSERT INTO usuarios 
			                  (nit, usuario, password, id_area, id_cargo, id_tipo_usuario, estado, id_creacion, fecha_registro)
			                  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",

			                  GetSQLValueString($_SESSION['nit2'], "int"),
			                  GetSQLValueString($_POST['usuario'], "text"),
			                  GetSQLValueString($pass, "text"),
			                  GetSQLValueString($_POST['area'], "int"),
			                  GetSQLValueString($_POST['cargo'], "int"),
			                  GetSQLValueString($_POST['perfil'], "int"),
			                  GetSQLValueString($estado, "int"),
			                  GetSQLValueString($_SESSION['id_usuario'], "int"), 
			                  GetSQLValueString($fecha_registro, "date"));  

			$result = $mysqli->query($sql);

			if($result){
				unset($_SESSION['nit2']);
				unset($_SESSION['nombre2']);
				unset($_SESSION['apellido2']);

				echo "
					<script  type='text/javascript'>
		                $.confirm({
		                    icon: 'fa fa-check-square',
		                    theme: 'supervan',
		                    closeIcon: false,
		                    content: 'USUARIO CREADO EXISTOSAMENTE CONTINUEMOS',
		                    animation: 'scale',
		                    type: 'green',
		                    buttons: {
		                        'ok': {
		                            text: 'OK',
		                            btnClass: 'btn-blue',
		                            action: function () {
		                                console.log('se violo la seguridad');
		                                window.location.replace('../modules/users');
		                            }
		                        },
		                    }
		                });

		        	</script>";
			}else{
				unset($_SESSION['nit2']);
				unset($_SESSION['nombre2']);
				unset($_SESSION['apellido2']);

				echo "
					<script  type='text/javascript'>
		                $.confirm({
		                    icon: 'fa fa-window-close',
		                    theme: 'supervan',
		                    closeIcon: false,
		                    content: 'ERROR 300! CONSULTE A SU DPTO DE SISTEMAS',
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        'ok': {
		                            text: 'OK',
		                            btnClass: 'btn-blue',
		                            action: function () {
		                                console.log('se violo la seguridad');
		                               // window.location.replace('../modules/users');
		                            }
		                        },
		                    }
		                });
		        	</script>";
			}

	}
	elseif (isset($_POST['cc']) && !empty($_POST['cc'])) {

		$nit = $_POST['cc'];
		/////////////////////////// consulta si existe el cliente ///////////////////////////////////////
		$sql = "SELECT nit, nombre, apellido FROM terceros WHERE nit = '$nit'";

		$result =$mysqli->query($sql);
		$datos = mysqli_fetch_assoc($result);
		$result = mysqli_num_rows($result);


		if ($result > 0) {
			/////////////////////////// consulta si existe el usuario ///////////////////////////////////////
			$sql = "SELECT nit FROM usuarios WHERE nit = '$nit'";

			$result2 =$mysqli->query($sql);
			$result2 = mysqli_num_rows($result2);

			if ($result2 > 0) {
				unset($_SESSION['nit2']);
				unset($_SESSION['nombre2']);
				unset($_SESSION['apellido2']);

				echo "
					<script  type='text/javascript'>						
		                $.confirm({
		                    icon: 'fa fa-window-close',
		                    theme: 'supervan',
		                    closeIcon: false,
		                    content: 'EL USUARIO YA EXISTE!!',
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        'ok': {
		                            text: 'OK',
		                            btnClass: 'btn-blue',
		                            action: function () {
		                                console.log('se violo la seguridad');
		                                window.location.replace('../modules/users');
		                            }
		                        },
		                    }
		                });

		        	</script>";
			}
			else{
				$_SESSION['nit2'] = $datos['nit'];
				$_SESSION['nombre2'] = $datos['nombre'];
				$_SESSION['apellido2'] = $datos['apellido'];
				header('Location: ../modules/users');
			}

		}
		else{
			unset($_SESSION['nit2']);
			unset($_SESSION['nombre2']);
			unset($_SESSION['apellido2']);

			echo "
				<script  type='text/javascript'>
	                $.confirm({
	                    icon: 'fa fa-window-close',
	                    theme: 'supervan',
	                    closeIcon: false,
	                    content: 'EL DOCUMENTO NO SE ENCUENTRA REGISTRADO',
	                    animation: 'scale',
	                    type: 'red',
	                    buttons: {
	                        'ok': {
	                            text: 'OK',
	                            btnClass: 'btn-blue',
	                            action: function () {
	                                console.log('se violo la seguridad');
	                                window.location.replace('../modules/client');
	                            }
	                        },
	                    }
	                });
	        	</script>";
		}
	}
	else{
		echo "
			<script  type='text/javascript'>
                $.confirm({
                    icon: 'fa fa-window-close',
                    theme: 'supervan',
                    closeIcon: false,
                    content: 'RECUERDE QUE LOS CAMPOS CON (*) SON OBLIGATORIOS!',
                    animation: 'scale',
                    type: 'red',
                    buttons: {
                        'ok': {
                            text: 'OK',
                            btnClass: 'btn-blue',
                            action: function () {
                                console.log('se violo la seguridad');
                                window.location.replace('../modules/users');
                            }
                        },
                    }
                });
        	</script>";
	}
 ?>