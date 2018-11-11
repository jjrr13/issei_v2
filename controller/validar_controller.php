<?php

//Proceso de conexion a la base de datos
	$ruta="../";
	require_once("../cx/cx.php"); 
	scripts($ruta);
	
//por que primero hace la consulta y despues valida si llego o no llego ? 
	if( (isset($_POST['usuario']) && !empty($_POST['usuario'])) &&
		(isset($_POST['pass']) && !empty($_POST['pass'])) ){
    
      $user = $_POST['usuario'];
      $passconvert= $_POST['pass'];
      $password = sha1("DAGqazxsw21"."$passconvert");

    // echo "<script>alert('$user -> $passconvert -> $password');</script>";
    //echo sha1(be50abbe40fb758f18ea1658cd8b97cfc34c4c15);

      $sql = "SELECT u.id_usuario, u.nit, CONCAT(t.nombre,' ',t.apellido) as nombre, u.usuario, u.password, u.estado, u.id_area, a.area, u.id_tipo_usuario, tp.tipo_usuario, u.fecha_registro
							FROM usuarios u, terceros t, area a, tipo_usuario tp
							WHERE u.usuario='$user' AND u.password='$password' AND t.nit = u.nit AND a.id_area = u.id_area AND tp.id_tipo_usuario = u.id_tipo_usuario AND u.estado = 1";
			$result = $mysqli->query($sql);
			$fila = mysqli_fetch_assoc($result);

			if($fila>0){
				//por que validar si es un array y luego si llego ? creo que con solo is_array se validan las dos
				if(is_array($fila) and isset($fila)){
          $_SESSION['nombre_usuario'] = $fila['nombre'];
					$_SESSION['id_usuario'] = $fila['id_usuario'];
					$_SESSION['id_tipo_usuario'] = $fila['id_tipo_usuario'];
					$_SESSION['id_area'] = $fila['id_area'];
					
          echo "<script>localStorage.setItem('cita', null);</script>";
					//dependiendo de quien se logeo se redirecciona hacia el lugar que le corresponde
					
						
						header("location: ../modules/");	

				}

			}else{

        echo "
				<script  type='text/javascript'>
				console.log('le viole la seguridad');
   	        	 	
                $.confirm({
                    icon: 'fa fa-user-circle-o',
                    theme: 'supervan',
                    closeIcon: false,
                    content: 'Credenciales Incorrestras! <br>Por favor, Intente de nuevo',
                    animation: 'scale',
                    type: 'red',
                    buttons: {
                        'ok': {
                            text: 'OK',
                            btnClass: 'btn-blue',
                            action: function () {
                                console.log('se violo la seguridad');
                                window.location.replace('../cx/destroy_session.php');
                            }
                        },
                    }
                });

        </script>";
			}
	}else{
    echo "<script  type='text/javascript'>
        console.log('paso por aqui1');

          $.confirm({
              icon: 'fa fa-user-circle-o',
              theme: 'supervan',
               content: 'Todos los campos son requeridos! <br>Por favor, Intente de nuevo',
              closeIcon: false,
              animation: 'scale',
              type: 'red',
              buttons: {
                  'ok': {
                      text: 'OK',
                      btnClass: 'btn-blue',
                      action: function () {
                          console.log('tambien por aqui11');
                          window.location.replace('../cx/destroy_session.php');
                      }
                  },
              }
          });

        </script>";
	}


?>
