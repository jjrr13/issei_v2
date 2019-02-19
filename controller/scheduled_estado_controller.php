<?php 

	$ruta="../";
	
	include_once $ruta."cx/cx.php";

	if (isset($_POST['submit1'])) {
		if ( (isset($_POST['estado']) && !empty($_POST['estado']) ) &&
			 (isset($_POST['cita']) && !empty($_POST['cita']) ) &&
		 	 (isset($_POST['obs']) && !empty($_POST['obs']) ) ) {
	
				$obs = $_POST['obs'];
				$hora = date('H:i:s');
				$estado = $_POST['estado'];
				$id_agendamiento = $_POST['cita'];


				$sql = sprintf("UPDATE agendamiento SET hora_fin=%s, id_estado=%s, obervacion_agd=%s WHERE id_agendamiento= %s",
				      
				       GetSQLValueString($hora, "text"),
				       GetSQLValueString($estado, "int"),
				       GetSQLValueString($_POST['obs'], "text"),
				       GetSQLValueString($id_agendamiento, "int"));

				$result = $mysqli->query($sql);

				scripts($ruta);	
			
			if(!$result){
				confirmar('ERROR EN LA BD CONSULTE DTO SISTEMAS', 'fa fa-window-close-o', 'red', '../modules/scheduled');
			}else{
				echo "
					<script  type='text/javascript'>

		   	        	 	
		                $.confirm({
		                    icon: 'fa fa-user-circle-o',
		                    theme: 'supervan',
		                    closeIcon: false,
		                    content: 'CITA TERMINADA',
		                    animation: 'scale',
		                    type: 'green',
		                    buttons: {
		                        'ok': {
		                            text: 'TERMINAR',
		                            btnClass: 'btn-blue',
		                            action: function () {
		                                //alert('TERMINO');
		                                localStorage.setItem('cita', null);
		                                window.location.replace('../modules/scheduled');
		                            }
		                        },
		                    }
		                });

		        	</script>";
			}

		}
		else{
				scripts($ruta);	
			confirmar('FALTARON ALGUNOS DATOS PARA TERMINAR LA CITA', 'fa fa-window-close-o', 'green', '../modules/scheduled');
		}

	}

	if ( (isset($_POST['cita']) && !empty($_POST['cita']) ) &&
		 (isset($_POST['estado']) && !empty($_POST['estado']) ) ) {

			$hora = date('H:i:s');
			$estado = $_POST['estado'];
			$id_agendamiento = $_POST['cita'];

			$sql = sprintf("UPDATE agendamiento SET hora_ini=%s, id_estado=%s WHERE id_agendamiento= %s",
			      
			       GetSQLValueString($hora, "text"),
			       GetSQLValueString($estado, "int"),
			       GetSQLValueString($id_agendamiento, "int"));

			$result = $mysqli->query($sql);

			if(!$result){

				scripts($ruta);	

				confirmar('ERROR EN LA BD CONSULTE DTO SISTEMAS', 'fa fa-window-close-o', 'green', '../modules/scheduled');

			}else{
				$arrayjson = array();
				$arrayjson[] = array(
								'estado'          =>  $estado,
								
				);
				echo json_encode($arrayjson);
			}

	}
	else{
		scripts($ruta);	
		
		confirmar('FALTARON ALGUNOS DATOS PARA ACTUALIZAR EL ESTADO DE LA CITA, INTENTA DE NUEVO!', 'fa fa-window-close-o', 'red', '../modules/scheduled');
	}

 ?>