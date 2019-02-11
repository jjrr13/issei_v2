<?php 

include_once "../cx/cx.php";
	// error_reporting(E_ERROR | E_WARNING | E_PARSE);
function unir($modalidad1)
{
	$tem = explode(' ', $modalidad1);
	if ( sizeof($tem)>1) {
		$union='';
		for ($js=0; $js < sizeof($tem); $js++) {
			$union.=$tem[$js];
		}
		return $union;
	}
	else{
		return $modalidad1;
	}

}

if (!empty($_POST['usos']) && !empty($_POST['tipoModalidades'])) {
	// La funcion explode convertira la cadena a arreglo
	$estrato = !empty($_POST['estrato']) ? $_POST['estrato'] : '' ;
	$_SESSION['conceptos'] = array();

	$uso = explode(',', $_POST['usos']);
	$modalidad = explode(',', $_POST['tipoModalidades']);

	for ($j=0; $j < sizeof($uso); $j++) { 
		// if ($uso[$j] == 'Vivienda' ) {
		// 	$estrato2 = $estrato;
		// }
		for ($jr=0; $jr < sizeof($modalidad); $jr++) {
			
			$datoModalidad = $modalidad[$jr];
			$modalidad[$jr] = unir($modalidad[$jr]);
			
			$fQ = $uso[$j].'_'.$modalidad[$jr];

			if (!empty($_POST[$fQ])) {
				$concepto = $datoModalidad.' '.$uso[$j].' '. ($uso[$j] == 'Vivienda' ) ? 'Estrato '.$estrato : '' ;

				$variable = $uso[$j].'_'.$modalidad[$jr].'_0';
				$variable = $_POST[$variable];

				array_push($_SESSION['conceptos'], array(  "1"  => $concepto,  "2" => $fQ,  "3" => $variable, ));

			}
			
		}
	}
}
else{
	// $_SESSION['radicar'] = 133;
	// $arrayjson = array();
	// $arrayjson[] = array(
	// 				'estado'	=> 0 );

	// echo json_encode($arrayjson);
	echo 1;
}


function limpiar()
{
	unset($_SESSION['radicar']);
	unset( $_SESSION['objetoTramite']);
	unset( $_SESSION['usos']);
	unset( $_SESSION['licencias']);
	unset( $_SESSION['predio']);
	unset( $_SESSION['vecinos']);
	unset( $_SESSION['titulares']);
	$_SESSION['radicar']=130;
	unset( $_SESSION['responsables']);
}
