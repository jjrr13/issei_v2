<?php 

$ruta="../";
	
include_once $ruta."cx/cx.php";
scripts($ruta);
// echo "
// <link rel='stylesheet' href='".$ruta."cx/demo/libs/bundled.css'>
// 			<link rel='stylesheet' href='".$ruta."cx/demo/demo.css'>
// 			<link rel='stylesheet' type='text/css' href='".$ruta."cx/jquery-confirm.css'>
// 			<!-- Este SCRIPT ejecuta todos los alerts -->
// 			<script src='".$ruta."cx/demo/libs/bundled.js'></script>
// 			<script src='".$ruta."cx/demo/demo.js'></script>
// 			<script type='text/javascript' src='".$ruta."cx/jquery-confirm.js'></script>


// ";


//Esta función calula el digito de verificación para el documento nit.
function calcularDV($nit) {
		if (! is_numeric($nit)) {
			return false;
		}

		$arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19, 8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
		$x = 0;
		$y = 0;
		$z = strlen($nit);
		$dv = '';

		for ($i=0; $i<$z; $i++) {
			$y = substr($nit, $i, 1);
			$x += ($y*$arr[$z-$i]);
		}

		$y = $x%11;

		if ($y > 1) {
			$dv = 11-$y;
			return $dv;
		} else {
			$dv = $y;
			return $dv;
		}

	}
$dv_bd = calcularDV($_POST['nit']);
 	

	if( (!empty($_POST['nit']) && isset($_POST['nit'])) &&
		(!empty($_POST['tdocumento']) && isset($_POST['tdocumento'])) &&
		(!empty($_POST['nombre']) && isset($_POST['nombre'])) &&
		(!empty($_POST['apellido']) && isset($_POST['apellido'])) &&
		(!empty($_POST['ciudad']) && isset($_POST['ciudad'])) &&
		(!empty($_POST['direccion']) && isset($_POST['direccion'])) &&
		(!empty($_POST['barrio']) && isset($_POST['barrio'])) &&
		(!empty($_POST['estrato']) && isset($_POST['estrato'])) &&
		!empty($_SESSION['id_usuario'])

	){

		// echo "<script>alert('". $_POST['nit'] ." / ". $_POST['tdocumento']." / ". $_POST['nombre']." / ". $_POST['apellido']." / ". $_POST['ciudad']." / ". $_POST['direccion']." / ".$_POST['barrio']." / ".$_POST['otro']." / ".$_POST['estrato']." / ".$_SESSION['id_usuario']." / $fecha_registro ')</script>";

/////////////////////////// consulta si existe el cliente ///////////////////////////////////////
		$nit = $_POST['nit'];
		$sql="SELECT nit FROM terceros where nit = $nit";

		$result =$mysqli->query($sql);
		$datos = mysqli_fetch_assoc($result);
		$result = mysqli_num_rows($result);


		if ($result <= 0) {



			$sql = sprintf("INSERT INTO terceros 
		                    (nit, dv, id_tipo_doc, nombre, apellido, lugar_expedicion, direccion, id_barrio, otro_barrio, estrato, telefono1, telefono2, celular, email, id_creacion, fecha_registro) 
		                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
		        
		                    GetSQLValueString($_POST['nit'], "text"),
		                    GetSQLValueString($dv_bd, "int"),
		                    GetSQLValueString($_POST['tdocumento'], "int"),
		                    GetSQLValueString($_POST['nombre'], "text"),
		                    GetSQLValueString($_POST['apellido'], "text"),
		                    GetSQLValueString($_POST['ciudad'], "text"),
		                    GetSQLValueString($_POST['direccion'], "text"),
		                    GetSQLValueString($_POST['barrio'], "int"),
		                    GetSQLValueString($_POST['otro'], "text"),
		                    GetSQLValueString($_POST['estrato'], "int"),
		                    GetSQLValueString($_POST['telefono1'], "text"),
		                    GetSQLValueString($_POST['telefono2'], "text"),
		                    GetSQLValueString($_POST['celular'], "text"),
		                    GetSQLValueString($_POST['email'], "text"),
		                    GetSQLValueString($_SESSION['id_usuario'], "int"),
		                    GetSQLValueString($fecha_registro, "datetime")); 

			$result = $mysqli->query($sql); 

	        if ($result) {

	        	$_SESSION['nit']= $_POST['nit'];

		        echo "<script  type='text/javascript'>
		                $.confirm({
		                        title: '',
		                        content: 'OPERACION EXITOSA! <br> CONTINUEMOS',
		                        icon: 'fa fa-check-square',
		                        animation: 'scale',
		                        closeAnimation: 'scale',
		                        theme: 'supervan',
		                        type: 'green',
		                        opacity: 0.5,
		                        buttons: {
		                            'ok': {
		                                text: 'OK',
		                                btnClass: 'btn-blue',
		                                action: function () {
		                                    console.log('tambien por aqui');
		                                    window.location.replace('../modules/quotes');
		                                }
		                            }, 
		                        }
		                    });
		                </script>";
	        }else{

	        	$_SESSION['nit']= $_POST['nit'];

		        echo "<script  type='text/javascript'>
		                $.confirm({
		                        title: '',
		                        content: 'ERROR 300! CONSULTE A SU DPTO DE SISTEMAS',
		                        icon: 'fa fa-check-square',
		                        animation: 'scale',
		                        closeAnimation: 'scale',
		                        theme: 'supervan',
		                        type: 'red',
		                        opacity: 0.5,
		                        buttons: {
		                            'ok': {
		                                text: 'OK',
		                                btnClass: 'btn-blue',
		                                action: function () {
		                                    console.log('tambien por aqui');
		                                    window.location.replace('../modules/client');
		                                }
		                            }, 
		                        }
		                    });
		                </script>";
	        }
		     
		    
		}else{
			echo "<script  type='text/javascript'>
	                $.confirm({
	                    title: '',
	                    content: 'EL CLIENTE YA EXISTE, CONSULTE DPTO DE SISTEMAS!',
	                    icon: 'fa fa-window-close ',
	                    animation: 'scale',
	                    closeAnimation: 'scale',
	                    theme: 'supervan',
	                    type: 'red',
	                    opacity: 0.5,
	                    buttons: {
	                        'ok': {
	                            text: 'OK',
	                            btnClass: 'btn-blue',
	                            action: function () {
	                                console.log('tambien por aqui2');
	                                window.location.replace('../modules/client');

	                            }
	                        }, 
	                    }
	                });
	            </script>"; 
		}
    }else{
    	echo "<script  type='text/javascript'>
	            $.confirm({
	                title: '',
	                content: 'RECUERDE QUE LOS CAMPOS CON (*) SON OBLIGATORIOS!',
	                icon: 'fa fa-window-close ',
	                animation: 'scale',
	                closeAnimation: 'scale',
	                theme: 'supervan',
	                type: 'red',
	                opacity: 0.5,
	                buttons: {
	                    'ok': {
	                        text: 'OK',
	                        btnClass: 'btn-blue',
	                        action: function () {
	                            console.log('tambien por aqui2');
	                            window.location.replace('../modules/client');

	                        }
	                    }, 
	                }
	            });
	        </script>"; 
    }
 ?>